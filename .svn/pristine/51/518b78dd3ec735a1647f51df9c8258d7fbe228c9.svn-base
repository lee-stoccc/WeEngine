<?php

//引入数据库操作类型
require_once dirname(__FILE__) . '/db.class.php';

class MyFun
{

    function check_yue()
    {
        global $_GPC, $_W;
        $DBUtil = new DBUtil();
        $user_det = $DBUtil->getOne('wys_tongcheng_user', 'uniacid=:uniacid and u_openid=:u_openid', array(':uniacid' => $_W['uniacid'], ':u_openid' => $_GPC['openId']));
        return $user_det['account'] ? $user_det['account'] : 0;
    }

    function server_money()
    {
        global $_GPC, $_W;
        $userapi_config = pdo_getcolumn('uni_account_modules', array('uniacid' => $_W['uniacid']), 'settings');
        $config = iunserializer($userapi_config);
        return empty($config['money_sxfl']) ? 0.3 : $config['money_sxfl'];
    }

    function update_tx_list($openid, $money_sj,$true_money, $tx_oncode)
    {
        global $_GPC, $_W;
        $DBUtil = new DBUtil();

        $kou = (float)$true_money-(float)$money_sj;
        $kou_money = round($kou,3);
        $order_data = array(
            'uniacid' => $_W['uniacid'],
            'oncode' => $tx_oncode,
            'openid' => $openid,
            'unionid' => '',
            'ordertype' => 'account_tx',
            'dt_id' => '',
            'orderrmk' => '帐户提现',
            'total_money' => $money_sj,
            'user_money' => $money_sj,
            'system_money' =>$kou_money,
            'system_rmk' =>'平台扣除'.$kou_money.'元',
            'transaction_id' => '',
            'u_name' => 'name',
            'u_phone' => 'phone',
            'paystate' => 3,
            'crtime' => time(),
            'paycrtime' => time(),
            'random_code' => '',
            'pay_channel' => 'account'
        );
        $DBUtil->save('wys_tongcheng_payorder', $order_data);
    }

    function  save_fenxiao_list($openid,$class, $u_nickname,$u_phone,$get_money)
    {
        global $_GPC, $_W;
        $DBUtil = new DBUtil();

        $order_data = array(
            'uniacid' => $_W['uniacid'],
            'oncode' => time(),
            'openid' => $openid,
            'unionid' => '',
            'ordertype' => 'fenxiao',
            'dt_id' => '',
            'orderrmk' => $class.'代理:'.$u_nickname,
            'total_money' => $get_money,
            'user_money' => $get_money,
            'system_money' =>$get_money,
            'system_rmk' =>$class.'级代理:'.$u_nickname.' 入驻',
            'transaction_id' => '',
            'u_name' => $u_nickname,
            'u_phone' => $u_phone,
            'paystate' => 3,
            'crtime' => time(),
            'paycrtime' => time(),
            'random_code' => '',
            'pay_channel' => 'fenxiao'
        );
        $DBUtil->save('wys_tongcheng_payorder', $order_data);
    }

    function check_tx_open()
    {
        global $_GPC, $_W;
        $account_module = pdo_getcolumn('uni_account_modules', array('uniacid'=>$_W['uniacid']),'settings');
        $data = iunserializer($account_module);
        if($data['tx_isopen'] == 0){
            return false;
        }
        return true;
    }

