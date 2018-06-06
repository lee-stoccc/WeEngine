<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/7/27
 * Time: 14:14
 */

namespace app\modules\mch\models;


use app\models\Order;
use app\models\OrderRefund;
use yii\helpers\VarDumper;

class StoreDataForm extends Model
{
    public $store_id;
    public $is_offline;
    public $user_id;
    public $clerk_id;
    public $parent_id;
    public $shop_id;

    public function search()
    {

        $condition = ['store_id' => $this->store_id, 'is_delete' => 0, 'is_cancel' => 0];
        $condition_c = ['store_id' => $this->store_id];
        $condition_m = ['store_id' => $this->store_id, 'is_cancel' => 0];
        if ($this->is_offline) {
            $condition['is_offline'] = $this->is_offline;
            $condition_c['is_offline'] = $this->is_offline;
        }
        if($this->user_id){
            $condition['user_id'] = $this->user_id;
            $condition_c['user_id'] = $this->user_id;
        }
        if($this->clerk_id){
            $condition['clerk_id'] = $this->clerk_id;
        }
        if($this->shop_id){
            $condition['shop_id'] = $this->shop_id;
        }
        $data = [
            'all_count' => [
                'all' => Order::find()->where($condition)->count('1'),
                '1day' => Order::find()->where($condition)->andWhere([
                    'AND',
                    ['>=', 'addtime', strtotime(date('Y-m-d 00:00:00'))],
                    ['<=', 'addtime', strtotime(date('Y-m-d 23:59:59'))],
                ])->count('1'),
                '7day' => Order::find()->where($condition)->andWhere([
                    'AND',
                    ['>=', 'addtime', strtotime(date('Y-m-d 23:59:59')) - 86400 * 7],
                    ['<=', 'addtime', strtotime(date('Y-m-d 23:59:59'))],
                ])->count('1'),
                '30day' => Order::find()->where($condition)->andWhere([
                    'AND',
                    ['>=', 'addtime', strtotime(date('Y-m-d 23:59:59')) - 86400 * 30],
                    ['<=', 'addtime', strtotime(date('Y-m-d 23:59:59'))],
                ])->count('1'),
            ],
            'status_count' => [
                'status_0' => Order::find()->where($condition)->andWhere(['is_pay' => 0])->count('1'),
                'status_1' => Order::find()->where($condition)->andWhere(['is_pay' => 1, 'is_send' => 0])->count('1'),
                'status_2' => Order::find()->where($condition)->andWhere(['is_send' => 1, 'is_confirm' => 0])->count('1'),
                'status_3' => Order::find()->where($condition)->andWhere(['is_confirm' => 1])->count('1'),
                'status_5' => Order::find()->where($condition_c)->andWhere(['or',['is_cancel'=>1],['is_delete'=>1,'apply_delete'=>1]])->count('1'),
            ],
            'money' => [
                'day' => Order::find()->where($condition_m)->andWhere([
                    'AND',
                    ['>=', 'addtime', strtotime(date('Y-m-d 00:00:00'))],
                    ['<=', 'addtime', strtotime(date('Y-m-d 23:59:59'))],
                    ['is_pay' => 1]
                ])->select(['sum(pay_price)'])->scalar(),
                'month' => Order::find()->where($condition_m)->andWhere([
                    'AND',
                    ['month(FROM_UNIXTIME(addtime))' => date('m')],
                    ['is_pay' => 1]
                ])->select(['sum(pay_price)'])->scalar(),
                'all' => Order::find()->where($condition_m)->andWhere([
                    'is_pay' => 1
                ])->select(['sum(pay_price)'])->scalar(),
                'refuse_1' => Order::find()->where($condition_m)->andWhere([
                    'is_pay' => 1,'apply_delete'=>1,'is_delete'=>1
                ])->select(['sum(pay_price)'])->scalar(),
                'refuse_2' => OrderRefund::find()->where(['store_id'=>$this->store_id,'is_delete'=>0,'type'=>1])->andWhere([
                    'status'=>1
                ])->select(['sum(refund_price)'])->scalar(),
            ],
        ];
        return $data;
    }
}