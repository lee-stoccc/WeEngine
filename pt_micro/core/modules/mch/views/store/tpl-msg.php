<?php
defined('YII_RUN') or exit('Access Denied');
/**
 * Created by IDEA.
 * User: luwei
 * Date: 2017年9月20日
 * Time: 16点53分
 */
/* @var \app\models\WechatTemplateMessage $model */

$urlManager = Yii::$app->urlManager;
$this->title = '通知设置';
$this->params['active_nav_group'] = 1;
?>
<div class="main-nav" flex="cross:center dir:left box:first" style="display: none">
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

<div class="main-body p-3" id="app">
    <form class="form auto-submit-form" method="post" autocomplete="off"
          data-return="<?= Yii::$app->request->absoluteUrl ?>">
        <div class="form-title"><?= $this->title ?></div>
        <div class="form-body">

            <div class="form-group row">
                <div class="col-3 text-right">
                </div>
                <div class="col-9">
                    <div class="alert alert-warning">注：因微信限制，每个支付订单最多只能发送<b>3</b>条模板消息，如不需要发送模板消息的请留空。</div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">支付通知模板消息id</label>
                </div>
                <div class="col-9">
                    <input class="form-control" value="<?= $model->pay_tpl ?>" name="pay_tpl">
                    <div class="fs-sm text-muted">
                        <span>用户支付完成后向用户发送消息，</span>
                        <a href="javascript:" data-toggle="modal" data-target="#pay_tpl">如何获取支付通知模板消息id</a>
                    </div>
                </div>
            </div>


            <!-- 未支付无法发送模板消息，待定 -->
            <div class="form-group row" hidden>
                <div class="col-3 text-right">
                    <label class=" col-form-label">订单未支付通知模板消息id</label>
                </div>
                <div class="col-9">
                    <input class="form-control" value="<?= $model->not_pay_tpl ?>" name="not_pay_tpl">
                    <a href="javascript:" class="fs-sm" data-toggle="modal"
                       data-target="#not_pay_tpl">如何获取订单未支付通知模板消息id</a>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">订单取消通知模板消息id</label>
                </div>
                <div class="col-9">
                    <input class="form-control" value="<?= $model->revoke_tpl ?>" name="revoke_tpl">
                    <div class="fs-sm text-muted">
                        <span>用户取消订单后向用户发送消息，若订单已付款则在后台审核通过后向用户发送消息，</span>
                        <a href="javascript:" class="fs-sm" data-toggle="modal"
                           data-target="#revoke_tpl">如何获取订单取消通知模板消息id</a>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">发货通知模板消息id</label>
                </div>
                <div class="col-9">
                    <input class="form-control" value="<?= $model->send_tpl ?>" name="send_tpl">
                    <div class="fs-sm text-muted">
                        <span>后台发货后向用户发送消息，</span>
                        <a href="javascript:" class="fs-sm" data-toggle="modal"
                           data-target="#send_tpl">如何获取发货通知模板消息id</a>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">退款通知模板消息id</label>
                </div>
                <div class="col-9">
                    <input class="form-control" value="<?= $model->refund_tpl ?>" name="refund_tpl">
                    <div class="fs-sm text-muted">
                        <span>退款订单后台处理完成后向用户发送消息，</span>
                        <a href="javascript:" class="fs-sm" data-toggle="modal"
                           data-target="#refund_tpl">如何获取退款通知模板消息id</a>
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

