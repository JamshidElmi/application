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

        $this->template->content->view('finance/accounts', ['accounts' => $accounts]);
        $this->template->publish();
    }

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
        $transections = $this->finance_model->data_get_by(['tr_acc_id'=> $acc_id]);

        $this->template->content->view('finance/credit_debit', ['account' => $account, 'transections' => $transections ]);
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
    }

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
    }

    public function expences()
    {
        $this->template->description = 'لیست خریداری و مصارف روزانه';

        $this->finance_model->expences();
        $expences = $this->finance_model->get_join_expences();

        $this->template->content->view('finance/expences', ['expences' => $expences]);
        $this->template->publish();
    }

    public function new_expence()
    {
        $this->template->description = 'ثبت خریداری و مصارف روزانه';
        // get current amount of main account
        $this->finance_model->accounts();
        $account = $this->finance_model->data_get_by(['acc_type' => 0] , TRUE);
        $this->finance_model->units();
        $units = $this->finance_model->data_get_by(['unit_type' => 0] );

        $this->template->content->view('finance/new_expence', ['acc_amount' => $account->acc_amount, 'units' => $units]);
        $this->template->publish();
    }


    public function insert_expence()
    {
        print_r($this->input->post());
    }





}