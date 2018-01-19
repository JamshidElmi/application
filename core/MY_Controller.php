<?php
/**
 * MY Base Controller Class
 * The base Controller for all controllers
 * Created by PhpStorm.
 * User: Jamshid Elmi
 * Date: 1/21/2017
 * Time: 8:11 PM
*/

/**
 * Class Cart
 * @property MY_Controller $cart Cart module
 */
class MY_Controller extends CI_Controller
{
    public $order_count = 0;
    public $order_list  = '';
    public $stock_count  = 0;
    public $stock_list  = '';
    /**
     * MY_Controller constructor.
     */
    function __construct()
    {
        parent::__construct();

        /*load language file*/
        // $this->lang->load('dari_lang', 'dari');

        // Check User Is LogIn
        $this->check_session();
        // Orders Notification Alert
        $this->load->model('order_model');
        $date = mds_date("Y-m-d", "now", 1);
        $time = (new \DateTime())->format('H:i:00');
        $notifications = $this->order_model->count_order_notifications($date, $time);
        $this->order_list = $notifications;

        foreach($this->order_list as $orders)
        {
            if($date == $orders->ord_date)
            {
                if ($orders->ord_time >= $time)
                {
                    $this->order_count++;
                }
            }
            else
            {
                $this->order_count++;
            }
        }

        // Stock Notification Alert
        $stock_list = $this->order_model->count_stock_notifications();
        $this->stock_count = count($stock_list);
        $this->stock_list = $stock_list;



    }

    /**
     * Login Redirection
     *
     */
    public function check_session()
    {
        if(!isset($this->session->emp_info))
        {
            redirect('login/');
        }
    }



} // end class
 ?>