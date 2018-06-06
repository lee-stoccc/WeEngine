<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="alert we7-page-alert">
	<p><i class="wi wi-info-sign"></i>可以把之前公众号应用的会员、数据等信息同步至小程序应用当中.</p>
	<p><i class="wi wi-info-sign"></i>从公众号应用同步的会员信息,在小程序应用登录时会被判断为新用户,此处无法识别为同一会员.</p>
</div>
<div class="we7-page-title">关联设置</div>
<div id="js-module-link-uniacid" ng-controller="moduleLinkUniacidCtrl" ng-cloak>
	<table class="table we7-table table-hover vertical-middle">
		<col width="180px" />
		<col width="140px"/>
		<col width="140px" />
		<tr>
			<th class="text-left">关联设置</th>
			<th class="text-left">公众号</th>
			<th class="text-right">操作</th>
		</tr>
		<tr ng-repeat="module in versionInfo.modules" ng-if="versionInfo.modules">
			<td class="text-left">
				<img ng-src="{{module.logo}}" style="width:50px;height:50px;">
				{{module.title}}
			</td>
			<td class="text-left" ng-if="module.account">
				<img src="<?php  echo tomedia('headimg_'.$module['account']['acid'].'.jpg')?>?time=<?php  echo time()?>" style="width:50px;height:50px;">
				<span>{{module.account.name}}</span>
			</td>
			<td class="text-left" ng-if="!module.account">
				<span>暂无</span>
			</td>
			<td>
				<div class="link-group" ng-if="module.account">
					<a href="javascript:;" ng-click="searchLinkAccount(module.name)" ng-if="module.wxapp_support == 2 && module.app_support == 2">修改</a>
					<a href="javascript:;" ng-click="module_unlink_uniacid()">删除</a>
				</div>
				<div class="link-group" ng-if="!module.account">
					<a href="javascript:;" ng-click="searchLinkAccount(module.name)">添加</a>
				</div>
			</td>
		</tr>
	</table>
	<div class="modal fade uploader-modal module" id="show-account" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog we7-modal-dialog" style="width:800px">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">选择公众号(点击选择)</h4>
				</div>
				<div class="modal-body material-content">
					<div class="alert bg-light-gray">
						<p><i class="wi wi-info-sign color-default"></i>小程序应用,必须同时支持公众号应用</p>
						<p><i class="wi wi-info-sign color-default"></i>公众号必须安装有公众号应用.</p>
						<p><i class="wi wi-info-sign color-default"></i>必须有小程序和公众号的主管理员权限</p>
					</div>
					<div class="panel-body we7-padding material-body">
						<div class="row js-show-account-content">
							<div class="col-sm-2" ng-repeat="account in linkAccounts" ng-if="linkAccounts">
								<div class="item" ng-click="selectLinkAccount(account, $event)">
									<img ng-src="{{account.logo}}" class="icon">
									<div class="name">{{account.name}}</div>
									<div class="mask">
										<span class="wi wi-right"></span>
									</div>
								</div>
							</div>
							<div class="col-sm-12 text-center" ng-if="!linkAccounts">没有可以关联的公众号</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" ng-click="moduleLinkUniacid()">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	angular.module('wxApp').value('config', {
		'version_info': <?php echo !empty($version_info) ? json_encode($version_info) : 'null'?>,
		'token': "<?php  echo $_W['token']?>",
		'links' : {
			'search_link_account': "<?php  echo url('wxapp/module-link-uniacid/search_link_account')?>",
			'module_link_uniacid': "<?php  echo url('wxapp/module-link-uniacid')?>",
			'module_unlink_uniacid':"<?php  echo url('wxapp/module-link-uniacid/module_unlink_uniacid')?>"
		},
	});
	angular.bootstrap($('#js-module-link-uniacid'), ['wxApp']);
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>