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
		$global = self::load_global_class();

		//page info and current nav
		$header['page_title'] = "Homepage | Word of the day";
		$header['main_menu'] = $global->main_nav('home');
		$header['sub_menu'] = $global->sub_nav();
		$header['word'] = '';
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

	private function load_global_class(){
		//include and initialized global class
		include 'global_class.php';
		$global = new Global_class();

		return $global;
	}

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