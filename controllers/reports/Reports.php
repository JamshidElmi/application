<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * create by: Eng-elmi
 *
*/
class Reports extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->template->title = 'گزارشات';
        $this->load->model('report_model');
    }

    public function resturant_order_report_list($firstDate = NULL, $lastDate = NULL)
    {
        $this->template->description = 'لیست سفارشات رستورانت';

        if ($firstDate != NULL)
        {
            $firstdate = $firstDate;
            $lastdate  = $lastDate;
        }
        elseif ($this->input->post('tarikh1'))
        {
            $firstdate = $this->input->post('tarikh1');
            $lastdate = $this->input->post('tarikh2');
        }
        else
        {
            $lastdate  = mds_date("Y-m-d", "now");
            $next = explode('-',$lastdate );
            $firstdate = $next[0].'-01-01';
        }

        $orders = $this->report_model->order_join_customer_by_date('resturant',$firstdate,$lastdate);

        //view
        $this->template->content->view('reports/resturant_orders', ['orders' => $orders]);
        $this->template->publish();
    }

    public function print_resturant_order_report_list($firstDate = NULL, $lastDate = NULL)
    {
        $this->template->set_template('print_template');
        $this->resturant_order_report_list();
    }

} // end class