<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->template->title = 'سفارشات';
        $this->load->model('order_model');
    }

    public function index()
    {
        # codes...
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
        $this->order_model->discounts();
        $discounts = $this->order_model->data_get();
        $base_sub_menu = $this->order_model->order_join_sub_order();

        // view
        $this->template->content->view('orders/create_order', ['customers' => $customers, 'bm' => $bm, 'base_sub_menu' => $base_sub_menu, 'discounts' => $discounts]);
        $this->template->publish();
    } // end create_order

    /* TODO: wordking here... insert_kitchen_order() */
    public function insert_kitchen_order()
    {
        $data = $this->input->post();
//        print_r($data); die();
        // Inserting data
        $this->order_model->orders();
        $insert_ord_id = $this->order_model->data_save(['ord_desc' => $data['ord_desc'], 'ord_created_date' => $data['ord_created_date'], 'ord_date' => $data['ord_date'], 'ord_time' => $data['ord_time'], 'ord_price' => $data['ord_price'], 'ord_discount' => $data['ord_discount'], 'ord_type' => 'kitchen', 'ord_cus_id' => $data['ord_cus_id']]);
        if (is_int($insert_ord_id)) {

            // inserting every sub_orders
            $row = count($this->input->post('sord_sm_id'))-1;
            $this->order_model->sub_orders();
            for($i=0; $i <= $row; $i++)
            {
                $sm_data = array(
                    'sord_bm_id'  => $data['sord_bm_id'],
                    'sord_sm_id'  => $data['sord_sm_id'][$i],
                    'sord_count'  => $data['sord_count'],
                    'sord_price'  => $data['bm_price'],
                    'sord_ord_id' => $insert_ord_id
                );
                $result = $this->order_model->data_save($sm_data);
                if(!is_int($result))
                {
                    $result = null;
                    $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
                    redirect('order/create_order');
                }
            } // end for

            // Get customer and cost from his account amount
            $this->order_model->customers();
            $customer = $this->order_model->data_get($data['ord_cus_id'], true);
            $this->order_model->accounts();
            $account = $this->order_model->data_get($customer->cus_acc_id, true);
            $acc_new_amount = $account->acc_amount - $data['tr_amount'];
            $this->order_model->data_save(['acc_amount' => $acc_new_amount], $account->acc_id);
            // Save Transection
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
            $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
            redirect('order/create_order');
        } else {
            $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد، دوباره کوشش نمائید.');
            redirect('order/create_order');
        }

    } // end insert_kitchen_order

    public function kitchen_orders()
    {
        $this->template->description = 'لیست سفارشات آشپزخانه';
        $orders = $this->order_model->order_join_customer('kitchen');

        // view
        $this->template->content->view('orders/kitchen_orders', ['orders' => $orders]);
        $this->template->publish();
    } // end kitchen_orders

    public function delete_bm()
    {
        sleep(1);
        $this->menu_model->base_menus();

        $bm_id = $this->input->post('bm_id');
        $this->menu_model->data_delete($bm_id);

    } // end delete_bm

    /* TODO: Discount must set on resturant orders */
    public function create_resturant_order()
    {
        $this->template->description = 'ثبت سفارش برای رستورانت';
        $this->order_model->menu_category();
        $menu_categories = $this->order_model->data_get();
        $this->order_model->customers();
        $customers = $this->order_model->data_get();
        $this->order_model->desks();
        $desks = $this->order_model->data_get();
        $this->order_model->discounts();
        $discounts = $this->order_model->data_get();

        // view
        $this->template->content->view('orders/create_resturant_order', ['menu_categories' => $menu_categories, 'customers' => $customers, 'desks' => $desks, 'discounts' => $discounts]);
        $this->template->publish();
    } // end create_resturant_order

    public function jq_menu_list($mc_id,$type = 'add')
    {
        // sleep(1);
        $this->order_model->base_menus();
        $base_menus = $this->order_model->data_get_by(['bm_type' => 1, 'bm_cat_id' => $mc_id]);

        foreach ($base_menus as $base_menu) {
            echo "<li id='bm_" . $base_menu->bm_id . "' >";
            echo '<img width="100" class="img-thumbnail" src="' . site_url('assets/img/menus/' . $base_menu->bm_picture) . '" data-toggle="tooltip" title="" data-original-title=" af">';
            echo '<a class="users-list-name" href="#"  style="margin-bottom: 10px" data-toggle="tooltip" title="" data-original-title="' . $base_menu->bm_desc . '">' . $base_menu->bm_name . '</a>';
            if ($type == "add")
            {
                echo '<a class="btn bg-green btn-xs btn_add" id="btn_add" bm-id="' . $base_menu->bm_id . '" menu-pic="' . $base_menu->bm_picture . '"  bm-price="' . $base_menu->bm_price . '" bm-name="' . $base_menu->bm_name . '"  ><span title="" data-original-title="Use"><i class="fa fa-plus"></i></span></a>&nbsp;';
                echo '<a class="btn bg-red btn-xs btn_minus" bm-id="' . $base_menu->bm_id . '" menu-pic="' . $base_menu->bm_picture . '" bm-price="' . $base_menu->bm_price . '" bm-name="' . $base_menu->bm_name . '"    ><span title="" data-original-title="Use"><i class="fa fa-minus "></i></span></a>';
            }
            else
            {
                echo '<a class="btn bg-orange btn-xs btn_add" id="btn_add" bm-id="' . $base_menu->bm_id . '" menu-pic="' . $base_menu->bm_picture . '"  bm-price="' . $base_menu->bm_price . '" bm-name="' . $base_menu->bm_name . '"  ><span title="" data-original-title="Use">&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-edit"></i>&nbsp;&nbsp;&nbsp;&nbsp;</span></a>&nbsp;';
            }
            echo '</li>';
        }
    } // end jq_menu_list

    public function insert_resturant_order()
    {
        $data = $this->input->post();
        // print_r($data);

        // Inserting data
        $this->order_model->orders();
        $insert_ord_id = $this->order_model->data_save(['ord_desc' => $data['ord_desc'], 'ord_date' => $data['ord_date'], 'ord_time' => $data['ord_time'], 'ord_price' => $data['ord_price'], 'ord_discount' => $data['ord_discount'], 'ord_type' => 'resturant', 'ord_desk_id' => $data['ord_desk_id'], 'ord_cus_id' => ($data['ord_cus_id'] == base_account()->acc_id . '_') ? base_account()->acc_id : $data['ord_cus_id']]);
        if (is_int($insert_ord_id)) {
            $count = count($data['sord_price']);
            for ($i = 0; $i < $count; $i++) {
                $this->order_model->sub_orders();
                $this->order_model->data_save(['sord_bm_id' => $data['sord_bm_id'][$i], 'sord_count' => $data['sord_count'][$i], 'sord_price' => $data['sord_price'][$i], 'sord_ord_id' => $insert_ord_id]);
            }

            if ($data['ord_cus_id'] != base_account()->acc_id . '_') {
                $this->order_model->customers();
                $customer = $this->order_model->data_get($data['ord_cus_id'], true);
                $this->order_model->accounts();
                $account = $this->order_model->data_get($customer->cus_acc_id, true);
                $acc_new_amount = $account->acc_amount - $data['tr_amount'];
                $this->order_model->data_save(['acc_amount' => $acc_new_amount], $account->acc_id);
                $account_id = $account->acc_id;
            } else {
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
            $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
            redirect('order/create_resturant_order');
        } else {
            $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد، دوباره کوشش نمائید.');
            redirect('order/create_resturant_order');
        }

    } // end insert_resturant_order
    // TODO: include the discount persent to list
    public function resturant_orders()
    {
        $this->template->description = 'لیست سفارشات رستورانت';
        $orders = $this->order_model->order_join_customer('resturant');
        $this->order_model->orders();
        $orders_base_acc = $this->order_model->data_get_by(['ord_type' => 'resturant']);

        // view
        $this->template->content->view('orders/resturant_orders', ['orders' => $orders, 'orders_base_acc' => $orders_base_acc]);
        $this->template->publish();
    } // end resturant_orders

    public function resturant_payment($ord_id)
    {
        $this->template->description = 'پرداخت باقیمانده هزینه سفارش رستورانت';
        $this->order_model->transections();
        $transections = $this->order_model->data_get_by(['tr_type' => 'resturant', 'tr_ord_id' => $ord_id]);

        $this->order_model->orders();
        $order = $this->order_model->data_get($ord_id);

        $this->order_model->discounts();
        $discounts = $this->order_model->data_get();

        if ($order->ord_cus_id != base_account()->acc_id) {
            $this->order_model->customers();
            $customer = $this->order_model->data_get_by(['cus_id' => $order->ord_cus_id], true);
        } else {
            $customer = array('cus_name' => base_account()->acc_name, 'cus_acc_id' => base_account()->acc_id);
        }

        // view
        $this->template->content->view('orders/resturant_payment', ['transections' => $transections, 'order' => $order, 'customer' => $customer, 'discounts' => $discounts]);
        $this->template->publish();
    } // end resturant_payment

    public function insert_resturant_payment()
    {
        $data = $this->input->post();
        $data['tr_type'] = 'resturant';
        $data['tr_status'] = 2;
//         print_r($data); die();

        if (isset($data['ord_price']))
        {
            $this->order_model->orders();
            $this->order_model->data_save(['ord_price' => $data['ord_price'], 'ord_discount' => $data['ord_discount']], $data['tr_ord_id']);
            unset($data['ord_price']);
        }
        unset($data['ord_discount']);

        $this->order_model->accounts();
        $account = $this->order_model->data_get($data['tr_acc_id']);
        $acc_amount = $account->acc_amount - $data['tr_amount'];
        $insert_acc = $this->order_model->data_save(['acc_amount' => $acc_amount], $data['tr_acc_id']);
        if (is_int($insert_acc)) {
            $this->order_model->transections();
            $insert_trans = $this->order_model->data_save($data);
            if (is_int($insert_trans)) {
                $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
                redirect('order/resturant_payment/' . $data['tr_ord_id']);
            }
            else
            {
                $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد، دوباره کوشش نمائید.');
                redirect('order/resturant_payment/' . $data['tr_ord_id']);
            }
        }
        else
        {
            $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد، دوباره کوشش نمائید.');
            redirect('order/resturant_payment/' . $data['tr_ord_id']);
        }
    } // end insert_resturant_payment
    /* TODO: add new item on order must be include. */
    public function sub_orders($order_id)
    {
        $this->template->description = 'ویرایش سفارش برای رستورانت';
        $this->order_model->sub_orders();
        $sub_orders = $this->order_model->get_sub_order_join_menu($order_id);
        $this->order_model->menu_category();
        $menu_categories = $this->order_model->data_get();
        $this->order_model->orders();
        $order = $this->order_model->data_get($order_id);

        // view
        $this->template->content->view('orders/resturant_sub_orders', ['sub_orders' => $sub_orders, 'menu_categories' => $menu_categories, 'order' => $order]);
        $this->template->publish();
    } // end sub_orders

    public function update_sub_order()
    {
        $data = $this->input->post();
        // get order
        $this->order_model->orders();
        $order = $this->order_model->data_get($data['sord_ord_id']);
        // get sub order
        $this->order_model->sub_orders();
        $sub_order = $this->order_model->data_get($data['sord_id']);
        // save new sub order info
        $this->order_model->data_save(['sord_bm_id' => $data['sord_bm_id'], 'sord_count' => $data['sord_count'], 'sord_price' => $data['sord_price']], $data['sord_id']);
        // set new ord price
        $new_ord_price = $order->ord_price - $sub_order->sord_price;
        $new_ord_price = $new_ord_price + $data['sord_price'] - $order->ord_discount / 100 * $data['sord_price'];
        // save new ord price
        $this->order_model->orders();
        $this->order_model->data_save(['ord_price' => $new_ord_price], $data['sord_ord_id']);
        // redirect
        $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
        redirect('order/sub_orders/' . $data['sord_ord_id']);
    } // end update_sub_order


    public function delete_kitchen_order()
    {
         sleep(1);
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
    } // end delete_kitchen_order

    public function edit_kitchen_order($ord_id)
    {
        $this->template->description = 'ویرایش سفارش برای آشپزخانه';
        $this->order_model->orders();
        $order = $this->order_model->data_get($ord_id, true);

        $this->order_model->sub_orders();
        $sub_order = $this->order_model->data_get_by(['sord_ord_id' => $ord_id], true);

        $this->order_model->discounts();
        $discounts = $this->order_model->data_get();

        $this->order_model->base_menus();
        $base_menu = $this->order_model->data_get($sub_order->sord_bm_id, true);

        $base_sub_menu = $this->order_model->order_join_sub_order();

        $bm = $this->order_model->data_get_by(['bm_type' => 0]);

        // view
        $this->template->content->view('orders/edit_kitchen_order', ['order' => $order, 'sub_order' => $sub_order, 'base_menu' => $base_menu, 'bm' => $bm, 'discounts' => $discounts, 'base_sub_menu' => $base_sub_menu]);
        $this->template->publish();
    } // end edit_kitchen_order

    public function update_kitchen_order()
    {
        $data = $this->input->post();
         print_r($data); die();

        $this->order_model->sub_orders();
        $insert_ord_id = $this->order_model->data_save(['sord_bm_id' => $data['sord_bm_id'], 'sord_count' => $data['sord_count'], 'sord_price' => $data['ord_price']], $data['sord_id']);
        if (is_int($insert_ord_id)) {
            $this->order_model->orders();
            $this->order_model->data_save(['ord_desc' => $data['ord_desc'], 'ord_date' => $data['ord_date'], 'ord_time' => $data['ord_time'], 'ord_price' => $data['ord_price']], $data['ord_id']);

            $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
            redirect('order/kitchen_orders');
        } else {
            $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد، دوباره کوشش نمائید.');
            redirect('order/kitchen_orders');
        }
    } // end update_kitchen_order

    public function kitchen_payment($ord_id)
    {
        $this->template->description = 'پرداخت باقیمانده هزینه سفارش آشپزخانه';
        $this->order_model->transections();
        $transections = $this->order_model->data_get_by(['tr_type' => 'kitchen_order', 'tr_ord_id' => $ord_id]);

        $this->order_model->orders();
        $order = $this->order_model->data_get($ord_id);

        $this->order_model->customers();
        $customer = $this->order_model->data_get_by(['cus_id' => $order->ord_cus_id], true);

        // view
        $this->template->content->view('orders/kitchen_payment', ['transections' => $transections, 'order' => $order, 'customer' => $customer]);
        $this->template->publish();
    } // end kitchen_payment

    public function insert_kitchen_payment()
    {
        $data = $this->input->post();
        $data['tr_type'] = 'kitchen_order';
        $data['tr_status'] = 2;
        // print_r($data); die();

        $this->order_model->accounts();
        $account = $this->order_model->data_get($data['tr_acc_id']);
        $acc_amount = $account->acc_amount - $data['tr_amount'];
        $insert_acc = $this->order_model->data_save(['acc_amount' => $acc_amount], $data['tr_acc_id']);
        if (is_int($insert_acc)) {
            $this->order_model->transections();
            $insert_trans = $this->order_model->data_save($data);
            if (is_int($insert_trans)) {
                $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
                redirect('order/kitchen_payment/' . $data['tr_ord_id']);
            } else {
                $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد، دوباره کوشش نمائید.');
                redirect('order/kitchen_payment/' . $data['tr_ord_id']);
            }
        } else {
            $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد، دوباره کوشش نمائید.');
            redirect('order/kitchen_payment/' . $data['tr_ord_id']);
        }
    } // end insert_kitchen_payment

    public function delete_kitchen_transection()
    {
        $tr_id = $this->input->post('tr_id');
        $tr_acc_id = $this->input->post('tr_acc_id');

        $this->order_model->transections();
        $trans = $this->order_model->data_get($tr_id);

        $this->order_model->accounts();
        $account = $this->order_model->data_get($tr_acc_id);
        $acc_amount = $account->acc_amount + $trans->tr_amount;
        $this->order_model->data_save(['acc_amount' => $acc_amount], $tr_acc_id);

        $this->order_model->transections();
        $this->order_model->data_delete($tr_id);
    } // end delete_kitchen_transection


    public function expence_stock($ord_id = NULL, $cus_name = NULL, $cus_lname = NULL)
    {
        $this->template->description = 'ثبت مصارف از گدام برای سفارشات ';
        $orders = $this->order_model->order_join_customer('kitchen', 30);
        $this->order_model->stock_units();
        $stocks = $this->order_model->data_get();

        // view
        $this->template->content->view('orders/expence_stock', ['orders' => $orders, 'stocks' => $stocks]);
        $this->template->publish();
    } // end expence_stock

    public function insert_stock_expence()
    {
        $data   = $this->input->post();
//        print_r($data); die();
        $count  = count($data['stock_count']);
        /* insert all stock expences */
        for ($i = 0; $i < $count; $i++) {
            $this->order_model->stocks();
            $this->order_model->data_save([
                'stock_ord_id'      => $data['stock_ord_id'],
                'stock_type'       => 'kitchen',
                'stock_st_id'       => $data['stock_st_id'][$i],
                'stock_count'       => $data['stock_count'][$i],
                'stock_total_price' => $data['stock_total_price'][$i]
            ]);
            /* decrease stocks */
            $this->order_model->stock_units();
            $stock_unit = $this->order_model->data_get($data['stock_st_id'][$i]);
            $this->order_model->data_save(['st_count' => $stock_unit->st_count - $data['stock_count'][$i]], $data['stock_st_id'][$i]);
        }
        $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
        redirect('order/expence_stock');
    } // end insert_stock_expence

    public function insert_stock_expence_resturant($expence_type)
    {
        $data   = $this->input->post();
        $count  = count($data['stock_count']);
        /* insert all stock expences */
        for ($i = 0; $i < $count; $i++) {
            $this->order_model->stocks();
            $this->order_model->data_save([
                'stock_type'        => $expence_type,
                'stock_st_id'       => $data['stock_st_id'][$i],
                'stock_count'       => $data['stock_count'][$i],
                'stock_date'        => $data['stock_date'],
                'stock_total_price' => $data['stock_total_price'][$i]
            ]);
            /* Decrease stocks */
            $this->order_model->stock_units();
            $stock_unit = $this->order_model->data_get($data['stock_st_id'][$i]);
            $this->order_model->data_save(['st_count' => $stock_unit->st_count - $data['stock_count'][$i]], $data['stock_st_id'][$i]);
        }
        $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
        redirect('order/expence_stock');
    }

    public function stock_expences($order_id)
    {
        $this->template->description = 'لیست مصارف برای سفارشات آشپزخانه';
        $this->order_model->stocks();
        $stocks = $this->order_model->stock_join_stock_unit($order_id);
        $this->order_model->orders();
        $order = $this->order_model->order_join_customer_by_id($order_id);

        // view
        $this->template->content->view('orders/stock_expences', ['order' => $order, 'stocks' => $stocks]);
        $this->template->publish();
    } // end public function stock_expences

    /* TODO: Working Here... */
    public function stock_expence_resturant($expence_type)
    {
        $this->template->description = ($expence_type == 'resturant')?'لیست مصارف برای سفارشات رستورانت':'لیست مصارف برای سفارشات فست فود ';
        /* get last month */
        $str_date = mds_date("Y-m-d", "now",1);
        $new = explode("-", $str_date);
        $end_date = implode("-",[$new[0], $new[1]+1, $new[2]]);
        /* get stock expences */
        $stocks = $this->order_model->stock_join_stock_unit([$str_date, $end_date, $expence_type]);

        // view
        $this->template->content->view('orders/resturant_stock_expences', ['stocks' => $stocks]);
        $this->template->publish();
    }

    public function delete_expence_order()
    {
        sleep(1);
        $stock_id = $this->input->post('stock_id');
        $this->order_model->stocks();
        $this->order_model->data_delete($stock_id);
    } // end delete_expence_order

    public function update_stock_expence($srock_id, $ord_id)
    {
        $this->order_model->stocks();
        if ($this->order_model->data_save($this->input->post(), $srock_id))
        {
            $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
            redirect('order/stock_expences/' . $ord_id);
        }
        else
        {
            $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد، دوباره کوشش نمائید.');
            redirect('order/stock_expences/' . $ord_id);
        }
    }

    public function update_resturant_stock_expence($srock_id,$type)
    {
        $this->order_model->stocks();
        if ($this->order_model->data_save($this->input->post(), $srock_id))
        {
            $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
            redirect('order/stock_expence_resturant/' . $type);
        }
        else
        {
            $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد، دوباره کوشش نمائید.');
            redirect('order/stock_expence_resturant/' . $type);
        }
    }

    /* TODO: Print Kitchen Order Bill */
    public function print_order_bill()
    {
        // view
        $this->template->content->view('orders/print_order_bill');
        $this->template->publish();
    }

    /* TODO: MAKE A PROFISSNAL CV  */


    public function jq_sub_menus($ord_id)
    {
        sleep(1);
        // get sub orders data
        $this->order_model->sub_orders();
        $sub_order = $this->order_model->data_get_by(['sord_ord_id' => $ord_id]);

        $result = '';
        $result .= '<table class="table table-bordered table-responsive">
                <tbody>
                    <tr class="bg-primary">
                        <th>#</th>
                        <th>زیر منو</th>
                        <th> قیمت</th>
                        <th>توضیحات</th>
                    </tr>';
        $i = 1;
        foreach ($sub_order as $so)
        {
            // get every sub menus
            $this->order_model->sub_menus();
            $sub_menus = $this->order_model->data_get($so->sord_sm_id, true);
            $result .= '<tr>
                <td>'.$i++.'</td>
                <td><strong>'.$sub_menus->sm_name.'</strong></td>
                <td><strong>'.$sub_menus->sm_price.' </strong> افغانی </td>
                <td>'.$sub_menus->sm_desc.'</td>
            </tr>';
        }
        $result .= '</tbody></table>';
    echo $result;
    }
} // end Class