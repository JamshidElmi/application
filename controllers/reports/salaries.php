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

    public function salary_monthly($fisrtdate = NULL, $lastdate = NULL)
    {
        $this->template->description = 'لیست معاشات پرداخت شده';
        if ($fisrtdate != NULL)
        {
            $now = $lastdate;
            $last = $fisrtdate;
        }
        elseif (!$this->input->post('tarikh1'))
        {
            $now = mds_date("Y-m-d", "now");
            $next = explode('-',$now );
            if ($next[1] > 3 )
                $next[1] = $next[1] - 3 ;
            else
                $next[1] = 0;

            $last = $next[0].'-'.$next[1].'-'.$next[2];
        }
        else
        {
            $last = $this->input->post('tarikh1');
            $now = $this->input->post('tarikh2');
        }
        $salaries = $this->report_model->sal_join_trans_join_emp($now,$last);
//        echo $this->db->last_query();


        $this->template->content->view('reports/salaries', ['salaries' => $salaries]);
        $this->template->publish();
    }

    public function print_salaries($now = NULL, $last = NULL)
    {
        $this->template->set_template('print_template');
        $this->salary_monthly($now,$last);
    }

} // end class