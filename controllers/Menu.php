<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->template->title = 'منو ها';
		$this->load->model('menu_model');
		$this->template->menu = 'menu_menus';
	}

	public function index()
	{

	}

    public function kitchen_menus($bm_id = NULL)
    {
        $this->template->menu1  = 'menu1_kitchen_menus';
        $this->template->menu2 = 'menu2_create_base_menu';
        $this->template->description = 'ثبت منو جدید برای آشپزخانه و لیست منو های موجود ';

        $bm = array();
        $sm = array();
        $this->menu_model->base_menus();
        $base_menus = $this->menu_model->data_get_by(['bm_type' => 0]);
        // get base menu if id came for update
        if ($bm_id != NULL) {
            $sm = $this->menu_model->sub_base_menus($bm_id);

            $this->menu_model->base_menus();
            $bm = $this->menu_model->data_get($bm_id);
        }

        $this->menu_model->sub_menus();
        $sub_menus = $this->menu_model->data_get();


        // view
        $this->template->content->view('menus/kitchen_menus', ['base_menus' => $base_menus, 'bm' => $bm, 'sub_menus' => $sub_menus, 'sm' => $sm]);
        $this->template->publish();
    } // end kitchen_menus

    public function insert_kitchen_menu($bm_id = NULL)
    {
//        echo $row = count($this->input->post('menus'))-1; die();
//         print_r($this->input->post()); die();

//        if(isset($_FILES['bm_picture']['name']))
//            echo "come";
//        else
//            echo "NOT come";
//
//        die();

        $data = $this->input->post();
        $data['bm_type']                = 0;
        $config['upload_path']          = './assets/img/menus';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 250;
        $config['max_width']            = 400;
        $config['max_height']           = 400;

        $this->load->library('upload', $config);

        if(isset($_FILES['bm_picture']['name']))
        {
            if ( ! $this->upload->do_upload('bm_picture'))
            {
                $this->session->set_flashdata('file_errors', $this->upload->display_errors());
                redirect('menu/kitchen_menus');
            }
            else
            {
                // Get file name
                $file = $this->upload->data();
                $file_name = $file['file_name'];
                $data['bm_picture'] = $file_name;
                unset($data['menus']);
//                 print_r($data); die();
                // Inserting data
                $this->menu_model->base_menus();
                if($bm_id == NULL)
                    $insert = $this->menu_model->data_save($data);
                else
                    $insert = $this->menu_model->data_save($data, $bm_id);

                if(is_int($insert))
                {
                    $row = count($this->input->post('menus'))-1;
                    $this->menu_model->sub_base_menu();
                    for($i=0; $i <= $row; $i++)
                    {
                        $data_m = array(
                            'sbm_bm_id'   => $insert,
                            'sbm_sm_id'   => $this->input->post('menus')[$i]
                        );
                        $result = $this->menu_model->data_save($data_m);
                        if(!is_int($result))
                        {
                            $result = null;
                            $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
                            redirect('menu/kitchen_menus');

                        }
                    } // end for
                }
                else
                {
                    $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد، دوباره کوشش نمائید.' );
                    redirect('menu/kitchen_menus');
                }
                $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.' );
                redirect('menu/kitchen_menus');
            }
        }
        else
        {
            // Inserting data
            $this->menu_model->base_menus();
            unset($data['menus']);
            if($bm_id == NULL)
                $insert = $this->menu_model->data_save($data);
            else
                $insert = $this->menu_model->data_save($data, $bm_id);

            if(is_int($insert))
            {
                $row = count($this->input->post('menus'))-1;
                $this->menu_model->sub_base_menu();

                $sbm = $this->menu_model->data_get_by(['sbm_bm_id' => $bm_id]);
                foreach ($sbm as $sub_base_menu)
                {
                    $this->menu_model->data_delete($sub_base_menu->sbm_id);
                }
                for ($i=0; $i <= $row; $i++)
                {

                    $data_m = array(
                        'sbm_bm_id'   => $insert,
                        'sbm_sm_id'   => $this->input->post('menus')[$i]
                    );
                    $result = $this->menu_model->data_save($data_m);
                    if(!is_int($result))
                    {
                        $result = null;
                        $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
                        redirect('menu/kitchen_menus');

                    }
                } // end for
            }
            else
            {
                $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد، دوباره کوشش نمائید.' );
                redirect('menu/kitchen_menus');
            }
            $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.' );
            redirect('menu/kitchen_menus');
        }
    } // end insert_kitchen_menu

    public function delete_bm()
    {
        sleep(1);
        $this->menu_model->base_menus();

        $bm_id = $this->input->post('bm_id');
        $this->menu_model->data_delete($bm_id);

    } // end insert_kitchen_menu

    public function resturant_menus($bm_id = NULL)
    {
        $this->template->menu1 = 'menu1_resturant_menus';
        $this->template->menu2 = 'menu2_create_menu';
        $bm = array();
        $this->template->description = 'ثبت منو جدید برای رستورانت و لیست منو های موجود ';
        // get base menus
        $this->menu_model->base_menus();
        $base_menus = $this->menu_model->data_get_by(['bm_type' => 1]);
        // get base menu if id came for update
        if ($bm_id != NULL) {
            $bm = $this->menu_model->data_get($bm_id);
        }
        // get menu categories
        $this->menu_model->menu_category();
        $menu_cat = $this->menu_model->data_get();
        // view
        $this->template->content->view('menus/resturant_menus', ['base_menus' => $base_menus, 'bm' => $bm, 'menu_cat' => $menu_cat]);
        $this->template->publish();
    } // end kitchen_menus

    public function insert_resturant_menu($bm_id = NULL)
    {
        // print_r($_FILES['bm_picture']['name']); die();

        $data = $this->input->post();
        $data['bm_type']                = 1;
        $config['upload_path']          = './assets/img/menus';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 250;
        $config['max_width']            = 400;
        $config['max_height']           = 400;

        $this->load->library('upload', $config);

        if($_FILES['bm_picture']['name'])
        {
            if ( ! $this->upload->do_upload('bm_picture'))
            {
                $this->session->set_flashdata('file_errors', $this->upload->display_errors());
                redirect('menu/resturant_menus');
            }
            else
            {
                // Get file name
                $file = $this->upload->data();
                $file_name = $file['file_name'];
                $data['bm_picture'] = $file_name;
                // print_r($data); die();
                // Inserting data
                $this->menu_model->base_menus();
                if($bm_id == NULL)
                    $insert = $this->menu_model->data_save($data);
                else
                    $insert = $this->menu_model->data_save($data, $bm_id);

                if(is_int($insert))
                {
                    $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.' );
                    redirect('menu/resturant_menus');
                }
                else
                {
                    $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد، دوباره کوشش نمائید.' );
                    redirect('menu/resturant_menus');
                }
            }
        }
        else
        {
            // Inserting data
            $this->menu_model->base_menus();
            if($bm_id == NULL)
                $insert = $this->menu_model->data_save($data);
            else
                $insert = $this->menu_model->data_save($data, $bm_id);

            if(is_int($insert))
            {
                $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.' );
                redirect('menu/resturant_menus');
            }
            else
            {
                $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد، دوباره کوشش نمائید.' );
                redirect('menu/resturant_menus');
            }
        }
    } // end insert_kitchen_menu

    public function delete_res_bm()
    {
        sleep(1);
        $this->menu_model->base_menus();

        $bm_id = $this->input->post('bm_id');
        $this->menu_model->data_delete($bm_id);

    } // end insert_kitchen_menu

    public function sub_menus()
    {
        $this->template->menu1 = 'menu1_kitchen_menus';
        $this->template->menu2 = 'menu2_create_sub_menu';
        $this->template->description = 'ثبت زیر منوی جدید برای آشپزخانه و لیست زیرمنو های موجود ';
        // get sub menus
        $this->menu_model->sub_menus();
        $sub_menus = $this->menu_model->sub_menu_join_unit();

        // veiw
        $this->template->content->view('menus/kitchen_sub_menus', ['sub_menus' => $sub_menus]);
        $this->template->publish();
    }

    public function insert_sub_menu()
    {
//         print_r($this->input->post()); die();
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

    public function update_sub_menu()
    {
//         print_r($this->input->post()); die();
        $data = $this->input->post();
        unset($data['sm_id']);

        $this->menu_model->sub_menus();
        $insert = $this->menu_model->data_save($data, $this->input->post('sm_id'));
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

    } // end update_sub_menu

    public function delete_sm()
    {
        sleep(1);
        $this->menu_model->sub_menus();
        $this->menu_model->data_delete($this->input->post('sm_id'));
        return ;
    }


    public function show_select2()
    {
        if ($this->input->post()) {
            print_r($this->input->post()); die();
        }
        // veiw
        $this->template->content->view('menus/select2');
        $this->template->publish();
    }



}