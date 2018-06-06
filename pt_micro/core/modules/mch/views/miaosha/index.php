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

    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="<?= $urlManager->createUrl(['mch/miaosha/index']) ?>">秒杀设置</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $urlManager->createUrl(['mch/miaosha/goods']) ?>">秒杀商品设置</a>
                </li>
            </ul>
        </div>
        <div class="card-block">

            <form class="auto-submit-form" method="post" autocomplete="off">
                <div class="form-group row">
                    <div class="col-md-2 text-right">
                        <label class="col-form-label">提示</label>
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-info">
                            <div>注：设置了开放时间，小程序端才有相关秒杀时间点出现</div>
                            <div>注：秒杀入口可以在
                                <a target="_blank" href="<?= $urlManager->createUrl(['mch/store/home-nav']) ?>">导航图标</a>、
                                <a target="_blank"
                                   href="<?= $urlManager->createUrl(['mch/store/home-block']) ?>">自定义版块</a>、
                                <a target="_blank" href="<?= $urlManager->createUrl(['mch/store/slide']) ?>">轮播图</a>设置。
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-2 text-right">
                        <label class="col-form-label">开放时间</label>
                    </div>
                    <div class="col-md-6" style="padding-top: calc(.5rem - 1px * 2)">
                        <?php $model->open_time = json_decode($model->open_time, true); ?>
                        <?php for ($i = 0; $i < 24; $i++): ?>
                            <label class="custom-control custom-checkbox">
                                <input name="open_time[]"<?= is_array($model->open_time) && in_array($i, $model->open_time) ? 'checked' : null ?>
                                       value="<?= $i ?>"
                                       type="checkbox" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description"><?= $i < 10 ? '0' . $i : $i ?>
                                    :00~<?= $i < 10 ? '0' . $i : $i ?>:59</span>
                            </label>
                        <?php endfor; ?>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 offset-md-2">
                        <div class="text-danger form-error mb-3" style="display: none">错误信息</div>
                        <div class="text-success form-success mb-3" style="display: none">成功信息</div>
                        <a class="btn btn-primary submit-btn" href="javascript:">保存</a>
                    </div>
                </div>
            </form>

        </div>
    </div>


</div>
