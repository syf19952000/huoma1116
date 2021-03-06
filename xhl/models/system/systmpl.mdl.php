<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: systmpl.mdl.php 2016-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_System_Systmpl extends Mdl_Table
{   
  
    protected $_table = 'systmpl';
    protected $_pk = 'systmpl_id';
    protected $_cols = 'systmpl_id,is_open,title,intro,from,key,tmpl,tmpl1,tmpl2,dateline';

    protected $_pre_cache_key = 'system_systmpl_list';    
    
    public function create($data, $checked=false)
    {
        if(!$checked && !$data = $this->_check_schema($data)){
            return false;
        }
        return $this->db->insert($this->_table, $data, true);
    }

    public function update($pk, $data, $checked=false)
    {
        $this->_checkpk();
        if(!$checked && !$data = $this->_check_schema($data,  $pk)){
            return false;
        }
        return $this->db->update($this->_table, $data, $this->field($this->_pk, $pk));
    }
    
    public function load_systmpl()
    {
        $data = $this->fetch_all();
        $return = array();
        foreach($data as $v){
            $return[$v['key']] = $v;
        }
        return $return;
    }  
    
    public function detail_by_key($key)
    {
		$data = $this->load_systmpl();        
		return $data[$key];
    }

    protected function _format_row($row)
    {
        
        if($row['intro']){
            $row['config'] = unserialize($row['intro']);
        }else{
            $row['config'] = array();
        }
       
        return $row;
    }
}