<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->template->title = 'منو ها';
		$this->load->model('menu_model');
	}

	public function index()
	{

	}

    public function kitchen_menus()
    {
        $this->template->description = 'ثبت منو جدید برای آشپزخانه و لیست منو های موجود ';
        $this->menu_model->base_menus();
        $menus = $this->menu_model->data_get();

        $this->template->content->view('menus/kitchen_menus', ['menus' => $menus]);
        $this->template->publish();
    }

    public function insert_kitchen_menu()
    {
        // print_r($this->input->post()); die();
        $data = $this->input->post();
        $config['upload_path']          = './assets/img/menus';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 250;
        $config['max_width']            = 400;
        $config['max_height']           = 400;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('bm_picture'))
        {
            $this->session->set_flashdata('file_errors', $this->upload->display_errors());
            redirect('menu/kitchen_menus');
        }
        else
        {
            print_r($data);
            // Get file name
            $file = $this->upload->data();
            $file_name = $file['file_name'];
            $data['bm_picture'] = $file_name;
            $data['bm_type'] = 0;
            // Inserting data
            $this->menu_model->base_menus();
            $insert = $this->menu_model->data_save($data);
            if(is_int($insert))
            {
                $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.' );
                redirect('menu/kitchen_menus');
            }
            else
            {
                $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد، دوباره کوشش نمائید.' );
                redirect('menu/kitchen_menus');
            }

        }

    }






}