<?php
/**
* Employee Model class
*/
class finance_model extends MY_Model
{
    protected $_table_name = 'accounts';
    protected $_primary_key = 'acc_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'acc_id';
    protected $_timestamps = FALSE;

    function __construct()
    {
        parent::__construct();
    }





}
