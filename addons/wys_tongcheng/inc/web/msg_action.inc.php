<?php
global $_W, $_GPC;


$myfun =new MyFun();
//$this->load('tpl');

$DBUtil = new DBUtil();
//******需要修改的地方 开始******
//模板前缀
$h_name='msg';
//操作名称
$h_title=urlencode('消息');
//表名
$h_tb=$DBUtil::wys_tongcheng_msg;
//排序
$order=' id desc';
//页面显示条数
$pagesize=10;

$op=!empty($_GPC['op'])?$_GPC['op']:'list';
$page = max(1, $_GPC['page']);
//******需要修改的地方 结束******

//表单提交
if(checksubmit()){
//******需要修改的地方******
$data=array(
	'uniacid'=>$_W['uniacid'],
	'content'=>$_GPC['content'],
	'audit_status'=>$_GPC['audit_status'],
	'is_placed_top'=>$_GPC['is_placed_top']
	);
if($data['is_placed_top']=='1'){
	$data['placed_top_duedate']=strtotime($_GPC['placed_top_duedate']);
}

if($op=='add'){	
	$res=$DBUtil->save($h_tb,$data);
//echo var_dump($data);exit;
	if($res){message('新增成功', $this->createWebUrl($h_name.'_action'), 'success');
}else{
	essage('新增失败', $this->createWebUrl($h_name.'_action'), 'error');
}
return;
}else if($op=='edit'){
	load()->func('tpl'); 
	$id=$_GPC['id'];

	$tid=$_GPC['tid'];
	$parent_tid=$_GPC['parent_tid'];
	$mtype=$DBUtil->getOne('wys_tongcheng_mtype','id=:id',array(':id'=>$tid));
	$data['tid']=$tid;
	$data['tname']=$mtype['tname'];
	if(empty($parent_tid) && $parent_tid!='0'){
		$data['parent_tid']=0;
		$data['parent_tname']='';
	}else{
		$pmtype=$DBUtil->getOne('wys_tongcheng_mtype','id=:id',array(':id'=>$parent_tid));
		$data['parent_tid']=$parent_tid;
		$data['parent_tname']=$pmtype['tname'];
	}


	$img_list=$_GPC['imgs_list'];
	$img_upurlList=array();
	foreach ($img_list as $key => $value) {
		array_push($img_upurlList, tomedia($value));
	}	
	$data['imgs_list']=implode(',',$img_upurlList);





	$res=$DBUtil->update($h_tb,$data,array('id'=>$id));

	if($res){message('修改成功', $this->createWebUrl($h_name.'_action'), 'success');
}else{
	message('修改失败',$this->createWebUrl($h_name.'_action'), 'warning');//
}
return;
}else if($op=='list'){
 
}

}


//批量审核通过
if(checksubmit('betch_shOK_selectd')){
$res = $DBUtil->update('wys_tongcheng_msg',array('audit_status'=>1),array('id'=>$_GPC['ids']));
if(count($_GPC['ids'])>0){
	

	$status_det=$DBUtil->getOne('wys_tongcheng_status','uniacid=:uniacid and stype=:stype',array(':uniacid'=>$_W['uniacid'],':stype'=>'msg'));
		if(empty($status_det)){
			$add_status=array(
				'uniacid'=>$_W['uniacid'],
				'stype'=>'msg',
				'status'=>'1',
				'crtime'=>time(),
				'modtime'=>time()
				);
			$DBUtil->save('wys_tongcheng_status',$add_status);
		}else{
			$add_status=array(
				'uniacid'=>$_W['uniacid'],
				'stype'=>'msg',
				'status'=>'1',
				'modtime'=>time()
				);
			
			$DBUtil->update('wys_tongcheng_status',$add_status,array('id'=>$status_det['id']));
		}
}

if($res){message('批量审核通过'.count($_GPC['ids']).'条成功!',referer(), 'success');
}else{message('批量审核失败!',referer(), 'error');}
return;	
}




