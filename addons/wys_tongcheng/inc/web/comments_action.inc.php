<?php
global $_W, $_GPC;

$DBUtil = new DBUtil();
//******需要修改的地方 开始******
//模板前缀
$h_name='comments';
//操作名称
$h_title=urlencode('评论管理');
//表名
$h_tb=$DBUtil::wys_tongcheng_comments;
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
	'tname'=>$_GPC['tname'],
	'send_money'=>trim($_GPC['send_money']),
	'warn_words'=>trim($_GPC['warn_words']),
	'is_audit'=>trim($_GPC['is_audit']),
	'img'=>trim($_GPC['img']),

	'show_index'=>trim($_GPC['show_index']),
	'pxh'=>trim($_GPC['pxh']),
	'manager_openid'=>trim($_GPC['manager_openid']),
	'enable'=>trim($_GPC['enable']),
	'crtime'=>time()
	);
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
}else if($op=='list_search'){

$pagediv='list';
$where='uniacid=:uniacid';
$param=array(':uniacid'=>$_W['uniacid']);

$sql_text=$_GPC['sql_text'];//搜索的信息


if(!empty($sql_text)){
$where.=' and (mid like :cont or m_content like :cont or rp_nickname like :cont or u_nickname like :cont or mcontent  like :cont)';
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
$value['m_content']=str_replace($sql_text,'<font color=\'red\' weight=\'bold\'>'.$sql_text.'</font>',$value['m_content']);
$value['rp_nickname']=str_replace($sql_text,'<font color=\'red\'>'.$sql_text.'</font>',$value['rp_nickname']);
$value['u_nickname']=str_replace($sql_text,'<font color=\'red\'>'.$sql_text.'</font>',$value['u_nickname']);
$value['mcontent']=str_replace($sql_text,'<font color=\'red\'>'.$sql_text.'</font>',$value['mcontent']);


}


include $this->template('web/'.$h_name.'_page');
return;	
}

?>