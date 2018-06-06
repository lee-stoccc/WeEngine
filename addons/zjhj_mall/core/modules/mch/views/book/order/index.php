<?php
defined('YII_RUN') or exit('Access Denied');

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/29
 * Time: 9:50
 */

use yii\widgets\LinkPager;

/* @var \app\models\User $user */

$urlManager = Yii::$app->urlManager;
$statics = Yii::$app->request->baseUrl . '/statics';
$this->title = '预约订单列表';
$this->params['active_nav_group'] = 10;
$this->params['is_book'] = 1;
$status = Yii::$app->request->get('status');
$is_offline = Yii::$app->request->get('is_offline');
$user_id = Yii::$app->request->get('user_id');
$condition = ['user_id' => $user_id, 'is_offline' => $is_offline, 'clerk_id' => $_GET['clerk_id'], 'shop_id' => $_GET['shop_id']];
if ($status === '' || $status === null || $status == -1)
    $status = -1;
?>
<style>
    .order-item {
        border: 1px solid transparent;
        margin-bottom: 1rem;
    }

    .order-item table {
        margin: 0;
    }

    .order-item:hover {
        border: 1px solid #3c8ee5;
    }

    .goods-item {
        margin-bottom: .75rem;
    }

    .goods-item:last-child {
        margin-bottom: 0;
    }

    .goods-pic {
        width: 5.5rem;
        height: 5.5rem;
        display: inline-block;
        background-color: #ddd;
        background-size: cover;
        background-position: center;
        margin-right: 1rem;
    }

    .goods-name {
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }

    .order-tab-1 {
        width: 40%;
    }

    .order-tab-2 {
        width: 20%;
        text-align: center;
    }

    .order-tab-3 {
        width: 10%;
        text-align: center;
    }

    .order-tab-4 {
        width: 20%;
        text-align: center;
    }

    .order-tab-5 {
        width: 10%;
        text-align: center;
    }

    .status-item.active {
        color: inherit;
    }
</style>
<script language="JavaScript" src="<?= $statics ?>/mch/js/LodopFuncs.js"></script>
<object id="LODOP_OB" classid="clsid:2105C259-1E0C-4534-8141-A753534CB4CA" width=0 height=0>
    <embed id="LODOP_EM" type="application/x-print-lodop" width=0 height=0></embed>
</object>
<div class="main-nav" flex="cross:center dir:left box:first">
    <div>
        <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/index']) ?>">我的商城</a>
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/book/index/index']) ?>">预约</a>
            <span class="breadcrumb-item active"><?= $this->title ?></span>
        </nav>
    </div>
    <div>
        <?= $this->render('/layouts/nav-right') ?>
    </div>
</div>

