<?php
defined('YII_RUN') or exit('Access Denied');
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/6/19
 * Time: 16:52
 */
$cat = [
    1 => '关于我们',
    2 => '服务中心',
];
$cat_id = Yii::$app->request->get('cat_id', 2);
$urlManager = Yii::$app->urlManager;
$this->title = '系统文章 - ' . $cat[$cat_id];
$this->params['active_nav_group'] = 6;
?>

<div class="main-nav" flex="cross:center dir:left box:first">
    <div>
        <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
            <a flex="cross:center" class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store']) ?>">我的商城</a>
            <span flex="cross:center" class="breadcrumb-item active"><?= $this->title ?></span>
        </nav>
    </div>
    <div>
        <?= $this->render('/layouts/nav-right') ?>
    </div>
</div>

<div class="main-body p-3">
    <?php if ($cat_id != 1): ?>
        <a href="<?= $urlManager->createAbsoluteUrl(['mch/article/edit', 'cat_id' => 2]) ?>"
           class="btn btn-primary mb-3"><i class="iconfont icon-playlistadd"></i>添加文章</a>
    <?php endif; ?>
    <table class="table table-bordered bg-white">
        <thead>
        <tr>
            <th>ID</th>
            <th>类别</th>
            <th>标题</th>
            <th>排序</th>
            <th>操作</th>
        </tr>
        </thead>
        <?php foreach ($list as $item): ?>
            <tr>
                <td><?= $item->id ?></td>
                <td><?= $cat[$item->article_cat_id] ?></td>
                <td><?= $item->title ?></td>
                <td><?= $item->sort ?></td>
                <td>
                    <a class="btn btn-sm btn-primary"
                       href="<?= $urlManager->createUrl(['mch/article/edit', 'cat_id' => $item->article_cat_id, 'id' => $item->id]) ?>">编辑</a>
                    <?php if ($cat_id != 1): ?>
                        <a class="btn btn-sm btn-primary copy"
                           data-clipboard-text="/pages/article-detail/article-detail?id=<?=$item->id?>"
                           href="javascript:" hidden>复制链接</a>
                        <a class="btn btn-sm btn-danger article-delete"
                           href="<?= $urlManager->createUrl(['mch/article/delete', 'id' => $item->id]) ?>">删除</a>
                    <?php else: ?>
                        <a class="btn btn-sm btn-primary copy"
                           data-clipboard-text="/pages/article-detail/article-detail?id=about_us"
                           href="javascript:" hidden>复制链接</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<script>
    $(document).on("click", ".article-delete", function () {
        var href = $(this).attr("href");
        $.myConfirm({
            content: "确认删除？",
            confirm: function () {
                $.myLoading();
                $.ajax({
                    url: href,
                    dataType: "json",
                    success: function (res) {
                        location.reload();
                    }
                });
            }
        });
        return false;
    });
</script>
<script>
    $(document).ready(function () {
        var clipboard = new Clipboard('.copy');
        clipboard.on('success', function (e) {
            $.myAlert({
                title: '提示',
                content: '复制成功'
            });
        });
        clipboard.on('error', function (e) {
            $.myAlert({
                title: '提示',
                content: '复制失败，请手动复制。链接为：' + e.text
            });
        });
    })
</script>