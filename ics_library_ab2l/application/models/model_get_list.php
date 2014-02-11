<?php
	class Model_get_list extends CI_Model{
		public function book_reserve($account){
			$sqlQuery = "SELECT GROUP_CONCAT(DISTINCT s.subject SEPARATOR ',') as subject,
							GROUP_CONCAT(DISTINCT a.author SEPARATOR 'and ') as author,
							i.title,i.type,o.date_borrowed,o.due_date,o.status,o.rank
							FROM user_account u, book i,book_reservation o, book_author a, book_subject s, book_call_number cn
							WHERE u.username = '".$account."' 
							AND u.account_number=o.account_number 
							AND o.call_number = cn.call_number
							AND cn.id = i.id
							AND cn.id = a.id
							AND cn.id = s.id
							GROUP BY o.call_number
							HAVING o.status = 'reserved'";
			$query = $this->db->query($sqlQuery);
			
			return $query->result();
		}
		public function book_borrowed($account){
			$sqlQuery = "SELECT GROUP_CONCAT(DISTINCT s.subject SEPARATOR ',') as subject,
							GROUP_CONCAT(DISTINCT a.author SEPARATOR 'and ') as author,
							i.title,i.type,o.date_borrowed,o.due_date,o.date_returned,o.status
							FROM user_account u, book i,book_reservation o, book_author a, book_subject s, book_call_number cn
							WHERE u.username = '".$account."' 
							AND u.account_number=o.account_number 
							AND o.call_number = cn.call_number
							AND cn.id = i.id
							AND cn.id = a.id
							AND cn.id = s.id
							GROUP BY o.call_number
							HAVING o.status = 'borrowed'
							ORDER BY o.date_borrowed";

			$query = $this->db->query($sqlQuery);
			
			return $query->result();
		}


		public function book_overdue($account){
			$sqlQuery = "SELECT GROUP_CONCAT(DISTINCT s.subject SEPARATOR ',') as subject,
							GROUP_CONCAT(DISTINCT a.author SEPARATOR 'and ') as author,
							i.title,i.type,o.date_borrowed,o.due_date,o.date_returned,o.status
							FROM user_account u, book i,book_reservation o, book_author a, book_subject s, book_call_number cn
							WHERE u.username = '".$account."' 
							AND u.account_number=o.account_number 
							AND o.call_number = cn.call_number
							AND cn.id = i.id
							AND cn.id = a.id
							AND cn.id = s.id
							GROUP BY o.call_number
							HAVING o.status = 'overdue'
							ORDER BY o.due_date";

			$query = $this->db->query($sqlQuery);
			
			return $query->result();
		}

		public function book_returned($account){
			$sqlQuery = "SELECT GROUP_CONCAT(DISTINCT s.subject SEPARATOR ',') as subject,
							GROUP_CONCAT(DISTINCT a.author SEPARATOR 'and ') as author,
							i.title,i.type,o.date_borrowed,o.due_date,o.date_returned,o.status
							FROM user_account u, book i,book_reservation o, book_author a, book_subject s, book_call_number cn
							WHERE u.username = '".$account."' 
							AND u.account_number=o.account_number 
							AND o.call_number = cn.call_number
							AND cn.id = i.id
							AND cn.id = a.id
							AND cn.id = s.id
							GROUP BY o.call_number
							HAVING o.status = 'returned'
							ORDER BY o.date_returned";

			$query = $this->db->query($sqlQuery);
			
			return $query->result();
		}

		public function all_books(){
			$sqlQuery = "SELECT GROUP_CONCAT(DISTINCT s.subject SEPARATOR ' / ') as subject,
							GROUP_CONCAT(DISTINCT a.author SEPARATOR ' and ') as author,
							b.title, b.type, b.year_of_pub,b.no_of_available, b.quantity, br.status, cn.call_number
							FROM book b, book_subject s, book_author a, book_reservation br, book_call_number cn
							WHERE b.id = s.id
							AND b.id = a.id
							AND cn.id = b.id
							AND cn.call_number = br.call_number
							GROUP BY b.id";

			$query = $this->db->query($sqlQuery);
			return $query->result();
		}
	}
?> 