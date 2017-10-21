<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->template->title = 'حساب کاربری';
		$this->load->model('user_model');

	}

	public function index()
	{
        $this->template->description = 'ایجاد حساب کاربری جدید';
        $employees = $this->user_model->get_employees();

		$this->template->content->view('users/new_user_form',array('employees' => $employees));
        $this->template->publish();
	}

	public function insert()
	{

		$this->load->library('form_validation');
		$this->form_validation->set_rules('user_name', 'نام کاربری', 'required|is_unique[users.user_name]');
		$this->form_validation->set_rules('user_pass', 'رمز عبور', 'required|min_length[5]');
		$this->form_validation->set_rules('confirm_pass', 'تائید رمز عبور', 'required|matches[user_pass]');
		$this->form_validation->set_rules('emp_id', 'انتخاب کارمند', 'required');

		$data = $this->input->post();
		unset($data['confirm_pass']);

		if ($this->form_validation->run() == FALSE)
        {
        	$this->session->set_flashdata('form_errors', validation_errors() );
        	$this->index();
        }
        else
        {
        	$this->user_model->data_save($data);
            $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد' );
        	$this->index();
        }
	}

	public function users()
    {
    	echo '<h1>All Users</h1>';
    }
}