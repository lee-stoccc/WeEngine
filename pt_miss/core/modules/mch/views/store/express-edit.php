<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/5
 * Time: 14:29
 */
defined('YII_RUN') or exit('Access Denied');
use yii\widgets\LinkPager;

$statics = Yii::$app->request->baseUrl . '/statics';
$urlManager = Yii::$app->urlManager;
$this->title = '面单打印编辑';
$this->params['active_nav_group'] = 1;
?>

<script language="JavaScript" src="<?= $statics ?>/mch/js/LodopFuncs.js"></script>
<object id="LODOP_OB" classid="clsid:2105C259-1E0C-4534-8141-A753534CB4CA" width=0 height=0>
    <embed id="LODOP_EM" type="application/x-print-lodop" width=0 height=0></embed>
</object>
<div class="main-nav" flex="cross:center dir:left box:first" style="display: none">
    <div>
        <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/index']) ?>">我的商城</a>
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/express']) ?>">面单打印设置</a>
            <span class="breadcrumb-item active"><?= $this->title ?></span>
        </nav>
    </div>
    <div>
        <?= $this->render('/layouts/nav-right') ?>
    </div>
</div>
<div class="main-body p-3" id="sender">
    <form class="form auto-submit-form" method="post" autocomplete="off"
          data-return="<?= $urlManager->createUrl(['mch/store/express']) ?>">
        <div class="form-title">面单打印设置</div>
        <div class="form-body">

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">选择快递公司</label>
                </div>
                <div class="col-9">
                    <select class="form-control" name="model[express_id]">
                        <?php foreach($express as $index=>$value):?>
                            <option value="<?=$value['id']?>"><?=$value['name']?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required"><div>电子面单客户账号</div><div>（与快递网点申请）</div></label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="text" name="model[customer_name]" value="<?= $list['customer_name'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required">电子面单密码</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="text" name="model[customer_pwd]" value="<?= $list['customer_pwd'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">月结编码</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="text" name="model[month_code]" value="<?= $list['month_code'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">网点编码</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="text" name="model[send_site]" value="<?= $list['send_site'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">网点名称</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="text" name="model[send_name]" value="<?= $list['send_name'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class="col-form-label">发件人公司</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="text" name="model[company]"
                           value="<?= $sender->company ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class="col-form-label required">发件人名称</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="text" name="model[name]" value="<?= $sender->name ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class="col-form-label">发件人电话</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="text" name="model[tel]" value="<?= $sender->tel ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class="col-form-label">发件人手机</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="text" name="model[mobile]"
                           value="<?= $sender->mobile ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class="col-form-label">发件人邮编</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="text" name="model[post_code]"
                           value="<?= $sender->post_code ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class="col-form-label required ">发件人地址</label>
                </div>
                <div class="col-9">
                    <select class="form-control col-4 province" style="float: left;height: 36px;" name="model[province]">
                        <option v-for="(item,index) in province"
                                :value="item.name" :data-index="index">{{item.name}}</option>
                    </select>
                    <select class="form-control col-4 city" style="float: left;height: 36px;" name="model[city]">
                        <option v-for="(item,index) in city"
                                :value="item.name" :data-index="index">{{item.name}}</option>
                    </select>
                    <select class="form-control col-4 area" style="float: left;height: 36px;" name="model[exp_area]">
                        <option v-for="(item,index) in area"
                                :value="item.name" :data-index="index">{{item.name}}</option>
                    </select>
                    <div>
                        <input class="form-control" type="text" name="model[address]" placeholder="请填写详细地址" value="<?=$sender->address?>">
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
    var app = new Vue({
        el:'#sender',
        data:{
            province:<?=$district?>,
            city:[],
            area:[],
            sender_province: "<?=$sender->province?>",
            sender_city: "<?=$sender->city?>",
            sender_area: "<?=$sender->exp_area?>"
        }
    });
    app.city = app.province[0].list;
    app.area = app.city[0].list;
    $(app.province).each(function (i) {
        if (app.province[i].name == app.sender_province) {
            app.city = app.province[i].list;
            return true;
        }
    });
    $(app.city).each(function (i) {
        if (app.city[i].name == app.sender_city) {
            app.area = app.city[i].list;
            return true;
        }
    });
    $(document).ready(function(){
        $('.province').find('option').each(function(i){
            if($(this).val() == app.sender_province){
                $(this).prop('selected','selected');
                return true;
            }
        });
        $('.city').find('option').each(function(i){
            if($(this).val() == app.sender_city){
                $(this).prop('selected','selected');
                return true;
            }
        });
        $('.area').find('option').each(function(i){
            if($(this).val() == app.sender_area){
                $(this).prop('selected','selected');
                return true;
            }
        });
        $(document).on('change', '.province', function () {
            var index = $(this).find('option:selected').data('index');
            app.city = app.province[index].list;
            app.area = app.city[0].list;
        });
        $(document).on('change', '.city', function () {
            var index = $(this).find('option:selected').data('index');
            app.area = app.city[index].list;
        });
    });
    $(document).on('change','.province',function(){
        var index = $(this).find('option:selected').data('index');
        app.city = app.province[index].list;
        app.area = app.city[0].list;
    });
    $(document).on('change','.city',function(){
        var index = $(this).find('option:selected').data('index');
        app.area = app.city[index].list;
    });
</script>