<?php

global $_W, $_GPC;
$DBUtil = new DBUtil();
//$det['rd_tw_imglist']=explode(',',$det['rd_tw_imglist']);  字符串转数组
//implode(',',$_GPC['rd_tw_imglist']) 数组转字符串
//******需要修改的地方 开始******
//模板前缀
$h_name='store_mtype';
//操作名称
$h_title=urlencode('店铺类型');
//表名
$h_tb='wys_tongcheng_store_mtype';
//排序
$order=' pxh asc';
//页面显示条数
$pagesize=20;

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

	//make by xuan
	'enter_money'=>$_GPC['enter_money'],

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
$ids=$_GPC['ids'];
foreach ($ids as $key => $id) {
	$res = $DBUtil->delete($h_tb,array('id'=>$id));
	$res = $DBUtil->delete($h_tb,array('attr'=>$id));
}
//$res = $DBUtil->delete($h_tb,array('id'=>$_GPC['ids']));
if($res){message('删除'.count($_GPC['ids']).'条成功!',referer(), 'success');
}else{message('删除失败!',referer(), 'error');}
return;	
}
//页面转及初始化其它操作说明模版
if($op=='init'){
//初始化店铺类型
$uniacid=$_W['uniacid'];

$sql='uniacid=:uniacid';
$sql_data=array(':uniacid'=>$_W['uniacid']);

$store_mtype_cnt=$DBUtil->getCount($h_tb,$sql,$sql_data);
if($store_mtype_cnt>0){
	message('初始化失败,你已有数据不可初始化!',referer(), 'warning');
}else{

$init_data=array(
	array(1,'餐饮美食',array('早点早餐','饭店餐厅','快餐外卖','烧烤麻辣','夜宵天地','火锅香辣','茶餐西餐','甜品饮料','零食水果')
		),
	array(2,'休闲娱乐',array('美容美发','游戏电玩','文体户外','汗蒸养生','网吧网咖','游泳馆','健身房','按摩推拿','足浴洗浴','咖啡厅','KTV','洒吧','电影院','茶馆')
		),
	array(3,'酒店旅游',array('星级酒店','旅游包车','商务宾馆','旅行社','旅游景点','农家乐','度假村')
		),
	array(4,'购物天地',array('文具办公','美容护肤','数码科技','保健养生','服装鞋包','眼镜饰品','家用电器','手机专卖','户外运动','茗茶烟酒','珍宝钟表','鲜花礼品','商行超市','生鲜特产','生鲜水产','海鲜水产')
		),
	array(5,'生活服务',array('的士/代驾','家政服务','送水站','宠物服务','开锁修锁','管道疏通','家电维修','二手回收','衣服洗护','搬家服务','快递服务','物流服务','货物运输','其它服务')
		),
	array(6,'汽车服务',array('摩托车/电动车','4S店','汽车美容','维修保养','驾校教练','汽配销售','车险信贷','汽车销售','汽车租赁','共享汽车')
		),
	array(7,'母婴专区',array('儿童玩具','母婴食品','母婴用品','母婴健康','母婴教育','母婴服务','月嫂服务')
		),
	array(8,'婚庆摄影',array('婚纱摄影','跟拍跟妆','影视制作','儿童摄影','婚庆公司','庆典礼仪','婚车租赁','喜糖铺子','主持司仪')
		),
	array(9,'教育培训',array('办公培训','职业技能','家政辅导','幼儿园','特长培训')
		),
	array(10,'家具建材',array('陶瓷卫浴','木地板','家私家具','衣柜橱柜','油漆涂料','装潢装饰','五金建材','水电管道','背景墙纸','家饰工艺','窗帘家纺','门窗灶炉','灯饰灯具','智能家具')
		),
	array(11,'房产相关',array('最新开盘','房屋中介','房产评估')
		),
	array(12,'商务服务',array('广告传媒','印刷包装','网络营销','法律咨询','工商注册','财务会计','设计策划','创业服务','软件服务')
		),
	array(13,'金融服务',array('快速贷款','典当抵押','保险公司','POS机','投资公司','股票期货','综合金融','代卡养卡')
		),
	array(14,'农林牧渔',array('农作物','园林花卉','畜禽养殖')
		),
	array(15,'医疗健康',array('美容整形','口腔健康','药店药房','医院诊所','健康体检')
		),
	);
$myfun =new MyFun();
foreach ($init_data as $key => $it) {
	$m_type=array(
		//'id'=>$it[0],
		'uniacid'=>$uniacid,
		'oncode'=>$myfun->randombylength(8),
		'tname'=>$it[1],
		'pxh'=>($key+1),
		'attr'=>'0',
		'is_parent_open'=>1,
		'crtime'=>time()
		);
	$DBUtil->save($h_tb,$m_type);
	foreach ($it[2] as $pkey => $pit) {
		$m_det=$DBUtil->getOne($h_tb,'uniacid=:uniacid and oncode=:oncode',array(':uniacid'=>$_W['uniacid'],':oncode'=>$m_type['oncode']));
		$p_type=array(
		'uniacid'=>$uniacid,
		'oncode'=>$myfun->randombylength(8),
		'tname'=>$pit,
		'pxh'=>($pkey+1),
		'attr'=>$m_det['id'],
		'is_parent_open'=>0,
		'crtime'=>time()
		);
	$DBUtil->save($h_tb,$p_type);
	}
	//echo '</br></br></br>';
}
message('初始化成功!',referer(), 'success');
}


//
//

}else if($op=='del_all'){
$DBUtil->delete($h_tb,array('uniacid'=>$_W['uniacid']));
message('删除所有成功!',referer(), 'success');

}else if($op=='del'){
$otid=$_GPC['oid'];
//新分类
$nid=$_GPC['nid'];
$mlevel=$_GPC['mlevel'];
if($mlevel=='main'){
//变更分类
$m_type=$DBUtil->getOne($h_tb,'id=:id',array(':id'=>$nid));
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
$pmtype=$DBUtil->getOne($h_tb,'id=:id',array(':id'=>$n_parent_id));
$upmsg_data['parent_tid']=$n_parent_id;
$upmsg_data['parent_tname']=$pmtype['tname'];
}
$ucnt=$DBUtil->getCount('wys_tongcheng_msg','tid=:tid',array(':tid'=>$otid));
$DBUtil->update('wys_tongcheng_msg',$upmsg_data,array('tid'=>$otid));
}else if($mlevel=='parent'){

$m_type=$DBUtil->getOne($h_tb,'id=:id',array(':id'=>$nid));
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
//$d=pdo_fetch('SELECT sum(look_cnt) cnt FROM '.tablename('wys_tongcheng_msg').' where tid=:tid', array(':tid'=>$mtype['id']));
//if($d['cnt']==''){$d['cnt']='0';}
$mtype['alllookcnt']=$DBUtil->getCount('wys_tongcheng_store','store_m_typeid=:store_m_typeid',array(':store_m_typeid'=>$mtype['id']));
	
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
$mtype['alllookcnt']=$DBUtil->getCount('wys_tongcheng_store','store_p_typeid=:store_p_typeid',array(':store_p_typeid'=>$mtype['id']));

}
include $this->template('web/'.$h_name.'_page');
return;	
}




?>