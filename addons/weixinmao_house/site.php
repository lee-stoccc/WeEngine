<?php
/**
 * 企业小程序模块微站定义
 *
 * @author  w*w*w*.*e*f*w*w*w*.*c*o*m 易福源码网
 * @url 
 */
defined('IN_IA') or exit('Access Denied');

class Weixinmao_houseModuleSite extends WeModuleSite {
  

	public function doWebIntro() {
		//这个操作被定义用来呈现 管理中心导航菜单
		global $_W,$_GPC;
		load()->func('tpl');
        $operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';

	   if ($operation == 'post') {
            $id = intval($_GPC['id']);
            if (checksubmit('submit')) {
                $data = array(
                    'uniacid' => $_W['uniacid'],
					'name'=>$_GPC['name'],
					'city'=>$_GPC['city'],
					'address'=>$_GPC['address'],
					'tel'=>$_GPC['tel'],
					'qq'=>$_GPC['qq'],
					'email'=>$_GPC['email'],
					'logo'=>$_GPC['logo'],
					'name'=>$_GPC['name'],
					'opentime'=>$_GPC['opentime'],
					'lng'=>$_GPC['location']['lng'],
					'lat'=>$_GPC['location']['lat'],
                    'content' => ihtmlspecialchars($_GPC['content']),
                    'createtime' => TIMESTAMP,
                );
               
                if (!empty($id)) {
                    unset($data['createtime']);
                    pdo_update('weixinmao_house_intro', $data, array('id' => $id));
                } else {
                    pdo_insert('weixinmao_house_intro', $data);
                    $id = pdo_insertid();
                }
                message('更新成功！', $this->createWebUrl('intro', array('op' => 'display')), 'success');
            }
            if (empty($shop)) {
                $shop['displayorder'] = 0;
                $shop['enabled'] = 1;
            }
        }elseif($operation == 'display'){
   	
		$intro = pdo_fetch("select * from " . tablename('weixinmao_house_intro') . " where uniacid=:uniacid limit 1", array(":uniacid" => $_W['uniacid']));
		include $this->template('intro');
		}
	}
	public function doWebCate() {
		//这个操作被定义用来呈现 管理中心导航菜单
		global $_GPC, $_W;
		load()->func('tpl');
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		if ($operation == 'display') {
			if (!empty($_GPC['displayorder'])) {
				foreach ($_GPC['displayorder'] as $id => $displayorder) {
					pdo_update('weixinmao_house_category', array('displayorder' => $displayorder), array('id' => $id, 'weid' => $_W['uniacid']));
				}
				message('分类排序更新成功！', $this->createWebUrl('category', array('op' => 'display')), 'success');
			}
			$children = array();
			
			$category = pdo_fetchall("SELECT * FROM " . tablename('weixinmao_house_category') . " WHERE weid = '{$_W['uniacid']}' ORDER BY parentid ASC, displayorder DESC");
			foreach ($category as $index => $row) {
				if (!empty($row['parentid'])) {
					$children[$row['parentid']][] = $row;
					unset($category[$index]);
				}
			}
			include $this->template('category');
		} elseif ($operation == 'post') {
			
			$parentid = intval($_GPC['parentid']);
			$id = intval($_GPC['id']);
			if (!empty($id)) {
				$category = pdo_fetch("SELECT * FROM " . tablename('weixinmao_house_category') . " WHERE id = :id AND weid = :weid", array(':id' => $id, ':weid' => $_W['uniacid']));
			} else {
				$category = array(
					'displayorder' => 0,
				);
			}
			if (!empty($parentid)) {
				$parent = pdo_fetch("SELECT id, name FROM " . tablename('weixinmao_house_category') . " WHERE id = '$parentid'");
				if (empty($parent)) {
					message('抱歉，上级分类不存在或是已经被删除！', $this->createWebUrl('post'), 'error');
				}
			}
			if (checksubmit('submit')) {
				if (empty($_GPC['catename'])) {
					message('抱歉，请输入分类名称！');
				}
				$data = array(
					'weid' => $_W['uniacid'],
					'name' => $_GPC['catename'],
					'enabled' => intval($_GPC['enabled']),
					'displayorder' => intval($_GPC['displayorder']),
					'isrecommand' => intval($_GPC['isrecommand']),
					'model'=>intval($_GPC['model']),
					'description' => $_GPC['description'],
					'parentid' => intval($parentid),
					'thumb' => $_GPC['thumb']
				);
				if (!empty($id)) {
					unset($data['parentid']);
					pdo_update('weixinmao_house_category', $data, array('id' => $id, 'weid' => $_W['uniacid']));
					load()->func('file');
					file_delete($_GPC['thumb_old']);
				} else {
					pdo_insert('weixinmao_house_category', $data);
					$id = pdo_insertid();
				}
				message('更新分类成功！', $this->createWebUrl('cate', array('op' => 'display')), 'success');
			}
			include $this->template('category');
		} elseif ($operation == 'delete') {
			$id = intval($_GPC['id']);
			$category = pdo_fetch("SELECT id, parentid FROM " . tablename('weixinmao_house_category') . " WHERE id = '$id'");
			if (empty($category)) {
				message('抱歉，分类不存在或是已经被删除！', $this->createWebUrl('weixinmao_house_category', array('op' => 'display')), 'error');
			}
			pdo_delete('weixinmao_house_category', array('id' => $id, 'parentid' => $id), 'OR');
			message('分类删除成功！', $this->createWebUrl('cate', array('op' => 'display')), 'success');
		}
		
	}
	public function doWebContent() {
		//这个操作被定义用来呈现 管理中心导航菜单
				global $_GPC, $_W;
		load()->func('tpl');

		$sql = 'SELECT * FROM ' . tablename('weixinmao_house_category') . ' WHERE `weid` = :weid ORDER BY `parentid`, `displayorder` DESC';
		
		$category = pdo_fetchall($sql, array(':weid' => $_W['uniacid']), 'id');
		
	
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		if ($operation == 'post') {
			
			$id = $_GPC['id'];
	
			 if (!empty($id)) {
				 
				 		$item = pdo_fetch("SELECT *  FROM " . tablename('weixinmao_house_content') . " WHERE id = :id", array(':id' => $id));
					
						
			}
			
			$pid = $_GPC['category']['parentid'];
			
			$sid = 0;

			
			if (checksubmit('submit')) {
				//print_r($_GPC);
				//exit;
                $data = array(
                    'uniacid' => $_W['uniacid'],
					'title'=>$_GPC['title'],
					'pid'=>$pid,
					'sid'=>$sid,
                    'content' => ihtmlspecialchars($_GPC['content']),
					'sort'=>$_GPC['sort'],
					'thumb'=>$_GPC['thumb'],
                    'createtime' => TIMESTAMP,
                );
               
                if (!empty($id)) {
                    unset($data['createtime']);
                    pdo_update('weixinmao_house_content', $data, array('id' => $id));
                } else {
                    pdo_insert('weixinmao_house_content', $data);
                    $id = pdo_insertid();
                }
                message('更新成功！', $this->createWebUrl('content', array('op' => 'display')), 'success');
            }
			
			
			
			
		} elseif ($operation == 'display') {
			
			echo $_GPC['keyword'];
			$pindex = max(1, intval($_GPC['page']));
			$psize = 15;
			$condition = ' WHERE `uniacid` = :uniacid ';
			$params = array(':uniacid' => $_W['uniacid']);
			
			if (!empty($_GPC['keyword'])) {
				$condition .= ' AND `title` LIKE :title';
				$params[':title'] = '%' . trim($_GPC['keyword']) . '%';
			}
			
			
			$sql = 'SELECT COUNT(*) FROM ' . tablename('weixinmao_house_content') .$condition ;

			$total = pdo_fetchcolumn($sql, $params);
			
			if (!empty($total)) {
				$sql = 'SELECT * FROM  ' . tablename('weixinmao_house_content') .$condition.' ORDER BY  `sort`  DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
				$list = pdo_fetchall($sql, $params);
				$pager = pagination($total, $pindex, $psize);
			}
			foreach($list as $k=>$v)
			{
				$parent_info = pdo_fetch("SELECT name  FROM " . tablename('weixinmao_house_category') . " WHERE id = :id", array(':id' => $v['pid']));
				$children_info = pdo_fetch("SELECT name  FROM " . tablename('weixinmao_house_category') . " WHERE id = :id", array(':id' => $v['sid']));

				$list[$k]['parent_catename'] = $parent_info['name'];
				$list[$k]['children_catename'] = $children_info['name'];
			}
			
			
		} elseif ($operation == 'delete') {
			$id = intval($_GPC['id']);
			$row = pdo_fetch("SELECT id FROM " . tablename('weixinmao_house_content') . " WHERE id = :id", array(':id' => $id));
			if (empty($row)) {
				message('抱歉，商品不存在或是已经被删除！');
			}

			pdo_delete('weixinmao_house_content', array('id' => $id));
			message('删除成功！', referer(), 'success');
		}
		include $this->template('goods');
		
	}
	
	
	
	
		public function doWebSalelist() {
		//这个操作被定义用来呈现 管理中心导航菜单
		global $_GPC, $_W;
		load()->func('tpl');
		
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		$sql = 'SELECT * FROM ' . tablename('weixinmao_house_area') . ' WHERE `uniacid` = :uniacid ORDER BY `sort` DESC';
		$speciallist = array();
		$arealist = pdo_fetchall($sql, array(':uniacid' => $_W['uniacid']));
		if ($operation == 'post') {
			
			$id = $_GPC['id'];
	
		
		
	
		} elseif ($operation == 'display') {
			
			//echo $_GPC['keyword'];
			$pindex = max(1, intval($_GPC['page']));
			$psize = 15;
			$condition = ' WHERE `uniacid` = :uniacid ';
			$params = array(':uniacid' => $_W['uniacid']);
			
			if (!empty($_GPC['keyword'])) {
				$condition .= ' AND `content` LIKE :title';
				$params[':title'] = '%' . trim($_GPC['keyword']) . '%';
			}
			
			
			$sql = 'SELECT COUNT(*) FROM ' . tablename('weixinmao_house_saleinfo') .$condition ;
		
			$total = pdo_fetchcolumn($sql, $params);
			
			if (!empty($total)) {
				$sql = 'SELECT * FROM  ' . tablename('weixinmao_house_saleinfo') .$condition.' ORDER BY  `createtime`  DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
				$list = pdo_fetchall($sql, $params);
				
				$pager = pagination($total, $pindex, $psize);
			}

			if($list)
			{
				if($arealist)
				{
				foreach($arealist as $k=>$v)
						{
								$areainfo[$v['id']] = $v['name'];			
						}
				}
				$housetypeinfo= array(1=>'出售',2=>'出租',3=>'求购',4=>'求租');
				
				foreach($list as $k=>$v)
					{
						$list[$k]['areaname'] =  $areainfo[$v['houseareaid']];
						$list[$k]['type'] =  $housetypeinfo[$v['type']];
					}
				
				
			}
			
			
			
			
		} elseif($operation == 'done'){
			
			$id = intval($_GPC['id']);
			$row = pdo_fetch("SELECT id FROM " . tablename('weixinmao_house_saleinfo') . " WHERE id = :id", array(':id' => $id));
			if (empty($row)) {
				message('抱歉，订单不存在或是已经被删除！');
			}
			 pdo_update('weixinmao_house_saleinfo', array('ischeck'=>1), array('id' => $id));

			message('操作成功！', referer(), 'success');
			
		
		}elseif ($operation == 'delete') {
			$id = intval($_GPC['id']);
			$row = pdo_fetch("SELECT id FROM " . tablename('weixinmao_house_saleinfo') . " WHERE id = :id", array(':id' => $id));
			if (empty($row)) {
				message('抱歉，不存在或是已经被删除！');
			}

			pdo_delete('weixinmao_house_saleinfo', array('id' => $id));

			message('删除成功！', referer(), 'success');
		}
		include $this->template('salelist');
		
	}
	
	
	
	
	public function doWebNewhouse() {
		//这个操作被定义用来呈现 管理中心导航菜单
		global $_GPC, $_W;
		load()->func('tpl');
		
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		$sql = 'SELECT * FROM ' . tablename('weixinmao_house_area') . ' WHERE `uniacid` = :uniacid ORDER BY `sort` DESC';
		$speciallist = array();
		$arealist = pdo_fetchall($sql, array(':uniacid' => $_W['uniacid']));
		if ($operation == 'post') {
			
			$id = $_GPC['id'];
	
			 if (!empty($id)) {
				 
				 		$item = pdo_fetch("SELECT *  FROM " . tablename('weixinmao_house_houseinfo') . " WHERE id = :id", array(':id' => $id));
						$speciallist = explode(',',$item['productspecial']);
						$piclist1 = unserialize($item['thumb_url']);
						$piclist = array();
						if(is_array($piclist1)){
							foreach($piclist1 as $p){
								$piclist[] = is_array($p)?$p['attachment']:$p;
							}
						}
						
			}
			
		
			if (checksubmit('submit')) {
				if(is_array($_GPC['thumbs'])){
					$thumb_data['thumb_url'] = serialize($_GPC['thumbs']);
				}
                $data = array(
                    'uniacid' => $_W['uniacid'],
					'housename'=>$_GPC['housename'],
					'companyname'=>$_GPC['companyname'],
					'housetype'=>$_GPC['housetype'],
					'houseprice'=>$_GPC['houseprice'],
					'houseareaid'=>$_GPC['houseareaid'],
					'houseaddress'=>$_GPC['houseaddress'],
					'housesaleaddress'=>$_GPC['housesaleaddress'],
					'houserate'=>$_GPC['houserate'],
					'housegreenrate'=>$_GPC['housegreenrate'],
					'housecovered'=>$_GPC['housecovered'],
					'buildarea'=>$_GPC['buildarea'],
					'opensaletime'=>$_GPC['opensaletime'],
					'staytime'=>$_GPC['staytime'],
					'productspecial'=>implode(',',$_GPC['productspecial']),
					'houseschool'=>$_GPC['houseschool'],
					'housebus'=>$_GPC['housebus'],
					'housestatus'=>$_GPC['housestatus'],
                    'content' => ihtmlspecialchars($_GPC['content']),
					'sort'=>$_GPC['sort'],
					'thumb'=>$_GPC['thumb'],
					'thumb_url'=>$thumb_data['thumb_url'],
					'isrecommand'=>$_GPC['isrecommand'],
					'tel'=>$_GPC['tel'],
                   'createtime' => TIMESTAMP,
				   'lng'=>$_GPC['location']['lng'],
				   'lat'=>$_GPC['location']['lat'],
                );
                if (!empty($id)) {
                    unset($data['createtime']);
                    pdo_update('weixinmao_house_houseinfo', $data, array('id' => $id));
                } else {
                    pdo_insert('weixinmao_house_houseinfo', $data);
                    $id = pdo_insertid();
                }
                message('更新成功！', $this->createWebUrl('newhouse', array('op' => 'display')), 'success');
            }
			
			
			
			
		} elseif ($operation == 'display') {
			
			//echo $_GPC['keyword'];
			$pindex = max(1, intval($_GPC['page']));
			$psize = 15;
			$condition = ' WHERE `uniacid` = :uniacid ';
			$params = array(':uniacid' => $_W['uniacid']);
			
			if (!empty($_GPC['keyword'])) {
				$condition .= ' AND `title` LIKE :title';
				$params[':title'] = '%' . trim($_GPC['keyword']) . '%';
			}
			
			
			$sql = 'SELECT COUNT(*) FROM ' . tablename('weixinmao_house_houseinfo') .$condition ;
		
			$total = pdo_fetchcolumn($sql, $params);
			
			if (!empty($total)) {
				$sql = 'SELECT * FROM  ' . tablename('weixinmao_house_houseinfo') .$condition.' ORDER BY  `sort`  DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
				$list = pdo_fetchall($sql, $params);
				
				$pager = pagination($total, $pindex, $psize);
			}

			if($list)
			{
				if($arealist)
				{
				foreach($arealist as $k=>$v)
						{
								$areainfo[$v['id']] = $v['name'];			
						}
				}
				$housetypeinfo= array(1=>'住宅',2=>'别墅',3=>'公寓',4=>'商铺',5=>'写字楼',6=>'酒店',7=>'厂房');
				
				foreach($list as $k=>$v)
					{
						$list[$k]['areaname'] =  $areainfo[$v['houseareaid']];
						$list[$k]['housetypename'] =  $housetypeinfo[$v['housetype']];
					}
				
				
			}
			
			
			
			
		} elseif ($operation == 'delete') {
			$id = intval($_GPC['id']);
			$row = pdo_fetch("SELECT id FROM " . tablename('weixinmao_house_houseinfo') . " WHERE id = :id", array(':id' => $id));
			if (empty($row)) {
				message('抱歉，不存在或是已经被删除！');
			}

			pdo_delete('weixinmao_house_houseinfo', array('id' => $id));

			message('删除成功！', referer(), 'success');
		}
		include $this->template('newhouse');
		
	}
	
	
	public function doWebOldhouse() {
		//这个操作被定义用来呈现 管理中心导航菜单
		global $_GPC, $_W;
		load()->func('tpl');
		
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		$sql = 'SELECT * FROM ' . tablename('weixinmao_house_area') . ' WHERE `uniacid` = :uniacid ORDER BY `sort` DESC';
		
		$arealist = pdo_fetchall($sql, array(':uniacid' => $_W['uniacid']));
		
		
		if ($operation == 'post') {
			
			$id = $_GPC['id'];
	
			 if (!empty($id)) {
				 
				 		$item = pdo_fetch("SELECT *  FROM " . tablename('weixinmao_house_oldhouseinfo') . " WHERE id = :id", array(':id' => $id));
					    $speciallist = explode(',',$item['special']);
						$piclist1 = unserialize($item['thumb_url']);
						$piclist = array();
						if(is_array($piclist1)){
							foreach($piclist1 as $p){
								$piclist[] = is_array($p)?$p['attachment']:$p;
							}
						}
			}
			
		
			if (checksubmit('submit')) {
				//print_r($_GPC);
			//	exit;
				if(is_array($_GPC['thumbs'])){
					$thumb_data['thumb_url'] = serialize($_GPC['thumbs']);
				}
                $data = array(
                    'uniacid' => $_W['uniacid'],
					'title'=>$_GPC['title'],
					'saleprice'=>$_GPC['saleprice'],
					'perprice'=>$_GPC['perprice'],
					'housestyle'=>$_GPC['housestyle'],
					'housetype'=>$_GPC['housetype'],
					'houseareaid'=>$_GPC['houseareaid'],
					'area'=>$_GPC['area'],
					'floor'=>$_GPC['floor'],
					'direction'=>$_GPC['direction'],
					'decorate'=>$_GPC['decorate'],
					'year'=>$_GPC['year'],
					'source'=>$_GPC['source'],
					'housearea'=>$_GPC['housearea'],
					'address'=>$_GPC['address'],
					'special'=>implode(',',$_GPC['special']),
					'lng'=>$_GPC['location']['lng'],
					'lat'=>$_GPC['location']['lat'],
					'name'=>$_GPC['name'],
					'tel'=>$_GPC['tel'],
					'salestatus'=>$_GPC['salestatus'],
                    'content' => ihtmlspecialchars($_GPC['content']),
					'sort'=>$_GPC['sort'],
					'thumb'=>$_GPC['thumb'],
					'thumb_url'=>$thumb_data['thumb_url'],
					'isrecommand'=>$_GPC['isrecommand'],
                   'createtime' => TIMESTAMP,
                ); 
              // print_r($data);
			  // exit;
                if (!empty($id)) {
                    unset($data['createtime']);
                    pdo_update('weixinmao_house_oldhouseinfo', $data, array('id' => $id));
                } else {
                    pdo_insert('weixinmao_house_oldhouseinfo', $data);
                    $id = pdo_insertid();
                }
                message('更新成功！', $this->createWebUrl('oldhouse', array('op' => 'display')), 'success');
            }
			
			
			
			
		}elseif($operation == 'done'){
			
			$id = intval($_GPC['id']);
			$row = pdo_fetch("SELECT id FROM " . tablename('weixinmao_house_oldhouseinfo') . " WHERE id = :id", array(':id' => $id));
			if (empty($row)) {
				message('抱歉，订单不存在或是已经被删除！');
			}
			 pdo_update('weixinmao_house_oldhouseinfo', array('ischeck'=>1), array('id' => $id));

			message('操作成功！', referer(), 'success');
			
		
		}elseif ($operation == 'display') {
			
			//echo $_GPC['keyword'];
			
			$pindex = max(1, intval($_GPC['page']));
			$psize = 15;
			$condition = ' WHERE `uniacid` = :uniacid  AND ispub =0';
			$params = array(':uniacid' => $_W['uniacid']);
			
			if (!empty($_GPC['keyword'])) {
				$condition .= ' AND `title` LIKE :title';
				$params[':title'] = '%' . trim($_GPC['keyword']) . '%';
			}
			
			
			$sql = 'SELECT COUNT(*) FROM ' . tablename('weixinmao_house_oldhouseinfo') .$condition ;
		
			$total = pdo_fetchcolumn($sql, $params);
			
			if (!empty($total)) {
				$sql = 'SELECT * FROM  ' . tablename('weixinmao_house_oldhouseinfo') .$condition.' ORDER BY  `sort`  DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
				$list = pdo_fetchall($sql, $params);
				
				$pager = pagination($total, $pindex, $psize);
			}
			if($list)
			{
				if($arealist)
				{
				foreach($arealist as $k=>$v)
						{
								$areainfo[$v['id']] = $v['name'];			
						}
				}
				$housetypeinfo= array(1=>'住宅',2=>'别墅',3=>'公寓',4=>'商铺',5=>'写字楼',6=>'酒店',7=>'厂房');
				
				foreach($list as $k=>$v)
					{
						$list[$k]['areaname'] =  $areainfo[$v['houseareaid']];
						$list[$k]['housetypename'] =  $housetypeinfo[$v['housetype']];
					}	
			}
			
			
		} elseif ($operation == 'displaymember') {
			
			//echo $_GPC['keyword'];
		
			$pindex = max(1, intval($_GPC['page']));
			$psize = 15;
			$condition = ' WHERE `uniacid` = :uniacid  AND ispub =1 AND uid>0 AND ischeck =1 ';
			$params = array(':uniacid' => $_W['uniacid']);
			
			if (!empty($_GPC['keyword'])) {
				$condition .= ' AND `title` LIKE :title';
				$params[':title'] = '%' . trim($_GPC['keyword']) . '%';
			}
			
			
			$sql = 'SELECT COUNT(*) FROM ' . tablename('weixinmao_house_oldhouseinfo') .$condition ;
		
			$total = pdo_fetchcolumn($sql, $params);
			
			if (!empty($total)) {
				$sql = 'SELECT * FROM  ' . tablename('weixinmao_house_oldhouseinfo') .$condition.' ORDER BY  `sort`  DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
				$list = pdo_fetchall($sql, $params);
				
				$pager = pagination($total, $pindex, $psize);
			}
			if($list)
			{
				if($arealist)
				{
				foreach($arealist as $k=>$v)
						{
								$areainfo[$v['id']] = $v['name'];			
						}
				}
				$housetypeinfo= array(1=>'住宅',2=>'别墅',3=>'公寓',4=>'商铺',5=>'写字楼',6=>'酒店',7=>'厂房');
				
				foreach($list as $k=>$v)
					{
						$list[$k]['areaname'] =  $areainfo[$v['houseareaid']];
						$list[$k]['housetypename'] =  $housetypeinfo[$v['housetype']];
					}	
			}
		
			
			
		} elseif ($operation == 'displaycheck') {
			
			//echo $_GPC['keyword'];
		
			$pindex = max(1, intval($_GPC['page']));
			$psize = 15;
			$condition = ' WHERE `uniacid` = :uniacid  AND ispub =1 AND uid>0 AND ischeck =0';
			$params = array(':uniacid' => $_W['uniacid']);
			
			if (!empty($_GPC['keyword'])) {
				$condition .= ' AND `title` LIKE :title';
				$params[':title'] = '%' . trim($_GPC['keyword']) . '%';
			}
			
			
			$sql = 'SELECT COUNT(*) FROM ' . tablename('weixinmao_house_oldhouseinfo') .$condition ;
		
			$total = pdo_fetchcolumn($sql, $params);
			
			if (!empty($total)) {
				$sql = 'SELECT * FROM  ' . tablename('weixinmao_house_oldhouseinfo') .$condition.' ORDER BY  `createtime`  DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
				$list = pdo_fetchall($sql, $params);
				
				$pager = pagination($total, $pindex, $psize);
			}
			if($list)
			{
				if($arealist)
				{
				foreach($arealist as $k=>$v)
						{
								$areainfo[$v['id']] = $v['name'];			
						}
				}
				$housetypeinfo= array(1=>'住宅',2=>'别墅',3=>'公寓',4=>'商铺',5=>'写字楼',6=>'酒店',7=>'厂房');
				
				foreach($list as $k=>$v)
					{
						$list[$k]['areaname'] =  $areainfo[$v['houseareaid']];
						$list[$k]['housetypename'] =  $housetypeinfo[$v['housetype']];
					}	
			}
		
			
			
		}elseif ($operation == 'delete') {
			$id = intval($_GPC['id']);
			$row = pdo_fetch("SELECT id FROM " . tablename('weixinmao_house_oldhouseinfo') . " WHERE id = :id", array(':id' => $id));
			if (empty($row)) {
				message('抱歉，不存在或是已经被删除！');
			}

			pdo_delete('weixinmao_house_oldhouseinfo', array('id' => $id));

			message('删除成功！', referer(), 'success');
		}
	
		include $this->template('oldhouse');
		
	}
	
	
	
