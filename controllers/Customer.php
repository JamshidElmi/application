<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->template->title = 'مشتریان';
		$this->load->model('customer_model');
	}

	public function index()
	{
        $this->template->description = 'لیست تمام مشتریان رستورانت و آشپزخانه';
        $employees = $this->employee_model->data_get();

		$this->template->content->view('employees/all_employees', ['employees' => $employees]);
        $this->template->publish();
	}

    public function create()
    {
        $this->template->description = 'ثبت مشتری جدید در سیستم';
        $this->customer_model->accounts();
        $accounts = $this->customer_model->data_get_by(['acc_type' => 2]);
        // view
        $this->template->content->view('customers/create', ['accounts' => $accounts]);
        $this->template->publish();
    }


    public function insert()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('cus_name', 'نام مشتری', 'required|trim');
        $this->form_validation->set_rules('cus_lname', 'تخلص مشتری', 'required|trim');
        $this->form_validation->set_rules('cus_job', 'وظیفه مشتری', 'required');
        $this->form_validation->set_rules('cus_join_date', 'تاریخ ثبت', 'required');
        $this->form_validation->set_rules('cus_org_place', 'سکونت اصلی', 'required');
        $this->form_validation->set_rules('cus_cur_place', 'سکونت فعلی', 'required');
        $this->form_validation->set_rules('cus_address', 'آدرس کامل مشتری', 'required');
        $this->form_validation->set_rules('cus_phones', 'شماره های تماس', 'required');
        // $this->form_validation->set_rules('cus_picture', 'عکس', 'required');
        $this->form_validation->set_rules('cus_email', 'ایمیل آدرس', 'valid_email');
        $this->form_validation->set_rules('cus_biography_no', 'شماره تذکره', 'numeric');

        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('form_errors', validation_errors() );
            redirect('employee/create');
        }
        else
        {
            // print_r($this->input->post()); die();
            // Set data
            $data = $this->input->post();
            if( $_FILES['cus_picture']['name'] )
            {
                $config['upload_path']          = './assets/img/customers';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 250;
                $config['max_width']            = 400;
                $config['max_height']           = 400;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('cus_picture'))
                {
                    $this->session->set_flashdata('file_errors', $this->upload->display_errors());
                    redirect('employee/create');
                }
                else
                {

                    // Get file name
                    $file = $this->upload->data();
                    $file_name = $file['file_name'];
                    $data['cus_picture'] = $file_name;
                    // Inserting data
                    $this->customer_model->data_save($data);
                    $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.' );
                    redirect('customer/create');
                }
            }
            else
            {
                // Inserting data
                $this->customer_model->data_save($data);
                $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.' );
                redirect('customer/create');
            }

        } // validation else
    } // end insert



    public function view($emp_id)
    {
        $this->template->description = 'اطلاعات مشتریان برای چاپ';
        $this->load->model('user_model');

        $employee = $this->employee_model->data_get($emp_id);
        $users = $this->user_model->data_get_by(['emp_id'=>$emp_id]);

        $this->template->content->view('employees/emp_profile', ['employee' => $employee, 'users' => $users]);
        $this->template->publish();
    } // end view

    public function print_profile($emp_id)
    {
        $this->template->set_template('print_template');
        $this->view($emp_id);
    }

    public function edit($emp_id)
    {
        $employee = $this->employee_model->data_get($emp_id, TRUE);
        $this->template->description = 'ویرایش اطلاعات '. $employee->emp_name ." ". $employee->emp_lname;

        $this->template->content->view('employees/edit', ['employee' => $employee]);
        $this->template->publish();
    }

    public function update($emp_id)
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
            if($_FILES['emp_picture']['name'])
            {
                if ( ! $this->upload->do_upload('emp_picture'))
                {
                    $this->session->set_flashdata('file_errors', $this->upload->display_errors());
                    redirect('employee/edit/'.$emp_id);
                }
                else
                {
                    // Get file name
                    $file = $this->upload->data();
                    $file_name = $file['file_name'];
                    // Set data
                    $data = $this->input->post();
                    $data['emp_picture'] = $file_name;
                    // Updating data
                    $this->employee_model->data_save($data, $emp_id);
                    $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.' );
                    redirect('employee/');
                }
            }
            else
            {
                // Remove Picure
                $data = $this->input->post();
                unset($data['emp_picture']);
                // Updating data
                $this->employee_model->data_save($data, $emp_id);
                $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.' );
                redirect('employee/');
            }
        }
    } // end update

    public function delete()
    {
        $emp_id = $this->input->post('emp_id');
        $this->employee_model->data_delete($emp_id);
    }



}