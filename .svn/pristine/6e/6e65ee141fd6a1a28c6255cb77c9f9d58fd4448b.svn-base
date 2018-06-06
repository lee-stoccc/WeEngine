<?php
defined('YII_RUN') or exit('Access Denied');
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/6/19
 * Time: 16:52
 */
$urlManager = Yii::$app->urlManager;
$this->title = '用户中心';
$this->params['active_nav_group'] = 1;
?>
<style>
    .menu-header > div,
    .menu-item > div {
        width: 33.333333%;
    }

    .menu-item {
        background: #fff;
        margin: .5rem 0;
    }

    .menu-item > div {
        padding: .5rem .75rem;
    }

    .menu-item .drop-btn {
        display: inline-block;
        padding: .25rem;
    }

    .menu-item .drop-btn .iconfont {
        font-size: .75rem;
        color: #666;
        font-weight: bold;
        text-decoration: none;
    }

    .menu-item .drop-btn .iconfont:hover {
        font-size: .75rem;
        color: #333;
        font-weight: bold;
        text-decoration: none;
        cursor: move;
    }
</style>
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
    <form class="card auto-submit-form" method="post" autocomplete="off">
        <div class="card-header">用户中心设置</div>
        <div class="card-block">


            <div class="form-group row">
                <div class="col-sm-2 text-right">
                    <label class="col-form-label">顶部背景图设置</label>
                </div>
                <div class="col-sm-6">
                    <?php
                    echo \app\widgets\ImageUpload::widget([
                        'name' => 'user_center_bg',
                        'value' => $user_center_bg,
                        'width' => 750,
                        'height' => 268,
                    ]);
                    ?>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-2 text-right">
                    <label class="col-form-label">菜单设置</label>
                </div>
                <div class="col-sm-6">
                    <div style="background: #f6f8f9;padding: 1rem">
                        <div flex="dir:left" class="menu-header mb-2">
                            <div>菜单名称</div>
                            <div class="text-right">是否显示</div>
                            <div class="text-right">拖动排序</div>
                        </div>
                        <div class="menu-list" id="sortList">
                            <?php foreach ($menu_list as $i => $item): ?>
                                <div class="menu-item" flex="dir:left">
                                    <input type="hidden" name="model[<?= is_numeric($i) ? ('item_' . $i) : $i ?>][name]"
                                           value="<?= $item['name'] ?>">
                                    <input type="hidden" name="model[<?= is_numeric($i) ? ('item_' . $i) : $i ?>][icon]"
                                           value="<?= $item['icon'] ?>">
                                    <input type="hidden" name="model[<?= is_numeric($i) ? ('item_' . $i) : $i ?>][open_type]"
                                           value="<?= $item['open_type'] ?>">
                                    <input type="hidden" name="model[<?= is_numeric($i) ? ('item_' . $i) : $i ?>][url]"
                                           value="<?= $item['url'] ?>">
                                    <input type="hidden" name="model[<?= is_numeric($i) ? ('item_' . $i) : $i ?>][tel]"
                                           value="<?= $item['tel'] ?>">
                                    <div class="menu-name" flex="cross:center"><?= $item['name'] ?></div>
                                    <div class="text-right menu-switch" flex="cross:center main:right">
                                        <label class="custom-control custom-checkbox mb-0 mr-0">
                                            <input <?= $item['is_show'] == 1 ? 'checked' : null ?>
                                                    name="model[<?= is_numeric($i) ? ('item_' . $i) : $i ?>][is_show]"
                                                    type="checkbox"
                                                    value="1"
                                                    class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description"></span>
                                        </label>
                                    </div>
                                    <div class="text-right menu-drop" flex="cross:center main:right">
                                    <span class="drop-btn">
                                        <i class="iconfont icon-paixu"></i>
                                    </span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>


            <div class="form-group row">
                <div class="col-sm-6 offset-md-2">
                    <div class="text-danger form-error mb-3" style="display: none">错误信息</div>
                    <div class="text-success form-success mb-3" style="display: none">成功信息</div>
                    <a class="btn btn-primary submit-btn" href="javascript:">保存</a>
                </div>
            </div>
        </div>

    </form>

</div>
<script src="https://cdn.bootcss.com/Sortable/1.6.0/Sortable.min.js"></script>
<script>

    Sortable.create(document.getElementById('sortList'), {
        animation: 250,
    }); // That's all.
</script>
