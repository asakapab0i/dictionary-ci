<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authors extends CI_Controller{


	public function index(){
		$global = self::load_global_class();

		$header['page_title'] = "Authors";
		$header['main_menu'] = $global::main_nav('authors');
		$header['sub_menu'] = $global::sub_nav();
		$header['word'] = '';



		$this->parser->parse('template/header', $header);
		$this->load->view('author/author_view');
		$this->load->view('template/footer.php');

	}

	public function view($author){

		
	}



	//HEALDER CLASS
	private function load_global_class(){
		//include and initialized global class
		include 'global_class.php';
		$global = new Global_class();
		return $global;
	}


}