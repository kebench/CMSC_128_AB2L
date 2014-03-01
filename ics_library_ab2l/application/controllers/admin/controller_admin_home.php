
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Controller_admin_home extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('admin_model','',TRUE);
        $this->load->helper('url');
        $this->load->library(array('form_validation','session'));
        $this->load->model('model_check_session');
    }

 
    function index() {
        $this->load->helper(array('form','html'));
        if($this->model_check_session->check_admin_session() == TRUE){
            $data['parent'] = "Admin";
            $data['current'] = "Home";
             $this->load->model("model_reservation");
            $data['reserved'] = $this->model_reservation->show_all_user_book_reservation("reserved");
            $data['overdue'] = $this->model_reservation->show_all_user_book_reservation('overdue');
            $this->load->model("model_stat");
            $data['stat'] = $this->model_stat->get_stat();
            $this->load->model('model_users');
            $data['users']=$this->model_users->getPendingUsers();
            
            $this->load->view("admin/view_header",$data);
            $this->load->view("admin/view_aside");
            $this->load->view('admin/view_admin_home', $data);
            $this->load->view("admin/view_footer");
        }
    }
 
}
/* End of file controller_admin_home.php */
/* Location: ./application/controllers/admin/controller_admin_home.php */