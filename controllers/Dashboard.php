<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->template->title = 'داشبورد';

	}

    public function index()
    {
        $this->template->description = 'گزارش از وضعیت فعلی سیستم';

        $this->template->content->view('dashboard/restaurant');
        $this->template->publish();
    }


} // end class