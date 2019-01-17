<?php
    class Login extends MY_Controller{
        /**
         *
         */
        function index(){
            $this->load->library('form_validation');
            $this->load->helper('form');
            //Neu co du lieu post len
            if($this->input->post()){
                $this->form_validation->set_rules('login', 'login', 'callback_check_login');
                if($this->form_validation->run()){
                    $this->session->set_userdata('login', true);
                    redirect(admin_url('home'));
                }
            }
            $this->load->view('admin/login/index');
        }

        /**
         * Kiem tra username va password
         */
        function check_login(){
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $password = md5($password);

            $this->load->model('admin_model');
            $where = array('username' => $username, 'password' => $password);
            if($this->admin_model->check_exists($where)){
                return true;
            }
            $html = '<div class="alert alert-danger" role="alert">
            <span class="alert-inner--icon"><i class="fas fa-exclamation-triangle"></i></span>
            <span class="alert-inner--text">Không thể đăng nhập</span>
            </div>';
            $this->form_validation->set_message(__FUNCTION__, $html);
            return false;
        }
    }
?>
