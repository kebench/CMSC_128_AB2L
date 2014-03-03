<?php
	class Model_get_list extends CI_Model{

	public function select_all_book_info($sort_by,$order_by,$data, $limit,$start){
		$query=$this->db->order_by($sort_by,$order_by)->get('book');

		if($limit>0){	
			$query=$this->db->order_by($sort_by,$order_by)->limit($limit,$start)->get('book');

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

		if($limit>0){
		$query= $this->db->query("SELECT *
		FROM book_reservation br, book b, user_account u, book_call_number cn
		WHERE u.username='".$account."' 
		AND br.call_number = cn.call_number
		AND u.account_number = br.account_number
		AND cn.id = b.id
		AND br.status='".$status."'
		GROUP BY br.call_number
		ORDER BY br.due_date
		LIMIT ".$limit." OFFSET ".$start." ");

		}



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
