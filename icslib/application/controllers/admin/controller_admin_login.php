

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once("controller_log.php");
class Controller_admin_login extends Controller_log {
	//http://imron02.wordpress.com/2013/06/01/simple-login-using-codeigniter-database/
	function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library(array('form_validation','session'));
    }


    function index(){

        $this->login();
    }
    function login() {
    	if($this->session->userdata('logged_in')){
    		redirect('index.php/admin/controller_admin_home', 'refresh');
			$username = $this->session->userdata('logged_in')['username'];
			$this->add_log("Admin $username logged in.", "Admin Login");
    	}else{
	        $this->load->helper(array('form','html'));
	        $this->load->view('admin/view_login'); //load view for login
    	}
        
       
    }
}
/* End of file controller_admin_login.php */
/* Location: ./application/controllers/admin/controller_admin_login.php */