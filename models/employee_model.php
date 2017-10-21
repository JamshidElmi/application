<?php
/**
* User Model class
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




}
