<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dictionary extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('dictionary_CRUD');
	}

	public function index(){
		$this->popular('a');
	}	

	public function popular($letter){
		//page info and current nav
		$header['page_title'] = "Dictionary Homepage | Dictionary | Letter $letter";
		$header['main_menu'] = self::main_nav('dictionary/popular/a');
		$header['sub_menu'] = self::sub_nav($letter);
		

		$data['total_words'] = self::popularTotalWords($letter);
		$data['list_of_words'] = self::popularListOfWords($letter);
		$data['letter'] = $letter;

		//load to view
		$this->parser->parse('template/header', $header);
		$this->parser->parse('dictionary/dictionary_view', $data);
		$this->load->view('template/footer.php');
	}

	public function browse($letter){
		$header['page_title'] = "Dictionary Homepage | Browse | Letter $letter";
		$header['main_menu'] = self::main_nav('dictionary/popular/a');
		$header['sub_menu'] = self::sub_nav($letter);
		

		$data['browse_words'] = self::browseWords($letter);

		//load to view
		$this->parser->parse('template/header', $header);
		$this->parser->parse('dictionary/browse_view', $data);
		$this->load->view('template/footer.php');	
	}

	public function define($word, $defid = false){
		$word = urldecode($word);
		$header['page_title'] = "Dictionary Homepage | Define | Word $word";
		$header['main_menu'] = self::main_nav('dictionary/popular/a');
		$header['sub_menu'] = self::sub_nav($word[0]);
		

		if(!$defid){
			$data['define_word'] = self::defineWord($word);
		}else{
			$data['define_word'] = self::defineWordWithDefId($word, $defid);
		}

		$data['tag_generator'] = self::generateTags($word, $defid);

		//load to view
		$this->parser->parse('template/header', $header);
		$this->parser->parse('dictionary/define_view', $data);
		$this->load->view('template/footer.php');	
	}

	public function permalink($word, $defid){
		$word = urldecode($word);
		$header['page_title'] = "Dictionary Homepage | Permalink | Word $word";
		$header['main_menu'] = self::main_nav('dictionary/popular/a');
		$header['sub_menu'] = self::sub_nav($word[0]);
		

		$data['perma_word'] = self::permaWord($word, $defid);
		$data['tag_generator'] = self::generateTags($word, $defid);
		//load to view
		$this->parser->parse('template/header', $header);
		$this->parser->parse('dictionary/perma_view', $data);
		$this->load->view('template/footer.php');	
	}

	/*******************************Class Helpers******************************************/

	/*******************************Dictionary Method*/

	private function popularTotalWords($letter){
		return $this->dictionary_CRUD->dictionary_get_total_words($letter);
	}

	private function popularListOfWords($letter){
		$resultset = $this->dictionary_CRUD->dictionary_get_list_of_words($letter);
		return $resultset;
	}
	/*******************************END Dictionary Method*/

	/*******************************Browse Method*/
	private function browseWords($letter){
		return $this->dictionary_CRUD->browse_get_words($letter);
	}
	/*******************************END Browse Method*/

	/*******************************Define Method*/
	private function defineWord($word){
		$resultset = $this->dictionary_CRUD->define_get_define_word($word);
		return $resultset;
	}
	/*******************************END Define Method*/

	/*******************************Define Method*/
	private function permaWord($word, $defid){
		$resultset = $this->dictionary_CRUD->permalink_get_define_word($word, $defid);
		return $resultset;
	}
	/*******************************END Define Method*/

	/*******************************Define Method*/
	private function defineWordWithDefId($word, $defid){
		$resultset = $this->dictionary_CRUD->define_get_define_word_with_id($word, $defid);
		return $resultset;
	}
	/*******************************END Define Method*/

	private function generateTags($word, $defid = false){


		if($this->uri->segment(2)=='define'){
			if(!$defid){
				$data = self::defineWord($word);
				//var_dump(self::runTagGenerator($data));
				return self::runTagGenerator($data);

			}else{
				$data = self::defineWordWithDefId($word, $defid);
				return self::runTagGenerator($data);
			}
		}else if($this->uri->segment(2)=='permalink'){
			$data = self::permaWord($word, $defid);
			return self::runTagGenerator($data);
		}
	}

	private function runTagGenerator($data){
		foreach ($data as $key => $row) {
					$tags = $row['tag'];
					$tags_array = explode(',', $tags);
					//$result = array();
					foreach ($tags_array as $key => $value) {
						$result[] = array('tags'=>anchor('dictionary/define/'.$value.'', $value, 'class="btn btn-primary custom-list-word"'));
					}

				}

				return $result;

	}

	private function main_nav($current_nav = 'home'){
		//populate navication array
		$navigation = array('home' => 'word of the day','dictionary/popular/a' => 'dictionary','add' => 'add word','authors'=>'authors','tags'=>'tags', 'recent'=>'recent','blog'=>'blog');
		$mainMenu = '';
		foreach ($navigation as $key => $value) {
			if ($current_nav == $key) {
				$mainMenu .= anchor($key, $value,'class="btn btn-default custom-fontSize custom-active"');
			}else{
				$mainMenu .= anchor($key, $value,'class="btn btn-default custom-fontSize"');
			}
		}
		return $mainMenu;
	}

	private function sub_nav($letter = NULL){
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



}