<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/7/17
 * Time: 11:48
 */

namespace app\modules\api\models\group;


use app\models\Address;
use app\models\Attr;
use app\models\AttrGroup;
use app\models\Cart;
use app\models\Goods;
use app\models\Level;
use app\models\MiaoshaGoods;
use app\models\PostageRules;
use app\models\PtGoods;
use app\models\PtOrder;
use app\models\PtOrderDetail;
use app\models\Shop;
use app\models\Store;
use app\models\User;
use app\modules\api\models\Model;

class OrderSubmitPreviewForm extends Model
{
    public $store_id;
    public $user_id;

    public $address_id;

    public $cart_id_list;
    public $goods_info;

    public $type;

    public function rules()
    {
        return [
            [['cart_id_list', 'goods_info', 'type'], 'string'],
            [['address_id',], 'integer'],
        ];
    }

    public function search()
    {
        $store = Store::findOne($this->store_id);
        if (!$this->validate())
            return $this->getModelError();

        if ($this->type =='GROUP_BUY'||$this->type=='GROUP_BUY_C')
            $res = $this->getDataByGoodsInfo($this->goods_info, $store);
        elseif ($this->type =='ONLY_BUY')
            $res = $this->getDataByGoodsInfoOnOnly($this->goods_info, $store);

//        $level = Level::find()->select([
//            'name', 'level', 'discount'
//        ])->where(['level' => \Yii::$app->user->identity->level, 'store_id' => $this->store_id])->asArray()->one();
//        $res['data']['level'] = $level;
        $res['data']['send_type'] = $store->send_type;

        return $res;
    }

    /**
     * 团购确认订单页展示数据获取
     * @param string $goods_info
     * JSON,eg.{"goods_id":"22","attr":[{"attr_group_id":1,"attr_group_name":"颜色","attr_id":3,"attr_name":"橙色"},{"attr_group_id":2,"attr_group_name":"尺码","attr_id":7,"attr_name":"L"}],"num":1}
     */
    private function getDataByGoodsInfo($goods_info, $store)
    {
        $goods_info = json_decode($goods_info);
        $goods = PtGoods::findOne([
            'id' => $goods_info->goods_id,
            'is_delete' => 0,
            'store_id' => $this->store_id,
            'status' => 1,
        ]);
        if (!$goods) {
            return [
                'code' => 1,
                'msg' => '商品不存在或已下架',
            ];
        }

        $attr_id_list = [];
        foreach ($goods_info->attr as $item) {
            array_push($attr_id_list, $item->attr_id);
        }
        $total_price = 0;
        $goods_attr_info = $goods->getAttrInfo($attr_id_list);

        $attr_list = Attr::find()->alias('a')
            ->select('ag.attr_group_name,a.attr_name')
            ->leftJoin(['ag' => AttrGroup::tableName()], 'a.attr_group_id=ag.id')
            ->where(['a.id' => $attr_id_list])
            ->asArray()->all();
        $goods_pic = isset($goods_attr_info['pic']) ? $goods_attr_info['pic'] ?: $goods->cover_pic : $goods->cover_pic;
        $goods_item = (object)[
            'goods_id' => $goods->id,
            'goods_name' => $goods->name,
            'goods_pic' => $goods_pic,
            'num' => $goods_info->num,
            'price' => doubleval(empty($goods_attr_info['price']) ? $goods->price : $goods_attr_info['price']) * $goods_info->num,
            'attr_list' => $attr_list,
        ];

        $total_price += $goods_item->price;

        $address = Address::find()->select('id,name,mobile,province_id,province,city_id,city,district_id,district,detail,is_default')->where([
            'id' => $this->address_id,
            'store_id' => $this->store_id,
            'user_id' => $this->user_id,
            'is_delete' => 0,
        ])->asArray()->one();
        if (!$address) {
            $address = Address::find()->select('id,name,mobile,province_id,province,city_id,city,district_id,district,detail,is_default')->where([
                'store_id' => $this->store_id,
                'user_id' => $this->user_id,
                'is_delete' => 0,
            ])->orderBy('is_default DESC,addtime DESC')->asArray()->one();
        }
        $express_price = 0;
        if ($address) {
            $express_price = PostageRules::getExpressPrice($this->store_id, $address['province_id'], $goods, $goods_info->num);
        }

        if ($this->type == 'GROUP_BUY'){
            $colonel = $goods->colonel;
        }else{
            $colonel = 0;
        }

        $orderNum = PtOrder::find()
            ->alias('o')
            ->select([
                'o.*',
            ])
            ->andWhere(['o.user_id'=>$this->user_id,'o.is_delete'=>0,'o.is_pay'=>1,'o.is_group'=>1])
            ->andWhere(['OR',['o.status'=>2],['o.status'=>3]])
            ->leftJoin(['od'=>PtOrderDetail::tableName()],'od.order_id = o.id')
            ->andWhere(['od.goods_id'=>$goods->id])
            ->count();
        if (!empty($goods->buy_limit) && $goods->buy_limit <= $orderNum){
            return [
                'code'  => 1,
                'msg'   => '您已超过该商品购买次数',
            ];
        }

        return [
            'code' => 0,
            'msg' => 'success',
            'data' => [
                'total_price' => $total_price,
                'goods_info' => $goods_info,
                'list' => [
                    $goods_item
                ],
                'address' => $address,
                'express_price' => $express_price,
                'colonel' => $colonel,
            ],
        ];
    }


