<?php
/**
 * [WeEngine System] Copyright (c) 2014 WE7.CC
 * WeEngine is NOT a free software, it under the license terms, visited http://www.we7.cc/ for more details.
 */
defined('IN_IA') or exit('Access Denied');

load()->model('app');

$dos = array('showjs');
$do = in_array($do, $dos) ? $do : 'showjs';
if ($do == 'showjs') {
	echo '';
	exit;
}