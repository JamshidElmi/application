<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->template->title = 'تنظیمات';
        $this->load->model('setting_model');
    }

    public function index()
    {

    }


    public function units()
    {
        $this->template->description = 'لیست واحدات مقیاسی';
        $units_resturant = $this->setting_model->data_get_by(['unit_type' => 1]);
        $units_coock = $this->setting_model->data_get_by(['unit_type' => 0]);

        $this->template->content->view('settings/units', ['units_resturant' => $units_resturant, 'units_coock' => $units_coock]);
        $this->template->publish();
    } // end units

    public function jobs()
    {
        $this->template->description = 'لیست وظایف ثبت شده در سیستم و ایجاد وظیفه جدید';
        $this->setting_model->jobs();

        $jobs = $this->setting_model->data_get();

        $this->template->content->view('settings/jobs', ['jobs' => $jobs]);
        $this->template->publish();
    } // end jobs

    public function delete_unit()
    {
        $unit_id = $this->input->post('unit_id');
        $this->setting_model->data_delete($unit_id);
    } // end delete_unit

    public function delete_job()
    {
        $this->setting_model->jobs();

        $job_id = $this->input->post('job_id');
        $this->setting_model->data_delete($job_id);
    } // end delete_job

    public function insert_unit()
    {
        $unit = $this->setting_model->data_save($this->input->post());
        if ($unit) {
            $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
            redirect('setting/units');
        } else {
            $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
            redirect('setting/units');
        }
    } // end insert_unit

    public function insert_job()
    {
        $this->setting_model->jobs();

        $unit = $this->setting_model->data_save($this->input->post());
        if ($unit) {
            $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
            redirect('setting/jobs');
        } else {
            $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
            redirect('setting/jobs');
        }
    } // end insert_job

    public function stock_units()
    {
        $this->template->description = 'لیست واحد اجناس گدام';
        $this->setting_model->stock_units();
        $units = $this->setting_model->data_get();

        $this->template->content->view('settings/stock_units', ['units' => $units]);
        $this->template->publish();
    } // end stock_units

    public function insert_stock_unit()
    {
        $this->setting_model->stock_units();
        $data = $this->input->post();
        // check if ID is come DO update else insert
        if ($this->input->post('st_id')) {
            $unit = $this->setting_model->data_save($data, $this->input->post('st_id'));
        } else {
            unset($data['st_id']);
            $unit = $this->setting_model->data_save(($data));
        }
        if ($unit) {
            $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
            redirect('setting/stock_units');
        } else {
            $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
            redirect('setting/stock_units');
        }
    } // end insert_stock_unit

    public function delete_stock_unit()
    {
        sleep(1);
        $this->setting_model->stock_units();

        $unit_id = $this->input->post('unit_id');
        $this->setting_model->data_delete($unit_id);
    } // end delete_stock_unit


    public function menu_category()
    {
        $this->template->description = 'لیست نوعیت منو برای رستورانت';
        $this->setting_model->menu_category();
        $menu_categories = $this->setting_model->data_get();

        $this->template->content->view('settings/menu_category', ['menu_categories' => $menu_categories]);
        $this->template->publish();
    } // end menu_category

    public function insert_menu_cat()
    {
        $this->setting_model->menu_category();
        $unit = $this->setting_model->data_save($this->input->post());
        if ($unit) {
            $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
            redirect('setting/menu_category');
        } else {
            $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
            redirect('setting/menu_category');
        }
    } // end insert_menu_cat

    public function delete_mc()
    {
        sleep(1);
        $this->setting_model->menu_category();

        $mc_id = $this->input->post('mc_id');
        $this->setting_model->data_delete($mc_id);
    }

    public function discounts()
    {
        $this->template->description = 'ثبت تخفیف جدید و لیست تخفیفات ثبت شده در سیستم';
        $this->setting_model->discounts();
        $discounts = $this->setting_model->data_get();
        // view
        $this->template->content->view('settings/discounts', ['discounts' => $discounts]);
        $this->template->publish();
    } // end discounts

    public function save_discount()
    {
        $data = $this->input->post();
        if ($this->input->post('disc_id'))
        {
            // Update disc
            $this->setting_model->discounts();
            unset($data['disc_id']);
            $disc = $this->setting_model->data_save($data, $this->input->post('disc_id'));
            if (is_int($disc)) {
                $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
                redirect('setting/discounts');
            } else {
                $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
                redirect('setting/discounts');
            }
        }
        else
        {
            // Insert disc
            $this->setting_model->discounts();
            $disc = $this->setting_model->data_save($data);
            if (is_int($disc)) {
                $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
                redirect('setting/discounts');
            } else {
                $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
                redirect('setting/discounts');
            }
        }
    } // end save_discount

    public function delete_disc()
    {
        sleep(1);
        $this->setting_model->discounts();

        $disc_id = $this->input->post('disc_id');
        $this->setting_model->data_delete($disc_id);
    } // end  delete_disc


    public function desks()
    {
        $this->template->description = 'ایجاد میز جدید و لیست میز های موجود در رستورانت';
        $this->setting_model->desks();
        $desks = $this->setting_model->data_get();
        // view
        $this->template->content->view('settings/desks', ['desks' => $desks]);
        $this->template->publish();
    } // end desks

    public function save_desk()
    {
        $data = $this->input->post();
        if ($this->input->post('desk_id')) {
            // Update Desk
            $this->setting_model->desks();
            unset($data['desk_id']);
            $desk = $this->setting_model->data_save($data, $this->input->post('desk_id'));
            if (is_int($desk)) {
                $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
                redirect('setting/desks');
            } else {
                $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
                redirect('setting/desks');
            }
        } else {
            // Insert Desk
            $this->setting_model->desks();
            $desk = $this->setting_model->data_save($data);
            if (is_int($desk)) {
                $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
                redirect('setting/desks');
            } else {
                $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
                redirect('setting/desks');
            }
        }
    } // end save_desk

    public function delete_desk()
    {
        sleep(1);
        $this->setting_model->desks();

        $desk_id = $this->input->post('desk_id');
        $this->setting_model->data_delete($desk_id);
    } // end  delete_desk

    public function partners()
    {
        $this->template->description = 'ثبت نام سهامداران';
        $partners = $this->setting_model->partner_join_emp();
        $this->setting_model->employees();
        $employees = $this->setting_model->data_get();
        // view
        $this->template->content->view('settings/partners', ['employees' => $employees, 'partners' => $partners]);
        $this->template->publish();
    }// end partners

    public function insert_partner()
    {
        $this->setting_model->partners();

        if ($this->setting_model->data_save($this->input->post()))
        {
            $this->session->set_flashdata('form_success', 'عملیات با موفقیت انجام شد.');
            redirect('setting/partners');
        } else {
            $this->session->set_flashdata('form_errors', 'عملیات با موفقیت انجام نشد دوباره کوشش نمائید.');
            redirect('setting/partners');
        }
    }

}