<?php
defined('YII_RUN') or exit('Access Denied');
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/29
 * Time: 10:49
 */

$urlManager = Yii::$app->urlManager;
$this->title = '预约商品编辑';
$staticBaseUrl = Yii::$app->request->baseUrl . '/statics';
$this->params['active_nav_group'] = 10;
$this->params['is_book'] = 1;
$returnUrl = Yii::$app->request->referrer;
if (!$returnUrl)
    $returnUrl = $urlManager->createUrl(['mch/group/goods/index']);
?>
<script src="<?= $staticBaseUrl ?>/mch/js/uploadVideo.js"></script>
<style>
    .cat-box {
        border: 1px solid rgba(0, 0, 0, .15);
    }

    .cat-box .row {
        margin: 0;
        padding: 0;
    }

    .cat-box .col-6 {
        padding: 0;
    }

    .cat-box .cat-list {
        border-right: 1px solid rgba(0, 0, 0, .15);
        overflow-x: hidden;
        overflow-y: auto;
        height: 10rem;
    }

    .cat-box .cat-item {
        border-bottom: 1px solid rgba(0, 0, 0, .1);
        padding: .5rem 1rem;
        display: block;
        margin: 0;
    }

    .cat-box .cat-item:last-child {
        border-bottom: none;
    }

    .cat-box .cat-item:hover {
        background: rgba(0, 0, 0, .05);
    }

    .cat-box .cat-item.active {
        background: rgb(2, 117, 216);
        color: #fff;
    }

    .cat-box .cat-item input {
        display: none;
    }

    form {
    }

    form .head {
        position: fixed;
        top: 62px;
        right: 1rem;
        /*left: 16rem;*/
        left: 27.5rem;
        z-index: 9;
        padding-top: 1rem;
        background: #f3f3f3;
    }

    form .head .head-content {
        background: #fff;
        border: 1px solid #eee;
        height: 40px;
    }

    .head-step {
        height: 100%;
        padding: 0 20px;
    }

    .step-block {
        position: relative;
    }

    form .body {
        padding-top: 45px;
    }

    .step-block > div {
        padding: 20px;
        background: #fff;
        border: 1px solid #eee;
        margin-bottom: 5px;
    }

    .step-block > div:first-child {
        padding: 20px;
        width: 200px;
        margin-right: 5px;
        font-weight: bold;
        text-align: center;
    }

    .step-block .step-location {
        position: absolute;
        top: -122px;
        left: 0;
    }

    .step-block:first-child .step-location {
        top: -140px;
    }

    form .foot {
        text-align: center;
        background: #fff;
        border: 1px solid #eee;
        padding: 1rem;
    }

    .edui-editor,
    #edui1_toolbarbox {
        z-index: 2 !important;
    }

    form .short-row {
        width: 380px;
    }

    .form {
        background: none;
        width: 100%;
        max-width: 100%;
    }

    .attr-group {
        border: 1px solid #eee;
        padding: .5rem .75rem;
        margin-bottom: .5rem;
        border-radius: .15rem;
    }

    .attr-group-delete {
        display: inline-block;
        background: #eee;
        color: #fff;
        width: 1rem;
        height: 1rem;
        text-align: center;
        line-height: 1rem;
        border-radius: 999px;
    }

    .attr-group-delete:hover {
        background: #ff4544;
        color: #fff;
        text-decoration: none;
    }

    .attr-list > div {
        vertical-align: top;
    }

    .attr-item {
        display: inline-block;
        background: #eee;
        margin-right: 1rem;
        margin-top: .5rem;
        overflow: hidden;
    }

    .attr-item .attr-name {
        padding: .15rem .75rem;
        display: inline-block;
    }

    .attr-item .attr-delete {
        padding: .35rem .75rem;
        background: #d4cece;
        color: #fff;
        font-size: 1rem;
        font-weight: bold;
    }

    .attr-item .attr-delete:hover {
        text-decoration: none;
        color: #fff;
        background: #ff4544;
    }

</style>

