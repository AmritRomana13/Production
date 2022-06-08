<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Home extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Common_model', 'common');
    }

    public function index()
    {
        if (is_loggedin_admin()) {

            $header_data['title'] = 'Dashboard || ' . config_item('application_name');

            $footer_data['apex_chart'] = true;
            $this->load->view('admin/common/header', $header_data);
            $this->load->view('admin/common/sidebar');
            $this->load->view('admin/home/index',);
            $this->load->view('admin/common/footer', $footer_data);
            $this->load->view('admin/validation/home');
        } else {
            $data['title'] = 'Login || ' . config_item('application_name');

            $this->load->view('admin/auth/login', $data);
        }
    }

    public function users()
    {
        if (is_loggedin_admin()) {

            $header_data['title'] = 'Dashboard || ' . config_item('application_name');

            $header_data['datatable'] = true;
            $footer_data['datatable'] = true;

            $header_data['datatable_buttons'] = true;
            $footer_data['datatable_buttons'] = true;
            
            $this->load->view('admin/common/header', $header_data);
            $this->load->view('admin/common/sidebar');
            $this->load->view('admin/home/users',);
            $this->load->view('admin/common/footer', $footer_data);
            $this->load->view('admin/validation/users');
        } else {
            $data['title'] = 'Login || ' . config_item('application_name');

            $this->load->view('admin/auth/login', $data);
        }
    }

    public function customers_data_ajax(){
        if (is_loggedin_admin()){
            $users = $this->common->getdatabytableall('users');
            $data = array();
            if(!empty($users)){
                $count = 1;
                foreach ($users as $user ) {
                    $data[] = array(
                        $count,
                        $user->first_name,
                        $user->last_name,
                        $user->email,
                        date("d F Y, h:m A", strtotime($user->created_at)),
                    );
                    $count++;
                }
            }
            $respose = array(
                'status'    => 200,
                'message'   => 'Data Found',
                'data'      => $data
            );
        } else{
            $respose = array(
                'status'    => 400,
                'message'   => 'please login',
                'data'      => array()
            );
        }
        echo json_encode(@$respose);
    }
}
