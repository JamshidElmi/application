<?php

/**
 * Menu Model class
 */
class order_model extends MY_Model
{
    protected $_table_name = 'orders';
    protected $_primary_key = 'ord_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'ord_id';
    protected $_timestamps = FALSE;

    function __construct()
    {
        parent::__construct();
    }

    public function orders()
    {
        $this->_table_name = 'orders';
        $this->_primary_key = 'ord_id';
        $this->_order_by = 'ord_id';
    }

    public function sub_orders()
    {
        $this->_table_name = 'sub_orders';
        $this->_primary_key = 'sord_id';
        $this->_order_by = 'sord_id';
    }

    public function customers()
    {
        $this->_table_name = 'customers';
        $this->_primary_key = 'cus_id';
        $this->_order_by = 'cus_id';
    }

    public function base_menus()
    {
        $this->_table_name = 'base_menus';
        $this->_primary_key = 'bm_id';
        $this->_order_by = 'bm_id';
    }

    public function sub_menus()
    {
        $this->_table_name = 'sub_menus';
        $this->_primary_key = 'sm_id';
        $this->_order_by = 'sm_id';
    }

    public function accounts()
    {
        $this->_table_name = 'accounts';
        $this->_primary_key = 'acc_id';
        $this->_order_by = 'acc_id';
    }

    public function transections()
    {
        $this->_table_name = 'transections';
        $this->_primary_key = 'tr_id';
        $this->_order_by = 'tr_id';
    }


    public function desks()
    {
        $this->_table_name = 'desks';
        $this->_primary_key = 'desk_id';
        $this->_order_by = 'desk_id';
    }

    public function menu_category()
    {
        $this->_table_name = 'menu_category';
        $this->_primary_key = 'mc_id';
        $this->_order_by = 'mc_id';
    }

    public function stock_units()
    {
        $this->_table_name = 'stock_units';
        $this->_primary_key = 'st_id';
        $this->_order_by = 'st_id';
    }

    public function stocks()
    {
        $this->_table_name = 'stocks';
        $this->_primary_key = 'stock_id';
        $this->_order_by = 'stock_id';
    }

    public function discounts()
    {
        $this->_table_name = 'discounts';
        $this->_primary_key = 'disc_id';
        $this->_order_by = 'disc_id';
    }

    public function order_join_sub_order()
    {
        $this->db->from('base_menus');
        $this->db->join('sub_base_menu', 'base_menus.bm_id = sub_base_menu.sbm_bm_id');
        $this->db->join('sub_menus', 'sub_menus.sm_id = sub_base_menu.sbm_sm_id');
        $this->db->where(['bm_type' => 0]);
        $query = $this->db->get()->result();
        return $query;
    }


    public function order_join_customer($ord_type, $limit = NULL)
    {
        $this->db->from('orders');
        $this->db->join('customers', 'customers.cus_id = orders.ord_cus_id');
        $this->db->where(['ord_type' => $ord_type]);
        if ($limit != NUll) {
            $this->db->limit($limit);
        }
        $this->db->order_by('ord_id DESC');
        $query = $this->db->get()->result();
        return $query;
    }

    public function order_join_customer_base_acc($ord_type)
    {
        $this->db->from('orders');
        $this->db->join('customers', 'customers.cus_id = orders.ord_cus_id');
        $this->db->where('ord_cus_id', base_account()->acc_id);
        // $this->db->where(['ord_type' => $ord_type]);
        $this->db->order_by('ord_id DESC');
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_sub_order_join_menu($order_id)
    {
        $this->db->from('sub_orders');
        $this->db->join('base_menus', 'sub_orders.sord_bm_id = base_menus.bm_id');
        $this->db->join('menu_category', 'menu_category.mc_id = base_menus.bm_cat_id');
        $this->db->join('units', 'base_menus.bm_unit_id = units.unit_id');
        $this->db->where('sord_ord_id', $order_id);
        $query = $this->db->get()->result();
        return $query;
    }
    /* TODO: Working Here... */
    public function stock_join_stock_unit($condateion)
    {
        $this->db->from('stocks');
        $this->db->join('stock_units', 'stocks.stock_st_id = stock_units.st_id');
        $this->db->join('units', 'units.unit_id = stock_units.st_unit');
        if (!is_array($condateion))
        {
            $this->db->where('stock_ord_id', $condateion);
        }
        else
        {
            $this->db->where('stock_date > ', $condateion[0]);
            $this->db->or_where('stock_date < ', $condateion[1]);
            $this->db->where('stock_type', $condateion[2]);
        }
        $query = $this->db->get()->result();
        return $query;
    }

    public function order_join_customer_by_id($order_id)
    {
        $this->db->from('orders');
        $this->db->join('customers', 'customers.cus_id = orders.ord_cus_id');
        $this->db->where(['ord_id' => $order_id]);
        $query = $this->db->get()->row();
        return $query;
    }

    public function ord_join_sub_ord_join_unit($order_id)
    {
        $this->db->from('orders');
        $this->db->join('sub_orders', 'sub_orders.sord_ord_id = orders.ord_id');
        $this->db->join('sub_menus', 'sub_orders.sord_sm_id = sub_menus.sm_id');
        $this->db->join('units', 'units.unit_id = sub_menus.sm_unit_id');
        $this->db->where(['orders.ord_id' => $order_id]);
        $query = $this->db->get()->result();
        return $query;
    }

    public function ord_join_sub_ord_join_unit_res($order_id)
    {
        $this->db->from('orders');
        $this->db->join('sub_orders', 'sub_orders.sord_ord_id = orders.ord_id');
        $this->db->join('base_menus', 'base_menus.bm_id = sub_orders.sord_bm_id');
        $this->db->join('units', 'units.unit_id = base_menus.bm_unit_id');
        $this->db->where(['orders.ord_id' => $order_id]);
        $query = $this->db->get()->result();
        return $query;
    }

    public function count_order_notifications($date,$time)
    {
        $this->db->from('orders');
        $this->db->join('customers', 'customers.cus_id = orders.ord_cus_id', 'left outer');
        $this->db->join('desks', 'desks.desk_id = orders.ord_desk_id', 'left outer');
        $this->db->where('ord_date >=' , $date);
        $this->db->order_by('ord_date',0);
        // $this->db->where('ord_time >=' , $time);
        $query = $this->db->get()->result();
//        echo $this->db->last_query();
        return $query;
        // echo count($query);

         // die();

    }

    public function count_stock_notifications()
    {
        $this->db->from('stock_units');
        $this->db->join('units', 'stock_units.st_unit = units.unit_id');
        $this->db->where('st_count <= st_min_count');
        $query = $this->db->get()->result();
//        echo $this->db->last_query();
        return $query;
    }

    public function get_stocks_units()
    {
        $this->db->from('stock_units');
        $this->db->join('units', 'stock_units.st_unit = units.unit_id');
        $query = $this->db->get()->result();
        return $query;
    }



} // end class