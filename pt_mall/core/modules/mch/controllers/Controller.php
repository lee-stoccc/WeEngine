<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/6/26
 * Time: 14:13
 */

namespace app\modules\mch\controllers;


use app\models\AdminPermission;
use app\models\Store;
use app\models\We7UserAuth;
use app\models\WechatApp;
use luweiss\wechat\Wechat;
use yii\helpers\VarDumper;

/**
 * @property Wechat $wechat
 */
class Controller extends \app\controllers\Controller
{
    public $layout = 'main';
    public $store;
    /* @var Wechat $wechat */
    public $wechat;
    public $wechat_app;

    public $is_admin = true;
    public $is_we7 = false;
    public $we7_user_auth = null;
    public $version;

    public function init()
    {
        parent::init();
        $this->store = Store::findOne([
            'id' => \Yii::$app->session->get('store_id'),
        ]);

//        if (!\Yii::$app->admin->isGuest) {
//            if (\Yii::$app->admin->id != $this->store->admin_id && \Yii::$app->admin->id != 1) {
//                \Yii::$app->response->redirect(\Yii::$app->urlManager->createUrl(['admin/default/index']))->send();
//                \Yii::$app->end();
//            }
//        }

//        if (empty($this->store)) {
//            \Yii::$app->response->redirect(\Yii::$app->urlManager->createUrl(['mch/passport/login']))->send();
//            \Yii::$app->end();
//        }
        $this->wechat_app = WechatApp::findOne(['id' => $this->store->wechat_app_id]);

        if (!is_dir(\Yii::$app->runtimePath . '/pem')) {
            mkdir(\Yii::$app->runtimePath . '/pem');
            file_put_contents(\Yii::$app->runtimePath . '/pem/index.html', '');
        }
        $cert_pem_file = null;
        if ($this->wechat_app->cert_pem) {
            $cert_pem_file = \Yii::$app->runtimePath . '/pem/' . md5($this->wechat_app->cert_pem);
            if (!file_exists($cert_pem_file))
                file_put_contents($cert_pem_file, $this->wechat_app->cert_pem);
        }
        $key_pem_file = null;
        if ($this->wechat_app->key_pem) {
            $key_pem_file = \Yii::$app->runtimePath . '/pem/' . md5($this->wechat_app->key_pem);
            if (!file_exists($key_pem_file))
                file_put_contents($key_pem_file, $this->wechat_app->key_pem);
        }
        $this->wechat = new Wechat([
            'appId' => $this->wechat_app->app_id,
            'appSecret' => $this->wechat_app->app_secret,
            'mchId' => $this->wechat_app->mch_id,
            'apiKey' => $this->wechat_app->key,
            'certPem' => $cert_pem_file,
            'keyPem' => $key_pem_file,
        ]);

        if (!\Yii::$app->admin->isGuest) {
            if (\Yii::$app->admin->id == 1)
                $this->is_admin = true;
        } else {
            if (isset($_SESSION['we7_user']['uid']) && $_SESSION['we7_user']['uid'] == 1)
                $this->is_admin = true;
            $this->is_we7 = true;
            $we7_user_auth_model = We7UserAuth::findOne(['we7_user_id' => \Yii::$app->user->identity->we7_uid]);
            if (!$we7_user_auth_model || $we7_user_auth_model->auth == null) {
                $this->we7_user_auth = $this->getAllPermission();
            } else {
                $this->we7_user_auth = json_decode($we7_user_auth_model->auth, true);
            }
        }

        $version = json_decode(file_get_contents(\Yii::$app->basePath . '/version.json'));
        $this->version = empty($version->version) ? '未知' : $version->version;
    }

    /**
     * 检查是否是总管理员，不是管理员则转到首页或指定页面
     * @param String $return_url 跳转的页面
     * @return boolean
     */
    public function checkIsAdmin($return_url = null)
    {
        if (!$this->is_admin) {
            $return_url = $return_url ? $return_url : \Yii::$app->urlManager->createUrl(['mch/store/index']);
            $this->redirect($return_url)->send();
            \Yii::$app->end();
        }
        return true;
    }

    public function getAllPermission()
    {
        $list = AdminPermission::getList();
        $new_list = [];
        foreach ($list as $item)
            $new_list[] = $item->name;
        return $new_list;
    }

}