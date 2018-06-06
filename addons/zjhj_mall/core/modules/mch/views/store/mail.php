<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/12
 * Time: 9:46
 */
defined('YII_RUN') or exit('Access Denied');
/* @var $list \app\models\MailSetting */
$urlManager = Yii::$app->urlManager;
$this->title = '邮件设置';
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
        <div class="form-title">邮件设置（QQ邮箱）</div>
        <div class="form-body">
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">开启邮箱提醒</label>
                </div>
                <div class="col-9">
                    <div class="pt-1">
                        <label class="custom-control custom-radio">
                            <input id="radio2" <?= $list->status == 0 ? 'checked' : null ?>
                                   value="0"
                                   name="status" type="radio" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">关闭</span>
                        </label>
                        <label class="custom-control custom-radio">
                            <input id="radio1" <?= $list->status == 1 ? 'checked' : null ?>
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
                    <label class=" col-form-label required">发件人邮箱</label>
                </div>
                <div class="col-9">
                    <input autocomplete="off" class="form-control" type="text" name="send_mail"
                           value="<?=$list->send_mail ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required">授权码</label>
                </div>
                <div class="col-9">
                    <?php if ($list->send_pwd): ?>
                        <div class="input-hide">
                            <input class="form-control" type="text" name="send_pwd"
                                   value="<?= $list->send_pwd ?>">
                            <div class="tip-block">已隐藏授权码，点击查看或编辑</div>
                        </div>
                    <?php else: ?>
                        <input class="form-control" type="text" name="send_pwd"
                               value="<?= $list->send_pwd ?>">
                    <?php endif; ?>
                    <div class="fs-sm"><a target="_blank" href="http://service.mail.qq.com/cgi-bin/help?subtype=1&&no=1001256&&id=28">什么是授权码？</a></div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required">发件平台名称</label>
                </div>
                <div class="col-9">
                    <input autocomplete="off" class="form-control" type="text" name="send_name"
                           value="<?=$list->send_name ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required">收件人邮箱</label>
                </div>
                <div class="col-9">
                    <input autocomplete="off" class="form-control" type="text" name="receive_mail"
                           value="<?=$list->receive_mail ?>">
                    <div class="fs-sm">多个请用英文逗号隔开</div>
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

