<?php ?><?php
 /*  起点源码社区 http://Www.qdyma.Com  */
?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');