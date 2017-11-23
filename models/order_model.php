<?php
/**
* Menu Model class
*/
class order_model extends MY_Model
{
    protected $_table_name = 'orders';
    protected $_primary_key = 'ord_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'ord_id';
    protected $_timestamps = FALSE;

    function __construct()
    {
        parent::__construct();
    }

    public function orders()
    {
        $this->_table_name = 'orders';
        $this->_primary_key = 'ord_id';
        $this->_order_by = 'ord_id';
    }

    public function customers()
    {
        $this->_table_name = 'customers';
        $this->_primary_key = 'cus_id';
        $this->_order_by = 'cus_id';
    }

    public function base_menus()
    {
        $this->_table_name = 'base_menus';
        $this->_primary_key = 'bm_id';
        $this->_order_by = 'bm_id';
    }

<<<<<<< HEAD
    public function accounts()
    {
        $this->_table_name = 'accounts';
        $this->_primary_key = 'acc_id';
        $this->_order_by = 'acc_id';
    }

    public function transections()
    {
        $this->_table_name = 'transections';
        $this->_primary_key = 'tr_id';
        $this->_order_by = 'tr_id';
=======
    public function menu_category()
    {
        $this->_table_name = 'menu_category';
        $this->_primary_key = 'mc_id';
        $this->_order_by = 'mc_id';
>>>>>>> master
    }

    public function order_join_sub_order()
    {
        $this->db->from('sub_menus');
        $this->db->join('base_menus', 'base_menus.bm_id = sub_menus.sm_bm_id');
        $this->db->where(['bm_type'=>0]);
        $query = $this->db->get();
        return $query->result();
    }



}
