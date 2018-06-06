<?php

public function doWebHb(){
        global $_W,$_GPC;
        load()->func('tpl');
        load()->model('account');
        $sql = "SELECT * FROM ".tablename('haoman_qjb_hb')." WHERE uniacid = :uniacid";
        $params = array(':uniacid'=>$_W['uniacid']);
        $settings = pdo_fetch($sql,$params);
        $settings = unserialize($settings['set']);
        if($_W['ispost']) {
            //字段验证, 并获得正确的数据$dat
            load()->func('file');
            mkdirs(ROOT_PATH . '/cert');
            $r = true;
            if (!empty($_GPC['cert'])) {
                $ret = file_put_contents(ROOT_PATH . '/cert/apiclient_cert.pem.' . $_W['uniacid'], trim($_GPC['cert']));
                $r = $r && $ret;
            }
            if (!empty($_GPC['key'])) {
                $ret = file_put_contents(ROOT_PATH . '/cert/apiclient_key.pem.' . $_W['uniacid'], trim($_GPC['key']));
                $r = $r && $ret;
            }
            if (!empty($_GPC['ca'])) {
                $ret = file_put_contents(ROOT_PATH . '/cert/rootca.pem.' . $_W['uniacid'], trim($_GPC['ca']));
                $r = $r && $ret;
            }
            if (!$r) {
                message('证书保存失败, 请保证 /addons/haoman_qjb/cert/ 目录可写');
            }
            $input = array_elements(array(
                'appid',
                'secret',
                'mchid',
                'password',
                'ip',
                'sname',
                'wishing',
                'actname',
                'logo'
            ) , $_GPC);
            $input['appid'] = trim($input['appid']);
            $input['secret'] = trim($input['secret']);
            $input['mchid'] = trim($input['mchid']);
            $input['sname'] = trim($input['sname']);
            $input['actname'] = trim($input['actname']);
            $input['wishing'] = trim($input['wishing']);
            $input['password'] = trim($input['password']);
            $input['ip'] = trim($input['ip']);
            $input['logo'] = trim($input['logo']);
            $data = array();
            $data['set'] = serialize($input);
            $data['uniacid'] = $_W['uniacid'];

            if(empty($settings)){
                pdo_insert('haoman_qjb_hb',$data);
            }else{
                pdo_update('haoman_qjb_hb',$data,array('uniacid'=>$_W['uniacid']));
            }

            message('提交成功',referer(),success);
        }

        if (empty($settings['ip'])) {
            $settings['ip'] = $_SERVER['SERVER_ADDR'];
        }
        include $this->template('hsetting');
    }

?>