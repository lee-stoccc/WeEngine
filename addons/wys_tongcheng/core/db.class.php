<?php
/**
 * 数据库操作类
 */
class DBUtil {

const wys_tongcheng_mtype = 'wys_tongcheng_mtype';
const wys_tongcheng_msg = 'wys_tongcheng_msg';
const wys_tongcheng_msg_imgs = 'wys_tongcheng_msg_imgs';
const wys_tongcheng_msg_placed_top_record = 'wys_tongcheng_msg_placed_top_record';
const wys_tongcheng_comments = 'wys_tongcheng_comments';
const wys_tongcheng_goods = 'wys_tongcheng_goods';
const wys_tongcheng_jubao = 'wys_tongcheng_jubao';
const wys_tongcheng_user = 'wys_tongcheng_user';
const wys_tongcheng_banner = 'wys_tongcheng_banner';
const wys_tongcheng_salebanner = 'wys_tongcheng_salebanner';

  
	//总数
	public function getCount($table, $where, $params) {
		return pdo_fetchcolumn('SELECT COUNT(*) AS `number` FROM ' . tablename($table) . ' WHERE ' . $where, $params);
	}
	//列表
	public function getMany($table, $where, $params, $order = '', $page = 1, $pagesize = 0, $op = 'AND') {
		$sql = 'SELECT * FROM ' . tablename($table) . ' WHERE ' . $where;
		if (!empty($order)) {
			$sql .= ' ORDER BY ' . $order;
		}
		if (!empty($pagesize)) {
			$sql .= ' LIMIT ' . ($page - 1) * $pagesize . ',' . $pagesize;
		}
		return pdo_fetchall($sql, $params, $op);
	}
	//单个
	public function getOne($table, $where, $params, $op = 'AND') {
		return pdo_fetch('SELECT * FROM ' . tablename($table) . ' WHERE ' . $where, $params, $op);
	}
	//修改
	public function update($table, $data, $params, $op = 'AND') {
		return pdo_update($table, $data, $params, $op);
	}
	//新增
	public function save($table, $data) {
		return pdo_insert($table, $data);
	}
	//删除
	public function delete($table, $params, $op = 'AND') {
		return pdo_delete($table, $params, $op);
	}
}
?>