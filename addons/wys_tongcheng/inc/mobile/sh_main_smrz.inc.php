<?php
global $_W, $_GPC;
$DBUtil = new DBUtil();


$op=$_GPC['op'];

if($op=='det'){
$msg_sql='uniacid=:uniacid and id=:id';
$msg_data=array(':uniacid'=>$_W['uniacid'],':id'=>$_GPC['did']);
$det=$DBUtil->getOne('wys_tongcheng_smrz',$msg_sql,$msg_data);

include $this->template('sh_det_smrz');
return;
}else if($op=='audit'){
//审核
	$status=$_GPC['status'];
	$id=$_GPC['did'];
$smrz_det=$DBUtil->getOne('wys_tongcheng_smrz','id=:id',array(':id'=>$id));
	if($status=='1'){

$update_data=array('audit_status'=>'0');
$DBUtil->update('wys_tongcheng_msg',$update_data,array('u_openid'=>$smrz_det['openid'],'audit_status'=>'-2'));
$res=$DBUtil->update('wys_tongcheng_smrz',array('audit_status'=>1,'audit_time'=>time()),array('id'=>$id));

if($res){
	message('审核成功,用户关联信息状态为待审核,请前去消息管理审核!',$this->createMobileUrl('sh_main_smrz'), 'success');
}else{
	message('处理失败!',$this->createMobileUrl('sh_main_smrz'), 'error');
}

	}else if($status=='-1'){

$update_data=array('audit_status'=>'-2','audit_desc'=>$_GPC['audit_desc']);
$DBUtil->update('wys_tongcheng_msg',$update_data,array('u_openid'=>$smrz_det['openid']));
$res=$DBUtil->update('wys_tongcheng_smrz',array('audit_status'=>2,'audit_time'=>time(),'audit_rmk'=>$_GPC['audit_desc']),array('id'=>$id));

if($res){
	message('审核驳回成功,用户关联信息状态为实名下架!',$this->createMobileUrl('sh_main_smrz'), 'success');
}else{
	message('处理失败!',$this->createMobileUrl('sh_main_smrz'), 'error');
}


	}

	//echo $status.'|'.$_GPC['did'];



return;
}


//实名待审
$msg_sql='uniacid=:uniacid and audit_status=:audit_status';
$msg_data=array(':uniacid'=>$_W['uniacid'],':audit_status'=>0);
$list=$DBUtil->getMany('wys_tongcheng_smrz',$msg_sql,$msg_data,'crtime desc');



include $this->template('sh_smrz');

?>