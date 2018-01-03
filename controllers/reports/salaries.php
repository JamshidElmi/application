<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 *create by: Eng-elmi
 *
*/
class salaries extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->template->title = 'گزارشات';
        $this->load->model('customer_model');
    }

    public function salary_monthly()
    {
        echo 'گزارش معاشات';
    }

} // end class