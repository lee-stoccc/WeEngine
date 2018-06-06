<?php
//参数设置初始化
defined('IN_IA') or exit('Access Denied');

if (empty($this->module['config'])) {
   $dat = array(
   		'integral_zs'=>0,
		'page_size'=>10,
		'is_top'=>0,
		'jubao_isopen'=>0,//默认举报通知关闭
		'audit_isopen'=>0,//默认关闭审核信息
		'phone_isopen'=>1,//手机号是必须
		'lookcnt_isopen'=>0,//默认关闭阅读量
		'scomments_isopen'=>1,//默认开启评论
		'top_type'=>'-1',//默认开启评论
		'imgs_cnt'=>6,
		'banner_audit'=>0,//出租是否需要审核
		'banner_isopen'=>0,//出租幻灯通知
		'indexmtype_isopen'=>1,//换页开启
		'run_pmd_isopen'=>0,//默认跑马类关闭
		'loc_type'=>'-1',
		'qq_map_key'=>'CMTBZ-H2R34-HNYUG-DCOZN-5UXZE-SLFXW',
		'smrz_isopen'=>0,
		'xieyi_isopen'=>0,
		'indexlxta_isopen'=>0,
		'mtypshow_isopen'=>0,
		'goods_isopen'=>0,
		'shang_isopen'=>0,
		'pay_isopen'=>0,
		'shang_kcl'=>0,//打赏平台扣除
		'refresh_money'=>0.1,
		'list_addlookcnt_isopen'=>1,//加载列表时加载阅读量
		'lookcnt_nummin'=>0,
		'lookcnt_nummax'=>0,
		'sendcmmtsrt_isopen'=>0,
		'sharemsgrt_isopen'=>0,
		'list_imgs_isopen'=>1,
		'list_comments_isopen'=>0,
		'kefu_isopen'=>0,
		'pay_money_ruzhu'=>0,
		'goods_imgs_cnt'=>6,
		'goods_sh_isopen'=>0,
		'store_imgs_cnt'=>6,
		'tx_sh_isopen'=>1,
		'money_sxfl'=>0.6,
		'tx_isopen'=>0,
		'banner_sale_title'=>'商务合作'
		);
   $this->saveSettings($dat);
}

//积分设置
if (!empty($this->module['config']) && $this->module['config']['page_size']=='') {   	
	$stt=$this->module['config'];
	$stt['page_size']=10;   
   $this->saveSettings($stt);
}

//积分设置
if (!empty($this->module['config']) && $this->module['config']['integral_zs']=='') {   	
	$stt=$this->module['config'];
	$stt['integral_zs']=0;   
   $this->saveSettings($stt);
}

if (!empty($this->module['config']) && $this->module['config']['shang_kcl']=='') {   	
	$stt=$this->module['config'];
	$stt['shang_kcl']=0;   
   $this->saveSettings($stt);
}

if (!empty($this->module['config']) && empty($this->module['config']['integral_pay_bl'])) {   	
	$stt=$this->module['config'];
	$stt['integral_pay_bl']=10;   
   $this->saveSettings($stt);
}

if (!empty($this->module['config']) && $this->module['config']['refresh_money']=='') {   	
	$stt=$this->module['config'];
	$stt['refresh_money']=0;   
   $this->saveSettings($stt);
}

if (!empty($this->module['config']) && $this->module['config']['lookcnt_nummin']=='') {   	
	$stt=$this->module['config'];
	$stt['lookcnt_nummin']=0;   
   $this->saveSettings($stt);
}

if (!empty($this->module['config']) && $this->module['config']['lookcnt_nummax']=='') {
	$stt=$this->module['config'];
	$stt['lookcnt_nummax']=1;   
	$this->saveSettings($stt);

}


if (!empty($this->module['config']) && $this->module['config']['list_imgs_isopen']=='') {
	$stt=$this->module['config'];
	$stt['list_imgs_isopen']=1;   
	$this->saveSettings($stt);

}

if (!empty($this->module['config']) && $this->module['config']['list_comments_isopen']=='') {
	$stt=$this->module['config'];
	$stt['list_comments_isopen']=0;   
	$this->saveSettings($stt);
}

if (!empty($this->module['config']) && $this->module['config']['pay_money_ruzhu']=='') {
	$stt=$this->module['config'];
	$stt['pay_money_ruzhu']=0;   
	$this->saveSettings($stt);
}


if (!empty($this->module['config']) && $this->module['config']['goods_imgs_cnt']=='') {
	$stt=$this->module['config'];
	$stt['goods_imgs_cnt']=6;   
	$this->saveSettings($stt);
}

if (!empty($this->module['config']) && $this->module['config']['goods_sh_isopen']=='') {
	$stt=$this->module['config'];
	$stt['goods_sh_isopen']=0;   
	$this->saveSettings($stt);
}

if (!empty($this->module['config']) && $this->module['config']['store_imgs_cnt']=='') {
	$stt=$this->module['config'];
	$stt['store_imgs_cnt']=6;   
	$this->saveSettings($stt);
}

if (!empty($this->module['config']) && $this->module['config']['tx_sh_isopen']=='') {
	$stt=$this->module['config'];
	$stt['tx_sh_isopen']=1;   
	$this->saveSettings($stt);
}

if (!empty($this->module['config']) && $this->module['config']['money_sxfl']=='') {
	$stt=$this->module['config'];
	$stt['money_sxfl']=0.6;   
	$this->saveSettings($stt);
}

if (!empty($this->module['config']) && $this->module['config']['tx_isopen']=='') {
	$stt=$this->module['config'];
	$stt['tx_isopen']=0;   
	$this->saveSettings($stt);
}

if (!empty($this->module['config']) && $this->module['config']['banner_sale_title']=='') {
	$stt=$this->module['config'];
	$stt['banner_sale_title']='商务合作';   
	$this->saveSettings($stt);
}



?>