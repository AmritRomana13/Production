<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Common_model', 'common');
    }

    public function index(){

        $header_data['title'] = 'Home Page';

        $where_data = array(
            'featured'  => 2
        );
        $slider_data['sliders'] = $this->common->getdatabytableall('sliders');
        $featured_data['featured_categories'] = $this->common->getdatabytableall('categories', $where_data);

        $where_data = array(
            'banner_id' => 1
        );
        $banner_data1['banners'] = $this->common->getdatabytable('product_banners', $where_data);

        $where_data = array(
            'banner_id' => 2
        );
        $banner_data2['banners'] = $this->common->getdatabytable('product_banners', $where_data);

        $banner_data['banners'] = $this->common->getdatabytableall('banners');


        $fetured_product = $this->common->get_fetured_product();
        $this->load->view('user/common/header', $header_data);
        $this->load->view('user/home/slider', $slider_data);
        $this->load->view('user/home/fetured', $featured_data);
        $this->load->view('user/home/product_banners', $banner_data1);
        $this->load->view('user/home/banners', $banner_data);
        if(!empty($fetured_product)){
            $fetured_product_data['product'] = $fetured_product;
            $this->load->view('user/home/fetured_product', $fetured_product_data);
        }
        $this->load->view('user/home/product_banners', $banner_data2);
        $this->load->view('user/common/footer');
    }

    public function contact_us(){
        $header_data['title'] = 'Contact Us || ' . config_item('application_name');
        $header_data['body_class'] = 'contact-template page-template ';
        $this->load->view('user/common/header', $header_data);
        $this->load->view('user/pages/contact_us',);
        $this->load->view('user/common/footer');
    }

    public function submit_contact_form(){
        $post_data = html_escape($this->input->post());
        if(!empty($post_data)){
            // print_r($post_data);

            $this->load->library('email');
            $this->email->initialize(array(
                'protocol' => 'smtp',
                'smtp_host' => config_item('email_host'),
                'smtp_user' => config_item('email_username'),
                'smtp_pass' => config_item('email_password'),
                'smtp_port' => config_item('email_port'),
                'smtp_crypto' => 'ssl',
                'crlf' => "\r\n",
                'newline' => "\r\n",
                'mailtype' => 'html'
            ));
            $mail_body = '
            <b>Full Name:- </b> :'. $post_data['name']. ' <br>
            <b>Email:- </b> :' . $post_data['email'] . ' <br>
            <b>Phone :- </b> :' . $post_data['phone'] . ' <br>
            <b>Subject :- </b> :' . $post_data['subject'] . ' <br>
            <b>Message :- </b> :' . $post_data['message'] . ' <br>
            ';
            $this->email->from(config_item('email_username'), 'Reppin Support');
            $this->email->to('support@reppin.co.in');
            $this->email->subject('Reppin Contact Form');
            $this->email->message($mail_body);
            $this->email->send();
            $res = $this->email->print_debugger();
            $this->session->set_flashdata('message', 'Your enquiry form has been forwarded to the concerned person. We will get back to you soon.');
            redirect('/');
//             echo "<script>
//     alert('Your enquiry form has been forwarded to the concerned person. We will get back to you soon.');
// </script>";
            // echo "<script>window.location='/';</script>";
        } else {
            redirect('/');
        }
    }
}