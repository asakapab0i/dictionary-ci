<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('add_CRUD');
	}

	public function index($word = ''){
		//$global = self::load_global_class();

		//page info and current nav
		$header['page_title'] = "Add word";
		$header['main_menu'] = self::main_nav('add');
		$header['sub_menu'] = self::sub_nav();
		$header['word'] = '';



		//load to view
		$this->parser->parse('template/header', $header);
		$this->load->view('add/add_view');
		$this->load->view('template/footer.php');
	}

	public function save($word = ''){
		$header['page_title'] = "Add word";
		$header['main_menu'] = self::main_nav('add');
		$header['sub_menu'] = self::sub_nav();
		$header['word'] = '';

		$data['success'] = FALSE;

		$formdata = array('word' => $this->input->post('word'),
							'definition' => $this->input->post('definition'),
							'example' => $this->input->post('example'),
							'tags' => $this->input->post('tags'),
							'author' => $this->input->post('author'),
							'email' => $this->input->post('email')
							);
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		$this->form_validation->set_rules('word', 'Word', 'required');
		$this->form_validation->set_rules('definition', 'Definition', 'required');
		$this->form_validation->set_rules('example', 'Example', 'required');
		$this->form_validation->set_rules('author', 'Author', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');


		if ($this->form_validation->run() == FALSE)
		{
			$data['success'] = TRUE;
			$this->parser->parse('template/header', $header);
			$this->load->view('add/add_view.php', $data);
			$this->load->view('template/footer.php');
		}
		else
		{	//save the data

			


			$this->load->view('add/success');
		}

	}

	private function populate_data($formdata){
		//var_dump($formdata);
		include 'global_class.php';
		$global = new Global_class();
		return $global;
	}






	//Class Helpers
	private function load_global_class(){
		include 'global_class.php';
		$global = new Global_class();
		return $global;
	}

	public function main_nav($current_nav = 'home'){
		//populate navication array
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

}