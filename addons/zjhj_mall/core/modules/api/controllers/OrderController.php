<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/7/17
 * Time: 11:47
 */

namespace app\modules\api\controllers;


use app\models\Order;
use app\models\UploadConfig;
use app\models\UploadForm;
use app\modules\api\behaviors\LoginBehavior;
use app\modules\api\models\ExpressDetailForm;
use app\modules\api\models\LocationForm;
use app\modules\api\models\OrderClerkForm;
use app\modules\api\models\OrderCommentForm;
use app\modules\api\models\OrderCommentPreview;
use app\modules\api\models\OrderConfirmForm;
use app\modules\api\models\OrderDetailForm;
use app\modules\api\models\OrderListForm;
use app\modules\api\models\OrderPayDataForm;
use app\modules\api\models\OrderRefundDetailForm;
use app\modules\api\models\OrderRefundForm;
use app\modules\api\models\OrderRefundPreviewForm;
use app\modules\api\models\OrderRevokeForm;
use app\modules\api\models\OrderSubmitForm;
use app\modules\api\models\OrderSubmitPreviewForm;
use app\modules\api\models\QrcodeForm;
use yii\base\Object;
use yii\helpers\VarDumper;

class OrderController extends Controller
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'login' => [
                'class' => LoginBehavior::className(),
            ],
        ]);
    }

    //订单提交前的预览页面
    public function actionSubmitPreview()
    {
        $form = new OrderSubmitPreviewForm();
        $form->attributes = \Yii::$app->request->get();
        $form->store_id = $this->store->id;
        $form->user_id = \Yii::$app->user->id;
        $this->renderJson($form->search());
    }

    //订单提交
    public function actionSubmit()
    {
        $form = new OrderSubmitForm();
        $model = \Yii::$app->request->post();
        if($model['offline'] == 0){
            $form->scenario = "EXPRESS";
        }else{
            $form->scenario = "OFFLINE";
        }
        $form->attributes = $model;
        $form->store_id = $this->store->id;
        $form->user_id = \Yii::$app->user->id;
        $this->renderJson($form->save());
    }

    //订单支付数据
    public function actionPayData()
    {
        $form = new OrderPayDataForm();
        $form->attributes = \Yii::$app->request->get();
        $form->store_id = $this->store->id;
        $form->user = \Yii::$app->user->identity;
        $this->renderJson($form->search());
    }

    //订单列表
    public function actionList()
    {
        $form = new OrderListForm();
        $form->attributes = \Yii::$app->request->get();
        $form->store_id = $this->store->id;
        $form->user_id = \Yii::$app->user->id;
        $this->renderJson($form->search());
    }

    //订单取消
    public function actionRevoke()
    {
        $form = new OrderRevokeForm();
        $form->attributes = \Yii::$app->request->get();
        $form->store_id = $this->store->id;
        $form->user_id = \Yii::$app->user->id;
        $this->renderJson($form->save());
    }

    //订单确认收货
    public function actionConfirm()
    {
        $form = new OrderConfirmForm();
        $form->attributes = \Yii::$app->request->get();
        $form->store_id = $this->store->id;
        $form->user_id = \Yii::$app->user->id;
        $this->renderJson($form->save());
    }

    //订单各个状态数量
    public function actionCountData()
    {
        $res = OrderListForm::getCountData($this->store->id, \Yii::$app->user->id);
        return $this->renderJson([
            'code' => 0,
            'msg' => 'success',
            'data' => $res,
        ]);
    }


    //订单详情
    public function actionDetail()
    {
        $form = new OrderDetailForm();
        $form->attributes = \Yii::$app->request->get();
        $form->store_id = $this->store->id;
        $form->user_id = \Yii::$app->user->id;
        $this->renderJson($form->search());
    }

    //售后页面
    public function actionRefundPreview()
    {
        $form = new OrderRefundPreviewForm();
        $form->attributes = \Yii::$app->request->get();
        $form->store_id = $this->store->id;
        $form->user_id = \Yii::$app->user->id;
        $this->renderJson($form->search());
    }

    //售后提交
    public function actionRefund()
    {
        $form = new OrderRefundForm();
        $form->attributes = \Yii::$app->request->post();
        $form->store_id = $this->store->id;
        $form->user_id = \Yii::$app->user->id;
        $this->renderJson($form->save());
    }

    //售后订单详情
    public function actionRefundDetail()
    {
        $form = new OrderRefundDetailForm();
        $form->attributes = \Yii::$app->request->get();
        $form->store_id = $this->store->id;
        $form->user_id = \Yii::$app->user->id;
        $this->renderJson($form->search());
    }

    //评论预览页面
    public function actionCommentPreview()
    {
        $form = new OrderCommentPreview();
        $form->attributes = \Yii::$app->request->get();
        $form->store_id = $this->store->id;
        $form->user_id = \Yii::$app->user->id;
        $this->renderJson($form->search());
    }

    //评论提交
    public function actionComment()
    {
        $form = new OrderCommentForm();
        $form->attributes = \Yii::$app->request->post();
        $form->store_id = $this->store->id;
        $form->user_id = \Yii::$app->user->id;
        $this->renderJson($form->save());
    }

    //订单物流信息
    public function actionExpressDetail()
    {
        $form = new ExpressDetailForm();
        $form->attributes = \Yii::$app->request->get();
        $form->store_id = $this->store->id;
        $form->user_id = \Yii::$app->user->id;
        $this->renderJson($form->search());
    }
    //核销订单
    public function actionClerk()
    {
        $form = new OrderClerkForm();
        $form->order_id = \Yii::$app->request->get('order_id');
        $form->store_id = $this->store->id;
        $form->user_id = \Yii::$app->user->id;
        $this->renderJson($form->save());
    }
    //核销订单详情
    public function actionClerkDetail()
    {
        $form = new OrderDetailForm();
        $form->order_no = \Yii::$app->request->get('order_no');
        $form->store_id = $this->store->id;
//        $form->user_id = \Yii::$app->user->id;
        $this->renderJson($form->clerk());
    }
    public function actionGetQrcode()
    {
        $order_no = \Yii::$app->request->get('order_no');
        $order = Order::findOne(['order_no'=>$order_no,'store_id'=>$this->store->id]);
        if($order->offline_qrcode){
            return json_encode([
                'code' => 0,
                'msg' => 'success',
                'data' => [
                    'url' => $order->offline_qrcode,
                ],
            ],JSON_UNESCAPED_UNICODE);
        }
        $url = \Yii::$app->cache->get('offline_qrcode'.$order_no);
        if($url){
            return json_encode([
                'code' => 0,
                'msg' => 'success',
                'data' => [
                    'url' => $url,
                ],
            ],JSON_UNESCAPED_UNICODE);
        }
        //获取微信小程序码
//        $access_token = $this->wechat->getAccessToken();
//        $api = "https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token={$access_token}";
//        $data = json_encode([
//            'scene'=>"{$order_no}",
//            'page'=>"pages/clerk/clerk",
//            'width'=>100
//        ],JSON_UNESCAPED_UNICODE);
//        $this->wechat->curl->post($api,$data);
//        $res = $this->wechat->curl->response;
//        //保存到本地
//        $saveRoot = \Yii::$app->basePath . '/web/';
//        $saveDir = 'uploads/linshi/';
//        if (!is_dir($saveRoot . $saveDir)) {
//            mkdir($saveRoot . $saveDir);
//            file_put_contents($saveRoot . $saveDir . '.gitignore', "*\r\n!.gitignore");
//        }
//        $webRoot = \Yii::$app->request->baseUrl . '/';
//        $saveName = md5(uniqid()) . '.jpeg';
//        file_put_contents($saveRoot.$saveDir.$saveName,$res);
//        $form = new UploadForm();
//        $upload_config = UploadConfig::findOne(['store_id'=>$this->store->id]);
//        $form->upload_config = $upload_config;
//        $form->store = $this->store;
////        unlink($saveRoot.$saveDir.$saveName);
//        $res = $form->saveQrcode($saveRoot.$saveDir.$saveName,$saveName);

        $form = new QrcodeForm();
//        $form->order_no = $order_no;
        $form->data = [
            'scene'=>"{$order_no}",
            'page'=>"pages/clerk/clerk",
            'width'=>100
        ];
        $form->store = $this->store;
        $res = $form->getQrcode();
        \Yii::$app->cache->set('offline_qrcode'.$order_no,$res['data']['url']);
        $order->offline_qrcode = $res['data']['url'];
        $order->save();
        return json_encode($res,JSON_UNESCAPED_UNICODE);
    }

    public function actionLocation()
    {
        $form = new LocationForm();
        $form->store_id = $this->store->id;
        $form->attributes = \Yii::$app->request->get();
        $this->renderJson($form->search());
    }
}