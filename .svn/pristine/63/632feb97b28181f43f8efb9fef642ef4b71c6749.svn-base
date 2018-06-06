<?php
	//店铺管理 所有分类
	global $_GPC, $_W;
	$DBUtil = new DBUtil();
	$myfun =new MyFun();//$myfun->randombylength(8)
	$setting = $this->module['config'];//$setting['qq_map_key']
	//表名
	$tb='wys_tongcheng_store_mtype';
	$op=$_GPC['op'];
	$id=$_GPC['id'];
	$openid=$_GPC['openid'];
	$unionid=$_GPC['unionid'];

	$order='pxh asc';
	$errno = 0;
	$message = 'dosucc';
	$data = array('doaction'=>$op);
	if($op=='list'){
	$list_all=$DBUtil->getMany($tb,'uniacid=:uniacid and attr=:attr and is_parent_open=:is_parent_open',array(':uniacid'=>$_W['uniacid'],':attr'=>0,':is_parent_open'=>1),$order);
	$main_arr=array();
	$main_arr_id=array();
	$main_arr_img=array();
	$main_arr_enter_money=array();
	$main_parr_all=array();
	$main_parr_all_id=array();
	foreach ($list_all as $key_all => &$it) {
		array_push($main_arr, $it['tname']);
		array_push($main_arr_id, $it['id']);
		array_push($main_arr_img, $it['img']);
		array_push($main_arr_enter_money, $it['enter_money']);

		$p_list=$DBUtil->getMany($tb,'uniacid=:uniacid and attr=:attr',array(':uniacid'=>$_W['uniacid'],':attr'=>$it['id']),$order);
		$main_parr=array();
		$main_parr_id=array();
		foreach ($p_list as $key_p => $pit) {
			array_push($main_parr, $pit['tname']);
			array_push($main_parr_id, $pit['id']);
		}
		array_push($main_parr_all, $main_parr);
		array_push($main_parr_all_id, $main_parr_id);
	}
	$data['main_arr']=$main_arr;
	$data['main_arr_id']=$main_arr_id;
	$data['main_arr_img']=$main_arr_img;
	$data['main_arr_enter_money']=$main_arr_enter_money;



	$data['main_parr_all']=$main_parr_all;
	$data['main_parr_all_id']=$main_parr_all_id;
	$data['pay_money_ruzhu']=$setting['pay_money_ruzhu'];
	$data['last_time_str']=date('Y年m月d日',$myfun->doDate('year','+',1));
	$data['store_imgs_cnt']=$setting['store_imgs_cnt'];

	}


	//返回信息
	return $this->result($errno, $message, $data);
?>