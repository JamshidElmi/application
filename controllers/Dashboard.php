<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->template->title = 'داشبورد';
        $this->template->menu = 'menu_dashboard';

    }

    public function index()
    {
        $this->template->description = 'گزارش از وضعیت فعلی سیستم';
        $this->template->menu1 = 'menu1_resturant';

        $this->template->content->view('dashboard/restaurant');
        $this->template->publish();
    }


} // end class