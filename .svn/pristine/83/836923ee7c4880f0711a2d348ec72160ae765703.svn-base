<?php

//云打印

function print_ticket($result, $fr_cp_settings) {
    global $_W;
    if (empty($fr_cp_settings['print_type'])) {
        return true;
    }
    //load()->func('communication');
    $msg = ""; //打印内容
    $msg .= "班次：{$result['start_station']} 至 {$result['end_station']}\r\n";
    $msg .= "发车时间：{$result['datetime']}\r\n";
    $msg .= "姓名：{$result['name']}\r\n";
    $msg .= "电话：{$result['phone']}\r\n";
    $msg .= "身份证：{$result['idcard']}\r\n";
    $msg .= "购票数：{$result['number']}\r\n";
    $msg .= "代金券：{$result['voucher']}\r\n";
    $msg .= "订单总额：{$result['price']}\r\n";
    $msg .= "附加项：\r\n";
    $msg .= "{$result['addons']}\r\n";
    $msg .= "=======================\r\n";
    $msg .= $_W['account']['name'];
    
    $apiKey       = $fr_cp_settings['print_apiKey'];//apiKey
    $mKey         = $fr_cp_settings['print_mKey'];//秘钥
    $partner      = $fr_cp_settings['print_partner'];//用户id
    $machine_code = $fr_cp_settings['print_machine_code'];//打印机终端号
    
    $params = array(
        'partner' => $partner,
        'machine_code' => $machine_code,
        'time' => TIMESTAMP
    );
    $sign = generateSign($params,$apiKey,$mKey);

    $params['sign'] = $sign;
    $params['content'] = $msg;

  
    $url = 'open.10ss.net:8888';//接口端点

    $p = '';
    foreach ($params as $k => $v) {
        $p .= $k.'='.$v.'&';
    }
    $data = rtrim($p, '&');
    
    return liansuo_post($url, $data);
//    $res = ihttp_post($url, $data);
//    if (is_error($res)) {
//        load()->func("logging");
//        logging_run($res['message'], 'error', 'fr_cp_print');
//        return false;
//    }else{
//        return true;
//    }
}
function liansuo_post($url,$data){ // 模拟提交数据函数
    load()->func("logging");
    $curl = curl_init(); // 启动一个CURL会话
    curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检测
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在
    curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Expect:')); //解决数据包大不能提交
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
    curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
    curl_setopt($curl, CURLOPT_COOKIEFILE, $GLOBALS['cookie_file']); // 读取上面所储存的Cookie信息
    curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循
    curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
           
    $tmpInfo = curl_exec($curl); // 执行操作
    if (curl_errno($curl)) {
        $error = 'Errno'.curl_error($curl);
        logging_run($error, 'error', 'fr_cp_print');
       return false;
    }
    curl_close($curl); // 关键CURL会话
    //logging_run($tmpInfo, 'success', 'fr_cp_print');
    return true; // 返回数据
}
?>