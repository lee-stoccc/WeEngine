<?php
/**
 * 发送短信
 * @param type $mobile
 * @param type $content
 * @param type $config
 * @return boolean
 */

function sendSms($mobile, $content, $config = array()) {
    global $_W;
    if (empty($mobile) || empty($content)) {
        return false;
    }
    if (is_array($mobile)) {
        $mobile = implode(",", $mobile);
    }
    if (empty($config)) {
        $config['sms_userid'] = '13243';
        $config['sms_account'] = 'k1615';
        $config['sms_password'] = '123456';
    }
    $post_data = array();
    $post_data['userid'] = $config['sms_userid'];
    $post_data['account'] = $config['sms_account'];
    $post_data['password'] = $config['sms_password'];
    $post_data['content'] = $content;
    $post_data['mobile'] = $mobile;
    $post_data['sendtime'] = ''; //不定时发送，值为0，定时发送，输入格式YYYYMMDDHHmmss的日期值
//    $url='http://www.duanxin10086.com/sms.aspx?action=send';
    $url='http://webservice.duanxin10086.com/enterprise/db2.0/sms.ashx?action=send';
    $o = '';
    foreach ($post_data as $k=>$v)
    {
       $o.="$k=".urlencode($v).'&'; //短信内容需要用urlencode编码下
    }
    $post_data_str = substr($o,0,-1);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data_str);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果需要将结果直接返回到变量里，那加上这句。
    $result = curl_exec($ch);
    $xml = xml_parser($result);
    $sms_log = array(
        'uniacid' => $_W['uniacid'],
        'mobile' => $mobile,
        'content' => $content,
        'createtime' => TIMESTAMP,
    );
    if ($xml !== false) {
        if ($xml->returnstatus == 'Success') {
            $sms_log['status'] = 1;
            fr_insert('sms_log', $sms_log);
            return TRUE;
        }else{
            $sms_log['status'] = 0;
            $sms_log['error_msg'] = $xml->message;
            fr_insert('sms_log', $sms_log);
            return false;
        }
    }else{
        $sms_log['status'] = 0;
        $sms_log['error_msg'] = $result;
        fr_insert('sms_log', $sms_log);
        return false;
    }
}
function xml_parser($str){   
    $xml_parser = xml_parser_create();   
    if(!xml_parse($xml_parser,$str,true)){   
        xml_parser_free($xml_parser);   
        return false;   
    }else {   
        return simplexml_load_string($str);   
    }   
}   


function sendVerify($mobile, $verifycode, $config) {
    include MODULE_ROOT . "/inc/alidayu/TopSdk.php";
    $tmp_sms_param = explode("\n", $config['sms_param']);
    $sms_param = array();
    foreach ($tmp_sms_param as $param) {
        $tmp_param = explode(":", $param);
        if (count($tmp_param) == 2 && validNumberLetter($tmp_param[0])) {
            $sms_param[trim($tmp_param[0])] = trim($tmp_param[1]);
        }
    }
    $sms_param['code'] = $verifycode;
    
    $c = new TopClient;
    $c->appkey = $config['key'];
    $c->secretKey = $config['secret'];
    $req = new AlibabaAliqinFcSmsNumSendRequest;
//    $req->setExtend("123456");
    $req->setSmsType("normal");
    $req->setSmsFreeSignName($config['free_sign']);
    $req->setSmsParam(json_encode($sms_param));
    $req->setRecNum($mobile);
    $req->setSmsTemplateCode($config['template_code']);
    $resp = $c->execute($req);
    $result = simplexml_obj2array($resp);
    if (isset($result['result']) && $result['result']['success'] == 'true') {
        return true;
    }else{
        return false;
    }
}

// XML转换成数组
function simplexml_obj2array($obj) {
    if (is_object($obj)) {
        $result = array();
        foreach ((array)$obj as $key => $item) {
            $result[$key] = simplexml_obj2array($item);
        }
        return $result;
    }
    return $obj;
}
  

function generateSign($params, $apiKey, $msign) {
    //所有请求参数按照字母先后顺序排
    ksort($params);
    //定义字符串开始所包括的字符串
    $stringToBeSigned = $apiKey;
    //把所有参数名和参数值串在一起
    foreach ($params as $k => $v) {
        $stringToBeSigned .= urldecode($k.$v);
    }
    unset($k, $v);
    //定义字符串结尾所包括的字符串
    $stringToBeSigned .= $msign;
    //使用MD5进行加密，再转化成大写
    return strtoupper(md5($stringToBeSigned));
}

?>