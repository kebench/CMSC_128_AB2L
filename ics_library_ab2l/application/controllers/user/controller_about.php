<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Controller_about extends CI_Controller {
 
    function index() {
        $this->load->helper(array('form','html'));
        $this->load->view("user/view_about");
        
    }
}
/* End of file home_controller.php */
/* Location: ./application/controllers/user/controller_home.php */