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
        return $users = $this->data_get();

    }

    public function join_user_emp()
    {
        $this->db->from('users');
        $this->db->join('employees', 'users.emp_id = employees.emp_id');
        $query = $this->db->get();
        return $query->result();
    }



}
