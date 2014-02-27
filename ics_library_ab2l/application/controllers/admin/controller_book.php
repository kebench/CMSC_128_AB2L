<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once("controller_log.php");
class Controller_book extends Controller_log {

	public function index()
	{
		$this->viewBook(null);	
		
	}

	public function viewBook($msg){
		$this->load->model('model_book');
		$data['query'] = $this->model_book->select_all_book_info();
		$data['parent'] = "Books";
    	$data['current'] = "View Books";
    	$data['user'] = $this->session->userdata('logged_in');
    	if($msg != null){
    		if($msg === "edit"){
    			$data['message'] = "You have successfully edited a book";
    		}
    		else if($msg === "delete"){
    			$data['message'] = "You have successfuly deleted a book";
    		}
    	}
    		

    	$this->load->helper(array('form','html'));
	    $this->load->view("admin/view_header",$data);
	    $this->load->view("admin/view_aside");
	    $this->load->view('admin/view_books', $data);
	    $this->load->view("admin/view_footer");
	}
	/*ADD BOOK FUNCTIONS*/
	function add_book(){
		$this->load->view("view_add_book");
	}
	
	public function call_add(){
			$session_user = $this->session->userdata('logged_in')['username'];
			if($this->session->userdata('logged_in_type')!="admin")
            redirect('index.php/user/controller_login', 'refresh');
		if(isset($_POST['submit'])){
			$call_number = $_POST['call_number'];
			$title = htmlspecialchars($_POST['title1']);
			$author = $_POST['author'];
			$subject = $_POST['subject'];
			$year_of_pub = htmlspecialchars($_POST['year_of_pub']);
			$type = htmlspecialchars($_POST['type1']);
			$quantity = sizeof($call_number);
			$no_of_available = $quantity;
			$book_stat = 0;
			
			$this->load->model("model_book");
			$this->model_book->insert_book_info($call_number, $title, $year_of_pub, $type, $no_of_available, $quantity, $book_stat, $author, $subject);
			
			
			$type = "Add Book";
			foreach ($call_number as $value) {
				$message = "Admin $session_user added a new book: $value";
				$this->add_log($message,$type );	
			}
			$this->call_success($title);
		}
	}

	public function call_success($title){
			echo "<script>
				alert('You have successfully add a book');
			</script>";
			redirect('index.php/admin/controller_add_books/add_book/'.$title, 'refresh');
	}
	
	/*UPDATE book*/
	/*UPDATE book*/
	//EDIT
	function edit(){
		$session_user = $this->session->userdata('logged_in')['username'];
		if($this->session->userdata('logged_in_type')!="admin")
            redirect('index.php/user/controller_login', 'refresh');
		$id = $_POST['id'];
		$this->load->model('model_book');
		$book = $this->model_book->get_by_id($id);
		$data['book'] = $book;

		$data['query'] = $this->model_book->select_all_book_info();
		$data['parent'] = "Books";
    	$data['current'] = " Books";
    	$data['user'] = $this->session->userdata('logged_in');

		$this->load->helper(array('form','html'));
		$this->load->view("admin/view_header",$data);
		$this->load->view("admin/view_aside");
		$this->load->view('admin/view_edit_book', $data);
		$this->load->view("admin/view_footer");
	}

	function edit_book(){
		$session_user = $this->session->userdata('logged_in')['username'];
		if($this->session->userdata('logged_in_type')!="admin")
            redirect('index.php/user/controller_login', 'refresh');
		$this->load->model('model_book');
		$id = $this->input->post('call_number1');
		$book = array(
			'title' => $this->input->post('title'),
			'year_of_pub' => $this->input->post('year_of_pub'),
			'no_of_available' => $this->input->post('no_of_available'),
			'type' => $this->input->post('type'),
			'quantity' => $this->input->post('quantity'),
		);
		$call_numbers = $this->input->post('call_number');
		$book_authors = $this->input->post('author');
		$book_subjects = $this->input->post('subject');
		
		$this->model_book->edit_book($id, $book, $call_numbers, $book_authors, $book_subjects);
		$this->add_log("Admin $session_user updated book with ID Number: $id", "Update Book");
		$this->edit_success($book['title']);

	}

	function edit_success($title){
		$session_user = $this->session->userdata('logged_in')['username'];
		$msg = "edit";
		echo "<script>
				alert('You have successfully updated the book $title');
			</script>";
		redirect('index.php/admin/controller_book/viewBook/'.$msg,'refresh');
	}
	
	//DELETE
	function delete(){
		if($this->session->userdata('logged_in_type')!="admin")
            redirect('index.php/user/controller_login', 'refresh');
		$session_user = $this->session->userdata('logged_in')['username'];
		$this->load->model('model_book');
		$call_number = $_POST['id'];
		$this->model_book->delete_book($call_number);
		$this->add_log("$session_user deleted book with Call Number: $call_number", "Delete Book");
		
		$msg = "delete";
		redirect('index.php/admin/controller_book/viewBook/'.$msg, 'refresh');
	}


}
 ?>