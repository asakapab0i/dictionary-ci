<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_CRUD extends CI_Model{


	public function index_get_data(){
		return $this->db->query("SELECT word.word,
                                        word.id,
                                        example.example,
                                        author.name,
                                        definition.word_id,
                                        definition.example_id,
                                        definition.id AS defid,
                                        definition.definition,
                                        wordoftheday.date as datew,
                                        author.name,
                                        author.email,
                                        wordmap.date
                                        FROM wordmap
                                        INNER JOIN word ON wordmap.word_id = word.id
                                        INNER JOIN author ON wordmap.author_id = author.id
                                        INNER JOIN definition ON wordmap.definition_id = definition.id
                                        INNER JOIN example on definition.example_id = example.id
                                        INNER JOIN wordoftheday ON wordmap.id = wordoftheday.wordmap_id
                                        ORDER BY datew DESC LIMIT 5")->result_array();
	}

	public function index_count_data(){

		
	}

}