//列表批量删除
if(checksubmit('delete_selectd')){
$ids=$_GPC['ids'];

//删除服务器图片
foreach ($ids as $key => $imgid){
$msg_det = $DBUtil->getOne($h_tb,'id=:id',array('id'=>$imgid));
$imglist=$DBUtil->getMany('wys_tongcheng_msg_imgs',' uniacid=:uniacid and oncode=:oncode',array(':uniacid'=>$_W['uniacid'],':oncode'=>$msg_det['oncode']));
foreach ($imglist as $key => $imgs) {
$temp_mg1=str_replace($_W['attachurl'],'',$imgs['imgpath']);
if(file_exists(ATTACHMENT_ROOT.$temp_mg1)){unlink(ATTACHMENT_ROOT.$temp_mg1);}
$DBUtil->delete('wys_tongcheng_msg_imgs',array('uniacid'=>$_W['uniacid'],'id'=>$imgs['id']));
//删除关联评论
$DBUtil->delete('wys_tongcheng_comments',array('uniacid'=>$_W['uniacid'], 'mid'=>$imgs['id']));
//关联幻灯片
$DBUtil->delete('wys_tongcheng_salebanner',array('uniacid'=>$_W['uniacid'],'openid'=>$msg_det['u_openid']));
}

//删除关联评论
//$DBUtil->delete('wys_tongcheng_comments',array('uniacid'=>$_W['uniacid'], 'mid'=>$imgid));


}



$res = $DBUtil->delete($h_tb,array('id'=>$_GPC['ids']));
if($res){message('删除'.count($_GPC['ids']).'条成功!',referer(), 'success');
}else{message('删除失败!',referer(), 'error');}
return;	
}

//更新图片
if(checksubmit('submit_upimage')){
$res = $DBUtil->update($DBUtil::wys_tongcheng_msg_imgs,array('imgpath'=>tomedia($_GPC['img'])),array('id'=>$_GPC['id']));
//更新图片信息列表
$imglist=$DBUtil->getMany($DBUtil::wys_tongcheng_msg_imgs,' uniacid=:uniacid and oncode=:oncode',array(':uniacid'=>$_W['uniacid'],':oncode'=>$_GPC['oncode']));
$imgstr='';
foreach ($imglist as $key => &$value) {
$imgstr= $imgstr.$value['imgpath'].',';
}
$DBUtil->update($DBUtil::wys_tongcheng_msg,array('imgs_list'=>$imgstr),array('id'=>$_GPC['mid']));

if($res){message('更新成功!',referer(), 'success');
}else{message('更新失败!',referer(), 'error');}
return;	
}

//删除图片
if(checksubmit('submit_delimage')){
$img_id=$_GPC['id'];

//删除服务器图片
$img_det=$DBUtil->getOne('wys_tongcheng_msg_imgs','id=:id',array(':id'=>$img_id));
$temp_mg1=str_replace($_W['attachurl'],'',$img_det['imgpath']);
if(file_exists(ATTACHMENT_ROOT.$temp_mg1)){unlink(ATTACHMENT_ROOT.$temp_mg1);}



$res = $DBUtil->delete($DBUtil::wys_tongcheng_msg_imgs,array('id'=>$_GPC['id']));

//更新图片信息列表
$imglist=$DBUtil->getMany($DBUtil::wys_tongcheng_msg_imgs,' uniacid=:uniacid and oncode=:oncode',array(':uniacid'=>$_W['uniacid'],':oncode'=>$_GPC['oncode']));
$imgstr='';
foreach ($imglist as $key => &$value) {
$imgstr= $imgstr.$value['imgpath'].',';
}
$DBUtil->update($DBUtil::wys_tongcheng_msg,array('imgs_list'=>$imgstr),array('id'=>$_GPC['mid']));


if($res){message('删除成功!',referer(), 'success');
}else{message('删除失败!',referer(), 'error');}
return;	
}



