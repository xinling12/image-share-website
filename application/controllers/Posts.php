<?php

    class Posts extends CI_Controller{
        public function index($offset = 0){
            //pagination config
            $config['base_url'] = base_url() . 'posts/index/';
            $config['total_rows'] = $this->db->count_all('posts');
            $config['per_page'] = 3;
            $config['uri_segment'] = 3;
            $config['attributes'] = array('class' => 'pagination-links');

            //init pagination
            $this->pagination->initialize($config);

            $data['posts'] = $this->post_model->get_posts(FALSE, $config['per_page'], $offset);
            
            $this->load->view('posts/index',$data);
        }

        public function view($slug = NULL){
            $userid = $this->session->userdata('id');
            $data['post'] = $this->post_model->get_posts($slug);
            $post_id = $data['post']['id'];
            $data['comments']= $this->comment_model->get_comments($post_id);
            

            if(empty($data['post'])){
                show_404();
            }

            $data['title'] = $data['post']['title'];
            $this->load->view('posts/view',$data);
        }

        public function create(){
            //check login
            if(!$this->session->userdata('id')){
                redirect('login');
            }

            $data['categories'] = $this->post_model->get_categories();

            $this->form_validation->set_rules('title','Titile','required');
            $this->form_validation->set_rules('body','Body', 'required');

            if($this->form_validation->run() === FALSE){
                $this->load->view('posts/create', $data);
            }else{
                //upload image
				// Upload Image
				$config['upload_path'] = './assets/images/posts';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '2048';
				$config['max_width'] = '2000';
				$config['max_height'] = '2000';
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload()){
					$errors = array('error' => $this->upload->display_errors());
					$post_image = 'noimage.jpg';
				} else {
					$data = array('upload_data' => $this->upload->data());
					$post_image = $_FILES['userfile']['name'];
				}
				$this->post_model->create_post($post_image);
				// Set message
				$this->session->set_flashdata('post_created', 'Your post has been created');
				redirect('posts');
                //other way

            }
            
        }
        
        public function delete($id){
            if(!$this->session->userdata('id')){
                redirect('login');
            }
            $this->post_model->delete_post($id);
            $this->session->set_flashdata('post_deleted','Your post has been deleted!');

            redirect('posts');
        }

        public function edit($slug){
            if(!$this->session->userdata('id')){
                redirect('login');
            }

            $data['post'] = $this->post_model->get_posts($slug);
            $data['categories'] = $this->post_model->get_categories();
            if(empty($data['post'])){
                show_404();
            }
            $this->load->view('posts/edit',$data);
        }

        public function update(){
            if(!$this->session->userdata('id')){
                redirect('login');
            }
            $this->post_model->update_post();
            $this->session->set_flashdata('post_updated','Your post has been updated!');
            redirect('posts');
            
        }

       


    }
?> 