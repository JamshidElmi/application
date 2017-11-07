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
        $this->_table_name = 'expences';
        $this->_primary_key = 'dex_id';
        $this->_order_by = 'dex_id';
    }

    public function get_join_expences($bill_id)
    {
        // $this->expences();

        $this->db->from('expences');
        $this->db->join('units', 'expences.dex_unit = units.unit_id');
        $this->db->where('dex_bill_id', $bill_id);
        $query = $this->db->get();
        return $query->result();

    }

    public function stocks_join_units()
    {
        // $this->expences();

        $this->db->from('stock_units');
        $this->db->join('units', 'stock_units.st_unit = units.unit_id');
        // $this->db->where('dex_bill_id', $bill_id);
        $query = $this->db->get();
        return $query->result();

    }

    public function units()
    {
        $this->_table_name = 'units';
        $this->_primary_key = 'unit_id';
        $this->_order_by = 'unit_id';
    }

    public function stocks()
    {
        $this->_table_name = 'stocks';
        $this->_primary_key = 'stock_id';
        $this->_order_by = 'stock_id';
    }

    public function stock_units()
    {
        $this->_table_name = 'stock_units';
        $this->_primary_key = 'st_id';
        $this->_order_by = 'st_id';
    }

    public function bills()
    {
        $this->_table_name = 'bills';
        $this->_primary_key = 'bill_id';
        $this->_order_by = 'bill_id';
    }

    public function employees()
    {
        $this->_table_name = 'employees';
        $this->_primary_key = 'emp_id';
        $this->_order_by = 'emp_id';
    }

    public function get_trans_dexs($acc_id)
    {
        $this->db->select_sum('tr_amount');
        $this->db->from('transections');
        $this->db->where(['tr_acc_id'=>$acc_id, 'tr_type' => 'daily_expence']);
        $query = $this->db->get();
        return $query->row()->tr_amount;
    }

    // public function dex_transection_delete($bill_id)
    // {
    //     $this->db->where(['bill_id'=> $bill_id, 'tr_type'=> 0]);
    //     if($this->db->delete('bills'))
    //     return true;
    // }

    public function dex_join_trans($bill_id)
    {
        $this->db->from('expences');
        $this->db->join('transections', 'expences.dex_tr_id = transections.tr_id');
        // $this->db->from('expences');
        $this->db->join('units', 'units.unit_id = expences.dex_unit');
        $this->db->where('bill_id', $bill_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function bill_join_trans($bill_type)
    {
        $this->db->from('transections');
        $this->db->join('bills', 'transections.bill_id = bills.bill_id');
        // $this->db->from('expences');
        // $this->db->join('units', 'units.unit_id = expences.dex_unit');
        $this->db->where('bill_type', $bill_type);
        $query = $this->db->get();
        return $query->result();
    }




}