//页面转及初始化其它操作说明模版
//
if($op=='comments'){
$id=$_GPC['id'];	
$res = $DBUtil->update($h_tb,array('comments_isopen'=>$_GPC['isopen']),array('id'=>$id));
//删除关联评论
$DBUtil->delete($DBUtil::wys_tongcheng_comments,array('uniacid'=>$_W['uniacid'], 'mid'=>$id));
if($res){
	message('操作成功!',referer(), 'success');
}else{
	message('操作失败!',referer(), 'error');
}
}else if($op=='audit_status'){
//快捷审核按钮
$id=$_GPC['id'];

if($_GPC['isopen']=='1'){

	$status_det=$DBUtil->getOne('wys_tongcheng_status','uniacid=:uniacid and stype=:stype',array(':uniacid'=>$_W['uniacid'],':stype'=>'msg'));
		if(empty($status_det)){
			$add_status=array(
				'uniacid'=>$_W['uniacid'],
				'stype'=>'msg',
				'status'=>'1',
				'crtime'=>time(),
				'modtime'=>time()
				);
			$DBUtil->save('wys_tongcheng_status',$add_status);
		}else{
			$add_status=array(
				'uniacid'=>$_W['uniacid'],
				'stype'=>'msg',
				'status'=>'1',
				'modtime'=>time()
				);
			
			$DBUtil->update('wys_tongcheng_status',$add_status,array('id'=>$status_det['id']));
		}


}

$res = $DBUtil->update($h_tb,array('audit_status'=>$_GPC['isopen']),array('id'=>$id));
//删除关联评论
$DBUtil->delete($DBUtil::wys_tongcheng_comments,array('uniacid'=>$_W['uniacid'], 'mid'=>$id));
if($res){
	message('操作成功!',referer(), 'success');
}else{
	message('操作失败!',referer(), 'error');
}
}else if($op=='del'){
//删除消息
$id=$_GPC['id'];

$msg_det = $DBUtil->getOne('wys_tongcheng_msg','id=:id',array('id'=>$id));
$imglist=$DBUtil->getMany('wys_tongcheng_msg_imgs',' uniacid=:uniacid and oncode=:oncode',array(':uniacid'=>$_W['uniacid'],':oncode'=>$msg_det['oncode']));
foreach ($imglist as $key => $imgs) {
$temp_mg1=str_replace($_W['attachurl'],'',$imgs['imgpath']);
if(file_exists(ATTACHMENT_ROOT.$temp_mg1)){unlink(ATTACHMENT_ROOT.$temp_mg1);}
$DBUtil->delete('wys_tongcheng_msg_imgs',array('uniacid'=>$_W['uniacid'],'id'=>$imgs['id']));		
}

//删除关联评论
$DBUtil->delete('wys_tongcheng_comments',array('uniacid'=>$_W['uniacid'], 'mid'=>$id));
//删除幻灯片
$DBUtil->delete('wys_tongcheng_salebanner',array('uniacid'=>$_W['uniacid'],'openid'=>$msg_det['u_openid']));
//删除消息主体
$res = $DBUtil->delete('wys_tongcheng_msg',array('uniacid'=>$_W['uniacid'], 'id'=>$id));



if($res){
	message('删除成功!',referer(), 'success');
}else{
	message('删除失败!',referer(), 'error');
}

}else if($op=='add'){
/*增加表单*/
//表单初始化开始
$det['enable']=1;
$det['show_index']=1;
$det['pxh']=0;
$det['send_money']=10;
//表单初始化结束

$pagediv='form';
include $this->template('web/'.$h_name.'_page');
return;	
}else if($op=='edit'){
$id=$_GPC['id'];
$where='uniacid=:uniacid and id=:id';
$param=array(':uniacid'=>$_W['uniacid'],':id'=>$_GPC['id']);
$det=$DBUtil->getOne($h_tb,$where,$param);

//$imglist=$DBUtil->getMany($DBUtil::wys_tongcheng_msg_imgs,' uniacid=:uniacid and oncode=:oncode',array(':uniacid'=>$_W['uniacid'],':oncode'=>$det['oncode']));

$imgs_list_str=explode(',',$det['imgs_list']); 
$img_upurlList=array();
foreach ($imgs_list_str as $key => $it) {
	if($it!=''){
	array_push($img_upurlList,$it);
	}
}
$det['imgs_list']=$img_upurlList;
//echo var_dump($det['imgs_list']);



$mlist=$DBUtil->getMany('wys_tongcheng_mtype','uniacid=:uniacid and enable=:enable',array(':uniacid'=>$_W['uniacid'],':enable'=>1));
// if($det['parent_tid']!='0'){
// $mlist_parent=$DBUtil->getMany('wys_tongcheng_mtype','uniacid=:uniacid and enable=:enable and attr=:attr',array(':uniacid'=>$_W['uniacid'],':enable'=>1,':attr'=>$det['tid']));	
// }

include $this->template('web/'.$h_name.'_page');
return;
}else if($op=='list'||$op==''){
$page_type='list';
//$where='uniacid=:uniacid and audit_status="0" and ( (is_placed_top="0" and total_money>0) or (is_placed_top="1" and payStatus="1") )';
$pagediv='list';
$where='uniacid=:uniacid and (audit_status=0 and total_money=0) or ( audit_status=0 and total_money>0 and payStatus=1 )';
$param=array(':uniacid'=>$_W['uniacid']);
$total=$DBUtil->getCount($h_tb,$where, $param);
//生成分页HTML
$result['pager']=pagination($total, $page, $pagesize);
$list=$DBUtil->getMany($h_tb,$where,$param,$order,$page, $pagesize);

foreach ($list as $key => &$value) {
	$value['content']=$myfun->textDecode($value['content']);
	$value['shang_all_money']=round(pdo_fetchcolumn("select sum(total_money) from ".tablename('wys_tongcheng_payorder')."where uniacid=:uniacid and ordertype=:ordertype and dt_id=:dt_id", array(':uniacid' =>$_W['uniacid'],':ordertype'=>'shang',':dt_id'=>$value['id'])),2);


}


include $this->template('web/'.$h_name.'_page');
return;	
}else if($op=='list_all'){
$page_type='list_all';
//所有消息
$pagediv='list';
$where='uniacid=:uniacid';
$param=array(':uniacid'=>$_W['uniacid']);
$total=$DBUtil->getCount($h_tb,$where, $param);
//生成分页HTML
$result['pager']=pagination($total, $page, $pagesize);
$list=$DBUtil->getMany($h_tb,$where,$param,$order,$page, $pagesize);

foreach ($list as $key => &$value) {
	$value['content']=$myfun->textDecode($value['content']);
	$value['shang_all_money']=round(pdo_fetchcolumn("select sum(total_money) from ".tablename('wys_tongcheng_payorder')."where uniacid=:uniacid and ordertype=:ordertype and dt_id=:dt_id", array(':uniacid' =>$_W['uniacid'],':ordertype'=>'shang',':dt_id'=>$value['id'])),2);

}


include $this->template('web/'.$h_name.'_page');
return;	
}else if($op=='list_search'){
$page_type='list_all';
$pagediv='list';
$where='uniacid=:uniacid';
$param=array(':uniacid'=>$_W['uniacid']);


$sql_text=$_GPC['sql_text'];//搜索的信息
if(!empty($sql_text)){
$where.=' and (content like :cont or tname like :cont or u_nickname like :cont)';
$param[':cont']='%'.$sql_text.'%';
}

$u_openid=$_GPC['u_openid'];//搜索的信息
if(!empty($u_openid)){
$where.=' and u_openid=:u_openid';
$param[':u_openid']=$u_openid;
}


$total=$DBUtil->getCount($h_tb,$where, $param);
//生成分页HTML
$result['pager']=pagination($total, $page, $pagesize);
$list=$DBUtil->getMany($h_tb,$where,$param,$order,$page, $pagesize);

foreach ($list as $key => &$value) {
$value['content']=str_replace($sql_text,'<font color=\'red\' weight=\'bold\'>'.$sql_text.'</font>',$value['content']);
$value['tname']=str_replace($sql_text,'<font color=\'red\'>'.$sql_text.'</font>',$value['tname']);
$value['u_nickname']=str_replace($sql_text,'<font color=\'red\'>'.$sql_text.'</font>',$value['u_nickname']);
}
include $this->template('web/'.$h_name.'_page');
return;	
}else if($op=='audit_status_0'){
//所有未审核
$page_type='audit_status_0';
$pagediv='list';
$where='uniacid=:uniacid and audit_status=:audit_status';
$param=array(':uniacid'=>$_W['uniacid'],':audit_status'=>0);
$total=$DBUtil->getCount($h_tb,$where, $param);
//生成分页HTML
$result['pager']=pagination($total, $page, $pagesize);
$list=$DBUtil->getMany($h_tb,$where,$param,$order,$page, $pagesize);
foreach ($list as $key => &$value) {
	$value['content']=$myfun->textDecode($value['content']);
}
include $this->template('web/'.$h_name.'_page');
return;	
}else if($op=='payStatus_msg_0'){
$page_type='payStatus_msg_0';
//所有发帖未支付
$pagediv='list';
$where='uniacid=:uniacid and payStatus=:payStatus and default_money>:default_money';
$param=array(':uniacid'=>$_W['uniacid'],':payStatus'=>0,':default_money'=>0);
$total=$DBUtil->getCount($h_tb,$where, $param);
//生成分页HTML
$result['pager']=pagination($total, $page, $pagesize);
$list=$DBUtil->getMany($h_tb,$where,$param,$order,$page, $pagesize);
foreach ($list as $key => &$value) {
	$value['content']=$myfun->textDecode($value['content']);
}
include $this->template('web/'.$h_name.'_page');
return;	
}else if($op=='payStatus_top_1'){
$page_type='payStatus_top_1';
//所有置顶未支付
$pagediv='list';
$where='uniacid=:uniacid and payStatus=:payStatus and is_placed_top=:is_placed_top';
$param=array(':uniacid'=>$_W['uniacid'],':payStatus'=>0,':is_placed_top'=>1);
$total=$DBUtil->getCount($h_tb,$where, $param);
//生成分页HTML
$result['pager']=pagination($total, $page, $pagesize);
$list=$DBUtil->getMany($h_tb,$where,$param,$order,$page, $pagesize);
foreach ($list as $key => &$value) {
	$value['content']=$myfun->textDecode($value['content']);
}
include $this->template('web/'.$h_name.'_page');
return;	
}else if($op=='payStatus_top_3'){
$page_type='payStatus_top_3';
//所有成功置顶
$pagediv='list';
$where='uniacid=:uniacid and payStatus=:payStatus and is_placed_top=:is_placed_top';
$param=array(':uniacid'=>$_W['uniacid'],':payStatus'=>1,':is_placed_top'=>1);

// $where='uniacid=:uniacid and is_placed_top=:is_placed_top and payStatus=:payStatus';
// $param=array(':uniacid'=>$_W['uniacid'],':is_placed_top'=>1,':payStatus'=>1);

$total=$DBUtil->getCount($h_tb,$where, $param);
//生成分页HTML
$result['pager']=pagination($total, $page, $pagesize);
$list=$DBUtil->getMany($h_tb,$where,$param,$order,$page, $pagesize);
foreach ($list as $key => &$value) {
	$value['content']=$myfun->textDecode($value['content']);
}
include $this->template('web/'.$h_name.'_page');
return;	
}


//
?>