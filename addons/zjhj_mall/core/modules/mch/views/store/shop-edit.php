<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/9
 * Time: 9:09
 */
defined('YII_RUN') or exit('Access Denied');
$urlManager = Yii::$app->urlManager;
$this->title = '编辑门店';
$this->params['active_nav_group'] = 1;
?>

<script charset="utf-8" src="https://map.qq.com/api/js?v=2.exp&key=key=OB4BZ-D4W3U-B7VVO-4PJWW-6TKDJ-WPB77"></script>
<div class="main-nav" flex="cross:center dir:left box:first">
    <div>
        <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/index']) ?>">我的商城</a>
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/shop']) ?>">门店列表</a>
            <span class="breadcrumb-item active"><?= $this->title ?></span>
        </nav>
    </div>
    <div>
        <?= $this->render('/layouts/nav-right') ?>
    </div>
</div>
<div class="main-body p-3 bg-white">
    <form class="form auto-submit-form" method="post" autocomplete="off" style="display: inline-block;width: 45%;"
          data-return="<?= $urlManager->createUrl(['mch/store/shop']) ?>">
        <div class="form-title">门店编辑</div>
        <div class="form-body">
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required">门店名称：</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="text" name="name" value="<?=$shop->name?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required">联系方式：</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="text" name="mobile" value="<?=$shop->mobile?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required">联系地址：</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="text" name="address" value="<?=$shop->address?>">
                    <input class="form-control" type="hidden" name="longitude" value="<?=$shop->longitude?>">
                    <input class="form-control" type="hidden" name="latitude" value="<?=$shop->latitude?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class="col-form-label">门店大图：</label>
                </div>
                <div class="col-9">
                    <?= \app\widgets\ImageUpload::widget([
                        'name' => 'cover_url',
                        'value' => $shop->cover_url,
                        'width' => 750,
                        'height' => 360,
                    ]) ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class="col-form-label">门店小图：</label>
                </div>
                <div class="col-9">
                    <?= \app\widgets\ImageUpload::widget([
                        'name' => 'pic_url',
                        'value' => $shop->pic_url,
                        'width' => 150,
                        'height' => 150,
                    ]) ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">评分：</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="number" name="score" min="1" max="5" value="<?=$shop->score?$shop->score:5?>">
                    <div class="text-danger">仅支持1~5的评分</div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">营业时间：</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="text" name="shop_time" value="<?=$shop->shop_time?>">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">门店介绍：</label>
                </div>
                <div class="col-9">
                            <textarea class="short-row" id="editor"
                                      name="content"><?=$shop->content?></textarea>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-9 offset-sm-3">
                    <div class="text-danger form-error mb-3" style="display: none">错误信息</div>
                    <div class="text-success form-success mb-3" style="display: none">成功信息</div>
                    <a class="btn btn-primary submit-btn" href="javascript:">保存</a>
                    <a class="btn btn-danger" href="<?=$urlManager->createUrl(['mch/store/shop'])?>">返回列表</a>
                </div>
            </div>
        </div>
    </form>
    <div style="display: inline-block;vertical-align: top;width: 45%">
        <div class="form-group row map">
            <div class="offset-2 col-9">
                <div class="input-group" style="margin-top: 20px;">
                    <input class="form-control region" type="text" placeholder="城市">
                    <span class="input-group-addon ">和</span>
                    <input class="form-control keyword" type="text" placeholder="关键字">
                    <a class="input-group-addon search" href="javascript:">搜索</a>
                </div>
                <div class="text-info">搜索时城市和关键字必填</div>
                <div class="text-info">点击地图上的蓝色点，获取经纬度</div>
                <div class="text-danger map-error mb-3" style="display: none">错误信息</div>
                <div id="container" style="min-width:600px;min-height:600px;"></div>
            </div>
        </div>

    </div>
</div>

<script src="<?= Yii::$app->request->baseUrl ?>/statics/ueditor/ueditor.config.js"></script>
<script src="<?= Yii::$app->request->baseUrl ?>/statics/ueditor/ueditor.all.min.js"></script>
<script>
    var ue = UE.getEditor('editor', {
        serverUrl: "<?=$urlManager->createUrl(['upload/ue'])?>",
        enableAutoSave: false,
        saveInterval: 1000 * 3600,
        enableContextMenu: false,
        autoHeightEnabled: false,
    });
</script>
<script>

    var searchService, map, markers = [];
//        window.onload = function(){
    //直接加载地图
    //初始化地图函数  自定义函数名init
    function init() {
        //定义map变量 调用 qq.maps.Map() 构造函数   获取地图显示容器
        var map = new qq.maps.Map(document.getElementById("container"), {
            center: new qq.maps.LatLng(39.916527, 116.397128),      // 地图的中心地理坐标。
            zoom: 15                                                 // 地图的中心地理坐标。
        });
        var latlngBounds = new qq.maps.LatLngBounds();
        //调用Poi检索类
        searchService = new qq.maps.SearchService({
            complete: function (results) {
                var pois = results.detail.pois;
                $('.map-error').hide();
                if (!pois) {
                    $('.map-error').show().html('关键字搜索不到，请重新输入');
                    return;
                }
                for (var i = 0, l = pois.length; i < l; i++) {
                    (function (n) {
                        var poi = pois[n];
                        latlngBounds.extend(poi.latLng);
                        var marker = new qq.maps.Marker({
                            map: map,
                            position: poi.latLng,
                        });

                        marker.setTitle(n + 1);

                        markers.push(marker);
                        //添加监听事件
                        qq.maps.event.addListener(marker, 'click', function (e) {
                            var address = poi.address;
                            $("input[name='address']").val(address);
                            $("input[name='longitude']").val(e.latLng.lng);
                            $("input[name='latitude']").val(e.latLng.lat);
                        });
                    })(i);
                }
                map.fitBounds(latlngBounds);
            }
        });
    }
    //清除地图上的marker
    function clearOverlays(overlays) {
        var overlay;
        while (overlay = overlays.pop()) {
            overlay.setMap(null);
        }
    }
    function searchKeyword() {
        var keyword = $(".keyword").val();
        var region = $(".region").val();
        clearOverlays(markers);
        searchService.setLocation(region);
        searchService.search(keyword);
    }

    //调用初始化函数地图
            init();


//        }
</script>
<script>
    $(document).on('click', '.search', function () {
        searchKeyword();
    })
</script>