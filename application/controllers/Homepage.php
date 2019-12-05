<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Homepage extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function index($offset = 0){
        //pagination config
        $config['base_url'] = base_url() . 'homepage/index/';            
        $config['total_rows'] = $this->db->count_all('posts');
        $config['per_page'] = 9;
        $config['uri_segment'] = 3;
        $config['attributes'] = array('class' => 'pagination-link');

        //init pagination
        $this->pagination->initialize($config);

        $data['posts'] = $this->post_model->get_posts(FALSE, $config['per_page'], $offset);

        
        // $data['posts'] = $this->post_model->get_posts();
       
        $this->load->view('homepage/index',$data);
    }

    function logout(){
        $data = $this->session->all_userdata();
        foreach($data as $row => $row_value){
            $this ->session->unset_userdata($row);
        }
        redirect('login');
    }
   

    public function search(){
        $data['query'] = $this->post_model->get_img();
        //$this->load->vars($data);
        $this->load->view('homepage/search',$data);
    }

    public function profile(){
        $this->load->model('login_model');
        $data['user'] = $this->login_model->get_user();
        $user_name = $data['user']['username'];

        if(empty($data['user'])){
            echo "cant find";
            show_404();
        }

        $data['email'] = $data['user']['email'];
        $this->load->view('homepage/profile',$data);
    }

    public function edit(){
        if(!$this->session->userdata('id')){
            redirect('login');
        }

        $data['user'] = $this->login_model->get_user();
        
        if(empty($data['user'])){
            show_404();
        }
        $this->load->view('posts/edit',$data);
    }
    
    public function update(){
        if(!$this->session->userdata('id')){
            redirect('login');
        }
        $this->login_model->update_profile();
        $this->session->set_flashdata('Profile_updated','Your profile has been updated!');
        redirect('profile');
        
    }
}
    
?>