    function api_transfers($openid, $user_name, $money_sj, $true_money,$tx_oncode)
    {
        global $_GPC, $_W;

        $user_money = $this->check_yue();
        if ($money_sj < 1) {
            $data = [
                'error' => '不能少于1元'
            ];
            return $data;
        }
        if ((float)$true_money > (float)$user_money) {
            $data = [
                'error' => '超过可提现金额'
            ];
            return $data;
        }

        $uniacid = $_W['uniacid'];
        $DBUtil = new DBUtil();
        //$setting = $this->module['config'];       
        // $errno = 0;
        // $message='su';


        $re_user_name = $user_name;////用户姓名
        $appid = $_W['account']['key'];//你的微信公众平台的appid
        $secret = $_W['account']['secret'];//你微信公众平台的secret
        $amount = floatval($money_sj) * 100;//$_GPC['amount'];
        // if(empty($amount)){
        // $amount=100;//金额（以分为单位，必须大于100） 
        // }
        $setting = uni_setting($uniacid, array('payment'));

        $mchid = $setting['payment']['wechat']['mchid'];//商户号
//        $mchid = 1498544462;//商户号
        $mchid_secret = $setting['payment']['wechat']['signkey'];//商户号
//        $mchid_secret = "fa77ea761663c193987f72adeebb48d5";//商户号

        $nonce_str = 'vhmake' . rand(100000, 999999);//随机数
        $partner_trade_no = 'VH' . time() . rand(10000, 99999);//商户订单号
        $check_name = 'NO_CHECK';//校验用户姓名选项，NO_CHECK：不校验真实姓名 FORCE_CHECK：强校验真实姓名（未实名认证的用户会校验失败，无法转账）OPTION_CHECK：针对已实名认证的用户才校验真实姓名（未实名认证用户不校验，可以转账成功）
        $desc = '帐户提现';//描述
        $spbill_create_ip = $_SERVER["REMOTE_ADDR"];//请求ip


        //封装成数据
        //$dataArr=array();

        //$sign=$myfun->getSign($dataArr,$mchid_secret);

        /*红包新商户订单号生成方式*/
        // $new_mch_billno = intval($user['fansid']%100);
        // $mch_billno =$new_mch_billno.date('ym').substr(time(),4).substr(microtime(),2,6).rand(18,99);
        /*红包新商户订单号生成方式*/
        $url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers';
        $pars = array();
        $pars['mch_appid'] = $appid;
        $pars['mchid'] = $mchid;
        $pars['nonce_str'] = $nonce_str;
        $pars['partner_trade_no'] = $partner_trade_no;
        $pars['openid'] = $openid;
        $pars['check_name'] = $check_name;
        $pars['re_user_name'] = $re_user_name;
        $pars['amount'] = $amount;
        $pars['desc'] = $desc;
        $pars['spbill_create_ip'] = $spbill_create_ip;
        ksort($pars, SORT_STRING);
        $string1 = '';
        foreach ($pars as $k => $v) {
            $string1 .= "{$k}={$v}&";
        }
        $string1 .= 'key=' . $mchid_secret;
        $pars['sign'] = strtoupper(md5($string1));
        $xml = array2xml($pars);
        $extras = array();

        $dir_path = MODULE_ROOT . '/paycert/' . $_W['uniacid'];

        //$extras['CURLOPT_CAINFO']  = $dir_path . '/rootca.pem';
        $extras['CURLOPT_SSLCERT'] = $dir_path . '/apiclient_cert.pem';
        $extras['CURLOPT_SSLKEY'] = $dir_path . '/apiclient_key.pem';
        load()->func('communication');

        // $this->message(array("success" => 2, "msg" => $api['ip']), "");


        $procResult = null;
        $resp = ihttp_request($url, $xml, $extras);
        if($resp['errno']){
            var_dump($resp);
            $data = [
                'error' => '系统繁忙,请稍后再试'
            ];
            return $data;
        }
        if (is_error($resp)) {
            $procResult = $resp;

        } else {

            $xml = '<?xml version="1.0" encoding="utf-8"?>' . $resp['content'];
            $dom = new DOMDocument();
            if ($dom->loadXML($xml)) {
                $xpath = new DOMXPath($dom);
                $return_code = $xpath->evaluate('string(//xml/return_code)');
                $return_msg = $xpath->evaluate('string(//xml/return_msg)');
                $ret = $xpath->evaluate('string(//xml/result_code)');
                if (strtolower($return_code) == 'success' && strtolower($ret) == 'success') {
                    $procResult = true;
                } else {
                    $error = $xpath->evaluate('string(//xml/err_code_des)');
                    $procResult = error(-2, $error);
                }
            } else {
                $procResult = error(-1, 'error response');
            }
        }


        $packpage['error_title'] = $return_msg == null ? '提现成功' : $return_msg;
        $packpage['return_code'] = $return_code;
        $packpage['error_info'] = $error == null ? $procResult['message'] : $error;
        if (is_error($procResult)) {
            $packpage['isok'] = false;
        } else {
            $packpage['isok'] = true;
        }
        //处理结束
        $rpdata['procresult'] = $procResult;
        //错误中文信息
        $rpdata['error'] = $error;
        $rpdata['packpage'] = $packpage;
        //SUCCESS/FAIL此字段是通信标识，非交易标识，

        //SUCCESS/FAIL此字段是通信标识，非交易标识，交易是否成功需要查看result_code来判断

        //交易是否成功需要查看result_code来判断
        $rpdata['ret'] = $ret;
        $rpdata['test'] = is_error(array('errno' => 1));

        if ($tx_oncode != '') {
            $tx_det = $DBUtil->getOne('wys_tongcheng_user_account_tx', 'oncode=:oncode', array(':oncode' => $tx_oncode));  //查询提现表，为空
            $data_up = array(
                'time_tx' => time(),
                'status_tx' => $packpage['isok'] == true ? '1' : '0',
                'rmk_tx' => $packpage['error_info']
            );
            if ($packpage['isok'] == 'true') {
                $data_up['enable'] = -1;
            } else if ($packpage['isok'] == false) {
                $data_up['enable'] = 1;

                $order_data = array(
                    'uniacid' => $_W['uniacid'],
                    'oncode' => $tx_oncode,
                    'openid' => $tx_det['u_openid'],
                    'unionid' => $tx_det['u_unionid'],
                    'ordertype' => 'account_tx',
                    'dt_id' => $tx_det['id'],
                    'orderrmk' => '帐户提现',
                    'total_money' => $tx_det['money'],
                    'user_money' => $tx_det['money_sj'],
                    'system_money' => $tx_det['money_sxf'],
                    'transaction_id' => '',
                    'u_name' => $tx_det['u_nickname'],
                    'u_phone' => $tx_det['u_phone'],
                    'paystate' => 3,
                    'crtime' => time(),
                    'paycrtime' => time(),
                    'random_code' => '',
                    'pay_channel' => 'account'
                );
                $DBUtil->save('wys_tongcheng_payorder', $order_data);

//            }
                $DBUtil->update('wys_tongcheng_user_account_tx', $data_up, array('oncode' => $tx_oncode));


            }

            $rpdata['oncode'] = $tx_oncode;

            return $rpdata;
        }
    }

