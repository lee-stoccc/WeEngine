<?php
global $_W, $_GPC;
$DBUtil = new DBUtil();

//消息待审核
//$msg_sql='uniacid=:uniacid and audit_status="0" and ( (is_placed_top="0" and total_money="0") or (is_placed_top="1" and payStatus="1") )';
$msg_sql='uniacid=:uniacid and (audit_status=0 and total_money=0) or ( audit_status=0 and total_money>0 and payStatus=1 )';
$msg_data=array(':uniacid'=>$_W['uniacid']);
$sh_msg_cnt=$DBUtil->getCount('wys_tongcheng_msg',$msg_sql,$msg_data);


//举报
$msg_sql='uniacid=:uniacid and cl_state=:cl_state';
$msg_data=array(':uniacid'=>$_W['uniacid'],':cl_state'=>0);
$sh_jubao_cnt=$DBUtil->getCount('wys_tongcheng_jubao',$msg_sql,$msg_data);

//幻灯出租
$msg_sql='uniacid=:uniacid and audit_status=:audit_status and paystate=:paystate';
$msg_data=array(':uniacid'=>$_W['uniacid'],':audit_status'=>0,':paystate'=>1);
$sh_banner_cnt=$DBUtil->getCount('wys_tongcheng_salebanner',$msg_sql,$msg_data);


//实名待审
$msg_sql='uniacid=:uniacid and audit_status=:audit_status';
$msg_data=array(':uniacid'=>$_W['uniacid'],':audit_status'=>0);
$sh_smrz_cnt=$DBUtil->getCount('wys_tongcheng_smrz',$msg_sql,$msg_data);




include $this->template('sh_main');

?>