<div class="main-body p-3">
    <div class="mb-3 clearfix">
        <div class="float-left pt-2">
            <a class="mr-3 status-item <?= $status == -1 ? 'active' : null ?>"
               href="<?= $urlManager->createUrl(array_merge(['mch/book/order/index'])) ?>">全部</a>

            <a class="mr-3 status-item <?= $status == 0 ? 'active' : null ?>"
               href="<?= $urlManager->createUrl(array_merge(['mch/book/order/index'], $condition, ['status' => 0])) ?>">待付款<?= $store_data['status_count']['status_0'] ? '(' . $store_data['status_count']['status_0'] . ')' : null ?></a>
            <a class="mr-3 status-item <?= $status == 1 ? 'active' : null ?>"
               href="<?= $urlManager->createUrl(array_merge(['mch/book/order/index'], $condition, ['status' => 1])) ?>">待使用<?= $store_data['status_count']['status_1'] ? '(' . $store_data['status_count']['status_1'] . ')' : null ?></a>
            <a class="mr-3 status-item <?= $status == 2 ? 'active' : null ?>"
               href="<?= $urlManager->createUrl(array_merge(['mch/book/order/index'], $condition, ['status' => 2])) ?>">已使用<?= $store_data['status_count']['status_2'] ? '(' . $store_data['status_count']['status_2'] . ')' : null ?></a>
            <a class="mr-3 status-item <?= $status == 3 ? 'active' : null ?>"
               href="<?= $urlManager->createUrl(array_merge(['mch/book/order/index'], $condition, ['status' => 3])) ?>">退款<?= $store_data['status_count']['status_6'] ? '(' . $store_data['status_count']['status_6'] . ')' : null ?></a>
            <a class="mr-3 status-item <?= $status == 5 ? 'active' : null ?>"
               href="<?= $urlManager->createUrl(array_merge(['mch/book/order/index'], $condition, ['status' => 5])) ?>">已取消<?= $store_data['status_count']['status_5'] ? '(' . $store_data['status_count']['status_5'] . ')' : null ?></a>

        </div>


        <div class="float-right">
            <form method="get">

                <?php $_s = ['keyword'] ?>
                <?php foreach ($_GET as $_gi => $_gv):if (in_array($_gi, $_s)) continue; ?>
                    <input type="hidden" name="<?= $_gi ?>" value="<?= $_gv ?>">
                <?php endforeach; ?>

                <div class="input-group">
                    <input class="form-control"
                           placeholder="订单号/用户/收货人"
                           name="keyword"
                           autocomplete="off"
                           value="<?= isset($_GET['keyword']) ? trim($_GET['keyword']) : null ?>">
                    <span class="input-group-btn">
                    <button class="btn btn-primary">搜索</button>
                </span>
                </div>
            </form>
        </div>
    </div>
    <table class="table table-bordered bg-white">
        <tr>
            <th class="order-tab-1">商品信息</th>
            <th class="order-tab-2">金额</th>
            <th class="order-tab-3">实际付款</th>
            <th class="order-tab-4">订单状态</th>
            <th class="order-tab-5">操作</th>
        </tr>
    </table>
    <?php foreach ($list as $order_item): ?>
        <div class="order-item">
            <table class="table table-bordered bg-white">
                <tr>
                    <td colspan="5">
                        <span class="mr-5"><?= date('Y-m-d H:i:s', $order_item['addtime']) ?></span>
                        <span class="mr-5">订单号：<?= $order_item['order_no'] ?></span>
                        <span>用户：<?= $order_item['nickname'] ?></span>
                    </td>
                </tr>
                <tr>
                    <td class="order-tab-1">
                        <div class="goods-item" flex="dir:left box:first">
                            <div class="fs-0">
                                <div class="goods-pic"
                                     style="background-image: url('<?= $order_item['cover_pic'] ?>')"></div>
                            </div>
                            <div class="goods-info">
                                <div class="goods-name"><?= $order_item['goods_name'] ?></div>
                                <div class="fs-sm">小计：
                                    <span class="text-danger"><?= $order_item['total_price'] ?>元</span></div>
                            </div>
                        </div>
                    </td>
                    <td class="order-tab-2">
                        <?php foreach ($order_item['orderFrom'] AS $k => $v): ?>
                            <div><?= $v->key ?>：<?= $v->value ?></div>
                        <?php endforeach; ?>

                    </td>
                    <td class="order-tab-3">
                        <div><?= $order_item['pay_price'] ?>元</div>
                    </td>
                    <td class="order-tab-4">
                        <div>
                            付款状态：
                            <?php if ($order_item['is_pay'] == 1): ?>
                                <span class="badge badge-success">已付款</span>
                            <?php else: ?>
                                <span class="badge badge-default">未付款</span>
                                <?php if ($order_item['is_cancel']==1): ?>
                                    <span class="badge badge-warning">已取消</span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <?php if ($order_item['is_pay'] == 1): ?>
                            <div>
                                发货状态：
                                <?php if ($order_item['is_use'] == 1): ?>
                                    <span class="badge badge-success">已使用</span>
                                <?php else: ?>
                                    <span class="badge badge-default">未使用</span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($order_item['apply_delete'] == 1): ?>
                            <div>
                                退款状态：
                                <?php if ($order_item['is_refund']==1):?>
                                    <span class="badge badge-danger">已退款</span>
                                <?php else: ?>
                                    <span class="badge badge-warning">申请退款中</span>
                                <?php endif; ?>

                            </div>
                        <?php endif; ?>
                    </td>
                    <td class="order-tab-5">
                        <?php if ($order_item['is_pay'] == 1 && $order_item['is_refund']==0&& $order_item['apply_delete'] == 1): ?>
                            <a class="btn btn-sm btn-primary send-confirm-btn" href="javascript:"
                               data-order-id="<?= $order_item['id'] ?>">
                                退款
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </div>
    <?php endforeach; ?>
    <div class="text-center">
        <?= LinkPager::widget(['pagination' => $pagination,]) ?>
        <div class="text-muted"><?= $row_count ?>条数据</div>
    </div>

</div>
</div>

<script>
    $(document).on("click", ".apply-status-btn", function () {
        var url = $(this).attr("href");
        $.myConfirm({
            content: "确认“" + $(this).text() + "”？",
            confirm: function () {
                $.myLoading();
                $.ajax({
                    url: url,
                    dataType: "json",
                    success: function (res) {
                        $.myLoadingHide();
                        $.myAlert({
                            content: res.msg,
                            confirm: function () {
                                if (res.code == 0)
                                    location.reload();
                            }
                        });
                    }
                });
            }
        });
        return false;
    });


//    $(document).on("click", ".send-btn", function () {
//        var order_id = $(this).attr("data-order-id");
//        $(".send-modal input[name=order_id]").val(order_id);
//        $(".send-modal").modal("show");
//    });
    $(document).on("click", ".send-confirm-btn", function () {

        var order_id = $(this).attr("data-order-id");
        var btn = $(this);
        var error = $(".send-form").find(".form-error");
        btn.btnLoading("正在提交");
        error.hide();
        console.log(error);
        $.ajax({
            url: "<?=$urlManager->createUrl(['mch/book/order/refund'])?>",
            type: "get",
            data: {order_id:order_id},
            dataType: "json",
            success: function (res) {
                if (res.code == 0) {
                    btn.text(res.msg);
                    location.reload();
                    $(".send-modal").modal("hide");
                }
                if (res.code == 1) {
                    btn.btnReset();
                    error.html(res.msg).show();
                }
            }
        });
    });


</script>
