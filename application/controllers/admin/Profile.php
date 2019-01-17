<?php
Class Profile extends MY_Controller{
    function __construct()
    {
        parent::__construct();
    }

    function index(){
        $this->data['temp'] = 'admin/profile/index';
        $this->data['page_name'] = '- Hồ sơ của tôi';
        $this->load->view('admin/main', $this->data);
    }
}