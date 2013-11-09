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
		$header['page_title'] = "Dictionary Homepage";
		$header['current_nav'] = 'index';
		$header['sub_menu'] = self::headerNav();
		//get words from data
		$data['words'] = $this->home_CRUD->index_get_data();
		//pagination
		$config['base_url'] = base_url() . 'home/page';
		$config['total_rows'] = 200; //$this->home_CRUD->index_count_data();
		$config['per_page'] = 20; 

		$this->pagination->initialize($config); 
		$data['pagination_links'] = $this->pagination->create_links();

		
		$this->parser->parse('template/header', $header);
		$this->parser->parse('home/home_view', $data);
		$this->load->view('template/footer.php');
	}

	//function helpers
	private function headerNav($letter = 'random'){
		//populate letters
		$letters = range('a', 'z');
		array_unshift($letters,'random');
		$subMenu = '';
		foreach ($letters as $key => $value) {

			if ($value == $letter) {
				$subMenu .= anchor('dictionary/popular/'.$value.'', $value,'class="btn btn-default active"');
			}else{
				$subMenu .= anchor('dictionary/popular/'.$value.'', $value, 'class="btn btn-default"');
			}
			
		}

		return $subMenu;
	
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */