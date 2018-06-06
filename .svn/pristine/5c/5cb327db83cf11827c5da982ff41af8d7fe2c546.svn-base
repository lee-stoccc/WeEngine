<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/1
 * Time: 16:16
 */
defined('YII_RUN') or exit('Access Denied');

use yii\widgets\LinkPager;
use \app\models\Option;
/* @var \app\models\Printer[] $list */
/* @var \app\models\PrinterSetting $model */

$urlManager = Yii::$app->urlManager;
$this->title = '打印设置';
$this->params['active_nav_group'] = 13;
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
    <form class="form auto-submit-form" method="post" autocomplete="off">
        <div class="form-title"><?= $this->title ?></div>
        <div class="form-body">

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">选择打印机</label>
                </div>
                <div class="col-9">
                    <select class="form-control" name="printer_id">
                        <?php foreach($list as $index=>$value):?>
                            <option value="<?=$value->id?>" <?=$model->printer_id == $value['id']?"selected":""?>><?=$value->name?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">订单打印方式</label>
                </div>
                <div class="col-9">
                    <div class="pt-1">
                        <label class="custom-control custom-checkbox">
                            <input id="radio1"
                                   value="1" <?=$model->type['order'] == 1?"checked":""?>
                                   name="type[order]" type="checkbox" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">下单打印</span>
                        </label>
                        <label class="custom-control custom-checkbox">
                            <input id="radio2"
                                   value="1" <?=$model->type['pay'] == 1?"checked":""?>
                                   name="type[pay]" type="checkbox" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">付款打印</span>
                        </label>
                        <label class="custom-control custom-checkbox">
                            <input id="radio2"
                                   value="1" <?=$model->type['confirm'] == 1?"checked":""?>
                                   name="type[confirm]" type="checkbox" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">确认收货打印</span>
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
