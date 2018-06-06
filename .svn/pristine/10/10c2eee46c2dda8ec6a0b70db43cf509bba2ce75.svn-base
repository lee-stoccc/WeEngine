<?php

global $_GPC, $_W;
$uniacid = $_W['uniacid'];
$DBUtil = new DBUtil();
$setting = $this->module['config'];
$myfun =new MyFun();

//$api_transfers=$myfun->api_transfers($data_add['u_openid'],$data_add['u_nickname'],$data_add['money_sj']);

//$rpdata=$myfun->api_transfers('ohzMZ0XzIIhTEtQaLsuQAdo2I1QM','徐国才','100');

// $errno = 0;
// $message='su';

// $op=$_GPC['op'];

// $openid='ohzMZ0XzIIhTEtQaLsuQAdo2I1QM';//$_GPC['openid'];
// $re_user_name='徐国才';//$_GPC['name'];//用户姓名
// $appid = $_W['account']['key'];//你的微信公众平台的appid
// $secret = $_W['account']['secret'];//你微信公众平台的secret
// $amount=$_GPC['amount'];
// if(empty($amount)){
// $amount=100;//金额（以分为单位，必须大于100）
// }


// $mchid=$_W['account']['setting']['payment']['wechat']['mchid'];//商户号
// $mchid_secret=$_W['account']['setting']['payment']['wechat']['signkey'];//商户号
// $nonce_str='vhmake'.rand(100000, 999999);//随机数
// $partner_trade_no='VH'.time().rand(10000, 99999);//商户订单号
// $openid=$openid;//用户唯一标识
// $check_name='NO_CHECK';//校验用户姓名选项，NO_CHECK：不校验真实姓名 FORCE_CHECK：强校验真实姓名（未实名认证的用户会校验失败，无法转账）OPTION_CHECK：针对已实名认证的用户才校验真实姓名（未实名认证用户不校验，可以转账成功）
// $desc='帐户提现';//描述
// $spbill_create_ip=$_SERVER["REMOTE_ADDR"];//请求ip
// //封装成数据
// //$dataArr=array();

// //$sign=$myfun->getSign($dataArr,$mchid_secret);

//         /*红包新商户订单号生成方式*/
//         $new_mch_billno = intval($user['fansid']%100);
//         $mch_billno =$new_mch_billno.date('ym').substr(time(),4).substr(microtime(),2,6).rand(18,99);
//         /*红包新商户订单号生成方式*/
//         $url='https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers';
//         $pars= array();
//         $pars['mch_appid']=$appid;
// 		$pars['mchid']=$mchid;
// 		$pars['nonce_str']=$nonce_str;
// 		$pars['partner_trade_no']=$partner_trade_no;
// 		$pars['openid']=$openid;
// 		$pars['check_name']=$check_name;
// 		$pars['re_user_name']=$re_user_name;
// 		$pars['amount']=$amount;
// 		$pars['desc']=$desc;
// 		$pars['spbill_create_ip']=$spbill_create_ip;
//         ksort($pars, SORT_STRING);
//         $string1 = '';
//         foreach ($pars as $k => $v) {
//             $string1 .= "{$k}={$v}&";
//         }
//         $string1 .= 'key='.$mchid_secret;
//         $pars['sign']              = strtoupper(md5($string1));
//         $xml                       = array2xml($pars);
//         $extras                    = array();

//         $dir_path=MODULE_ROOT.'/paycert/'.$_W['uniacid'];

//         //$extras['CURLOPT_CAINFO']  = $dir_path . '/rootca.pem';
//         $extras['CURLOPT_SSLCERT'] = $dir_path.'/apiclient_cert.pem';
//         $extras['CURLOPT_SSLKEY']  =$dir_path.'/apiclient_key.pem';
//         load()->func('communication');

//         // $this->message(array("success" => 2, "msg" => $api['ip']), "");

//         $procResult = null;
//         $resp       = ihttp_request($url, $xml, $extras);
//         if (is_error($resp)) {
//             $procResult = $resp;

//         } else {

//             $xml = '<?xml version="1.0" encoding="utf-8"?//>' $resp['content'];
//             $dom = new DOMDocument();
//             if ($dom->loadXML($xml)) {
//                 $xpath = new DOMXPath($dom);
//                 $return_code  = $xpath->evaluate('string(//xml/return_code)');
//                 $return_msg  = $xpath->evaluate('string(//xml/return_msg)');
//                 $ret   = $xpath->evaluate('string(//xml/result_code)');

//                 if (strtolower($return_code) == 'success' && strtolower($ret) == 'success') {
//                     $procResult = true;
//                 } else {
//                     $error      = $xpath->evaluate('string(//xml/err_code_des)');
//                     $procResult = error(-2, $error);
//                 }
//             } else {
//                 $procResult = error(-1, 'error response');
//             }
//         }


//         $packpage['error_title']=$return_msg==null?'提现失败':$return_msg;
//         $packpage['return_code']=$return_code;
//         $packpage['error_info']=$error==null?$procResult['message']:$error;
//         if (is_error($procResult)) {
//             $packpage['isok']=false;
//         } else {
//             $packpage['isok']=true;
//         }
//         //处理结束
//         $rpdata['procresult']= $procResult;
//         //错误中文信息
//         $rpdata['error']= $error;
//         $rpdata['packpage']= $packpage;
//         //SUCCESS/FAIL此字段是通信标识，非交易标识，

//         //SUCCESS/FAIL此字段是通信标识，非交易标识，交易是否成功需要查看result_code来判断

//         //交易是否成功需要查看result_code来判断
//         $rpdata['ret']=$ret;
//         $rpdata['test']=is_error(array('errno'=>1));
//         //ret>FAIL   procresult message 余额不足

return $this->result($errno, $message, $rpdata);
?>