    function sendredpack($openid, $money_sj)
    {
        global $_GPC, $_W;

        $uniacid = $_W['uniacid'];
        $DBUtil = new DBUtil();

        $appid = $_W['account']['key'];//你的微信公众平台的appid
        $secret = $_W['account']['secret'];//你微信公众平台的secret
        $amount = floatval($money_sj) * 100;//$_GPC['amount'];

        $setting = uni_setting($uniacid, array('payment'));

        $mchid = $setting['payment']['wechat']['mchid'];//商户号
//        $mchid = 1498544462;//商户号
        $mchid_secret = $setting['payment']['wechat']['signkey'];//商户号
//        $mchid_secret = "fa77ea761663c193987f72adeebb48d5";//商户号

        $nonce_str = 'vhmake' . rand(100000, 999999);//随机数
        $partner_trade_no = 'RP' . time() . rand(10000, 99999);//商户订单号
        $check_name = 'NO_CHECK';//校验用户姓名选项，NO_CHECK：不校验真实姓名 FORCE_CHECK：强校验真实姓名（未实名认证的用户会校验失败，无法转账）OPTION_CHECK：针对已实名认证的用户才校验真实姓名（未实名认证用户不校验，可以转账成功）
        $desc = '帐户红包';//描述
        $spbill_create_ip = $_SERVER["REMOTE_ADDR"];//请求ip


        $url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack';
        $pars = array();
        $pars['wxappid'] = $appid;
        $pars['mch_id'] = $mchid;
        $pars['nonce_str'] = $nonce_str;
        $pars['mch_billno'] = $partner_trade_no;
        $pars['re_openid'] = $openid;
        $pars['send_name'] = '速用老叶';
        $pars['total_amount'] = $amount;
        $pars['total_num'] = 1;
        $pars['wishing'] = '测试发送红包';
        $pars['act_name'] = $desc;
        $pars['remark'] = '猜越多得越多，快来抢!';
        $pars['client_ip'] = $spbill_create_ip;
        ksort($pars, SORT_STRING);
        $string1 = '';
        foreach ($pars as $k => $v) {
            $string1 .= "{$k}={$v}&";
        }
        $string1 .= 'key=' . $mchid_secret;
        $pars['sign'] = strtoupper(md5($string1));
        $xml = array2xml($pars);
        $extras = array();

        $dir_path = MODULE_ROOT . '/paycert/' . $_W['uniacid'];

        $extras['CURLOPT_SSLCERT'] = $dir_path . '/apiclient_cert.pem';
        $extras['CURLOPT_SSLKEY'] = $dir_path . '/apiclient_key.pem';
        load()->func('communication');


        $procResult = null;
        $resp = ihttp_request($url, $xml, $extras);
        if (is_error($resp)) {
            $procResult = $resp;

        } else {
            $xml = '<?xml version="1.0" encoding="utf-8"?>' . $resp['content'];
            $dom = new DOMDocument();
            if ($dom->loadXML($xml)) {
                $xpath = new DOMXPath($dom);
                $return_code = $xpath->evaluate('string(//xml/return_code)');
                $return_msg = $xpath->evaluate('string(//xml/return_msg)');
                $ret = $xpath->evaluate('string(//xml/result_code)');
                if (strtolower($return_code) == 'success' && strtolower($ret) == 'success') {
                    $procResult = true;
                } else {
                    $error = $xpath->evaluate('string(//xml/err_code_des)');
                    $procResult = error(-2, $error);
                }
            } else {
                $procResult = error(-1, 'error response');
            }
        }


        $packpage['error_title'] = $return_msg == null ? '提现成功' : $return_msg;
        $packpage['return_code'] = $return_code;
        $packpage['error_info'] = $error == null ? $procResult['message'] : $error;
        if (is_error($procResult)) {
            $packpage['isok'] = false;
        } else {
            $packpage['isok'] = true;
        }
        //处理结束
        $rpdata['procresult'] = $procResult;
        //错误中文信息
        $rpdata['error'] = $error;
        $rpdata['packpage'] = $packpage;


        //交易是否成功需要查看result_code来判断
        $rpdata['ret'] = $ret;
        $rpdata['test'] = is_error(array('errno' => 1));

        return $rpdata;
    }

