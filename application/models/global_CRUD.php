<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Global_CRUD extends CI_Model {

	  public function side_bar_get_words_up($word){
          $word = $this->db->escape_str($word);
          $limit = 11;
          return $query = $this->db->query("SELECT * FROM word WHERE word < '$word' ORDER BY word DESC LIMIT $limit")->result_array();
     }

     public function side_bar_get_words_current($word){
          $word = $this->db->escape_str($word);
          $limit = 11;
          return $query = $this->db->query("SELECT * FROM word WHERE word = '$word' ORDER BY word LIMIT $limit")->result_array();
     }

     public function side_bar_get_words_down($word){
          $word = $this->db->escape_str($word);
          $limit = 11;
          return $query = $this->db->query("SELECT * FROM word WHERE word > '$word' ORDER BY word ASC LIMIT $limit")->result_array();
     }
}
	/*
	This code generates the index file
	*/
