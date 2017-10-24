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

    public function create()
    {
        $this->template->description = 'استخدام کارمند جدید در سیستم';
        $this->template->content->view('employees/create');
        $this->template->publish();
    }

    public function insert()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('emp_name', 'نام کارمند', 'required|trim');
        $this->form_validation->set_rules('emp_lname', 'تخلص کارمند', 'required|trim');
        $this->form_validation->set_rules('emp_position', 'پست', 'required');
        $this->form_validation->set_rules('emp_salary', 'معاش کارمند', 'required|numeric');
        $this->form_validation->set_rules('emp_join_date', 'تاریخ استخدام', 'required');
        $this->form_validation->set_rules('emp_org_place', 'سکونت اصلی', 'required');
        $this->form_validation->set_rules('emp_cur_place', 'سکونت فعلی', 'required');
        $this->form_validation->set_rules('emp_address', 'آدرس کامل کارمند', 'required');
        $this->form_validation->set_rules('emp_phone', 'شماره تماس', 'required|numeric');
        // $this->form_validation->set_rules('emp_picture', 'عکس', 'required');
        $this->form_validation->set_rules('emp_email', 'ایمیل آدرس', 'valid_email');
        $this->form_validation->set_rules('emp_biography_no', 'شماره تذکره', 'numeric');

        $config['upload_path']          = './assets/img/profiles';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 250;
        $config['max_width']            = 400;
        $config['max_height']           = 400;

        $this->load->library('upload', $config);

        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('form_errors', validation_errors() );
            redirect('employee/create');
        }
        else
        {


            if ( ! $this->upload->do_upload('emp_picture'))
            {
                $this->session->set_flashdata('file_errors', $this->upload->display_errors());
                redirect('employee/create');
            }
            else
            {
                // Get file name
                $file = $this->upload->data();
                $file_name = $file['file_name'];
                // Set data
                $data = $this->input->post();
                $data['emp_picture'] = $file_name;
                // Inserting data
                $this->employee_model->data_save($data);
                $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.' );
                redirect('employee/');
            }


        }






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