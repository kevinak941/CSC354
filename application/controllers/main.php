<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Default controller for website
 *
 * @author Kevin Kern
 * @version 1.0
 * TESTTTT
 */
class Main extends CI_Controller {
	
	/**
	 * Creates initial JQM index page
	 */
	public function index()
	{
		$this->load->view('header');
		$this->load->view('login');
		$this->load->view('main');
		$this->load->view('register');
		$this->load->view('dashboard');
		//$this->load->view('objects/view');
		$this->load->view('objects/create');
		$this->load->view('my_book');
		$this->load->view('footer');
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */