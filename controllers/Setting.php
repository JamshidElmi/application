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
    } // end units

    public function jobs()
    {
        $this->template->description = 'لیست وظایف ثبت شده در سیستم و ایجاد وظیفه جدید';
        $this->setting_model->jobs();

        $jobs = $this->setting_model->data_get();

        $this->template->content->view('settings/jobs', ['jobs' => $jobs]);
        $this->template->publish();
    } // end jobs

    public function delete_unit()
    {
        $unit_id = $this->input->post('unit_id');
        $this->setting_model->data_delete($unit_id);
    } // end delete_unit

    public function delete_job()
    {
        $this->setting_model->jobs();

        $job_id = $this->input->post('job_id');
        $this->setting_model->data_delete($job_id);
    } // end delete_job

    public function insert_unit()
    {
        $unit = $this->setting_model->data_save($this->input->post());
        if ($unit) {
            $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
            redirect('setting/units');
        }
        else
        {
            $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
            redirect('setting/units');
        }
    } // end insert_unit

    public function insert_job()
    {
        $this->setting_model->jobs();

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
    } // end insert_job

    public function stock_units()
    {
        $this->template->description = 'لیست واحد اجناس گدام';
        $this->setting_model->stock_units();
        $units = $this->setting_model->data_get();

        $this->template->content->view('settings/stock_units', ['units' => $units]);
        $this->template->publish();
    } // end stock_units

    public function insert_stock_unit()
    {
        $this->setting_model->stock_units();
        $data = $this->input->post();
        // check if ID is come DO update else insert
        if ($this->input->post('st_id')) {
            $unit = $this->setting_model->data_save($data, $this->input->post('st_id'));
        }else {
            unset($data['st_id']);
            $unit = $this->setting_model->data_save(($data));
        }
        if ($unit) {
            $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
            redirect('setting/stock_units');
        }
        else
        {
            $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
            redirect('setting/stock_units');
        }
    } // end insert_stock_unit

    public function delete_stock_unit()
    {
        sleep(1);
        $this->setting_model->stock_units();

        $unit_id = $this->input->post('unit_id');
        $this->setting_model->data_delete($unit_id);
    }


    public function menu_category()
    {
        $this->template->description = 'لیست نوعیت منو برای رستورانت';
        $this->setting_model->menu_category();
        $menu_categories = $this->setting_model->data_get();

        $this->template->content->view('settings/menu_category', ['menu_categories' => $menu_categories]);
        $this->template->publish();
    } // end units

    public function insert_menu_cat()
    {
        $this->setting_model->menu_category();
        $unit = $this->setting_model->data_save($this->input->post());
        if ($unit) {
            $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
            redirect('setting/menu_category');
        }
        else
        {
            $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
            redirect('setting/menu_category');
        }
    }

    public function delete_mc()
    {
        sleep(1);
        $this->setting_model->menu_category();

        $mc_id = $this->input->post('mc_id');
        $this->setting_model->data_delete($mc_id);
    }






}