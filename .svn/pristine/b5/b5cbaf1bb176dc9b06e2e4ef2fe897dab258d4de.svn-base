<?php
global $_W, $_GPC;
$DBUtil = new DBUtil();
$op=$_GPC['op'];

if($op=='det'){
$msg_sql='uniacid=:uniacid and id=:id';
$msg_data=array(':uniacid'=>$_W['uniacid'],':id'=>$_GPC['did']);
$sh_det=$DBUtil->getOne('wys_tongcheng_jubao',$msg_sql,$msg_data);

$det=$DBUtil->getOne('wys_tongcheng_msg','id=:id',array('id'=>$sh_det['mid']));

if(empty($det)){
$DBUtil->delete('wys_tongcheng_jubao',array('id'=>$_GPC['did']));
message('该消息已不存在,已删除举报消息,返回列表!',$this->createMobileUrl('sh_main_jubao'), 'error');
}


$imglist=$DBUtil->getMany($DBUtil::wys_tongcheng_msg_imgs,' uniacid=:uniacid and oncode=:oncode',array(':uniacid'=>$_W['uniacid'],':oncode'=>$det['oncode']));
include $this->template('sh_det_jubao');
return;
}else if($op=='audit'){
//审核
	$status=$_GPC['status'];
	if($status=='-1'){
	$DBUtil->update('wys_tongcheng_jubao',array('cl_state'=>1),array('id'=>$_GPC['did']));
	$res = $DBUtil->update('wys_tongcheng_msg',array('audit_status'=>-1,'audit_desc'=>$_GPC['audit_desc']),array('id'=>$_GPC['mid']));

	}else if($status=='-11'){

	$res =$DBUtil->delete('wys_tongcheng_jubao',array('id'=>$_GPC['did']));
	}

	//echo $status.'|'.$_GPC['did'];

if($res){
	message('操作成功,返回列表!',$this->createMobileUrl('sh_main_jubao'), 'success');
}else{
	message('操作失败,返回列表!',$this->createMobileUrl('sh_main_jubao'), 'error');
}

return;
}


//举报
$msg_sql='uniacid=:uniacid and cl_state=:cl_state';
$msg_data=array(':uniacid'=>$_W['uniacid'],':cl_state'=>0);
$list=$DBUtil->getMany('wys_tongcheng_jubao',$msg_sql,$msg_data,'crtime desc');



include $this->template('sh_jubao');

?>