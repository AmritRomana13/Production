<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Categories extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->config->load('pagination', true);
        $this->load->helper('url', 'form');
        $this->load->library("pagination");
        $this->load->model('Common_model', 'common');
    }


    public function products($cat_id)
    {
        $where_data = array(
            'id'    => $cat_id
        );
        $category_data = $this->common->getdatabytable('categories', $where_data);
        if (!empty($category_data)) {
            $get_all_subcats = getsubcats($cat_id);

            if ($cat_id != 'all') {
                $sub_cats_array = array();
                if (!empty($get_all_subcats)) {
                    foreach ($get_all_subcats as $key => $cat) {
                        $sub_cats_array[] = $cat->id;
                    }
                }
            }

            $sub_cats_array[] = $cat_id;


            $validation_data['catid'] = $cat_id;

            $config['base_url'] = base_url('categories/products/') . $cat_id;
            $config['total_rows'] = $this->common->getAllProductsByCatNameRows($sub_cats_array);

            $config['per_page'] = 20;
            $config['enable_query_strings'] = TRUE;
            $config['page_query_string'] = TRUE;
            $config['use_page_numbers'] = TRUE;
            $config['reuse_query_string'] = TRUE;
            $config['query_string_segment'] = 'page';
            $this->pagination->initialize($config);
            $current_page = $this->input->get('page', 0);
            $offset = ($this->input->get('page')) ? ($this->input->get('page') - 1) * $config['per_page'] : 0;

            $products = $this->common->getAllProductsByCatName($config["per_page"], $offset, $sub_cats_array);
            $data['pagination'] = $this->pagination->create_links();
            $data['products'] = $products;
            $data['category_data'] = $category_data;

            $data['total_rows'] =  $config['total_rows'];

            $header_data['title'] = $category_data->category_name . ' || ' . config_item('application_name');

           

            $data['z'] = $config['total_rows'];

            $data['x'] = (int)$offset + 1;

            if ($offset + $config['per_page'] > $config['total_rows']) {
                $data['y'] = $config['total_rows'];
            } else {
                $data['y'] = (int)$offset + $config['per_page'];
            }

            $available_sizes = $this->common->getsizesincat($sub_cats_array);
            $filterd_available_sizes = array();
            foreach ($available_sizes as $key => $size) {
                $sizes__ = explode(',', $size->sizes);
                if(!empty($sizes__)){
                    foreach ($sizes__ as $key => $size__) {
                        $filterd_available_sizes[] = $size__;
                    }
                }
            }
            $final_availabe_sizes = array_unique($filterd_available_sizes);
            $data['availabe_sizes'] = $final_availabe_sizes;

            $this->load->view('user/common/header', $header_data);
            $this->load->view('user/shop/products', $data);
            $this->load->view('user/common/footer');
            $this->load->view('user/validation/products', $validation_data);
        } else {
            //404...
            $this->output->set_status_header('404');
        }
    }


    public function view_product($slug)
    {

        $where_data = array(
            'slug'      => $slug,
            'status'    => 1
        );

        $product_data = $this->common->getdatabytable('products', $where_data);
        if (!empty($product_data)) {
            $header_data['title'] = $product_data->product_name . '|| ' . config_item('application_name');

            $data['product_data'] = $product_data;

            $product_act_array = explode(',', $product_data->cat_id);
            $related_products = $this->common->getrelatedproducts($product_act_array, $product_data->id);
            $data['related_products'] = $related_products;

            $this->load->view('user/common/header', $header_data);
            $this->load->view('user/shop/view_product', $data);
            $this->load->view('user/common/footer');
            $this->load->view('user/validation/product');
        } else {
            //404..
            $this->output->set_status_header('404');
        }
    }

    public function Filter_category($cat_id){
        $where_data = array(
            'id'    => $cat_id
        );
        $category_data = $this->common->getdatabytable('categories', $where_data);
        if (!empty($category_data)) {

            $get_all_subcats = getsubcats($cat_id);

            if ($cat_id != 'all') {
                $sub_cats_array = array();
                if (!empty($get_all_subcats)) {
                    foreach ($get_all_subcats as $key => $cat) {
                        $sub_cats_array[] = $cat->id;
                    }
                }
            }

            $sub_cats_array[] = $cat_id;
            


            $config['base_url'] = base_url('categories/Filter_category/') . $cat_id;
            $config['total_rows'] = $this->common->getcatfilterproductsrows($sub_cats_array,$_GET);

            $config['per_page'] = 20;
            $config['enable_query_strings'] = TRUE;
            $config['page_query_string'] = TRUE;
            $config['use_page_numbers'] = TRUE;
            $config['reuse_query_string'] = TRUE;
            $config['query_string_segment'] = 'page';
            $this->pagination->initialize($config);
            $current_page = $this->input->get('page', 0);
            $offset = ($this->input->get('page')) ? ($this->input->get('page') - 1) * $config['per_page'] : 0;



            $products = $this->common->getAllProductsByCatNameFilter($config["per_page"], $offset, $sub_cats_array, $_GET);
            $data['pagination'] = $this->pagination->create_links();
            $data['products'] = $products;
            $data['category_data'] = $category_data;

            $data['total_rows'] =  $config['total_rows'];

            $header_data['title'] = $category_data->category_name . ' || ' . config_item('application_name');



            $data['z'] = $config['total_rows'];

            $data['x'] = (int)$offset + 1;

            if ($offset + $config['per_page'] > $config['total_rows']) {
                $data['y'] = $config['total_rows'];
            } else {
                $data['y'] = (int)$offset + $config['per_page'];
            }


            $validation_data['catid'] = $cat_id;
            $validation_data['minamount'] = @$_GET['minamount'];
            $validation_data['maxamount'] = @$_GET['maxamount'];

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
            $this->load->view('user/shop/products', $data);
            $this->load->view('user/common/footer');
            $this->load->view('user/validation/products', $validation_data);

        } else {
            //404...
            $this->output->set_status_header('404');
        }
    }
}