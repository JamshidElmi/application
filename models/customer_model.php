<?php
/**
* Employee Model class
*/
class customer_model extends MY_Model
{
    protected $_table_name = 'customers';
    protected $_primary_key = 'cus_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'cus_id';
    protected $_timestamps = FALSE;

    function __construct()
    {
        parent::__construct();
    }

    // public function join_user_emp($emp_id)
    // {
    //     $this->db->from('employees');
    //     $this->db->join('users', 'employees.emp_id = users.emp_id');
    //     $this->db->where(['emp_id'=>$emp_id]);
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    public function accounts()
    {
        $this->_table_name = 'accounts';
        $this->_primary_key = 'acc_id';
        $this->_order_by = 'acc_id';
    }



}
