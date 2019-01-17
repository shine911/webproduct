<?php
Class Catalog extends MY_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('catalog_model');
    }

    function index(){
        $list = $this->catalog_model->get_list();
        $this->data['list'] = $list;

        //Lay noi dung bien message
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $this->data['temp'] = 'admin/catalog/index';
        $this->load->view('admin/main', $this->data);
    }

    /**
     * Them du lieu moi
     */

    function add(){
        //Load library
        $this->load->library('form_validation');
        $this->load->helper('form');
        
        //neu co du lieu post len thi kiem tra
        
        if($this->input->post()){
            //Ten la bat buoc
            $this->form_validation->set_rules('name', 'name', 'required');

            //nhap lieu chinh xac
            if($this->form_validation->run()){
                //them vao csdl
                $name = $this->input->post('name');
                $parent_id = $this->input->post('parent_id');
                $sort_id = $this->input->post('sort_order');
                $data = array(
                    'name' => $name,
                    'parent_id' => $parent_id,
                    'sort_order' => intval($sort_order)  
                );

                if($this->catalog_model->create($data)){
                    $this->session->set_flashdata('message', '<div style="color:green">Thêm danh mục thành công</div>');
                }
                else{
                    $this->session->set_flashdata('message', 'Đã xảy ra lỗi');
                }

                redirect(admin_url('catalog'));
            }
        }
        

        $input = array();
        $input['where'] = array('parent_id' => 0);

        $parent_id = $this->catalog_model->get_list($input);

        $this->data['parent'] = $parent_id;
        $this->data['temp'] = 'admin/catalog/add';
        $this->load->view('admin/main', $this->data);
    }
}