<?php
class Login_model extends CI_Model{
    function can_login($email,$password){
        $sql = 'SELECT * FROM codeigniter_register WHERE email = ?';
        $query = $this->db->query($sql,array($email));
        // $this->db->where('email',$email);
        // $query = $this->db->get('codeigniter_register');
        if($query->num_rows()>0){
            foreach($query->result() as $row){
                if($row->is_email_verified == 'yes'){
                    //$store_password = $this->encrypt->decode($row->password);
                    if(password_verify($password,$row->password)){
                        $this->session->set_userdata('id',$row->id);
                    }else{
                        return "Wrong Password.";
                    }
                    
                }else{
                    return "Please verified your email first.";
                }
            }
        }else{
            return "Wrong Email Address";
        }
    }


    public function getUserInfoByEmail($email)
    {
        $sql = 'SELECT * FROM codeigniter_register WHERE email = ?';
        $q = $this->db->query($sql,array($email));
        // $q = $this->db->get_where('codeigniter_register', array('email' => $email), 1);  
        if($this->db->affected_rows() > 0){
            $row = $q->row();
            return $row;
        }else{
            error_log('no user found getUserInfo('.$email.')');
            return false;
        }
    }

    public function getUserInfo($id)
    {
        $sql = 'SELECT * FROM codeigniter_register WHERE id = ?';
        $query = $this->db->query($sql,array($id));
        // $q = $this->db->get_where('codeigniter_register', array('id' => $id), 1);  
        if($this->db->affected_rows() > 0){
            $row = $q->row();
            return $row;
        }else{
            error_log('no user found getUserInfo('.$id.')');
            return false;
        }
    }

    public function get_user(){

        $this->db->where('id',$this->session->userdata('id'));
        $query = $this->db->get('codeigniter_register');
        return $query->row_array();
    }

    public function update_user(){
        $data = array(
            'username' => $this->input->user('username'),
            'email' => $this->input->user('email')
            
        );
        $this->db->where('id',$this->input->user('id'));
        return $this->db->update('codeigniter_register', $data);
    }

    
}

?>