    function update_tx_record($tx_oncode,$openid,$money_sj)
    {
        global $_GPC, $_W;

        $DBUtil = new DBUtil();
        $order_data = array(
            'uniacid' => $_W['uniacid'],
            'oncode' => $tx_oncode,
            'openid' => $openid,
            'unionid' => '',
            'ordertype' => 'account_tx',
            'dt_id' => time(),
            'orderrmk' => '帐户提现',
            'total_money' => $money_sj,
            'user_money' => $tx_det['money_sj'],     //用户得到扣除后费用
            'system_money' => $tx_det['money_sxf'],   //平台扣除
            'transaction_id' => '',
            'u_name' => 'name',
            'u_phone' => 'phone',
            'paystate' => 3,
            'crtime' => time(),
            'paycrtime' => time(),
            'random_code' => '',
            'pay_channel' => 'account'
        );
        $DBUtil->save('wys_tongcheng_payorder', $order_data);
    }

    /**
     *  作用：格式化参数，签名过程需要使用
     */
    function formatBizQueryParaMap($paraMap, $urlencode)
    {
        $buff = "";
        ksort($paraMap);
        foreach ($paraMap as $k => $v) {
            if ($urlencode) {
                $v = urlencode($v);
            }
            $buff .= $k . "=" . $v . "&";
        }
        if (strlen($buff) > 0) {
            $reqPar = substr($buff, 0, strlen($buff) - 1);
        }
        return $reqPar;
    }

