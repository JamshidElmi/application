<?php
/**
* MY Base Controller Class
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







    }

    /**
     * Add product to cart
     * @param int $id Product id
     */
    public function my_first_fun($id)
    {
        echo $id;
    }



} // end class
 ?>