<!-- Modal -->
<div class="modal fade" id="pay_tpl" data-backdrop="static" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">如何获取支付通知模板消息id</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ol class="pl-3">
                    <li>
                        <div>进入微信小程序官方后台，找到模板库</div>
                        <div style="text-align: center">
                            <img style="max-width: 100%"
                                 src="<?= Yii::$app->request->baseUrl ?>/statics/images/tplmsg/0.png">
                        </div>
                    </li>
                    <li>
                        <div>查找指定模板，点击选用</div>
                        <div style="text-align: center">
                            <img style="max-width: 100%"
                                 src="<?= Yii::$app->request->baseUrl ?>/statics/images/tplmsg/pay_tpl/1.png">
                        </div>
                    </li>
                    <li>
                        <div>选择下图关键词，并按下图调好顺序；点击提交</div>
                        <div style="text-align: center">
                            <img style="max-width: 100%"
                                 src="<?= Yii::$app->request->baseUrl ?>/statics/images/tplmsg/pay_tpl/2.png">
                        </div>
                    </li>
                    <li>
                        <div>复制模板ID</div>
                        <div style="text-align: center">
                            <img style="max-width: 100%"
                                 src="<?= Yii::$app->request->baseUrl ?>/statics/images/tplmsg/pay_tpl/3.png">
                        </div>
                    </li>
                </ol>
            </div>
            <div class="modal-footer">
                <a href="javascript:" class="btn btn-secondary" data-dismiss="modal">关闭</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="revoke_tpl" data-backdrop="static" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">如何获取订单取消通知模板消息id</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ol class="pl-3">
                    <li>
                        <div>进入微信小程序官方后台，找到模板库</div>
                        <div style="text-align: center">
                            <img style="max-width: 100%"
                                 src="<?= Yii::$app->request->baseUrl ?>/statics/images/tplmsg/0.png">
                        </div>
                    </li>
                    <li>
                        <div>查找指定模板，点击选用</div>
                        <div style="text-align: center">
                            <img style="max-width: 100%"
                                 src="<?= Yii::$app->request->baseUrl ?>/statics/images/tplmsg/revoke_tpl/1.png">
                        </div>
                    </li>
                    <li>
                        <div>选择下图关键词，并按下图调好顺序；点击提交</div>
                        <div style="text-align: center">
                            <img style="max-width: 100%"
                                 src="<?= Yii::$app->request->baseUrl ?>/statics/images/tplmsg/revoke_tpl/2.png">
                        </div>
                    </li>
                    <li>
                        <div>复制模板ID</div>
                        <div style="text-align: center">
                            <img style="max-width: 100%"
                                 src="<?= Yii::$app->request->baseUrl ?>/statics/images/tplmsg/revoke_tpl/3.png">
                        </div>
                    </li>
                </ol>
            </div>
            <div class="modal-footer">
                <a href="javascript:" class="btn btn-secondary" data-dismiss="modal">关闭</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="send_tpl" data-backdrop="static" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">发货通知模板消息id</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ol class="pl-3">
                    <li>
                        <div>进入微信小程序官方后台，找到模板库</div>
                        <div style="text-align: center">
                            <img style="max-width: 100%"
                                 src="<?= Yii::$app->request->baseUrl ?>/statics/images/tplmsg/0.png">
                        </div>
                    </li>
                    <li>
                        <div>查找指定模板，点击选用</div>
                        <div style="text-align: center">
                            <img style="max-width: 100%"
                                 src="<?= Yii::$app->request->baseUrl ?>/statics/images/tplmsg/send_tpl/1.png">
                        </div>
                    </li>
                    <li>
                        <div>选择下图关键词，并按下图调好顺序；点击提交</div>
                        <div style="text-align: center">
                            <img style="max-width: 100%"
                                 src="<?= Yii::$app->request->baseUrl ?>/statics/images/tplmsg/send_tpl/2.png">
                        </div>
                    </li>
                    <li>
                        <div>复制模板ID</div>
                        <div style="text-align: center">
                            <img style="max-width: 100%"
                                 src="<?= Yii::$app->request->baseUrl ?>/statics/images/tplmsg/send_tpl/3.png">
                        </div>
                    </li>
                </ol>
            </div>
            <div class="modal-footer">
                <a href="javascript:" class="btn btn-secondary" data-dismiss="modal">关闭</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="refund_tpl" data-backdrop="static" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">如何获取退款通知模板消息id</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ol class="pl-3">
                    <li>
                        <div>进入微信小程序官方后台，找到模板库</div>
                        <div style="text-align: center">
                            <img style="max-width: 100%"
                                 src="<?= Yii::$app->request->baseUrl ?>/statics/images/tplmsg/0.png">
                        </div>
                    </li>
                    <li>
                        <div>查找指定模板，点击选用</div>
                        <div style="text-align: center">
                            <img style="max-width: 100%"
                                 src="<?= Yii::$app->request->baseUrl ?>/statics/images/tplmsg/refund_tpl/1.png">
                        </div>
                    </li>
                    <li>
                        <div>选择下图关键词，并按下图调好顺序；点击提交</div>
                        <div style="text-align: center">
                            <img style="max-width: 100%"
                                 src="<?= Yii::$app->request->baseUrl ?>/statics/images/tplmsg/refund_tpl/2.png">
                        </div>
                    </li>
                    <li>
                        <div>复制模板ID</div>
                        <div style="text-align: center">
                            <img style="max-width: 100%"
                                 src="<?= Yii::$app->request->baseUrl ?>/statics/images/tplmsg/refund_tpl/3.png">
                        </div>
                    </li>
                </ol>
            </div>
            <div class="modal-footer">
                <a href="javascript:" class="btn btn-secondary" data-dismiss="modal">关闭</a>
            </div>
        </div>
    </div>
</div>