    /**
     *  作用：生成签名
     */
    function getSign($Obj, $secret)
    {
        foreach ($Obj as $k => $v) {
            $Parameters[$k] = $v;
        }
        //签名步骤一：按字典序排序参数
        ksort($Parameters);
        $String = $this->formatBizQueryParaMap($Parameters, false);
        //echo '【string1】'.$String.'</br>';
        //签名步骤二：在string后加入KEY
        $String = $String . '&key=' . $secret;
        //echo "【string2】".$String."</br>";
        //签名步骤三：MD5加密
        $String = md5($String);
        //echo "【string3】 ".$String."</br>";
        //签名步骤四：所有字符转为大写
        $result_ = strtoupper($String);
        //echo "【result】 ".$result_."</br>";
        return $result_;
    }

    public function fileext($filename)
    {
        return substr(strrchr($filename, '.'), 1);
    }

    //生成随机文件名函数  
    public function randombylength($length)
    {
        $hash = 'CR-';
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
        $max = strlen($chars) - 1;
        mt_srand((double)microtime() * 1000000);
        for ($i = 0; $i < $length; $i++) {
            $hash .= $chars[mt_rand(0, $max)];
        }
        return $hash;
    }

    //生成随机文件名函数  
    public function randombylength_num($length)
    {
        $hash = '';
        $chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $max = strlen($chars) - 1;
        mt_srand((double)microtime() * 1000000);
        for ($i = 0; $i < $length; $i++) {
            $hash .= $chars[mt_rand(0, $max)];
        }
        return $hash;
    }

    //生成随机文件名函数  
    public function randombylength_num_true($length)
    {
        $hash = '';
        $chars = '0123456789';
        $max = strlen($chars) - 1;
        mt_srand((double)microtime() * 1000000);
        for ($i = 0; $i < $length; $i++) {
            $hash .= $chars[mt_rand(0, $max)];
        }
        return $hash;
    }

    //$datetype day也可以改成year（年），month（月），hour（小时）minute（分），second（秒）
    public function doDate($datetype, $doaction, $donum, $datetime = '')
    {
        if (empty($datetime)) {
            $datetime = time();
        }
        return strtotime($doaction . $donum . ' ' . $datetype, $datetime);
    }

