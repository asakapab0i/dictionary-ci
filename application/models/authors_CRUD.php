<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Authors_CRUD extends CI_Model
{
	
	function get_all_authors(){
		$query = $this->db->query("SELECT * FROM author");
		return $query->result_array();
	}

	function get_an_author($author){
		$query = $this->db->query("SELECT word.word,
                                        word.id,
                                        example.example,
                                        author.name,
                                        definition.word_id,
                                        definition.example_id,
                                        definition.definition,
                                        DATE_FORMAT(wordmap.date,'%d %W %M %Y') as datew,
                                        vote.up,
                                        vote.down,
                                        vote.word_id,
                                        author.name,
                                        tag.tag,
                                        author.email
                                        FROM wordmap
                                        INNER JOIN word ON wordmap.word_id = word.id
                                        INNER JOIN author ON wordmap.author_id = author.id
                                        INNER JOIN definition ON wordmap.definition_id = definition.id
                                        INNER JOIN example ON definition.example_id = example.id
                                        INNER JOIN vote ON definition.vote_id = vote.id
                                        INNER JOIN tag ON definition.tag_id = tag.id
                                        WHERE author.name = '$author'
                                        ");
		return $query->result_array();
	}


}