<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/AJcommonCssAndJs', TEMPLATE_INCLUDEPATH)) : (include template('web/AJcommonCssAndJs', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
.btn-primary.active {background-color:#04be02;border-color:#04be02;}
.btn-primary {background-color:gray;border-color:gray;}
</style>
<?php 
//是否隐藏过去日期是 否
// if( $settings['fastpos_isopen']==""){
//     $settings['fastpos_isopen']=0;
// }
// if( $settings['is_tuijian']==""){
//     $settings['is_tuijian']=1;
// }
?>
<div class="main">	    
<div class="">
<form action="" class="form-horizontal form" method="post" autocomplete="off">
<input type="hidden" name="id" value="<?php  echo $item['id'];?>">
<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />		



<div class="panel-body">
<div class="form-group">
<label class="col-md-2 control-label">&nbsp;</label>
<div class="col-sm-9">
<button type="submit" class="btn btn-success col-lg-9" name="submit" value="提交">提交参数保存</button>
</div>
</div>
</div>





<div class="panel panel-default">

<div class="panel-heading" id="paoject_info">帐户提现设置<font color="red"></font></div>
<div class="panel-body">


<div class="form-group">

<label class="col-md-2 control-label" for="">是否开启提现</label>
<div class="col-sm-4">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($settings['tx_isopen']==1) { ?>active<?php  } ?>">
<input type="radio" name="tx_isopen" value="1" <?php  if($settings['tx_isopen']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($settings['tx_isopen']==0) { ?>active<?php  } ?>">    
<input type="radio" name="tx_isopen" value="0" <?php  if($settings['tx_isopen']==0) { ?>checked="true"<?php  } ?>>否
</label></div>
</div>



</div>


<div class="form-group">
<label class="col-md-2 control-label">商户支付证书</label>
<div class="col-sm-10">
<textarea class="form-control" name="apiclient_cert" placeholder="为保证安全性, 不显示证书内容. 若要修改, 请直接输入"></textarea> 
<p class="form-control-static" style="color:gray;">
<?php  if($settings['apiclient_cert']!='') { ?>
<font color="green">已保存</font>
<?php  } ?>
从商户平台上下载支付证书, 解压并取得其中的 apiclient_cert.pem 用记事本打开并复制文件内容, 填至此处
<input type="hidden" name="apiclient_cert1" value="<?php  echo $settings['apiclient_cert'];?>" >
</p>
</div>
</div>


<div class="form-group">
<label class="col-md-2 control-label">支付证书私钥</label>
<div class="col-sm-10">
<textarea class="form-control" name="apiclient_key" placeholder="为保证安全性, 不显示证书内容. 若要修改, 请直接输入"></textarea> 
<p class="form-control-static" style="color:gray;">
<?php  if($settings['apiclient_key']!='') { ?>
<font color="green">已保存</font>
<?php  } ?>
从商户平台上下载支付证书, 解压并取得其中的 apiclient_key.pem 用记事本打开并复制文件内容, 填至此处
<input type="hidden" name="apiclient_key1" value="<?php  echo $settings['apiclient_key'];?>" >
</p>
</div>
</div>


<div class="form-group">

<label class="col-md-2 control-label" for="">提现订单是否需要审核</label>
<div class="col-sm-4">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($settings['tx_sh_isopen']==1) { ?>active<?php  } ?>">
<input type="radio" name="tx_sh_isopen" value="1" <?php  if($settings['tx_sh_isopen']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($settings['tx_sh_isopen']==0) { ?>active<?php  } ?>">    
<input type="radio" name="tx_sh_isopen" value="0" <?php  if($settings['tx_sh_isopen']==0) { ?>checked="true"<?php  } ?>>否
</label></div>

<p class="form-control-static" style="color:red;">默认审核,如不审核,商户号余额不足可选择不好体验</p>
</div>

<label class="col-md-2 control-label">提现费率</label>
<div class="col-sm-4">

<div class="input-group">
<span class="input-group-addon">费率</span>
<input type="number" style="text-align:right;" class="form-control" step="0.1" name="money_sxfl" value="<?php  echo $settings['money_sxfl'];?>" />
<span class="input-group-addon">%</span>
</div>

<p class="form-control-static" style="color:gray;">普通微信默认:T+7, 0.6%费率,可自行调整</p>
</div>

</div>

</div>


<div class="panel panel-default">





<?php  if($store_status) { ?>
<div class="panel-heading" id="paoject_info">商家/店铺基础配置<font color="red"></font></div>
<div class="panel-body">


<div class="form-group">
<label class="col-md-2 control-label">店铺-入驻费用</label>
<div class="col-sm-4">

<div class="input-group">
<span class="input-group-addon">入驻</span>
<input type="number" style="text-align:right;" class="form-control" step="0.1" name="pay_money_ruzhu" value="<?php  echo $settings['pay_money_ruzhu'];?>" />
<span class="input-group-addon">元/年</span>
</div>
</div>

<label class="col-md-2 control-label">店铺幻灯图片数量限制</label>
<div class="col-sm-4">
<input type="number"  class="form-control" name="store_imgs_cnt" value="<?php  echo $settings['store_imgs_cnt'];?>" />   
</div>

</div>

<div class="form-group">

<label class="col-md-2 control-label" for="">商品是否需审核</label>
<div class="col-sm-4">
<!-- 
<input type="checkbox" class="form-control" name="goods_sh_isopen" checked="<?php  echo $settings['goods_sh_isopen'];?>"> -->
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($settings['goods_sh_isopen']==1) { ?>active<?php  } ?>">
<input type="radio" name="goods_sh_isopen" value="1" <?php  if($settings['goods_sh_isopen']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($settings['goods_sh_isopen']==0) { ?>active<?php  } ?>">    
<input type="radio" name="goods_sh_isopen" value="0" <?php  if($settings['goods_sh_isopen']==0) { ?>checked="true"<?php  } ?>>否
</label></div>
</div>

<label class="col-md-2 control-label">商品幻灯图片数量限制</label>
<div class="col-sm-4">
<input type="number"  class="form-control" name="goods_imgs_cnt" value="<?php  echo $settings['goods_imgs_cnt'];?>" />   
</div>


</div>

</div>
<?php  } ?>




<?php  if($pinche_status) { ?>
<div class="panel-heading" id="paoject_info">拼车基础配置<font color="red"></font></div>
<div class="panel-body">


<div class="form-group">
<label class="col-md-2 control-label">车找人 发布-帐户保证余额</label>
<div class="col-sm-4">

<div class="input-group">
<span class="input-group-addon">帐户余额大等于</span>
<input type="number" style="text-align:right;" class="form-control" step="0.1" name="account_czr" value="<?php  echo $settings['account_czr'];?>" />
<span class="input-group-addon">元</span>
</div>
</div>


<div class="form-group">
<label class="col-md-2 control-label">车找货 发布-帐户保证余额</label>
<div class="col-sm-4">

<div class="input-group">
<span class="input-group-addon">帐户余额大等于</span>
<input type="number" style="text-align:right;" class="form-control" step="0.1" name="account_czh" value="<?php  echo $settings['account_czh'];?>" />
<span class="input-group-addon">元</span>
</div>
</div>



</div>






<div class="form-group">

<label class="col-md-2 control-label" for="">拼车信息是否审核</label>
<div class="col-sm-4">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($settings['pinche_sh_isopen']==1) { ?>active<?php  } ?>">
<input type="radio" name="pinche_sh_isopen" value="1" <?php  if($settings['pinche_sh_isopen']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($settings['pinche_sh_isopen']==0) { ?>active<?php  } ?>">    
<input type="radio" name="pinche_sh_isopen" value="0" <?php  if($settings['pinche_sh_isopen']==0) { ?>checked="true"<?php  } ?>>否
</label></div>
</div>

</div>

</div>
</div>
<?php  } ?>

<!-- <div class="panel-heading" id="paoject_info">同城基础配置<font color="red"></font></div>
<div class="panel-body">

</div> -->

<div class="panel-heading" id="paoject_info">同城>>) 基础信息设置</div>
<div class="panel-body">
<div class="form-group">

<label class="col-md-2 control-label">信息加载条数</label>
<div class="col-sm-2">

<div class="input-group">
<span class="input-group-addon">每次</span>
<input type="number"  class="form-control" id="page_size" name="page_size" value="<?php  echo $settings['page_size'];?>" />
<span class="input-group-addon">条</span>

</div>
<p class="form-control-static" style="color:gray;">请输入6-10条,不要设置过多</p>
</div>

<label class="col-md-2 control-label">新用户赠送积分</label>
<div class="col-sm-2">   
<div class="input-group">
<input type="number"  step="0.01" class="form-control" name="integral_zs" value="<?php  echo $settings['integral_zs'];?>" />
<span class="input-group-addon">积分</span>
</div>
</div>

<label class="col-md-2 control-label">刷新消息日期扣除</label>
<div class="col-sm-2">   
<div class="input-group">
<input type="number"  class="form-control" step="0.01" name="refresh_money" value="<?php  echo $settings['refresh_money'];?>" />
<span class="input-group-addon">元</span>
</div>
<p class="form-control-static" style="color:gray;">设置0为不扣费用</p>
</div>


</div>

<div class="form-group">
<label class="col-md-2 control-label" for="">发布-(同城)手机号必须</label>
<div class="col-sm-2">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($settings['phone_isopen']==1) { ?>active<?php  } ?>">
<input type="radio" name="phone_isopen" value="1" <?php  if($settings['phone_isopen']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($settings['phone_isopen']==0) { ?>active<?php  } ?>">    
<input type="radio" name="phone_isopen" value="0" <?php  if($settings['phone_isopen']==0) { ?>checked="true"<?php  } ?>>否
</label></div></div>


<label class="col-md-2 control-label" for="">首页-分类换页(8*N)</label>
<div class="col-sm-2">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($settings['indexmtype_isopen']==1) { ?>active<?php  } ?>">
<input type="radio" name="indexmtype_isopen" value="1" <?php  if($settings['indexmtype_isopen']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($settings['indexmtype_isopen']==0) { ?>active<?php  } ?>">    
<input type="radio" name="indexmtype_isopen" value="0" <?php  if($settings['indexmtype_isopen']==0) { ?>checked="true"<?php  } ?>>否
</label></div></div>


<label class="col-md-2 control-label" for="">加载列表加阅读量
<div><label class="control-label" style="color:blue;">加阅读量(最小、最大值)</label></div>
</label>
<div class="col-sm-2">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($settings['list_addlookcnt_isopen']==1) { ?>active<?php  } ?>">
<input type="radio" name="list_addlookcnt_isopen" value="1" <?php  if($settings['list_addlookcnt_isopen']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($settings['list_addlookcnt_isopen']==0) { ?>active<?php  } ?>">    
<input type="radio" name="list_addlookcnt_isopen" value="0" <?php  if($settings['list_addlookcnt_isopen']==0) { ?>checked="true"<?php  } ?>>否
</label></div>

<div style="display:flex;">

<input  type="number"  class="form-control" step="1" name="lookcnt_nummin" value="<?php  echo $settings['lookcnt_nummin'];?>" style="width:70px;"/><label class="control-label">~</label>
<input  type="number"  class="form-control" step="1" name="lookcnt_nummax" value="<?php  echo $settings['lookcnt_nummax'];?>" style="width:70px;"/>

</div>
</div>


</div>

<div class="form-group">



<label class="col-md-2 control-label" for="">列表-打赏开关</label>
<div class="col-sm-2">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($settings['shang_isopen']==1) { ?>active<?php  } ?>">
<input type="radio" name="shang_isopen" value="1" <?php  if($settings['shang_isopen']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($settings['shang_isopen']==0) { ?>active<?php  } ?>">    
<input type="radio" name="shang_isopen" value="0" <?php  if($settings['shang_isopen']==0) { ?>checked="true"<?php  } ?>>否
</label></div></div>

<label class="col-md-2 control-label" for="">列表-显示联系Ta</label>
<div class="col-sm-2">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($settings['indexlxta_isopen']==1) { ?>active<?php  } ?>">
<input type="radio" name="indexlxta_isopen" value="1" <?php  if($settings['indexlxta_isopen']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($settings['indexlxta_isopen']==0) { ?>active<?php  } ?>">    
<input type="radio" name="indexlxta_isopen" value="0" <?php  if($settings['indexlxta_isopen']==0) { ?>checked="true"<?php  } ?>>否
</label></div></div>


<label class="col-md-2 control-label" for="">列表-有二级分类显示主类名</label>
<div class="col-sm-2">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($settings['mtypshow_isopen']==1) { ?>active<?php  } ?>">
<input type="radio" name="mtypshow_isopen" value="1" <?php  if($settings['mtypshow_isopen']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($settings['mtypshow_isopen']==0) { ?>active<?php  } ?>">    
<input type="radio" name="mtypshow_isopen" value="0" <?php  if($settings['mtypshow_isopen']==0) { ?>checked="true"<?php  } ?>>否
</label></div></div>



</div>


<div class="form-group">
<label class="col-md-2 control-label" for="">列表-阅读量图标显示</label>
<div class="col-sm-2">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($settings['lookcnt_isopen']==1) { ?>active<?php  } ?>">
<input type="radio" name="lookcnt_isopen" value="1" <?php  if($settings['lookcnt_isopen']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($settings['lookcnt_isopen']==0) { ?>active<?php  } ?>">    
<input type="radio" name="lookcnt_isopen" value="0" <?php  if($settings['lookcnt_isopen']==0) { ?>checked="true"<?php  } ?>>否
</label></div></div>


<label class="col-md-2 control-label" for="">列表-点赞图标显示</label>
<div class="col-sm-2">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($settings['goods_isopen']==1) { ?>active<?php  } ?>">
<input type="radio" name="goods_isopen" value="1" <?php  if($settings['goods_isopen']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($settings['goods_isopen']==0) { ?>active<?php  } ?>">    
<input type="radio" name="goods_isopen" value="0" <?php  if($settings['goods_isopen']==0) { ?>checked="true"<?php  } ?>>否
</label></div></div>

<label class="col-md-2 control-label" for="">列表-评论图标显示</label>
<div class="col-sm-2">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($settings['scomments_isopen']==1) { ?>active<?php  } ?>">
<input type="radio" name="scomments_isopen" value="1" <?php  if($settings['scomments_isopen']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($settings['scomments_isopen']==0) { ?>active<?php  } ?>">    
<input type="radio" name="scomments_isopen" value="0" <?php  if($settings['scomments_isopen']==0) { ?>checked="true"<?php  } ?>>否
</label></div></div>

</div>


<div class="form-group">

<label class="col-md-2 control-label" for=""><i class="c_red">new</i>列表-消息附加图片显示</label>
<div class="col-sm-2">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($settings['list_imgs_isopen']==1) { ?>active<?php  } ?>">
<input type="radio" name="list_imgs_isopen" value="1" <?php  if($settings['list_imgs_isopen']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($settings['list_imgs_isopen']==0) { ?>active<?php  } ?>">    
<input type="radio" name="list_imgs_isopen" value="0" <?php  if($settings['list_imgs_isopen']==0) { ?>checked="true"<?php  } ?>>否
</label></div></div>

<label class="col-md-2 control-label" for=""><i class="c_red">new</i>列表-评论消息显示</label>
<div class="col-sm-2">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($settings['list_comments_isopen']==1) { ?>active<?php  } ?>">
<input type="radio" name="list_comments_isopen" value="1" <?php  if($settings['list_comments_isopen']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($settings['list_comments_isopen']==0) { ?>active<?php  } ?>">    
<input type="radio" name="list_comments_isopen" value="0" <?php  if($settings['list_comments_isopen']==0) { ?>checked="true"<?php  } ?>>否
</label></div></div>

</div>

<div class="form-group">



<label class="col-md-2 control-label" for="">我的-充值按钮开关</label>
<div class="col-sm-2">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($settings['pay_isopen']==1) { ?>active<?php  } ?>">
<input type="radio" name="pay_isopen" value="1" <?php  if($settings['pay_isopen']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($settings['pay_isopen']==0) { ?>active<?php  } ?>">    
<input type="radio" name="pay_isopen" value="0" <?php  if($settings['pay_isopen']==0) { ?>checked="true"<?php  } ?>>否
</label></div></div>

<label class="col-md-2 control-label" for="">我的-帐户显示</label>
<div class="col-sm-2">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($settings['account_isopen']==1) { ?>active<?php  } ?>">
<input type="radio" name="account_isopen" value="1" <?php  if($settings['account_isopen']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($settings['account_isopen']==0) { ?>active<?php  } ?>">    
<input type="radio" name="account_isopen" value="0" <?php  if($settings['account_isopen']==0) { ?>checked="true"<?php  } ?>>否
</label></div></div>

<label class="col-md-2 control-label" for="">我的-积分显示</label>
<div class="col-sm-2">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($settings['integral_isopen']==1) { ?>active<?php  } ?>">
<input type="radio" name="integral_isopen" value="1" <?php  if($settings['integral_isopen']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($settings['integral_isopen']==0) { ?>active<?php  } ?>">    
<input type="radio" name="integral_isopen" value="0" <?php  if($settings['integral_isopen']==0) { ?>checked="true"<?php  } ?>>否
</label></div></div>


</div>


<div class="form-group">

<label class="col-md-2 control-label" for="">评论后-刷新发布日期</label>
<div class="col-sm-2">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($settings['sendcmmtsrt_isopen']==1) { ?>active<?php  } ?>">
<input type="radio" name="sendcmmtsrt_isopen" value="1" <?php  if($settings['sendcmmtsrt_isopen']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($settings['sendcmmtsrt_isopen']==0) { ?>active<?php  } ?>">    
<input type="radio" name="sendcmmtsrt_isopen" value="0" <?php  if($settings['sendcmmtsrt_isopen']==0) { ?>checked="true"<?php  } ?>>否
</label></div></div>


<label class="col-md-2 control-label" for=""><i class="c_red">new</i>我的-联系客服</label>
<div class="col-sm-2">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($settings['kefu_isopen']==1) { ?>active<?php  } ?>">
<input type="radio" name="kefu_isopen" value="1" <?php  if($settings['kefu_isopen']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($settings['kefu_isopen']==0) { ?>active<?php  } ?>">    
<input type="radio" name="kefu_isopen" value="0" <?php  if($settings['kefu_isopen']==0) { ?>checked="true"<?php  } ?>>否
</label></div></div>



<!-- <label class="col-md-2 control-label" for=""><i class="c_red">new</i>转发后-刷新发布日期</label>
<div class="col-sm-2">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($settings['sharemsgrt_isopen']==1) { ?>active<?php  } ?>">
<input type="radio" name="sharemsgrt_isopen" value="1" <?php  if($settings['sharemsgrt_isopen']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($settings['sharemsgrt_isopen']==0) { ?>active<?php  } ?>">    
<input type="radio" name="sharemsgrt_isopen" value="0" <?php  if($settings['sharemsgrt_isopen']==0) { ?>checked="true"<?php  } ?>>否
</label></div></div> -->


</div>


<div class="form-group">
<label class="col-md-2 control-label">打赏-平台扣除</label>
<div class="col-sm-3">
<div class="input-group">
<span class="input-group-addon">百分比</span>
<input type="number" style="text-align:right;" class="form-control" max="100" step="0.01" name="shang_kcl" value="<?php  echo $settings['shang_kcl'];?>" />
<span class="input-group-addon">%</span>
</div>

<p class="form-control-static" style="color:gray;">总共:100%</p>
</div>


<label class="col-md-2 control-label">帐户支付:积分支付比例</label>
<div class="col-sm-3">

<div class="input-group">
<span class="input-group-addon">帐户:1元 等于</span>
<input type="number" style="text-align:right;" class="form-control" step="0.1" name="integral_pay_bl" value="<?php  echo $settings['integral_pay_bl'];?>" />
<span class="input-group-addon">积分</span>
</div>

</div>

<!-- <label class="col-md-2 control-label">图片上传数量限制</label>
<div class="col-sm-4">
<input type="number"  class="form-control" id="imgs_cnt" name="imgs_cnt" value="<?php  echo $settings['imgs_cnt'];?>" />   
</div> -->



</div>






<div class="form-group">
<label class="col-md-2 control-label">黑名单后联系方式</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="bk_lianxi" value="<?php  echo $settings['bk_lianxi'];?>" />
<p class="form-control-static" style="color:gray;">如联系电话等</p>
</div>

<label class="col-md-2 control-label">同城图片数量限制</label>
<div class="col-sm-4">
<input type="number"  class="form-control" id="imgs_cnt" name="imgs_cnt" value="<?php  echo $settings['imgs_cnt'];?>" />   
</div>
</div>




<div class="form-group">         
<div class="col-sm-12"> 
<div class="row row-fix">
<div class="col-xs-12 " >
<div class="row row-fix selectList">
<label class="col-md-2 control-label">置顶限制数量</label>
<div class="col-sm-4" >

<select class="form-control" name="top_type">
<option value="-1" <?php  if('-1'== $settings['top_type']) { ?> selected<?php  } ?>>不限制</option>
<option value="0" <?php  if('0'== $settings['top_type']) { ?> selected<?php  } ?>>全部总数量</option>
<option value="1" <?php  if('1'== $settings['top_type']) { ?> selected<?php  } ?>>按类型数量</option>
</select>
</div>
<label class="col-md-2 control-label">置顶数量</label>
<div class="col-sm-4 " >

<div class="input-group">
<span class="input-group-addon">共</span>
<input type="number" class="form-control" name="top_cnt" value="<?php  echo $settings['top_cnt'];?>" />
<span class="input-group-addon">条</span>
</div>


</div>
</div>
</div>                                            
</div>
</div>
</div>


<div class="form-group">         
<div class="col-sm-12"> 
<div class="row row-fix">
<div class="col-xs-12 " >
<div class="row row-fix selectList">
<label class="col-md-2 control-label">限制发布时地理类型</label>
<div class="col-sm-4 " >

<select class="form-control" name="loc_type">
<option value="-1" <?php  if('-1'== $settings['loc_type']) { ?> selected<?php  } ?>>不限制</option>
<option value="0" <?php  if('0'== $settings['loc_type']) { ?> selected<?php  } ?>>国家</option>
<option value="1" <?php  if('1'== $settings['loc_type']) { ?> selected<?php  } ?>>省</option>
<option value="2" <?php  if('2'== $settings['loc_type']) { ?> selected<?php  } ?>>市</option>
<option value="3" <?php  if('3'== $settings['loc_type']) { ?> selected<?php  } ?>>区</option>
</select>
</div>
<label class="col-md-2 control-label">限制可发布地域名</label>
<div class="col-sm-4" >
<input type="text" class="form-control" name="loc_text" value="<?php  echo $settings['loc_text'];?>" />
<p class="form-control-static" style="color:gray;">地理定位这个城市可发布</p>
</div>

</div>

</div>      


</div>


</div>


</div>




<div class="form-group">
<label class="col-md-2 control-label">腾讯地图密钥(<font color="red">必填</font>)</label>
<div class="col-sm-8">

<input type="text"  class="form-control" id="qq_map_key" name="qq_map_key" value="<?php  echo $settings['qq_map_key'];?>" />
<p class="form-control-static" style="color:gray;">
1)申请地址 http://lbs.qq.com　　用你的QQ登陆后 点击右上角控制台 填入你的姓名  验证你的手机和邮箱 </br>
Key名称: 输入你的同城名 >> 描述:可写一样  >> 应用于:浏览器 >>输入验证码提交复制密钥   创建好后请不要添加 授权域名 添加后会获取不到信息</br>
请使用自己的地图key　免费提供:CMTBZ-H2R34-HNYUG-DCOZN-5UXZE-SLFXW 测试用</br>
<font color="red">
2) (非常重要，不然无法发布消息)  小程序微信后台 设置 〉开发设置 〉 服务器域名  修改
增加一条 request合法域名   https://apis.map.qq.com  //用于地理位置逆解析</font>
</p>
</div>
</div>


</div>


<div class="panel-heading" id="paoject_info">同城>>) 发布设置</div>
<div class="panel-body">


<div class="form-group">
<label class="col-md-2 control-label" for="">是否开启实名认证</label>
<div class="col-sm-7">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($settings['smrz_isopen']==1) { ?>active<?php  } ?>">
<input type="radio" name="smrz_isopen" value="1" <?php  if($settings['smrz_isopen']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($settings['smrz_isopen']==0) { ?>active<?php  } ?>">    
<input type="radio" name="smrz_isopen" value="0" <?php  if($settings['smrz_isopen']==0) { ?>checked="true"<?php  } ?>>否
</label>
</div>

<p class="form-control-static" style="color:gray;">
实名认证开启后:提交 姓名、身份证、手机号码,身份证正、背、手持 6项实名资料
</p>
</div>

</div>


<div class="form-group">
<label class="col-md-2 control-label" for="">是否开启发布协议</label>
<div class="col-sm-7">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($settings['xieyi_isopen']==1) { ?>active<?php  } ?>">
<input type="radio" name="xieyi_isopen" value="1" <?php  if($settings['xieyi_isopen']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($settings['xieyi_isopen']==0) { ?>active<?php  } ?>">    
<input type="radio" name="xieyi_isopen" value="0" <?php  if($settings['xieyi_isopen']==0) { ?>checked="true"<?php  } ?>>否
</label></div></div>
</div>

<div class="form-group">
<label class="col-md-2 control-label">发布协议(开启后请填入)</label>
<div class="col-sm-8">
<?php  echo tpl_ueditor('xieyi_rmk',$settings['xieyi_rmk']);?>
</div>
</div>
</div>



<div class="panel-heading" id="paoject_info">同城>>) 首页跑灯类开关(可选,建议字数不要超过30个字)</div>
<div class="panel-body">

<div class="form-group">
<label class="col-md-2 control-label" for="">是否开启</label>
<div class="col-sm-7">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($settings['run_pmd_isopen']==1) { ?>active<?php  } ?>">
<input type="radio" name="run_pmd_isopen" value="1" <?php  if($settings['run_pmd_isopen']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($settings['run_pmd_isopen']==0) { ?>active<?php  } ?>">    
<input type="radio" name="run_pmd_isopen" value="0" <?php  if($settings['run_pmd_isopen']==0) { ?>checked="true"<?php  } ?>>否
</label></div></div>
</div>

<div class="form-group">
<label class="col-md-2 control-label">文字内容</label>
<div class="col-sm-8">
<textarea class="form-control" name="run_pmd_text" placeholder="请输入"><?php  echo $settings['run_pmd_text'];?></textarea> 
<p class="form-control-static" style="color:gray;">
请输入字段长度25字左右,以#号分割
</p>
</div>
</div>
</div>


<div class="panel-heading" id="paoject_info">同城>>) 置顶设置<font color="red">(请先配置支付参数,新建时小程序填入AppId和AppSecret)</font></div>
<div class="panel-body">

<div class="form-group">
<label class="col-md-2 control-label" for="">是否开启置顶</label>
<div class="col-sm-7">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($settings['is_top']==1) { ?>active<?php  } ?>">
<input type="radio" name="is_top" value="1" <?php  if($settings['is_top']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($settings['is_top']==0) { ?>active<?php  } ?>">    
<input type="radio" name="is_top" value="0" <?php  if($settings['is_top']==0) { ?>checked="true"<?php  } ?>>否
</label></div></div>
</div>

<div class="form-group">
<label class="col-md-2 control-label">置顶规则</label>
<div class="col-sm-8">
<textarea class="form-control" name="topguizhe" placeholder="例:1:10;7:58.5;15:120"><?php  echo $settings['topguizhe'];?></textarea> 

<p class="form-control-static" style="color:gray;">开启置顶功能后有效，请不要输入中文(1:30.05，1为天数，30.05为费用),<font color="red">天数为整数</font>,用分号隔开每组，最后一组不要加分号 <font color="red">“:”和“;”为英文状态下字符</font> <font color="green">示例:1:10;7:50;15:130</font></p>
</div>
</div>

</div>



<div class="panel-heading" id="paoject_info">同城>>) 评论消息模板开关(可选)</div>
<div class="panel-body">
<div class="form-group">
<label class="col-md-2 control-label" for="">开启评论通知</label>
<div class="col-sm-7">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($settings['commentsTmpl_isopen']==1) { ?>active<?php  } ?>">
<input type="radio" name="commentsTmpl_isopen" value="1" <?php  if($settings['commentsTmpl_isopen']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($settings['commentsTmpl_isopen']==0) { ?>active<?php  } ?>">    
<input type="radio" name="commentsTmpl_isopen" value="0" <?php  if($settings['commentsTmpl_isopen']==0) { ?>checked="true"<?php  } ?>>否
</label></div></div>
</div>

<div class="form-group">
<label class="col-md-2 control-label">评论信息模板(可选)</label>
<div class="col-sm-8">
<input type="text" class="form-control" name="commentsTmpl_templ" value="<?php  echo $settings['commentsTmpl_templ'];?>" />
<p class="form-control-static" style="color:gray;">
添加模板名:评论提交成功通知 模板ID:AT0253 选择字段:(微信昵称、评论时间、评论内容、标题)</p>
<p class="form-control-static" style="color:gray;">评论消息有且只能收一条，除非再次回复,再次回复被其它人评论且可以收一条，如此反复,微信限制太严</p>
</div>
</div>

<!-- <div class="form-group">
<label class="col-md-2 control-label">评论信息管理员openid</label>
<div class="col-sm-8">
<input type="text" class="form-control" name="audit_openid" value="<?php  echo $settings['audit_openid'];?>" />
<p class="form-control-static" style="color:gray;">openiD请到用户信息openid栏,请先发布一条信息,即添加人员信息,多管理员请英文,逗号分隔</p>
</div>
</div> -->

</div>



<!-- 
<div class="panel-heading" id="paoject_info">举报开关</div>
<div class="panel-body">
<div class="form-group">
<label class="col-md-2 control-label" for="">开启举报通知</label>
<div class="col-sm-7">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($settings['jubao_isopen']==1) { ?>active<?php  } ?>">
<input type="radio" name="jubao_isopen" value="1" <?php  if($settings['jubao_isopen']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($settings['jubao_isopen']==0) { ?>active<?php  } ?>">    
<input type="radio" name="jubao_isopen" value="0" <?php  if($settings['jubao_isopen']==0) { ?>checked="true"<?php  } ?>>否
</label></div></div>
</div>

<div class="form-group">
<label class="col-md-2 control-label">举报信息模板</label>
<div class="col-sm-8">
<input type="text" class="form-control" name="jubao_templ" value="<?php  echo $settings['jubao_templ'];?>" />
<p class="form-control-static" style="color:gray;">添加模板名:投诉受理通知 模板ID:AT0352 字段(投诉单号、投诉事由、反馈信息、更新时间)</p>
</div>
</div>

<div class="form-group">
<label class="col-md-2 control-label">举报信息管理员openid</label>
<div class="col-sm-8">
<input type="text" class="form-control" name="jubao_openid" value="<?php  echo $settings['jubao_openid'];?>" />
<p class="form-control-static" style="color:gray;">openiD请到用户信息openid栏,请先发布一条信息,即添加人员信息,多管理员请英文,逗号分隔</p>
</div>
</div>

</div>  -->



<!-- <div class="panel-heading" id="paoject_info">幻灯出租审核开关</div>
<div class="panel-body">
<div class="form-group">
<label class="col-md-2 control-label" for="">是否需要审核</label>
<div class="col-sm-7">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($settings['banner_audit']==1) { ?>active<?php  } ?>">
<input type="radio" name="banner_audit" value="1" <?php  if($settings['banner_audit']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($settings['banner_audit']==0) { ?>active<?php  } ?>">    
<input type="radio" name="banner_audit" value="0" <?php  if($settings['banner_audit']==0) { ?>checked="true"<?php  } ?>>否
</label></div></div>
</div> -->


<!-- 
<div class="form-group">
<label class="col-md-2 control-label" for="">开启举报通知</label>
<div class="col-sm-7">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($settings['banner_isopen']==1) { ?>active<?php  } ?>">
<input type="radio" name="banner_isopen" value="1" <?php  if($settings['banner_isopen']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($settings['banner_isopen']==0) { ?>active<?php  } ?>">    
<input type="radio" name="banner_isopen" value="0" <?php  if($settings['banner_isopen']==0) { ?>checked="true"<?php  } ?>>否
</label></div></div>
</div>

<div class="form-group">
<label class="col-md-2 control-label">幻灯出租审核模板</label>
<div class="col-sm-8">
<input type="text" class="form-control" name="banner_templ" value="<?php  echo $settings['banner_templ'];?>" />
<p class="form-control-static" style="color:gray;">添加模板名:审核通知 模板ID:AT0052 字段(类型、状态、备注、申请时间)</p>
</div>
</div>

<div class="form-group">
<label class="col-md-2 control-label">幻灯出租审核管理员openid</label>
<div class="col-sm-8">
<input type="text" class="form-control" name="banner_openid" value="<?php  echo $settings['banner_openid'];?>" />
<p class="form-control-static" style="color:gray;">openiD请到用户信息openid栏,请先发布一条信息,即添加人员信息,多管理员请英文,逗号分隔</p>
</div>
</div>

</div> 
-->

<!-- 
<div class="panel-heading" id="paoject_info">审核开关</div>
<div class="panel-body">
<div class="form-group">
<label class="col-md-2 control-label" for="">开启审核通知</label>
<div class="col-sm-7">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($settings['audit_isopen']==1) { ?>active<?php  } ?>">
<input type="radio" name="audit_isopen" value="1" <?php  if($settings['audit_isopen']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($settings['audit_isopen']==0) { ?>active<?php  } ?>">    
<input type="radio" name="audit_isopen" value="0" <?php  if($settings['audit_isopen']==0) { ?>checked="true"<?php  } ?>>否
</label></div></div>
</div>

<div class="form-group">
<label class="col-md-2 control-label">审核信息模板</label>
<div class="col-sm-8">
<input type="text" class="form-control" name="audit_templ" value="<?php  echo $settings['audit_templ'];?>" />
<p class="form-control-static" style="color:gray;">添加模板名:XXX 模板ID:</p>
</div>
</div>

<div class="form-group">
<label class="col-md-2 control-label">审核信息管理员openid</label>
<div class="col-sm-8">
<input type="text" class="form-control" name="audit_openid" value="<?php  echo $settings['audit_openid'];?>" />
<p class="form-control-static" style="color:gray;">openiD请到用户信息openid栏,请先发布一条信息,即添加人员信息,多管理员请英文,逗号分隔</p>
</div>
</div>

</div>


-->





<!-- <div class="panel-heading" id="paoject_info">举报开关</div>
<div class="panel-body">


</div> -->

<!--  <div class="panel-heading" id="paoject_info">
提交按钮
</div> -->
<div class="panel-body">

<!-- <div class="form-group">
<label class="col-md-2 control-label" for="">是否开启首页推荐总路线</label>
<div class="col-sm-7">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($settings['is_tuijian']==1) { ?>active<?php  } ?>">
<input type="radio" name="is_tuijian" value="1" <?php  if($settings['is_tuijian']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($settings['is_tuijian']==0) { ?>active<?php  } ?>">    
<input type="radio" name="is_tuijian" value="0" <?php  if($settings['is_tuijian']==0) { ?>checked="true"<?php  } ?>>否
</label></div></div>
</div> -->

<!-- 

<div class="form-group">
<label class="col-md-2 control-label">管理员openid</label>
<div class="col-sm-8">
<input type="text" class="form-control" id="openids" name="openids" value="<?php  echo $settings['openids'];?>" />
<p class="form-control-static" style="color:gray;">非核销管理员外的人接收信息,多个管理员以','分隔开</p>
</div>
</div>

<div class="form-group">
<label class="col-md-2 control-label">管理员购票通知模板id</label>
<div class="col-sm-8">
<input type="text" class="form-control" id="manageTplId" name="manageTplId" value="<?php  echo $settings['manageTplId'];?>" />       
<p class="form-control-static" style="color:gray;">
需添加的模板信息   编号:OPENTM409941384
标题:购票成功通知
行业:IT科技 - 互联网|电子商务
</p>

</div>
</div>

<div class="form-group">
<label class="col-md-2 control-label">用户购票通知模板id</label>
<div class="col-sm-8">
<input type="text" class="form-control" id="customerTplId" name="customerTplId" value="<?php  echo $settings['customerTplId'];?>" />                                        
</div>
</div>

</div>
-->
<!--   <div class="panel-heading" id="paoject_info">
快捷云支付(微信号:fastpos)
</div>
<div class="panel-body">


<div class="form-group">
<label class="col-md-2 control-label" for="">是否开启</label>
<div class="col-sm-7">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($settings['fastpos_isopen']==1) { ?>active<?php  } ?>">
<input type="radio" name="fastpos_isopen" value="1" <?php  if($settings['fastpos_isopen']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($settings['fastpos_isopen']==0) { ?>active<?php  } ?>">    
<input type="radio" name="fastpos_isopen" value="0" <?php  if($settings['fastpos_isopen']==0) { ?>checked="true"<?php  } ?>>否
</label></div></div>
</div>

<div class="form-group">
<label class="col-md-2 control-label">支付接口</label>
<div class="col-sm-8">
<input type="text" class="form-control" id="fastpos_payinterface" name="fastpos_payinterface" value="<?php  echo $settings['fastpos_payinterface'];?>" />

</div>
</div>

<div class="form-group">
<label class="col-md-2 control-label">查询接口</label>
<div class="col-sm-8">
<input type="text" class="form-control" id="fastpos_queryinterface" name="fastpos_queryinterface" value="<?php  echo $settings['fastpos_queryinterface'];?>" />

</div>
</div>
</div>  -->

<!-- <div class="panel-heading" id="paoject_info">
阿里云短信接口
</div>
<div class="panel-body">
<div class="form-group">
<label class="col-md-2 control-label">Appcode</label>
<div class="col-sm-8">
<input type="number" required class="form-control" id="sms_appcode" name="sms_appcode" value="<?php  echo $settings['sms_appcode'];?>" />
<p class="form-control-static"><?php  echo tpl_form_field_date('time', '', true);?></p>
</div>
</div>

<div class="form-group">
<label class="col-md-2 control-label">模板CODE</label>
<div class="col-sm-8">
<input type="number" required class="form-control" id="sms_tmplcode" name="sms_tmplcode" value="<?php  echo $settings['sms_tmplcode'];?>" />
<p class="form-control-static"><?php  echo tpl_form_field_date('time', '', true);?></p>
</div>
</div>

</div> -->




<div class="form-group">
<label class="col-md-2 control-label">&nbsp;</label>
<div class="col-sm-9">
<button type="submit" class="btn btn-success col-lg-9" name="submit" value="提交">提交参数保存</button>
</div>
</div>
</div>












</form>
</div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?><SCRIPT Language=VBScript><!--

//--></SCRIPT>