	public function doWebLethouse() {
		//这个操作被定义用来呈现 管理中心导航菜单
		global $_GPC, $_W;
		load()->func('tpl');
		 $labellist = array();
		 $speciallist = array();
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		$sql = 'SELECT * FROM ' . tablename('weixinmao_house_area') . ' WHERE `uniacid` = :uniacid ORDER BY `sort` DESC';
		
		$arealist = pdo_fetchall($sql, array(':uniacid' => $_W['uniacid']));
		
		
		if ($operation == 'post') {
			
			$id = $_GPC['id'];
	
			 if (!empty($id)) {
				 
				 		$item = pdo_fetch("SELECT *  FROM " . tablename('weixinmao_house_lethouseinfo') . " WHERE id = :id", array(':id' => $id));
					    $speciallist = explode(',',$item['special']);
						 $labellist = explode(',',$item['houselabel']);
						$piclist1 = unserialize($item['thumb_url']);
						$piclist = array();
						if(is_array($piclist1)){
							foreach($piclist1 as $p){
								$piclist[] = is_array($p)?$p['attachment']:$p;
							}
						}
			}
			
		
		
			if (checksubmit('submit')) {
				//print_r($_GPC);
			//	exit;
				if(is_array($_GPC['thumbs'])){
					$thumb_data['thumb_url'] = serialize($_GPC['thumbs']);
				}
                $data = array(
                    'uniacid' => $_W['uniacid'],
					'title'=>$_GPC['title'],
					'money'=>$_GPC['money'],
					'dmoney'=>$_GPC['dmoney'],
					'roomid'=>$_GPC['roomid'],
					'roomtype'=>$_GPC['roomtype'],
					'housetype'=>$_GPC['housetype'],
					'letway'=>$_GPC['letway'],
					'payway'=>$_GPC['payway'],
					'houselabel'=>implode(',',$_GPC['houselabel']),
					'houseareaid'=>$_GPC['houseareaid'],
					'area'=>$_GPC['area'],
					'floor'=>$_GPC['floor'],
					'direction'=>$_GPC['direction'],
					'decorate'=>$_GPC['decorate'],
					'year'=>$_GPC['year'],
					'source'=>$_GPC['source'],
					'housearea'=>$_GPC['housearea'],
					'address'=>$_GPC['address'],
					'special'=>implode(',',$_GPC['special']),
					'lng'=>$_GPC['location']['lng'],
					'lat'=>$_GPC['location']['lat'],
					'name'=>$_GPC['name'],
					'tel'=>$_GPC['tel'],
					'salestatus'=>$_GPC['salestatus'],
                    'content' => ihtmlspecialchars($_GPC['content']),
					'sort'=>$_GPC['sort'],
					'thumb'=>$_GPC['thumb'],
					'thumb_url'=>$thumb_data['thumb_url'],
					'isrecommand'=>$_GPC['isrecommand'],
                   'createtime' => TIMESTAMP,
                ); 
              // print_r($data);
			  // exit;
                if (!empty($id)) {
                    unset($data['createtime']);
                    pdo_update('weixinmao_house_lethouseinfo', $data, array('id' => $id));
                } else {
                    pdo_insert('weixinmao_house_lethouseinfo', $data);
                    $id = pdo_insertid();
                }
                message('更新成功！', $this->createWebUrl('lethouse', array('op' => 'display')), 'success');
            }
			
			
			
			
		}elseif($operation == 'done'){
			
			$id = intval($_GPC['id']);
			$row = pdo_fetch("SELECT id FROM " . tablename('weixinmao_house_lethouseinfo') . " WHERE id = :id", array(':id' => $id));
			if (empty($row)) {
				message('抱歉，订单不存在或是已经被删除！');
			}
			 pdo_update('weixinmao_house_lethouseinfo', array('ischeck'=>1), array('id' => $id));

			message('操作成功！', referer(), 'success');
			
		
		} elseif ($operation == 'display') {
			
			//echo $_GPC['keyword'];
			
			$pindex = max(1, intval($_GPC['page']));
			$psize = 15;
			$condition = ' WHERE `uniacid` = :uniacid  AND ispub =0';

			$params = array(':uniacid' => $_W['uniacid']);
			
			if (!empty($_GPC['keyword'])) {
				$condition .= ' AND `title` LIKE :title';
				$params[':title'] = '%' . trim($_GPC['keyword']) . '%';
			}
			
			
			$sql = 'SELECT COUNT(*) FROM ' . tablename('weixinmao_house_lethouseinfo') .$condition ;
		
			$total = pdo_fetchcolumn($sql, $params);
			
			if (!empty($total)) {
				$sql = 'SELECT * FROM  ' . tablename('weixinmao_house_lethouseinfo') .$condition.' ORDER BY  `sort`  DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
				$list = pdo_fetchall($sql, $params);
				
				$pager = pagination($total, $pindex, $psize);
			}
			if($list)
			{
				if($arealist)
				{
				foreach($arealist as $k=>$v)
						{
								$areainfo[$v['id']] = $v['name'];			
						}
				}
				$housetypeinfo= array(1=>'住宅',2=>'别墅',3=>'公寓',4=>'商铺',5=>'写字楼',6=>'酒店',7=>'厂房');
				$letwayinfo = array(0=>'整租',1=>'合租');
				foreach($list as $k=>$v)
					{
						$list[$k]['areaname'] =  $areainfo[$v['houseareaid']];
						$list[$k]['housetypename'] =  $housetypeinfo[$v['housetype']];
					    $list[$k]['letwayname'] = $letwayinfo[$v['letway']];
					}
				
			}
			
		}elseif ($operation == 'displaymember') {
			
			//echo $_GPC['keyword'];
			
			$pindex = max(1, intval($_GPC['page']));
			$psize = 15;
			$condition = ' WHERE `uniacid` = :uniacid  AND ispub =1 AND uid>0 AND ischeck =1 ';

			$params = array(':uniacid' => $_W['uniacid']);
			
			if (!empty($_GPC['keyword'])) {
				$condition .= ' AND `title` LIKE :title';
				$params[':title'] = '%' . trim($_GPC['keyword']) . '%';
			}
			
			
			$sql = 'SELECT COUNT(*) FROM ' . tablename('weixinmao_house_lethouseinfo') .$condition ;
		
			$total = pdo_fetchcolumn($sql, $params);
			
			if (!empty($total)) {
				$sql = 'SELECT * FROM  ' . tablename('weixinmao_house_lethouseinfo') .$condition.' ORDER BY  `sort`  DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
				$list = pdo_fetchall($sql, $params);
				
				$pager = pagination($total, $pindex, $psize);
			}
			if($list)
			{
				if($arealist)
				{
				foreach($arealist as $k=>$v)
						{
								$areainfo[$v['id']] = $v['name'];			
						}
				}
				$housetypeinfo= array(1=>'住宅',2=>'别墅',3=>'公寓',4=>'商铺',5=>'写字楼',6=>'酒店',7=>'厂房');
				$letwayinfo = array(0=>'整租',1=>'合租');
				foreach($list as $k=>$v)
					{
						$list[$k]['areaname'] =  $areainfo[$v['houseareaid']];
						$list[$k]['housetypename'] =  $housetypeinfo[$v['housetype']];
					    $list[$k]['letwayname'] = $letwayinfo[$v['letway']];
					}
				
			}
			
		}elseif ($operation == 'displaycheck') {
			
			//echo $_GPC['keyword'];
			
			$pindex = max(1, intval($_GPC['page']));
			$psize = 15;
			$condition = ' WHERE `uniacid` = :uniacid  AND ispub =1 AND uid>0 AND ischeck =0 ';

			$params = array(':uniacid' => $_W['uniacid']);
			
			if (!empty($_GPC['keyword'])) {
				$condition .= ' AND `title` LIKE :title';
				$params[':title'] = '%' . trim($_GPC['keyword']) . '%';
			}
			
			
			$sql = 'SELECT COUNT(*) FROM ' . tablename('weixinmao_house_lethouseinfo') .$condition ;
		
			$total = pdo_fetchcolumn($sql, $params);
			
			if (!empty($total)) {
				$sql = 'SELECT * FROM  ' . tablename('weixinmao_house_lethouseinfo') .$condition.' ORDER BY  `sort`  DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
				$list = pdo_fetchall($sql, $params);
				
				$pager = pagination($total, $pindex, $psize);
			}
			if($list)
			{
				if($arealist)
				{
				foreach($arealist as $k=>$v)
						{
								$areainfo[$v['id']] = $v['name'];			
						}
				}
				$housetypeinfo= array(1=>'住宅',2=>'别墅',3=>'公寓',4=>'商铺',5=>'写字楼',6=>'酒店',7=>'厂房');
				$letwayinfo = array(0=>'整租',1=>'合租');
				foreach($list as $k=>$v)
					{
						$list[$k]['areaname'] =  $areainfo[$v['houseareaid']];
						$list[$k]['housetypename'] =  $housetypeinfo[$v['housetype']];
					    $list[$k]['letwayname'] = $letwayinfo[$v['letway']];
					}
				
			}
			
		}  elseif ($operation == 'delete') {
			$id = intval($_GPC['id']);
			$row = pdo_fetch("SELECT id FROM " . tablename('weixinmao_house_lethouseinfo') . " WHERE id = :id", array(':id' => $id));
			if (empty($row)) {
				message('抱歉，不存在或是已经被删除！');
			}

			pdo_delete('weixinmao_house_lethouseinfo', array('id' => $id));

			message('删除成功！', referer(), 'success');
		}
	
		include $this->template('lethouse');
		
	}
	
	
	
	
	
	
	
	
	public function doWebCase() {
		//这个操作被定义用来呈现 管理中心导航菜单
		global $_GPC, $_W;
		load()->func('tpl');
		
		
		$sql = 'SELECT * FROM ' . tablename('weixinmao_house_houseinfo') . ' WHERE `uniacid` = :uniacid ORDER BY `sort` DESC';
		
		$teamlist = pdo_fetchall($sql, array(':uniacid' => $_W['uniacid']));
		
	
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		if ($operation == 'post') {
			
			$id = $_GPC['id'];
	
			 if (!empty($id)) {
				 
				 		$item = pdo_fetch("SELECT *  FROM " . tablename('weixinmao_house_case') . " WHERE id = :id", array(':id' => $id));
							
			}
			
		
			if (checksubmit('submit')) {
                $data = array(
                    'uniacid' => $_W['uniacid'],
					'title'=>$_GPC['title'],
					'teamid'=>$_GPC['teamid'],
                    'content' => ihtmlspecialchars($_GPC['content']),
					'sort'=>$_GPC['sort'],
					'thumb'=>$_GPC['thumb'],
					'isrecommand'=>$_GPC['isrecommand'],
                    'createtime' => TIMESTAMP,
                );
               
                if (!empty($id)) {
                    unset($data['createtime']);
                    pdo_update('weixinmao_house_case', $data, array('id' => $id));
                } else {
                    pdo_insert('weixinmao_house_case', $data);
                    $id = pdo_insertid();
                }
                message('更新成功！', $this->createWebUrl('case', array('op' => 'display')), 'success');
            }
			
			
			
			
		} elseif ($operation == 'display') {
			
		//	echo $_GPC['keyword'];
			$pindex = max(1, intval($_GPC['page']));
			$psize = 15;
			$condition = ' WHERE `uniacid` = :uniacid ';
			$params = array(':uniacid' => $_W['uniacid']);
			
			if (!empty($_GPC['keyword'])) {
				$condition .= ' AND `title` LIKE :title';
				$params[':title'] = '%' . trim($_GPC['keyword']) . '%';
			}
			
			
			$sql = 'SELECT COUNT(*) FROM ' . tablename('weixinmao_house_case') .$condition ;
		//	echo $sql;
			
			$total = pdo_fetchcolumn($sql, $params);
			
			if (!empty($total)) {
				$sql = 'SELECT * FROM  ' . tablename('weixinmao_house_case') .$condition.' ORDER BY  `sort`  DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
				$list = pdo_fetchall($sql, $params);
				foreach($list as $k=>$v)
						{
							$house_info = pdo_fetch("SELECT housename  FROM " . tablename('weixinmao_house_houseinfo') . " WHERE id = :id", array(':id' => $v['teamid']));

							$list[$k]['housetitle'] = $house_info['housename'];
						}
				$pager = pagination($total, $pindex, $psize);
			}

			
			
		} elseif ($operation == 'delete') {
			$id = intval($_GPC['id']);
			$row = pdo_fetch("SELECT id FROM " . tablename('weixinmao_house_case') . " WHERE id = :id", array(':id' => $id));
			if (empty($row)) {
				message('抱歉，商品不存在或是已经被删除！');
			}

			pdo_delete('weixinmao_house_case', array('id' => $id));
			message('删除成功！', referer(), 'success');
		}
		include $this->template('case');
		
	}
	
	
	
