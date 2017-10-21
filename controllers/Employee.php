<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->template->title = 'کارمندان';
		$this->load->model('employee_model');
	}

	public function index()
	{
        $this->template->description = 'لیست تمام کارمندان رستورانت و آشپزخانه';

        $employees = $this->employee_model->data_get();

		$this->template->content->view('employees/all_employees', ['employees' => $employees]);
        $this->template->publish();
	}

    public function view($emp_id)
    {
        echo '<h1>emp Profile</h1>';
    }

    public function edit($emp_id)
    {
        echo '<h1>emp edit </h1>';
    }

    public function delete()
    {
        $emp_id = $this->input->post('emp_id');
        $this->employee_model->data_delete($emp_id);

    }




}