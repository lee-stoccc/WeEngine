<?php
//商品管理
global $_GPC, $_W;
	$DBUtil = new DBUtil();
	$myfun =new MyFun();//$myfun->randombylength(8)
	$setting = $this->module['config'];//$setting['qq_map_key']
	//表名
	$tb='wys_tongcheng_store_goods';
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
			's_id'=>$_GPC['s_id'],
			's_name'=>$_GPC['s_name'],
			'g_type'=>$_GPC['g_type'],
			'g_name'=>$_GPC['g_name'],
			'g_cnt_all'=>$_GPC['g_cnt_all'],
			'money_mengshi'=>$_GPC['money_mengshi'],
			'money_sale'=>$_GPC['money_sale'],
			'isopen_newkefu'=>$_GPC['isopen_newkefu'],
			'money_newkefu_reduction'=>$_GPC['isopen_newkefu']=='true'?$_GPC['money_newkefu_reduction']:'',
			'tc_info'=>$_GPC['tc_info'],
			'isopen_last_time'=>$_GPC['isopen_last_time'],
			'last_time'=>$_GPC['isopen_last_time']=='true'?strtotime($_GPC['last_time']):''
			);
		if($op=='add'){

			if($setting['goods_sh_isopen']=='1'){
				$data['enable']='0';
			}else{
				$data['enable']='1';
			}


			//
			$data['crtime']=time();
			$oncode=time().$myfun->randombylength(8);
			$data['oncode']=$oncode;
			$DBUtil->save($tb,$data);
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
		$rpdata['imgs_list_arr']=$this->getList_imsg_list($rpdata['imgs_list']);
		if(!empty($rpdata['last_time'])){
		$rpdata['last_time']=date('Y-m-d',$rpdata['last_time']);
		}



	}else if($op=='get_one_view'){
		$rpdata=$DBUtil->getOne($tb,'oncode=:oncode',array(':oncode'=>$_GPC['oncode']));
		$rpdata['imgs_list_arr']=$this->getList_imsg_list($rpdata['imgs_list']);
		if(!empty($rpdata['last_time'])){
		$rpdata['last_time']=date('Y-m-d',$rpdata['last_time']);
		}

		$cnt_comment_all_store=$DBUtil->getMany('wys_tongcheng_store_comments','s_id=:s_id',array(':s_id'=>$rpdata['s_id']));
		$all_score=0;
		foreach ($cnt_comment_all_store as $key_ct => &$ct) {
			$all_score+=floatval($ct['score']);
		}

        $store_info = $DBUtil->getOne('wys_tongcheng_store','id=:id',array(':id'=>$rpdata['s_id']));

		$store_info['score_all']= 2; //floatval($all_score/count($cnt_comment_all_store ));

		$store_info['score_m']=$this->getScore_m(floatval($all_score/count($cnt_comment_all_store )));
		$store_info['score_p']=$this->getScore_p(floatval($all_score/count($cnt_comment_all_store )));

		$rpdata['store']=$store_info;

		$rpdata['cnt_comments']=$DBUtil->getCount('wys_tongcheng_store_comments','s_id=:s_id and pl_ctype=:pl_ctype',array(':s_id'=>$rpdata['s_id'],':pl_ctype'=>'main'));

		$cnt_comment_all=$DBUtil->getMany('wys_tongcheng_store_comments','goods_id=:goods_id and pl_ctype=:pl_ctype',array(':goods_id'=>$rpdata['id'],':pl_ctype'=>'main'),'crtime desc',1,5);
		foreach ($cnt_comment_all as $key_ct => &$ct) {
			$ct['imgs_list']=$this->getList_imsg_list($ct['imgs_list']);
			$ct['score_m']=$this->getScore_m(floatval($ct['score']));
			$ct['score_p']=$this->getScore_p(floatval($ct['score']));
			$ct['crtime']=$myfun->friendlyDate($ct['crtime'],'ym_time');
			$ct['comments_p']=$DBUtil->getMany('wys_tongcheng_store_comments','attr=:attr',array(':attr'=>$ct['id']));
		}
		$rpdata['cnt_comment_all']=$cnt_comment_all;
		$rpdata['goods_list']=$DBUtil->getMany('wys_tongcheng_store_goods','s_id=:s_id',array(':s_id'=>$rpdata['s_id']));

		$rpdata['imgs_one']=$this->getList_imsg_one($rpdata['imgs_list']);

		// $is_buyt=$DBUtil->getCount('wys_tongcheng_store_order_info','goods_id=:goods_id and openid=:openid',array(':goods_id'=>$rpdata['id'],':openid'=>$openid));
		// if($is_buyt!=0){
		// 	$rpdata['isopen_newkefu']=false;
		// }

		//$rpdata=$DBUtil->getOne($tb,'oncode=:oncode',array(':oncode'=>$_GPC['oncode']));
		//$cnt_look=$rpdata['cnt_look']+1;
		//$DBUtil->update($tb,array('cnt_look'=>$cnt_look),array('id'=>$rpdata['id']));

	}else if($op=='list_my'){
		//根据用户ID 取店铺列表
		$rpdata=$DBUtil->getMany($tb,'openid=:openid',array(':openid'=>$openid),$order);
		foreach ($rpdata as $key => &$it) {
			$it['img_store_mentou']=$this->getList_imsg_one($it['imgs_list']);//current(explode(',', $it['imgs_list']));
		}


	}else if($op=='list_store'){
		//所有店铺
		$list=$DBUtil->getMany($tb,'openid=:openid',array(':openid'=>$openid),$order);
		$main_arr=array();
		$main_arr_id=array();
		foreach ($list as $key => $it) {
		array_push($main_arr, $it['s_name']);
		array_push($main_arr_id, $it['id']);
		}
	$rpdata['main_arr']=$main_arr;
	$rpdata['main_arr_id']=$main_arr_id;

	}else if($op=='del_img_list'){
	//删除商品其中一个图片信息
	$goods_det=$DBUtil->getOne($tb,'uniacid=:uniacid and oncode=:oncode',array(':uniacid'=>$_W['uniacid'],':oncode'=>$_GPC['oncode']));
	$del_img=$_GPC['del_img'];

	$imgs=explode(',', $goods_det['imgs_list']);
	$img_upurlList=array();
	$is_have=false;
	foreach ($imgs as $key => $it) {
		if(!empty($it)){
			if($it==$del_img){
				$is_have=true;
				$temp_mg1=str_replace($_W['attachurl'],'',$del_img);
				if(file_exists(ATTACHMENT_ROOT.$temp_mg1)){unlink(ATTACHMENT_ROOT.$temp_mg1);}
			}else{

				array_push($img_upurlList,$it);

			}
		}
	}
	//$rpdata['del_img']=$del_img;
	$rpdata['is_have']=$is_have;
	//$rpdata['goods_det']=$goods_det;

	$DBUtil->update($tb,array('imgs_list'=>implode(',', $img_upurlList)),array('uniacid'=>$_W['uniacid'],'oncode'=>$_GPC['oncode']));


	}else if($op=='check_store'){
		//检查店铺
		//审核驳回 店铺到期



	}

	//返回信息
   return $this->result($errno, $message, $rpdata);
