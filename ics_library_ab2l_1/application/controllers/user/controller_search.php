<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Controller_search extends CI_Controller {
 
    function index() {
        $this->load->helper(array('form','html'));
        
        $data['titlepage']= "Search Books";
        $this->load->view("user/view_header", $data);
        $this->load->view("user/view_search");
        $this->load->view("user/view_footer");
    }
}
/* End of file home_controller.php */
/* Location: ./application/controllers/user/controller_home.php */