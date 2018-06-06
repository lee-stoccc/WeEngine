<?php
defined('YII_RUN') or exit('Access Denied');
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/27
 * Time: 11:36
 */

$urlManager = Yii::$app->urlManager;
$this->title = '导航图标编辑';
$this->params['active_nav_group'] = 1;
?>
<div class="main-nav" flex="cross:center dir:left box:first" style="display: none">
    <div>
        <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/index']) ?>">我的商城</a>
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/home-nav']) ?>">导航图标</a>
            <span class="breadcrumb-item active"><?= $this->title ?></span>
        </nav>
    </div>
    <div>
        <?= $this->render('/layouts/nav-right') ?>
    </div>
</div>

<div class="main-body p-3">
    <form class="form auto-submit-form" method="post" autocomplete="off"
          data-return="<?= $urlManager->createUrl(['mch/store/home-nav']) ?>">
        <div class="form-title">导航图标编辑</div>
        <div class="form-body">

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class="col-form-label required">名称</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="text" name="model[name]" value="<?= $model['name'] ?>">
                </div>
            </div>


            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required">排序</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="number" name="model[sort]"
                           value="<?= $model['sort'] ? $model['sort'] : 100 ?>">
                </div>
            </div>


            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required">图标</label>
                </div>
                <div class="col-9">
                    <?= \app\widgets\ImageUpload::widget([
                        'name' => 'model[pic_url]',
                        'value' => $model['pic_url'],
                        'width' => 88,
                        'height' => 88,
                    ]) ?>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">图标链接</label>
                </div>
                <div class="col-9">
                    <div class="input-group page-link-input">
                        <input class="form-control link-input"
                               name="model[url]"
                               value="<?= $model['url'] ?>">
                        <input class="link-open-type" name="model[open_type]" value="<?= $model['open_type'] ?>"
                               type="hidden">
                        <span class="input-group-btn">
                            <a class="btn btn-secondary pick-link-btn" href="javascript:">选择链接</a>
                        </span>
                    </div>
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