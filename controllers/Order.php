<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->template->title = 'سفارشات';
		$this->load->model('order_model');
	}

	public function index()
	{

	}

    public function kitchen_menus($bm_id = NULL)
    {
        $bm = array();
        $this->template->description = 'ثبت سفارش جدید برای آشپزخانه و لیست سفارشات امروز ';
        $this->menu_model->base_menus();
        $base_menus = $this->menu_model->data_get_by(['bm_type' => 0]);
        // get base menu if id came for update
        if ($bm_id != NULL) {
            $bm = $this->menu_model->data_get($bm_id);
        }
        // view
        $this->template->content->view('menus/kitchen_menus', ['base_menus' => $base_menus, 'bm' => $bm]);
        $this->template->publish();
    } // end kitchen_menus


    public function create_order()
    {
        $this->template->description = 'ثبت سفارش جدید برای آشپزخانه';
        $this->order_model->customers();
        $customers = $this->order_model->data_get();
        $this->order_model->base_menus();
        $bm = $this->order_model->data_get_by(['bm_type' => 0]);
        $base_sub_menu = $this->order_model->order_join_sub_order();

         // view
        $this->template->content->view('orders/create_order', ['customers' => $customers, 'bm' => $bm, 'base_sub_menu' => $base_sub_menu]);
        $this->template->publish();
    }

    public function insert_kitchen_order()
    {
        // print_r($this->input->post()); die();

        $data = $this->input->post();
        unset($data['bm_cat_id']);
        unset($data['ord_bm_id']);
        unset($data['bm_price']);

        print_r($data); die();
        // Inserting data
        $this->order_model->orders();
        $insert = $this->order_model->data_save(['ord_desc'=>$data['ord_desc'],'ord_desc'=>$data['ord_desc'], ]);
        if(is_int($insert))
        {
            // $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.' );
            // redirect('menu/kitchen_menus');
            $this->order_model->customers();
            $customer = $this->order_model->data_get($this->input->post('ord_cus_id'), true);
            $this->order_model->accounts();
            $account = $this->order_model->data_get($customer->cus_acc_id, true);
            $this->order_model->transections();
            $this->order_model->data_save([
                'tr_desc'
                ]);
        }
        else
        {
            $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد، دوباره کوشش نمائید.' );
            redirect('menu/kitchen_menus');
        }

    } // end insert_kitchen_menu

    public function delete_bm()
    {
        sleep(1);
        $this->menu_model->base_menus();

        $bm_id = $this->input->post('bm_id');
        $this->menu_model->data_delete($bm_id);

    } // end insert_kitchen_menu


    public function create_resturant_order()
    {
        $this->template->description = 'ثبت سفارش برای رستورانت';
        $this->order_model->menu_category();
        $menu_categories = $this->order_model->data_get();

        // view
        $this->template->content->view('orders/create_resturant_order', ['menu_categories' => $menu_categories]);
        $this->template->publish();
    }

    public function jq_menu_list($mc_id)
    {
        $this->order_model->base_menus();
        $base_menus = $this->order_model->data_get_by(['bm_type' => 1, 'bm_cat_id' => $mc_id]);

        foreach ($base_menus as $base_menu)
        {
            echo "<li id='bm_".$base_menu->bm_id."' >";
                echo '<img width="100" class="img-thumbnail" src="'.site_url('assets/img/menus/'.$base_menu->bm_picture).'" >';
                echo '<a class="users-list-name" href="#" style="margin-bottom: 10px" data-toggle="tooltip" title="" data-original-title="'.$base_menu->bm_desc.'">'.$base_menu->bm_name.'</a>';
                echo '<a class="btn bg-green btn-xs btn_add" id="btn_add" bm-id="'.$base_menu->bm_id.'" menu-pic="'.$base_menu->bm_picture.'"     ><span title="" data-original-title="Use"><i class="fa fa-plus "></i></span></a>&nbsp;';
                echo '<a class="btn bg-orange btn-xs btn_add" bm-id="'.$base_menu->bm_id.'" menu-pic="'.$base_menu->bm_picture.'" bm-price="'.$base_menu->bm_price.'"    ><span title="" data-original-title="Use"><i class="fa fa-minus "></i></span></a>';
            echo '</li>';
        }
    }




}