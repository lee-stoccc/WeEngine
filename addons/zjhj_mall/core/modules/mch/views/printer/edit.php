<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/1
 * Time: 10:20
 */
defined('YII_RUN') or exit('Access Denied');

use yii\widgets\LinkPager;
use \app\models\Option;
/* @var \app\models\Printer $model */

$urlManager = Yii::$app->urlManager;
$this->title = '打印机编辑';
$this->params['active_nav_group'] = 13;
$returnUrl = Yii::$app->request->referrer;
if (!$returnUrl)
    $returnUrl = $urlManager->createUrl(['mch/printer/list']);
?>
<div class="main-nav" flex="cross:center dir:left box:first">
    <div>
        <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/index']) ?>">我的商城</a>
            <a class="breadcrumb-item" href="<?= $returnUrl ?>">打印机管理</a>
            <span class="breadcrumb-item active"><?= $this->title ?></span>
        </nav>
    </div>
    <div>
        <?= $this->render('/layouts/nav-right') ?>
    </div>
</div>
<div class="main-body p-3" id="app">
    <form class="form auto-submit-form" method="post" autocomplete="off" data-return="<?= $returnUrl ?>">
        <div class="form-title"><?= $this->title ?></div>
        <div class="form-body">

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required">打印机名称</label>
                </div>
                <div class="col-9">
                    <input class="form-control" name="name" value="<?= $model->name ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">打印机类型</label>
                </div>
                <div class="col-9">
                    <select class="form-control" name="printer_type" v-model="printer_type">
                        <option value="kdt2">365云打印（编号kdt2）</option>
                        <option value="yilianyun-k4">易联云（k4）</option>
                        <option value="feie">飞鹅打印机</option>
                    </select>
                    <div>目前支持365-kdt2云打印、易联云-k4</div>
                </div>
            </div>
            <div v-if="printer_type == 'kdt2'">
                <div class="form-group row">
                    <div class="col-3 text-right">
                        <label class=" col-form-label">打印机编号</label>
                    </div>
                    <div class="col-9">
                        <input class="form-control" name="printer_setting[name]" value="<?= $model->printer_setting['name'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-3 text-right">
                        <label class=" col-form-label">打印机密钥</label>
                    </div>
                    <div class="col-9">
                        <input class="form-control" name="printer_setting[key]" value="<?= $model->printer_setting['key'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-3 text-right">
                        <label class=" col-form-label">打印机联数</label>
                    </div>
                    <div class="col-9">
                        <input class="form-control" type="number" min="1" max="9" name="printer_setting[time]" value="<?= $model->printer_setting['time'] ?>">
                        <div class="fs-sm">同一订单，打印的次数</div>
                    </div>
                </div>
                <div class="form-group row" hidden>
                    <div class="col-3 text-right">
                        <label class=" col-form-label">URL</label>
                    </div>
                    <div class="col-9">
                        <input class="form-control" name="printer_setting[url]" value="http://open.printcenter.cn:8080/addOrder">
                    </div>
                </div>
            </div>
            <div v-if="printer_type == 'yilianyun-k4'">
                <div class="form-group row">
                    <div class="col-3 text-right">
                        <label class=" col-form-label">终端号</label>
                    </div>
                    <div class="col-9">
                        <input class="form-control" name="printer_setting[machine_code]" value="<?= $model->printer_setting['machine_code'] ?>">
                        <div class="fs-sm">打印机终端号</div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-3 text-right">
                        <label class=" col-form-label">密钥</label>
                    </div>
                    <div class="col-9">
                        <input class="form-control" name="printer_setting[key]" value="<?= $model->printer_setting['key'] ?>">
                        <div class="fs-sm">打印机终端密钥</div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-3 text-right">
                        <label class=" col-form-label">用户ID</label>
                    </div>
                    <div class="col-9">
                        <input class="form-control" name="printer_setting[client_id]" value="<?= $model->printer_setting['client_id'] ?>">
                        <div class="fs-sm">用户id（管理中心系统集成里获取）</div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-3 text-right">
                        <label class=" col-form-label">apiKey</label>
                    </div>
                    <div class="col-9">
                        <input class="form-control" name="printer_setting[client_key]" value="<?= $model->printer_setting['client_key'] ?>">
                        <div class="fs-sm">apiKey（管理中心系统集成里获取）</div>
                    </div>
                </div>
                <div class="form-group row" hidden>
                    <div class="col-3 text-right">
                        <label class=" col-form-label">URL</label>
                    </div>
                    <div class="col-9">
                        <input class="form-control" name="printer_setting[url]" value="<?= $model->printer_setting['url']?$model->printer_setting['url']:"http://open.10ss.net:8888" ?>">
                        <div class="fs-sm">API接口地址</div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-3 text-right">
                        <label class=" col-form-label">打印联数</label>
                    </div>
                    <div class="col-9">
                        <input class="form-control" type="number" min="1" max="9" name="printer_setting[time]" value="<?= $model->printer_setting['time'] ?>">
                        <div class="fs-sm">同一订单，打印的次数</div>
                    </div>
                </div>
            </div>
            <div v-if="printer_type == 'feie'">
                <div class="form-group row">
                    <div class="col-3 text-right">
                        <label class=" col-form-label">USER</label>
                    </div>
                    <div class="col-9">
                        <input class="form-control" name="printer_setting[user]" value="<?= $model->printer_setting['user'] ?>">
                        <div class="fs-sm">飞鹅云后台注册用户名</div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-3 text-right">
                        <label class=" col-form-label">UKEY</label>
                    </div>
                    <div class="col-9">
                        <input class="form-control" name="printer_setting[ukey]" value="<?= $model->printer_setting['ukey'] ?>">
                        <div class="fs-sm">飞鹅云后台登录生成的UKEY</div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-3 text-right">
                        <label class=" col-form-label">打印机编号</label>
                    </div>
                    <div class="col-9">
                        <input class="form-control" name="printer_setting[sn]" value="<?= $model->printer_setting['sn'] ?>">
                        <div class="fs-sm">打印机编号9位,查看飞鹅打印机底部贴纸上面的打印机编号</div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-3 text-right">
                        <label class=" col-form-label">打印机key</label>
                    </div>
                    <div class="col-9">
                        <input class="form-control" name="printer_setting[key]" value="<?= $model->printer_setting['key'] ?>">
                        <div class="fs-sm">打印机编号9位,查看飞鹅打印机底部贴纸上面的打印机key</div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-3 text-right">
                        <label class=" col-form-label">打印联数</label>
                    </div>
                    <div class="col-9">
                        <input class="form-control" type="number" min="1" max="9" name="printer_setting[time]" value="<?= $model->printer_setting['time'] ?>">
                        <div class="fs-sm">同一订单，打印的次数</div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-9 offset-sm-3">
                    <div class="text-danger form-error mb-3" style="display: none">错误信息</div>
                    <div class="text-success form-success mb-3" style="display: none">成功信息</div>
                    <a class="btn btn-primary submit-btn" href="javascript:">保存</a>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    var app = new Vue({
        el: "#app",
        data: {
            printer_type: "<?=$model->printer_type?$model->printer_type:"kdt2"?>",
        },
    });
</script>