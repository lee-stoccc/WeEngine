<?php
defined('YII_RUN') or exit('Access Denied');
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/27
 * Time: 11:36
 */

$urlManager = Yii::$app->urlManager;
$this->title = '预约产品分类';
$this->params['active_nav_group'] = 10;
$this->params['is_book'] = 1;
?>
<div class="main-nav" flex="cross:center dir:left box:first">
    <div>
        <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/index']) ?>">我的商城</a>
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/book/index/index']) ?>">预约</a>
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/book/goods/cat']) ?>">商品分类</a>
            <span class="breadcrumb-item active"><?= $this->title ?></span>
        </nav>
    </div>
    <div>
        <?= $this->render('/layouts/nav-right') ?>
    </div>
</div>

<div class="main-body p-3">
    <form class="form auto-submit-form" method="post" autocomplete="off"
          data-return="<?= $urlManager->createUrl(['mch/book/goods/cat']) ?>">
        <div class="form-title">分类编辑</div>
        <div class="form-body">
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required">分类名称</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="text" name="model[name]" value="<?= $list['name'] ?>">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required">排序</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="number" name="model[sort]"
                           value="<?= $list['sort'] ? $list['sort'] : 100 ?>">
                </div>
            </div>


            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">分类图标</label>
                </div>
                <div class="col-9">
                    <?= \app\widgets\ImageUpload::widget([
                        'name' => 'model[pic_url]',
                        'value' => $list['pic_url'],
                        'width' => 200,
                        'height' => 200,
                    ]) ?>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-9 offset-sm-3">
                    <div class="text-danger form-error mb-3" style="display: none">错误信息</div>
                    <div class="text-success form-success mb-3" style="display: none">成功信息</div>
                    <a class="btn btn-primary submit-btn" href="javascript:">保存</a>
                </div>
            </div>
        </div>
    </form>

</div>
