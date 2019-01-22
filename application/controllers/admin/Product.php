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
        $input = array();
        $input['like'] = array('name' => $keyword);
        if(!$keyword){
            $this->session->set_flashdata('type', 1);
            $this->session->set_flashdata('message', 'Không tìm thấy sản phẩm');
            redirect('admin/product');
        }
        $list = $this->product_model->get_list($input);

        if(count($list)==0){
            //Lay noi dung bien message
            $this->session->set_flashdata('type', 1);
            $this->session->set_flashdata('message', 'Không tìm thấy sản phẩm');
            redirect(admin_url('product/search'));
        }

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

    /**
     * Thêm sản phẩm
     */
    function add(){
        $this->data['page_name'] = 'Thêm sản phẩm';
        //Load library
        $this->load->library('form_validation');
        $this->load->helper('form');
        
        //lay danh sach danh muc san pham
        $this->load->model('catalog_model');
        $input = array();
        $input['where'] = array('parent_id' => 0);
        $catalogs = $this->catalog_model->get_list($input);
        foreach ($catalogs as $row)
        {
            $input['where'] = array('parent_id' => $row->id);
            $subs = $this->catalog_model->get_list($input);
            $row->subs = $subs;
        }
        $this->form_validation->set_rules('name', 'Tên', 'required');
        $this->form_validation->set_rules('catalog', 'Thể loại', 'required');
        $this->form_validation->set_rules('price', 'Giá', 'required');
        
        //nhập liệu chính xác
        if($this->form_validation->run())
        {
            //them vao csdl
            $name        = $this->input->post('name');
            $catalog_id  = $this->input->post('catalog');
            $price       = $this->input->post('price');
            $price       = str_replace(',', '', $price);
            $discount = $this->input->post('discount');
            $discount = str_replace(',', '', $discount);
            
            //lay ten file anh minh hoa duoc update len
            $this->load->library('upload_library');
            $upload_path = './upload/product';
            $upload_data = $this->upload_library->upload($upload_path, 'image');  

            $image_link = '';
            if(isset($upload_data['file_name']))
            {
                $image_link = $upload_data['file_name'];
            }
            //upload cac anh kem theo
            $image_list = array();
            $image_list = $this->upload_library->upload_file($upload_path, 'image_list');
            $image_list = json_encode($image_list);

            //luu du lieu can them
            $data = array(
                'name'       => $name,
                'catalog_id' => $catalog_id,
                'price'      => $price,
                'image_link' => $image_link,
                'image_list' => $image_list,
                'discount'   => $discount,
                'warranty'   => $this->input->post('warranty'),
                'gifts'      => $this->input->post('gifts'),
                'site_title' => $this->input->post('site_title'),
                'meta_desc'  => $this->input->post('meta_desc'),
                'meta_key'   => $this->input->post('meta_key'),
                'content'    => $this->input->post('content'),
            ); 
            //them moi vao csdl
            if($this->product_model->create($data))
            {
                //tạo ra nội dung thông báo
                $this->session->set_flashdata('type', 0);
                $this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công');
            }else{
                $this->session->set_flashdata('type', 1);
                $this->session->set_flashdata('message', 'Không thêm được');
            }
            //chuyen tới trang danh sách
            redirect(admin_url('product'));
        }
        $this->data['catalogs'] = $catalogs;
        $this->data['temp'] = 'admin/product/add';
        $this->load->view('admin/main', $this->data);
    }

    function edit(){
        //Lấy id của sản phẩm
        $id = $this->uri->segment('4');
        $product = $this->product_model->get_info($id);
        if(!$product)
        {
            //tạo ra nội dung thông báo
            $this->session->set_flashdata('type', 1);
            $this->session->set_flashdata('message', 'Không tồn tại sản phẩm này');
            redirect(admin_url('product'));
        }
        $this->data['product'] = $product;
        //lay danh sach danh muc san pham
        $this->load->model('catalog_model');
        $input = array();
        $input['where'] = array('parent_id' => 0);
        $catalogs = $this->catalog_model->get_list($input);
        foreach ($catalogs as $row)
        {
            $input['where'] = array('parent_id' => $row->id);
            $subs = $this->catalog_model->get_list($input);
            $row->subs = $subs;
        }
        $this->data['catalogs'] = $catalogs;
        
        //load thư viện validate dữ liệu
        $this->load->library('form_validation');
        $this->load->helper('form');
        //neu ma co du lieu post len thi kiem tra
        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Tên', 'required');
            $this->form_validation->set_rules('catalog', 'Thể loại', 'required');
            $this->form_validation->set_rules('price', 'Giá', 'required');
        
            //nhập liệu chính xác
            if($this->form_validation->run())
            {
                //them vao csdl
                $name        = $this->input->post('name');
                $catalog_id  = $this->input->post('catalog');
                $price       = $this->input->post('price');
                $price       = str_replace(',', '', $price);
                
                $discount = $this->input->post('discount');
                $discount = str_replace(',', '', $discount);
                
                //lay ten file anh minh hoa duoc update len
                $this->load->library('upload_library');
                $upload_path = './upload/product';
                $upload_data = $this->upload_library->upload($upload_path, 'image');
                $image_link = '';
                if(isset($upload_data['file_name']))
                {
                    $image_link = $upload_data['file_name'];
                }
            
                //upload cac anh kem theo
                $image_list = array();
                $image_list = $this->upload_library->upload_file($upload_path, 'image_list');
                $image_list_json = json_encode($image_list);
        
                //luu du lieu can them
                $data = array(
                    'name'       => $name,
                    'catalog_id' => $catalog_id,
                    'price'      => $price,
                    'discount'   => $discount,
                    'warranty'   => $this->input->post('warranty'),
                    'gifts'      => $this->input->post('gifts'),
                    'site_title' => $this->input->post('site_title'),
                    'meta_desc'  => $this->input->post('meta_desc'),
                    'meta_key'   => $this->input->post('meta_key'),
                    'content'    => $this->input->post('content'),
                );
                if($image_link != '')
                {
                    $data['image_link'] = $image_link;
                }
                
                if(!empty($image_list))
                {
                    $data['image_list'] = $image_list_json;
                }
                
                //them moi vao csdl
                if($this->product_model->update($product->id, $data)){
                //tạo ra nội dung thông báo
                $this->session->set_flashdata('type', 0);
                $this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công');
                }else{
                $this->session->set_flashdata('type', 1);
                $this->session->set_flashdata('message', 'Không thêm được');
                }
                //chuyen tới trang danh sách
                redirect(admin_url('product'));
            }
        }
        //load view
        $this->data['page_name'] = 'Sửa sản phẩm';
        $this->data['temp'] = 'admin/product/edit';
        $this->load->view('admin/main', $this->data);
    }

        /*
     * Xoa du lieu
     */
    function delete()
    {
        $id = $this->uri->segment(4);
        $this->_del($id);
        
        //tạo ra nội dung thông báo
        $this->session->set_flashdata('type', 0);
        $this->session->set_flashdata('message', 'Đã xóa thành công');
        redirect(admin_url('product'));
    }
    
    /*
     *Xoa san pham
     */
    private function _del($id)
    {
        $product = $this->product_model->get_info($id);
        if(!$product)
        {
            //tạo ra nội dung thông báo
            $this->session->set_flashdata('type', 1);
            $this->session->set_flashdata('message', 'không tồn tại sản phẩm này');
            redirect(admin_url('product'));
        }
        //thuc hien xoa san pham
        $this->product_model->delete($id);
        //xoa cac anh cua san pham
        $image_link = './upload/product/'.$product->image_link;
        if(file_exists($image_link))
        {
            unlink($image_link);
        }
        //xoa cac anh kem theo cua san pham
        $image_list = json_decode($product->image_list);
        if(is_array($image_list))
        {
            foreach ($image_list as $img)
            {
                $image_link = './upload/product/'.$img;
                if(file_exists($image_link))
                {
                    unlink($image_link);
                }
            }
        }
    }
}
