<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/19
 * Time: 16:14
 */
defined('YII_RUN') or exit('Access Denied');


use yii\widgets\LinkPager;

$urlManager = Yii::$app->urlManager;
$this->title = '优惠券管理';
$this->params['active_nav_group'] = 4;
$status = Yii::$app->request->get('status');
$user_id = Yii::$app->request->get('user_id');
$condition = ['user_id' => $user_id];
if ($status === '' || $status === null || $status == -1)
    $status = -1;
?>

<div class="main-nav" flex="cross:center dir:left box:first" style="display: none">
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
    <div class="float-left pt-2">
        <a class="mr-3 status-item <?= $status == -1 ? 'active' : null ?>"
           href="<?= $urlManager->createUrl(array_merge(['mch/user/coupon'], $condition)) ?>">全部</a>
        <a class="mr-3 status-item <?= $status == 0 ? 'active' : null ?>"
           href="<?= $urlManager->createUrl(array_merge(['mch/user/coupon'], $condition, ['status' => 0])) ?>">未使用<?= $data['status_0'] ? '(' . $data['status_0'] . ')' : null ?></a>
        <a class="mr-3 status-item <?= $status == 1 ? 'active' : null ?>"
           href="<?= $urlManager->createUrl(array_merge(['mch/user/coupon'], $condition, ['status' => 1])) ?>">已使用<?= $data['status_1'] ? '(' . $data['status_1'] . ')' : null ?></a>
        <a class="mr-3 status-item <?= $status == 2 ? 'active' : null ?>"
           href="<?= $urlManager->createUrl(array_merge(['mch/user/coupon'], $condition, ['status' => 2])) ?>">已过期<?= $data['status_2'] ? '(' . $data['status_2'] . ')' : null ?></a>
        <?php if ($user): ?>
            <span class="status-item mr-3">会员：<?= $user->nickname ?>的优惠券</span>
        <?php endif; ?>
    </div>
    <div class="float-right mb-4">
        <form method="get">

            <?php $_s = ['keyword'] ?>
            <?php foreach ($_GET as $_gi => $_gv):if (in_array($_gi, $_s)) continue; ?>
                <input type="hidden" name="<?= $_gi ?>" value="<?= $_gv ?>">
            <?php endforeach; ?>

            <div class="input-group">
                <input class="form-control"
                       placeholder="微信昵称"
                       name="keyword"
                       autocomplete="off"
                       value="<?= isset($_GET['keyword']) ? trim($_GET['keyword']) : null ?>">
                    <span class="input-group-btn">
                    <button class="btn btn-primary">搜索</button>
                </span>
            </div>
        </form>
    </div>
    <table class="table table-bordered bg-white">
        <thead>
        <tr>
            <th>昵称</th>
            <th>优惠券名称</th>
            <th>最低消费金额（元）</th>
            <th>优惠方式</th>
            <th>有效时间</th>
            <th>领取时间</th>
            <th>获取方式</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        </thead>
        <?php foreach ($list as $item): ?>
            <tr>
                <td><?= $item['nickname'] ?></td>
                <td><?= $item['name'] ?></td>
                <td><?= $item['min_price'] ?></td>
                <td>
                    <div>优惠：<?= $item['discount_type'] == 2 ? $item['sub_price'] . '元' : "--" ?></div>
                    <!--<div>折扣：<?= $item['discount_type'] == 1 ? $item['discount'] : "--" ?></div>-->
                </td>
                <td>
                    <?php if ($item['expire_type'] == 1): ?>
                        <span>领取<?= $item['expire_day'] ?>天过期</span>
                    <?php else: ?>
                        <span><?= date('Y-m-d', $item['begin_time']) ?>-<?= date('Y-m-d', $item['end_time']) ?></span>
                    <?php endif; ?>
                </td>
                <td><?= date('Y-m-d H:i', $item['uc_time']) ?></td>
                <td><?=$item['event_desc']?></td>
                <td><?= $item['is_expire'] == 0 ? ($item['is_use'] == 0 ? "未使用" : "已使用") : "已过期" ?></td>
                <td><a class="btn btn-sm btn-danger del" href="javascript:"
                    data-url="<?=$urlManager->createUrl(['mch/user/coupon-del','id'=>$item['uc_id']])?>" data-content="是否删除？">删除</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div class="text-center">
        <?= \yii\widgets\LinkPager::widget(['pagination' => $pagination,]) ?>
        <div class="text-muted"><?= $row_count ?>条数据</div>
    </div>
</div>
<script>
    $(document).on('click', '.del', function () {
        var a = $(this);
        $.myConfirm({
            content: a.data('content'),
            confirm: function () {
                $.ajax({
                    url: a.data('url'),
                    type: 'get',
                    dataType: 'json',
                    success: function (res) {
                        if (res.code == 0) {
                            window.location.reload();
                        } else {
                            $.myAlert({
                                title:'提示',
                                content: res.msg
                            });
                        }
                    }
                });
            }
        });
        return false;
    });
</script>