	public function doWebhouse() {
		//这个操作被定义用来呈现 管理中心导航菜单
		global $_GPC, $_W;
		load()->func('tpl');
		
		
		$sql = 'SELECT * FROM ' . tablename('weixinmao_house_houseinfo') . ' WHERE `uniacid` = :uniacid ORDER BY `sort` DESC';
		
		$teamlist = pdo_fetchall($sql, array(':uniacid' => $_W['uniacid']));
	
		
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		if ($operation == 'post') {
			
			$id = $_GPC['id'];
	
			 if (!empty($id)) {
				 
				 		$item = pdo_fetch("SELECT *  FROM " . tablename('weixinmao_house_house') . " WHERE id = :id", array(':id' => $id));
						
			}
			
		
			if (checksubmit('submit')) {
				//print_r($_GPC);
				//exit;
                $data = array(
                    'uniacid' => $_W['uniacid'],
					'title'=>$_GPC['title'],
					'teamid'=>$_GPC['teamid'],
                    'content' => ihtmlspecialchars($_GPC['content']),
					'sort'=>$_GPC['sort'],
					'thumb'=>$_GPC['thumb'],
					'isrecommand'=>$_GPC['isrecommand'],
                    'createtime' => TIMESTAMP,
                );
               
                if (!empty($id)) {
                    unset($data['createtime']);
                    pdo_update('weixinmao_house_house', $data, array('id' => $id));
                } else {
                    pdo_insert('weixinmao_house_house', $data);
                    $id = pdo_insertid();
                }
                message('更新成功！', $this->createWebUrl('house', array('op' => 'display')), 'success');
            }
			
			
			
			
		} elseif ($operation == 'display') {
			
		
			$pindex = max(1, intval($_GPC['page']));
			$psize = 15;
			$condition = ' WHERE `uniacid` = :uniacid ';
			$params = array(':uniacid' => $_W['uniacid']);
			
			if (!empty($_GPC['keyword'])) {
				$condition .= ' AND `title` LIKE :title';
				$params[':title'] = '%' . trim($_GPC['keyword']) . '%';
			}
		
			
			$sql = 'SELECT COUNT(*) FROM ' . tablename('weixinmao_house_house') .$condition ;
		
			
			$total = pdo_fetchcolumn($sql, $params);
			
			if (!empty($total)) {
				$sql = 'SELECT * FROM  ' . tablename('weixinmao_house_house') .$condition.' ORDER BY  `sort`  DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
				$list = pdo_fetchall($sql, $params);
				foreach($list as $k=>$v)
						{
							$house_info = pdo_fetch("SELECT housename  FROM " . tablename('weixinmao_house_houseinfo') . " WHERE id = :id", array(':id' => $v['teamid']));

							$list[$k]['housetitle'] = $house_info['housename'];
						}
				$pager = pagination($total, $pindex, $psize);
			}

			
			
		} elseif ($operation == 'delete') {
			$id = intval($_GPC['id']);
			$row = pdo_fetch("SELECT id FROM " . tablename('weixinmao_house_house') . " WHERE id = :id", array(':id' => $id));
			if (empty($row)) {
				message('抱歉，商品不存在或是已经被删除！');
			}

			pdo_delete('weixinmao_house_house', array('id' => $id));

			message('删除成功！', referer(), 'success');
		} 
		include $this->template('house');
		
	}
	
	
	
	
	
	
	
	
	public function doWebAdv() {
		global $_W, $_GPC;
			load()->func('tpl');
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		if ($operation == 'display') {
			$list = pdo_fetchall("SELECT * FROM " . tablename('weixinmao_house_adv') . " WHERE weid = '{$_W['uniacid']}' ORDER BY displayorder DESC");
		} elseif ($operation == 'post') {
			$id = intval($_GPC['id']);
			if (checksubmit('submit')) {
				$data = array(
					'weid' => $_W['uniacid'],
					'advname' => $_GPC['advname'],
					'link' => $_GPC['link'],
					'enabled' => intval($_GPC['enabled']),
					'displayorder' => intval($_GPC['displayorder']),
					'thumb'=>$_GPC['thumb']
				);
				if (!empty($id)) {
					pdo_update('weixinmao_house_adv', $data, array('id' => $id));
				} else {
					pdo_insert('weixinmao_house_adv', $data);
					$id = pdo_insertid();
				}
				message('更新幻灯片成功！', $this->createWebUrl('adv', array('op' => 'display')), 'success');
			}
			$adv = pdo_fetch("select * from " . tablename('weixinmao_house_adv') . " where id=:id and weid=:weid limit 1", array(":id" => $id, ":weid" => $_W['uniacid']));
		} elseif ($operation == 'delete') {
			$id = intval($_GPC['id']);
			$adv = pdo_fetch("SELECT id FROM " . tablename('weixinmao_house_adv') . " WHERE id = '$id' AND weid=" . $_W['uniacid'] . "");
			if (empty($adv)) {
				message('抱歉，幻灯片不存在或是已经被删除！', $this->createWebUrl('adv', array('op' => 'display')), 'error');
			}
			pdo_delete('weixinmao_house_adv', array('id' => $id));
			message('幻灯片删除成功！', $this->createWebUrl('adv', array('op' => 'display')), 'success');
		} else {
			message('请求方式不存在');
		}
		include $this->template('adv', TEMPLATE_INCLUDEPATH, true);
	}
	
