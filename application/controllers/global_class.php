<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
*Contains all the global functions in the entire website 
*/
class Global_class extends CI_Controller
{	
	public function __construct(){
		parent::__construct();
		$this->load->model('global_CRUD');
	}

	public function main_nav($current_nav = 'home'){
		//populate navigation array
		$navigation = array('home' => array('word of the day', 'glyphicon glyphicon-bookmark'),
							'dictionary/popular/a' => array('dictionary', 'glyphicon glyphicon-book'),
							'add' => array('add word', 'glyphicon glyphicon-plus'),
							'authors' => array('authors', 'glyphicon glyphicon-user'),
							'tags'=> array('tags', 'glyphicon glyphicon-tags'), 
							'recent'=> array('recent', 'glyphicon glyphicon-time'),
							'blog'=> array('blog', 'glyphicon glyphicon-fire')
							);
		$mainMenu = '';
		foreach ($navigation as $key => $value) {
			if ($current_nav == $key) {
				$mainMenu .= anchor($key, '<span class="'.$value[1].'"></span> '.$value[0],'class="btn btn-default custom-fontSize custom-active"');
			}else{
				$mainMenu .= anchor($key, '<span class="'.$value[1].'"></span> '.$value[0],'class="btn btn-default custom-fontSize"');
			}
		}
		return $mainMenu;
	}

	public function sub_nav($letter = 'aa'){
		//populate letters
		$letters = range('a', 'z');
		array_unshift($letters,'random');
		$subMenu = '';
		foreach ($letters as $key => $value) {
			if ($value == $letter) {
				$subMenu .= anchor('dictionary/popular/'.$value.'', $value,'class="btn btn-default custom-active"');
			}else{
				$subMenu .= anchor('dictionary/popular/'.$value.'', $value, 'class="btn btn-default"');
			}
		}

		return $subMenu;
	
	}


	//sidebar
	public function sidebarUp($word){
		$resultset = $this->global_CRUD->side_bar_get_words_up($word);
		//var_dump($resultset);
		return array_reverse($resultset);


	}

	public function sidebarCurrent($word){
			$resultset = $this->global_CRUD->side_bar_get_words_current($word);
			//var_dump($resultset);
		return $resultset;


	}

	public function sidebarDown($word){
		$resultset = $this->global_CRUD->side_bar_get_words_down($word);
		//var_dump($resultset);
		return $resultset;


	}

	//search

	public function search_term(){
		$term = $this->input->post('term');
		redirect('dictionary/define/'.$term.'', 'refresh');
	}


}
