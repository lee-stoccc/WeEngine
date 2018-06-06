<?php

global $_W, $_GPC;
$DBUtil = new DBUtil();
//$det['rd_tw_imglist']=explode(',',$det['rd_tw_imglist']);  字符串转数组
//implode(',',$_GPC['rd_tw_imglist']) 数组转字符串
//******需要修改的地方 开始******
//模板前缀
$h_name='mtype';
//操作名称
$h_title=urlencode('消息分类');
//表名
$h_tb=$DBUtil::wys_tongcheng_mtype;
//排序
$order=' pxh asc';
//页面显示条数
$pagesize=10;

$op=!empty($_GPC['op'])?$_GPC['op']:'list';
$page = max(1, $_GPC['page']);
//******需要修改的地方 结束******

//表单提交
if(checksubmit()){
//******需要修改的地方******

//echo var_dump($_GPC['rd_tw_imglist']);exit;

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
	'attr'=>$_GPC['attr'],
	'crtime'=>time(),

	'type'=>$_GPC['type'],
	'rd_wx_appid'=>$_GPC['rd_wx_appid'],
	'rd_wx_path'=>$_GPC['rd_wx_path'],
	'rd_wx_extradata'=>$_GPC['rd_wx_extradata'],
	'rd_wx_envversion'=>$_GPC['rd_wx_envversion'],	
	'rd_tw_rmk'=>$_GPC['rd_tw_rmk'],
	'rd_tw_title'=>$_GPC['rd_tw_title']
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

	$img_list=$_GPC['rd_tw_imglist'];
	$img_upurlList=array();
	foreach ($img_list as $key => $value) {
		array_push($img_upurlList, tomedia($value));
	}	
	$data['rd_tw_imglist']=implode(',',$img_upurlList);

	$res=$DBUtil->update($h_tb,$data,array('id'=>$id));

	if($res){message('修改成功', $this->createWebUrl($h_name.'_action'), 'success');
}else{
	message('修改失败', $this->createWebUrl($h_name.'_action'), 'error');
}
return;
}else if($op=='parent_add'){	
	$res=$DBUtil->save($h_tb,$data);
	if($res){message('新增二级分类成功',$this->createWebUrl($h_name.'_action',array('op'=>'parent_list','id'=>$_GPC['pattr'],'tname'=>$_GPC['pattrname'])), 'success');
}else{
	essage('新增二级分类失败', $this->createWebUrl($h_name.'_action',array('op'=>'parent_list','id'=>$_GPC['pattr'],'tname'=>$_GPC['pattrname'])), 'error');
}
return;
}else if($op=='parent_edit'){
	$id=$_GPC['id'];

	$img_list=$_GPC['rd_tw_imglist'];
	$img_upurlList=array();
	foreach ($img_list as $key => $value) {
		array_push($img_upurlList, tomedia($value));
	}	
	$data['rd_tw_imglist']=implode(',',$img_upurlList);

	$res=$DBUtil->update($h_tb,$data,array('id'=>$id));

	if($res){message('修改成功', $this->createWebUrl($h_name.'_action',array('op'=>'parent_list','id'=>$_GPC['pattr'],'tname'=>$_GPC['pattrname'])), 'success');
}else{
	message('修改失败',$this->createWebUrl($h_name.'_action',array('op'=>'parent_list','id'=>$_GPC['pattr'],'tname'=>$_GPC['pattrname'])), 'error');
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
$otid=$_GPC['oid'];
//新分类
$nid=$_GPC['nid'];
$mlevel=$_GPC['mlevel'];
if($mlevel=='main'){
//变更分类
$m_type=$DBUtil->getOne('wys_tongcheng_mtype','id=:id',array(':id'=>$nid));
$upmsg_data=array(
	'tid'=>$m_type['id'],
	'tname'=>$m_type['tname']
	);
//新的字类
$n_parent_id=$_GPC['n_parent_id'];
if(empty($n_parent_id) && $n_parent_id!='0'){
$upmsg_data['parent_tid']='0';
$upmsg_data['parent_tname']='';
}else{
$pmtype=$DBUtil->getOne('wys_tongcheng_mtype','id=:id',array(':id'=>$n_parent_id));
$upmsg_data['parent_tid']=$n_parent_id;
$upmsg_data['parent_tname']=$pmtype['tname'];
}
$ucnt=$DBUtil->getCount('wys_tongcheng_msg','tid=:tid',array(':tid'=>$otid));
$DBUtil->update('wys_tongcheng_msg',$upmsg_data,array('tid'=>$otid));
}else if($mlevel=='parent'){

$m_type=$DBUtil->getOne('wys_tongcheng_mtype','id=:id',array(':id'=>$nid));
$upmsg_data=array(
	'parent_tid'=>$m_type['id'],
	'parent_tname'=>$m_type['tname']
	);
$ucnt=$DBUtil->getCount('wys_tongcheng_msg','parent_tid=:parent_tid',array(':parent_tid'=>$otid));
$DBUtil->update('wys_tongcheng_msg',$upmsg_data,array('parent_tid'=>$otid));
}

//cho $otid.'|'.$nid;exit;


//删除分类
$res = $DBUtil->delete($h_tb,array('uniacid'=>$_W['uniacid'], 'id'=>$otid));
if($res){
	message('删除合并'.$ucnt.'条成功!',referer(), 'success');
}else{
	message('删除失败!',referer(), 'error');
}
}else if($op=='add'){
/*增加表单*/
//表单初始化开始
$det['enable']=1;
$det['show_index']=1;
$det['pxh']=0;
$det['send_money']=0;
$det['attr']=0;
$det['type']=0;
$show_index=true;
$det['rd_wx_extradata']='{test:1}';

//表单初始化结束

$pagediv='form';
include $this->template('web/'.$h_name.'_page');
return;	
}else if($op=='edit' || $op=='parent_edit'){
$show_index=true;
$id=$_GPC['id'];

$tname=$_GPC['tname'];
$where='uniacid=:uniacid and id=:id';
$param=array(':uniacid'=>$_W['uniacid'],':id'=>$_GPC['id']);
$det=$DBUtil->getOne($h_tb,$where,$param);

$det['rd_tw_imglist']=explode(',',$det['rd_tw_imglist']); 
if(empty($det['rd_wx_extradata'])|| $det['rd_wx_extradata']==''){
	$det['rd_wx_extradata']='{test:1}';


}

//$data='{"ids":1}'; 
//echo var_dump(json_decode($data)).'</br>'; 
//$ff =json_decode($data);
//echo "string>>>>".$ff->ids;




include $this->template('web/'.$h_name.'_page');
return;
}else if($op=='list'||$op==''){
$pagediv='list';
$where='uniacid=:uniacid and attr=:attr';
$param=array(':uniacid'=>$_W['uniacid'],':attr'=>0);
$total=$DBUtil->getCount($h_tb,$where, $param);
//生成分页HTML
$result['pager']=pagination($total, $page, $pagesize);
$list=$DBUtil->getMany($h_tb,$where,$param,$order,$page, $pagesize);

foreach ($list as $key => &$mtype) {
$d=pdo_fetch('SELECT sum(look_cnt) cnt FROM '.tablename('wys_tongcheng_msg').' where tid=:tid', array(':tid'=>$mtype['id']));
if($d['cnt']==''){$d['cnt']='0';}
$mtype['alllookcnt']=$d['cnt'];
	// //look_cnt , 'uid'
}
include $this->template('web/'.$h_name.'_page');
return;	
}else if($op=='is_audit'){
$id=$_GPC['id'];$res = $DBUtil->update($h_tb,array($op=>$_GPC['isopen']),array('id'=>$id));
if($res){message('操作成功!',referer(), 'success');
}else{	message('操作失败!',referer(), 'error');}}
else if($op=='enable'){
$id=$_GPC['id'];$res = $DBUtil->update($h_tb,array($op=>$_GPC['isopen']),array('id'=>$id));
if($res){message('操作成功!',referer(), 'success');
}else{	message('操作失败!',referer(), 'error');}}
else if($op=='is_parent_open'){
$id=$_GPC['id'];$res = $DBUtil->update($h_tb,array($op=>$_GPC['isopen']),array('id'=>$id));
if($res){message('操作成功!',referer(), 'success');
}else{	message('操作失败!',referer(), 'error');}}
else if($op=='show_index'){
$id=$_GPC['id'];$res = $DBUtil->update($h_tb,array($op=>$_GPC['isopen']),array('id'=>$id));
if($res){message('操作成功!',referer(), 'success');
}else{	message('操作失败!',referer(), 'error');}}


else if($op=='parent_add'){
$det['attr']=$_GPC['id'];
$tname=$_GPC['tname'];

/*增加表单*/
//表单初始化开始
$show_index=false;
$det['enable']=1;
$det['show_index']=0;
$det['pxh']=0;
$det['send_money']=0;
$det['type']=0;
//表单初始化结束

$pagediv='form';
include $this->template('web/'.$h_name.'_page');
return;	
}else if($op=='parent_list'){
$tname=$_GPC['tname'];
$attr=$_GPC['id'];
$pagediv='parent_list';
$where='uniacid=:uniacid and attr=:attr';
$param=array(':uniacid'=>$_W['uniacid'],':attr'=>$attr);
$total=$DBUtil->getCount($h_tb,$where, $param);
//生成分页HTML
$result['pager']=pagination($total, $page, $pagesize);
$list=$DBUtil->getMany($h_tb,$where,$param,$order,$page, $pagesize);

foreach ($list as $key => &$mtype) {
$d=pdo_fetch('SELECT sum(look_cnt) cnt FROM '.tablename('wys_tongcheng_msg').' where tid=:tid', array(':tid'=>$mtype['id']));
if($d['cnt']==''){$d['cnt']='0';}
$mtype['alllookcnt']=$d['cnt'];
	// //look_cnt , 'uid'
}
include $this->template('web/'.$h_name.'_page');
return;	
}




?>