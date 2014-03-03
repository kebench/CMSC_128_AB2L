<?php
class Controller_reservation extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index(){
		//$this->load->view('view_admin_home');
		$this->get_All();
		//$this->send_email();
	}//END OF index()

	/*Function to show all borrowed book information stored in the database */
	public function get_All(){
		$this->load->model('model_reservation');
		$data['query'] = $this->model_reservation->show_all_user_book_reservation('borrowed');
		$data['overdue'] = $this->model_reservation->show_all_user_book_reservation('overdue');
		$data['parent'] = "Books";
    	$data['current'] = "View Borrowed Books";

    		 $this->load->helper(array('form','html'));
	        $this->load->view("admin/view_header",$data);
	        $this->load->view("admin/view_aside");
	        $this->load->view('admin/view_reserved_books', $data);	
	        $this->load->view("admin/view_footer");
		
	}//END OF get_All()
	
	public function extend(){
		if($this->session->userdata('logged_in_type')!="admin")
            redirect('index.php/user/controller_login', 'refresh');
        $res_number=$_POST['res_number'];
        $this->load->model('model_reservation');
        $this->model_reservation->update_book_reservation($res_number, "extend");
        redirect('index.php/admin/controller_reservation','refresh');
    }//END OF extend()


}
?>
