<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authors extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('authors_CRUD');
	}


	public function index(){
		$global = self::load_global_class();

		$header['page_title'] = "Authors";
		$header['main_menu'] = $global::main_nav('authors');
		$header['sub_menu'] = $global::sub_nav();
		$header['word'] = '';

		$data['authors'] = $this->authors_CRUD->get_all_authors();


		$this->parser->parse('template/header', $header);
		$this->parser->parse('author/author_view', $data);
		$this->load->view('template/footer.php');

	}

	public function view($author){
		$global = self::load_global_class();

		$header['page_title'] = "Authors";
		$header['main_menu'] = $global::main_nav('authors');
		$header['sub_menu'] = $global::sub_nav();
		$header['word'] = '';

		$data['authors'] = $this->authors_CRUD->get_an_author($author);

		

		$this->parser->parse('template/header', $header);
		$this->parser->parse('author/author_view_each', $data);
		$this->load->view('template/footer.php');
	}



	//HEALDER CLASS
	private function load_global_class(){
		//include and initialized global class
		include 'global_class.php';
		$global = new Global_class();
		return $global;
	}


}