<div class="main-nav" flex="cross:center dir:left box:first">
    <div>
        <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/book/store/index']) ?>">我的商城</a>
            <a class="breadcrumb-item" href="<?= $returnUrl ?>">商品管理</a>
            <span class="breadcrumb-item active"><?= $this->title ?></span>
        </nav>
    </div>
    <div>
        <?= $this->render('/layouts/nav-right') ?>
    </div>
</div>

<div class="main-body p-3" id="page">

    <form class="form auto-submit-form" method="post" autocomplete="off" data-return="<?= $returnUrl ?>">
        <div class="head">
            <div class="head-content" flex="dir:left">
                <a flex="cross:center" class="head-step" href="#step1">选择分类</a>
                <a flex="cross:center" class="head-step" href="#step2">基本信息</a>
                <a flex="cross:center" class="head-step" href="#step3">自定义表单</a>
                <a flex="cross:center" class="head-step" href="#step4">商品详情</a>
            </div>
        </div>
        <div class="body" id="app">
            <div class="step-block" flex="dir:left box:first">
                <div>
                    <span>选择分类</span>
                    <span class="step-location" id="step1"></span>
                </div>
                <div>
                    <div class="form-group row">
                        <div class="col-3 text-right">
                            <label class=" col-form-label required">商品分类</label>
                        </div>
                        <div class="col-9">
                            <div class="input-group short-row">
                                <select class="form-control parent" name="model[cat_id]">
                                    <option value="">请选择分类</option>
                                    <?php foreach ($cat as $value): ?>
                                        <option value="<?= $value['id'] ?>" <?= $value['id'] == $goods['cat_id'] ? 'selected' : '' ?>><?= $value['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="step-block" flex="dir:left box:first">
                <div>
                    <span>基本信息</span>
                    <span class="step-location" id="step2"></span>
                </div>
                <div>
                    <div class="form-group row">
                        <div class="col-3 text-right">
                            <label class=" col-form-label required">商品名称</label>
                        </div>
                        <div class="col-9">
                            <input class="form-control short-row" type="text" name="model[name]"
                                   value="<?= $goods['name'] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-3 text-right">
                            <label class=" col-form-label">商品排序</label>
                        </div>
                        <div class="col-9">
                            <input class="form-control short-row" type="text" name="model[sort]"
                                   value="<?= $goods['sort'] ?: 100 ?>">
                            <div class="text-muted fs-sm">排序按升序排列</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-3 text-right">
                            <label class=" col-form-label">虚拟销量</label>
                        </div>
                        <div class="col-9">
                            <input class="form-control short-row" type="number" name="model[virtual_sales]"
                                   value="<?= $goods['virtual_sales'] ?>">
                            <div class="text-muted fs-sm">前端展示的销量=实际销量+虚拟销量</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-3 text-right">
                            <label class="col-form-label required">商品缩略图</label>
                        </div>
                        <div class="col-9">
                            <?= \app\widgets\ImageUpload::widget([
                                'name' => 'model[cover_pic]',
                                'value' => $goods['cover_pic'],
                                'width' => 220,
                                'height' => 220,
                            ]) ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-3 text-right">
                            <label class="col-form-label required">商品图片</label>
                        </div>
                        <div class="col-9">
                            <?php if ($goods->goodsPicList()):foreach ($goods->goodsPicList() as $goods_pic): ?>
                                <?php $goods_pic_list[] = $goods_pic->pic_url ?>
                            <?php endforeach;
                            else:$goods_pic_list = [];endif; ?>
                            <?= \app\widgets\ImageUpload::widget([
                                'name' => 'model[goods_pic_list][]',
                                'value' => $goods_pic_list,
                                'multiple' => true,
                                'width' => 750,
                                'height' => 700,
                            ]) ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-3 text-right">
                            <label class=" col-form-label required">预约金额</label>
                        </div>
                        <div class="col-9">
                            <div class="input-group short-row">
                                <input type="number" step="0.01" class="form-control"
                                       name="model[price]" min="0.01"
                                       value="<?= $goods['price'] ? $goods['price'] : 1 ?>">
                                <span class="input-group-addon">元</span>
                                <div class="fs-sm text-muted">设置0则小程序端将显示为 免费</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-3 text-right">
                            <label class=" col-form-label required">原价</label>
                        </div>
                        <div class="col-9">
                            <input type="number" step="0.01" class="form-control short-row"
                                   name="model[original_price]" min="0"
                                   value="<?= $goods['original_price'] ? $goods['original_price'] : 1 ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-3 text-right">
                            <label class=" col-form-label">服务内容</label>
                        </div>
                        <div class="col-9">
                            <input class="form-control short-row" name="model[service]"
                                   value="<?= $goods['service'] ?>">
                            <div class="fs-sm text-muted">例子：正品保障,极速发货,7天退换货。多个请使用英文逗号<kbd>,</kbd>分隔</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-3 text-right">
                            <label class=" col-form-label">支持门店</label>
                        </div>
                        <div class="col-9">
                            <input class="form-control short-row" name="model[shop_id]"
                                   value="<?= $goods['shop_id'] ?>">
                            <div class="fs-sm text-muted">请填写门店id 多个请使用英文逗号<kbd>,</kbd>分隔</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="step-block" flex="dir:left box:first">
                <div>
                    <span>自定义表单</span>
                    <span class="step-location" id="step3"></span>
                </div>
                <div>
                <div class="form-group row">
                    <div class="col-3 text-right required">
                        <label class="col-form-label">自定义表单</label>
                    </div>
                        <div class="col-9">
                            <table class="table">
                                <thead>
                                <tr>
                                    <td>类型</td>
                                    <td>名称</td>
                                    <td>必填</td>
                                    <td>设置</td>
                                    <td></td>
                                </tr>
                                </thead>
                                <col style="width: 15%;">
                                <col style="width: 15%;">
                                <col style="width: 10%;">
                                <col style="width: 30%;">
                                <col style="width: 30%;">
                                <tbody>
                                <template v-for="(item,index) in form_list">
                                    <tr v-if="item.type == 'text'">
                                        <td>
                                            单行文本
                                            <input type="hidden" v-model="item.id" class="form-control"
                                                   :name="'model[form_list]['+index+'][id]'">
                                            <input type="hidden" v-model="item.type"
                                                   :name="'model[form_list]['+index+'][type]'">
                                        </td>
                                        <td><input type="text" v-model="item.name" class="form-control"
                                                   :name="'model[form_list]['+index+'][name]'"></td>
                                        <td><input type="checkbox" value="1" :checked="item.required==1"
                                                   :name="'model[form_list]['+index+'][required]'"></td>
                                        <td>
                                            <div class="mb-2">
                                                <span class="mr-2">设置默认值</span><input type="text" v-model="item.default"
                                                                                      class="form-control"
                                                                                      :name="'model[form_list]['+index+'][default]'">
                                            </div>
                                            <div class="mb-2">
                                                <span class="mr-2">提示语</span><input type="text" v-model="item.tip"
                                                                                    class="form-control"
                                                                                    :name="'model[form_list]['+index+'][tip]'">
                                            </div>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-primary form-prev" :data-index="index"
                                               v-if="index>0"
                                               href="javascript:">上移</a>
                                            <a class="btn btn-sm btn-primary form-next" :data-index="index"
                                               v-if="index<form_list.length-1"
                                               href="javascript:">下移</a>
                                            <a class="btn btn-sm btn-danger form-del" :data-index="index"
                                               href="javascript:">删除</a>
                                        </td>
                                    </tr>
                                    <tr v-if="item.type == 'textarea'">
                                        <td>
                                            多行文本
                                            <input type="hidden" v-model="item.id" class="form-control"
                                                   :name="'model[form_list]['+index+'][id]'">
                                            <input type="hidden" v-model="item.type"
                                                   :name="'model[form_list]['+index+'][type]'">
                                        </td>
                                        <td><input type="text" v-model="item.name" class="form-control"
                                                   :name="'model[form_list]['+index+'][name]'"></td>
                                        <td><input type="checkbox" value="1" :checked="item.required==1"
                                                   :name="'model[form_list]['+index+'][required]'"></td>
                                        <td>
                                            <div class="mb-2">
                                                <span class="mr-2">设置默认值</span><input type="text" v-model="item.default"
                                                                                      class="form-control"
                                                                                      :name="'model[form_list]['+index+'][default]'">
                                            </div>
                                            <div class="mb-2">
                                                <span class="mr-2">提示语</span><input type="text" v-model="item.tip"
                                                                                    class="form-control"
                                                                                    :name="'model[form_list]['+index+'][tip]'">
                                            </div>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-primary form-prev" :data-index="index"
                                               v-if="index>0"
                                               href="javascript:">上移</a>
                                            <a class="btn btn-sm btn-primary form-next" :data-index="index"
                                               v-if="index<form_list.length-1"
                                               href="javascript:">下移</a>
                                            <a class="btn btn-sm btn-danger form-del" :data-index="index"
                                               href="javascript:">删除</a>
                                        </td>
                                    </tr>
                                    <tr v-if="item.type == 'time'">
                                        <td>
                                            时间选择器
                                            <input type="hidden" v-model="item.id" class="form-control"
                                                   :name="'model[form_list]['+index+'][id]'">
                                            <input type="hidden" v-model="item.type"
                                                   :name="'model[form_list]['+index+'][type]'">
                                        </td>
                                        <td><input type="text" v-model="item.name" class="form-control"
                                                   :name="'model[form_list]['+index+'][name]'"></td>
                                        <td><input type="checkbox" value="1" :checked="item.required==1"
                                                   :name="'model[form_list]['+index+'][required]'"></td>
                                        <td>
                                            <div class="mb-2">
                                                <span class="mr-2">设置默认值</span><input type="time" v-model="item.default"
                                                                                      class="form-control "
                                                                                      :name="'model[form_list]['+index+'][default]'">
                                            </div>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-primary form-prev" :data-index="index"
                                               v-if="index>0"
                                               href="javascript:">上移</a>
                                            <a class="btn btn-sm btn-primary form-next" :data-index="index"
                                               v-if="index<form_list.length-1"
                                               href="javascript:">下移</a>
                                            <a class="btn btn-sm btn-danger form-del" :data-index="index"
                                               href="javascript:">删除</a>
                                        </td>
                                    </tr>
                                    <tr v-if="item.type == 'date'">
                                        <td>
                                            日期选择器
                                            <input type="hidden" v-model="item.id" class="form-control"
                                                   :name="'model[form_list]['+index+'][id]'">
                                            <input type="hidden" v-model="item.type"
                                                   :name="'model[form_list]['+index+'][type]'">
                                        </td>
                                        <td><input type="text" v-model="item.name" class="form-control"
                                                   :name="'model[form_list]['+index+'][name]'"></td>
                                        <td><input type="checkbox" value="1" :checked="item.required==1"
                                                   :name="'model[form_list]['+index+'][required]'"></td>
                                        <td>
                                            <div class="mb-2">
                                                <span class="mr-2">设置默认值</span><input type="date" v-model="item.default"
                                                                                      class="form-control "
                                                                                      :name="'model[form_list]['+index+'][default]'">
                                            </div>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-primary form-prev" :data-index="index"
                                               v-if="index>0"
                                               href="javascript:">上移</a>
                                            <a class="btn btn-sm btn-primary form-next" :data-index="index"
                                               v-if="index<form_list.length-1"
                                               href="javascript:">下移</a>
                                            <a class="btn btn-sm btn-danger form-del" :data-index="index"
                                               href="javascript:">删除</a>
                                        </td>
                                    </tr>
                                    <tr v-if="item.type == 'radio'">
                                        <td>
                                            单选框
                                            <input type="hidden" v-model="item.id" class="form-control"
                                                   :name="'model[form_list]['+index+'][id]'">
                                            <input type="hidden" v-model="item.type"
                                                   :name="'model[form_list]['+index+'][type]'">
                                        </td>
                                        <td><input type="text" v-model="item.name" class="form-control"
                                                   :name="'model[form_list]['+index+'][name]'"></td>
                                        <td><input type="checkbox" value="1" :checked="item.required==1"
                                                   :name="'model[form_list]['+index+'][required]'"></td>
                                        <td>
                                            <div class="mb-2">
                                                <span class="mr-2">选项值</span><input type="text" v-model="item.default"
                                                                                      class="form-control"
                                                                                      :name="'model[form_list]['+index+'][default]'">

                                                <div class="text-muted fs-sm">选项值请用英文逗号<kbd>,</kbd>分隔</div>
                                            </div>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-primary form-prev" :data-index="index"
                                               v-if="index>0"
                                               href="javascript:">上移</a>
                                            <a class="btn btn-sm btn-primary form-next" :data-index="index"
                                               v-if="index<form_list.length-1"
                                               href="javascript:">下移</a>
                                            <a class="btn btn-sm btn-danger form-del" :data-index="index"
                                               href="javascript:">删除</a>
                                        </td>
                                    </tr>
                                    <tr v-if="item.type == 'checkbox'">
                                        <td>
                                            复选框
                                            <input type="hidden" v-model="item.id" class="form-control"
                                                   :name="'model[form_list]['+index+'][id]'">
                                            <input type="hidden" v-model="item.type"
                                                   :name="'model[form_list]['+index+'][type]'">
                                        </td>
                                        <td><input type="text" v-model="item.name" class="form-control"
                                                   :name="'model[form_list]['+index+'][name]'"></td>
                                        <td><input type="checkbox" value="1" :checked="item.required==1"
                                                   :name="'model[form_list]['+index+'][required]'"></td>
                                        <td>
                                            <div class="mb-2">
                                                <span class="mr-2">选项值</span><input type="text" v-model="item.default"
                                                                                    class="form-control"
                                                                                    :name="'model[form_list]['+index+'][default]'">

                                                <div class="text-muted fs-sm">选项值请用英文逗号<kbd>,</kbd>分隔</div>
                                            </div>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-primary form-prev" :data-index="index"
                                               v-if="index>0"
                                               href="javascript:">上移</a>
                                            <a class="btn btn-sm btn-primary form-next" :data-index="index"
                                               v-if="index<form_list.length-1"
                                               href="javascript:">下移</a>
                                            <a class="btn btn-sm btn-danger form-del" :data-index="index"
                                               href="javascript:">删除</a>
                                        </td>
                                    </tr>

                                </template>
                                <template>
                                    <tr>
                                        <td colspan="2">
                                            <select class="form-control form-add-type">
                                                <option value="text">单行文本</option>
                                                <option value="textarea">多行文本</option>
                                                <option value="time">时间选择器</option>
                                                <option value="date">日期选择器</option>
                                                <option value="radio">单选</option>
                                                <option value="checkbox">复选</option>
                                            </select>
                                        </td>
                                        <td colspan="2" style="text-align: right">
                                            <a class="btn btn-sm btn-primary form-add" href="javascript:">添加一个字段</a>
                                        </td>
                                    </tr>
                                </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="step-block" flex="dir:left box:first">
                <div>
                    <span>图文详情</span>
                    <span class="step-location" id="step4"></span>
                </div>
                <div>
                    <div class="form-group row">
                        <div class="col-3 text-right">
                            <label class=" col-form-label required">图文详情</label>
                        </div>
                        <div class="col-9">
                            <textarea class="short-row" id="editor"
                                      name="model[detail]"><?= $goods['detail'] ?></textarea>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="foot">
            <div class="text-danger form-error mb-3" style="display: none">错误信息</div>
            <div class="text-success form-success mb-3" style="display: none">成功信息</div>
            <a class="btn btn-primary submit-btn" href="javascript:">保存</a>
        </div>
    </form>


    <!-- 选择分类 -->
    <div class="modal fade" id="catModal" tabindex="-1" role="dialog" aria-labelledby="catModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <b>选择分类</b>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="cat-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="cat-list parent-cat-list">
                                    <?php foreach ($cat_list as $index => $cat): ?>
                                        <label class="cat-item <?= $index == 0 ? 'active' : '' ?>">
                                            <?= $cat->name ?>
                                            <input value="<?= $cat->id ?>"
                                                <?= $index == 0 ? 'checked' : '' ?>
                                                   type="radio"
                                                   name="model[cat_id]">
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="cat-list">
                                    <label class="cat-item" v-for="sub_cat in sub_cat_list">
                                        {{sub_cat.name}}
                                        <input v-bind:value="sub_cat.id" type="radio" name="model[cat_id]">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary cat-confirm">确认</button>
                </div>
            </div>
        </div>
    </div>

</div>



<script src="<?= Yii::$app->request->baseUrl ?>/statics/ueditor/ueditor.config.js"></script>
<script src="<?= Yii::$app->request->baseUrl ?>/statics/ueditor/ueditor.all.min.js"></script>
<script>
    var app = new Vue({
        el: "#app",
        data: {
            form_list: <?=$form_list?>,
        }
    });
</script>

<script>
    $(document).on('change', '.video', function () {
        $('.video-check').attr('href', this.value);
    });
    //日期时间选择器
    laydate.render({
        elem: '#limit_time'
        , type: 'datetime'
    });
    var ue = UE.getEditor('editor', {
        serverUrl: "<?=$urlManager->createUrl(['upload/ue'])?>",
        enableAutoSave: false,
        saveInterval: 1000 * 3600,
        enableContextMenu: false,
        autoHeightEnabled: false,
    });

</script>

<script>
    $(document).on("click", ".submit-btn-1", "click", function () {
        var form = $(this).parents("form");
        var return_url = form.attr("data-return");
        var timeout = form.attr("data-timeout");
        var btn = $(this);
        var error = form.find(".form-error");
        var success = form.find(".form-success");
        error.hide();
        success.hide();
        $("input[name='_csrf']").val("<?=Yii::$app->request->csrfToken?>");
        btn.btnLoading("正在提交");
        var form_list = app.form_list;
        var is_submit = true;
        for (var i in form_list) {
            if (!form_list[i].name || form_list[i] == undefined) {
                is_submit = false;
                break;
            }
        }
        if (!is_submit) {
            btn.btnReset();
            $.myAlert({
                content: '请填写字段名称'
            });
            return;
        }
        $.ajax({
            url: form.attr("action"),
            type: form.attr("method"),
            data: form.serialize(),
            dataType: "json",
            success: function (res) {
                if (res.code == 0) {
                    success.html(res.msg).show();
                    if (return_url) {
                        if (timeout)
                            timeout = 1000 * parseInt(timeout);
                        else
                            timeout = 1500;
                        setTimeout(function () {
                            location.href = return_url;
                        }, timeout);
                    } else {
                        btn.btnReset();
                    }
                }
                if (res.code == 1) {
                    error.html(res.msg).show();
                    btn.btnReset();
                }
            }
        });
        return false;
    });
</script>
<script>
$(document).on('click', '.form-del', function () {
    var index = $(this).data('index');
    app.form_list.splice(index, 1);
});
$(document).on('click', '.form-prev', function () {
    var index = $(this).data('index');
    if (index == 0) {
        return;
    }
    var middle = app.form_list[index];
    var prev = app.form_list[index - 1];
    app.form_list.splice(index - 1, 2, middle, prev);
});
$(document).on('click', '.form-next', function () {
    var index = $(this).data('index');
    if (index == app.form_list.length - 1) {
        return;
    }
    var middle = app.form_list[index];
    var next = app.form_list[index + 1];
    app.form_list.splice(index, 2, next, middle);
});
</script>
<script>
    $(document).on('click', '.form-add', function () {
        var aa = {};
        aa.type = $('.form-add-type').val();
        aa.name = $('.form-add-type').val();
        app.form_list.push(aa);
    });
</script>