<?php
defined('YII_RUN') or exit('Access Denied');
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/27
 * Time: 11:36
 */

$urlManager = Yii::$app->urlManager;
$this->title = '预约设置';
$this->params['active_nav_group'] = 10;
$this->params['is_book'] = 1;
?>
<div class="main-nav" flex="cross:center dir:left box:first" style="display: none">
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
    <form class="form auto-submit-form" method="post" autocomplete="off"
          data-return="<?= $urlManager->createUrl(['mch/book/index/setting']) ?>">
        <div class="form-title">预约基础设置</div>
        <div class="form-body">
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">是否显示分类</label>
                </div>
                <div class="col-9 col-form-label">
                    <label class="custom-control custom-radio">
                        <input <?= $setting['cat'] == 1 ? 'checked' : 'checked' ?> value="1"
                                                                                     name="model[cat]"
                                                                                     type="radio"
                                                                                     class="custom-control-input">
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">显示</span>
                    </label>
                    <label class="custom-control custom-radio">
                        <input <?= $setting['cat'] == 0 ? 'checked' : null ?> value="0"
                                                                                name="model[cat]"
                                                                                type="radio"
                                                                                class="custom-control-input">
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">不显示</span>
                    </label>
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