	public function doWebMessage() {
		global $_W, $_GPC;
			load()->func('tpl');
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		if ($operation == 'display') {
			$list = pdo_fetchall("SELECT * FROM " . tablename('weixinmao_house_message') . " WHERE uniacid = '{$_W['uniacid']}' ORDER BY createtime DESC");
		} elseif ($operation == 'post') {
			$id = intval($_GPC['id']);
			if (checksubmit('submit')) {
				$data = array(
					'uniacid' => $_W['uniacid'],
					'name' => $_GPC['name'],
					'tel' => $_GPC['tel'],
					'companyname' => $_GPC['companyname'],
					'createtime' => TIMESTAMP
					);
				if (!empty($id)) {
					pdo_update('weixinmao_house_message', $data, array('id' => $id));
				} else {
					pdo_insert('weixinmao_house_message', $data);
					$id = pdo_insertid();
				}
				message('更新幻灯片成功！', $this->createWebUrl('message', array('op' => 'display')), 'success');
			}
			$adv = pdo_fetch("select * from " . tablename('weixinmao_house_message') . " where id=:id and uniacid=:uniacid limit 1", array(":id" => $id, ":uniacid" => $_W['uniacid']));
		} elseif ($operation == 'delete') {
			$id = intval($_GPC['id']);
			$adv = pdo_fetch("SELECT id FROM " . tablename('weixinmao_house_message') . " WHERE id = '$id' AND uniacid=" . $_W['uniacid'] . "");
			if (empty($adv)) {
				message('抱歉，不存在或是已经被删除！', $this->createWebUrl('message', array('op' => 'display')), 'error');
			}
			pdo_delete('weixinmao_house_message', array('id' => $id));
			message('删除成功！', $this->createWebUrl('message', array('op' => 'display')), 'success');
		} else {
			message('请求方式不存在');
		}
		include $this->template('message', TEMPLATE_INCLUDEPATH, true);
	}
	
	
	
