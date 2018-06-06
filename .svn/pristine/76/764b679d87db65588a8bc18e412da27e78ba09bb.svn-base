<?php
global $_W, $_GPC;
$DBUtil = new DBUtil();
//******需要修改的地方 开始******
$nowtime=time();
//模板前缀
$h_name='bannersale';
//操作名称
$h_title=urlencode('幻灯片出租');
//表名
$h_tb=$DBUtil::wys_tongcheng_salebanner;
//排序
$order=' audit_status desc,paystate desc,crtime desc';
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
	'img'=>tomedia($_GPC['img']),
	'bn_total_money'=>$_GPC['bn_total_money']
	);

	// if(empty($data['is_sale'])||$data['is_sale']=='0'){
	// 	$data['lastdate']=$this->doAdDateF('day','+',90);
	// }
	

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
	//修改关联幻灯的图片

//取出租信息主体
$sale_banner=$DBUtil->getOne('wys_tongcheng_salebanner',' uniacid=:uniacid and id=:id',array(':uniacid'=>$_W['uniacid'],':id'=>$id));
if($sale_banner['audit_status']=='1' && $sale_banner['paystate']=='1'){
//已审核直接幻灯图片
	$update_banner=array(
	'sale_img'=>tomedia($_GPC['img'])//修改出租显示幻灯
	);
$DBUtil->update('wys_tongcheng_banner',$update_banner,array('id'=>$sale_banner['bn_id']));
}



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
//取出租信息主体
$sale_banner=$DBUtil->getOne('wys_tongcheng_salebanner',' uniacid=:uniacid and id=:id',array(':uniacid'=>$_W['uniacid'],':id'=>$id));

$update_banner=array(
	'sale_status'=>0,//出租状态
	'sale_openid'=>'',//租借人openid
	'days'=>0,//租借天数
	'lastdate'=>$this->doAdDateF('day','+',90),
	'mid'=>'',
	'msg_type'=>0,//自定义内容
	'sale_img'=>''
	);
$res=$DBUtil->update('wys_tongcheng_banner',$update_banner,array('id'=>$sale_banner['bn_id']));

if(!empty($sale_banner['m_id'])){
$res=$DBUtil->update('wys_tongcheng_msg',array('banner_sale'=>0),array('id'=>$sale_banner['m_id']));
}

//make by xuan
    if(!empty($sale_banner['city'])){
     $DBUtil->delete('wys_tongcheng_city_banner',array('banner_id'=>$sale_banner['bn_id']));
    }

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

$imglist=$DBUtil->getMany($DBUtil::wys_tongcheng_msg_imgs,' uniacid=:uniacid and oncode=:oncode',array(':uniacid'=>$_W['uniacid'],':oncode'=>$det['oncode']));

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
}else if($op=='audit_status'){
//列表快捷按钮 审核通过
$id=$_GPC['id'];
//本幻灯显示

//取出租信息主体
$sale_banner=$DBUtil->getOne('wys_tongcheng_salebanner',' uniacid=:uniacid and id=:id',array(':uniacid'=>$_W['uniacid'],':id'=>$id));
if($_GPC['isopen']==1){
//更新幻灯片信息
$update_banner=array(
	'sale_status'=>1,//出租状态
	'sale_openid'=>$sale_banner['openid'],//租借人openid
	'days'=>$sale_banner['bn_days'],//租借天数
	'lastdate'=>$this->doAdDateF('day','+',intval($sale_banner['bn_days'])),
	'mid'=>$sale_banner['m_id'],
	'msg_type'=>1,
	'sale_img'=>$sale_banner['img']//修改出租显示幻灯
	);

$DBUtil->update('wys_tongcheng_banner',$update_banner,array('id'=>$sale_banner['bn_id']));

//make by xuan
if(!empty($sale_banner['city'])){
    $banner_city_info = $DBUtil->getOne('wys_tongcheng_city_banner','uniacid=:uniacid and banner_id=:banner_id and city=:city and type=:type',array(':uniacid'=>$_W['uniacid'],':banner_id'=>$sale_banner['bn_id'],':city'=>$sale_banner['city'],':type'=>$sale_banner['type']));
    if(!$banner_city_info){
        $demo = array(
            'type'=>$sale_banner['type'] ? $sale_banner['type'] : 'index',
            'city'=>$sale_banner['city'],
            'uniacid'=>$_W['uniacid'],
            'banner_id'=>$sale_banner['bn_id'],
            'city_img'=>$sale_banner['img']
        );
        $DBUtil->save('wys_tongcheng_city_banner',$demo);
    }

    if(!empty($banner_city_info['city_img'])){
        $DBUtil->update('wys_tongcheng_city_banner',array('city_img'=>$sale_banner['img']),array('banner_id'=>$sale_banner['bn_id']));
    }
}


$DBUtil->update('wys_tongcheng_msg',array('banner_sale'=>1),array('id'=>$sale_banner['m_id']));
$res = $DBUtil->update('wys_tongcheng_salebanner',array('audit_status'=>$_GPC['isopen'],'banner_lasttime'=>$update_banner['lastdate']),array('id'=>$id));


}else if($_GPC['isopen']==0){
$update_banner=array(
	'sale_status'=>0,//出租状态
	'sale_openid'=>'',//租借人openid
	'days'=>0,//租借天数
	'lastdate'=>$this->doAdDateF('day','+',90),
	'mid'=>'',
	'msg_type'=>0,//自定义内容
	'sale_img'=>''
	);
$DBUtil->update('wys_tongcheng_banner',$update_banner,array('id'=>$sale_banner['bn_id']));
if(!empty($sale_banner['m_id'])){
$DBUtil->update('wys_tongcheng_msg',array('banner_sale'=>0),array('id'=>$sale_banner['m_id']));
}
$res = $DBUtil->update($h_tb,array('audit_status'=>$_GPC['isopen']),array('id'=>$id));

//make by xuan
    if(!empty($sale_banner['city'])){
        $banner_city_info = $DBUtil->getOne('wys_tongcheng_city_banner','uniacid=:uniacid and banner_id=:banner_id and city=:city and type=:type',array(':uniacid'=>$_W['uniacid'],':banner_id'=>$sale_banner['bn_id'],':city'=>$sale_banner['city'],':type'=>$sale_banner['type']));
        if(!empty($banner_city_info['city_img'])){
            $DBUtil->update('wys_tongcheng_city_banner',array('city_img'=>'','type'=>''),array('banner_id'=>$sale_banner['bn_id']));
        }
    }

}

if($res){
	message('更新成功!',referer(), 'success');
}else{
	message('更新失败!',referer(), 'error');
}
}

?>