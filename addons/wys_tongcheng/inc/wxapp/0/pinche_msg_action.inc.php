<?php

global $_GPC, $_W;
$DBUtil = new DBUtil();
$myfun =new MyFun();
$setting = $this->module['config'];

$m_type=$_GPC['m_type'];//类型
$page = max(1, $_GPC['page']);
$op=$_GPC['op'];
$tb='wys_tongcheng_pingche_msg';
if($op=='list'){
$sql='uniacid=:uniacid and pc_type=:pc_type';
$sql_data=array(':uniacid'=>$_W['uniacid'],':pc_type'=>$m_type);

//$sql.="(type='临时拼车')";
//$sql.=' and time>:time';
//$sql_data[':time']=time();



$rpdata =$DBUtil->getMany($tb,$sql,$sql_data,'time+0 asc',$page,10);





foreach ($rpdata as $key => &$value) {
	//$value['time']=intval($value['time'])>time().'>>';
	$value['time']=$myfun->friendlyDate($value['time'],'ym_time');//full
	
	//$value['time'].='|'.time();


}

}else if($op=='add'){

$mod_data=array(
'uniacid'=>$_W['uniacid'],

'type'=>$_GPC['type'],
'pc_type'=>$_GPC['pc_type'],


'address_start'=>$_GPC['address_start'],
'address_start_lat'=>$_GPC['address_start_lat'],
'address_start_lon'=>$_GPC['address_start_lon'],
'address_start_nation'=>$_GPC['address_start_nation'],
'address_start_province'=>$_GPC['address_start_province'],
'address_start_city'=>$_GPC['address_start_city'],
'address_start_district'=>$_GPC['address_start_district'],
'address_start_street'=>$_GPC['address_start_street'],
'address_start_street_number'=>$_GPC['address_start_street_number'],

'address_end'=>$_GPC['address_end'],
'address_end_lat'=>$_GPC['address_end_lat'],
'address_end_lon'=>$_GPC['address_end_lon'],
'address_end_nation'=>$_GPC['address_end_nation'],
'address_end_province'=>$_GPC['address_end_province'],
'address_end_city'=>$_GPC['address_end_city'],
'address_end_district'=>$_GPC['address_end_district'],
'address_end_street'=>$_GPC['address_end_street'],
'address_end_street_number'=>$_GPC['address_end_street_number'],

'msg_address'=>$_GPC['msg_address'],
'msg_lat'=>$_GPC['msg_lat'],
'msg_lon'=>$_GPC['msg_lon'],
'msg_nation'=>$_GPC['msg_nation'],
'msg_province'=>$_GPC['msg_province'],
'msg_city'=>$_GPC['msg_city'],
'msg_district'=>$_GPC['msg_district'],
'msg_street'=>$_GPC['msg_street'],
'msg_street_number'=>$_GPC['msg_street_number'],

'num'=>$_GPC['num'],
'geixiaofei'=>$_GPC['geixiaofei'],


'rmk_yaoqiu'=>$_GPC['yaoqiu'],
'rmk_buchong'=>$_GPC['buchong'],


'u_phone'=>$_GPC['u_phone'],
'u_nickname'=>$_GPC['u_nickname'],
'u_city'=>$_GPC['u_city'],
'u_openid'=>$_GPC['u_openid'],
'u_unionid'=>$_GPC['u_unionid'],
'u_avatarurl'=>$_GPC['u_avatarurl'],
'formID'=>$_GPC['formID'],


'time'=>strtotime($_GPC['dates'].' '.$_GPC['times']),
'time_start'=>strtotime($_GPC['dates_start'].' '.$_GPC['times_start']),
'time_end'=>strtotime($_GPC['dates_end'].' '.$_GPC['times_end']),
'crtime'=>time(),
);
$res=$DBUtil->save($tb,$mod_data);


$rpdata['add_status']=$res;

}else if($op=='get_one_show'){
$rpdata=$DBUtil->getOne($tb,'id=:id',array(':id'=>$_GPC['id']));

}

$errno = 0;
$message = '返回消息';



return $this->result($errno, $message,$rpdata);
?>