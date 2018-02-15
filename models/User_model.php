<?php

/**
 * User Model class
 */
class user_model extends MY_Model
{
    protected $_table_name = 'users';
    protected $_primary_key = 'user_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'user_id';
    protected $_timestamps = FALSE;

    function __construct()
    {
        parent::__construct();
    }

    public function get_employees()
    {
        $this->_table_name = 'employees';
        $this->_order_by = 'emp_id';
        return $users = $this->data_get();

    }

    public function employees($value='')
    {
        $this->_table_name = 'users';
        $thia->_primary_key = 'user_id';
        $thia->_order_by = 'user_id';
    }

    public function join_user_emp()
    {
        $this->db->from('users');
        $this->db->join('employees', 'users.emp_id = employees.emp_id');
        $query = $this->db->get()->result();
        return $query;
    }

    public function emp_join_partner($emp_id)
    {
        $this->db->from('partners');
        $this->db->join('employees', 'partners.part_emp_id = employees.emp_id');
        $this->db->where('part_emp_id', $emp_id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();
    }

    public function company_info()
    {
        $this->_table_name = 'company_info';
        $this->_primary_key = 'ci_id';
        $this->_order_by = 'ci_id';
    }


}
