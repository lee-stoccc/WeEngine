<?php
defined('YII_RUN') or exit('Access Denied');
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/6/19
 * Time: 16:52
 */
$cat = [
    1 => '关于我们',
    2 => '服务中心',
];
$cat_id = Yii::$app->request->get('cat_id', 2);
$urlManager = Yii::$app->urlManager;
$this->title = '拼团规则';
$this->params['active_nav_group'] = 10;
$this->params['is_group'] = 1;

$returnUrl = Yii::$app->request->referrer;
if (!$returnUrl)
    $returnUrl = $urlManager->createUrl(['mch/group/article/edit']);
?>

<div class="main-nav" flex="cross:center dir:left box:first" style="display: none">
    <div>
        <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
            <a flex="cross:center" class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store']) ?>">我的商城</a>
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/group/index/index']) ?>">拼团管理</a>
            <span flex="cross:center" class="breadcrumb-item active"><?= $this->title ?></span>
        </nav>
    </div>
    <div>
        <?= $this->render('/layouts/nav-right') ?>
    </div>
</div>

<div class="main-body p-3">
    <form class="form auto-submit-form" method="post" autocomplete="off" data-return="<?= $returnUrl ?>">
        <div class="form-title"><?= $this->title ?></div>
        <div class="form-body">


            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required">标题</label>
                </div>
                <div class="col-9">
                    <div class="input-group">
                        <input readonly class="form-control cat-name" name="title" value="<?= $model->title?:'拼团规则'?>">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class="col-form-label required">排序</label>
                </div>
                <div class="col-9">
                    <div class="input-group">
                        <input class="form-control cat-name" name="sort"
                               value="<?= $model->sort ? $model->sort : 100 ?>">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required">内容</label>
                </div>
                <div class="col-9">
                    <div class="input-group">
                        <textarea id="editor" style="width: 100%"
                                  name="content"><?= $model->content ?></textarea>
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
<script src="<?= Yii::$app->request->baseUrl ?>/statics/ueditor/ueditor.config.js"></script>
<script src="<?= Yii::$app->request->baseUrl ?>/statics/ueditor/ueditor.all.min.js"></script>
<script>
    var ue = UE.getEditor('editor', {
        serverUrl: "<?=$urlManager->createUrl(['upload/ue'])?>",
    });
</script>