<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Controller_home extends CI_Controller {
 
    function index() {
        $this->load->helper(array('form','html'));
        
        $data['titlepage']= "ICS Library Home";
        $this->load->view("user/view_header", $data);

        $this->load->view("user/view_home");
        $this->load->view("user/view_footer");
    }
}
/* End of file home_controller.php */
/* Location: ./application/controllers/user/controller_home.php */