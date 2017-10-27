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

        $account = $this->finance_model->data_save($this->input->post());
        if ($account) {
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