	public function doWebArea() {
		global $_W, $_GPC;
			load()->func('tpl');
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		if ($operation == 'display') {
			$list = pdo_fetchall("SELECT * FROM " . tablename('weixinmao_house_area') . " WHERE uniacid = '{$_W['uniacid']}' ORDER BY sort DESC");
		} elseif ($operation == 'post') {
			$id = intval($_GPC['id']);
			if (checksubmit('submit')) {
				$data = array(
					'uniacid' => $_W['uniacid'],
					'name' => $_GPC['name'],
					'sort' => $_GPC['sort'],
					'enabled'=>1
					);
					
				if (!empty($id)) {
					pdo_update('weixinmao_house_area', $data, array('id' => $id));
				} else {
					pdo_insert('weixinmao_house_area', $data);
					$id = pdo_insertid();
				}
				message('更新区域成功！', $this->createWebUrl('area', array('op' => 'display')), 'success');
			}
			$area = pdo_fetch("select * from " . tablename('weixinmao_house_area') . " where id=:id and uniacid=:uniacid limit 1", array(":id" => $id, ":uniacid" => $_W['uniacid']));
		} elseif ($operation == 'delete') {
			$id = intval($_GPC['id']);
			$area = pdo_fetch("SELECT id FROM " . tablename('weixinmao_house_area') . " WHERE id = '$id' AND uniacid=" . $_W['uniacid'] . "");
			if (empty($area)) {
				message('抱歉，不存在或是已经被删除！', $this->createWebUrl('area', array('op' => 'display')), 'error');
			}
			pdo_delete('weixinmao_house_area', array('id' => $id));
			message('删除成功！', $this->createWebUrl('area', array('op' => 'display')), 'success');
		} else {
			message('请求方式不存在');
		}
		include $this->template('area', TEMPLATE_INCLUDEPATH, true);
	}
	
	
	
