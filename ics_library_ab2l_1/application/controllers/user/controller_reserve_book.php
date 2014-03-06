<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller_reserve_book extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('model_reserve_book');
	}

	function index(){
		if($this->session->userdata('id') == FALSE){
			redirect('index.php/user/controller_search_book', 'refresh');
		}
		$data['titlepage'] = 'Reservation Page';
		$data['id'] = urldecode($this->session->userdata('id'));
		$row=$this->model_reserve_book->fetch_book($data['id']);
		if($row->num_rows()>0){
			foreach($row->result() as $book_details){
				$data['title'] = $book_details->title;
				$data['year_of_pub'] = $book_details->year_of_pub;
				$data['type'] = $book_details->type;
				$newdata = array();
				$arow = $this->model_reserve_book->fetch_book_author($data['id']);
				//display data from database
				if($arow->num_rows()>0){
					foreach($arow->result() as $abook_details){
						array_push($newdata, $abook_details->author);
					}
				}
				else{}
				$data['author'] = $newdata;	
			}
		}
		$data['borrower'] = $this->session->userdata('logged_in')['username'];
		date_default_timezone_set('Asia/Manila'); // CDT
		$data['date_reserved'] = getdate();
		$data['date_expire'] = $this->model_reserve_book->getExpiration($data['date_reserved']);
		$data['parent'] = "Books";
    	$data['current'] = "Reserve";

        $this->load->helper(array('form','html'));
        $this->load->view("user/view_header",$data);
        $this->load->view("user/view_reserve_book", $data);
        $this->load->view("user/view_footer");
	}

	function verify_login($id){
		$id = urldecode($id);
			$newdata = array(
				'id' => $id
				);
			$this->session->set_userdata($newdata);
			
		if($this->session->userdata('logged_in') == FALSE){
			redirect('index.php/user/controller_login', 'refresh');
		}
		else{
			redirect('index.php/user/controller_reserve_book');
		}
	}

	function confirm_reservation($title){
		if($this->session->userdata('id') != FALSE && $this->session->userdata('logged_in') != FALSE){
			$data['id'] = $this->session->userdata('id');
			$this->session->unset_userdata('id');
			$row = $this->model_reserve_book->fetch_user($this->session->userdata('logged_in')['username']);
			foreach ($row->result() as $value) {
				$data['borrower'] = $value->account_number;
			}
			$num_borrowed = $this->model_reserve_book->fetch_user_reservation($data['borrower'])->num_rows();
			if($num_borrowed < 3){
				$row = $this->model_reserve_book->fetch_book($data['id']);
				if($row->num_rows() == 1){
					foreach ($row->result() as $value) {
						$no_of_available = $value->no_of_available;
					}
				}
				
				if($no_of_available > 0){
					$this->model_reserve_book->add_reservation($data);
					echo "<script>alert('You have successfully reserved a book. Please confirm it to the administrator.');</script>";
					redirect('index.php/user/controller_book/user_reserved_list/'.$title,'refresh');
				}
				else{
					$this->model_reserve_book->waitlist_reservation($data);
					echo "<script>alert('There is not enough number of books available. You are waitlisted.');</script>";
					redirect('index.php/user/controller_book/user_borrowed_list', 'refresh');

				}
			}
			else{
				echo "<script>alert('A user is allowed to borrow at most 3 books');</script>";
					redirect('index.php/user/controller_book/user_borrowed_list', 'refresh');
			}
			
		}
		else{
				$this->session->unset_userdata('id');
				redirect('index.php/user/controller_reserve_book/verify_login', 'refresh');
			
		}
		
	}

	function success($title){
	}
}