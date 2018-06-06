<?php



//echo floor(1.255*100)/100;  // 1.96
global $_W, $_GPC;

$DBUtil = new DBUtil();
//******需要修改的地方 开始******
//模板前缀
$h_name='store_info';
//操作名称
$h_title=urlencode('店铺管理');
//表名
$h_tb='wys_tongcheng_store';
//排序
$order='paystatus desc,enable asc';
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
	'pxh'=>trim($_GPC['pxh']),
	
	'msg_type'=>trim($_GPC['msg_type']),
	'content'=>trim($_GPC['content']),
	'enable'=>trim($_GPC['enable']),
	'crtime'=>time(),

	'is_sale'=>trim($_GPC['is_sale']),
	'money'=>trim($_GPC['money']),
	//'sale_status'=>trim($_GPC['sale_status']),
	'days'=>trim($_GPC['days']),
	'sale_openid'=>trim($_GPC['sale_openid']),	
	'audit_status'=>trim($_GPC['audit_status'])

	
	);

	if(empty($data['is_sale'])||$data['is_sale']=='0'){
		$data['lastdate']=$this->doAdDateF('day','+',90);
	}
	

if($op=='add'){	
	//增加出租状态为空闲
	$data['sale_status']='0';
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
$res = $DBUtil->delete($h_tb,array('id'=>$_GPC['ids']));
if($res){message('删除'.count($_GPC['ids']).'条成功!',referer(), 'success');
}else{message('删除失败!',referer(), 'error');}
return;	
}


//页面转及初始化其它操作说明模版
if($op=='del'){
$id=$_GPC['id'];	
$res = $DBUtil->delete($h_tb,array('uniacid'=>$_W['uniacid'], 'id'=>$id));
if($res){
	message('删除成功!',referer(), 'success');
}else{
	message('删除失败!',referer(), 'error');
}
}else if($op=='add'){
/*增加表单*/
//表单初始化开始
$det['enable']=1;//启用状态
$det['audit_status']=1;//审核状态
$det['money']=10;//出租每天金额
$det['pxh']=0;//排序
$det['is_sale']=0;//是否出租
$det['days']=0;//出租天数

//表单初始化结束
$pagediv='form';
//所有消息分类
$mtypelist=$DBUtil->getMany($DBUtil::wys_tongcheng_mtype,' uniacid=:uniacid and enable=:enable',array(':uniacid'=>$_W['uniacid'],':enable'=>1));
include $this->template('web/'.$h_name.'_page');
return;	
}else if($op=='edit'){
$id=$_GPC['id'];
$where='uniacid=:uniacid and id=:id';
$param=array(':uniacid'=>$_W['uniacid'],':id'=>$_GPC['id']);
$det=$DBUtil->getOne($h_tb,$where,$param);
//$start_diqu = $DBUtil->getDiqus('uniacid=:uniacid AND attr=:attr', array(':uniacid'=>$_W['uniacid'], ':attr'=>0));
//所有消息分类
$mtypelist=$DBUtil->getMany($DBUtil::wys_tongcheng_mtype,' uniacid=:uniacid and enable=:enable',array(':uniacid'=>$_W['uniacid'],':enable'=>1));


include $this->template('web/'.$h_name.'_page');
return;
}else if($op=='look'){
$id=$_GPC['id'];
$where='uniacid=:uniacid and id=:id';
$param=array(':uniacid'=>$_W['uniacid'],':id'=>$_GPC['id']);
$det=$DBUtil->getOne($DBUtil::wys_tongcheng_msg,$where,$param);
//$start_diqu = $DBUtil->getDiqus('uniacid=:uniacid AND attr=:attr', array(':uniacid'=>$_W['uniacid'], ':attr'=>0));
//echo 'sdfsdf|'.$det['content'];
include $this->template('web/msg_view');
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
}else if($op=='enable'){
//列表快捷按钮
$id=$_GPC['id'];
$enable=$_GPC['isopen'];
if($enable=='1'){
	$up_data=array(
		'enable'=>$enable,
		'sh_time'=>time()
		);

}else if($enable=='2'){
	$up_data=array(
		'sh_str'=>$_GPC['bhstr'],
		'enable'=>$enable,
		'sh_time'=>time()
		);
}

$res = $DBUtil->update($h_tb,$up_data,array('id'=>$id));
if($res){
	message('更新成功!',referer(), 'success');
}else{
	message('更新失败!',referer(), 'error');
}
}else if($op=='lastdate'){
//列表快捷按钮
$id=$_GPC['id'];
$lastdate=$this->doAdDateF('day','+',90);

$res = $DBUtil->update($h_tb,array('lastdate'=>$lastdate),array('id'=>$id));
if($res){
	message('更新成功!',referer(), 'success');
}else{
	message('更新失败!',referer(), 'error');
}
}

?>