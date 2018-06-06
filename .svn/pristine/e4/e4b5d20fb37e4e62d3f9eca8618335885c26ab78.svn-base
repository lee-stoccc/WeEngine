<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/4
 * Time: 10:40
 */
defined('YII_RUN') or exit('Access Denied');
use yii\widgets\LinkPager;
$urlManager = Yii::$app->urlManager;
$this->title = '视频设置';
$this->params['active_nav_group'] = 9;
$statics = Yii::$app->request->baseUrl.'/statics';
?>
<div class="main-nav" flex="cross:center dir:left box:first">
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

    <a href="<?= $urlManager->createAbsoluteUrl(['mch/store/video-edit']) ?>" class="btn btn-primary mb-3">
        <i class="iconfont icon-playlistadd"></i>添加视频</a>
    <div style="overflow-x: hidden">
        <div class="row">
            <?php foreach ($list as $index => $value): ?>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card mb-3">
                        <div class="card-img-top">
                            <a href="<?=$value['url']?>" target="_blank">
                                <div class="card-img-top" data-responsive="730:432" style="background-image: url(<?= $value['pic_url'] ?>);background-size: cover;background-position: center"></div>
                            </a>
                            <!--
                            <video width="320" height="240" controls="controls">
                                <source src="<?=$value['url']?>" type="video/mp4" />
                                <source src="<?=$value['url']?>" type="video/ogg" />
                                <source src="<?=$value['url']?>" type="video/webm" />
                                <object data="<?=$value['url']?>" width="320" height="240">
                                    <embed src="<?=$value['url']?>" width="320" height="240" />
                                </object>
                            </video>
                            -->
                        </div>
                        <div class="card-body p-3">
                            <p>标题：<?= $value['title'] ?></p>
                            <p>排序：<?= $value['sort'] ?></p>
                        </div>

                        <div class="card-footer text-muted">
                            <a class="btn btn-sm btn-primary"
                               href="<?= $urlManager->createAbsoluteUrl(['mch/store/video-edit', 'id' => $value['id']]) ?>">修改</a>
                            <a class="btn btn-sm btn-danger del"
                               href="<?= $urlManager->createAbsoluteUrl(['mch/store/video-del', 'id' => $value['id']]) ?>">删除</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <nav aria-label="Page navigation example">
        <?php echo LinkPager::widget([
            'pagination' => $pagination,
            'prevPageLabel' => '上一页',
            'nextPageLabel' => '下一页',
            'firstPageLabel' => '首页',
            'lastPageLabel' => '尾页',
            'maxButtonCount' => 5,
            'options' => [
                'class' => 'pagination',
            ],
            'prevPageCssClass' => 'page-item',
            'pageCssClass' => "page-item",
            'nextPageCssClass' => 'page-item',
            'firstPageCssClass' => 'page-item',
            'lastPageCssClass' => 'page-item',
            'linkOptions' => [
                'class' => 'page-link',
            ],
            'disabledListItemSubTagOptions' => ['tag' => 'a', 'class' => 'page-link'],
        ])
        ?>
    </nav>
</div>
<script>
    $(document).on('click', '.del', function () {
        if (confirm("是否删除？")) {
            $.ajax({
                url: $(this).attr('href'),
                type: 'get',
                dataType: 'json',
                success: function (res) {
                    alert(res.msg);
                    if (res.code == 0) {
                        window.location.reload();
                    }
                }
            });
        }
        return false;
    });
</script>
