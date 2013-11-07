<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Phonebook extends CI_Controller {

	public function index()
	{
		//page title
		$header['page_title'] = "Phonebook Homepage";


		//meta pages
  		$meta = array(
                  array('name' => 'robots', 'content' => 'no-cache'),
                  array('name' => 'description', 'content' => 'My Great Site'),
                  array('name' => 'keywords', 'content' => 'love, passion, intrigue, deception'),
                  array('name' => 'robots', 'content' => 'no-cache'),
                  array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv')
              );

  		$header['meta'] = meta($meta);

  		//links bootstrap
  		$link = array(
                    'href' => 'assets/css/bootstrap.css',
                    'rel' => 'stylesheet',
                    'type' => 'text/css'
                );
  		$header['bootstrap_css'] = link_tag($link);


    	//links custom
    	 $link = array(
                    'href' => 'assets/css/custom.css',
                    'rel' => 'stylesheet',
                    'type' => 'text/css'
                );

    	$header['custom_css'] = link_tag($link);

    	//table template
		   $tmpl = array (
		  'table_open'          => '<table class="table table-border table-hover"',
		  'heading_row_start'   => '<tr class="heading">',
		  'heading_row_end'     => '</tr>',
		  'heading_cell_start'  => '<th>',
		  'heading_cell_end'    => '</th>',
		  'row_start'           => '<tr>',
		  'row_end'             => '</tr>',
		  'cell_start'          => '<td>',
		  'cell_end'            => '</td>',
		  'row_alt_start'       => '<tr class="alt">',
		  'row_alt_end'         => '</tr>',
		  'cell_alt_start'      => '<td>',
		  'cell_alt_end'        => '</td>',
		  'table_close'         => '</table>'
		);


		$this->table->set_template($tmpl);
		$this->table->set_caption("Bryan Bojorque | 09329091453");
    	//table data
    	$table_data = array(
             array('Bryan Bojorque', '09329091453', anchor('#', 'View', 'class="btn btn-info"').' '.anchor('#', 'Edit', 'class="btn btn-success"')),
             array('Fred', 'Blue', anchor('#', 'View', 'class="btn btn-info"').' '.anchor('#', 'Edit', 'class="btn btn-success"')),
             array('Mary', 'Red', anchor('#', 'View', 'class="btn btn-info"').' '.anchor('#', 'Edit', 'class="btn btn-success"')),
             array('John', 'Green', anchor('#', 'View', 'class="btn btn-info"').' '.anchor('#', 'Edit', 'class="btn btn-success"'))	
             );

    	//array heading
    	$table_heading = array('Name','Number','Action' );
    	$this->table->set_heading($table_heading);
    	$data['table_data'] = $this->table->generate($table_data);


		
		

		

		//js links --footer
		$footer['jquery'] = "http://code.jquery.com/jquery-1.10.1.min.js";
		$footer['bootstrap'] = base_url().'assets/js/bootstrap.js';
		
		$this->parser->parse('template/header', $header);
		$this->parser->parse('phonebook_view', $data);
		$this->parser->parse('template/footer.php', $footer);
	}
}

/* End of file phonebook.php */
/* Location: ./application/controllers/welcome.php */