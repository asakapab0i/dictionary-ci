<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		//loads the home model in the entire class
		parent::__construct();
		$this->load->model('home_CRUD');
	}

	public function index()
	{
		//page info and current nav
		$header['page_title'] = "Dictionary Homepage";
		$header['current_nav'] = 'Index';

		//get words from data
		$data['words'] = $this->home_CRUD->index_get_data();
		//pagination
		$config['base_url'] = base_url() . 'home';
		$config['total_rows'] = $this->home_CRUD->index_count_data();
		$config['per_page'] = 20; 

		$this->pagination->initialize($config); 
		$data['pagination_links'] = $this->pagination->create_links();

		
		$this->parser->parse('template/header', $header);
		$this->load->view('home/home_view', $data);
		$this->load->view('template/footer.php');
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */