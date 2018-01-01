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
            $partner = $this->user_model->emp_join_partner($user->emp_id);
            $this->user_model->company_info();
            $general_info = $this->user_model->data_get(1, TRUE);

            $this->session->set_userdata('user_info', $user);
            $this->session->set_userdata('emp_info', $employee);
            $this->session->set_userdata('partner_id', $partner->part_id);
            $this->session->set_userdata('general_info', $general_info);
            redirect('dashboard/');
        }
        else
        {
            redirect('login/');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy('user_info', 'emp_info', 'partner_id', 'general_info');
        redirect('login/');
    }

} // end class