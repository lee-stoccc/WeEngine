<?php
//店铺管理
global $_GPC, $_W;
	$DBUtil = new DBUtil();
	$myfun =new MyFun();//$myfun->randombylength(8)
	$setting = $this->module['config'];//$setting['qq_map_key']
	//表名
	$page = max(1, $_GPC['page']);
	$tb='wys_tongcheng_store_order';
	$tb_info='wys_tongcheng_store_order_info';
	$op=$_GPC['op'];
	$id=$_GPC['id'];
	$openid=$_GPC['openid'];
	$unionid=$_GPC['unionid'];

	$order='crtime desc';
	$errno = 0;
	$message = 'dosucc';
	$rpdata = array('doaction'=>$op);
	//操作方法
	if($op=='add' || $op=='edit'){
		//
		$data=array(
			'uniacid'=>$_W['uniacid'],
			'openid'=>$openid,
			'unionid'=>$unionid,
			'u_nickname'=>$_GPC['u_nickname'],
			'u_avatarurl'=>$_GPC['u_avatarurl'],		
			'total_money'=>$_GPC['total_money'],
			'store_openid'=>$_GPC['store_openid'],
			's_id'=>$_GPC['s_id'],
			'goods_id'=>$_GPC['id'],
			);
		if($op=='add'){

			$goods_det=$DBUtil->getOne('wys_tongcheng_store_goods','id=:id',array(':id'=>$_GPC['id']));

			//有库存
			if(intval($goods_det['g_cnt_all'])!=0){
				if(intval($goods_det['g_cnt_all'])-intval($goods_det['g_cnt_sale'])>=intval($_GPC['goodsNum'])){
					//大于现在库存
						$rpdata['cnt_is_sale']=true;

						$data['status']='0';//0未支付 1已支付 2已核销 
						$data['crtime']=time();
						$data['last_time_pay']=$myfun->doDate('minute','+',30);
						$oncode=time().$myfun->randombylength_num_true(4);
						$data['oncode']=$oncode;
						$DBUtil->save($tb,$data);

						$data_info=array(
						'uniacid'=>$_W['uniacid'],
						'oncode'=>$data['oncode'],
						'order_id'=>$data['oncode'],
						'openid'=>$openid,
						'unionid'=>$unionid,
						's_id'=>$_GPC['s_id'],
						'goods_id'=>$_GPC['id'],
						'g_type'=>$_GPC['g_type'],
						'g_name'=>$_GPC['g_name'],		
						'money_pay'=>$_GPC['money_sale'],
						'cnt_buy'=>$_GPC['goodsNum'],
						'crtime'=>time()
						);
						$DBUtil->save($tb_info,$data_info);

				}else{
					$rpdata['cnt_is_sale']=false;
					$rpdata['cnt_sale_kucun']=intval($goods_det['g_cnt_all'])-intval($goods_det['g_cnt_sale']);
				}

			}else{
			$data['status']='0';//0未支付 1已支付 2已核销 
			$data['crtime']=time();
			$data['last_time_pay']=$myfun->doDate('minute','+',30);
			$oncode=time().$myfun->randombylength_num_true(4);
			$data['oncode']=$oncode;
			$DBUtil->save($tb,$data);

			$rpdata['cnt_is_sale']=true;
			$data_info=array(
			'uniacid'=>$_W['uniacid'],
			'oncode'=>$data['oncode'],
			'order_id'=>$data['oncode'],
			'openid'=>$openid,
			'unionid'=>$unionid,
			's_id'=>$_GPC['s_id'],
			'goods_id'=>$_GPC['id'],
			'g_type'=>$_GPC['g_type'],
			'g_name'=>$_GPC['g_name'],		
			'money_pay'=>$_GPC['money_sale'],
			'cnt_buy'=>$_GPC['goodsNum'],
			'crtime'=>time()
			);
			$DBUtil->save($tb_info,$data_info);
			}		



			//返回
			$rpdata['oncode']=$oncode;			

		}else if($op=='edit'){			
			$rpdata['oncode']=$_GPC['oncode'];
			$store_info_det=$DBUtil->getOne($tb,'oncode=:oncode',array(':oncode'=>$_GPC['oncode']));
			if($store_info_det['enable']=='2'){
				$data['enable']='0';
			}
			$DBUtil->update($tb,$data,array('id'=>$id));
		}

	}else if($op=='get_one'){
		$rpdata=$DBUtil->getOne($tb,'oncode=:oncode',array(':oncode'=>$_GPC['oncode']));
		$time_yy=explode('-',$rpdata['time_start']);
		$rpdata['time_start']=$time_yy[0];
		$rpdata['time_end']=$time_yy[1];

	}else if($op=='get_one_view'){
		$rpdata=$DBUtil->getOne($tb,'oncode=:oncode',array(':oncode'=>$_GPC['oncode']));
		//$cnt_look=$rpdata['cnt_look']+1;
		//$DBUtil->update($tb,array('cnt_look'=>$cnt_look),array('id'=>$rpdata['id']));

	}else if($op=='list_my'){
		//根据用户ID 取店铺列表
		//$rpdata=$DBUtil->getMany($tb,'openid=:openid',array(':openid'=>$openid),$order);
		$rpdata=$DBUtil->getMany($tb,'openid=:openid',array(':openid'=>$openid),$order,$page,10);
		foreach ($rpdata as $key => &$it) {
		$it['crtime_str']=$myfun->friendlyDate($it['crtime'],'full');
		$it['infos']=$DBUtil->getMany('wys_tongcheng_store_order_info','oncode=:oncode',array(':oncode'=>$it['oncode']));
		}
	}else if($op=='list_store_my'){
		//根据用户ID 取店铺列表 店铺订单
		$rpdata=$DBUtil->getMany($tb,'store_openid=:store_openid and status=:status',array(':store_openid'=>$openid,':status'=>1),$order,$page,10);
		foreach ($rpdata as $key => &$it) {
		$it['crtime_str']=$myfun->friendlyDate($it['crtime'],'full');
		$it['infos']=$DBUtil->getMany('wys_tongcheng_store_order_info','oncode=:oncode',array(':oncode'=>$it['oncode']));
		}
	}else if($op=='list_store'){
		//所有店铺
		$list=$DBUtil->getMany($tb,'openid=:openid',array(':openid'=>$openid));
		$main_arr=array();
		$main_arr_id=array();
		foreach ($list as $key => $it) {
		array_push($main_arr, $it['s_name']);
		array_push($main_arr_id, $it['id']);
		}
	$rpdata['main_arr']=$main_arr;
	$rpdata['main_arr_id']=$main_arr_id;

	}else if($op=='check_order'){
		//订单核销 扫描
		$rpdata=$DBUtil->getOne($tb,'oncode=:oncode',array(':oncode'=>$_GPC['oncode']));
		$rpdata['infos']=$DBUtil->getMany('wys_tongcheng_store_order_info','oncode=:oncode',array(':oncode'=>$rpdata['oncode']));
		if($rpdata['store_openid']!=$openid){
			$rpdata['hexiao_do_status']=false;
		}else{
			$rpdata['hexiao_do_status']=true;
		}
	}else if($op=='hexiao_sure'){
		//订单核销 扫描
		$rpdata=$DBUtil->getOne($tb,'oncode=:oncode',array(':oncode'=>$_GPC['oncode']));
		$rpdata['infos']=$DBUtil->getMany('wys_tongcheng_store_order_info','oncode=:oncode',array(':oncode'=>$rpdata['oncode']));
		
		$up_data=array(
			'hexiao_use'=>1,
			'hexiao_uid'=>'',
			'hexiao_user'=>'',
			'hexiao_time'=>time()
			);
		$rpdata['hexiao_status']=$DBUtil->update($tb,$up_data,array('oncode'=>$_GPC['oncode']));
	}else if($op=='check_goods'){		
		$goods_det=$DBUtil->getOne('wys_tongcheng_store_goods','id=:id',array(':id'=>$_GPC['gid']));

		if(intval($goods_det['g_cnt_all'])!=0){
			$rpdata['check_kuccun']=intval($goods_det['g_cnt_all'])-intval($goods_det['g_cnt_sale'])>=1;
		}else{
			$rpdata['check_kuccun']=true;
		}

		if($goods_det['isopen_last_time']=='1'){
			if(intval($goods_det['last_time'])>time()){
				$rpdata['check_lasttime']=true;
			}else{
				$rpdata['check_lasttime']=false;
			}
		}else{
			$rpdata['check_lasttime']=true;
		}
		$rpdata['enable']=$goods_det['enable'];

	}



	//返回信息
	return $this->result($errno, $message, $rpdata);
?>