<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/3
 * Time: 13:42
 */
defined('YII_RUN') or exit('Access Denied');
use \app\models\User;
use \app\models\Level;

/* @var \app\models\User $user */
/* @var \app\models\Level[] $level */
$urlManager = Yii::$app->urlManager;
$this->title = '会员编辑';
$this->params['active_nav_group'] = 4;
?>
<div class="main-nav" flex="cross:center dir:left box:first">
    <div>
        <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
            <a flex="cross:center" class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store']) ?>">我的商城</a>
            <a flex="cross:center" class="breadcrumb-item"
               href="<?= $urlManager->createUrl(['mch/user/index']) ?>">会员列表</a>
            <span flex="cross:center" class="breadcrumb-item active"><?= $this->title ?></span>
        </nav>
    </div>
    <div>
        <?= $this->render('/layouts/nav-right') ?>
    </div>
</div>
<div class="main-body p-3">
    <div class="">
        <form method="post" class="form auto-submit-form" autocomplete="off" data-return="<?=$urlManager->createUrl(['mch/user/index'])?>">
            <div class="form-title">会员编辑</div>
            <div class="form-body">
                <div class="form-group row">
                    <div class="col-2 text-right">
                        <label class="col-form-label">会员</label>
                    </div>
                    <div class="col-5">
                        <div>
                            <img src="<?=$user->avatar_url?>" style="width: 50px;height:50px;">
                            <span><?=$user->nickname?></span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-2 text-right">
                        <label class="col-form-label required">会员等级</label>
                    </div>
                    <div class="col-2">
                        <select class="form-control" name="level">
                            <option value="-1" <?=$user->level==-1?"selected":""?>>普通用户</option>
                            <?php foreach ($level as $value): ?>
                                <option
                                    value="<?= $value->level ?>" <?= ($value->level == $user->level) ? "selected" : "" ?>><?= $value->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-2 text-right">
                        <label class="col-form-label">注册时间</label>
                    </div>
                    <div class="col-5">
                        <label class="col-form-label"><?=date('Y-m-d H:i',$user->addtime);?></label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-2 col-5">
                        <div class="text-danger form-error mb-3" style="display: none">错误信息</div>
                        <div class="text-success form-success mb-3" style="display: none">成功信息</div>
                        <a class="btn btn-primary submit-btn" href="javascript:">提交</a>
                        <a class="btn btn-outline-primary" href="<?=$urlManager->createUrl(['mch/user/index'])?>">返回列表</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
