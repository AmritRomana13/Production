<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Myaccount extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Common_model', 'common');
    }

    public function index()
    {
        if (is_loggedin_user()){
            $header_data['title'] = 'My Account';

            $where_data = array(
                'user_id'   => get_user_sessiondata('id')
            );
            $data['orders'] = $this->common->getdatabytableall('orders', $where_data);

            $this->load->view('user/common/header', $header_data);
            $this->load->view('user/myaccount/index',$data);
            $this->load->view('user/common/footer');
        } else {
            redirect('auth/login');
        }
    }

    public function view_order($order_id){
        if (is_loggedin_user()){
            $header_data['title'] = 'View Order';

            $where_data = array(
                'user_id'   => get_user_sessiondata('id'),
                'id'        => $order_id
            );

            $data['order_data'] = $this->common->getdatabytable('orders', $where_data);
            if(!empty($data['order_data'])){
                $data['order_products'] = $this->common->get_order_data($order_id,get_user_sessiondata('id'));

                $this->load->view('user/common/header', $header_data);
                $this->load->view('user/myaccount/view_order', $data);
                $this->load->view('user/common/footer');
            } else {
                redirect('myaccount');
            }
        } else {
            redirect('auth/login');
        }
    }
}