	public function doWebOldhouseprice() {
		global $_W, $_GPC;
			load()->func('tpl');
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		if ($operation == 'display') {
			$list = pdo_fetchall("SELECT * FROM " . tablename('weixinmao_house_oldhouseprice') . " WHERE uniacid = '{$_W['uniacid']}' ORDER BY sort DESC");
		} elseif ($operation == 'post') {
			$id = intval($_GPC['id']);
		
			if (checksubmit('submit')) {
				$data = array(
					'uniacid' => $_W['uniacid'],
					'name' => $_GPC['name'],
				    'beginprice'=>$_GPC['beginprice'],
					'endprice'=>$_GPC['endprice'],
					'sort' => $_GPC['sort'],
					'enabled'=>1
					);
				if (!empty($id)) {
					pdo_update('weixinmao_house_oldhouseprice', $data, array('id' => $id));
				} else {
					pdo_insert('weixinmao_house_oldhouseprice', $data);
					$id = pdo_insertid();
				}
				message('更新区域成功！', $this->createWebUrl('oldhouseprice', array('op' => 'display')), 'success');
			}

			$oldhouseprice = pdo_fetch("select * from " . tablename('weixinmao_house_oldhouseprice') . " where id=:id and uniacid=:uniacid limit 1", array(":id" => $id, ":uniacid" => $_W['uniacid']));
		} elseif ($operation == 'delete') {
			$id = intval($_GPC['id']);
			$oldhouseprice = pdo_fetch("SELECT id FROM " . tablename('weixinmao_house_oldhouseprice') . " WHERE id = '$id' AND uniacid=" . $_W['uniacid'] . "");
			if (empty($oldhouseprice)) {
				message('抱歉，不存在或是已经被删除！', $this->createWebUrl('oldhouseprice', array('op' => 'display')), 'error');
			}
			pdo_delete('weixinmao_house_oldhouseprice', array('id' => $id));
			message('删除成功！', $this->createWebUrl('oldhouseprice', array('op' => 'display')), 'success');
		} else {
			message('请求方式不存在');
		}
		include $this->template('oldhouseprice', TEMPLATE_INCLUDEPATH, true);
	}

	
	
	
		public function doWebLethouseprice() {
		global $_W, $_GPC;
	    load()->func('tpl');
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		if ($operation == 'display') {
			$list = pdo_fetchall("SELECT * FROM " . tablename('weixinmao_house_lethouseprice') . " WHERE uniacid = '{$_W['uniacid']}' ORDER BY sort DESC");
		} elseif ($operation == 'post') {
			$id = intval($_GPC['id']);
		
			if (checksubmit('submit')) {
				$data = array(
					'uniacid' => $_W['uniacid'],
					'name' => $_GPC['name'],
				    'beginprice'=>$_GPC['beginprice'],
					'endprice'=>$_GPC['endprice'],
					'sort' => $_GPC['sort'],
					'enabled'=>1
					);
				if (!empty($id)) {
					pdo_update('weixinmao_house_lethouseprice', $data, array('id' => $id));
				} else {
					pdo_insert('weixinmao_house_lethouseprice', $data);
					$id = pdo_insertid();
				}
				message('更新区域成功！', $this->createWebUrl('lethouseprice', array('op' => 'display')), 'success');
			}

			$lethouseprice = pdo_fetch("select * from " . tablename('weixinmao_house_lethouseprice') . " where id=:id and uniacid=:uniacid limit 1", array(":id" => $id, ":uniacid" => $_W['uniacid']));
			
		} elseif ($operation == 'delete') {
			$id = intval($_GPC['id']);
			$oldhouseprice = pdo_fetch("SELECT id FROM " . tablename('weixinmao_house_lethouseprice') . " WHERE id = '$id' AND uniacid=" . $_W['uniacid'] . "");
			if (empty($oldhouseprice)) {
				message('抱歉，不存在或是已经被删除！', $this->createWebUrl('lethouseprice', array('op' => 'display')), 'error');
			}
			pdo_delete('weixinmao_house_oldhouseprice', array('id' => $id));
			message('删除成功！', $this->createWebUrl('lethouseprice', array('op' => 'display')), 'success');
		} else {
			message('请求方式不存在');
		}
		include $this->template('lethouseprice', TEMPLATE_INCLUDEPATH, true);
	}
	
	
	
	
public function doWebToplist() {
		global $_W, $_GPC;
	    load()->func('tpl');
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		if ($operation == 'display') {
			$list = pdo_fetchall("SELECT * FROM " . tablename('weixinmao_house_toplist') . " WHERE uniacid = '{$_W['uniacid']}' ORDER BY sort DESC");
		} elseif ($operation == 'post') {
			$id = intval($_GPC['id']);
		
			if (checksubmit('submit')) {
				$data = array(
					'uniacid' => $_W['uniacid'],
					'money' => $_GPC['money'],
				    'days'=>$_GPC['days'],
					'sort' => $_GPC['sort'],
					'enabled'=>1
					);
				if (!empty($id)) {
					pdo_update('weixinmao_house_toplist', $data, array('id' => $id));
				} else {
					pdo_insert('weixinmao_house_toplist', $data);
					$id = pdo_insertid();
				}
				message('更新区域成功！', $this->createWebUrl('toplist', array('op' => 'display')), 'success');
			}

			$toplist = pdo_fetch("select * from " . tablename('weixinmao_house_toplist') . " where id=:id and uniacid=:uniacid limit 1", array(":id" => $id, ":uniacid" => $_W['uniacid']));
			
		} elseif ($operation == 'delete') {
			$id = intval($_GPC['id']);
			$oldhouseprice = pdo_fetch("SELECT id FROM " . tablename('weixinmao_house_toplist') . " WHERE id = '$id' AND uniacid=" . $_W['uniacid'] . "");
			if (empty($oldhouseprice)) {
				message('抱歉，不存在或是已经被删除！', $this->createWebUrl('toplist', array('op' => 'display')), 'error');
			}
			pdo_delete('weixinmao_house_toplist', array('id' => $id));
			message('删除成功！', $this->createWebUrl('toplist', array('op' => 'display')), 'success');
		} else {
			message('请求方式不存在');
		}
		include $this->template('toplist', TEMPLATE_INCLUDEPATH, true);
	}
	
	
	
	
	public function doWebHouseprice() {
		global $_W, $_GPC;
			load()->func('tpl');
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		if ($operation == 'display') {
			$list = pdo_fetchall("SELECT * FROM " . tablename('weixinmao_house_houseprice') . " WHERE uniacid = '{$_W['uniacid']}' ORDER BY sort DESC");
		} elseif ($operation == 'post') {
			$id = intval($_GPC['id']);
		
			if (checksubmit('submit')) {
				$data = array(
					'uniacid' => $_W['uniacid'],
					'name' => $_GPC['name'],
				    'beginprice'=>$_GPC['beginprice'],
					'endprice'=>$_GPC['endprice'],
					'sort' => $_GPC['sort'],
					'enabled'=>1
					);
				if (!empty($id)) {
					pdo_update('weixinmao_house_houseprice', $data, array('id' => $id));
				} else {
					pdo_insert('weixinmao_house_houseprice', $data);
					$id = pdo_insertid();
				}
				message('更新区域成功！', $this->createWebUrl('houseprice', array('op' => 'display')), 'success');
			}

			$houseprice = pdo_fetch("select * from " . tablename('weixinmao_house_houseprice') . " where id=:id and uniacid=:uniacid limit 1", array(":id" => $id, ":uniacid" => $_W['uniacid']));
		} elseif ($operation == 'delete') {
			$id = intval($_GPC['id']);
			$oldhouseprice = pdo_fetch("SELECT id FROM " . tablename('weixinmao_house_houseprice') . " WHERE id = '$id' AND uniacid=" . $_W['uniacid'] . "");
			if (empty($oldhouseprice)) {
				message('抱歉，不存在或是已经被删除！', $this->createWebUrl('houseprice', array('op' => 'display')), 'error');
			}
			pdo_delete('weixinmao_house_houseprice', array('id' => $id));
			message('删除成功！', $this->createWebUrl('houseprice', array('op' => 'display')), 'success');
		} else {
			message('请求方式不存在');
		}
		include $this->template('houseprice', TEMPLATE_INCLUDEPATH, true);
	}
	
