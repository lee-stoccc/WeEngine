<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/15
 * Time: 14:17
 */

namespace app\modules\mch\models;


use app\models\Model;
use app\models\Order;

class OrderPriceForm extends Model
{
    public $store_id;
    public $order_id;
    public $price;
    public $type;

    public function rules()
    {
        return [
            [['order_id','price','type'],'number'],
            [['type'],'in','range'=>[1,2]],
            [['price'],'required']
        ];
    }
    public function attributeLabels()
    {
        return [
            'price'=>'修改的价格'
        ];
    }

    public function update()
    {
        if(!$this->validate()){
            return $this->getModelError();
        }
        $order = Order::findOne(['id'=>$this->order_id,'is_delete'=>0,'is_pay'=>0]);
        if(!$order){
            return [
                'code'=>0,
                'msg'=>'网络异常'
            ];
        }
        $money = $order->pay_price;
        if($order->before_update_price){
        }else{
            $order->before_update_price = $money;
        }
        if($this->type == 1){
            $order->pay_price = round($money + $this->price,2);
        }else{
            $order->pay_price = round($money - $this->price,2);
        }
        if($order->pay_price < 0.01){
            return [
                'code'=>1,
                'msg'=>'修改后的价格不能小于0.01'
            ];
        }
        if($order->save()){
            return [
                'code'=>0,
                'msg'=>'成功'
            ];
        }else{
            return [
                'code'=>1,
                'msg'=>'网络异常'
            ];
        }
    }
}