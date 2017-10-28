<?php
/**
* Employee Model class
*/
class finance_model extends MY_Model
{
    public $_table_name = 'accounts';
    public $_primary_key = 'acc_id';
    public $_primary_filter = 'intval';
    public $_order_by = 'acc_id';
    public $_timestamps = FALSE;

    function __construct()
    {
        parent::__construct();
    }

    public function transections()
    {
        $this->_table_name = 'transections';
        $this->_primary_key = 'tr_id';
        $this->_order_by = 'tr_id';
    }





}
