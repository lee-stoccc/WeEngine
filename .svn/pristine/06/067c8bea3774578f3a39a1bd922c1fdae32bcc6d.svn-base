<?php
/**
 * 微同城模块微站定义
 * @author xswys3
 * @url 
 */
defined('IN_IA') or exit('Access Denied');
require_once dirname(__FILE__).'/core/db.class.php';
//require_once dirname(__FILE__).'/inc/common.php';
require_once dirname(__FILE__).'/core/function_common.class.php';
class Wys_tongchengModuleSite extends WeModuleSite {

	function doAdDateF($datetype,$doaction,$donum,$datetime=''){
		if(empty($datetime)){
			$datetime=time();
		}
		return strtotime($doaction.$donum.' '.$datetype,$datetime);
	}

}