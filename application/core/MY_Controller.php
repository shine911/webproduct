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

        }

    }
?>
