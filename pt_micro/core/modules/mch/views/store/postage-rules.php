<?php
defined('YII_RUN') or exit('Access Denied');
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/27
 * Time: 11:14
 */

$urlManager = Yii::$app->urlManager;
$this->title = '运费规则';
$this->params['active_nav_group'] = 1;
?>

<div class="main-nav" flex="cross:center dir:left box:first" style="display: none">
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
    <a href="<?= $urlManager->createUrl(['mch/store/postage-rules-edit']) ?>"
       class="btn btn-primary mb-3"><i class="iconfont icon-playlistadd"></i>添加规则</a>
    <table class="table table-bordered bg-white">
        <tr>
            <th>规则名称</th>
            <th hidden>快递公司</th>
            <th>是否默认</th>
            <th>操作</th>
        </tr>
        <?php foreach ($list as $item): ?>
            <tr>
                <td><?= $item->name ?></td>
                <td hidden><?= $item->express ? $item->express : '无' ?></td>
                <td>
                    <?php if ($item->is_enable == 0): ?>
                        <span class="badge badge-default">不是默认</span>
                        |
                        <a href="<?= $urlManager->createUrl(['mch/store/postage-rules-set-enable', 'id' => $item->id, 'type' => 1]) ?>">设置默认</a>
                    <?php else: ?>
                        <span class="badge badge-success">默认</span>
                        |
                        <a href="<?= $urlManager->createUrl(['mch/store/postage-rules-set-enable', 'id' => $item->id, 'type' => 0]) ?>">取消默认</a>
                    <?php endif; ?>
                </td>
                <td>
                    <a class="btn btn-sm btn-primary"
                       href="<?= $urlManager->createUrl(['mch/store/postage-rules-edit', 'id' => $item->id]) ?>">修改</a>
                    <a class="btn btn-sm btn-danger rules-del"
                       href="<?= $urlManager->createUrl(['mch/store/postage-rules-delete', 'id' => $item->id]) ?>">删除</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<script>
    $(document).on('click', '.rules-del', function () {
        var a = $(this);
        $.myConfirm({
            content: "是否删除该规则？",
            confirm: function () {
                $.myLoading({
                    content: "正在处理",
                });
                $.ajax({
                    url: a.attr("href"),
                    dataType: "json",
                    success: function (res) {
                        $.myLoadingHide();
                        $.myAlert({
                            content: res.msg,
                            confirm: function () {
                                if (res.code == 0) {
                                    location.reload();
                                }
                            }
                        });
                    }
                });
            }
        });
        return false;
    });
</script>