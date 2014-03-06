<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Controller_add_user extends CI_Controller {

    public function __construct()
    {
      parent::__construct();
      $this->load->model('model_register');
      $this->load->model('model_check_session');
    }
 
    function index() {
    	$data['parent'] = "Users";
    	$data['current'] = "Add Users";

    		$this->load->helper(array('form','html'));
	        $this->load->view("admin/view_header",$data);
	        $this->load->view("admin/view_aside");
	        $this->load->view("admin/view_add_user");
	        $this->load->view("admin/view_footer");
    }
	
	public function alpha_space($str){
       $this->form_validation->set_message('alpha_space', 'Invalid input.');
      return(! preg_match("/^([-a-z\ \-])+$/i", $str))? FALSE: TRUE;

    }

    public function registration()
    {
          if($this->model_check_session->check_admin_session() == TRUE){
            if($this->session->userdata('logged_in_type')!="admin")
              redirect('index.php/user/controller_login', 'refresh');
            $this->load->library('form_validation');
            // field name, error message, validation rules
           $this->form_validation->set_rules('fname', 'First Name', 'trim|required|callback_alpha_space|xss_clean');
          $this->form_validation->set_rules('minit', 'Middle Initial', 'trim|required|xss_clean');
          $this->form_validation->set_rules('lname', 'Last Name', 'trim|required|callback_alpha_space|xss_clean');

           $this->form_validation->set_rules('stdNum', 'Student Number', 'trim|required|min_length[10]|max_length[32]|alpha_dash|xss_clean');
          $this->form_validation->set_rules('college', 'College', 'trim|min_length[2]|alpha|xss_clean');
          $this->form_validation->set_rules('course', 'Course', 'trim|min_length[3]|xss_clean');
          $this->form_validation->set_rules('classi', 'Classification', 'trim|alpha|xss_clean');
          
          $this->form_validation->set_rules('eadd', 'Your Email', 'trim|required|valid_email');

          $this->form_validation->set_rules('uname', 'Username', 'trim|required|min_length[4]|xss_clean|callback_usernameRegex');
          $this->form_validation->set_rules('pass', 'Password', 'trim|required|min_length[5]|max_length[32]|alpha_numeric');
          $this->form_validation->set_rules('cpass', 'Password Confirmation', 'trim|required|matches[pass]');


            if($this->form_validation->run() == FALSE)
            {
             $data['msg'] = validation_errors();
             $this->success($data); 
            }
            else
            {
              $this->model_register->add_user();
              $data['msg'] = "You successfully registered an account. You may proceed to ICS library to activate it! ";
              $this->success($data);
            }
          }
    }

     public function username_Regex($username){
        if (preg_match('/^[A-Za-z][A-Za-z0-9._]{4,20}$/', $username) ) {
            return TRUE;
          } else {
            return FALSE;
            $this->form_validation->set_message('username_Regex', 'Invalid input.');
          }
    }

    function success($data) {

        $data['parent'] = "Users";
        $data['current'] = "Add Users";

            $this->load->helper(array('form','html'));
            $this->load->view("admin/view_header",$data);
            $this->load->view("admin/view_aside");
            $this->load->view("admin/view_add_user",$data);
            $this->load->view("admin/view_footer");
    }
}
/* End of file home_controller.php */
/* Location: ./application/controllers/user/controller_home.php */

