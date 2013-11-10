<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		//loads the home model in the entire class
		parent::__construct();
		$this->load->model('home_CRUD');
	}

	public function index(){
		$this->page();
	}

	public function page(){
		//page info and current nav
		$header['page_title'] = "Homepage | Word of the day";
		$header['main_menu'] = self::main_nav();
		$header['sub_menu'] = self::sub_nav();
		//get words from data

		//array('words' => array('word' => 'ambot', 'name' => 'jay'));
		//self::get_words();

		$limit = 3;

		$data['words'] = self::get_words($limit, $this->uri->segment(3));
		//$data['tag_generator'] = self::generateTags($limit, $this->uri->segment(3));

		//$data['sample'] = 
		//pagination call
		$data['pagination_links'] = self::pagination_link();
		//load to view
		$this->parser->parse('template/header', $header);
		$this->parser->parse('home/home_view', $data);
		$this->load->view('template/footer.php');
	}

/*******************************Class Helpers******************************************/

	// private function generateTags($limit = 1, $uri){

	
	// 	$data = self::get_words($limit, $uri);
	// 	return self::runTagGenerator($data);
	// }

	// private function runTagGenerator($data){
	// 		foreach ($data as $key => $row) {
	// 				$tags = $row['tag'];
	// 				$tags_array = explode(',', $tags);
	// 				//$result = array();
	// 				foreach ($tags_array as $key => $value) {
	// 					$result[] = array('tags'=>anchor('dictionary/define/'.$value.'', $value, 'class="btn btn-primary custom-list-word"'));
	// 				}

	// 			}
				
	// 			return $result;
	// }

	private function get_words($limit, $offset){
		//fixed stubborn bug
		if($offset < 1){
			$offset = 1;
		}else{
			$offset = $this->uri->segment(3);
		}

		return $this->home_CRUD->index_get_data($limit, $offset);
		//$data = array();
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

	private function pagination_link(){
		//pagination
		//$config['base_url'] = base_url() . 'home/page';
		$config['total_rows'] = $this->home_CRUD->index_count_data();
		//$config['per_page'] = 7; 

		$this->pagination->initialize($config); 
		return $this->pagination->create_links();
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */