<?php
global $_W, $_GPC;
$DBUtil = new DBUtil();
if(checksubmit()){
$user_name=$_GPC['user_name'];
$user_password=$_GPC['user_password'];

$search_sql='uniacid=:uniacid and user_name=:user_name';
$search_data=array(
	':uniacid'=>$_W['uniacid'],
	':user_name'=>$user_name
	);


$manger_det=$DBUtil->getOne('wys_tongcheng_manager',$search_sql,$search_data);

if(!empty($manger_det)){
	if($manger_det['user_password']==$user_password){
	message('登陆成功!',$this->createMobileUrl('sh_main',array('mgid'=>$manger_det['id'])), 'success');
	}else{
		message('密码输入不正确!',referer(), 'error');
	}
}else{
	message('没有该帐号!',referer(), 'error');
}

}
include $this->template('login');

?>