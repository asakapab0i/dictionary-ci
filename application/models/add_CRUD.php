<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_CRUD extends CI_Model {

	public function check_pname_email($pname, $email){
		$query = $this->db->query("SELECT * FROM author WHERE name = '$pname' AND email = '$email' ");
		return $query->num_rows();
	}

	public function check_pname($pname){
		$query = $this->db->query("SELECT * FROM author WHERE name = '$pname'");
		return $query->num_rows();
	}

	public function get_pname($pname){
		$query = $this->db->query("SELECT * FROM author WHERE name = '$pname'");
		return $query->result_array();
	}

	public function check_email($email){
		$query = $this->db->query("SELECT * FROM author WHERE email = '$email'");
		return $query->num_rows();
	}

	public function check_word($word){
		$query = $this->db->query("SELECT * FROM word WHERE word = '$word'");
		return $query;
	}

	public function add_to_db($formdata){
		$word = $formdata['word'];
		$definition = $formdata['definition'];
		$example = $formdata['example'];
		$tags = $formdata['tags'];
		$pname = $formdata['pname'];
		$email = $formdata['email'];


		if (self::check_pname_email($pname, $email) == 0){
			self::ifNewPnameAndEmail($formdata);
			return true;
		}elseif (self::check_pname_email($pname, $email) == 1){
			self::ifOldPnameAndEmail($formdata);
			return true;
		}

	}

	
	private function ifNewPnameAndEmail($formdata){
		$word = $formdata['word'];
		$checkword = self::check_word($formdata['word']);
		$definition = $formdata['definition'];
		$example = $formdata['example'];
		$tags = $formdata['tags'];
		$pname = $formdata['pname'];
		$email = $formdata['email'];


		if ($checkword->num_rows == 1) {
			$row = $checkword->row(); 
			$wordid = $row->id;
			$this->db->trans_start(TRUE);
			$query1 = $this->db->query("INSERT INTO author (name,email,written_article)VALUES('$pname','$email', 0)");
			$pnameid = $this->db->insert_id();
			$query2 = $this->db->query("INSERT INTO vote (word_id, up, down) VALUES ('$wordid', 0, 0)");
			$voteid = $this->db->insert_id();
			$query3 = $this->db->query("INSERT INTO example (example) VALUES ('$example')");
			$exampleid = $this->db->insert_id();
			$query4 = $this->db->query("INSERT INTO definition (word_id,definition,example_id,vote_id, tag_id) VALUES ('$wordid','$definition','$exampleid','$voteid', 0)");
			$definitionid = $this->db->insert_id();
			$query5 = $this->db->query("INSERT INTO tag (definition_id,tag) VALUES ('$definitionid','$tags')");
			$tagid = $this->db->insert_id();
			$query6 = $this->db->query("UPDATE definition SET tag_id = '$tagid' WHERE id = '$definitionid'");
			$query7 = $this->db->query("INSERT INTO wordmap (word_id,author_id,definition_id,date) VALUES ('$wordid','$pnameid','$definitionid',now()) ");
			$this->db->trans_complete();
		}else{	
			$this->db->trans_start(TRUE);
			$query0 = $this->db->query("INSERT INTO author (name,email,written_article)VALUES('$pname','$email', 0)");
			$pnameid = $this->db->insert_id();
			$query1 = $this->db->query("INSERT INTO word (word, popular)VALUES('$word', 0)");
			$wordid = $this->db->insert_id();
			$query2 = $this->db->query("INSERT INTO vote (word_id, up, down) VALUES ('$wordid', 0, 0)");
			$voteid = $this->db->insert_id();
			$query3 = $this->db->query("INSERT INTO example (example) VALUES ('$example')");
			$exampleid = $this->db->insert_id();
			$query4 = $this->db->query("INSERT INTO definition (word_id,definition,example_id,vote_id, tag_id) VALUES ('$wordid','$definition','$exampleid','$voteid', 0)");
			$definitionid = $this->db->insert_id();
			$query5 = $this->db->query("INSERT INTO tag (definition_id,tag) VALUES ('$definitionid','$tags')");
			$tagid = $this->db->insert_id();
			$query6 = $this->db->query("UPDATE definition SET tag_id = '$tagid' WHERE id = '$definitionid'");
			$query7 = $this->db->query("INSERT INTO wordmap (word_id,author_id,definition_id,date) VALUES ('$wordid','$pnameid','$definitionid',now()) ");
			$this->db->trans_complete();
			}
	}

	private function ifOldPnameAndEmail($formdata){
		$word = $formdata['word'];
		$checkword = self::check_word($formdata['word']);
		$definition = $formdata['definition'];
		$example = $formdata['example'];
		$tags = $formdata['tags'];
		$pname = $formdata['pname'];
		$pnameid = self::get_pname_id($formdata['pname']);
		$email = $formdata['email'];


		if ($checkword->num_rows == 1) {
			$row = $checkword->row(); 
			$wordid = $row->id;

			$this->db->trans_start(TRUE);
			$query2 = $this->db->query("INSERT INTO vote (word_id, up, down) VALUES ('$wordid', 0, 0)");
			$voteid = $this->db->insert_id();
			$query3 = $this->db->query("INSERT INTO example (example) VALUES ('$example')");
			$exampleid = $this->db->insert_id();
			$query4 = $this->db->query("INSERT INTO definition (word_id,definition,example_id,vote_id, tag_id) VALUES ('$wordid','$definition','$exampleid','$voteid', 0)");
			$definitionid = $this->db->insert_id();
			$query5 = $this->db->query("INSERT INTO tag (definition_id,tag) VALUES ('$definitionid','$tags')");
			$tagid = $this->db->insert_id();
			$query6 = $this->db->query("UPDATE definition SET tag_id = '$tagid' WHERE id = '$definitionid'");
			$query7 = $this->db->query("INSERT INTO wordmap (word_id,author_id,definition_id,date) VALUES ('$wordid','$pnameid','$definitionid',now()) ");
			$this->db->trans_complete();

		}else{	
			$this->db->trans_start(TRUE);
			$query1 = $this->db->query("INSERT INTO word (word, popular)VALUES('$word', 0)");
			$wordid = $this->db->insert_id();
			$query2 = $this->db->query("INSERT INTO vote (word_id, up, down) VALUES ('$wordid', 0, 0)");
			$voteid = $this->db->insert_id();
			$query3 = $this->db->query("INSERT INTO example (example) VALUES ('$example')");
			$exampleid = $this->db->insert_id();
			$query4 = $this->db->query("INSERT INTO definition (word_id,definition,example_id,vote_id, tag_id) VALUES ('$wordid','$definition','$exampleid','$voteid', 0)");
			$definitionid = $this->db->insert_id();
			$query5 = $this->db->query("INSERT INTO tag (definition_id,tag) VALUES ('$definitionid','$tags')");
			$tagid = $this->db->insert_id();
			$query6 = $this->db->query("UPDATE definition SET tag_id = '$tagid' WHERE id = '$definitionid'");
			$query7 = $this->db->query("INSERT INTO wordmap (word_id,author_id,definition_id,date) VALUES ('$wordid','$pnameid','$definitionid',now()) ");
			$this->db->trans_complete();
			}
	}

	private function get_pname_id($pname){
		$this->db->select('*')->from('author')->where('name', $pname);
		$query = $this->db->get();
		$result = $query->result_array();

		foreach ($result as $key => $row) {
			$pname_id = $row['id'];
		}
		return $pname_id;
	}
}
