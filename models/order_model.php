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

    public function order_join_sub_order()
    {
        $this->db->from('base_menus');
        $this->db->join('sub_menus', 'base_menus.bm_id = sub_menus.sm_bm_id');
        $this->db->where(['bm_type'=>0]);
        $query = $this->db->get();
        return $query->result();
    }



}