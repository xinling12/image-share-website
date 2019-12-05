<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Chat extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function index(){
        $this->load->view('chat');
    }

    public function chatroom_enter(){
		$postData = $this->input->post();
		$result = $this->chat_model->chatroom_insert($postData);
		echo json_encode($result);
	}

	public function chatroom_load(){
		$result = $this->chat_model->chatroom_load();
		echo json_encode($result);
	}
}
?>