<?php
defined('YII_RUN') or exit('Access Denied');
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/6/19
 * Time: 16:52
 */
$urlManager = Yii::$app->urlManager;
$this->title = '秒杀';
$this->params['active_nav_group'] = 10;
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

<div class="main-body p-3">

    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $urlManager->createUrl(['mch/miaosha/index']) ?>">秒杀设置</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?= $urlManager->createUrl(['mch/miaosha/goods']) ?>">秒杀商品</a>
                </li>
            </ul>
        </div>
        <div class="card-block">

            <div class="mb-3 clearfix">
                <div class="btn-group mr-5" role="group" aria-label="Basic example">
                    <a href="<?= $urlManager->createUrl(['mch/miaosha/goods']) ?>" class="btn btn-primary">按商品查看</a>
                    <a href="<?= $urlManager->createUrl(['mch/miaosha/calendar']) ?>"
                       class="btn btn-outline-primary">按日历查看</a>
                </div>
                <a class="btn btn-primary"
                   href="<?= $urlManager->createUrl(['mch/miaosha/goods-edit']) ?>">添加秒杀商品</a>
            </div>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>商品ID</th>
                    <th>商品</th>
                    <th>开放次数</th>
                    <th>操作</th>
                </tr>
                </thead>
                <?php if (!$list || count($list) == 0): ?>
                    <tr>
                        <td colspan="4" class="text-center p-5">
                            <a href="<?= $urlManager->createUrl(['mch/miaosha/goods-edit']) ?>">添加秒杀商品</a>
                        </td>
                    </tr>
                <?php else: foreach ($list as $item): ?>
                    <tr>
                        <td><?= $item['goods_id'] ?></td>
                        <td>
                            <a href="<?= $urlManager->createUrl(['mch/miaosha/goods-detail', 'goods_id' => $item['goods_id']]) ?>"><?= $item['name'] ?></a>
                        </td>
                        <td>
                            <a href="<?= $urlManager->createUrl(['mch/miaosha/goods-detail', 'goods_id' => $item['goods_id']]) ?>"><?= $item['miaosha_count'] ?>
                                次</a>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-danger delete-btn"
                               href="<?= $urlManager->createUrl(['mch/miaosha/goods-delete', 'goods_id' => $item['goods_id']]) ?>">删除</a>
                        </td>
                    </tr>
                <?php endforeach; endif; ?>
            </table>


        </div>
    </div>

</div>
<script>
    $(document).on("click", ".delete-btn", function () {
        var url = $(this).attr("href");
        $.myConfirm({
            content: "确认删除？删除后该商品的所有秒杀设置将全部删除！",
            confirm: function () {
                $.myLoading({
                    title: "正在处理",
                });
                $.ajax({
                    url: url,
                    type: "get",
                    dataType: "json",
                    success: function (res) {
                        $.myLoadingHide();
                        $.myToast({
                            content: res.msg,
                            callback: function () {
                                if (res.code == 0)
                                    location.reload();
                            },
                        });
                    }
                });
            }
        });
        return false;
    });
</script>
