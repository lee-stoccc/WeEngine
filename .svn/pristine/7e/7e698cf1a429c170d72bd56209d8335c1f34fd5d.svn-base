<?php
//店铺上传图片
global $_GPC, $_W;
$errno = 0;
$DBUtil = new DBUtil();
$myfun =new MyFun();

$oncode=$_GPC['oncode'];

//分文件夹保存
$date_info = getdate();
$year = $date_info['year'];
$mon = $date_info['mon'];
$day = $date_info['mday'];
$logo_path = 'images/wys_tongcheng/uniacid_'.$_W['uniacid'].'/store/comments'.sprintf("%s/%s/%s/%s/",$logo_path,$year,$mon,$day);
$uplogo_path=ATTACHMENT_ROOT.$logo_path;
	//dirname(__FILE__)
if(!is_dir($uplogo_path)){$res=mkdir($uplogo_path,0777,true);}
//文件名
$img_file_name=time().$myfun->randombylength(8).'.'.$myfun->fileext($_FILES['file']['name']);
if(move_uploaded_file($_FILES['file']['tmp_name'], $uplogo_path.$img_file_name)){
	$restult=true;
}else{
	$restult=false;
}
//上传图片的外链
//$webimgurl=$_W['attachurl'].$logo_path.$img_file_name;
$webimgurl=tomedia($logo_path.$img_file_name);

$message ='img upload suc';
$data = array(
	'oncode'=>$oncode,
	//'isyun'=>$webimgurl
	);

$store_goods_det=$DBUtil->getOne('wys_tongcheng_store_comments','oncode=:oncode',array(':oncode'=>$oncode));

$imgs_list=$store_goods_det['imgs_list'];
$imgs_list_array = explode(',', $imgs_list); 

$img_upurlList=array();
foreach ($imgs_list_array as $key => $value) {
	if($value!=''){
	array_push($img_upurlList,$value);
	}
}
array_push($img_upurlList,$webimgurl);

$img_upurlList_str=implode(',',$img_upurlList);


$update_data=array(
		'imgs_list'=>$img_upurlList_str
	);

//更新图片集
$DBUtil->update('wys_tongcheng_store_comments',$update_data,array('oncode'=>$oncode));

return $this->result($errno, $message, $data);





?>