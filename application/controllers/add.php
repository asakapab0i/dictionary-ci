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

		$data['success'] = FALSE;



		//load to view
		$this->parser->parse('template/header', $header);
		$this->load->view('add/add_view', $data);
		$this->load->view('template/footer.php');
	}

	public function callback_check_word_validation($email, $pname){
		$checkpname = $this->add_CRUD->check_pname($pname);
		$checkemail = $this->add_CRUD->check_email($email);


		if ($checkpname == 1) {
			$get_pname_result = $this->add_CRUD->get_pname($pname);
			foreach ($get_pname_result as $key => $row) {
				$get_pname_email = $row['email'];
			}
			if ($email != $get_pname_email) {
				$this->form_validation->set_message('check_word_validation', 'Incorrect email address.');
				return FALSE;
			}else{
				return TRUE;
			}
		}else{
			if ($checkemail == 1) {
				$this->form_validation->set_message('check_word_validation', 'Email address already exist.');
				return FALSE;
			}else{
				return TRUE;
			}
		}

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
							'pname' => $this->input->post('pname'),
							'email' => $this->input->post('email')
							);
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		$this->form_validation->set_rules('word', 'Word', 'required');
		$this->form_validation->set_rules('definition', 'Definition', 'required');
		$this->form_validation->set_rules('example', 'Example', 'required');
		$this->form_validation->set_rules('tags', 'Related Tags', 'required');
		$this->form_validation->set_rules('pname', 'Psuedo Name', 'required|callback_check_pname,');
		$this->form_validation->set_rules('email', 'Email', 'required|callback_check_word_validation['.$this->input->post('pname').']');


		if ($this->form_validation->run() == FALSE)
		{

			
			$this->parser->parse('template/header', $header);
			$this->load->view('add/add_view.php', $data);
			$this->load->view('template/footer.php');
		}
		else
		{	//save the data

			$this->add_CRUD->add_to_db($formdata);

			$this->parser->parse('template/header', $header);
			$this->load->view('add/save_view.php', $data);
			$this->load->view('template/footer.php');
		}

	}

	//function Helpers
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