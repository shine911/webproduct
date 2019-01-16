<?php
    class MY_Controller extends CI_Controller{
        //bien gui du lieu cho ben view
        public $data = array();

        function __construct()
        {
            parent::__construct();

            $controller = $this->uri->segment(1);
            switch ($controller) {
                case 'admin':
                    $this->load->helper('admin');
                    $this->_check_login();
                    break;
                default:

                    break;
            }
        }
        
        private function _check_login(){
            $controller = $this->uri->rsegment(1);
            $login = $this->session->userdata('login');
            
            //Neu chua dang nhap thi redirect ve trang dang nhap
            if(!$login && $controller!='login'){
                redirect(admin_url('login'));
            }
            
            //Neu dang nhap roi nhung co tinh truy cap trang dang nhap thi redirect ve home
            if($login && $controller == 'login'){
                redirect(admin_url('home'));
            }
        }

    }
?>
