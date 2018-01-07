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

    public function accounts()
    {
        $this->_table_name = 'salaries';
        $this->_primary_key = 'sal_id';
        $this->_order_by = 'sal_id';
    }

    public function uniquee_id()
    {

    }



}
