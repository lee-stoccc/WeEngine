<?php
defined('YII_RUN') or exit('Access Denied');
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/6/19
 * Time: 16:52
 */
$urlManager = Yii::$app->urlManager;
$this->title = '专题';
$this->params['active_nav_group'] = 8;
?>
<style>
    .cover-pic {
        display: block;
        width: 8rem;
        height: 5rem;
        background-size: cover;
        background-position: center;
    }
</style>
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
    <a class="btn btn-primary mb-3" href="<?= $urlManager->createUrl(['mch/topic/edit']) ?>">添加专题</a>

    <table class="table table-bordered bg-white">
        <thead>
        <tr>
            <th>ID</th>
            <th>封面图</th>
            <th>专题</th>
            <th class="text-center">排序</th>
            <th class="text-center">布局方式</th>
            <th class="text-center">操作</th>
        </tr>
        </thead>
        <?php foreach ($list as $item): ?>
            <tr>
                <td><?= $item->id ?></td>
                <td>
                    <div class="cover-pic" style="background-image: url('<?= $item->cover_pic ?>')"></div>
                </td>
                <td>
                    <div style="max-width: 40rem">
                        <div class="mb-2 text-overflow-ellipsis"><?= $item->title ?></div>
                        <div class="text-muted fs-sm mb-2 text-overflow-ellipsis"><?= $item->sub_title ?></div>
                        <div class="text-muted fs-sm"><?= date('Y-m-d H:i:s', $item->addtime) ?></div>
                    </div>
                </td>
                <td class="text-center"><?= $item->sort ?></td>
                <td class="text-center"><?= $item->layout == 0 ? '小图模式' : '大图模式' ?></td>
                <td class="text-center">
                    <div class="mb-2">
                        <a class="btn btn-sm btn-primary"
                           href="<?= $urlManager->createUrl(['mch/topic/edit', 'id' => $item->id]) ?>">编辑</a>
                    </div>
                    <div>
                        <a class="btn btn-sm btn-danger delete-btn"
                           href="<?= $urlManager->createUrl(['mch/topic/delete', 'id' => $item->id]) ?>">删除</a>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
    <div class="text-center">
        <?= \yii\widgets\LinkPager::widget(['pagination' => $pagination,]) ?>
        <div class="text-muted"><?= $pagination->totalCount ?>条数据</div>
    </div>
</div>
<script>
    $(document).on("click", ".delete-btn", function () {
        var url = $(this).attr("href");
        $.myConfirm({
            content: "确认删除？",
            confirm: function () {
                $.myLoading();
                $.ajax({
                    url: url,
                    dataType: "json",
                    success: function (res) {
                        $.myLoadingHide();
                        $.myToast({
                            content: res.msg,
                        });
                        if (res.code == 0) {
                            location.reload();
                        }
                    }
                });
            }
        });
        return false;
    });
</script>