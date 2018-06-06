<?php
defined('YII_RUN') or exit('Access Denied');
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/6/19
 * Time: 16:52
 * @var \yii\web\View $this
 */
$urlManager = Yii::$app->urlManager;
$this->title = '首页设置';
$this->params['active_nav_group'] = 1;
?>
<style>
    body.dragging, body.dragging * {
        cursor: move !important;
    }

    .dragged {
        position: absolute;
        z-index: 2000;
        box-shadow: 2px 2px 1px rgba(0, 0, 0, .05);
    }

    .edit-box .module-item.placeholder {
        position: relative;
    }

    .edit-box .module-item.placeholder:before {
        position: absolute;
    }

    .form {
        width: 70rem;
        background: #fff;
        padding-left : 20px;
        /*border: 1px solid #e3e3e3;*/
    }

    .module-list,
    .edit-box {
        width: 20rem;
        min-height: 32rem;
        border: 1px solid #e3e3e3;
        padding: .5rem;
        float: left;
        margin-right: 1rem;
        position: relative;
        list-style: disc;
        overflow-x: hidden;
    }

    .module-list .module-item,
    .edit-box .module-item {
        border: 1px solid #eee;
        margin-bottom: .5rem;
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .edit-box .module-item {
        left: .5rem !important;
        background: #fff;
        cursor: default;
        cursor: move;
    }

    .module-item .operations {
        position: absolute;
        right: 0;
        top: 0;
        width: 5rem;
        z-index: 100;
        text-align: right;
        opacity: .05;
        transition: opacity 200ms;
    }

    .module-item:hover .operations {
        opacity: 1;
    }

    .module-item .operations .operate-icon {
        width: 1.5rem;
        height: 1.5rem;
        display: inline-block;
        float: right;
        font-size: 0;
        background: #ebebeb;
        margin-left: .25rem;
        padding: .25rem;
    }

    .module-item .operations .operate-icon img {
        width: 100%;
        height: 100%;
    }

    .block-title {
        float: left;
        width: 20rem;
        margin-right: 1rem;
        font-weight: bold;
        text-align: center;
        margin-bottom: 1rem;
    }

    .submit-block {
        width: 20rem;
        float: left;
        border: 1px solid #e3e3e3;
        padding: 1rem;
    }

    .home-block {
        position: relative;
    }

    .home-block .block-content {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
    }

    .home-block .block-name {
        color: #fff;
        padding: 6px;
        text-align: center;
        background: rgba(0, 0, 0, .2);
        opacity: .9;
    }

    .home-block:hover .block-name {
        background: rgba(0, 0, 0, .7);
        opacity: 1;
    }

    .home-block .block-img {
        width: 100%;
        height: auto;
    }

    .sortable-ghost {
        opacity: .3;
    }
</style>
<div class="main-nav" flex="cross:center dir:left box:first" style="display: none">
    <div>
        <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
            <a flex="cross:center" class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store']) ?>">我的商城</a>
            <span flex="cross:center" class="breadcrumb-item active"><?= $this->title ?></span>
        </nav>
    </div>
    <div>
        <?= $this->render('/layouts/nav-right') ?>
    </div>
</div>

<div class="main-body p-3" id="app">
    <form class="form" method="post" autocomplete="off">
        <div class="form-title"><?= $this->title ?></div>
        <div class="form-body">
            <div class="clearfix">
                <div class="block-title">可选模块列表</div>
                <div class="block-title">小程序端布局预览</div>
                <div class="block-title">操作</div>
            </div>
            <div class="clearfix">
                <div class="module-list" style="max-height: 540px;overflow-y: scroll">
                    <div v-for="(item,i) in module_list" class="module-item" v-bind:data-module-name="item.name">
                        <div style="position: relative;height: 0">
                            <div class="operations">
                                <a href="javascript:" class="operate-icon item-add" v-bind:data-index="i">
                                    <img src="<?= Yii::$app->request->baseUrl ?>/statics/images/icon-add.png">
                                </a>
                            </div>
                        </div>
                        <div v-html="item.content"></div>
                    </div>
                </div>
                <ol class="edit-box" id="sortList" style="max-height: 540px;overflow-y: scroll">
                    <li v-for="(item,i) in edit_list" class="module-item" v-bind:data-module-name="item.name">
                        <div style="position: relative;height: 0">
                            <div class="operations">
                                <a href="javascript:" class="operate-icon drop-btn" v-bind:data-index="i">
                                    <img src="<?= Yii::$app->request->baseUrl ?>/statics/images/icon-move.png">
                                </a>
                                <a href="javascript:" class="operate-icon item-delete" v-bind:data-index="i">
                                    <img src="<?= Yii::$app->request->baseUrl ?>/statics/images/icon-delete.png">
                                </a>
                            </div>
                        </div>
                        <div v-html="item.content"></div>
                    </li>
                </ol>
                <div class="submit-block">
                    <div class="text-danger form-error mb-3" style="display: none">错误信息</div>
                    <div class="text-success form-success mb-3" style="display: none">成功信息</div>
                    <a class="btn btn-primary btn-block submit-btn" href="javascript:">保存</a>
                    <hr>
                    <div class="text-muted">
                        提示：
                        <br>首页板块可以添加到小程序端，如果没有板块可以<a
                                href="<?= $urlManager->createUrl(['mch/store/home-block-edit']) ?>">点击这里添加板块</a>；
                        <br>首页更新小程序端下拉刷新就可以看到。
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!--<script src="<? /*= Yii::$app->request->baseUrl */ ?>/statics/js/jquery-sortable.js"></script>-->
<script src="https://cdn.bootcss.com/Sortable/1.6.0/Sortable.min.js"></script>
<script>
    var app = new Vue({
        el: "#app",
        data: {
            module_list: <?=json_encode($module_list, true)?>,
            edit_list: <?=json_encode($edit_list, true)?>,
        }
    });
    $(document).on("click", ".item-add", function () {
        var index = $(this).attr("data-index");
        app.edit_list.push(app.module_list[index]);
    });
    $(document).on("click", ".item-delete", function () {
        var index = $(this).attr("data-index");
        var item = $(this).parents(".module-item");
        var timeout = 200;
        item.slideUp(timeout, function () {
            item.addClass("delete");
            app.edit_list[index].delete = true;
        });
    });

    //    $(".edit-box").sortable({
    //        handle: ".drop-btn"
    //    });

    Sortable.create(document.getElementById("sortList"), {
        animation: 150,
    }); // That's all.


    $(document).on("click", ".submit-btn", function () {
        //console.log(JSON.stringify(app.edit_list));
        var module_list = [];
        $(".edit-box .module-item").each(function (i) {
            if ($(this).hasClass("delete"))
                return;
            module_list.push({
                name: $(this).attr("data-module-name"),
            });
        });
        var btn = $(this);
        var success = $(".form-success");
        var error = $(".form-error");
        success.hide();
        error.hide();
        btn.btnLoading("正在提交");
        $.ajax({
            type: "post",
            dataType: "json",
            data: {
                _csrf: _csrf,
                module_list: JSON.stringify(module_list),
            },
            success: function (res) {
                if (res.code == 0) {
                    success.html(res.msg).show();
                    setTimeout(function () {
                        location.reload();
                    }, 1500);
                }
                if (res.code == 1) {
                    error.html(res.msg).show();
                }
            }
        });
    });
</script>