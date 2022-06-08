<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Search extends CI_Controller 
{
    function __construct()
    {
        parent::__construct();
        $this->config->load('pagination', TRUE);
        $this->load->helper('url', 'form');
        $this->load->library("pagination");
        $this->load->model('Common_model', 'common');
    }

    public function index(){
        $key_word_data = html_escape($this->input->get());
        $key_word_data = $this->security->xss_clean($key_word_data);
        $keyword = $key_word_data['keyword'];
        if (empty($keyword)) {
            redirect('home');
        }


        $config['base_url'] = base_url('search');
        $config['total_rows'] = $this->common->search_num_rows($keyword);
        $config['per_page'] = 20;

        $config['enable_query_strings'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['use_page_numbers'] = TRUE;
        $config['reuse_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';

        $this->pagination->initialize($config);
        $current_page = $this->input->get('page', 0);
        $offset = ($this->input->get('page')) ? ($this->input->get('page') - 1) * $config['per_page'] : 0;

        $data['products'] = $this->common->search_getproducts($keyword, $config['per_page'], $offset);
        $data['pagination'] = $this->pagination->create_links();

        $header_data['title'] = "Search Reults - " . $keyword . ' || ' . config_item('application_name');

        $data['z'] = $config['total_rows'];

        $data['x'] = (int)$offset + 1;

        if ($offset + $config['per_page'] > $config['total_rows']) {
            $data['y'] = $config['total_rows'];
        } else {
            $data['y'] = (int)$offset + $config['per_page'];
        }
        $data['keyword'] = $keyword;

        $sub_cats_array[] = 'all';
        $available_sizes = $this->common->getsizesincat($sub_cats_array);
        $filterd_available_sizes = array();
        foreach ($available_sizes as $key => $size) {
            $sizes__ = explode(',', $size->sizes);
            if (!empty($sizes__)) {
                foreach ($sizes__ as $key => $size__) {
                    $filterd_available_sizes[] = $size__;
                }
            }
        }
        $final_availabe_sizes = array_unique($filterd_available_sizes);
        $data['availabe_sizes'] = $final_availabe_sizes;

        $this->load->view('user/common/header', $header_data);
        $this->load->view('user/shop/products_search', $data);
        $this->load->view('user/common/footer');

        $this->load->view('user/validation/products_search',);
    }

    public function Filter_search(){
        $key_word_data = html_escape($this->input->get());
        $key_word_data = $this->security->xss_clean($key_word_data);
        $keyword = $key_word_data['keyword'];
        if (empty($keyword)) {
            redirect('home');
        }


        $config['base_url'] = base_url('search/Filter_search');
        $config['total_rows'] = $this->common->search_num_rows_filter($keyword, $key_word_data);
        $config['per_page'] = 1;

        $config['enable_query_strings'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['use_page_numbers'] = TRUE;
        $config['reuse_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';

        $this->pagination->initialize($config);
        $current_page = $this->input->get('page', 0);
        $offset = ($this->input->get('page')) ? ($this->input->get('page') - 1) * $config['per_page'] : 0;

        $data['products'] = $this->common->search_getproducts_filter($keyword, $config['per_page'], $offset, $key_word_data);
        $data['pagination'] = $this->pagination->create_links();

        $header_data['title'] = "Search Reults - " . $keyword . ' || ' . config_item('application_name');

        $data['z'] = $config['total_rows'];

        $data['x'] = (int)$offset + 1;

        if ($offset + $config['per_page'] > $config['total_rows']) {
            $data['y'] = $config['total_rows'];
        } else {
            $data['y'] = (int)$offset + $config['per_page'];
        }
        $data['keyword'] = $keyword;

        $validation_data['minamount'] = @$_GET['minamount'];
        $validation_data['maxamount'] = @$_GET['maxamount'];

        $sub_cats_array[] = 'all';
        $available_sizes = $this->common->getsizesincat($sub_cats_array);
        $filterd_available_sizes = array();
        foreach ($available_sizes as $key => $size) {
            $sizes__ = explode(',', $size->sizes);
            if (!empty($sizes__)) {
                foreach ($sizes__ as $key => $size__) {
                    $filterd_available_sizes[] = $size__;
                }
            }
        }
        $final_availabe_sizes = array_unique($filterd_available_sizes);
        $data['availabe_sizes'] = $final_availabe_sizes;
        
        $this->load->view('user/common/header', $header_data);
        $this->load->view('user/shop/products_search', $data);
        $this->load->view('user/common/footer');

        $this->load->view('user/validation/products_search', $validation_data);

    }
}