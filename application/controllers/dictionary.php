<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dictionary extends CI_Controller{

	

	public function __construct(){
		parent::__construct();
		$this->load->model('dictionary_CRUD');
	}

	public function index(){
		$this->popular('a');
	}	

	public function popular($letter = 'a'){
		$letter = urlencode($letter);

		//generate random words
		if($this->uri->segment(3) == 'random'){
			//generate random number
			$rand_num = self::random_number();
			$rand_num =  rand(1, $rand_num);
			$dictionary = self::random_word($rand_num);
			
			foreach ($dictionary as $key => $row) {
				$word = $row['word'];
			}

			if(!self::checkWord($word)){

				redirect('dictionary/popular/random/', 'refresh');
			}

			//get the data from that random number

			redirect('dictionary/define/'.$word.'', 'refresh');
		}

		//page info and current nav
		$global = self::load_global_class();
		$header['page_title'] = "Dictionary | Letter ".strtoupper($letter);
		$header['main_menu'] = $global->main_nav('dictionary/popular/a');
		$header['sub_menu'] = $global->sub_nav(strtolower($letter));
		$header['word'] = '';
		

		$data['total_words'] = self::popularTotalWords($letter);
		$data['list_of_words'] = self::popularListOfWords($letter);
		$data['letter'] = $letter;

		//load to view
		$this->parser->parse('template/header', $header);
		$this->parser->parse('dictionary/dictionary_view', $data);
		$this->load->view('template/footer.php');
	}

	public function browse($letter){
		$global = self::load_global_class();
		$header['page_title'] = "Browse | Letter " . strtoupper($letter);
		$header['main_menu'] = $global->main_nav('dictionary/popular/a');
		$header['sub_menu'] = $global->sub_nav(strtolower($letter));
		$header['word'] = '';
		

		$data['browse_words'] = self::browseWords($letter);

		//load to view
		$this->parser->parse('template/header', $header);
		$this->parser->parse('dictionary/browse_view', $data);
		$this->load->view('template/footer.php');	
	}

	public function define($word = NULL, $defid = NULL){
		$global = self::load_global_class();
		$word = urldecode($word);
		$header['page_title'] = "Define | $word";
		$header['main_menu'] = $global->main_nav('dictionary/popular/a');
		$header['sub_menu'] = $global->sub_nav(strtolower($word[0]));
		$header['word'] = $word;
		
		
		
		if(!$defid){
			if (!self::checkWord($word)) {
				 redirect('dictionary/undefined/'.$word.' ', 'refresh');
			}else{
				$data['define_word'] = self::defineWord($word);
				$data['tag_generator'] = self::generateTags($word);
				$data['sidebar_words_up'] = $global->sidebarUp($word);
				$data['sidebar_words_current'] = $global->sidebarCurrent($word);
				$data['sidebar_words_down'] = $global->sidebarDown($word);
			}
			
		}else{
			if (!self::checkWord($word)) {
				 redirect('dictionary/undefined/'.$word.' ', 'refresh');
			}else{
				$data['define_word'] = self::defineWordWithDefId($word, $defid);
				$data['tag_generator'] = self::generateTags($word, $defid);
				$data['sidebar_words_up'] = $global->sidebarUp($word);
				$data['sidebar_words_current'] = $global->sidebarCurrent($word);
				$data['sidebar_words_down'] = $global->sidebarDown($word);
			}
			
		}

		

		//load to view
		//$this->parser->parse('template/sidebar', $sidebar);
		$this->parser->parse('template/header', $header);
		$this->parser->parse('dictionary/define_view', $data);
		$this->load->view('template/footer.php');	
	}

	public function permalink($word, $defid){
		$word = urldecode($word);
		$global = self::load_global_class();
		$header['page_title'] = "Permalink | $word";
		$header['main_menu'] = $global->main_nav('dictionary/popular/a');
		$header['sub_menu'] = $global->sub_nav(strtolower($word[0]));
		$header['word'] = $word;
		

		$data['perma_word'] = self::permaWord($word, $defid);
		$data['tag_generator'] = self::generateTags($word, $defid);
	

		$data['sidebar_words_up'] = $global->sidebarUp($word);
		$data['sidebar_words_current'] = $global->sidebarCurrent($word);
		$data['sidebar_words_down'] = $global->sidebarDown($word);
		
		//load to view
		$this->parser->parse('template/header', $header);
		$this->parser->parse('dictionary/perma_view', $data);
		$this->load->view('template/footer.php');	
	}

	public function undefined($word = ''){
		
		if ($word == '') {
			 redirect('dictionary/popular/random', 'refresh');
		}		

		$word = urldecode($word);
		$global = self::load_global_class();
		$header['page_title'] = "Undefined | Word $word";
		$header['main_menu'] = $global->main_nav('dictionary/popular/a');
		$header['sub_menu'] = $global->sub_nav(strtolower($word[0]));

		$data['word'] = $word;

		//load to view
		$this->parser->parse('template/header', $header);
		$this->parser->parse('dictionary/undefined_view', $data);
		$this->load->view('template/footer.php');
	}

	/*******************************Class Helpers******************************************/
	private function load_global_class(){
		//include and initialized global class
		include 'global_class.php';
		$global = new Global_class();
		return $global;
	}
	/*******************************Dictionary Method*/

	private function checkWord($word, $defid = false){
		$resultset = $this->dictionary_CRUD->dictionary_get_num_rows($word);
		
		if ($resultset > 0) {
			return true;
		}else{
			return false;
		}
	}

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

	/*******************************Random Method*/
	private function random_number(){
		$resultset = $this->dictionary_CRUD->random_get_total_words();
		return $resultset;
	}

	private function random_word($rand_num){
		$resultset = $this->dictionary_CRUD->random_get_random_word($rand_num);
		return $resultset;
	}
	/*******************************END Random Method*/

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


}