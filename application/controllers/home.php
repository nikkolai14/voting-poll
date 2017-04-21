<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	private $page_data = array();

	public function __construct() {
		parent::__construct();
		$this->load->model('poll_model');
		$this->load->library('session');
	}

	public function index()
	{	
		// get question from the database
		$this->page_data['poll'] = $this->poll_model->get_poll_questions();

		// check if poll is save or not
		$this->page_data['save_msg'] = ($this->session->flashdata('is_save') !== null) ? ($this->session->flashdata('is_save')) : 
			false;

		$this->load->view('home', $this->page_data);
	}

	public function submit_vote() {
		$this->form_validation->set_rules('poll_choice', 'poll choice', 'required');

		if ($this->form_validation->run() == FALSE) {
            redirect('home');
        } else {
            // save vote  choice
            $save_vote = $this->poll_model->save_vote();

            if ($save_vote) {
            	$this->session->set_flashdata('is_save', true);
            } else {
            	$this->session->set_flashdata('is_save', false);
            }

            redirect('home');
        }
	}

	public function view_poll_results() {
		// get total votes
		$this->page_data['poll_results'] = $this->poll_model->get_poll_results();

		$this->load->view('view_poll_results', $this->page_data);
	}
}
