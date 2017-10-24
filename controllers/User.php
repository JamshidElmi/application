<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->template->title = 'حساب کاربری';
		$this->load->model('user_model');

	}

    public function index($value='')
    {
        $this->template->description = 'لسیت حساب های کاربری ';
        $users = $this->user_model->join_user_emp();

        $this->template->content->view('users/users',array('users' => $users));
        $this->template->publish();
    }

	public function create()
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
        	redirect('user/create');
        }
        else
        {
        	$this->user_model->data_save($data);
            $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد' );
        	redirect('user/create');
        }
	}

	public function users()
    {
    	echo '<h1>All Users</h1>';
    }

    public function delete()
    {
        $user_id = $this->input->post('user_id');
        $this->user_model->data_delete($user_id);
    }

    public function edit($user_id)
    {
        $user = $this->user_model->data_get($user_id, TRUE);
        $current_pass = $user->user_pass;

        // Check Validation
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_name', 'نام کاربری', 'required|is_unique[users.user_name]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('form_errors', validation_errors() );
            redirect('user/');
        }
        else
        {
            $old_pass = $this->input->post('old_pass');

            if($current_pass != $old_pass)
            {
                $this->session->set_flashdata('form_errors', 'رمز عبور قبلی را درست وارد نکردید، لطفاً دقت نمائید.');
                redirect('user/');
            }
            else
            {
                $data = $this->input->post();
                unset($data['old_pass']);
                $user_new_id = $this->user_model->data_save($data, $user_id);
            }

            if(is_int($user_new_id))
            {
                // Updating Done
                $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
                redirect('user/');
            }
            else
            {
                // Updating Failed
                $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد، لطفاً دوباره سیع نمائید.');
                redirect('user/');
            }
        }


    }

}