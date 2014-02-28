<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class controller_editprofile extends CI_Controller {
 

    public function __construct(){
            parent::__construct();
            $this->load->helper('url');
            $this->load->model('model_viewUser');
             $this->load->model('user_model');
              $this->load->model('model_check_session');
        }

    function index() {
        $this->load->helper(array('form','html'));

        if($this->session->userdata('logged_in')){
               

       if($this->model_check_session->check_session() == TRUE){

               $data['username']= $this->session->userdata('logged_in')['username'];
                $data['start']= "true";
                //get the details of the user
               $user_details = $this->model_viewUser->get_info($data['username']);
             //  var_dump($user_details[0]['classification']);

               foreach ($user_details as $user) {
                  $data['user_details']=$user;
                  break;
               }

            $data['name']= $data['user_details']->first_name." ".$data['user_details']->middle_initial.". ". $data['user_details']->last_name;
              $data['titlepage']= $data['name'];
        }
        else
             redirect('index.php/user/controller_login', 'refresh');
       

      
        $this->load->view("user/view_header",$data);
        if($this->session->userdata('logged_in')){
                $this->load->view("user/view_profile",$data);
        }
        else
             redirect('index.php/user/controller_login', 'refresh');
        $this->load->view("user/view_navigation");
        $this->load->view("user/view_logged_in");
  
        $this->load->view("user/view_footer");
    }
}

    public function viewInfo($number){
            //$data['title']= 'Home';
           
            $value['info'] = $this->modelviewUser->getInfo($number);
            $this->load->view('viewAccount',$value);
        }


    public function check_username( $username){
            $this->db->where('username',$username);
            $query = $this->db->get('user_account')->num_rows();
            if($query == 0 ){
                    $this->db->where('username',$username);
                    $query = $this->db->get('admin_account')->num_rows();
                     if($query == 0 )
                       echo 'userOk';
                     else echo 'userNo';
              }
            else echo 'userNo';
            
    }

    public function edit_username(){
        $this->load->library('form_validation');
        $old_username= $this->session->userdata('logged_in')['username'];
        $this->form_validation->set_rules('new_username', 'Username', 'trim|required|min_length[3]|callback_usernameRegex|xss_clean');
        $this->form_validation->set_rules('pword_for_username', 'Password', 'trim|required|min_length[5]|max_length[32]|alpha_numeric|callback_check_database');
       
        //check if the password is right
        if($this->form_validation->run() == FALSE) {
           
            $var = validation_errors();
            $this->session->set_flashdata('error_username1', $var);
             $this->session->set_flashdata('error_username','error');
            redirect('index.php/user/controller_editprofile', 'refresh');

            
            } 
        else {
                //Go to private area
            //update username

            $username= $this->session->userdata('logged_in')['username'];
            $new_username = $this->input->post('new_username');
            $update_result=$this->user_model->update_username($username, $new_username); 
            if($update_result){
                $old_session =  $this->session->userdata('logged_in');
                unset($old_session['username']);
                $new_array = array('username'=> $new_username);
                $old_session=array_merge($old_session, $new_array);
                $this->session->set_userdata('logged_in', $old_session);
               
            }
            else{
                $this->form_validation->set_message('check_database', 'Username already taken.');
                
            }


           if($this->session->userdata('logged_in_type')=="user"){
            if($this->session->userdata('id')){
              redirect('index.php/user/controller_reserve_book');
            }
            else{ 
                $this->session->set_flashdata('success_username', 'Successfully edited your username.');
                redirect('index.php/user/controller_editprofile', 'refresh');
                
                }
            }
           else redirect('index.php/admin/controller_admin_home', 'refresh');
        }   

    }

    public function check_database($password){
        $this->load->model("user_model");
        $username= $this->session->userdata('logged_in')['username'];
        $new_username = $this->input->post('new_username');
        $result= $this->check_password($username,$password);
        if($result== true){
           return true;
            
        }
        else{

            $this->form_validation->set_message('check_database', 'Wrong password.');
            return false;
        }

    }

    public function check_password($username, $password){
        $this->db->select('username, password');
        $this->db->from('user_account');
        $this->db->where('username', $username);
        $this->db->where('password', sha1($password));
        $this->db->limit(1);
         
        //get query and processing
        $query = $this->db->get();
        if($query->num_rows() == 1) { 
            return true; //if data is true
        } else {
            return false; //if data is wrong
        }
    }

    public function username_Regex($username){
        if (preg_match('/^[A-Za-z][A-Za-z0-9._]{2,20}$/', $username) ) {
            return TRUE;
          } else {
            return FALSE;
            $this->form_validation->set_message('username_Regex', 'Invalid input.');
          }
    }


}
/* End of file controller_editprofile.php */
/* Location: ./application/controllers/user/controller_editprofile.php */