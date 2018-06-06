<?php

global $_W, $_GPC;

$DBUtil = new DBUtil();
//******需要修改的地方 开始******
//模板前缀
$h_name='jubao';
//操作名称
$h_title=urlencode('举报信息');
//表名
$h_tb=$DBUtil::wys_tongcheng_jubao;
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
$res = $DBUtil->delete($h_tb,array('id'=>$_GPC['ids']));
if($res){message('删除'.count($_GPC['ids']).'条成功!',referer(), 'success');
}else{message('删除失败!',referer(), 'error');}
return;	
}


//页面转及初始化其它操作说明模版
if($op=='xiajia'){
//下回处理
$id=$_GPC['id'];	
$jubao_mod=$DBUtil->getOne($h_tb,'id=:id',array(':id'=>$id));
$res=$DBUtil->update($DBUtil::wys_tongcheng_msg,array('audit_status'=>-1,'audit_desc'=>$jubao_mod['jb_conent']),array('id'=>$_GPC['mid']));
$res=$DBUtil->update($h_tb,array('cl_state'=>1),array('id'=>$id));

if($res){
	message('处理成功!',referer(), 'success');
}else{
	message('处理失败!',referer(), 'error');
}
}else if($op=='del'){
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
}

?>