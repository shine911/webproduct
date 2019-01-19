<?php
    Class Home extends MY_Controller{
        function __construct()
        {
            parent::__construct();
        }
        function index(){
            $this->data['temp'] = 'admin/home/index';
            $this->data['page_name'] = 'Tổng quan';
            $this->load->view('admin/main', $this->data);
        }
    }
?>