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

    public function salary()
    {
        $this->_table_name = 'salary';
        $this->_primary_key = 'sal_id';
        $this->_order_by = 'sal_id';
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

    public function partners()
    {
        $this->_table_name = 'partners';
        $this->_primary_key = 'part_id';
        $this->_order_by = 'part_id';
    }

    public function extra_expences()
    {
        $this->_table_name = 'extra_expences';
        $this->_primary_key = 'exp_id';
        $this->_order_by = 'exp_id';
    }

    public function expence_category()
    {
        $this->_table_name = 'expence_category';
        $this->_primary_key = 'exp_cat_id';
        $this->_order_by = 'exp_cat_id';
    }

    public function get_trans_dexs($acc_id)
    {
        $this->db->select_sum('tr_amount');
        $this->db->from('transections');
        $this->db->where(['tr_acc_id' => $acc_id, 'tr_type' => 'daily_expence']);
        $query = $this->db->get()->row()->tr_amount;
        return $query;
    }


    public function dex_join_trans($bill_id)
    {
        $this->db->from('expences');
        $this->db->join('transections', 'expences.dex_tr_id = transections.tr_id');
        // $this->db->from('expences');
        $this->db->join('units', 'units.unit_id = expences.dex_unit');
        $this->db->where('bill_id', $bill_id);
        $query = $this->db->get()->result();
        return $query;
    }

    public function bill_join_trans($bill_type)
    {
        $this->db->from('transections');
        $this->db->join('bills', 'transections.bill_id = bills.bill_id');
        // $this->db->from('expences');
        // $this->db->join('units', 'units.unit_id = expences.dex_unit');
        $this->db->where('bill_type', $bill_type);
        $this->db->where('tr_type', 'buy_stocks');
        $this->db->order_by('tr_id DESC');
        $query = $this->db->get()->result();
        return $query;
    }

    public function sal_join_trans_join_emp($emp_id, $year, $month)
    {
        $next_year = $year + 1;
        $last_year = $year - 1;
        $this->db->from('salary');
        $this->db->join('transections', 'transections.tr_sal_id = salary.sal_id');
        $this->db->where('sal_emp_id', $emp_id);
        $this->db->where('sal_date <', $next_year . '-0-0');
        $this->db->where('sal_date >', $last_year . '-0-0');
        $this->db->where('sal_month', $month);
        $query = $this->db->get()->result();
        // echo $this->db->last_query(); die();
        return $query;
    }

    public function partner_join_employee($part_id)
    {
        $this->db->from('partners');
        $this->db->join('employees', 'partners.part_emp_id = employees.emp_id');
        $this->db->where('part_id', $part_id);
        $query = $this->db->get()->row();
        return $query;
    }

    public function total_part_amount()
    {
        $this->db->select('SUM(part_amount) as total_amount');
        $this->db->from('partners');
        $query = $this->db->get()->row();
        return $query;
    }

    public function exp_cat_join_extra_expences($exp_id = NULL)
    {
        $this->db->from('extra_expences');
        $this->db->join('expence_category', 'expence_category.exp_cat_id = extra_expences.exp_cat_id');
        $this->db->limit(50);
        if ($exp_id != NULL)
        {
            $this->db->where('exp_id', $exp_id);
            $query = $this->db->get()->row();
        }
        else
        {
            $query = $this->db->get()->result();
        }
        return $query;
    }


}