	public function doWebAgent() {
		global $_W, $_GPC;
			load()->func('tpl');
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		if ($operation == 'display') {
			
			
				$pindex = max(1, intval($_GPC['page']));
			$psize = 15;
			$condition = ' WHERE `uniacid` = :uniacid ';
			$params = array(':uniacid' => $_W['uniacid']);
			
			if (!empty($_GPC['keyword'])) {
				$condition .= ' AND `title` LIKE :title';
				$params[':title'] = '%' . trim($_GPC['keyword']) . '%';
			}
		
			
			$sql = 'SELECT COUNT(*) FROM ' . tablename('weixinmao_house_agent') .$condition ;
		
			
			$total = pdo_fetchcolumn($sql, $params);
			
			if (!empty($total)) {
				$sql = 'SELECT * FROM  ' . tablename('weixinmao_house_agent') .$condition.' ORDER BY  `sort`  DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
				$list = pdo_fetchall($sql, $params);
				foreach($list as $k=>$v)
						{

							$list[$k]['housetitle'] = $house_info['housename'];
						}
				$pager = pagination($total, $pindex, $psize);
			}
			
			
			
			
			
		} elseif ($operation == 'post') {
			$id = intval($_GPC['id']);
		
			if (checksubmit('submit')) {
				$data = array(
					'uniacid' => $_W['uniacid'],
					'name' => $_GPC['name'],
				    'thumb'=>$_GPC['thumb'],
					'tel'=>$_GPC['tel'],
					'qq' => $_GPC['qq'],
					'address' => $_GPC['address'],
					'intro' => $_GPC['intro'],
					'content' => ihtmlspecialchars($_GPC['content']),
					'enabled'=> $_GPC['enabled'],
					'sort'=>$_GPC['sort'],
					'createtime' => TIMESTAMP
					);
				if (!empty($id)) {
					pdo_update('weixinmao_house_agent', $data, array('id' => $id));
				} else {
					pdo_insert('weixinmao_house_agent', $data);
					$id = pdo_insertid();
				}
				message('更新区域成功！', $this->createWebUrl('agent', array('op' => 'display')), 'success');
			}

			$agent = pdo_fetch("select * from " . tablename('weixinmao_house_agent') . " where id=:id and uniacid=:uniacid limit 1", array(":id" => $id, ":uniacid" => $_W['uniacid']));
		} elseif ($operation == 'delete') {
			$id = intval($_GPC['id']);
			$oldhouseprice = pdo_fetch("SELECT id FROM " . tablename('weixinmao_house_agent') . " WHERE id = '$id' AND uniacid=" . $_W['uniacid'] . "");
			if (empty($oldhouseprice)) {
				message('抱歉，不存在或是已经被删除！', $this->createWebUrl('agent', array('op' => 'display')), 'error');
			}
			pdo_delete('weixinmao_house_agent', array('id' => $id));
			message('删除成功！', $this->createWebUrl('agent', array('op' => 'display')), 'success');
		} else {
			message('请求方式不存在');
		}
		include $this->template('agent', TEMPLATE_INCLUDEPATH, true);
	}
	

	
	public function doWebActive() {
		//这个操作被定义用来呈现 管理中心导航菜单
		global $_GPC, $_W;
		load()->func('tpl');

	
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		if ($operation == 'post') {
			
			$id = $_GPC['id'];
	
			 if (!empty($id)) {
				 $item = pdo_fetch("SELECT *  FROM " . tablename('weixinmao_house_active') . " WHERE id = :id", array(':id' => $id));		
			}
		    $newhouselist = pdo_fetchall("SELECT id,housename  FROM " . tablename('weixinmao_house_houseinfo') . " WHERE uniacid = :uniacid", array(':uniacid' => $_W['uniacid']));		
			
			if (checksubmit('submit')) {
				if(is_array($_GPC['thumbs'])){
					$thumb_data['thumb_url'] = serialize($_GPC['thumbs']);
				}
                $data = array(
                    'uniacid' => $_W['uniacid'],
					'title'=>$_GPC['title'],
                    'content' => ihtmlspecialchars($_GPC['content']),
					'sort'=>$_GPC['sort'],
					'thumb'=>$_GPC['thumb'],
                    'createtime' => TIMESTAMP,
					'money'=>$_GPC['money'],
					'pid'=>$_GPC['pid']
                );
               
                if (!empty($id)) {
                    unset($data['createtime']);
                    pdo_update('weixinmao_house_active', $data, array('id' => $id));
                } else {
                    pdo_insert('weixinmao_house_active', $data);
                    $id = pdo_insertid();
                }
                message('更新成功！', $this->createWebUrl('active', array('op' => 'display')), 'success');
            }
			
			
			
			
		} elseif ($operation == 'display') {
			
		
			$pindex = max(1, intval($_GPC['page']));
			$psize = 15;
			$condition = ' WHERE `uniacid` = :uniacid ';
			$params = array(':uniacid' => $_W['uniacid']);
			
			if (!empty($_GPC['keyword'])) {
				$condition .= ' AND `title` LIKE :title';
				$params[':title'] = '%' . trim($_GPC['keyword']) . '%';
			}
			
			
			$sql = 'SELECT COUNT(*) FROM ' . tablename('weixinmao_house_active') .$condition ;

			$total = pdo_fetchcolumn($sql, $params);
			
			if (!empty($total)) {
				$sql = 'SELECT * FROM  ' . tablename('weixinmao_house_active') .$condition.' ORDER BY  `sort`  DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
				$list = pdo_fetchall($sql, $params);
				$pager = pagination($total, $pindex, $psize);
			}
			
			
			
		}elseif($operation == 'baoming'){
			
			
			
			$pindex = max(1, intval($_GPC['page']));
			$psize = 15;
			$condition = ' WHERE b.uniacid = :uniacid ';
			$params = array(':uniacid' => $_W['uniacid']);
			
			if (!empty($_GPC['keyword'])) {
				$condition .= ' AND a.title LIKE :title';
				$params[':title'] = '%' . trim($_GPC['keyword']) . '%';
			}
			
			
			$sqlcount = 'SELECT  COUNT(*)  ';
		
			
			
			$sql = " FROM " . tablename('weixinmao_house_baoming') . " AS b ";
			
			$sql .= "  LEFT JOIN  " . tablename('weixinmao_house_houseinfo') . " as h ON h.id = b.pid ";
			
			$sql .= "  LEFT JOIN  " . tablename('weixinmao_house_active') . " as a ON a.id = b.aid ";
			
			//$sql .= " WHERE r.paperid = :paperid AND r.weid = :weid AND m.weid = :weid AND did = 1";
			$total = pdo_fetchcolumn($sqlcount.$sql.$condition, $params);
			
			if (!empty($total)) {
				
				
				
				$sqlall = 'SELECT b.createtime AS createtime,  b.name as name, b.tel as tel,h.housename AS housename,a.title AS title ,b.id AS id' . $sql .$condition.' ORDER BY  b.createtime  DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
				
				
				$list = pdo_fetchall($sqlall, $params);
			
				$pager = pagination($total, $pindex, $psize);
			}
			
			
			
		} elseif ($operation == 'delete') {
			$id = intval($_GPC['id']);
			$row = pdo_fetch("SELECT id FROM " . tablename('weixinmao_house_active') . " WHERE id = :id", array(':id' => $id));
			if (empty($row)) {
				message('抱歉，商品不存在或是已经被删除！');
			}
			pdo_delete('weixinmao_house_active', array('id' => $id));

			message('删除成功！', referer(), 'success');
		}elseif ($operation == 'deleteactive'){
			
			$id = intval($_GPC['id']);
			$row = pdo_fetch("SELECT id FROM " . tablename('weixinmao_house_baoming') . " WHERE id = :id", array(':id' => $id));
			if (empty($row)) {
				message('抱歉，商品不存在或是已经被删除！');
			}
			pdo_delete('weixinmao_house_baoming', array('id' => $id));

			message('删除成功！', referer(), 'success');
			
		}
		include $this->template('active');
		
	}
	
