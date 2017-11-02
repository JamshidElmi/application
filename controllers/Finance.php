<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Finance extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->template->title = 'مدیریت مالی';
		$this->load->model('finance_model');
	}

	public function index()
	{

	}

    public function accounts()
    {
        $this->template->description = 'لیست صندوق ها و ایجاد صندوق جدید';
        $accounts = $this->finance_model->data_get();
        // view
        $this->template->content->view('finance/accounts', ['accounts' => $accounts]);
        $this->template->publish();
    } // end accounts

    public function insert_account()
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
                redirect('finance/accounts');
            }
            else
            {
                $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
                redirect('finance/accounts');
            }
        }
    } // insert_account


    public function credit_debit($acc_id)
    {
        $this->template->description = 'برداشت از حساب و جمع در حساب';
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
            $this->session->set_flashdata('form_errors', validation_errors() );
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

    public function expences()
    {
        $this->template->description = 'لیست خریداری و مصارف روزانه';

        // $this->finance_model->expences();
        // $expences = $this->finance_model->get_join_expences();
        $this->finance_model->bills();
        $expences = $this->finance_model->data_get_by(['bill_type'=>0]);
        // view
        $this->template->content->view('finance/expences', ['expences' => $expences, 'expences' => $expences]);
        $this->template->publish();
    } // end expences

    public function new_expence()
    {
        $this->template->description = 'ثبت خریداری و مصارف روزانه';
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
                'bill_type'         => 0
                );
            $this->finance_model->bills();
            $inserted_bill_id = $this->finance_model->data_save($bill_data);

            $row = count($this->input->post('dex_unit'))-1;
            // get account data
            $this->finance_model->accounts();
            $account = $this->finance_model->data_get_by(['acc_type'=>0], TRUE);

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
                    'dex_bill_id'       => $inserted_bill_id
                );

                $result = $this->finance_model->data_save($data);
                if(!is_int($result))
                {
                    $result = null;
                    $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
                    redirect('finance/new_expence/');
                }
            } // end for
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

            // updating account data
            $this->finance_model->accounts();
            $acc_remain = ($account->acc_amount) - ($this->input->post('bill_sum'));
            $this->finance_model->data_save(['acc_amount'=> $acc_remain], $account->acc_id);
            $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
            redirect('finance/new_expence/');
        }

    } // end insert_expence


    public function delete_bill_expence($bill_id,$bill_total_amount)
    {
        $this->finance_model->bills();
        if($this->finance_model->data_delete($bill_id))
        {
            // get current amount of account
            $this->finance_model->accounts();
            $account = $this->finance_model->data_get_by(['acc_type'=> 0], TRUE);
            $new_amount = $account->acc_amount + $bill_total_amount;
            // Set new amount of account
            $acc_inserted = $this->finance_model->data_save(['acc_amount'=>$new_amount],$account->acc_id);
            if (is_int($acc_inserted))
            {
               $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
                redirect('finance/expences/');
            }

        }
        $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
        redirect('finance/expences/');

    } // end delete_bill_expence


    public function edit_daily_expence($dex_id)
    {
        $this->template->description = 'ویرایش خریداری و مصارف ثبت شده';
        $this->finance_model->expences();
        $dex = $this->finance_model->data_get($dex_id, TRUE);
        // view
        $this->template->content->view('finance/edit_expence', ['expence' => $dex]);
        $this->template->publish();

    } // edit_daily_expence

    public function update_expence($dex_id, $bill_id)
    {
        // get current expence
        $this->finance_model->expences();
        $expences = $this->finance_model->data_get($dex_id, TRUE);
        // Update Expence
        $old_amount = $expences->dex_total_amount;
        $this->finance_model->data_save($this->input->post(), $dex_id);
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
        $transection = $this->finance_model->data_get_by(['bill_id' => $bill_id, 'tr_type' => 'daily_expence'], TRUE);
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

    public function bill_details($bill_id)
    {
        $this->template->description = 'لیست جزئیات فاکتور';
        $this->finance_model->expences();
        $expences = $this->finance_model->get_join_expences($bill_id);
        $this->finance_model->bills();
        $bill = $this->finance_model->data_get($bill_id, TRUE);
        // view
        $this->template->content->view('finance/bill_details', ['expences' => $expences, 'bill' => $bill]);
        $this->template->publish();
    }

    public function insert_stock_expence()
    {
        print_r($this->input->post());
    }




} // end class

