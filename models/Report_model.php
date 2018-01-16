<?php
/**
* Report Model class
*/
class report_model extends MY_Model
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

    public function salaries()
    {
        $this->_table_name = 'salaries';
        $this->_primary_key = 'sal_id';
        $this->_order_by = 'sal_id';
    }

    public function sal_join_trans_join_emp($firstYear,$lastYear)
    {
        $this->db->from('employees');
        $this->db->join('salary', 'employees.emp_id = salary.sal_emp_id');
        $this->db->where('sal_date <=', $firstYear);
        $this->db->where('sal_date >=', $lastYear);
        $query = $this->db->get()->result();
        return $query;
    }

    public function order_join_customer_by_date($ord_type, $fisrtDate = NULL, $lastDate = NULL)
    {
        $this->db->from('orders');
        $this->db->join('customers', 'customers.cus_id = orders.ord_cus_id');
        $this->db->join('desks', 'desks.desk_id = orders.ord_desk_id');
        $this->db->where(['ord_type' => $ord_type]);
        $this->db->where(['ord_date >=' => $fisrtDate]);
        $this->db->where(['ord_date <=' => $lastDate]);
        $this->db->order_by('ord_date DESC');
        $query = $this->db->get()->result();
        return $query;
    }

} // end class
