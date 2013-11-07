<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {


	public function index()
	{
		//page info and current nav
		$header['page_title'] = "Dictionary Homepage";
		$header['current_nav'] = 'Index';

		
		$this->parser->parse('template/header', $header);
		$this->load->view('home/home_view');
		$this->load->view('template/footer.php');
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */