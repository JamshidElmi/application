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

    public function accounts()
    {
        $this->_table_name = 'accounts';
        $this->_primary_key = 'acc_id';
        $this->_order_by = 'acc_id';
    }

    public function expences()
    {
        $this->_table_name = 'daily_expences';
        $this->_primary_key = 'dex_id';
        $this->_order_by = 'dex_id';
    }

    public function get_join_expences($value='')
    {
        // $this->expences();

        $this->db->from('daily_expences');
        $this->db->join('units', 'daily_expences.dex_unit = units.unit_id');
        $query = $this->db->get();
        return $query->result();

    }

    public function units()
    {
        $this->_table_name = 'units';
        $this->_primary_key = 'unit_id';
        $this->_order_by = 'unit_id';
    }




}
