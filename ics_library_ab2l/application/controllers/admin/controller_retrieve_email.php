<?php
	if($this->model_check_session->check_admin_session() == TRUE){
		if($this->session->userdata('logged_in_type')!="admin")
			redirect('index.php/user/controller_login', 'refresh');
		$txt_file = file_get_contents('./application/third_party/e99b386ab2e00f9ad17b.txt');
		$rows = explode("\n", $txt_file);
		$email = $rows[0];
		$password =  $rows[1];
	}
?>