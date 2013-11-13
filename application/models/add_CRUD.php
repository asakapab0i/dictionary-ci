<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_CRUD extends CI_Model {

	private function check_pname_email($pname, $email){
		$query = $this->db->query("SELECT * FROM author WHERE name = '$pname' AND email = '$email' ");
		return $query->num_rows();
	}

	private function check_pname($pname){
		$query = $this->db->query("SELECT * FROM author WHERE name = '$name'");
		return $query->num_rows();
	}

	private function get_pname($pname){
		$query = $this->db->query("SELECT * FROM author WHERE name = '$name'");
		return $query->result_array();
	}

	private function check_email($email){
		$query = $this->db->query("SELECT * FROM author WHERE email = '$email'");
		return $query->num_rows();
	}

	public function add_to_db($formdata){
		$word = $formdata['word'];
		$definition = $formdata['definition'];
		$example = $formdata['example'];
		$tags = $formdata['tags'];
		$pname = $formdata['pname'];
		$email = $formdata['email'];


		if (self::check_pname_email($pname, $email) == 0) {



		}elseif (self::check_pname_email($pname, $email) == 1){
			self::ifNewPnameAndEmail($formdata);
			return true;
		}

	}

	private function ifOldPnameAndEmail($formdata){

	}

	private function ifNewPnameAndEmail($formdata){
		$word = $formdata['word'];
		$definition = $formdata['definition'];
		$example = $formdata['example'];
		$tags = $formdata['tags'];
		$pname = $formdata['pname'];
		$email = $formdata['email'];

		$this->db->trans_start();
		$query1 = $this->db->query("INSERT INTO word (word)VALUES('$word')");
		$wordid = $this->db->insert_id();
		$query2 = $this->db->query("INSERT INTO vote (word_id) VALUES ('$wordid')");
		$voteid = $this->db->insert_id();
		$query3 = $this->db->query("INSERT INTO example (example) VALUES ('$example')");
		$exampleid = $this->db->insert_id();
		$query4 = $this->db->query("INSERT INTO definition (word_id,definition,example_id,vote_id) VALUES ('$wordid','$definition','$exampleid','$voteid')");
		$definitionid = $this->db->insert_id();
		$query5 = $this->db->query("INSERT INTO tag (definition_id,tag) VALUES ('$definitionid','$tag')");
		$tagid = $this->db->insert_id();
		$query6 = $this->db->query("UPDATE definition SET tag_id = '$tagid' WHERE id = '$definitionid'");
		$query7 = $this->db->query("INSERT INTO wordmap (word_id,author_id,definition_id,date) VALUES ('$wordid','$authorId','$definitionid',now()) ");
		$this->db->trans_complete();
	}


}
