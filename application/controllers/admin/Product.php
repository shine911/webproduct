<?php
class Product extends MY_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->model('catalog_model');
        $this->load->helper('url');
    }

    function index(){
        /**
         * Phân trang dữ liệu
         */
        $config['total_rows'] = $this->product_model->get_total();
        $config['base_url'] = admin_url('product').'/index/';
        $config['per_page'] = 10;
        $config['use_page_numbers'] = TRUE;
        $page_count = intdiv($config['total_rows'], $config['per_page']); //số trang mà chia được
        $start=$this->uri->segment(4);
        if($config['total_rows']%$config['per_page'] != 0 && $start != ($page_count+1)){
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
        if($start==$page_count && $config['total_rows']%$config['per_page']!=0){
            $config['per_page'] = $config['total_rows']%$config['per_page'];
        }

        $start = $start*$config['per_page']-$config['per_page'];

        $this->data['total'] = $config['total_rows'];
        $input['limit'] = array($config['per_page'], $start); 
        $this->load->library('pagination', $config);
        $this->data['links'] = $this->pagination->create_links();

        //Lay noi dung bien message
        $type= $this->session->flashdata('type');
        $message = $this->session->flashdata('message');

        $list = $this->product_model->get_list($input);
        foreach($list as $row){
            $row->catalog = $this->catalog_model->get_info($row->catalog_id);
        }
        $this->data['message'] = $message;
        $this->data['type'] = $type;
        $this->data['temp'] = 'admin/product/index';
        $this->data['page_name'] = 'Quản lí sản phẩm';
        $this->data['list'] = $list;
        $this->load->view('admin/main', $this->data);
    }

    function search(){
        /**
         * Lấy danh sách
         */
        $keyword = $this->input->get('name');
        $input['like'] = array('name', $keyword);
        if(!$keyword){
            redirect('admin/catalog');
        }
        $list = $this->product_model->get_list($input);

        /**
         * Phân trang dữ liệu
         */
        $config['total_rows'] = count($list);
        $config['base_url'] = admin_url('product').'/index/search/';
        $config['per_page'] = 10;
        $config['use_page_numbers'] = TRUE;
        $page_count = intdiv($config['total_rows'], $config['per_page']); //số trang mà chia được
        $start=$this->uri->segment(4);
        if($config['total_rows']%$config['per_page'] != 0 && $start != ($page_count+1)){
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
        if($start==$page_count && $config['total_rows']%$config['per_page']!=0){
            $config['per_page'] = $config['total_rows']%$config['per_page'];
        }
        $start = $start*$config['per_page']-$config['per_page'];
        $this->data['total'] = $config['total_rows'];
        
        /**
         * Lấy lại dữ liệu đã được limit
         */

        $input['limit'] = array($config['per_page'], $start);
        $list = $this->product_model->get_list($input);

        $this->load->library('pagination', $config);
        $this->data['links'] = $this->pagination->create_links();

        //Lay noi dung bien message
        $type = $this->session->flashdata('type');
        $message = $this->session->flashdata('message');

        foreach($list as $row){
            $row->catalog = $this->catalog_model->get_info($row->catalog_id);
        }

        $this->data['message'] = $message;
        $this->data['type'] = $type;
        $this->data['temp'] = 'admin/product/index';
        $this->data['page_name'] = 'Quản lí sản phẩm';
        $this->data['list'] = $list;
        $this->load->view('admin/main', $this->data);
    }
}