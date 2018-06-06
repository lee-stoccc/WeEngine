<?php

global $_W, $_GPC;

$DBUtil = new DBUtil();
//******需要修改的地方 开始******
//模板前缀
$h_name='smrz';
//操作名称
$h_title=urlencode('实名认证');
//表名
$h_tb='wys_tongcheng_smrz';
//排序
$order=' id asc';
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
	'img'=>$_GPC['img'],
	'title'=>$_GPC['title'],
	'mid'=>trim($_GPC['mid']),
	'btype'=>trim($_GPC['btype']),
	'btypename'=>trim($_GPC['btypename']),

	'money'=>trim($_GPC['money']),
	'is_sale'=>trim($_GPC['is_sale']),
	'sale_status'=>trim($_GPC['sale_status']),
	'pxh'=>trim($_GPC['pxh']),

	'msg_type'=>trim($_GPC['msg_type']),
	'content'=>trim($_GPC['content']),
	
	'days'=>trim($_GPC['days']),
	'audit_status'=>trim($_GPC['audit_status']),
	'sale_openid'=>trim($_GPC['sale_openid']),
	'enable'=>trim($_GPC['enable']),
	'crtime'=>time()
	);

	if($data['is_sale']=='0'){
		$data['lastdate']=$this->doAdDateF('day','+',30);
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
	$id=$_GPC['id'];
	$res=$DBUtil->update($h_tb,$data,array('id'=>$id));

	if($res){message('修改成功', $this->createWebUrl($h_name.'_action'), 'success');
}else{
	message('修改失败', $this->createWebUrl($h_name.'_action'), 'error');
}
return;
}else if($op=='list'){
 
}

}
//列表批量删除
if(checksubmit('delete_selectd')){
$ids=$_GPC['ids'];
//删除服务器图片
foreach ($ids as $key => $smid){
$smrz_det = $DBUtil->getOne($h_tb,'id=:id',array('id'=>$smid));

$temp_mg1=str_replace($_W['attachurl'],'',$smrz_det['img1']);
if(file_exists(ATTACHMENT_ROOT.$temp_mg1)){unlink(ATTACHMENT_ROOT.$temp_mg1);}

$temp_mg1=str_replace($_W['attachurl'],'',$smrz_det['img2']);
if(file_exists(ATTACHMENT_ROOT.$temp_mg1)){unlink(ATTACHMENT_ROOT.$temp_mg1);}

$temp_mg1=str_replace($_W['attachurl'],'',$smrz_det['img3']);
if(file_exists(ATTACHMENT_ROOT.$temp_mg1)){unlink(ATTACHMENT_ROOT.$temp_mg1);}

$res = $DBUtil->delete($h_tb,array('id'=>$smid));
}


//$res = $DBUtil->delete($h_tb,array('id'=>$_GPC['ids']));
if($res){message('删除'.count($_GPC['ids']).'条成功!',referer(), 'success');
}else{message('删除失败!',referer(), 'error');}
return;	
}


//页面转及初始化其它操作说明模版
if($op=='audit_status'){
//下回处理
$id=$_GPC['id'];
$audit_status=$_GPC['audit_status'];
$smrz_det=$DBUtil->getOne($h_tb,'id=:id',array(':id'=>$id));

if($audit_status=='1'){
//关联所有消息为上架
$update_data=array('audit_status'=>'0');
$DBUtil->update('wys_tongcheng_msg',$update_data,array('u_openid'=>$smrz_det['openid'],'audit_status'=>'-2'));
$res=$DBUtil->update($h_tb,array('audit_status'=>$audit_status,'audit_time'=>time()),array('id'=>$id));

if($res){
	message('审核成功,用户关联信息状态为待审核,请前去消息管理审核!',referer(), 'success');
}else{
	message('处理失败!',referer(), 'error');
}

}else if($audit_status=='2'){
//关联所有消息下架
$update_data=array('audit_status'=>'-2','audit_desc'=>$_GPC['bhstr']);
echo var_dump($update_data);
$DBUtil->update('wys_tongcheng_msg',$update_data,array('u_openid'=>$smrz_det['openid']));

$res=$DBUtil->update($h_tb,array('audit_status'=>$audit_status,'audit_time'=>time(),'audit_rmk'=>$_GPC['bhstr']),array('id'=>$id));

if($res){
	message('审核驳回成功,用户关联信息状态为实名下架!',referer(), 'success');
}else{
	message('处理失败!',referer(), 'error');
}
}




}else if($op=='del'){
$id=$_GPC['id'];	

$smrz_det = $DBUtil->getOne($h_tb,'id=:id',array('id'=>$id));

$temp_mg1=str_replace($_W['attachurl'],'',$smrz_det['img1']);
if(file_exists(ATTACHMENT_ROOT.$temp_mg1)){unlink(ATTACHMENT_ROOT.$temp_mg1);}

$temp_mg1=str_replace($_W['attachurl'],'',$smrz_det['img2']);
if(file_exists(ATTACHMENT_ROOT.$temp_mg1)){unlink(ATTACHMENT_ROOT.$temp_mg1);}

$temp_mg1=str_replace($_W['attachurl'],'',$smrz_det['img3']);
if(file_exists(ATTACHMENT_ROOT.$temp_mg1)){unlink(ATTACHMENT_ROOT.$temp_mg1);}



$res = $DBUtil->delete($h_tb,array('uniacid'=>$_W['uniacid'], 'id'=>$id));
if($res){
	message('删除成功!',referer(), 'success');
}else{
	message('删除失败!',referer(), 'error');
}
}else if($op=='add'){
/*增加表单*/
//表单初始化开始
$det['enable']=0;
$det['money']=100;
$det['pxh']=0;
$det['is_sale']=0;
$det['audit_status']=0;
$det['days']=0;
$det['sale_status']=0;
//表单初始化结束

$pagediv='form';
include $this->template('web/'.$h_name.'_page');
return;	
}else if($op=='edit'){
$id=$_GPC['id'];
$where='uniacid=:uniacid and id=:id';
$param=array(':uniacid'=>$_W['uniacid'],':id'=>$_GPC['id']);
$det=$DBUtil->getOne($h_tb,$where,$param);
//$start_diqu = $DBUtil->getDiqus('uniacid=:uniacid AND attr=:attr', array(':uniacid'=>$_W['uniacid'], ':attr'=>0));
include $this->template('web/'.$h_name.'_page');
return;
}else if($op=='list'||$op==''){

$pagediv='list';
$where='uniacid=:uniacid';
$param=array(':uniacid'=>$_W['uniacid']);
$total=$DBUtil->getCount($h_tb,$where, $param);
//生成分页HTML
$result['pager']=pagination($total, $page, $pagesize);
$list=$DBUtil->getMany($h_tb,$where,$param,$order,$page, $pagesize);
include $this->template('web/'.$h_name.'_page');
return;	
}

?>