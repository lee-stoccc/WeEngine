<?php
defined('YII_RUN') or exit('Access Denied');

/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/8/24
 * Time: 10:18
 */

use yii\widgets\LinkPager;
/* @var \app\models\Coupon $coupon*/

$urlManager = Yii::$app->urlManager;
$this->title = '优惠券发放';
$this->params['active_nav_group'] = 7;
$returnUrl = Yii::$app->request->referrer;
if (!$returnUrl)
    $returnUrl = $urlManager->createUrl(['mch/coupon/coupon']);
?>
<link href="https://cdn.bootcss.com/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.min.css" rel="stylesheet">
<style>

    .user-list .user-item {
        text-align: center;
        width: 120px;
        border: 1px solid #e3e3e3;
        padding: 1rem 0;
        cursor: pointer;
        display: inline-block;
        vertical-align: top;
        margin: 0 1rem 1rem 0;
        border-radius: .15rem;
    }

    .user-list .user-item:hover {
        background: rgba(238, 238, 238, 0.54);
    }

    .user-list .user-item img {
        width: 3.5rem;
        height: 3.5rem;
        border-radius: 999px;
        margin-bottom: 1rem;
    }

    .user-list .user-item.active {
        background: rgba(2, 117, 216, 0.69);
        color: #fff;
    }
</style>
<div class="main-nav" flex="cross:center dir:left box:first" style="display: none">
    <div>
        <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/index']) ?>">我的商城</a>
            <a class="breadcrumb-item" href="<?= $returnUrl ?>">优惠券列表</a>
            <span class="breadcrumb-item active"><?= $this->title ?></span>
        </nav>
    </div>
    <div>
        <?= $this->render('/layouts/nav-right') ?>
    </div>
</div>
<div class="main-body p-3" id="app">
    <form class="form auto-submit-form" method="post" autocomplete="off" data-timeout="5"
          data-return="<?= $returnUrl ?>">
        <div class="form-title"><?= $this->title ?></div>
        <div class="form-body">

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class="">优惠券名称</label>
                </div>
                <div class="col-9">
                    <?= $coupon->name ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class="">最低消费金额（元）</label>
                </div>
                <div class="col-9">
                    <?= $coupon->min_price ?>
                </div>
            </div>
            <?php if($coupon->discount_type == 2):?>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class="">优惠金额（元）</label>
                </div>
                <div class="col-9">
                    <?= $coupon->sub_price ?>
                </div>
            </div>
            <?php elseif($coupon->discount_type == 1):?>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class="">折扣率</label>
                </div>
                <div class="col-9">
                    <?= $coupon->discount ?>折
                </div>
            </div>
            <?php endif;?>

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class="">剩余数量</label>
                </div>
                <div class="col-9">
                    <?=($coupon->total_count == -1)?"无限制":($coupon->total_count-$coupon->count)?>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class="">优惠券有效期</label>
                </div>
                <div class="col-9">
                    <?php if ($coupon->expire_type == 1): ?>
                        发放后<span class="text-danger"><?= $coupon->expire_day ?>天内</span>可以使用
                    <?php else: ?>
                        <span class="text-danger"><?= date('Y-m-d', $coupon->begin_time) ?></span>至<span
                                class="text-danger"><?= date('Y-m-d', $coupon->begin_time) ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class="">发放对象</label>
                </div>
                <div class="col-9">
                    <div class="input-group mb-3" style="max-width: 250px">
                        <input class="form-control search-user-keyword" placeholder="昵称"
                               onkeydown="if(event.keyCode==13) {search_user();return false;}">
                        <span class="input-group-btn">
                            <a class="btn btn-secondary search-user-btn" onclick="search_user()"
                               href="javascript:">查找用户</a>
                        </span>
                    </div>
                    <div class="user-list">
                        <div v-if="user_list">
                            <label class="user-item" v-for="(user,index) in user_list">
                                <img v-bind:src="user.avatar_url">
                                <input v-bind:value="user.id" type="checkbox" name="user_id_list[]"
                                       style="display: none">
                                <div style="white-space: nowrap;text-overflow: ellipsis;overflow: hidden">
                                    {{user.nickname}}
                                </div>
                            </label>
                        </div>
                        <div v-else style="color: #ddd;">请输入昵称查找用户</div>
                    </div>
                </div>
            </div>


            <div class="form-group row">
                <div class="col-9 offset-sm-3">
                    <div class="text-danger form-error mb-3" style="display: none">错误信息</div>
                    <div class="text-success form-success mb-3" style="display: none">成功信息</div>
                    <a class="btn btn-primary submit-btn" href="javascript:">立即发放</a>
                </div>
            </div>
        </div>

    </form>
</div>
<script src="https://cdn.bootcss.com/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.min.js"></script>
<script>

    var app = new Vue({
        el: "#app",
        data: {
            user_list: false,
        }
    });

    $(document).on("change", "input[name=expire_type]", function () {
        $(".expire-type").hide();
        $(".expire-type-" + this.value).show();
    });
    $(document).on("change", "input[name='user_id_list[]']", function () {
        console.log($(this).parents("label"));
        if ($(this).prop("checked")) {
            $(this).parents("label").addClass("active");
        } else {
            $(this).parents("label").removeClass("active");
        }
    });

    (function () {
        $.datetimepicker.setLocale('zh');
        $('#begin_time').datetimepicker({
            format: 'Y-m-d',
            onShow: function (ct) {
                this.setOptions({
                    maxDate: $('#end_time').val() ? $('#end_time').val() : false
                })
            },
            timepicker: false,
        });
        $('#end_time').datetimepicker({
            format: 'Y-m-d',
            onShow: function (ct) {
                this.setOptions({
                    minDate: $('#begin_time').val() ? $('#begin_time').val() : false
                })
            },
            timepicker: false,
        });
    })();


    function search_user() {
        var btn = $(".search-user-btn");
        var keyword = $(".search-user-keyword").val();
        btn.btnLoading("正在查找");
        $.ajax({
            url: "<?=$urlManager->createUrl(['mch/coupon/search-user'])?>",
            dataType: "json",
            data: {
                keyword: keyword,
            },
            success: function (res) {
                btn.btnReset();
                if (res.code == 0) {
                    app.user_list = res.data.list;
                }
            }
        });
    }


</script>