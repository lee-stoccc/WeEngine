<?php
defined('YII_RUN') or exit('Access Denied');
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/27
 * Time: 11:14
 */
use yii\widgets\LinkPager;

$urlManager = Yii::$app->urlManager;
$this->title = '首页导航';
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
    <a href="<?= $urlManager->createUrl(['mch/store/home-nav-edit']) ?>" class="btn btn-primary mb-3">
        <i class="iconfont icon-playlistadd"></i>添加图标</a>
    <table class="table table-bordered bg-white">
        <thead>
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>图标</th>
            <th>页面</th>
            <th>排序</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($list as $index => $item): ?>
            <tr>
                <td><?= $item['id'] ?></td>
                <td><?= $item['name'] ?></td>
                <td><img src="<?= $item['pic_url'] ?>"
                         style="width: 20px;height: 20px;"></td>
                <td><?= $item['url']; ?></td>
                <td><?= $item['sort']; ?></td>
                <td>
                    <a class="btn btn-sm btn-primary"
                       href="<?= $urlManager->createUrl(['mch/store/home-nav-edit', 'id' => $item['id']]) ?>">修改</a>
                    <a class="btn btn-sm btn-danger nav-del"
                       href="<?= $urlManager->createUrl(['mch/store/home-nav-del', 'id' => $item['id']]) ?>">删除</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>

    </table>
</div>

<script>
    $(document).on('click', '.nav-del', function () {
        var a = $(this);
        $.myConfirm({
            content: "是否删除该图标？",
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