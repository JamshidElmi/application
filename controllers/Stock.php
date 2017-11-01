<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->template->title = 'گدام';
		$this->load->model('stock_model');
	}

	public function index()
	{

	}






}