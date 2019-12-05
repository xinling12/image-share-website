<?php
    class Comments extends CI_Controller{
        public function __construct() {

            parent::__construct();
            $this->load->library('form_validation');
            $this->load->library('email');
                // Userid
           
            $this->load->view('posts/view',$data);
        }

        public function create($post_id){
            $slug = $this->input->post('slug');
            $data['post'] = $this->post_model->get_posts($slug);

            $this->form_validation->set_rules('name','Name','required');
            $this->form_validation->set_rules('email','Email','required|trim|valid_email');
            $this->form_validation->set_rules('body','Body','required');
          
            if($this->form_validation->run() === FALSE){
                
                $this->load->view('posts/view',$data);
            }else{

                $this->comment_model->create_comment($post_id);
                redirect('posts/'.$slug);
            }
        }

        
    }
?>