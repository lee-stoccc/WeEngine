<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/23
 * Time: 15:40
 */
defined('YII_RUN') or exit('Access Denied');
/* @var $sms \app\models\SmsSetting */
$urlManager = Yii::$app->urlManager;
$this->title = '短信设置';
$this->params['active_nav_group'] = 1;
?>

<div class="main-nav" flex="cross:center dir:left box:first">
    <div>
        <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/index']) ?>">我的商城</a>
            <span class="breadcrumb-item active"><?= $this->title ?></span>
        </nav>
    </div>
    <div>
        <?= $this->render('/layouts/nav-right') ?>
    </div>
</div>

<div class="main-body p-3" id="app">
    <form class="form auto-submit-form" method="post" autocomplete="off">
        <div class="form-title">短信设置（阿里云平台的短信服务）</div>
        <div class="form-body">
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">开启短信提醒</label>
                </div>
                <div class="col-9">
                    <div class="pt-1">
                        <label class="custom-control custom-radio">
                            <input id="radio2" <?= $sms->status == 0 ? 'checked' : null ?>
                                   value="0"
                                   name="status" type="radio" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">关闭</span>
                        </label>
                        <label class="custom-control custom-radio">
                            <input id="radio1" <?= $sms->status == 1 ? 'checked' : null ?>
                                   value="1"
                                   name="status" type="radio" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">开启</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required">阿里云AccessKeyId</label>
                </div>
                <div class="col-9">
                    <?php if ($sms->AccessKeyId): ?>
                        <div class="input-hide">
                            <input class="form-control" type="text" name="AccessKeyId"
                                   value="<?= $sms->AccessKeyId ?>">
                            <div class="tip-block">已隐藏AccessKeyId，点击查看或编辑</div>
                        </div>
                    <?php else: ?>
                        <input class="form-control" type="text" name="AccessKeyId"
                               value="<?= $sms->AccessKeyId ?>">
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required">阿里云AccessKeySecret</label>
                </div>
                <div class="col-9">
                    <?php if ($sms->AccessKeyId): ?>
                        <div class="input-hide">
                            <input class="form-control" type="text" name="AccessKeySecret"
                                   value="<?= $sms->AccessKeySecret ?>">
                            <div class="tip-block">已隐藏AccessKeySecret，点击查看或编辑</div>
                        </div>
                    <?php else: ?>
                        <input class="form-control" type="text" name="AccessKeySecret"
                               value="<?= $sms->AccessKeySecret ?>">
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required">模板名称</label>
                </div>
                <div class="col-9">
                    <input autocomplete="off" class="form-control" type="text" name="name"
                           value="<?= $sms->name ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required">模板签名</label>
                </div>
                <div class="col-9">
                    <input autocomplete="off" class="form-control" type="text" name="sign"
                           value="<?= $sms->sign ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required">模板ID</label>
                </div>
                <div class="col-9">
                    <input autocomplete="off" class="form-control" type="text" name="tpl"
                           value="<?= $sms->tpl ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">模板变量</label>
                </div>
                <div class="col-9">
                    <input autocomplete="off" class="form-control" type="text" name="msg"
                           value="<?= $sms->msg ?>">
                    <div><span>例如：“模板内容: 您有一个新的订单，订单号：${order}”，则填写“order”</span></div>
                    <div><span class="text-danger" style="font-weight: bold">注意：目前只支持设置订单号</span></div>

                </div>
            </div>

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required">接受短信手机号</label>
                </div>
                <div class="col-9">
                    <input autocomplete="off" class="form-control" type="text" name="mobile"
                           value="<?= $sms->mobile ?>">
                    <div class="fs-sm text-muted">多个请使用英文逗号<kbd>,</kbd>分隔</div>
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
        el:"#app",
        data:{
            mobile_list:[],
            mobile:""
        }
    });
</script>
