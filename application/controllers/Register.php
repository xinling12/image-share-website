<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Register extends CI_Controller{
    
    public function __construct() {

        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('encrypt');
        $this->load->model('register_model');
        $this->load->library('email');
    }

    function index(){
        $this->load->view('register');
    }

    function validation(){
        $this->form_validation->set_rules('username','Name'
        ,'required|trim');
        $this->form_validation->set_rules('email','Email'
        ,'required|trim|valid_email|is_unique[codeigniter_register.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('rpassword', 'Password Confirmation', 'trim|required|matches[password]');
        if($this->form_validation->run())
        {
            //for email verification,not for pw
            $verification_key=md5(rand());
            //$encrypted_password=$this->encrypt->encode($this->input->post('password'));
            //hash pw
            $hash=password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $data = array(
                'username' => $this->input->post('username'),
                'email'    => $this->input->post('email'),
                'password' => $hash,
                'verification_key' => $verification_key
            );
            $id = $this ->register_model -> insert($data);
            if($id > 0){

                $subject = 'please verify email for login';
                $messgae = 
                "<p>Hi ".$this->input->post('username')."</p>
                <p>This is email verification mail from Codeigniter Picture Website
                Login system. For complete registration process and login into
                the website. First you need to verify you email by click this
                <a href='".base_url()."register/verify_email/".$verification_key."'>link</a>.</p>
                <p>once you click this link, your email will be verified and you can login</p>
                <p>Thanks.</p>";

                $config = array(
                    'protocol'  => 'smtp',
                    'smtp_port' => 465,
                    'smtp_host' => 'ssl://smtp.gmail.com',
                    'smtp_user' => 'xxinling1012@gmail.com',
                    'smtp_pass' => 'xxl941012',
                    'mailtype'  => 'html',
                    'charset'   => 'utf-8'
                );
                $this->email->initialize($config);
                $this->email->set_mailtype("html");
                $this->email->set_newline("\r\n");
                $this->email->from('xxinling1012@gmail.com','Identification');
                $this->email->to($this->input->post('email'));
                $this->email->subject($subject);
                $this->email->message($messgae);
                if($this->email->send()){
                    $this->session->set_flashdata('message','check in your email for email verification mail'); 
                    redirect('register');
                }

            }
        }
        else{

            $this->index();
        }  
    }

    function verify_email(){

        if($this->uri->segment(3)){
            $verification_key = $this->uri->segment(3);
            if($this->register_model->verify_email($verification_key)){
                $data['message'] = '<h1 align=center>Your Email has been successfully 
                verified, now you can login from <a href="'.base_url().'login">here</a></h1>';
            }else{
                $data['message']='<h1 align="center">Invalid Link</h1>';
            }
            $this->load->view('email_verification',$data);
        }
    }
}
?>