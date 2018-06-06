<?php
/**
 * 微同城模块定义
 *
 * @author xswys3
 * @url 
 */
defined('IN_IA') or exit('Access Denied');

class Wys_tongchengModule extends WeModule {

	public function settingsDisplay($settings) {		
		global $_W, $_GPC;
		include_once MODULE_ROOT . '/inc/params_init.php';

		//echo MODULE_ROOT.'/'.$_W['uniacid'];
		// load()->classs('cloudapi');
		// load()->func('tpl');
		// $api = new CloudApi(true);
		// $iframe = $api->url('debug', 'settingsDisplay', array(
		// 	'referer' => urlencode($_W['siteurl']),
		// 	'version' => $this->module['version'],
		// 	'v'=>random(3),
		// 	'page_size'=>$_GPC['page_size']
		// ), 'html');
		// if (is_error($iframe)) {
		// 	message($iframe['message'], '', 'error');
		// }

		$store_status=true;
		$pinche_status=false;
		$data_set=array(
			'banner_sale_title'=>$_GPC['banner_sale_title'],
			'tx_isopen'=>$_GPC['tx_isopen'],
			'tx_sh_isopen'=>$_GPC['tx_sh_isopen'],
			'money_sxfl'=>$_GPC['money_sxfl'],
			'pinche_sh_isopen'=>$_GPC['pinche_sh_isopen'],
			'account_czr'=>$_GPC['account_czr'],
			'account_czh'=>$_GPC['account_czh'],

			'store_imgs_cnt'=>$_GPC['store_imgs_cnt'],
			'goods_sh_isopen'=>$_GPC['goods_sh_isopen'],
			'goods_imgs_cnt'=>$_GPC['goods_imgs_cnt'],
			'pay_money_ruzhu'=>$_GPC['pay_money_ruzhu'],
			'sendcmmtsrt_isopen'=>$_GPC['sendcmmtsrt_isopen'],//评论后-刷新发布日期
			'sharemsgrt_isopen'=>$_GPC['sharemsgrt_isopen'],//转发后-刷新发布日期
			'refresh_money'=>$_GPC['refresh_money'],//打赏-平台扣除
			'shang_kcl'=>$_GPC['shang_kcl'],//打赏-平台扣除
			'integral_pay_bl'=>$_GPC['integral_pay_bl'],//帐户支付:积分支付比例
			'list_addlookcnt_isopen'=>$_GPC['list_addlookcnt_isopen'],//加载列表时加阅读量
			'lookcnt_nummin'=>$_GPC['lookcnt_nummin'],//加载列表时加阅读量 增加量
			'lookcnt_nummax'=>$_GPC['lookcnt_nummax'],//加载列表时加阅读量 增加量
			'list_imgs_isopen'=>$_GPC['list_imgs_isopen'],//列表-显示图片
			'list_comments_isopen'=>$_GPC['list_comments_isopen'],//列表-显示图片
			'kefu_isopen'=>$_GPC['kefu_isopen'],//我的-客服开关

            'is_mianma'=> $_GPC['is_mianma'], //make by xuan
            'first_sxfl'=>$_GPC['first_sxfl'],  //make by xuan
            'second_sxfl'=>$_GPC['second_sxfl'],  //make by xuan

            'is_share'=>$_GPC['is_share'],  //make by xuan
            'share_get'=>$_GPC['share_get'],  //make by xuan

            'is_lucky_money'=>$_GPC['is_lucky_money'], //make by xuan
            'reduce_feng'=>$_GPC['reduce_feng'], //make by xuan
            'min_lucky'=>$_GPC['min_lucky'], //make by xuan
            'max_lucky'=>$_GPC['max_lucky'], //make by xuan

			'page_size'=>$_GPC['page_size'],
			'integral_zs'=>$_GPC['integral_zs'],
			'phone_isopen'=>$_GPC['phone_isopen'],
			'lookcnt_isopen'=>$_GPC['lookcnt_isopen'],
			'scomments_isopen'=>$_GPC['scomments_isopen'],
			'indexmtype_isopen'=>$_GPC['indexmtype_isopen'],
			'goods_isopen'=>$_GPC['goods_isopen'],
			'shang_isopen'=>$_GPC['shang_isopen'],
			'pay_isopen'=>$_GPC['pay_isopen'],
			'account_isopen'=>$_GPC['account_isopen'],
			'integral_isopen'=>$_GPC['integral_isopen'],
			
			'bk_lianxi'=>$_GPC['bk_lianxi'],
			'imgs_cnt'=>$_GPC['imgs_cnt'],

			'top_type'=>$_GPC['top_type'],
			'top_cnt'=>$_GPC['top_cnt'],

			'loc_type'=>$_GPC['loc_type'],
			'loc_text'=>trim($_GPC['loc_text']),
			
			'topguizhe'=>$_GPC['topguizhe'],
			'is_top'=>$_GPC['is_top'],
			'jubao_isopen'=>$_GPC['jubao_isopen'],
			'jubao_templ'=>$_GPC['jubao_templ'],
			'jubao_openid'=>$_GPC['jubao_openid'],

			'audit_isopen'=>$_GPC['audit_isopen'],
			'audit_templ'=>$_GPC['audit_templ'],
			'audit_openid'=>$_GPC['audit_openid'],
			'indexlxta_isopen'=>$_GPC['indexlxta_isopen'],
			'mtypshow_isopen'=>$_GPC['mtypshow_isopen'],


			'commentsTmpl_isopen'=>$_GPC['commentsTmpl_isopen'],
			'commentsTmpl_templ'=>$_GPC['commentsTmpl_templ'],



			// 'banner_audit'=>$_GPC['banner_audit'],
			'banner_isopen'=>$_GPC['banner_isopen'],
			'banner_templ'=>$_GPC['banner_templ'],
			'banner_openid'=>$_GPC['banner_openid'],

			'copy_right_title'=>$_GPC['copy_right_title'],
			'copy_right_phone'=>$_GPC['copy_right_phone'],

			'run_pmd_text'=>$_GPC['run_pmd_text'],  //make by xuan
			'run_pmd_isopen'=>$_GPC['run_pmd_isopen'],

			'qq_map_key'=>$_GPC['qq_map_key'],

			'smrz_isopen'=>$_GPC['smrz_isopen'],
			'xieyi_isopen'=>$_GPC['xieyi_isopen'],
			'xieyi_rmk'=>$_GPC['xieyi_rmk']
			);
		
		$apiclient_cert=$_GPC['apiclient_cert'];
		$apiclient_key=$_GPC['apiclient_key'];
		if(!empty($apiclient_cert) && $apiclient_cert!=''){			
			$dir_path=MODULE_ROOT.'/paycert/'.$_W['uniacid'];
			if(!is_dir($dir_path)){$res=mkdir($dir_path,0777,true);}
			$ret = file_put_contents($dir_path.'/apiclient_cert.pem',trim($apiclient_cert));
			$data_set['apiclient_cert']=$apiclient_cert;
			echo "string";
		}

		if(!empty($apiclient_key) && $apiclient_key!=''){			
			$dir_path=MODULE_ROOT.'/paycert/'.$_W['uniacid'];
			if(!is_dir($dir_path)){$res=mkdir($dir_path,0777,true);}
			$ret = file_put_contents($dir_path.'/apiclient_key.pem',trim($apiclient_key));
			$data_set['apiclient_key']=$apiclient_key;
		}

		if(!empty($_GPC['apiclient_cert1']) && $apiclient_cert==''){			
			$data_set['apiclient_cert']=$_GPC['apiclient_cert1'];
		}

		if(!empty($_GPC['apiclient_key1'])  && $apiclient_key==''){			
			$data_set['apiclient_key']=$_GPC['apiclient_key1'];
		}


		if($_W['ispost']) {
			// $setting = $_GPC['setting'];topguizhe
			// //echo $setting.$_GPC['page_size'];exit;
			// $setting = $api->post('debug', 'saveSettings', array('setting' => $setting, 'version' => $this->module['version'], 'v' => random(3),'page_size'=>$_GPC['page_size']), 'json');
			// if (is_error($setting)) {
			// 	die("<script>alert('{$setting['message']}');location.href = '{$iframe}';</script>");
			// }
			
			//echo $_GPC['goods_sh_isopen']=='on':true:false;
			
			$this->saveSettings($data_set);
			message('参数设置成功!',referer(), 'success');
		}

		include $this->template('setting');
	}


}