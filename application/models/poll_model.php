<?php 

class Poll_model extends CI_model {
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}	
	
	public function get_poll_questions() {
		$sql = "select * from poll_option";
		$query = $this->db->query($sql);
		return $query->row();
	}

	public function save_vote() {
		$sql = "INSERT INTO votes VALUES (?, ?)";
		return $this->db->query($sql, array('', $this->input->post('poll_choice')));
	}

	public function get_poll_results() {
		$sql = 'SELECT answer_list FROM poll_option';
		$query = $this->db->query($sql);
		$answer_list = $query->result_array();

		$poll_results = array();

		// convert json string to array type
		$answer_list_array = json_decode($answer_list[0]['answer_list']);
		$answer_list_length = count($answer_list_array);

		for ($i = 0; $i < $answer_list_length; $i++) {
			$sql = 'SELECT COUNT(vote_option) AS vote_option FROM votes WHERE vote_option = ?';
			$query = $this->db->query($sql, array($answer_list_array[$i]));
			$result = $query->row_array();
			$poll_results[] = [$answer_list_array[$i] => $result];
		}


		// get the total votes
		$total_votes = 0;
		$sql = 'SELECT COUNT(vote_option) AS total_votes FROM votes';
		$query = $this->db->query($sql);
		$total_votes = array('total_votes' => $query->row_array());

		return array($poll_results, $total_votes, $answer_list_array);
	}
}