<?php
/**
* Employee Model class
*/
class employee_model extends MY_Model
{
    protected $_table_name = 'employees';
    protected $_primary_key = 'emp_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'emp_id';
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



}
