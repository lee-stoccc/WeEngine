<?php
defined('YII_RUN') or exit('Access Denied');
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/27
 * Time: 11:36
 */

$urlManager = Yii::$app->urlManager;
$this->title = '分类编辑';
$this->params['active_nav_group'] = 1;
?>
<div class="main-nav" flex="cross:center dir:left box:first">
    <div>
        <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/index']) ?>">我的商城</a>
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/cat']) ?>">商品分类</a>
            <span class="breadcrumb-item active"><?= $this->title ?></span>
        </nav>
    </div>
    <div>
        <?= $this->render('/layouts/nav-right') ?>
    </div>
</div>

<div class="main-body p-3">
    <form class="form auto-submit-form" method="post" autocomplete="off"
          data-return="<?= $urlManager->createUrl(['mch/store/cat']) ?>">
        <div class="form-title">分类编辑</div>
        <div class="form-body">
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">父级分类</label>
                </div>
                <div class="col-9">
                    <select class="form-control parent" name="model[parent_id]">
                        <option value="0">无</option>
                        <?php foreach ($parent_list as $cat): ?>
                            <option value="<?= $cat->id ?>" <?= $cat->id == $list['parent_id'] ? 'selected' : '' ?>><?= $cat->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>


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
                <div class="col-3 text-right">
                    <label class=" col-form-label">分类大图（显示在分类页面）</label>
                </div>
                <div class="col-9">
                    <?= \app\widgets\ImageUpload::widget([
                        'name' => 'model[big_pic_url]',
                        'value' => $list['big_pic_url'],
                        'width' => 702,
                        'height' => 212,
                    ]) ?>
                </div>
            </div>

            <div class="advert" <?= empty($list['parent_id']) ?'':'style="display:none"'?>>
                <div class="form-group row">
                    <div class="col-3 text-right">
                        <label class=" col-form-label">分类广告</label>
                    </div>
                    <div class="col-9">
                        <?= \app\widgets\ImageUpload::widget([
                            'name' => 'model[advert_pic]',
                            'value' => $list['advert_pic'],
                            'width' => 500,
                            'height' => 184,
                        ]) ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-3 text-right">
                        <label class=" col-form-label">分类广告链接</label>
                    </div>
                    <div class="col-9">
                        <div class="input-group page-link-input">
                            <input class="form-control link-input advert_url"
                                   name="model[advert_url]"
                                   value="<?= $list['advert_url'] ?>">
                            <span class="input-group-btn">
                            <a class="btn btn-secondary pick-link-btn" href="javascript:" open-type="navigate">选择链接</a>
                        </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">是否显示</label>
                </div>
                <div class="col-9">
                    <div class="pt-1">
                        <label class="custom-control custom-radio">
                            <input id="radio1" <?= $list['is_show'] == 1 ? 'checked' : 'checked' ?>
                                   value="1"
                                   name="model[is_show]" type="radio" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">显示</span>
                        </label>
                        <label class="custom-control custom-radio">
                            <input id="radio2" <?= $list['is_show'] == 2 ? 'checked' : null ?>
                                   value="2"
                                   name="model[is_show]" type="radio" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">隐藏</span>
                        </label>
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
<script>
    $(document).on('change','.parent',function () {
        var p = $(this).val();
        if (p == '0'){
            $('.advert').fadeIn();
        }else {
            $('input[name="model[advert_url]"]').val('');
            $('input[name="model[advert_pic]"]').val('');
            $('input[name="model[advert_pic]"]').next('.image-picker-view').css('background-image','url("")');
            $('.advert').fadeOut();
        }
    })
</script>