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
        // Inserting data
        $this->order_model->orders();
        $insert_ord_id = $this->order_model->data_save(['ord_desc'=>$data['ord_desc'],'ord_date'=>$data['ord_date'],'ord_time'=>$data['ord_time'],'ord_price'=>$data['ord_price'],'ord_type'=> 'kitchen', 'ord_cus_id'=>$data['ord_cus_id'] ]);
        if(is_int($insert_ord_id))
        {
            $this->order_model->sub_orders();
            $insert_sord_id = $this->order_model->data_save(['sord_bm_id'=>$data['sord_bm_id'],'sord_count'=>$data['sord_count'],'sord_price'=>$data['ord_price'],'sord_ord_id'=>$insert_ord_id ]);
            $this->order_model->customers();
            $customer = $this->order_model->data_get($data['ord_cus_id'], true);
            $this->order_model->accounts();
            $account = $this->order_model->data_get($customer->cus_acc_id, true);
            $acc_new_amount = $account->acc_amount - $data['tr_amount'];
            $this->order_model->data_save(['acc_amount' => $acc_new_amount], $account->acc_id);

            $this->order_model->transections();
            $this->order_model->data_save([
                'tr_desc' => $data['ord_desc'],
                'tr_amount' => $data['tr_amount'],
                'tr_type' => 'kitchen_order',
                'tr_date' => $data['ord_date'],
                'tr_status' => 1,
                'tr_acc_id' => $account->acc_id,
                'tr_ord_id' => $insert_ord_id,
                ]);
            $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.' );
            redirect('order/create_order');
        }
        else
        {
            $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد، دوباره کوشش نمائید.' );
            redirect('order/create_order');
        }

    } // end insert_kitchen_menu

    public function kitchen_orders()
    {
        $this->template->description = 'لیست سفارشات آشپزخانه';
        $orders = $this->order_model->order_join_customer();

         // view
        $this->template->content->view('orders/kitchen_orders', ['orders' => $orders]);
        $this->template->publish();
    }

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
        $this->order_model->customers();
        $customers = $this->order_model->data_get();
        $this->order_model->desks();
        $desks = $this->order_model->data_get();

        // view
        $this->template->content->view('orders/create_resturant_order', ['menu_categories' => $menu_categories, 'customers' => $customers, 'desks' => $desks]);
        $this->template->publish();
    }

    public function jq_menu_list($mc_id)
    {
        // sleep(1);
        $this->order_model->base_menus();
        $base_menus = $this->order_model->data_get_by(['bm_type' => 1, 'bm_cat_id' => $mc_id]);

        foreach ($base_menus as $base_menu)
        {
            echo "<li id='bm_".$base_menu->bm_id."' >";
                echo '<img width="100" class="img-thumbnail" src="'.site_url('assets/img/menus/'.$base_menu->bm_picture).'" >';
                echo '<a class="users-list-name" href="#" style="margin-bottom: 10px" data-toggle="tooltip" title="" data-original-title="'.$base_menu->bm_desc.'">'.$base_menu->bm_name.'</a>';
                echo '<a class="btn bg-green btn-xs btn_add" id="btn_add" bm-id="'.$base_menu->bm_id.'" menu-pic="'.$base_menu->bm_picture.'"  bm-price="'.$base_menu->bm_price.'"   ><span title="" data-original-title="Use"><i class="fa fa-plus "></i></span></a>&nbsp;';
                echo '<a class="btn bg-red btn-xs btn_minus" bm-id="'.$base_menu->bm_id.'" menu-pic="'.$base_menu->bm_picture.'" bm-price="'.$base_menu->bm_price.'"    ><span title="" data-original-title="Use"><i class="fa fa-minus "></i></span></a>';
            echo '</li>';
        }
    }

    public function insert_resturant_order()
    {
        $data = $this->input->post();
        // print_r($data);

        // Inserting data
        $this->order_model->orders();
        $insert_ord_id = $this->order_model->data_save(['ord_desc'=>$data['ord_desc'],'ord_date'=>$data['ord_date'],'ord_time'=>$data['ord_time'],'ord_price'=>$data['ord_price'],'ord_type'=> 'resturant', 'ord_desk_id'=>$data['ord_desk_id'], 'ord_cus_id'=>($data['ord_cus_id'] == base_account()->acc_id.'_') ? base_account()->acc_id : $data['ord_cus_id'] ]);
        if(is_int($insert_ord_id))
        {
            $count = count($data['sord_price']);
            for ($i=0; $i < $count  ; $i++)
            {
                $this->order_model->sub_orders();
                $insert_sord_id = $this->order_model->data_save(['sord_bm_id'=>$data['sord_bm_id'][$i],'sord_count'=>$data['sord_count'][$i],'sord_price'=>$data['sord_price'][$i],'sord_ord_id'=>$insert_ord_id ]);
            }

            if($data['ord_cus_id'] != base_account()->acc_id.'_')
            {
                $this->order_model->customers();
                $customer = $this->order_model->data_get($data['ord_cus_id'], true);
                $this->order_model->accounts();
                $account = $this->order_model->data_get($customer->cus_acc_id, true);
                $acc_new_amount = $account->acc_amount - $data['tr_amount'];
                $this->order_model->data_save(['acc_amount' => $acc_new_amount], $account->acc_id);
                $account_id = $account->acc_id;
            }
            else
            {
                $this->order_model->accounts();
                $acc_new_amount = base_account()->acc_amount + $data['tr_amount'];
                $this->order_model->data_save(['acc_amount' => $acc_new_amount], base_account()->acc_id);
                $account_id = base_account()->acc_id;
            }

            $this->order_model->transections();
            $this->order_model->data_save([
                'tr_desc' => $data['ord_desc'],
                'tr_amount' => $data['tr_amount'],
                'tr_type' => 'resturant',
                'tr_date' => $data['ord_date'],
                'tr_status' => ($account_id == base_account()->acc_id) ? 2 : 1,
                'tr_acc_id' => $account_id,
                'tr_ord_id' => $insert_ord_id,
                ]);
            $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.' );
            redirect('order/create_resturant_order');
        }
        else
        {
            $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد، دوباره کوشش نمائید.' );
            redirect('order/create_resturant_order');
        }

    }


























    public function delete_kitchen_order()
    {
        // sleep(1);
        $ord_id = $this->input->post('ord_id');
        $acc_id = $this->input->post('acc_id');

        $this->order_model->transections();
        $trans = $this->order_model->data_get_by(['tr_type' => 'kitchen_order', 'tr_ord_id' => $ord_id]);
        $total = 0;
        foreach ($trans as $tran) {
            $total += $tran->tr_amount;
        }

        $this->order_model->accounts();
        $account = $this->order_model->data_get($acc_id, true);
        $acc_amount = $account->acc_amount + $total;
        $this->order_model->data_save(['acc_amount' => $acc_amount], $acc_id);

        $this->order_model->orders();
        $this->order_model->data_delete($ord_id);
    }

    public function edit_kitchen_order($ord_id)
    {
        $this->template->description = 'ثبت سفارش برای رستورانت';
        $this->order_model->orders();
        $order = $this->order_model->data_get($ord_id, true);

        $this->order_model->sub_orders();
        $sub_order = $this->order_model->data_get_by(['sord_ord_id' => $ord_id], true);

        $this->order_model->base_menus();
        $base_menu = $this->order_model->data_get($sub_order->sord_bm_id, true);

        $bm = $this->order_model->data_get_by(['bm_type' => 0]);

        // view
        $this->template->content->view('orders/edit_kitchen_order', ['order' => $order, 'sub_order' => $sub_order, 'base_menu' => $base_menu, 'bm' => $bm ]);
        $this->template->publish();
    }

    public function update_kitchen_order()
    {
        $data = $this->input->post();
        // print_r($data); die();

        $this->order_model->sub_orders();
        $insert_ord_id = $this->order_model->data_save(['sord_bm_id' => $data['sord_bm_id'], 'sord_count' => $data['sord_count'], 'sord_price' => $data['ord_price']], $data['sord_id']);
        if(is_int($insert_ord_id))
        {
            $this->order_model->orders();
            $insert_sord_id = $this->order_model->data_save(['ord_desc' => $data['ord_desc'], 'ord_date'=>$data['ord_date'], 'ord_time'=>$data['ord_time'], 'ord_price' => $data['ord_price']], $data['ord_id']);

            $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.' );
            redirect('order/kitchen_orders');
        }
        else
        {
            $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد، دوباره کوشش نمائید.' );
            redirect('order/kitchen_orders');
        }
    } // end update_kitchen_order

    public function kitchen_payment($ord_id)
    {
        $this->order_model->transections();
        $transections = $this->order_model->data_get_by(['tr_type' => 'kitchen_order', 'tr_ord_id' => $ord_id]);

        $this->order_model->orders();
        $order = $this->order_model->data_get($ord_id);

        $this->order_model->customers();
        $customer = $this->order_model->data_get_by(['cus_id'=>$order->ord_cus_id], true);

        // view
        $this->template->content->view('orders/kitchen_payment', ['transections' => $transections,'order' => $order, 'customer' => $customer]);
        $this->template->publish();
    }

    public function insert_kitchen_payment()
    {
        $data = $this->input->post();
        $data['tr_type'] = 'kitchen_order';
        $data['tr_status'] = 2;
        // print_r($data); die();

        $this->order_model->accounts();
        $account = $this->order_model->data_get($data['tr_acc_id']);
        $acc_amount = $account->acc_amount - $data['tr_amount'];
        $insert_acc = $this->order_model->data_save(['acc_amount'=>$acc_amount], $data['tr_acc_id']);
        if (is_int($insert_acc))
        {
            $this->order_model->transections();
            $insert_trans = $this->order_model->data_save($data);
            if(is_int($insert_trans))
            {
                $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.' );
                redirect('order/kitchen_payment/'.$data['tr_ord_id']);
            }
            else
            {
                $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد، دوباره کوشش نمائید.' );
                redirect('order/kitchen_payment/'.$data['tr_ord_id']);
            }
        }
        else
        {
            $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد، دوباره کوشش نمائید.' );
            redirect('order/kitchen_payment/'.$data['tr_ord_id']);
        }
    }

    public function delete_kitchen_transection()
    {
        $tr_id = $this->input->post('tr_id');
        $tr_acc_id = $this->input->post('tr_acc_id');

        $this->order_model->transections();
        $trans = $this->order_model->data_get($tr_id);

        $this->order_model->accounts();
        $account = $this->order_model->data_get($tr_acc_id);
        $acc_amount = $account->acc_amount + $trans->tr_amount;
        $insert_acc = $this->order_model->data_save(['acc_amount'=>$acc_amount], $tr_acc_id);

        $this->order_model->transections();
        $this->order_model->data_delete($tr_id);
    }



}