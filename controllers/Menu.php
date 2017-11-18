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
        $base_menus = $this->menu_model->data_get();

        $this->template->content->view('menus/kitchen_menus', ['base_menus' => $base_menus]);
        $this->template->publish();
    } // end kitchen_menus

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
    } // end insert_kitchen_menu


    public function delete_bm()
    {
        sleep(1);
        $this->menu_model->base_menus();

        $bm_id = $this->input->post('bm_id');
        $this->menu_model->data_delete($bm_id);

    } // end insert_kitchen_menu

    public function sub_menus()
    {
        $this->template->description = 'ثبت منو جدید برای آشپزخانه و لیست زیرمنو های موجود ';
        // get base menu
        $this->menu_model->base_menus();
        $base_menus = $this->menu_model->data_get_by(['bm_type' => 0]);
        $sub_menus = $this->menu_model->base_join_sub_menus();

        $this->template->content->view('menus/kitchen_sub_menus', ['base_menus' => $base_menus, 'sub_menus' => $sub_menus]);
        $this->template->publish();
    }

    public function insert_sub_menu()
    {
        // print_r($this->input->post()); die();
        $data = $this->input->post();

        $this->menu_model->sub_menus();
        $insert = $this->menu_model->data_save($data);
        if(is_int($insert))
        {
            $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.' );
            redirect('menu/sub_menus');
        }
        else
        {
            $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد، دوباره کوشش نمائید.' );
            redirect('menu/sub_menus');
        }

    } // end insert_sub_menu

    public function delete_sm()
    {
        sleep(1);
        $this->menu_model->sub_menus();
        $this->menu_model->data_delete($this->input->post('sm_id'));
        return ;

    }



}