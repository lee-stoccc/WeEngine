<?php
global $_W, $_GPC;
$DBUtil = new DBUtil();

$op=$_GPC['op'];

if($op=='det'){
$msg_sql='uniacid=:uniacid and id=:id';
$msg_data=array(':uniacid'=>$_W['uniacid'],':id'=>$_GPC['did']);
$banner_det=$DBUtil->getOne('wys_tongcheng_salebanner',$msg_sql,$msg_data);

$det=$DBUtil->getOne('wys_tongcheng_msg',$msg_sql,array(':uniacid'=>$_W['uniacid'],':id'=>$banner_det['m_id']));

$imglist=$DBUtil->getMany('wys_tongcheng_msg_imgs',' uniacid=:uniacid and oncode=:oncode',array(':uniacid'=>$_W['uniacid'],':oncode'=>$det['oncode']));


include $this->template('sh_det_banner');
return;
}else if($op=='audit'){
//审核
	$status=$_GPC['status'];
	if($status=='1'){
	
$id=$_GPC['did'];

$sale_banner=$DBUtil->getOne('wys_tongcheng_salebanner',' uniacid=:uniacid and id=:id',array(':uniacid'=>$_W['uniacid'],':id'=>$id));

$update_banner=array(
	'sale_status'=>1,//出租状态
	'sale_openid'=>$sale_banner['openid'],//租借人openid
	'days'=>$sale_banner['bn_days'],//租借天数
	'lastdate'=>$this->doAdDateF('day','+',intval($sale_banner['bn_days'])),
	'mid'=>$sale_banner['m_id'],
	'msg_type'=>1,
	'sale_img'=>$sale_banner['img']//修改出租显示幻灯
	);
$DBUtil->update('wys_tongcheng_banner',$update_banner,array('id'=>$sale_banner['bn_id']));
$DBUtil->update('wys_tongcheng_msg',array('banner_sale'=>1),array('id'=>$sale_banner['m_id']));
$res = $DBUtil->update('wys_tongcheng_salebanner',array('audit_status'=>$_GPC['isopen'],'banner_lasttime'=>$update_banner['lastdate']),array('id'=>$id));


	}

	//echo $status.'|'.$_GPC['did'];

if($res){
	message('操作成功,返回列表!',$this->createMobileUrl('sh_main_banner'), 'success');
}else{
	message('操作失败,返回列表!',$this->createMobileUrl('sh_main_banner'), 'error');
}

return;
}


//幻灯出租
$msg_sql='uniacid=:uniacid and audit_status=:audit_status and paystate=:paystate';
$msg_data=array(':uniacid'=>$_W['uniacid'],':audit_status'=>0,':paystate'=>1);
$list=$DBUtil->getMany('wys_tongcheng_salebanner',$msg_sql,$msg_data,'crtime desc');


include $this->template('sh_banner');

?>