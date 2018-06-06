<?php
//阿里云短信
/*
参数：
$TemplateCode STRING 模板CODE
$SignName STRING 签名名称
$RecNum STRING 目标手机号,多条记录可以英文逗号分隔
$ParamString STRING 模板变量，其中数字必须转换为字符串，个人用户每个变量长度必须小于15个字符。例如：短信模板为：“短信验证码${no}”。若参数传递为 {“no”:”123456”}，用户将接收到的短信内容为：【短信签名】短信验证码123456
*/
function doailyunsms($TemplateCode){
    $host = "http://sms.market.alicloudapi.com";
    $path = "/singleSendSms";
    $method = "GET";
    $appcode = "你自己的AppCode";
    $headers = array();
    array_push($headers, "Authorization:APPCODE ".$appcode);
    $querys = "ParamString=%7B%22no%22%3A%22123456%22%7D&RecNum=RecNum&SignName=SignName&TemplateCode=TemplateCode";
    $bodys = "";
    $url = $host . $path . "?" . $querys;

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_FAILONERROR, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, true);
    if (1 == strpos("$".$host, "https://"))
    {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    }
    var_dump(curl_exec($curl));

}
?>