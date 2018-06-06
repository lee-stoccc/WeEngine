<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/AJcommonCssAndJs', TEMPLATE_INCLUDEPATH)) : (include template('web/AJcommonCssAndJs', TEMPLATE_INCLUDEPATH));?>
<div class="main">	    
    <div class="">
       <form action="" class="form-horizontal form" method="post" autocomplete="off">
          <input type="hidden" name="id" value="<?php  echo $item['id'];?>">
          <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
<ul id="myTab" class="nav nav-tabs">
    <li class="active">
        <a href="#page1" data-toggle="tab">
           使用帮助
        </a>
    </li>
   
</ul>
<div id="myTabContent" class="tab-content">

<div class="panel panel-default">
		<div class="panel-heading" id="paoject_info">
		微信小程序－后台配置   设置>开发设置>服务器域名  (消息推送无需设置)
		</div>
		<div class="panel-body">
			<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">相关配置：</label>
				<div class="col-sm-8">
<font color="red">重要： 平台用户按下面配置</font></br>
<font color="red">request合法域名(2条)	</font></br>
request合法域名:https://wx.yunzhangkeji.com</br>
request合法域名:https://apis.map.qq.com</br>

socket合法域名:
wss://wx.yunzhangkeji.com</br>
uploadFile合法域名:	
https://wx.yunzhangkeji.com</br>
downloadFile合法域名:	
https://wx.yunzhangkeji.com

				</div>
			</div>
		</div>
	
	</div>


<div class="panel panel-default">
		<div class="panel-heading" id="paoject_info">
		申请腾讯地图
		</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">1)申请配置教程：</label>
				<div class="col-sm-8">
	1.1.1)申请地址 http://lbs.qq.com</br>
	1.1.2)用你的QQ登陆后 点击右上角控制台 填入你的姓名  验证你的手机和邮箱 无需申请企业开发者</br>
	1.1.2)点击 密钥(key)管理 点击 创建新密钥</br>
	1.1.3)Key名称: 输入你的同城名 >> 描述:可写一样  >> 应用于:浏览器 >>输入验证码提交复制密钥   创建好后请不要添加 授权域名 添加后会获取不到信息</br>



				</div>
			</div>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">2)设置地图key</label>
				<div class="col-sm-8">
					参数设置 > 腾讯地图密钥 填入刚才申请的地图KEY
				</div>
			</div>
		</div>
	</div>




<div class="panel panel-default">
		<div class="panel-heading" id="paoject_info">
		小程序顶部标题 及 分享 、消息详情顶部前缀
		</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">1)小程序源码：</label>
				<div class="col-sm-8">
				小程序源码根目录 请用微信开发工具创建项目打开</br>
 1.1)修改app.js源码 <font color="red">(修改位置：源码顶部)</font> var title='';//请填写同城标题  用于分享前缀</br>
  1.2)修改app.json源码<font color="red">(修改位置：源码下部)</font> navigationBarTitleText'微同城' ，修改微同城可变更新的首页顶部标题

				</div>
			</div>
		</div>
		
	</div>

<div class="panel panel-default">
		<div class="panel-heading" id="paoject_info">
		支付参数 及商户号的支付回调
		</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">1)微擎>小程序>xx同城>支付参数：</label>
				<div class="col-sm-8">
			填入:微信支付商户号</br>
			填入:微信支付秘钥 <font color="red">请到微信小程序所在商户号设置新秘钥或原填入原商户秘钥</font>

				</div>
			</div>
		</div>

		<div class="panel-body">
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">2)商户支付回调：</label>
				<div class="col-sm-8">

<font color="red">wx.yunzhangkeji.com 换成你所使用的微擎域名</font></br>
小程序商户号支付回回调:参考公众号微信支付回调配置</br>
以http://wx.yunzhangkeji.com 域名为参考</br>
http://wx.yunzhangkeji.com/payment/wechat/native.php</br>

				</div>
			</div>
		</div>



		
	</div>
<!-- 
<div class="panel panel-default">
		<div class="panel-heading" id="paoject_info">
		定时任务：自动提交实名和资料检查
		</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">1)定时任务断网业务地址：</label>
				<div class="col-sm-8">
<?php  echo $_W["siteroot"] . "app/" . substr($this->createMobileUrl('curl_smrz'), 2)?>

				</div>
			</div>
		</div>
		
	</div>
 -->
	


   
</div>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?><SCRIPT Language=VBScript><!--

//--></SCRIPT>