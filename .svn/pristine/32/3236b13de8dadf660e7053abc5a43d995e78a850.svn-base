<?php
defined('YII_RUN') or exit('Access Denied');
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/6/19
 * Time: 16:52
 */
$urlManager = Yii::$app->urlManager;
$this->title = '补丁区';
$this->params['active_nav_group'] = 1;
?>

<div class="main-nav" flex="cross:center dir:left">
    <nav class="breadcrumb rounded-0 mb-0">
        <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/index']) ?>">我的商城</a>
        <span class="breadcrumb-item active"><?= $this->title ?></span>
    </nav>
</div>
<div class="main-body p-3">
    <div class="card">
        <div class="card-header">
            <span>WDCP面板补丁</span>
            <?php if ($wdcp_patch): ?>
                <span class="text-success">（已开启）</span>
            <?php else: ?>
                <span>（已关闭）</span>
            <?php endif; ?>
        </div>
        <div class="card-block">
            <div class="mb-3">说明：用于处理装了wdcp面板的环境下无法获取请求的是否是https协议，wdcp面板的用户建议使用，非wdcp面板的用户无需使用，使用后系统将判断所有请求都是https。
            </div>
            <div class="mb-3">
                <span>补丁状态：</span>
                <?php if ($wdcp_patch): ?>
                    <span>已开启</span>
                    <span>|</span>
                    <a href="javascript:" class="badge badge-danger close-wdcp-patch">关闭</a>
                <?php else: ?>
                    <span>已关闭</span>
                    <span>|</span>
                    <a href="javascript:" class="badge badge-success open-wdcp-patch">开启</a>
                <?php endif; ?>
            </div>
            <?php if ($wdcp_patch && is_array($wdcp_patch)): ?>
                <div>
                    <span>有效的域名：</span>
                    <?php foreach ($wdcp_patch as $host): ?>
                        <span class="mr-3"><?= $host ?></span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<script>
    $(document).on("click", ".open-wdcp-patch", function () {
        $.myPrompt({
            content: "请输入您的域名，多个域名使用英文逗号分隔",
            confirm: function (val) {
                $.myLoading();
                $.ajax({
                    type: "post",
                    dataType: "json",
                    data: {
                        action: "wdcp-patch",
                        _csrf: _csrf,
                        status: "open",
                        hosts: val,
                    },
                    success: function (res) {
                        $.myAlert({
                            content: res.msg,
                            confirm: function () {
                                location.reload();
                            }
                        });
                    }
                });
            }
        });
    });
    $(document).on("click", ".close-wdcp-patch", function () {
        $.myConfirm({
            content: "确认关闭wdcp补丁？（可重新开启）",
            confirm: function (val) {
                $.myLoading();
                $.ajax({
                    type: "post",
                    data: {
                        action: "wdcp-patch",
                        _csrf: _csrf,
                        status: "close",
                    },
                    success: function (res) {
                        $.myAlert({
                            content: res.msg,
                            confirm: function () {
                                location.reload();
                            }
                        });
                    }
                });
            }
        });
    });
</script>