<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * create by: Eng-elmi
 *
*/
class salaries extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->template->title = 'گزارشات';
        $this->load->model('report_model');
    }

    public function salary_monthly()
    {
        $this->template->description = 'لیست معاشات پرداخت شده';
        $employees = $this->employee_model->data_get();

        $this->template->content->view('employees/all_employees', ['employees' => $employees]);
        $this->template->publish();
    }

} // end class