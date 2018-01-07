<?php
/**
* Employee Model class
*/
class setting_model extends MY_Model
{
    public $_table_name = 'units';
    public $_primary_key = 'unit_id';
    public $_primary_filter = 'intval';
    public $_order_by = 'unit_id';
    public $_timestamps = FALSE;

    function __construct()
    {
        parent::__construct();
    }

    public function stock_units()
    {
        $this->_table_name = 'stock_units';
        $this->_primary_key = 'st_id';
        $this->_order_by = 'st_id';
    }

    public function jobs()
    {
        $this->_table_name = 'jobs';
        $this->_primary_key = 'job_id';
        $this->_order_by = 'job_id';
    }

     public function units()
    {
        $this->_table_name = 'units';
        $this->_primary_key = 'unit_id';
        $this->_order_by = 'unit_id';
    }

    public function menu_category()
    {
        $this->_table_name = 'menu_category';
        $this->_primary_key = 'mc_id';
        $this->_order_by = 'mc_id';
    }

    public function sub_menus()
    {
        $this->_table_name = 'sub_menus';
        $this->_primary_key = 'sm_id';
        $this->_order_by = 'sm_id';
    }

    public function base_menus()
    {
        $this->_table_name = 'base_menus';
        $this->_primary_key = 'bm_id';
        $this->_order_by = 'bm_id';
    }

    public function desks()
    {
        $this->_table_name = 'desks';
        $this->_primary_key = 'desk_id';
        $this->_order_by = 'desk_id';
    }

    public function discounts()
    {
        $this->_table_name = 'discounts';
        $this->_primary_key = 'disc_id';
        $this->_order_by = 'disc_id';
    }

    public function employees()
    {
        $this->_table_name = 'employees';
        $this->_primary_key = 'emp_id';
        $this->_order_by = 'emp_id';
    }

    public function partners()
    {
        $this->_table_name = 'partners';
        $this->_primary_key = 'part_id';
        $this->_order_by = 'part_id';
    }

    public function company_info()
    {
        $this->_table_name = 'company_info';
        $this->_primary_key = 'ci_id';
        $this->_order_by = 'ci_id';
    }

    public function partner_join_emp()
    {
        $this->db->from('partners');
        $this->db->join('employees', 'partners.part_emp_id = employees.emp_id');
        $query = $this->db->get()->result();
        return $query;
    }





}
