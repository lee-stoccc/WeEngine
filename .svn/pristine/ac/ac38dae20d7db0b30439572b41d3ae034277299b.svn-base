<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/1
 * Time: 10:19
 */
defined('YII_RUN') or exit('Access Denied');

use yii\widgets\LinkPager;

/* @var \app\models\Coupon[] $list */

$urlManager = Yii::$app->urlManager;
$this->title = '打印机管理';
$this->params['active_nav_group'] = 13;
$type = [
    'kdt2'=>'365云打印(编号kdt1) ',
    'yilianyun-k4'=>'易联云-k4'
];
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
    <a class="btn btn-primary mb-3" href="<?= $urlManager->createUrl(['mch/printer/edit']) ?>">添加打印机</a>
    <table class="table table-bordered bg-white">
        <thead>
        <tr>
            <td><span>打印机名称</span></td>
            <td>打印机品牌</td>
            <td>操作</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach($list as $index=>$value):?>
            <tr>
                <td><span><?=$value['name']?></span></td>
                <td><?=$type[$value['printer_type']]?></td>
                <td>
                    <a class="btn btn-sm btn-primary" href="<?=$urlManager->createUrl(['mch/printer/edit','id'=>$value['id']])?>">编辑</a>
                    <a class="btn btn-sm btn-danger del" href="javascript:" data-content="是否删除？"
                       data-url="<?=$urlManager->createUrl(['mch/printer/printer-del','id'=>$value['id']])?>">删除</a>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
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
                                title: res.msg
                            });
                        }
                    }
                });
            }
        });
        return false;
    });
</script>
