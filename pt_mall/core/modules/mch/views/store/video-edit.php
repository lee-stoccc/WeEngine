<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/4
 * Time: 13:43
 */
defined('YII_RUN') or exit('Access Denied');
$urlManager = Yii::$app->urlManager;
$this->title = '视频编辑';
$this->params['active_nav_group'] = 9;
$statics = Yii::$app->request->baseUrl . '/statics';
?>

<div class="main-nav" flex="cross:center dir:left box:first" style="display: none">
    <div>
        <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/index']) ?>">我的商城</a>
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/video']) ?>">视频设置</a>
            <span class="breadcrumb-item active"><?= $this->title ?></span>
        </nav>
    </div>
    <div>
        <?= $this->render('/layouts/nav-right') ?>
    </div>
</div>

<div class="main-body p-3">
    <form class="form auto-submit-form" method="post" autocomplete="off"
          data-return="<?= $urlManager->createUrl(['mch/store/video']) ?>">
        <div class="form-title">视频编辑</div>
        <div class="form-body">
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">标题</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="text" name="model[title]" value="<?= $list['title'] ?>">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">排序</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="number" step="1" name="model[sort]"
                           value="<?= $list['sort'] ? $list['sort'] : 100 ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="offset-3 col-9 col-form-label text-danger">排序按升序排列</label>
            </div>

            <div class="form-group row type-hide">
                <div class="col-3 text-right">
                    <label class=" col-form-label">视频来源</label>
                </div>
                <div class="col-9">
                    <div class="pt-1">
                        <label class="custom-control custom-radio type">
                            <input id="radio2" <?= $list['type'] == 0 ? 'checked' : null ?>
                                   value="0"
                                   name="model[type]" type="radio" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">源地址</span>
                        </label>
                        <label class="custom-control custom-radio type">
                            <input id="radio1" <?= $list['type'] == 1 ? 'checked' : null ?>
                                   value="1"
                                   name="model[type]" type="radio" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">腾讯</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required">视频链接</label>
                </div>
                <div class="col-9">
                    <div class="video-picker" data-url="<?= $urlManager->createUrl(['upload/video']) ?>">
                        <div class="input-group">
                            <input class="video-picker-input video form-control" name="model[url]"
                                   value="<?= $list['url'] ?>" placeholder="请输入视频源地址或者选择上传视频">
                            <a href="javascript:" class="btn btn-secondary video-picker-btn">选择视频</a>
                        </div>
                        <a class="video-check" href="<?= $list['url'] ? $list['url'] : "javascript:" ?>"
                           target="_blank">视频预览</a>

                        <div class="video-preview"></div>
                        <div><span
                                class="text-danger">支持格式mp4;支持编码H.264;视频大小不能超过<?= \app\models\UploadForm::getMaxUploadSize() ?>
                                M</span></div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required">封面图</label>
                </div>
                <div class="col-9">
                    <?= \app\widgets\ImageUpload::widget([
                        'name' => 'model[pic_url]',
                        'value' => $list['pic_url'],
                        'width' => 750,
                        'height' => 400,
                    ]) ?>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">详情介绍</label>
                </div>
                <div class="col-9">
                    <div>
                        <textarea class="form-control" name="model[content]"><?= $list['content'] ?></textarea>
                    </div>
                    <div class="text-right"><span class="num">0</span>/100</div>
                </div>
            </div>
            <div class="form-group row">
                <label class="offset-3 col-9 col-form-label text-danger"></label>
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

<script type="text/javascript">
    // Custom example logic
    $(document).ready(function () {
        var video_picker = $('.video-picker');
        video_picker.each(function (i) {
            var picker = this;
            var el = $(this);
            var btn = el.find('.video-picker-btn');
            var url = el.data('url');
            var input = el.find('.video-picker-input');
            var view = el.find('.video-preview');

            function uploaderVideo() {

                var el_id = $.randomString(32);
                btn.attr("id", el_id);

                var uploader = new plupload.Uploader({
                    runtimes: 'html5,flash,silverlight,html4',
                    browse_button: el_id, // you can pass an id...
                    url: url,
                    flash_swf_url: '<?=$statics?>/mch/js/Moxie.swf',
                    silverlight_xap_url: '<?=$statics?>/mch/js/Moxie.xap',

                    filters: {
                        max_file_size: '50mb',
                        mime_types: [
                            {title: "Video files", extensions: "mp4"}
                        ]
                    },

                    init: {
                        PostInit: function () {

                        },

                        FilesAdded: function (up, files) {
                            $('.form-error').hide();
                            uploader.start();
                            btn.btnLoading("正在上传");
                            uploader.disableBrowse(true);

                            plupload.each(files, function (file) {
                                console.log(file)
                                view.html('<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>');
                            });
                        },
                        FileUploaded: function (uploader, file, responseObject) {
                            if (responseObject.status == undefined || responseObject.status != 200) {
                                return true;
                            }
                            var res = $.parseJSON(responseObject.response);
                            if (res.code != 0) {
                                $('.form-error').html(res.msg).show();
                                return true;
                            }
                            $(input).val(res.data.url);
                            $('.video-check').prop('href', res.data.url);
                            $('.video-preview').find('span').html('100%');
                        },

                        UploadProgress: function (up, file) {
                            var percent = file.percent - 1;
                            $($("#" + file.id).find('b')[0]).html('<span>' + percent + "%</span>");
//                            document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
                        },

                        Error: function (up, err) {
                            $('.form-error').html('文件大小超出配置').show();
//                            document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
                        },
                        UploadComplete: function (uploader, files) {
                            btn.btnReset();
                            uploader.destroy();
                            uploaderVideo();
                        }
                    }
                });
                uploader.init();
            }

            uploaderVideo();
        });
    });
    $(document).on('change', '.video', function () {
        $('.video-check').attr('href', this.value);
    });
    $('.num').html($("textarea[name='model[content]']").val().length);
    $(document).on('input propertychange', "textarea[name='model[content]']", function () {
        var a = $(this).val().length;
        $('.form-error').hide();
        if (a > 100) {
            var num = $(this).val().substr(0, 100);
            $(this).val(num);
            $('.form-error').html('详情介绍不能超过100个字').show();
        } else {
            $('.num').html(a)
        }
    });
</script>







