<?php
/**
* Menu Model class
*/
class menu_model extends MY_Model
{
    protected $_table_name = 'menu_category';
    protected $_primary_key = 'mc_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'mc_id';
    protected $_timestamps = FALSE;

    function __construct()
    {
        parent::__construct();
    }

    public function menu_category()
    {
        $this->_table_name = 'menu_category';
        $this->_primary_key = 'mc_id';
        $this->_order_by = 'mc_id';
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

    public function sub_base_menu()
    {
        $this->_table_name = 'sub_base_menu';
        $this->_primary_key = 'sbm_id';
        $this->_order_by = 'sbm_id';
    }

    public function base_join_sub_menus($bm_id = NULL)
    {
        $this->db->from('base_menus');
        $this->db->join('sub_menus', 'base_menus.bm_id = sub_menus.sm_bm_id');
        $this->db->where(['bm_type'=> 0]);
        if ($bm_id != Null) {
            $this->db->where(['bm_id' => $bm_id]);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function sub_base_menus($bm_id)
    {
        $this->db->from('base_menus');
        $this->db->join('sub_base_menu', 'base_menus.bm_id = sub_base_menu.sbm_bm_id');
        $this->db->join('sub_menus', 'sub_menus.sm_id = sub_base_menu.sbm_sm_id');
        $this->db->where(['bm_id' => $bm_id]);
        $query = $this->db->get();
        return $query->result();
    }

    public function sub_base_menus_not($bm_id)
    {
        $this->db->from('base_menus');
        $this->db->join('sub_base_menu', 'base_menus.bm_id = sub_base_menu.sbm_bm_id');
        $this->db->join('sub_menus', 'sub_menus.sm_id = sub_base_menu.sbm_sm_id');
        $this->db->where(['bm_id !=' => $bm_id]);
        $query = $this->db->get();
        return $query->result();
    }


}