    /**
     * 单独购买确认订单展示页数据获取
     * @param string $goods_info
     * JSON,eg.{"goods_id":"22","attr":[{"attr_group_id":1,"attr_group_name":"颜色","attr_id":3,"attr_name":"橙色"},{"attr_group_id":2,"attr_group_name":"尺码","attr_id":7,"attr_name":"L"}],"num":1}
     */
    private function getDataByGoodsInfoOnOnly($goods_info, $store)
    {
        $goods_info = json_decode($goods_info);
        $goods = PtGoods::findOne([
            'id' => $goods_info->goods_id,
            'is_delete' => 0,
            'store_id' => $this->store_id,
            'status' => 1,
        ]);
        if (!$goods) {
            return [
                'code' => 1,
                'msg' => '商品不存在或已下架',
            ];
        }

        $attr_id_list = [];
        foreach ($goods_info->attr as $item) {
            array_push($attr_id_list, $item->attr_id);
        }
        $total_price = 0;
        $goods_attr_info = $goods->getAttrInfo($attr_id_list);

        $attr_list = Attr::find()->alias('a')
            ->select('ag.attr_group_name,a.attr_name')
            ->leftJoin(['ag' => AttrGroup::tableName()], 'a.attr_group_id=ag.id')
            ->where(['a.id' => $attr_id_list])
            ->asArray()->all();
        $goods_pic = isset($goods_attr_info['pic']) ? $goods_attr_info['pic'] ?: $goods->cover_pic : $goods->cover_pic;
        $goods_item = (object)[
            'goods_id' => $goods->id,
            'goods_name' => $goods->name,
            'goods_pic' => $goods_pic,
            'num' => $goods_info->num,
            'price' => $goods->original_price * $goods_info->num,
            'attr_list' => $attr_list,
        ];

        $total_price += $goods_item->price;
        $address = Address::find()->select('id,name,mobile,province_id,province,city_id,city,district_id,district,detail,is_default')->where([
            'id' => $this->address_id,
            'store_id' => $this->store_id,
            'user_id' => $this->user_id,
            'is_delete' => 0,
        ])->asArray()->one();
        if (!$address) {
            $address = Address::find()->select('id,name,mobile,province_id,province,city_id,city,district_id,district,detail,is_default')
                ->where([
                    'store_id' => $this->store_id,
                    'user_id' => $this->user_id,
                    'is_delete' => 0,
                ])->orderBy('is_default DESC,addtime DESC')->asArray()->one();
        }

        $express_price = 0;
        if ($address) {
            $express_price = PostageRules::getExpressPrice($this->store_id, $address['province_id'], $goods, $goods_info->num);
        }

        return [
            'code' => 0,
            'msg' => 'success',
            'data' => [
                'total_price' => $total_price,
                'goods_info' => $goods_info,
                'list' => [
                    $goods_item
                ],
                'address' => $address,
                'express_price' => $express_price,
                'colonel' => 0,
            ],
        ];
    }


}