<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->template->title = 'تنظیمات';
		$this->load->model('setting_model');
	}

	public function index()
	{

	}


    public function units()
    {
        $this->template->description = 'لیست واحدات مقیاسی';
        $units_resturant = $this->setting_model->data_get_by(['unit_type'=>1]);
        $units_coock = $this->setting_model->data_get_by(['unit_type'=>0]);

        $this->template->content->view('settings/units', ['units_resturant' => $units_resturant, 'units_coock' => $units_coock]);
        $this->template->publish();
    }

    public function jobs()
    {
        $this->template->description = 'لیست وظایف ثبت شده در سیستم و ایجاد وظیفه جدید';
        $this->setting_model->_table_name = 'jobs';
        $this->setting_model->_primary_key = 'job_id';
        $this->setting_model->_order_by = 'job_id';

        $jobs = $this->setting_model->data_get();

        $this->template->content->view('settings/jobs', ['jobs' => $jobs]);
        $this->template->publish();
    }

    public function delete_unit()
    {
        $unit_id = $this->input->post('unit_id');
        $this->setting_model->data_delete($unit_id);
    }

    public function delete_job()
    {
        $this->setting_model->_table_name = 'jobs';
        $this->setting_model->_primary_key = 'job_id';
        $this->setting_model->_order_by = 'job_id';

        $job_id = $this->input->post('job_id');
        $this->setting_model->data_delete($job_id);
    }

    public function insert_unit()
    {
        $unit = $this->setting_model->data_save($this->input->post());
        if ($unit) {
            $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
            redirect('setting/units','refresh');
        }
        else
        {
            $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
            redirect('setting/units','refresh');
        }
    }

    public function insert_job()
    {
        $this->setting_model->_table_name = 'jobs';
        $this->setting_model->_primary_key = 'job_id';
        $this->setting_model->_order_by = 'job_id';

        $unit = $this->setting_model->data_save($this->input->post());
        if ($unit) {
            $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
            redirect('setting/jobs');
        }
        else
        {
            $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
            redirect('setting/jobs');
        }
    }




}