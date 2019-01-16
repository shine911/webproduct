<?php
    class Admin extends MY_Controller{
        // function create(){
        //     $this->load->model('admin_model');
        //     $data = array();
        //     $data['username'] = 'admin1';
        //     $data['password'] = 'admin1';
        //     $data['name'] = 'Hocphp';

        //     if($this->admin_model->create($data)){
        //         echo 'Them thanh cong';
        //     }
        //     else{
        //         echo 'Them that bai';
        //     }
        // }

        // function update(){
        //     $id = '8';
        //     $this->load->model('admin_model');
        //     $data = array();
        //     $data['username'] = 'admin2';
        //     $data['password'] = 'admin2';
        //     $data['name'] = 'Hocphp 2';

        //     if($this->admin_model->update($id, $data)){
        //         echo 'cap nhat thanh cong';
        //     }
        //     else{
        //         echo 'cap nhat that bai';
        //     }
        // }

        // function delete(){
        //     $id = '8';
        //     $this->load->model('admin_model');
        //     if($this->admin_model->delete($id)){
        //         echo 'Xoa thanh cong';
        //     }
        //     else{
        //         echo 'Xoa that bai';
        //     }
        // }

        // //lay id cua danh sach
        // function get_info(){
        //     $id = 1;
        //     $this->load->model('admin_model');
        //     $info = $this->admin_model->get_info($id, 'username, password');
        //     echo '<pre>';
        //     print_r($info);
        // }

        // //lay tat ca danh sach
        // function get_list(){
        //     $this->load->model('admin_model');
        //     $input = array();

        //     //$input['where'] = array('id'=>1); //dieu kien de lay id = 1
        //     //$input['order'] = array('id', 'asc'); //sap xep danh sach
        //     //$input['limit'] = array(1,0); //chuc nang phan trang
        //     //$input['like'] = array('name', 'mod'); //tim ten
        //     $list = $this->admin_model->get_list($input);
        //     echo '<pre>';
        //     print_r($list);
        // }

        function __construct(){
            parent::__construct();
            $this->load->model('admin_model');
        }
        
        function index(){
            $input = array();
            $list = $this->admin_model->get_list($input);
            $this->data['list'] = $list;
            
            $total = $this->admin_model->get_total();
            $this->data['total'] = $total;
            
            $this->data['temp'] = 'admin/admin/index';
            $this->load->view('admin/main', $this->data);
        }

        //check username
        function check_username(){
            $username = $this->input->post('username');
            $where = array('username' => $username);

            //kiem tra username da ton tai chua
            if($this->admin_model->check_exists($where)){
                //tra ve thong bao loi
                $this->form_validation->set_message(__FUNCTION__. 'Tai khoan da ton tai');
                return false;
            }
            return true;
        }

        //them moi
        function add(){
            $this->load->library('form_validation');
            $this->load->helper('form');
            
            //neu co du lieu post len thi kiem tra
            if($this->input->post()){
                $this->form_validation->set_rules('name', 'name', 'required|min_length[8]');
                $this->form_validation->set_rules('username', 'username', 'required');
                $this->form_validation->set_rules('password', 'password', 'required|min_length[6]');
                $this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'matches[password]');

                //nhap lieu chinh xac
                if($this->form_validation->run()){
                    //them vao csdl
                    $name = $this->input->post('name');
                    $username = $this->input->post('username');
                    $password = $this->input->post('password');
                    $data = array(
                        'name' => $name,
                        'username' => $username,
                        'password' => md5($password)  
                    );

                    if($this->admin_model->create($data)){
                        echo 'Them thanh cong';
                    }
                    else{
                        echo 'Them that bai';
                    }
                }
            }

            $this->data['temp'] = 'admin/admin/add';
            $this->load->view('admin/main', $this->data);
        }

        /**
         * Chuc nang logout admin by Qui
         */
        function logout(){
            if($this->session->userdata('login')){
                $this->session->unset_userdata('login');
            }
            redirect(admin_url('login'));
        }
    }
?>