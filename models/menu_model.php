<?php
/**
* Employee Model class
*/
class menu_model extends MY_Model
{
    protected $_table_name = 'menu_category';
    protected $_primary_key = 'mc_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'mc_id';
    protected $_timestamps = FALSE;

    function __construct()
    {
        parent::__construct();
    }

    // public function join_user_emp($emp_id)
    // {
    //     $this->db->from('base_manus');
    //     $this->db->join('users', 'base_manus. = users.emp_id');
    //     $this->db->where(['emp_id'=>$emp_id]);
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    public function menu_category()
    {
        $this->_table_name = 'menu_category';
        $this->_primary_key = 'mc_id';
        $this->_order_by = 'mc_id';
    }

    public function base_menus()
    {
        $this->_table_name = 'base_menus';
        $this->_primary_key = 'bm_id';
        $this->_order_by = 'bm_id';
    }

    public function sub_menus()
    {
        $this->_table_name = 'sub_menus';
        $this->_primary_key = 'sm_id';
        $this->_order_by = 'sm_id';
    }

    public function base_join_sub_menus()
    {
        $this->db->from('base_menus');
        $this->db->join('sub_menus', 'base_menus.bm_id = sub_menus.sm_bm_id');
        $this->db->where(['bm_type'=> 0]);
        $query = $this->db->get();
        return $query->result();
    }


}
