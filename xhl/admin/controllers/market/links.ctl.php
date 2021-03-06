<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: links.ctl.php 2016-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Market_Links extends Ctl
{
    
    public function index($page=1)
    {
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 50;
        if($SO = $this->GP('SO')){
            $pager['SO'] = $SO;            
        }
        $filter['closed'] = 0;
        
        if($items = K::M('market/links')->items($filter, null, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO'=>$SO));
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'admin:links/items.html';
    }

    public function so()
    {
        $this->tmpl = 'admin:links/so.html';
    }

    public function create()
    {
        if($this->checksubmit()){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else {
                   
			unset($data['city_ids']);
				if($link_id = K::M('market/links')->create($data)){
					$this->err->add('添加内容成功');
					$this->err->set_data('forward', '?market/links-index.html');         
				}

					         
            } 
        }else{
           $this->tmpl = 'admin:links/create.html';
        }
    }

    public function edit($link_id=null)
    {
        if(!($link_id = (int)$link_id) && !($link_id = $this->GP('link_id'))){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('market/links')->detail($link_id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }else if($this->checksubmit('data')){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else{
               if(K::M('market/links')->update($link_id,$data)){
                        $this->err->add('修改内容成功');
                        $this->err->set_data('forward', '?market/links-index.html'); 
                    }  
                } 
        }else{
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'admin:links/edit.html';
        }
    }

    public function delete($link_id=null)
    {
        if($link_id = (int)$link_id){
           if (!$detail = K::M('market/links')->detail($link_id)) {
                $this->err->add('您要修改的内容不存在或已经删除', 212);
            } else if(K::M('market/links')->delete($link_id)){
                $this->err->add('删除成功');
            }
        }else if($ids = $this->GP('link_id')){
             $status = true;
            foreach($ids as $id){
                $detail = K::M('market/links')->detail($id);
            }
            if ($status &&K::M('market/links')->delete($ids)){
                $this->err->add('批量删除成功');
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }

}