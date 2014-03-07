<?php
	class Model_get_list extends CI_Model{

	public function select_all_book_info($sort_by,$order_by,$data, $limit,$start){
		if ($sort_by != "author" && $sort_by != "subject")
			$query=$this->db->order_by($sort_by,$order_by)->get('book');

		else if ($sort_by == "author")
			$query = $this->db->query("SELECT DISTINCT b.*
										FROM book b, book_author ba
										WHERE b.id = ba.id
										ORDER BY ba.author $order_by ");

		else if ($sort_by == "subject")
			$query = $this->db->query("SELECT DISTINCT b.*
										FROM book b, book_subject bs
										WHERE b.id = bs.id
										ORDER BY bs.subject $order_by");
		

		if($limit>0){	
			if ($start == NULL)
					$start = 0;

			if ($sort_by != "author" && $sort_by!="subject") 
				$query=$this->db->order_by($sort_by,$order_by)->limit($limit,$start)->get('book');
			
			else if ($sort_by == "author")
				$query = $this->db->query("SELECT DISTINCT b.*
										FROM book b, book_author ba
										WHERE b.id = ba.id
										ORDER BY ba.author $order_by
										LIMIT $start,$limit");
			
			else if ($sort_by == "subject")
				$query = $this->db->query("SELECT DISTINCT b.*
										FROM book b, book_subject bs
										WHERE b.id = bs.id
										ORDER BY bs.subject $order_by
										LIMIT $start,$limit");


		}

		return $query->result();
		
	}


public function select_returned_books($account,$sort_by,$order_by,$data, $limit,$start){
	
	if ($sort_by == "due_date")
			$query= $this->db->query("SELECT *
			FROM book_reservation br, book b, user_account u, book_call_number cn
			WHERE u.username='".$account."' 
			AND br.call_number = cn.call_number
			AND u.account_number = br.account_number
			AND cn.id = b.id
			AND br.status='returned'
			GROUP BY br.call_number
			ORDER BY br.due_date");

	if($limit>0){	
		if ($start == NULL)
				$start = 0;
		if ($sort_by == "due_date")
			$query= $this->db->query("SELECT * FROM book_reservation br, book b, user_account u, book_call_number cn
					WHERE u.username='".$account."' 
					AND br.call_number = cn.call_number
					AND u.account_number = br.account_number
					AND cn.id = b.id
					AND br.status='returned'
					GROUP BY br.call_number
					ORDER BY br.due_date
					LIMIT $start,$limit");
		}
		return $query->result();
}

	
	public function get_book_authors($id){
	 	$query = $this->db->get_where('book_author', array('id' => $id));
		return $query->result();
	}
	
	public function get_book_subjects($id){
		$query = $this->db->get_where('book_subject', array('id' => $id));
		return $query->result();
	}

	public function get_list($account,$status,$data,$limit,$start){
		$query= $this->db->query("SELECT *
		FROM book_reservation br, book b, user_account u, book_call_number cn
		WHERE u.username='".$account."' 
		AND br.call_number = cn.call_number
		AND u.account_number = br.account_number
		AND cn.id = b.id
		AND br.status='".$status."'
		GROUP BY br.call_number
		ORDER BY br.due_date");

		

		return $query->result();
	}

	public function cancel_reservation($res_number){
		$this->db->where('res_number', $res_number);
		$this->db->delete('book_reservation');
	}

	public function update_rank($call_number){
		$this->db->query("UPDATE book_reservation SET  rank = rank-1 WHERE call_number = '".$call_number."' AND rank > 1 AND status = 'reserved' ");
	}

	public function update_available($call_number){
		$this->db->query("UPDATE book a,book_call_number c
							SET a.no_of_available = a.no_of_available + 1
							WHERE c.call_number = '".$call_number."' AND
  							c.id = a.id");

	}

}
	
?> 
