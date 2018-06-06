<?php
defined('YII_RUN') or exit('Access Denied');
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/6/19
 * Time: 16:52
 */
$urlManager = Yii::$app->urlManager;
$this->title = '广告设置';
$this->params['active_nav_group'] = 10;
$this->params['is_group'] = 1;
?>
<style>
</style>
<div class="main-nav" flex="cross:center dir:left box:first">
    <div>
        <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/index']) ?>">我的商城</a>
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/group/index/index']) ?>">拼团</a>
            <span class="breadcrumb-item active"><?= $this->title ?></span>
        </nav>
    </div>
    <div>
        <?= $this->render('/layouts/nav-right') ?>
    </div>
</div>

<div class="main-body p-3" id="app">
    <form class="card auto-submit-form" method="post" autocomplete="off">
        <div class="card-header"><?= $this->title ?></div>
        <div class="card-block">


            <div class="form-group row">
                <div class="col-2 text-right">
                    <label class=" col-form-label">广告图示例</label>
                </div>
                <div class="col-9">
                    <img src="<?= Yii::$app->request->baseUrl ?>/statics/images/img-block-demo.png" style="width: 100%">
                </div>
            </div>


            <div class="form-group row">
                <div class="col-2 text-right">
                    <label class=" col-form-label">注</label>
                </div>
                <div class="col-9" style="padding-top: calc(.5rem - 1px * 2);">只放一张图片时小程序端不会对图片裁剪，图片宽度填充屏幕宽度，高度自适应</div>
            </div>

            <div class="form-group row">
                <div class="col-2 text-right">
                    <label class=" col-form-label">广告图片</label>
                </div>
                <div class="col-9">

                    <div class="row mb-3" v-for="(item,i) in pic_list">
                        <div class="col-sm-5">
                            <div class="input-group">
                                <div class="input-group-addon">图片</div>
                                <div class="input-group-addon" style="padding: 0">
                                    <img v-bind:src="item.pic_url" style="height:32px;width: 34px;">
                                </div>
                                <input class="form-control"
                                       v-bind:name="'pic_list['+i+'][pic_url]'"
                                       v-model="item.pic_url">
                                <div class="input-group-btn">
                                    <a class="btn btn-secondary pic-upload"
                                       v-bind:data-index="i"
                                       href="javascript:">上传</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="input-group page-link-input">
                                <input class="form-control link-input"
                                       v-bind:index="i"
                                       v-bind:name="'pic_list['+i+'][url]'"
                                       v-model:value="item.url"
                                       value="<?= $store->copyright_url ?>">
                                <input class="link-open-type"
                                       v-bind:index="i"
                                       v-bind:name="'pic_list['+i+'][open_type]'"
                                       v-model:value="item.open_type"
                                       type="hidden">
                                <span class="input-group-btn">
                                        <a class="btn btn-secondary pick-link-btn" href="javascript:"
                                           open-type="navigate,wxapp">选择链接</a>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-2 text-right">
                            <a class="btn btn-danger pic-delete" v-bind:data-index="i" href="javascript:">删除</a>
                        </div>
                    </div>
                    <a v-if="pic_list.length<4" class="btn btn-secondary add-pic" href="javascript:">添加</a>
                    <div v-else class="text-muted">最多上传4张图片</div>
                </div>
            </div>


            <div class="form-group row">
                <div class="col-sm-6 offset-md-3">
                    <div class="text-danger form-error mb-3" style="display: none">错误信息</div>
                    <div class="text-success form-success mb-3" style="display: none">成功信息</div>
                    <a class="btn btn-primary submit-btn" href="javascript:">保存</a>
                </div>
            </div>
        </div>

    </form>

</div>
<?php
if (empty($pic_list)) {
    $pic_list = [
        [
            'pic_url' => '',
            'url' => '',
        ],
    ];
}
?>
<script>
    var upload_url = "<?=$urlManager->createUrl(['upload/image'])?>";
    var app = new Vue({
        el: "#app",
        data: {
            pic_list: <?=json_encode($pic_list, JSON_UNESCAPED_UNICODE)?>,
        }
    });

    $(document).on("click", ".pic-delete", function () {
        var i = $(this).attr("data-index");
        app.pic_list.splice(i, 1);
    });

    $(document).on("click", ".add-pic", function () {
        app.pic_list.push({
            pic_url: '',
            url: '',
        });
        setTimeout(function () {
            setPlUpload();
        }, 100);
    });

    $(document).on("change", ".link-input", function () {
        var index = $(this).attr("index");
        app.pic_list[index].url = $(this).val();
    });

    $(document).on("change", ".link-open-type", function () {
        var index = $(this).attr("index");
        app.pic_list[index].open_type = $(this).val();
    });

    function setPlUpload() {
        $(".pic-upload").plupload({
            url: upload_url,
            beforeUpload: function ($this, _this) {
                console.log($this);
                $($this).btnLoading("Loading");
            },
            success: function (res, _this, $this) {
                $($this).btnReset().text("上传");
                if (res.code == 0) {
                    var i = $(_this).attr("data-index");
                    app.pic_list[i].pic_url = res.data.url;
                }
            }
        });
    }

    setTimeout(function () {
        setPlUpload();
    }, 1);
</script>