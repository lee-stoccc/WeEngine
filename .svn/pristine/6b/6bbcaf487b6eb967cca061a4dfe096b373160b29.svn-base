<?php
global $_GPC, $_W;
$DBUtil = new DBUtil();
$myfun =new MyFun();
$setting = $this->module['config'];
$op=$_GPC['op'];


if($op=='qq_map_key'){
//地图密钥
$rpdata['qq_map_key']=$setting['qq_map_key'];
}else if($op=='pinche_send_init'){
//地图密钥
$rpdata['qq_map_key']=$setting['qq_map_key'];
$rpdata['now_data']=date('Y-m-d');
$rpdata['now_data2']=date('Y-m-d',$myfun->doDate('day','+',3));
$user_det=$DBUtil->getOne('wys_tongcheng_user','u_openid=:u_openid',array(':u_openid'=>$_GPC['openid']));
if(!empty($user_det)){
$rpdata['u_phone']=$user_det['u_phone'];
}else{
$rpdata['u_phone']='';	
}


}









$errno = 0;
$message = 'rp_textCC';
return $this->result($errno, $message, $rpdata);
?>