    /**
     * 友好的时间显示
     *
     * @param int $sTime 待显示的时间
     * @param string $type 类型. normal | mohu | full | ymd | other
     * @param string $alt 已失效
     * @return string
     */
    function friendlyDate($sTime, $type = 'normal', $alt = 'false')
    {
        if (!$sTime)
            return '';
        //sTime=源时间，cTime=当前时间，dTime=时间差
        $cTime = time();
        $dTime = $cTime - $sTime;
        $dDay = intval(date("z", $cTime)) - intval(date("z", $sTime));
        //$dDay     =   intval($dTime/3600/24);
        $dYear = intval(date("Y", $cTime)) - intval(date("Y", $sTime));
        //normal：n秒前，n分钟前，n小时前，日期
        if ($type == 'normal') {
            if ($dTime < 60) {
                if ($dTime < 10) {
                    return '刚刚';    //by yangjs
                } else {
                    return intval(floor($dTime / 10) * 10) . "秒前";
                }
            } elseif ($dTime < 3600) {
                return intval($dTime / 60) . "分钟前";
                //今天的数据.年份相同.日期相同.
            } elseif ($dYear == 0 && $dDay == 0) {
                //return intval($dTime/3600)."小时前";
                return '今天' . date('H:i', $sTime);
            } elseif ($dYear == 0) {
                return date("m月d日 H:i", $sTime);
            } else {
                return date("Y-m-d H:i", $sTime);
            }
        } elseif ($type == 'mohu') {
            if ($dTime < 60) {
                return $dTime . "秒前";
            } elseif ($dTime < 3600) {
                return intval($dTime / 60) . "分钟前";
            } elseif ($dTime >= 3600 && $dDay == 0) {
                return intval($dTime / 3600) . "小时前";
            } elseif ($dDay > 0 && $dDay <= 7) {

                return intval($dDay) . "天前";
            } elseif ($dDay > 7 && $dDay <= 30) {
                return intval($dDay / 7) . '周前';
            } elseif ($dDay > 30) {
                return intval($dDay / 30) . '个月前';
            }
            //full: Y-m-d , H:i:s
        } elseif ($type == 'mohu_ot') {
            if ($dTime < 60) {
                return $dTime . "秒前";
            } elseif ($dTime < 3600) {
                return intval($dTime / 60) . "分钟前";
            } elseif ($dTime >= 3600 && $dDay == 0) {
                return intval($dTime / 3600) . "小时前";
            } elseif ($dDay > 0 && $dDay <= 7) {
                return intval($dDay) . "天前 " . date("m月d日 H:i", $sTime);
            } elseif ($dDay > 7 && $dDay <= 30) {
                return intval($dDay / 7) . '周前 ' . date("m月d日 H:i", $sTime);
            } elseif ($dDay > 30) {
                return intval($dDay / 30) . '个月前 ' . date("m月d日 H:i", $sTime);
            } else {
                return date("y年m月d日 H:i", $sTime);
            }
            //full: Y-m-d , H:i:s
        } elseif ($type == 'ym_time') {
            if ($dYear > 0) {
                return date("Y年m月d日 H:i", $sTime);
            } else {
                return date("m月d日 H:i", $sTime);
            }
            //full: Y-m-d , H:i:s
        } elseif ($type == 'full') {
            return date("Y-m-d H:i:s", $sTime);
        } elseif ($type == 'ymd') {
            return date("Y-m-d", $sTime);
        } else {
            if ($dTime < 60) {
                return $dTime . "秒前";
            } elseif ($dTime < 3600) {
                return intval($dTime / 60) . "分钟前";
            } elseif ($dTime >= 3600 && $dDay == 0) {
                return intval($dTime / 3600) . "小时前";
            } elseif ($dYear == 0) {
                return date("Y-m-d H:i:s", $sTime);
            } else {
                return date("Y-m-d H:i:s", $sTime);
            }
        }
    }

    //utf8mb4表情转换，用于存储  
    function textEncode($str)
    {
        if (!is_string($str)) return $str;
        if (!$str || $str == 'undefined') return '';

        $text = json_encode($str); //暴露出unicode
        $text = preg_replace_callback("/(\\\u[ed][0-9a-f]{3})/i", function ($str) {
            return addslashes($str[0]);
        }, $text); //将emoji的unicode留下，其他不动，这里的正则比原答案增加了d，因为我发现我很多emoji实际上是\ud开头的，反而暂时没发现有\ue开头。
        return json_decode($text);
        /* $txtContent=json_encode($text);

         $txtContent=preg_replace_callback ('#(\\\u263a|\\\u2728|\\\u2b50|\\\u2753|\\\u270a|\\\u261d|\\\u2757|\\\ud[0-9a-f]{3}\\\ud[0-9a-f]{3})#',function($matches){ return  addslashes($matches[1]);}, $txtContent);
         $txtContent=json_decode($txtContent);

         return $txtContent;  */
    }

    //表情反转，用于显示
    function textDecode($str)
    {
        $text = json_encode($str); //暴露出unicode
        $text = preg_replace_callback('/\\\\\\\\/i', function ($str) {
            return '\\';
        }, $text); //将两条斜杠变成一条，其他不动
        return json_decode($text);
    }

