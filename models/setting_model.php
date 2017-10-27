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




}
