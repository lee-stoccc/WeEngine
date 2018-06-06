<?php


	//随机数$cnt 位数,$type 类型
	function doRandnum($cnt=6,$type=1){
		//srand((double)microtime()*1000000);
		if($type==1){
			$ychar="0,1,2,3,4,5,6,7,8,9";
			$list=explode(",",$ychar);
			for($i=0;$i<$cnt;$i++){
				$randnum=rand(0,9);
				$authnum.=$list[$randnum];
			}
		}else{
			$ychar="0,1,2,3,4,5,6,7,8,9,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z";
			$list=explode(",",$ychar);
			for($i=0;$i<$cnt;$i++){
				$randnum=rand(0,26);
				$authnum.=$list[$randnum];
			}
		}
		return $authnum;
	}


//日期处理函数 
//$this->doAdDate('day','+',1)
//$datetype day也可以改成year（年），month（月），hour（小时）minute（分），second（秒）
	function doAdDate($datetype,$doaction,$donum,$datetime){
		if(empty($datetime)){
			$datetime=time();
		}
		return strtotime($doaction.$donum.' '.$datetype,$datetime);
	}


/**
* $date是身份证日期19871122
* $type为1的时候是虚岁,2的时候是周岁
*/
function getAgeByBirth($date,$type = 1){	
	$nowYear = date('Y');
	$nowMonth = date('m');
	$nowDay = date('d');
	$data1=substr($date,0,4).'-'.substr($date,4,2).'-'.substr($date,6,2);
	$data=strtotime($data1);
	$birthYear = date("Y",$data);
	$birthMonth = date("m",$data);
	$birthDay = date("d",$data);
	if($type==1){
		$age = $nowYear - ($birthYear - 1);
	}elseif($type == 2){
		if($nowMonth<$birthMonth){
			$age = $nowYear - $birthYear - 1;
		}elseif($nowMonth==$birthMonth){
			if($nowDay<$birthDay){
				$age = $nowYear - $birthYear - 1;
			}else{
				$age = $nowYear - $birthYear;
			}
		}else{
			$age = $nowYear - $birthYear;
		}
	}
	return $age;
}

?>