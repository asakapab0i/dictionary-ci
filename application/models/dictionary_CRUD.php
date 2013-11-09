<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dictionary_CRUD extends CI_Model {

	/*
	This code generates the index file
	*/

	public function dictionary_get_total_words($letter){

		$query =  $this->db->query("SELECT word.word
                               FROM word
                               WHERE word.word LIKE '$letter%' AND word.popular = '1'
                               ORDER BY word.word");

		return $query->num_rows();

	}

	public function dictionary_get_list_of_words($letter){

		return $this->db->query("SELECT word.word
                               FROM word
                               WHERE word.word LIKE '$letter%' AND word.popular = '1'
                               ORDER BY word.word")->result_array();
		
	}

	public function browse_get_words($letter){
		return $this->db->query("SELECT word FROM word WHERE word LIKE '$letter%'")->result_array();
	}

	public function define_get_define_word($word){
		return $this->db->query("SELECT word.word,
                                        word.id,
                                        example.example,
                                        author.name,
                                        definition.word_id,
                                        definition.example_id,
                                        definition.definition,
                                        definition.id AS defid,
                                        vote.up,
                                        vote.down,
                                        vote.word_id,
                                        author.name,
                                        tag.tag,
                                        DATE_FORMAT(wordmap.date,'%d %W %M %Y') as datew,
                                        wordmap.id AS wordmapid,
                                        author.email
                                        FROM wordmap
                                        INNER JOIN word ON wordmap.word_id = word.id
                                        INNER JOIN author ON wordmap.author_id = author.id
                                        INNER JOIN definition ON wordmap.definition_id = definition.id
                                        INNER JOIN example ON definition.example_id = example.id
                                        INNER JOIN vote ON definition.vote_id = vote.id
                                        INNER JOIN tag ON definition.tag_id = tag.id
                                        WHERE word.word = '$word' ORDER BY defid")->result_array();
	}

	public function permalink_get_define_word($word, $defid){
		return $this->db->query("SELECT word.word,
                                        word.id,
                                        example.example,
                                        author.name,
                                        definition.word_id,
                                        definition.example_id,
                                        definition.definition,
                                        definition.id AS defid,
                                        DATE_FORMAT(wordmap.date,'%d %W %M %Y') as datew,
                                        vote.up,
                                        vote.down,
                                        vote.word_id,
                                        author.name,
                                        tag.tag,
                                        wordmap.id AS wordmapid,
                                        author.email
                                        FROM wordmap
                                        INNER JOIN word ON wordmap.word_id = word.id
                                        INNER JOIN author ON wordmap.author_id = author.id
                                        INNER JOIN definition ON wordmap.definition_id = definition.id
                                        INNER JOIN example ON definition.example_id = example.id
                                        INNER JOIN vote ON definition.vote_id = vote.id
                                        INNER JOIN tag ON definition.tag_id = tag.id
                                        WHERE word.word = '$word' AND definition.id = '$defid'")->result_array();
	}

	public function define_get_define_word_with_id($word, $defid){
		return $this->db->query("SELECT word.word,
                                        word.id,
                                        example.example,
                                        author.name,
                                        definition.word_id,
                                        definition.example_id,
                                        definition.definition,
                                        definition.id AS defid,
                                        DATE_FORMAT(wordmap.date,'%d %W %M %Y') as datew,
                                        vote.up,
                                        vote.down,
                                        vote.word_id,
                                        author.name,
                                        tag.tag,
                                        wordmap.id AS wordmapid,
                                        author.email
                                        FROM wordmap
                                        INNER JOIN word ON wordmap.word_id = word.id
                                        INNER JOIN author ON wordmap.author_id = author.id
                                        INNER JOIN definition ON wordmap.definition_id = definition.id
                                        INNER JOIN example ON definition.example_id = example.id
                                        INNER JOIN vote ON definition.vote_id = vote.id
                                        INNER JOIN tag ON definition.tag_id = tag.id
                                        WHERE word.word = '$word' ORDER BY CASE defid
                                        WHEN '$defid' THEN 0 ELSE 1 END")->result_array();
	}

     public function dictionary_get_generate_tags($word){
          
     }

}