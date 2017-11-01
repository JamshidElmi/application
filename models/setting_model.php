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



}
