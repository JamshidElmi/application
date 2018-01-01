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



} // end class
 ?>