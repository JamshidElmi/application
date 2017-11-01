<?php
/**
* Employee Model class
*/
class stock_model extends MY_Model
{
    public $_table_name = 'stocks';
    public $_primary_key = 'st_id';
    public $_primary_filter = 'intval';
    public $_order_by = 'st_id';
    public $_timestamps = FALSE;

    function __construct()
    {
        parent::__construct();
    }




}
