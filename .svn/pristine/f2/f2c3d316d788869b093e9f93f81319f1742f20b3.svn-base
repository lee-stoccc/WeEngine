<?php
defined('YII_RUN') or exit('Access Denied');
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/8
 * Time: 14:57
 */
/* @var $pagination yii\data\Pagination */
/* @var $setting \app\models\Setting */
use yii\widgets\LinkPager;

$urlManager = Yii::$app->urlManager;
$this->title = '充值记录';
$this->params['active_nav_group'] = 4;
$status = Yii::$app->request->get('status');
if ($status === '' || $status === null || $status == -1)
    $status = -1;
?>
<style>
    .status-item.active {
        color: inherit;
    }
</style>
<div class="main-nav" flex="cross:center dir:left box:first">
    <div>
        <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/index']) ?>">我的商城</a>
            <a class="breadcrumb-item" href="javascript:;" onclick="javascript:history.back(-1);">用户列表</a>
            <span class="breadcrumb-item active"><?= $this->title ?></span>
        </nav>
    </div>
    <div>
        <?= $this->render('/layouts/nav-right') ?>
    </div>
</div>
<div class="main-body p-3" id="app">
<!--    <div class="mb-3 clearfix">

        <div class="float-right">
            <form method="get">

                <?php /*$_s = ['keyword'] */?>
                <?php /*foreach ($_GET as $_gi => $_gv):if (in_array($_gi, $_s)) continue; */?>
                    <input type="hidden" name="<?/*= $_gi */?>" value="<?/*= $_gv */?>">
                <?php /*endforeach; */?>

                <div class="input-group">
                    <input class="form-control"
                           placeholder="姓名/微信昵称"
                           name="keyword"
                           autocomplete="off"
                           value="<?/*= isset($_GET['keyword']) ? trim($_GET['keyword']) : null */?>">
                    <span class="input-group-btn">
                    <button class="btn btn-primary">搜索</button>
                </span>
                </div>
            </form>
        </div>

    </div>-->
    <table class="table table-bordered bg-white">
        <tr>
            <td width="50px">ID</td>
            <td width="200px">微信昵称</td>
            <td>
                充值积分
            </td>
            <td>下级分销商</td>
            <td>充值时间</td>
            <td>说明</td>
        </tr>
        <?php foreach ($list as $index => $value): ?>
            <tr>
                <td><?= $value['id'] ?></td>
                <td><?= $value['operator'] ?></td>
                <td>
                    <?= $value['integral'] ?>
                </td>
                <td>
                    <?= $value['username'] ?>
                </td>
                <td><?= date('Y-m-d H:i', $value['addtime']); ?></td>
                <td><?= $value['content'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div class="text-center">
        <nav aria-label="Page navigation example">
            <?=\yii\widgets\LinkPager::widget([
                'pagination'=>$pagination,
                'nextPageLabel' => '下一页',
                'prevPageLabel' => '上一页',
                'firstPageLabel' => '首页',
                'lastPageLabel' => '尾页',
            ])?>
        </nav>
    </div>
</div>
