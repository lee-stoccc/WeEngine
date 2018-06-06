<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/8
 * Time: 18:01
 */
defined('YII_RUN') or exit('Access Denied');
/* @var $list \app\models\Setting */

/* @var $qrcode \app\models\Qrcode */

use yii\widgets\LinkPager;

$static = Yii::$app->request->baseUrl . '/statics';
$urlManager = Yii::$app->urlManager;
$this->title = '基础设置';
$this->params['active_nav_group'] = 5;
?>
<style>
    .help-block {
        display: block;
        margin-top: 5px;
        margin-bottom: 10px;
        color: #737373;
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
    <form class="form auto-submit-form" method="post" autocomplete="off">
        <div class="form-title">基础设置</div>
        <div class="form-body">
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required">分销层级</label>
                </div>
                <div class="col-9">
                    <label class="col-form-label mr-3"><input type="radio" name="model[level]"
                                                              value="0" <?= ($list->level == 0) ? "checked" : "" ?>>不开启</label>
                    <label class="col-form-label mr-3"><input type="radio" name="model[level]"
                                                              value="1" <?= ($list->level == 1) ? "checked" : "" ?>>一级分销</label>
                    <label class="col-form-label mr-3"><input type="radio" name="model[level]"
                                                              value="2" <?= ($list->level == 2) ? "checked" : "" ?>>二级分销</label>
                    <label class="col-form-label"><input type="radio" name="model[level]"
                                                         value="3" <?= ($list->level == 3) ? "checked" : "" ?>>三级分销</label>
                </div>
            </div>

            <div class="form-group row" style="border-bottom: 1px #ccc dashed">
                <div class="col-3 text-right">
                    <label class=" col-form-label">上下线关系设置</label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required">成为下线条件</label>
                </div>
                <div class="col-9">
                    <div>
                        <label class="col-form-label mr-3"><input type="radio" name="model[condition]"
                                                                  value="0" <?= ($list->condition == 0) ? "checked" : "" ?>>首次点击链接</label>
                        <!--                        <label class="col-form-label mr-3"><input type="radio" name="model[condition]" value="1">首次下单</label>-->
                        <!--                        <label class="col-form-label mr-3"><input type="radio" name="model[condition]" value="2">首次付款</label>-->
                    </div>
                    <div class="help-block">首次点击分享链接： 可以自由设置分销商条件</div>
                </div>
            </div>
            <div class="form-group row" style="border-bottom: 1px #ccc dashed">
                <div class="col-3 text-right">
                    <label class=" col-form-label">分销资格设置</label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required">成为分销商条件</label>
                </div>
                <div class="col-9">
                    <div>
                        <label class="col-form-label mr-3"><input type="radio" name="model[share_condition]"
                                                                  value="0" <?= ($list->share_condition == 0) ? "checked" : "" ?>>无条件（需要审核）</label>
                        <label class="col-form-label mr-3"><input type="radio" name="model[share_condition]"
                                                                  value="1" <?= ($list->share_condition == 1) ? "checked" : "" ?>>申请（需要审核）</label>
                        <label class="col-form-label mr-3"><input type="radio" name="model[share_condition]"
                                                                  value="2" <?= ($list->share_condition == 2) ? "checked" : "" ?>>无需审核</label>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">推广海报图</label>
                </div>
                <div class="col-9">
                    <a href="<?= $urlManager->createUrl(['mch/share/qrcode']) ?>"
                       class="btn btn-sm btn-primary">设置</a>

                </div>
            </div>
            <div class="form-group row" style="border-bottom: 1px #ccc dashed">
                <div class="col-3 text-right">
                    <label class=" col-form-label">分销佣金</label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class="col-form-label required">提现方式</label>
                </div>
                <div class="col-9">
                    <div>
                        <label class="col-form-label mr-3">
                            <input type="checkbox" name="model[pay_type][]" value="0"
                                <?=($list->pay_type==2||$list->pay_type==0)?"checked":""?>>
                            <span>微信支付</span>
                        </label>
                        <label class="col-form-label mr-3">
                            <input type="checkbox" name="model[pay_type][]" value="1"
                                <?=($list->pay_type==2||$list->pay_type==1)?"checked":""?>>
                            <span>支付宝支付</span>
                        </label>
                    </div>
                    <div>
                        <label class="col-form-label">微信自动支付，需要申请微信支付的企业付款到零钱功能</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required">最少提现额度</label>
                </div>
                <div class="col-9">
                    <div class="input-group" style="max-width:350px;">
                        <input class="form-control" name="model[min_money]"
                               value="<?= $list->min_money ? $list->min_money : 1 ?>">
                        <span class="input-group-addon">元</span>
                    </div>
                </div>
            </div>


            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required">每日提现上限</label>
                </div>
                <div class="col-9">
                    <div class="input-group" style="max-width:350px;">
                        <input type="number" min="0" step="0.01" class="form-control" name="model[cash_max_day]"
                               value="<?= $option['cash_max_day'] ? $option['cash_max_day'] : 0 ?>">
                        <span class="input-group-addon">元</span>
                    </div>
                    <div class="text-muted fs-sm">0元表示不限制每日提现金额</div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class="col-form-label required">消费自动成为分销商</label>
                </div>
                <div class="col-9">
                    <div class="input-group" style="max-width:350px;">
                        <input type="number" min="0" step="0.01" class="form-control" name="model[auto_share_val]"
                               value="<?= $option['auto_share_val'] ? $option['auto_share_val'] : 0 ?>">
                        <span class="input-group-addon">元</span>
                    </div>
                    <div class="text-muted fs-sm">消费满指定金额自动成为分销商，0元表示不自动</div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">用户须知</label>
                </div>
                <div class="col-9">
                    <textarea class="form-control" name="model[content]"
                              style="min-height: 150px;max-width: 350px;"><?= $list->content ?></textarea>
                </div>
            </div>

            <div class="form-group row" style="border-bottom: 1px #ccc dashed">
                <div class="col-3 text-right">
                    <label class=" col-form-label">分销协议</label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">申请协议</label>
                </div>
                <div class="col-9">
                    <textarea class="form-control" name="model[agree]"
                              style="min-height: 150px;max-width: 350px;"><?= $list->agree ?></textarea>
                </div>
            </div>
            <div class="form-group row" style="border-bottom: 1px #ccc dashed">
                <div class="col-3 text-right">
                    <label class=" col-form-label">背景图片</label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">申请页面</label>
                </div>
                <div class="col-9">
                    <?= \app\widgets\ImageUpload::widget([
                        'name' => 'model[pic_url_1]',
                        'value' => $list->pic_url_1,
                        'width' => 750,
                        'height' => 300,
                    ]) ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">待审核页面</label>
                </div>
                <div class="col-9">
                    <?= \app\widgets\ImageUpload::widget([
                        'name' => 'model[pic_url_2]',
                        'value' => $list->pic_url_2,
                        'width' => 750,
                        'height' => 300,
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