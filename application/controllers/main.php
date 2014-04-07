<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Default controller for website
 *
 * @author Kevin Kern
 * @version 1.0
 * TESTTTT
 */
class Main extends MY_Controller {
	
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
		$this->load->view('feed');
		$this->load->view('objects/view');
		$this->load->view('objects/create');
		$this->load->view('objects/search');
		$this->load->view('objects/edit');
		$this->load->view('my_book');
		$this->load->view('my_achievements');
		$this->load->view('my_stats');
		$this->load->view('footer');
		$this->load->view('pops/achievement_pop');
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */