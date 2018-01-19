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
    public $all_orders  = '';
    public $all_order_count  = 0;
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
        // check the order notificatuions
        $this->load->model('order_model');
        $date = mds_date("Y-m-d", "now", 1);
        $time = (new \DateTime())->format('H:i:00');
        $notifications = $this->order_model->count_order_notifications($date, $time);
        //$this->order_count = count($notifications);
        $this->order_list = $notifications;

        foreach($this->order_list as $orders)
        {
            if ($orders->ord_time >= $time)
            {
                $this->order_count++;
            }
        }

        $all_notifications = $this->order_model->all_order_notifications($date, $time);
        $this->all_orders = $all_notifications;

        foreach($this->all_orders as $orders)
        {
            if ($orders->ord_time >= $time)
            {
                $this->all_order_count++;
            }
        }

    }

    /**
     * Add product to cart
     * @param int $id Product id
     */
    public function check_session()
    {
        if(!isset($this->session->emp_info))
        {
            redirect('login/');
        }
    }

    // public function count_order_notifications()
    // {

    // }



} // end class
 ?>