    /**
     * 计算两点地理坐标之间的距离
     * @param Decimal $longitude1 起点经度
     * @param Decimal $latitude1 起点纬度
     * @param Decimal $longitude2 终点经度
     * @param Decimal $latitude2 终点纬度
     * @param Int $unit 单位 1:米 2:公里
     * @param Int $decimal 精度 保留小数位数
     * @return Decimal
     */
    function getDistance($longitude1, $latitude1, $longitude2, $latitude2, $unit = 2, $decimal = 2)
    {

        $EARTH_RADIUS = 6370.996; // 地球半径系数
        $PI = 3.1415926;

        $radLat1 = $latitude1 * $PI / 180.0;
        $radLat2 = $latitude2 * $PI / 180.0;

        $radLng1 = $longitude1 * $PI / 180.0;
        $radLng2 = $longitude2 * $PI / 180.0;

        $a = $radLat1 - $radLat2;
        $b = $radLng1 - $radLng2;

        $distance = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2)));
        $distance = $distance * $EARTH_RADIUS * 1000;

        if ($unit == 2) {
            $distance = $distance / 1000;
        }

        return round($distance, $decimal);

    }


    /**
     *$myApp=new Wys_tongchengModuleWxapp();
     * 模拟post进行url请求
     * @param string $url
     * @param string $param
     */
    function request_post($url = '', $param = '')
    {
        if (empty($url) || empty($param)) {
            return false;
        }
        $ch = curl_init();//初始化curl
        curl_setopt($ch, CURLOPT_URL, $url);//抓取指定网页
        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
        if ($param != '') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_HEADER, false);//设置header

        $data = curl_exec($ch);//运行curl
        curl_close($ch);
        return $data;
    }


    function request_posts($url = '', $param = '')
    {
        if (empty($url) || empty($param)) {
            return false;
        }
        $ch = curl_init();//初始化curl
        curl_setopt($ch, CURLOPT_URL, $url);//抓取指定网页
        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
        if ($param != '') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_HEADER, true);//设置header
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // https请求 不验证证书和hosts
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $data = curl_exec($ch);//运行curl
        curl_close($ch);
        return $data;
    }

    function _requestPost($url, $data, $ssl = true, $header = null, $cookie = false, $do_header = false)
    {
        // curl完成
        $curl = curl_init();

        //设置curl选项
        curl_setopt($curl, CURLOPT_URL, $url);//URL
        $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36';
        curl_setopt($curl, CURLOPT_USERAGENT, $user_agent);//user_agent，请求代理信息
        curl_setopt($curl, CURLOPT_AUTOREFERER, true);//referer头，请求来源
        //SSL相关
        if ($ssl) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//禁用后cURL将终止从服务端进行验证
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);//检查服务器SSL证书中是否存在一个公用名(common name)。
            if (isset($ssl['cert']) and isset($ssl['key'])) {
                curl_setopt($curl, CURLOPT_SSLCERT, $ssl['cert']);
                curl_setopt($curl, CURLOPT_SSLKEY, $ssl['key']);
            }
        }
        if ($header) {
            for ($i = 0; $i < count($header); $i++) {
                $headers[] = $header[$i]; // 'Content-Type: application/x-www-form-urlencoded; charset=utf-8';
            }
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        }
        if ($cookie) {
            curl_setopt($curl, CURLOPT_COOKIE, $cookie);
        }
        // 处理post相关选项
        curl_setopt($curl, CURLOPT_POST, true);// 是否为POST请求
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);// 处理请求数据
        // 处理响应结果
        curl_setopt($curl, CURLOPT_HEADER, $do_header);//是否处理响应头
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);//curl_exec()是否返回响应结果

        // 发出请求
        $response = curl_exec($curl);
        curl_close($curl);
        if (false === $response) {
            return false;
        }
        $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $body = substr($response, $headerSize);
        return $body;
    }


    //返回获取公众号AccessToken
    function getUserinfo_openid($appid, $appsecret, $code)
    {
        $url = 'https://api.weixin.qq.com/sns/jscode2session?appid=' . $appid . '&secret=' . $appsecret . '&js_code=' . $code . '&grant_type=authorization_code';
        $html = $this->file_get_content($url);//file_get_contents
        $output = json_decode($html, true);
        return $output;// $output;
    }


    //   //https 访问 返回获取公众号AccessToken
    // function getUserinfo_openid ($appid, $appsecret,$code) {                    
    //     $cachekey = "accesstoken_user:".$code;
    //     $cache = cache_load($cachekey);
    //     if (!empty($cache) && !empty($cache['user_token']) && $cache['expire_user'] > TIMESTAMP) {
    //         //$this->account['access_token_user'] = $cache;
    //         $user_token=$cache['user_token'];
    //         $user_token['is_cache']=true;
    //         return  $user_token;
    //     }

    //     $url='https://api.weixin.qq.com/sns/jscode2session?appid='.$appid.'&secret='.$appsecret.'&js_code='.$code.'&grant_type=authorization_code'; 
    //     $html =$this->file_get_content($url);//file_get_contents
    //     $response =@json_decode($html,true);
    //     //load()->func('communication');
    //     //$output = $this->requestApi($url);
    //     $record = array();
    //     $record['user_token'] = $response;
    //     $record['expire_user'] = TIMESTAMP + $response['expires_in'] - 200;        
    //     //$this->account['access_token_user'] = $record;
    //     cache_write($cachekey, $record);
    //     return $response;
    // }


    //获取小程序accseeToken
    function getAccessToken($appid, $appsecret)
    {
        $cachekey = "access_token_xcx:" . $appid;
        $cache = cache_load($cachekey);
        if (!empty($cache) && !empty($cache['access_token']) && $cache['expire_token_xcx'] > TIMESTAMP) {
            //$this->account['access_token_user'] = $cache;
            $user_token = $cache['access_token'];

            return $user_token;
        }
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $appid . '&secret=' . $appsecret;
        $html = $this->file_get_content($url);//file_get_contents
        $response = @json_decode($html, true);
        //load()->func('communication');
        //$output = $this->requestApi($url);
        $record = array();
        $record['access_token'] = $response['access_token'];
        $record['expire_token_xcx'] = TIMESTAMP + $response['expires_in'] - 200;
        //$this->account['access_token_user'] = $record;
        cache_write($cachekey, $record);
        return $response['access_token'];
    }


    function file_get_content($url)
    {
        if (function_exists('file_get_contents')) {
            $file_contents = @file_get_contents($url);
        }
        if ($file_contents == '') {
            $ch = curl_init();
            $timeout = 30;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $file_contents = curl_exec($ch);
            curl_close($ch);
        }
        return $file_contents;
    }

    //返回获取公众号AccessToken
    // function getAccessToken ($appid, $appsecret) {                    
    //     $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsecret;
    //     $html = file_get_contents($url);
    //     $output = json_decode($html, true);
    //     $access_token = $output['access_token'];
    //     return $access_token;
    // }
    //发送模板消息

    /**
     *发布模板消息
     * @param string $openid
     * @param string $templateid
     * @param string $formid //打开页面id
     * @param string $data_arr //数据提示
     */
    function send_template_fun($openid, $templateid, $formid, $page, $data_arr, $emphasis_keyword = '')
    {
        $account_api = WeAccount::create();
        $access_token = $account_api->getAccessToken();
        //$access_token=$this->getAccessToken ($appid, $appsecret);     
        $post_data = array(
            'touser' => $openid,
            'template_id' => $templateid,
            "page" => $page,//点击模板消息后跳转到的页面，可以传递参数
            'form_id' => $formid,
            'data' => $data_arr,
            'emphasis_keyword' => $emphasis_keyword . '.DATA'//keyword2.DATA
            //需要强调的关键字，会加大居中显示
        );

        $url = 'https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send?access_token=' . $access_token;
        //这里替换为你的 appID 和 appSecret
        $data = json_encode($post_data, true);
        //将数组编码为 JSON
        $return = $this->send_post($url, $data);
        return $return;
    }

    //post 模拟
    function send_post($url, $post_data)
    {
        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-type:application/json',//header 需要设置为 JSON
                'content' => $post_data,
                'timeout' => 60//超时时间
            )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        return $result;
    }

    function send_post2($url, $post_data)
    {
        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-type:application/x-www-form-urlencoded',//header 需要设置为 JSON
                //'content' => $post_data,
                'timeout' => 60//超时时间
            )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        return $result;
    }


}


?>