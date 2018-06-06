<?php
defined('YII_RUN') or exit('Access Denied');
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/6/19
 * Time: 16:52
 */
use \app\models\Option;
$urlManager = Yii::$app->urlManager;
$this->title = '商城设置';
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

<div class="main-body p-3">
    <form class="form auto-submit-form" method="post" autocomplete="off">
        <div class="form-title">商城设置</div>
        <div class="form-body">
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required">商城名称</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="text" name="name" value="<?= $store->name ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required">小程序AppId</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="text" name="app_id" value="<?= $wechat_app->app_id ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required">小程序AppSecret</label>
                </div>
                <div class="col-9">
                    <?php if ($wechat_app->app_secret): ?>
                        <div class="input-hide">
                            <input class="form-control" type="text" name="app_secret"
                                   value="<?= $wechat_app->app_secret ?>">
                            <div class="tip-block">已隐藏AppSecret，点击查看或编辑</div>
                        </div>
                    <?php else: ?>
                        <input class="form-control" type="text" name="app_secret"
                               value="<?= $wechat_app->app_secret ?>">
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required">微信支付商户号</label>
                </div>
                <div class="col-9">
                    <input autocomplete="off" class="form-control" type="text" name="mch_id"
                           value="<?= $wechat_app->mch_id ?>">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required">微信支付Api密钥</label>
                </div>
                <div class="col-9">
                    <?php if ($wechat_app->key): ?>
                        <div class="input-hide">
                            <input class="form-control" type="text" name="key"
                                   value="<?= $wechat_app->key ?>">
                            <div class="tip-block">已隐藏Key，点击查看或编辑</div>
                        </div>
                    <?php else: ?>
                        <input class="form-control" type="text" name="key"
                               value="<?= $wechat_app->key ?>">
                    <?php endif; ?>

                </div>
            </div>

            <div class="form-group row" style="display: none">
                <div class="col-3 text-right">
                    <label class=" col-form-label">微信支付apiclient_cert.pem</label>
                </div>
                <div class="col-9">
                    <?php if ($wechat_app->cert_pem): ?>
                        <div class="input-hide">
                            <textarea class="form-control" type="text"
                                      rows="3"
                                      placeholder="请将apiclient_cert.pem文件里面的内容粘贴到此处"
                                      name="cert_pem"><?= $wechat_app->cert_pem ?></textarea>
                            <div class="tip-block">已隐藏Key，点击查看或编辑</div>
                        </div>
                    <?php else: ?>
                        <textarea class="form-control" type="text"
                                  rows="3"
                                  placeholder="请将apiclient_cert.pem文件里面的内容粘贴到此处"
                                  name="cert_pem"><?= $wechat_app->cert_pem ?></textarea>
                    <?php endif; ?>
                    <div class="text-muted fs-sm">如果无需退款请填写0</div>
                </div>
            </div>

            <div class="form-group row" style="display: none">
                <div class="col-3 text-right">
                    <label class=" col-form-label">微信支付apiclient_key.pem</label>
                </div>
                <div class="col-9">
                    <?php if ($wechat_app->key_pem): ?>
                        <div class="input-hide">
                            <textarea class="form-control" type="text"
                                      rows="3"
                                      placeholder="请将apiclient_cert.pem文件里面的内容粘贴到此处"
                                      name="key_pem"><?= $wechat_app->key_pem ?></textarea>
                            <div class="tip-block">已隐藏Key，点击查看或编辑</div>
                        </div>
                    <?php else: ?>
                        <textarea class="form-control" type="text"
                                  rows="3"
                                  placeholder="请将apiclient_key.pem文件里面的内容粘贴到此处"
                                  name="key_pem"><?= $wechat_app->key_pem ?></textarea>
                    <?php endif; ?>
                    <div class="text-muted fs-sm">如果无需退款请填写0</div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">联系电话</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="text" name="contact_tel"
                           value="<?= $store->contact_tel ?>">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">开启在线客服</label>
                </div>
                <div class="col-9">
                    <div class="pt-1">
                        <label class="custom-control custom-radio">
                            <input id="radio1" <?= $store->show_customer_service == 1 ? 'checked' : null ?>
                                   value="1"
                                   name="show_customer_service" type="radio" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">开启</span>
                        </label>
                        <label class="custom-control custom-radio">
                            <input id="radio2" <?= $store->show_customer_service == 0 ? 'checked' : null ?>
                                   value="0"
                                   name="show_customer_service" type="radio" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">关闭</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">客服图标</label>
                </div>
                <div class="col-9">
                    <?= \app\widgets\ImageUpload::widget([
                        'name' => 'service',
                        'value' => Option::get('service',$store->id,'admin'),
                        'width' => 100,
                        'height' => 100,
                    ]) ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">底部版权图片</label>
                </div>
                <div class="col-9">
                    <?= \app\widgets\ImageUpload::widget([
                        'name' => 'copyright_pic_url',
                        'value' => $store->copyright_pic_url,
                        'width' => 120,
                        'height' => 60,
                    ]) ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">底部版权文字</label>
                </div>
                <div class="col-9">
                    <input class="form-control" name="copyright"
                           value="速用科技提供技术支持" readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">底部版权页面链接</label>
                </div>
                <div class="col-9">
                    <div class="input-group page-link-input">
                        <input class="form-control link-input"
                               name="copyright_url"
                               value="www.suyongw.com" readonly>
                        <span class="input-group-btn">
                            <a class="btn btn-secondary pick-link-btn" href="javascript:" open-type="navigate">选择链接</a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">收货时间</label>
                </div>
                <div class="col-9">
                    <div class="input-group">
                        <input class="form-control" type="number" name="delivery_time"
                               value="<?= $store->delivery_time ?>">
                        <span class="input-group-addon">天</span>
                    </div>
                    <div class="text-muted fs-sm">从发货到自动确认收货的时间</div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">售后时间</label>
                </div>
                <div class="col-9">
                    <div class="input-group">
                        <input class="form-control" type="number" name="after_sale_time"
                               value="<?= $store->after_sale_time ?>">
                        <span class="input-group-addon">天</span>
                    </div>
                    <div class="text-muted fs-sm">可以申请售后的时间，<span class="text-danger">注意：分销订单中的已完成订单，只有订单已确认收货，并且时间超过设置的售后天数之后才计入其中！</span>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">快递鸟商户ID</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="text" name="kdniao_mch_id"
                           value="<?= $store->kdniao_mch_id ?>">
                    <div class="text-muted fs-sm">用于获取物流信息，<a target="_blank" href="http://www.kdniao.com/">快递鸟接口申请</a>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">快递鸟API KEY</label>
                </div>
                <div class="col-9">
                    <input class="form-control" type="text" name="kdniao_api_key"
                           value="<?= $store->kdniao_api_key ?>">
                </div>
            </div>


            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">分类页面样式</label>
                </div>
                <div class="col-9" style="padding-top: calc(.5rem - 1px * 2);">
                    <label class="custom-control custom-radio">
                        <input id="radio1" <?= $store->cat_style == 1 ? 'checked' : null ?>
                               value="1"
                               name="cat_style" type="radio" class="custom-control-input">
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">大图模式（不显示侧栏）</span>
                    </label>
                    <label class="custom-control custom-radio">
                        <input id="radio2" <?= $store->cat_style == 2 ? 'checked' : null ?>
                               value="2"
                               name="cat_style" type="radio" class="custom-control-input">
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">大图模式（显示侧栏）</span>
                    </label>
                    <label class="custom-control custom-radio">
                        <input id="radio2" <?= $store->cat_style == 3 ? 'checked' : null ?>
                               value="3"
                               name="cat_style" type="radio" class="custom-control-input">
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">小图标模式（不显示侧栏）</span>
                    </label>
                    <label class="custom-control custom-radio">
                        <input id="radio2" <?= $store->cat_style == 4 ? 'checked' : null ?>
                               value="4"
                               name="cat_style" type="radio" class="custom-control-input">
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">小图标模式（显示侧栏）</span>
                    </label>
                    <div hidden class="text-muted fs-sm"><a href="javascript:" data-toggle="modal"
                                                            data-target="#catTypeModal">分类样式示意图</a></div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">首页分类商品每行个数</label>
                </div>
                <div class="col-9">
                    <select class="form-control" name="cat_goods_cols">
                        <option value="2" <?= $store->cat_goods_cols == 2 ? 'selected' : null ?> >2</option>
                        <option value="3" <?= $store->cat_goods_cols == 3 ? 'selected' : null ?> >3</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required">首页分类商品显示个数</label>
                </div>
                <div class="col-9">
                    <div class="input-group">
                        <input class="form-control" type="number" name="cat_goods_count"
                               value="<?= $store->cat_goods_count ?>">
                        <span class="input-group-addon">个</span>
                    </div>
                    <div class="text-muted fs-sm">每个分类板块显示的商品最大数量</div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">未支付订单超时时间</label>
                </div>
                <div class="col-9">
                    <div class="input-group">
                        <input class="form-control" type="number" name="over_day"
                               value="<?= $store->over_day ?>">
                        <span class="input-group-addon">小时</span>
                    </div>
                    <div class="text-danger text-muted fs-sm">注意：时间设置为0则表示不开启自动删除未支付订单功能</div>
                </div>
            </div>

            <div class="form-group row" hidden>
                <div class="col-3 text-right">
                    <label class=" col-form-label">开启线下自提</label>
                </div>
                <div class="col-9">
                    <div class="pt-1">
                        <label class="custom-control custom-radio">
                            <input id="radio1" <?= $store->is_offline == 1 ? 'checked' : null ?>
                                   value="1"
                                   name="is_offline" type="radio" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">开启</span>
                        </label>
                        <label class="custom-control custom-radio">
                            <input id="radio2" <?= $store->is_offline == 0 ? 'checked' : null ?>
                                   value="0"
                                   name="is_offline" type="radio" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">关闭</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">发货方式</label>
                </div>
                <div class="col-9">
                    <div class="pt-1">
                        <label class="custom-control custom-radio">
                            <input id="radio1" <?= $store->send_type == 0 ? 'checked' : null ?>
                                   value="0"
                                   name="send_type" type="radio" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">快递或自提</span>
                        </label>
                        <label class="custom-control custom-radio">
                            <input id="radio1" <?= $store->send_type == 1 ? 'checked' : null ?>
                                   value="1"
                                   name="send_type" type="radio" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">仅快递</span>
                        </label>
                        <label class="custom-control custom-radio">
                            <input id="radio1" <?= $store->send_type == 2 ? 'checked' : null ?>
                                   value="2"
                                   name="send_type" type="radio" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">仅自提</span>
                        </label>
                    </div>
                    <div class="text-muted fs-sm">自提需要设置门店，如果您还未设置门店请保存本页后前往  “门店设置”  进行设置。
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">开启领券中心</label>
                </div>
                <div class="col-9">
                    <div class="pt-1">
                        <label class="custom-control custom-radio">
                            <input id="radio1" <?= $store->is_coupon == 1 ? 'checked' : null ?>
                                   value="1"
                                   name="is_coupon" type="radio" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">开启</span>
                        </label>
                        <label class="custom-control custom-radio">
                            <input id="radio2" <?= $store->is_coupon == 0 ? 'checked' : null ?>
                                   value="0"
                                   name="is_coupon" type="radio" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">关闭</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">首页导航栏一行个数</label>
                </div>
                <div class="col-9">
                    <div class="pt-1">
                        <label class="custom-control custom-radio">
                            <input id="radio1" <?= $store->nav_count == 0 ? 'checked' : null ?>
                                   value="0"
                                   name="nav_count" type="radio" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">开启4个</span>
                        </label>
                        <label class="custom-control custom-radio">
                            <input id="radio2" <?= $store->nav_count == 1 ? 'checked' : null ?>
                                   value="1"
                                   name="nav_count" type="radio" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">开启5个</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label">会员积分</label>
                </div>
                <div class="col-9">
                    <div class="input-group short-row">
                        <input type="number" step="1" class="form-control short-row" name="integral"
                               value="<?= $store->integral?:10 ?>">
                        <span class="input-group-addon">积分抵扣1元</span>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class=" col-form-label required">会员积分使用规则</label>
                </div>
                <div class="col-9">
                    <textarea class="form-control" type="text"
                              rows="3"
                              placeholder="请填写积分使用规则"
                              name="integration"><?= $store->integration ?></textarea>
                    <div class="text-muted fs-sm">积分使用规则用于用户结算页说明显示，为了更好体验字数最好不要超过80字</div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-3 text-right">
                    <label class="col-form-label">商城首页公告</label>
                </div>
                <div class="col-9">
                    <textarea class="form-control" type="text"
                              rows="3"
                              placeholder="请填写商城公告"
                              name="notice"><?=Option::get('notice',$store->id,'admin')?></textarea>
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
<div class="modal fade" id="catTypeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">分类页样式示例</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>