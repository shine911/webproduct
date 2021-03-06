<?php
Class Catalog extends MY_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('catalog_model');
        $this->load->helper('url');
    }

    function index(){
        /**
         * Phân trang dữ liệu
         */
        $config['total_rows'] = $this->catalog_model->get_total();
        $config['base_url'] = admin_url('catalog').'/index/';
        $config['per_page'] = 5;
        $config['use_page_numbers'] = TRUE;
        $page_count = intdiv($config['total_rows'], 5); //số trang mà chia được
        $start=$this->uri->segment(4);
        if($config['total_rows']%5 != 0 && $start != ($page_count+1)){
            $page_count++; //nếu thừa thì cộng thêm 1 trang
        }
        if($start==''){
            $start = 1;
        }
        /**
         * Làm đẹp cho phân trang
         */
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_link'] = '<i class="fas fa-angle-double-left"></i>';
        $config['first_tag_close'] = '</li>';

        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_link'] = '<i class="fas fa-angle-double-right"></i>';
        $config['last_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');
        $config['full_tag_open'] = '<ul class="pagination justify-content-end mb-0">';
        $config['full_tag_close'] = '</ul>';
        
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_link'] = '<i class="fas fa-angle-left"></i>';
        $config['prev_tag_close'] = '</li>';

        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_link'] = '<i class="fas fa-angle-right"></i>';
        $config['next_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        //Kết thúc làm đẹp
        
        //Xét điều kiện ở bảng còn hay bảng thiếu, Bảng cuối cùng và còn thiếu
        if($start==$page_count && $config['total_rows']%5!=0){
            $config['per_page'] = $config['total_rows']%5;
        }

        $start = $start*5-5;

        $this->data['total'] = $config['total_rows'];
        $input['limit'] = array($config['per_page'], $start); 
        $this->load->library('pagination', $config);
        $this->data['links'] = $this->pagination->create_links();

        //Lay noi dung bien message
        $type= $this->session->flashdata('type');
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $this->data['type'] = $type;
        $this->data['temp'] = 'admin/catalog/index';
        $this->data['page_name'] = 'Quản lí danh mục sản phẩm';
        $this->data['list'] = $this->catalog_model->get_list($input);
        $this->load->view('admin/main', $this->data);
    }

    /**
     * Them du lieu moi
     */

    function add(){
        $this->data['page_name'] = 'Quản lí danh mục sản phẩm';
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
                $sort_order = $this->input->post('sort_order');
                $data = array(
                    'name' => $name,
                    'parent_id' => $parent_id,
                    'sort_order' => intval($sort_order)  
                );

                if($this->catalog_model->create($data)){
                    $this->session->set_flashdata('type', '0');
                    $this->session->set_flashdata('message', 'Thêm danh mục thành công');
                }
                else{
                    $this->session->set_flashdata('type', '1');
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

    /**
     * Chỉnh sửa danh mục
     */
    function edit(){
        $this->data['page_name'] = 'Quản lí danh mục sản phẩm';
        //Load library
        $this->load->library('form_validation');
        $this->load->helper('form');
        $id = $this->uri->segment(4);
        $info = $this->catalog_model->get_info($id);
        if(!$info){
            $this->session->set_flashdata('type', 1);
            $this->session->set_flashdata('message', 'Danh mục không tồn tại');
            redirect(admin_url('catalog'));
        }
        //neu co du lieu post len thi kiem tra
        if($this->input->post()){
            //Ten la bat buoc
            $this->form_validation->set_rules('name', 'name', 'required');
            //nhap lieu chinh xac
            if($this->form_validation->run()){
                //them vao csdl
                $name = $this->input->post('name');
                $parent_id = $this->input->post('parent_id');
                $sort_order = $this->input->post('sort_order');
                $data = array(
                    'name' => $name,
                    'parent_id' => $parent_id,
                    'sort_order' => intval($sort_order)  
                );

                if($this->catalog_model->update($id, $data)){
                    $this->session->set_flashdata('type', '0');
                    $this->session->set_flashdata('message', 'Cập nhật danh mục thành công');
                }
                else{
                    $this->session->set_flashdata('type', '1');
                    $this->session->set_flashdata('message', 'Đã xảy ra lỗi');
                }
                redirect(admin_url('catalog'));
            }
        }
            $input = array();
            $input['where'] = array('parent_id' => 0);
    
            $parent_id = $this->catalog_model->get_list($input);
            
            $this->data['info'] = $info;
            $this->data['parent'] = $parent_id;
            $this->data['temp'] = 'admin/catalog/edit';
            $this->load->view('admin/main', $this->data);
    }
    
    /**
     * Xóa dữ liệu
     */
    function delete(){
        $id = $this->uri->segment(4);
        $info = $this->catalog_model->get_info($id);
        if(!$info){
            $this->session->set_flashdata('type', 1);
            $this->session->set_flashdata('message', 'Danh mục không tồn tại');
            redirect(admin_url('catalog'));
        }

        if($this->catalog_model->delete($id)){
            $this->session->set_flashdata('type', '0');
            $this->session->set_flashdata('message', 'Xóa danh mục thành công');
        }
        else{
            $this->session->set_flashdata('type', '1');
            $this->session->set_flashdata('message', 'Đã xảy ra lỗi');
        }
        /**
         * Cập nhật dữ liệu cho danh mục con
         */

        $input = array();
        $input['where'] = array('parent_id' => $id);
        $list = $this->catalog_model->get_list($input);
        foreach($list as $row){
            $this->catalog_model->delete($row->id);
        }
        redirect(admin_url('catalog'));
    }
}