	    public function doWebOrder()
	{
		global $_GPC, $_W;
		load()->func('tpl');
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		
		if ($operation == 'post') {
			$id = $_GPC['id'];
			if (!empty($id)) {
				 $item = pdo_fetch("SELECT *  FROM " . tablename('weixinmao_house_order') . " WHERE id = :id", array(':id' => $id));			
			}
			if (checksubmit('submit')) {
				//print_r($_GPC);
				//exit;
                $data = array(
                    'uniacid' => $_W['uniacid'],
					'title'=>$_GPC['title'],
                    'content' => htmlspecialchars_decode($_GPC['content']),
					'sort'=>$_GPC['sort'],
					'thumb'=>$_GPC['thumb'],
                    'createtime' => TIMESTAMP,
                );
                if (!empty($id)) {
                    unset($data['createtime']);
                    pdo_update('weixinmao_house_order', $data, array('id' => $id));
                } else {
                    pdo_insert('weixinmao_house_order', $data);
                    $id = pdo_insertid();
                }
                message('更新成功！', $this->createWebUrl('order', array('op' => 'display')), 'success');
            }
		} elseif($operation == 'done'){
			
			$id = intval($_GPC['id']);
			$row = pdo_fetch("SELECT id FROM " . tablename('weixinmao_house_order') . " WHERE id = :id", array(':id' => $id));
			if (empty($row)) {
				message('抱歉，订单不存在或是已经被删除！');
			}
			 pdo_update('weixinmao_house_order', array('status'=>2), array('id' => $id));

			message('操作成功！', referer(), 'success');
			
		
		}elseif ($operation == 'display') {
			$status = $_GPC['status'];
			if(!isset($status))
					$status = -1;
			$pindex = max(1, intval($_GPC['page']));
			$psize = 15;
			$condition = ' WHERE `uniacid` = :uniacid ';
			$params = array(':uniacid' => $_W['uniacid']);
			
			if (!empty($_GPC['member'])) {
				$condition .= ' AND `tel` LIKE :title';
				$params[':title'] = '%' . trim($_GPC['member']) . '%';
			}
			if($status ==0)
			{
				$condition .= ' AND `paid` = 0 ';
			}elseif($status ==1)
			{
					$condition .= ' AND `paid` = 1 AND status =1 ';
			}elseif($status == 2){
				
				$condition .= ' AND `paid` = 1 AND status =2 ';
			}elseif($status ==3){
				
				$condition .= ' AND `paid` = 1 AND status =3 ';
			}
			
			$sql = 'SELECT COUNT(*) FROM ' . tablename('weixinmao_house_order') .$condition ;

			$total = pdo_fetchcolumn($sql, $params);
			
			if (!empty($total)) {
				$sql = 'SELECT * FROM  ' . tablename('weixinmao_house_order') .$condition.' ORDER BY  `createtime`  DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
				$list = pdo_fetchall($sql, $params);
				$pager = pagination($total, $pindex, $psize);
				if($list)
				{
						foreach($list as $k=>$v)
						{
							if($v['couponid']>0)
							{
								$coupon_order = pdo_fetch("SELECT title FROM " . tablename('weixinmao_house_order') . " WHERE id = :id", array(':id' => $v['couponid']));
								//print_r($coupon_order);
								$list[$k]['coupon'] = $coupon_order['title'];
							}else{
								
								$list[$k]['coupon'] = '';
							}
						}
					
				}
				
			}
			
		} elseif ($operation == 'delete') {
			$id = intval($_GPC['id']);
			$row = pdo_fetch("SELECT id FROM " . tablename('weixinmao_house_order') . " WHERE id = :id", array(':id' => $id));
			if (empty($row)) {
				message('抱歉，订单不存在或是已经被删除！');
			}
			pdo_delete('weixinmao_house_order', array('id' => $id));
			message('删除成功！', referer(), 'success');
		}
		include $this->template('order');
		
	}
	
	
	
	

}