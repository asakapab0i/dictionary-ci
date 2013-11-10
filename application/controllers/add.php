<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add extends CI_Controller{

	public function index(){
		$global = self::load_global_class();

		//page info and current nav
		$header['page_title'] = "Add word";
		$header['main_menu'] = $global->main_nav('add');
		$header['sub_menu'] = $global->sub_nav();
		$header['word'] = '';


		//load to view
		$this->parser->parse('template/header', $header);
		$this->load->view('add/add_view');
		$this->load->view('template/footer.php');
	}

	public function save(){
		
	}




	//Class Helpers
	private function load_global_class(){
		include 'global_class.php';
		$global = new Global_class();
		return $global;
	}

}