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

    public function delete_account()
    {
        $unit_id = $this->input->post('unit_id');
        $this->setting_model->data_delete($unit_id);
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
                $this->finance_model->data_save(['tr_amount'=> $tr_amount,'tr_status' =>1,'tr_desc' => 'مقدار اولیه', 'tr_acc_id'=>$account, 'tr_date'=>$tr_date], $acc_id);

                $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
                redirect('finance/accounts');
            }
            else
            {
                $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
                redirect('finance/accounts');
            }
        }

    }


    public function credit_debit($acc_id)
    {
        $this->template->description = 'برداشت از حساب و جمع در حساب';
        $account = $this->finance_model->data_get($acc_id, TRUE);
        $this->finance_model->transections();
        $transections = $this->finance_model->data_get_by(['tr_acc_id'=> $acc_id]);

        $this->template->content->view('finance/credit_debit', ['account' => $account, 'transections' => $transections ]);
        $this->template->publish();
    }

    public function insert_credit_debit()
    {
        $acc_id = $this->input->post('tr_acc_id');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('tr_amount', 'مقدار جدید', 'required|numeric');
        $this->form_validation->set_rules('tr_desc', 'توضیحات / یادداشت', 'required');
        $this->form_validation->set_rules('tr_status', 'نوعیت عملیات', 'required|in_list[1,0]');
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('form_errors', validation_errors() );
            redirect('finance/credit_debit/'.$acc_id);
        }
        else
        {
            $this->finance_model->transections();

            $transection = $this->finance_model->data_save($this->input->post());
            if ($transection) {
                $this->finance_model->_table_name = 'accounts';
                $this->finance_model->_primary_key = 'acc_id';
                $this->finance_model->_order_by = 'acc_id';
                $acc_info = $this->finance_model->data_get($acc_id, TRUE);
                $acc_new_amount = $this->input->post('tr_amount');
                if($this->input->post('tr_status') == 0)
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
    }




}