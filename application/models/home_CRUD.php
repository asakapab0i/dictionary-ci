<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_CRUD extends CI_Model{


	public function index_get_data($limit = 3, $offset = 1){
		return $this->db->query("SELECT word.word,
                                        word.id,
                                        example.example,
                                        author.name,
                                        definition.word_id,
                                        definition.example_id,
                                        definition.id AS defid,
                                        definition.definition,
                                        DATE_FORMAT(wordoftheday.date,'%d %W %M %Y') as datew,
                                        author.name,
                                        author.email,
                                        wordmap.date
                                        FROM wordmap
                                        INNER JOIN word ON wordmap.word_id = word.id
                                        INNER JOIN author ON wordmap.author_id = author.id
                                        INNER JOIN definition ON wordmap.definition_id = definition.id
                                        INNER JOIN example on definition.example_id = example.id
                                        INNER JOIN wordoftheday ON wordmap.id = wordoftheday.wordmap_id
                                        ORDER BY datew DESC LIMIT $offset,$limit")->result_array();
	}

	public function index_count_data(){

                $query = $this->db->query("SELECT word.word,
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
                                        ORDER BY datew DESC");


                return $query->num_rows();
	}

}