<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Finance extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->template->title = 'مدیریت مالی';
		$this->load->model('finance_model');
        $this->template->menu = 'menu_finance';
	}

	public function index()
	{

	}

    public function accounts()
    {
        $this->template->description = 'لیست صندوق ها و ایجاد صندوق جدید';
        $this->template->menu1 = 'menu1_accounts';
        $this->template->menu2 = 'menu2_create_account';

        $accounts = $this->finance_model->data_get();
        // view
        $this->template->content->view('finance/accounts', ['accounts' => $accounts]);
        $this->template->publish();
    } // end accounts

    public function insert_account($redirect = 'accounts')
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('acc_name', 'نام صندوق', 'required|trim');
        $this->form_validation->set_rules('acc_amount', 'مقدار اولیه', 'required|numeric');
        $this->form_validation->set_rules('acc_date', 'تاریخ ایجاد', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('form_errors', validation_errors() );
            redirect('employee/create');
        }
        else
        {
            $account = $this->finance_model->data_save($this->input->post());
            if ($account) {
                // get data from account form
                $tr_amount = $this->input->post('acc_amount');
                $tr_date = $this->input->post('acc_date');
                // set trans values
                $this->finance_model->transections();
                $this->finance_model->data_save(['tr_amount'=> $tr_amount,'tr_status' =>1,'tr_desc' => 'افتتاح حساب', 'tr_acc_id'=>$account, 'tr_date'=>$tr_date, 'tr_type' => 'credit_debit'], $acc_id);

                $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
                redirect('finance/'.$redirect);

            }
            else
            {
                $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
                redirect('finance/'.$redirect);
            }
        }
    } // insert_account


    public function credit_debit($acc_id)
    {
        $this->template->description = 'برداشت از حساب و جمع در حساب';
        $this->template->menu1 = 'menu1_accounts';
        $this->template->menu2 = 'menu2_debit_credit';

        $account = $this->finance_model->data_get($acc_id, TRUE);
        $this->finance_model->transections();
        $transections = $this->finance_model->data_get_by(['tr_acc_id'=> $acc_id, 'tr_type'=> 'credit_debit']);
        // get daily_expences SUM
        $daily_expences = $this->finance_model->get_trans_dexs($acc_id);
        // view
        $this->template->content->view('finance/credit_debit', ['account' => $account, 'transections' => $transections, 'daily_expences' => $daily_expences ]);
        $this->template->publish();
    } // credit_debit

    public function insert_credit_debit()
    {
        $acc_id = $this->input->post('tr_acc_id');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('tr_amount', 'مقدار جدید', 'required|numeric');
        $this->form_validation->set_rules('tr_status', 'نوعیت عملیات', 'required|in_list[1,2]');
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('form_errors', validation_errors());
            redirect('finance/credit_debit/'.$acc_id);
        }
        else
        {
            $data = $this->input->post();
            $data['tr_type'] = 'credit_debit';
            $this->finance_model->transections();
            $transection = $this->finance_model->data_save($data);
            if ($transection) {
                $this->finance_model->accounts();
                $acc_info = $this->finance_model->data_get($acc_id, TRUE);
                $acc_new_amount = $this->input->post('tr_amount');
                if($this->input->post('tr_status') == 2)
                    $acc_new_amount = $acc_info->acc_amount - $acc_new_amount;
                else
                    $acc_new_amount = $acc_info->acc_amount + $acc_new_amount;

                $this->finance_model->data_save(['acc_amount'=>$acc_new_amount], $acc_id);

                $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
                redirect('finance/credit_debit/'.$acc_id);
            }
            else
            {
                $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
                redirect('finance/credit_debit/'.$acc_id);
            }
        }
    } /* END insert_credit_debit */

    public function delete_account()
    {
        sleep(1);
        $acc_id = $this->input->post('acc_id');
        $this->finance_model->data_delete($acc_id);
    } // end delete_account

    public function delete_transection($tr_id, $acc_id, $acc_amount)
    {
        sleep(1);
        // set trans values
        $this->finance_model->transections();
        // get current amount of account
        $transection = $this->finance_model->data_get($tr_id, TRUE);
        if($transection->tr_status == 1)
            $new_amount = $acc_amount - $transection->tr_amount;
        else
            $new_amount = $acc_amount + $transection->tr_amount;
        // Set new amount of account
        $this->finance_model->accounts();
        $account = $this->finance_model->data_save(['acc_amount'=> $new_amount], $acc_id);
        if (is_int($account)) {
            // delete trans tow
            $this->finance_model->transections();
            $this->finance_model->data_delete($tr_id);
            $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
            redirect('finance/credit_debit/'.$acc_id);
        }
        else{
            $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
            redirect('finance/credit_debit/'.$acc_id);
        }
    } // end delete_transection

    public function expences($bill_type)
    {
        $this->template->description = ($bill_type == 0) ? ' لیست مصارف روزانه' : ' لیست خریداری مصارف گدام ';
        $this->template->menu1 = ($bill_type == 0) ? 'menu1_expences' : 'menu1_stock';
        $this->template->menu2 = ($bill_type == 0) ? 'menu2_daily_expences' : 'menu2_buy_for_stock_list';

        $this->finance_model->bills();
        // $expences = $this->finance_model->data_get_by(['bill_type'=>$bill_type]);
        $expences = $this->finance_model->bill_join_trans($bill_type);
        // view
        $this->template->content->view('Finance/expences', ['expences' => $expences]);
        $this->template->publish();
    } // end expences

    public function new_expence()
    {
        $this->template->description = 'ثبت خریداری و مصارف روزانه';
        $this->template->menu1 = 'menu1_expences';
        $this->template->menu2 = 'menu2_create_daily_expence';

        // get current amount of main account
        $this->finance_model->accounts();
        $account = $this->finance_model->data_get_by(['acc_type' => 0] , TRUE);
        $this->finance_model->units();
        $units = $this->finance_model->data_get_by(['unit_type' => 0] );
        // view
        $this->template->content->view('finance/new_expence', ['acc_amount' => $account->acc_amount, 'units' => $units]);
        $this->template->publish();
    } // end new_expence


    public function insert_expence()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('bill_no', 'شماره بل', 'numeric');
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('form_errors', validation_errors());
            redirect('finance/new_expence/');
        }
        else
        {
            // inserting bill data
            $bill_data = array(
                'bill_no'           => $this->input->post('bill_no'),
                'bill_shop'         => $this->input->post('bill_shop'),
                'bill_date'         => $this->input->post('bill_date'),
                'bill_desc'         => $this->input->post('bill_desc'),
                'bill_total_amount' => $this->input->post('bill_sum'),
                'bill_dex_type'     => $this->input->post('bill_dex_type'),
                'bill_type'         => 0
                );
            $this->finance_model->bills();
            $inserted_bill_id = $this->finance_model->data_save($bill_data);

            // get account data
            $this->finance_model->accounts();
            $account = $this->finance_model->data_get_by(['acc_type'=>0], TRUE);

            // insertign transection data
            $data_trans = array(
                'tr_amount'     => $this->input->post('bill_sum'),
                'tr_date'       => $this->input->post('bill_date'),
                'tr_desc'       => $this->input->post('bill_desc'),
                'tr_type'       => 'daily_expence',
                'tr_status'     => 2,
                'tr_acc_id'     => $account->acc_id,
                'bill_id'       => $inserted_bill_id,
            );
            $this->finance_model->transections();
            $result_trans = $this->finance_model->data_save($data_trans);
            if(!is_int($result_trans))
            {
                $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
                redirect('finance/new_expence/');
            }

            $row = count($this->input->post('dex_unit'))-1;

            // inserting every expence data
            $this->finance_model->expences();
            for($i=0; $i <= $row; $i++)
            {
                $data = array(
                    'dex_name'          => $this->input->post('dex_name')[$i],
                    'dex_price'         => $this->input->post('dex_price')[$i],
                    'dex_count'         => $this->input->post('dex_count')[$i],
                    'dex_unit'          => $this->input->post('dex_unit')[$i],
                    'dex_total_amount'  => $this->input->post('dex_total_amount')[$i],
                    'dex_bill_id'       => $inserted_bill_id,
                    'dex_tr_id'         => $result_trans,
                );
                $result = $this->finance_model->data_save($data);
                if(!is_int($result))
                {
                    $result = null;
                    $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
                    redirect('finance/new_expence/');
                }
            } // end for


            // updating account data
            $this->finance_model->accounts();
            $acc_remain = ($account->acc_amount) - ($this->input->post('bill_sum'));
            $this->finance_model->data_save(['acc_amount'=> $acc_remain], $account->acc_id);
            $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
            redirect('finance/new_expence/');
        }

    } // end insert_expence


    public function delete_bill_expence($bill_id, $bill_total_amount ,$acc_id ,$type)
    {
        // get current amount of account
        $this->finance_model->accounts();

        $account = $this->finance_model->data_get($acc_id, TRUE);

        $this->finance_model->bills();
        if(!$this->finance_model->data_delete($bill_id))
        {
            $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
            redirect('finance/expences/'.$type);
        }

        $this->finance_model->accounts();
        $new_amount = $account->acc_amount + $bill_total_amount;
        // Set new amount of account
        $acc_inserted = $this->finance_model->data_save(['acc_amount'=>$new_amount],$account->acc_id);
        if (is_int($acc_inserted))
        {
           $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
            redirect('finance/expences/'.$type);
        }


        $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
        redirect('finance/expences/'.$type);

    } // end delete_bill_expence


    public function edit_daily_expence($dex_id)
    {
        $this->template->description = 'ویرایش خریداری و مصارف ثبت شده';
        $this->finance_model->expences();
        $dex = $this->finance_model->data_get($dex_id, TRUE);
        $stock_units = $this->finance_model->stocks_join_units();
        // view
        $this->template->content->view('finance/edit_expence', ['expence' => $dex, 'stock_units' => $stock_units]);
        $this->template->publish();

    } // edit_daily_expence

    public function delete_daily_expence($dex_id, $cost_amount, $total_amount, $acc_id, $bill_id, $tr_id)
    {
        $remain = $total_amount - $cost_amount;

        $this->finance_model->expences();
        $this->finance_model->data_delete($dex_id);

        $this->finance_model->bills();
        $this->finance_model->data_save(['bill_total_amount' => $remain], $bill_id);

        $this->finance_model->transections();
        $this->finance_model->data_save(['tr_amount' => $remain], $tr_id);

        $this->finance_model->accounts();
        $account = $this->finance_model->data_get($acc_id, TRUE);
        $acc_remain = $account->acc_amount + $cost_amount;
        $this->finance_model->data_save(['acc_amount' => $acc_remain], $acc_id);

        $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
        redirect('finance/bill_details/'.$bill_id);
    }


    /**
     * @param $dex_id
     * @param $bill_id
     */
    public function update_expence($dex_id, $bill_id)
    {

        // get current expence
        $this->finance_model->expences();
        $expences = $this->finance_model->data_get($dex_id, TRUE);
        // Update Expence
        $old_amount = $expences->dex_total_amount;
        if(!$this->input->post('dex_unit_name'))
        {
            // echo 'dex_unit_name COME';  die();
            $this->finance_model->data_save($this->input->post(), $dex_id);
        }
        else
        {
            // echo 'dex_unit_name NOT COME'; die();
            $data = $this->input->post();
            $this->finance_model->data_save(['dex_name' => $data['dex_st_name'],'dex_unit' => $data['dex_unit'],'dex_st_unit' => $data['dex_name'],'dex_count' => $data['dex_count'],'dex_price' => $data['dex_price'], 'dex_total_amount' => $data['dex_total_amount']], $dex_id);
        }
        // get current bill
        $this->finance_model->bills();
        $bill = $this->finance_model->data_get($bill_id, TRUE);
        // set new amount 4 bill
        $bill_total_amount = $bill->bill_total_amount - $old_amount;
        $bill_total_amount = $bill_total_amount + $this->input->post('dex_total_amount');
        // update new amount 4 bill
        $this->finance_model->data_save(['bill_total_amount' => $bill_total_amount], $bill_id);
        // Update transection
        $this->finance_model->transections();
        if(!$this->input->post('dex_unit_name'))
            $transection = $this->finance_model->data_get_by(['bill_id' => $bill_id, 'tr_type' => 'daily_expence'], TRUE);
        else
            $transection = $this->finance_model->data_get_by(['bill_id' => $bill_id, 'tr_type' => 'buy_stocks'], TRUE);

        // echo $this->db->last_query();
        // echo $transection->tr_id; die();
        $this->finance_model->data_save(['tr_amount' => $bill_total_amount], $transection->tr_id);
        // Get Base Account
        $this->finance_model->accounts();
        $account = $this->finance_model->data_get_by(['acc_type' => 0], TRUE);
        // Set New Acc_amount
        $acc_new_amount = ($old_amount) + ($account->acc_amount);
        $acc_new_amount = $acc_new_amount - $this->input->post('dex_total_amount');
        // Update New acc_amount
        $this->finance_model->data_save(['acc_amount' => $acc_new_amount], $account->acc_id);
        // view
        $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
        redirect('finance/bill_details/'.$bill_id);
    }

    public function buy_stock()
    {
        $this->template->description = 'خریداری اجناس برای گدام';
        $this->template->menu1 = 'menu1_stock';
        $this->template->menu2 = 'menu2_buy_for_stock';
        $this->finance_model->accounts();
        $accounts = $this->finance_model->data_get_by(['acc_type' => 1]);
        // $this->finance_model->stock_units();
        // $stock_units = $this->finance_model->data_get();
        // $this->finance_model->units();
        // $units = $this->finance_model->data_get();
        $stock_units = $this->finance_model->stocks_join_units();
        // view
        $this->template->content->view('finance/buy_for_stock', ['accounts' => $accounts, 'stock_units' => $stock_units]);
        $this->template->publish();
    }

    /**
     * @param $bill_id
     */
    public function bill_details($bill_id)
    {
        $this->template->description = 'لیست جزئیات فاکتور';
        $this->finance_model->expences();
        // $expences = $this->finance_model->get_join_expences($bill_id);
        $dex_trans = $this->finance_model->dex_join_trans($bill_id);
        $this->finance_model->bills();
        $bill = $this->finance_model->data_get($bill_id, TRUE);

        // view
        $this->template->content->view('finance/bill_details', [ 'bill' => $bill, 'dex_trans' => $dex_trans]);
        $this->template->publish();
    }

    public function insert_stock_expence()
    {
        // print_r($this->input->post()); die();
        $data = $this->input->post();
        // check btn type
        if (isset($data['first']))
        {
            // insert BILL
            $data_bill = array(
                'bill_no'           => $data['bill_no'] ,
                'bill_shop'         => $data['bill_shop'] ,
                'bill_date'         => $data['bill_date'] ,
                'bill_desc'         => $data['dex_desc'] ,
                'bill_total_amount' => $data['dex_total_amount'] ,
                'bill_type'         => 1
            );
            $this->finance_model->bills();
            $bill_id = $this->finance_model->data_save($data_bill);
            if (!is_int($bill_id)) {
                $insert_ids['bill_id'] = $bill_id;
                $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
                redirect('finance/buy_stock/');
            }
            $insert_ids['bill_id'] = $bill_id;
            // insert TRANSECTION
            $data_trans = array(
                'tr_desc'   => $data['dex_desc'] ,
                'tr_amount' => $data['dex_total_amount'] ,
                'tr_type'   => 'buy_stocks',
                'tr_date'   => $data['bill_date'] ,
                'tr_status' => 2 ,
                'tr_acc_id' => $data['acc_id'] ,
                'bill_id'   => $bill_id
            );
            $this->finance_model->transections();
            $trans_id = $this->finance_model->data_save($data_trans);
            if (!is_int($trans_id)) {
                $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
                redirect('finance/buy_stock/');
            }
            $insert_ids['trans_id'] = $trans_id;
            // update ACCOUNT
            $this->finance_model->accounts();
            $acc_id = $this->finance_model->data_save(['acc_amount' => $data['acc_amount']], $data['acc_id']);
            if (!is_int($acc_id)) {
                $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
                redirect('finance/buy_stock/');
            }
            $insert_ids['acc_id'] = $acc_id;
            $this->session->set_userdata('insert_ids', $insert_ids);
            // insert DEX
            $data_dex = array(
                'dex_name'          => $data['st_unit_name'] ,
                'dex_st_unit'       => $data['st_id'] ,
                'dex_price'         => $data['dex_price'] ,
                'dex_count'         => $data['dex_count'],
                'dex_unit'          => $data['dex_unit_id'] ,
                'dex_total_amount'  => $data['dex_total_amount']  ,
                'dex_bill_id'       => $this->session->insert_ids['bill_id'],
                'dex_tr_id'         => $trans_id
            );

            $this->finance_model->stock_units();
            $stock = $this->finance_model->data_get($data['st_id']);
            $this->finance_model->data_save(['st_price' =>$data['dex_price'], 'st_count' => $stock->st_count + $data['dex_count']], $data['st_id'] );

            $this->finance_model->expences();
            $dex_id = $this->finance_model->data_save($data_dex);
            if (!is_int($dex_id)) {
                $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
                redirect('finance/buy_stock/');
            }
        }
        else
        {
            $data['dex_sum'] += $this->input->post('dex_sum');
            // update BILL
            $this->finance_model->bills();
            $transection = $this->finance_model->data_get($this->session->insert_ids['bill_id'], TRUE);
            $bill_total_amount = $transection->bill_total_amount + $data['dex_total_amount'];
            $bill_id = $this->finance_model->data_save(['bill_total_amount' => $bill_total_amount], $this->session->insert_ids['bill_id']);
            if (!is_int($bill_id)) {

                $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
                redirect('finance/buy_stock/');
            }
            // update TRANS
            $this->finance_model->transections();
            $transection = $this->finance_model->data_get($this->session->insert_ids['trans_id'], TRUE);
            $tr_amount = $transection->tr_amount + $data['dex_total_amount'];
            $trans_id = $this->finance_model->data_save(['tr_amount' => $tr_amount], $this->session->insert_ids['trans_id']);
            if (!is_int($trans_id)) {
                $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
                redirect('finance/buy_stock/');
            }
            // update ACCOUNT
            $this->finance_model->accounts();
            $acc_id = $this->finance_model->data_save(['acc_amount' => $data['acc_amount']], $data['acc_id']);
            if (!is_int($acc_id)) {
                $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
                redirect('finance/buy_stock/');
            }
            // insert DEX
            $data_dex = array(
                'dex_name'          => $data['st_unit_name'] ,
                'dex_st_unit'       => $data['st_id'] ,
                'dex_price'         => $data['dex_price'] ,
                'dex_count'         => $data['dex_count'],
                'dex_unit'          => $data['dex_unit_id'] ,
                'dex_total_amount'  => $data['dex_total_amount']  ,
                'dex_bill_id'       => $this->session->insert_ids['bill_id'],
                'dex_tr_id'         => $this->session->insert_ids['trans_id']
            );

            $this->finance_model->stock_units();
            $stock = $this->finance_model->data_get($data['st_id']);
            $this->finance_model->data_save(['st_price' =>$data['dex_price'], 'st_count' => $stock->st_count + $data['dex_count']], $data['st_id'] );

            $this->finance_model->expences();
            $dex_id = $this->finance_model->data_save($data_dex);
            if (!is_int($dex_id)) {
                $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
                redirect('finance/buy_stock/');
            }
        }

        $this->session->set_userdata('bill_info', $data);
        $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
        redirect('finance/buy_stock');
    } // end insert_stock_expence

    public function insert_stock_pay_transection()
    {
        $data = $this->input->post();
        print_r($data);

        $data['tr_type'] = 'buy_stock';
        $data['tr_status'] = 1;

        $this->finance_model->transections();
        $tr_id = $this->finance_model->data_save($data);

        if (is_int($tr_id)) {
            $this->finance_model->accounts();
            $account = $this->finance_model->data_get($data['tr_acc_id'], true);

            $new_amount = $account->acc_amount + $data['tr_amount'];
            $this->finance_model->data_save(['acc_amount' => $new_amount], $data['tr_acc_id']);
            $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
            $this->end_buy();
        } else {
            $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
            redirect('finance/buy_stock/');
        }

    }

    public function end_buy()
    {
        $this->session->unset_userdata('bill_info');
        $this->session->unset_userdata('insert_ids');
        redirect('finance/expences/1');
    }

    public function salary_payment()
    {
        $this->template->description = 'پرداخت معاش کارمندان';
//        $this->template->menu1 = 'menu1_expences';
        $this->template->menu1 = 'menu1_salary_payment';

        $this->finance_model->employees();
        $employees = $this->finance_model->data_get();

        // view
        $this->template->content->view('finance/salary_payment', ['employees' => $employees]);
        $this->template->publish();
    } // end salary_payment

    public function insert_salary()
    {
        // print_r(base_account()->acc_id); die();
        // print_r($this->input->post()); die();

        $data = $this->input->post();
        $this->finance_model->salary();
        $new = current(explode('-', $this->input->post('sal_date')))+1;
        $old = current(explode('-', $this->input->post('sal_date')))-1;
        // check emp for this month of salary
        $emp_sal = $this->finance_model->data_get_by(
            ['sal_emp_id' => $this->input->post('sal_emp_id'),
             'sal_date <' =>  $new."-0-0",
             'sal_date >' => $old."-0-0",
             'sal_month' => $this->input->post('sal_month')],
             TRUE
            );
        if ($emp_sal) {
            $this->session->set_flashdata('form_warning', 'معاش کارمند برای این برج پرداخت شده است. درصورتی که معاش کارمند مورد نظر باقیمانده است از لیست کارمندان، باقیمانده معاش را بپردازید.');
            redirect('finance/salary_payment/');
         }

        // insert salary
        $this->finance_model->salary();
        $sal_id = $this->finance_model->data_save($data);
        if (is_int($sal_id))
        {
            $this->finance_model->transections();
            $trans_data = array(
                'tr_desc'   => $data['sal_desc'],
                'tr_amount' => $data['sal_amount'],
                'tr_type'   => 'salary',
                'tr_date'   => $data['sal_date'],
                'tr_status' => 2,
                'tr_acc_id' => base_account()->acc_id,
                'tr_sal_id' => $sal_id,
                );
            $trnas_id = $this->finance_model->data_save($trans_data);
            if (is_int($trnas_id))
            {
                $this->finance_model->accounts();
                $acc_remain_amount = base_account()->acc_amount - $data['sal_amount'];
                $acc_id = $this->finance_model->data_save(['acc_amount' => $acc_remain_amount], base_account()->acc_id);
                if (is_int($acc_id))
                {
                    $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
                    redirect('finance/salary_payment/');
                }
            }
        }
        $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
        redirect('finance/salary_payment/');
    } // end insert_salary


    public function pay_salary()
    {
        $this->template->description = 'پرداخت باقیمانده معاش کارمند';
        // $date[0] ==> year   -|-   $date[0] ==> month
        $date = explode('-', $this->input->post('date'));
        $emp_id = $this->input->post('emp_id');

        $salaries = $this->finance_model->sal_join_trans_join_emp($emp_id, $date[0], $date[1]);
        if(!$salaries){
            $this->session->set_flashdata('form_warning', 'برای کارمند مورد نظر در برج وارد شده معاش پرداخت نشده است.');
            redirect('finance/salary_payment/');
        }

        $this->finance_model->employees();
        $employee = $this->finance_model->data_get($emp_id, TRUE);
        // print_r($emp); die();

        // view
        $this->template->content->view('finance/pay_salary', ['salaries' => $salaries, 'employee' => $employee]);
        $this->template->publish();
    } // end pay_salary

    /**
     * @param $emp_id
     */
    public function salary($emp_id)
    {
        $this->template->description = 'لیست پرداخت معاشات کارمندان';

        $this->finance_model->salary();
        $this->finance_model->data_get_by(['sal_emp_id' => $emp_id], TRUE);
        $employees = $this->finance_model->sal_join_trans_join_emp($emp_id);
        // view
        $this->template->content->view('finance/pay_salary', ['employees' => $employees]);
        $this->template->publish();
    } // end salary

    public function insert_salary_pay()
    {
        $data = $this->input->post();
        $this->finance_model->salary();
        $new = current(explode('-', $this->input->post('sal_date')))+1;
        $old = current(explode('-', $this->input->post('sal_date')))-1;
        // check emp for this month of salary
        $emp_sal = $this->finance_model->data_get_by(
            ['sal_emp_id'   => $data['sal_emp_id'],
             'sal_date <'   =>  $new."-0-0",
             'sal_date >'   => $old."-0-0",
             'sal_month'    => $data['sal_month'] ], true
            );
        if ($emp_sal) {
            // echo $data['sal_remain']; die();
            $amount = $emp_sal->sal_amount + $data['sal_amount'];
            $this->finance_model->data_save(['sal_remain' => $data['sal_remain'], 'sal_amount' => $amount], $emp_sal->sal_id);
            // insert new trnasection
            $this->finance_model->transections();
            $this->finance_model->data_save([
                'tr_desc'   => $data['sal_desc'],
                'tr_amount' => $data['sal_amount'],
                'tr_type'   => 'salary',
                'tr_date'   => $data['sal_date'],
                'tr_status' => 2,
                'tr_acc_id' => base_account()->acc_id,
                'tr_sal_id' => $emp_sal->sal_id
            ]);
            // update base account
            $acc_remain = base_account()->acc_amount - $data['sal_amount'];
            $this->finance_model->accounts();
            $this->finance_model->data_save(['acc_amount' => $acc_remain], base_account()->acc_id);
            // view success
            // view error
            $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
            redirect('finance/salary_payment/');
        }
        else
        {
            $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد. لطفاً دوباره کوشش نمائید');
            redirect('finance/salary_payment/');
        }
    } // end insert_salary_pay

    public function delete_salary()
    {
        $tr_id = $this->input->post('tr_id');
        // get trnasection info
        $this->finance_model->transections();
        $transection = $this->finance_model->data_get($tr_id, TRUE);
        // update base account
        $this->finance_model->accounts();
        $acc_amount = base_account()->acc_amount + $transection->tr_amount;
        $this->finance_model->data_save(['acc_amount' => $acc_amount], base_account()->acc_id);

        $this->finance_model->salary();
        $salary = $this->finance_model->data_get($transection->tr_sal_id);
        $sal_amount = $salary->sal_amount - $transection->tr_amount;
        $sal_remain = $salary->sal_remain + $transection->tr_amount;
        $this->finance_model->data_save(['sal_amount' => $sal_amount, 'sal_remain' => $sal_remain], $transection->tr_sal_id);
        // delete transection row
        $this->finance_model->transections();
        $this->finance_model->data_delete($tr_id);
    }


    /**
     * @param $acc_id
     * @param $part_id
     */
    public function partner_credit_debit($part_id)
    {
        $this->template->description = '  جمع و برداشت در حساب '.$this->session->emp_info->emp_name .' '.$this->session->emp_info->emp_lname;
        $this->template->menu1 = 'menu1_accounts';
        $this->template->menu2 = 'menu2_partner_debit_credit';

        $this->finance_model->partners();
        $partners = $this->finance_model->data_get();
        $partner = $this->finance_model->partner_join_employee($part_id);
        $this->finance_model->transections();
        $transections = $this->finance_model->data_get_by(['tr_part_id'=> $part_id, 'tr_type'=> 'partner_credit_debit']);
        // view
        $this->template->content->view('finance/partner_credit_debit', ['transections' => $transections, 'partner' => $partner, 'partners' => $partners ]);
        $this->template->publish();
    } // end partner_credit_debit

    public function insert_partner_credit_debit()
    {
//        print_r($data = $this->input->post()); die();
        $data = $this->input->post();

        $this->finance_model->transections();
        $tr_id = $this->finance_model->data_save([
            'tr_desc'   => $data['tr_desc'],
            'tr_amount' => $data['part_amount'],
            'tr_type'   => 'partner_credit_debit',
            'tr_date'   => $data['tr_date'],
            'tr_status' => $data['tr_status'],
            'tr_acc_id' => base_account()->acc_id,
            'tr_part_id'=> $data['tr_part_id'],
        ]);
        if (is_int($tr_id))
        {
            $this->finance_model->partners();
            $partner = $this->finance_model->data_get($data['tr_part_id']);

            if ($data['tr_status'] == 1)
            {
                $total_amount = $this->finance_model->total_part_amount()->total_amount + $data['part_amount'];
                $part_amount = $data['part_amount'] + $partner->part_amount;
            }
            else
            {
                $total_amount = $this->finance_model->total_part_amount()->total_amount - $data['part_amount'];
                $part_amount = $partner->part_amount - $data['part_amount'];
            }

            if ($this->input->post('part_persent')) {
                $part_data = array('part_amount' => $part_amount, 'part_persent' => $data['part_persent']);
            }
            else
            {
                $part_data = array('part_amount' => $part_amount);
            }
            $part_id = $this->finance_model->data_save($part_data, $data['tr_part_id']);
            if(is_int($part_id))
            {
                if (!$this->input->post('part_persent'))
                {
                    $partners = $this->finance_model->data_get();
                    foreach ($partners as $part)
                    {
                        $new_persent = $part->part_amount / $total_amount * 100;
                        $this->finance_model->data_save(['part_persent' => $new_persent], $part->part_id);
                    }
                }

                $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
                redirect('finance/partner_credit_debit/'.$data['tr_part_id']);
            }
            else
            {
                $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد. لطفاً دوباره کوشش نمائید');
                redirect('finance/partner_credit_debit/'.$data['tr_part_id']);
            }
        }
        else{
            $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد. لطفاً دوباره کوشش نمائید');
            redirect('finance/partner_credit_debit/'.$data['tr_part_id']);
        }
    }

    public function delete_partner_transection($tr_id, $tr_amount, $tr_status, $part_id, $part_amount, $auto_persentage = null)
    {
        $this->finance_model->transections();
        if ($this->finance_model->data_delete($tr_id))
        {
            if($tr_status == 1)
                $new_tr_amount = $part_amount - $tr_amount;
            else
                $new_tr_amount = $part_amount + $tr_amount;

            $this->finance_model->partners();
            $this->finance_model->data_save(['part_amount' => $new_tr_amount], $part_id);

            if($auto_persentage != null)
            {
                $partners = $this->finance_model->data_get();
                foreach ($partners as $part)
                {
                    $total_amount = $this->finance_model->total_part_amount()->total_amount;
                    $new_persent = $part->part_amount / $total_amount * 100;
                    $this->finance_model->data_save(['part_persent' => $new_persent], $part->part_id);
                }
            }
            $this->session->set_flashdata('form_2_success', 'عملیات با موفقیت انجام شد.');
            redirect('finance/partner_credit_debit/'.$part_id);
        }
    else
        {
            $this->session->set_flashdata('form_2_errors', 'عملیات با موفقیت انجام نشد. لطفاً دوباره کوشش نمائید');
            redirect('finance/partner_credit_debit/'.$part_id);
        }
    }

} // end class