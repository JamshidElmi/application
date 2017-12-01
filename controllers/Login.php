<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
        $this->load->model('user_model');
		$this->load->model('employee_model');
	}

    public function index()
    {
        $this->load->view('users/login');
    }

    public function check_login()
    {
        $user_name = $this->input->post('user_name', TRUE);
        $user_pass = $this->input->post('user_pass', TRUE);

        $user = $this->user_model->data_get_by(['user_name'=>$user_name, 'user_pass'=>$user_pass], TRUE);
        if(is_object($user))
        {
            $employee = $this->employee_model->data_get($user->emp_id, TRUE);
            $this->session->set_userdata('user_info', $user);
            $this->session->set_userdata('emp_info', $employee);
            redirect('dashboard/');
        }
        else
        {
            redirect('login/');
        }
    }

}