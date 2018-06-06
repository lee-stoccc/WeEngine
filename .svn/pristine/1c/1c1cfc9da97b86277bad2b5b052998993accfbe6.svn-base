<?php
defined('YII_RUN') or exit('Access Denied');

use yii\widgets\LinkPager;

$urlManager = Yii::$app->urlManager;
$this->title = '小程序发布';
$this->params['active_nav_group'] = 1;
?>
<style>
    .wxdev-tool-login-qrcode,
    .wxdev-tool-preview-qrcode {
        border: 1px solid #e3e3e3;
    }
</style>
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

<div class="main-body p-3">
    <div class="card">
        <div class="card-block">
            <p style="display: none">小程序发布流程请参考文档：<a href="http://cloud.zjhejiang.com/we7/mall/#help" target="_blank">http://cloud.zjhejiang.com/we7/mall/#help</a>
            </p>
            <?php if (!strstr(Yii::$app->request->hostInfo, 'https://')): ?>
                <p><b class="text-danger">请确认您的服务器是否支持https访问，如不支持，小程序将无法正常运行。</b></p>
            <?php endif; ?>
            <a class="btn btn-sm btn-primary download-wxapp" href="javascript:">打包并下载小程序</a>
            <hr>
            <a class="btn btn-sm btn-primary wxapp-qrcode mb-3" href="javascript:">获取小程序二维码</a>
            <div>
                <img src="" class="wxapp-qrcode-img" style="max-width: 320px">
            </div>
            <hr>
            <a class="btn btn-sm btn-primary mb-3 wxdev-tool-login" href="javascript:">扫码上传小程序</a>
            <div class="wxdev-login-block" style="display: none">
                <div>请使用小程序管理员或开发者微信扫码上传小程序：</div>
                <img src="" class="wxdev-tool-login-qrcode" style="height: 120px">
            </div>
            <div class="wxdev-upload-block" style="display: none">
                <div class="wxdev-upload-res"></div>
                <img src="" class="wxdev-tool-preview-qrcode" style="height: 120px">
            </div>
        </div>
    </div>
</div>
<script>
    var wxdev_token = '';
    $(document).on("click", ".download-wxapp", function () {
        var btn = $(this);
        btn.btnLoading("正在处理");
        $.ajax({
            type: "post",
            dataType: "json",
            data: {
                _csrf: _csrf,
                action: 'download',
            },
            success: function (res) {
                btn.btnReset();
                if (res.code == 0) {
                    window.open(res.data);
                }
                if (res.code == 1) {
                }
            }
        });
    });

    $(document).on("click", ".wxdev-tool-login", function () {
        var btn = $(this);
        btn.btnLoading("正在处理");
        $.ajax({
            type: "post",
            dataType: "json",
            data: {
                _csrf: _csrf,
                action: 'wxdev_tool_login',
            },
            success: function (res) {
                btn.btnReset();
                if (res.code == 0) {
                    $('.wxdev-login-block').show();
                    $('.wxdev-tool-login-qrcode').attr('src', res.data.qrcode);
                    wxdev_token = res.token;
                    checkQrcodeScan();
                } else {
                }
            },
            complete: function () {
                btn.btnReset();
            }
        });
    });

    function checkQrcodeScan() {
        $.ajax({
            type: 'post',
            dataType: "json",
            data: {
                _csrf: _csrf,
                action: 'wxdev_tool_upload',
                token: wxdev_token,
            },
            success: function (res) {
                if (res.code == 0) {
                    $('.wxdev-login-block').hide();
                    $('.wxdev-upload-block').show();
                    $('.wxdev-upload-res').html('上传成功，请登录微信小程序平台（<a href="https://mp.weixin.qq.com/" target="_blank">https://mp.weixin.qq.com/</a>）发布小程序；<br>扫码可预览小程序：');
                    $('.wxdev-tool-preview-qrcode').attr('src', res.data.qrcode);
                }
                if (res.code == -1) {
                    checkQrcodeScan();
                }
                if (res.code == 1) {
                    $('.wxdev-login-block').hide();
                    $('.wxdev-upload-block').show();
                    $.myAlert({
                        content: res.msg,
                        confirm: function () {
                            location.reload();
                        }
                    });
                }
            },
        });
    }

    $(document).on("click", ".wxapp-qrcode", function () {
        var btn = $(this);
        btn.btnLoading("正在处理");
        $.ajax({
            url: "<?=$urlManager->createUrl(['mch/store/wxapp-qrcode'])?>",
            type: "post",
            dataType: "json",
            data: {
                _csrf: _csrf,
            },
            success: function (res) {
                btn.btnReset();
                if (res.code == 0) {
                    $(".wxapp-qrcode-img").attr("src", res.data);
                }
                if (res.code == 1) {
                    $.myAlert({
                        content: res.msg,
                        confirm: function () {
                            location.reload();
                        }
                    });
                }
            }
        });
    });
</script>