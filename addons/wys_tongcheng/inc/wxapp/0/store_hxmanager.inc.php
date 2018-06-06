<?php


global $_GPC, $_W;
	$DBUtil = new DBUtil();
	$myfun =new MyFun();
	$setting = $this->module['config'];
	$errno = 0;
	$message = 'rp_textCC';
	$data = array(
		'a'=>1002,
		'op'=>$_GPC['op'],
		'myfun'=>$myfun->randombylength(8),
		'$setting'=>$setting['qq_map_key']
		);
	return $this->result($errno, $message, $data);


?>