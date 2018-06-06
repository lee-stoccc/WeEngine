<?php
//店铺管理
global $_GPC, $_W;
	$DBUtil = new DBUtil();
	$myfun =new MyFun();//$myfun->randombylength(8)
	$setting = $this->module['config'];//$setting['qq_map_key']
	//表名
	$tb='wys_tongcheng_store_comments';
	$op=$_GPC['op'];
	$id=$_GPC['id'];
	$openid=$_GPC['openid'];
	$unionid=$_GPC['unionid'];
	$order='crtime desc';
	$page = max(1, $_GPC['page']);

	$errno = 0;
	$message = 'dosucc';
	$rpdata = array('doaction'=>$op);
	//操作方法
	if($op=='add' || $op=='add2'){
		//
		$data=array(
			'uniacid'=>$_W['uniacid'],			
			'oncode'=>$_GPC['oncode'],
			
			's_id'=>$_GPC['s_id'],
			'goods_id'=>$_GPC['goods_id'],
			
			'score'=>$_GPC['flag'],
			'mcontent'=>$_GPC['mcontent'],

			'pl_ctype'=>$_GPC['pl_ctype'],//类型
			'attr'=>$_GPC['attr'],//归属ID

			'u_nickname'=>$_GPC['u_nickname'],
			'u_city'=>$_GPC['u_city'],
			'u_openid'=>$_GPC['u_openid'],
			'u_unionid'=>$_GPC['u_unionid'],
			'u_avatarurl'=>$_GPC['u_avatarurl'],			
			'formID'=>$_GPC['formID'],	

			);
		if($op=='add'){
			$data['crtime']=time();
			$DBUtil->save($tb,$data);
			//更新订单
			$DBUtil->update('wys_tongcheng_store_order',array('is_comment'=>1),array('oncode'=>$_GPC['oncode']));
			$rpdata['oncode']=$data['oncode'];
		}else if($op=='add2'){
			$data['crtime']=time();
			$DBUtil->save($tb,$data);
			//更新订单
			$DBUtil->update('wys_tongcheng_store_order',array('is_comment'=>1),array('oncode'=>$_GPC['oncode']));
			$rpdata['oncode']=$data['oncode'];
			$rpdata['rp_comment']=$DBUtil->getMany($tb,'attr=:attr',array(':attr'=>$_GPC['attr']));
		}
			

	}else if($op=='list_show'){
		$vtype=$_GPC['vtype'];	
		if($vtype=='store'){
			$sql='s_id=:s_id';
			$sql_param=array(':s_id'=>$_GPC['val']);
		}else if($vtype=='goods'){
			$sql='goods_id=:goods_id';
			$sql_param=array(':goods_id'=>$_GPC['val']);
			
		}

		$sql.=' and pl_ctype=:pl_ctype';
		$sql_param[':pl_ctype']='main';
		$rpdata=$DBUtil->getMany($tb,$sql,$sql_param,'crtime desc',$page,20);
		foreach ($rpdata as $key => &$ct) {
		$ct['crtime']=$myfun->friendlyDate($ct['crtime'],'ym_time');
		$ct['imgs_list']=$this->getList_imsg_list($ct['imgs_list']);
		$ct['comments_p']=$DBUtil->getMany('wys_tongcheng_store_comments','attr=:attr',array(':attr'=>$ct['id']));
		}
	

	}



	//返回信息
	return $this->result($errno, $message, $rpdata);
?>