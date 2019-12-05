<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function chatroom_insert($postData){
        if($postData['chatcontent']){
            $newcontent = array(
                'name' => 'Anonymous',
                'content' => $postData['chatcontent']
            );
            $this->db->insert('chatroom', $newcontent);
            $result = $this->db->query('SELECT * FROM chatroom');
            $realresult = $result->result_array();
            return $realresult;
        }
    }

    public function chatroomlog_insert($postData){
        if($postData['chatcontent']){
            $newcontent = array(
                'name' => $postData['name'],
                'content' => $postData['chatcontent']
            );
            $this->db->insert('chatroom', $newcontent);
            $result = $this->db->query('SELECT * FROM chatroom');
            $realresult = $result->result_array();
            return $realresult;
        }
    }

    public function chatroom_load(){
        $result = $this->db->query('SELECT * FROM chatroom');
        $realresult = $result->result_array();
        return $realresult;
    }
        
}

?>