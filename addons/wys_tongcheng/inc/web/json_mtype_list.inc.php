<?php
//json_mtype_list.inc.php

global $_W, $_GPC;
$DBUtil = new DBUtil();
$tbname=$_GPC['tbname'];
$list=$DBUtil->getMany($tbname,'attr=:attr',array(':attr'=>$_GPC['attr']));
echo json_encode($list);
?>
