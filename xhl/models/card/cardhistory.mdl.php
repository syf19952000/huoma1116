<?php
/**
 * Copy Right 16-expo.com
 * 人要活得优雅,代码更需要优雅
 * $Id: member.mdl.php 2015-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
	exit("Access Denied");
}

class Mdl_Card_Cardhistory extends Mdl_Table
{
	protected $_table = 'ims_amouse_wxapp_card_history';
	protected $_pk = 'id';
	public function create($data, $checked=false)
	{
		$data['createtime'] = time();
		$fanid = $this->db->insert($this->_table, $data, true);

		return $fanid;
	}



}