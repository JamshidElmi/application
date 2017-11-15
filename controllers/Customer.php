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
        $customers = $this->customer_model->data_get();

		$this->template->content->view('customers/customers', ['customers' => $customers]);
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
        $this->form_validation->set_rules('cus_unique_id', 'کد مشترک', 'is_unique[customers.cus_unique_id]');
        // $this->form_validation->set_rules('cus_picture', 'عکس', 'required');
        $this->form_validation->set_rules('cus_email', 'ایمیل آدرس', 'valid_email');
        $this->form_validation->set_rules('cus_biography_no', 'شماره تذکره', 'numeric');

        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('form_errors', validation_errors() );
            redirect('customer/create');
        }
        else
        {
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
                    redirect('customer/create');
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
                    redirect('customer/');
                }
            }
            else
            {
                // Inserting data
                $this->customer_model->data_save($data);
                $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.' );
                redirect('customer/');
            }

        } // validation else
    } // end insert



    public function view($cus_id)
    {
        $this->template->description = 'اطلاعات مشتریان برای چاپ';
        // get customer
        $customer = $this->customer_model->data_get($cus_id, TRUE);
        // get account info
        $this->customer_model->accounts();
        $account = $this->customer_model->data_get($customer->cus_acc_id, TRUE);
        // view
        $this->template->content->view('customers/view', ['customer' => $customer, 'account' => $account]);
        $this->template->publish();
    } // end view

    public function print_profile($cus_id)
    {
        $this->template->set_template('print_template');
        $this->view($cus_id);
    }

    public function edit($cus_id)
    {
        // get the customers
        $customer = $this->customer_model->data_get($cus_id, TRUE);
        $this->template->description = 'ویرایش اطلاعات '. $customer->cus_name ." ". $customer->cus_lname;
        // get the accounts
        $this->customer_model->accounts();
        $accounts = $this->customer_model->data_get_by(['acc_type' => 2]);

        $this->template->content->view('customers/edit', ['customer' => $customer, 'accounts' => $accounts]);
        $this->template->publish();
    }

    public function update($cus_id)
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
            redirect('customer/edit/'.$cus_id);
        }
        else
        {
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
                    redirect('customer/edit/'.$cus_id);
                }
                else
                {
                    // Get file name
                    $file = $this->upload->data();
                    $file_name = $file['file_name'];
                    $data['cus_picture'] = $file_name;
                    // Updating data
                    $this->customer_model->data_save($data , $cus_id);
                    $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.' );
                    redirect('customer/');
                }
            }
            else
            {
                // Updating data
                $this->customer_model->data_save($data, $cus_id);
                $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.' );
                redirect('customer/');
            }

        } // validation else
    } // end update

    public function delete()
    {
        sleep(1);
        $cus_id = $this->input->post('cus_id');
        $this->customer_model->data_delete($cus_id);
    }



}