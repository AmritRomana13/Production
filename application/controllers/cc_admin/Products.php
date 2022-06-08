<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . '../vendor/autoload.php';

use phpDocumentor\Reflection\Types\Object_;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Products extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Common_model', 'common');
    }

    public function index()
    {
        if (is_loggedin_admin()) {

            $header_data['title'] = 'All Products || ' . config_item('application_name');

            $header_data['form_validation'] = true;
            $footer_data['form_validation'] = true;

            $header_data['select_2'] = true;
            $footer_data['select_2'] = true;

            $header_data['datatable'] = true;
            $footer_data['datatable'] = true;

            $header_data['sweet_alert'] = true;
            $footer_data['sweet_alert'] = true;

            $this->load->view('admin/common/header', $header_data);
            $this->load->view('admin/common/sidebar');
            $this->load->view('admin/products/index',);
            $this->load->view('admin/common/footer', $footer_data);
            $this->load->view('admin/validation/products_list');
        } else {
            $data['title'] = 'Login || ' . config_item('application_name');

            $this->load->view('admin/auth/login', $data);
        }
    }

    public function add()
    {
        if (is_loggedin_admin()) {

            $header_data['title'] = 'Add Product || ' . config_item('application_name');

            $header_data['form_validation'] = true;
            $footer_data['form_validation'] = true;

            $header_data['select_2'] = true;
            $footer_data['select_2'] = true;

            $header_data['js_tree'] = true;
            $footer_data['js_tree'] = true;

            $this->load->view('admin/common/header', $header_data);
            $this->load->view('admin/common/sidebar');
            $this->load->view('admin/products/add',);
            $this->load->view('admin/common/footer', $footer_data);
            $this->load->view('admin/validation/products');
            $this->load->view('admin/validation/drag_and_drop');
        } else {
            $data['title'] = 'Login || ' . config_item('application_name');

            $this->load->view('admin/auth/login', $data);
        }
    }

    public function add_newproduct()
    {
        if (is_loggedin_admin()) {
            $post_data = html_escape($this->input->post());
            if (!empty($post_data['product_name']) && !empty($post_data['mrp']) && !empty($post_data['sale_price']) && !empty($post_data['short_description']) && !empty($post_data['description']) && !empty($post_data['cat_id']) && !empty($post_data['brand'])&& !empty($post_data['img_path']) && !empty($post_data['size'][0])) {
                $product_data = array(
                    'product_name'      => $post_data['product_name'],
                    'slug'              => url_title(convert_accented_characters($post_data['product_name']), 'dash', true) . '_' . time(),
                    'cat_id'            => $post_data['cat_id'],
                    'brand_id'          => $post_data['brand'],
                    'product_price'     => $post_data['mrp'],
                    'images'            => json_encode($post_data['img_path']),
                    'sale_price'        => $post_data['sale_price'],
                    'description'       => $this->input->post('description'),
                    'short_description' => $post_data['short_description'],
                    'sizes'             => implode(',', $post_data['size']),
                    'fetured'           => $post_data['fetured'],
                    'status'            => 1,
                    'created_by'        => get_admin_sessiondata('id')
                );
                $insert = $this->common->insert($product_data, 'products');
                if (!empty($insert)) {
                    $response = array(
                        'status'   => 200,
                        'message'  => 'New Product addedd successfully'
                    );
                } else {
                    $response = array(
                        'status'   => 400,
                        'message'  => 'Someting went worng..'
                    );
                }
            } else {
                $response = array(
                    'status'    => 400,
                    'message'   => 'Somefeilds are mandatory'
                );
            }
        } else {
            $response = array(
                'status'    => 400,
                'message'   => 'Please login'
            );
        }

        echo json_encode($response);
    }

    public function products_data_ajax()
    {
        if (is_loggedin_admin()){
            $post_data = html_escape($this->input->post());
            if(!empty($post_data['top_category'])){

                $top_cat = $post_data['top_category'];
                $get_all_subcats = getsubcats($top_cat);

                if ($top_cat != 'all') {
                    $sub_cats_array = array();
                    if (!empty($get_all_subcats)) {
                        foreach ($get_all_subcats as $key => $cat) {
                            $sub_cats_array[] = $cat->id;
                        }
                    }
                }

                $sub_cats_array[] = $top_cat;

                $products = $this->common->getproductsnyfilter($sub_cats_array, $post_data);

                if (!empty($products)) {
                    foreach ($products as $key => $product) {

                        $status = null;
                        if ($product->status == 1) {
                            $status = '<div class="badge bg-soft-success font-size-12 p-status">Active</div>';
                            $next_status = 2;
                        } else if ($product->status == 2) {
                            $status = '<div class="badge bg-soft-warning font-size-12 p-status">In-Active</div>';
                            $next_status = 1;
                        }

                        $product_price = '<del> '. $product->product_price.'</del> <br>  '. $product->sale_price;

                        $data[] = array(
                            $product->id,
                            $product->product_name,
                            $product_price,
                            '<img src="' . base_url('uploads/products/') .  json_decode($product->images)[0] . '" alt="" class="rounded avatar-lg">',
                            $status,
                            '<a href="' . base_url("cc_admin/products/edit/") . $product->id  . '" target="_blank" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                        <button onclick="change_status_product(' . $product->id  . ', 3,this)" href="javascript:void(0);" class="btn px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></button>
                        <button onclick="change_status_product(' . $product->id  . ',' . $next_status . ',this)" href="javascript:void(0);" class="btn px-3 text-info"><i class="uil uil-eye font-size-18"></i></button>' 
                        );
                    }

                    $response = array(
                        'status'    => 200,
                        'message'   => 'No Data Found',
                        'data'      => $data
                    );
                } else {
                    $response = array(
                        'status'    => 400,
                        'message'   => 'No Data Found',
                        'data'      => array()
                    );
                }
            } else {
                $response = array(
                    'status'    => 400,
                    'message'   => 'Some data is missed.',
                    'data'      => array()
                );
            }
        } else {
            $response = array(
                'status'    => 400,
                'message'   => 'Please login',
                'data'      => array()
            );
        }
        echo json_encode(@$response);
    }

    public function edit(Int $product_id)
    {
        if (is_loggedin_admin()) {

            $where_data = array(
                'id'        => $product_id,
                'status !=' => 3
            );
            $data['product_data'] = $this->common->getdatabytable('products',$where_data);
            if(!empty($data['product_data'])){
                $header_data['title'] = 'Edit Product || ' . config_item('application_name');

                $header_data['form_validation'] = true;
                $footer_data['form_validation'] = true;

                $header_data['select_2'] = true;
                $footer_data['select_2'] = true;

                $header_data['js_tree'] = true;
                $footer_data['js_tree'] = true;

                $validation_data['cat_id'] = $data['product_data']->cat_id;

                $this->load->view('admin/common/header', $header_data);
                $this->load->view('admin/common/sidebar');
                $this->load->view('admin/products/edit',$data);
                $this->load->view('admin/common/footer', $footer_data);
                $this->load->view('admin/validation/products', $validation_data);
                $this->load->view('admin/validation/drag_and_drop');
            } else {
                redirect('cc_admin/products');
            }

            
        } else {
            $data['title'] = 'Login || ' . config_item('application_name');

            $this->load->view('admin/auth/login', $data);
        }
    }

    public function update_product()
    {
        if (is_loggedin_admin()) {
            $post_data = html_escape($this->input->post());
            if (!empty($post_data['product_name']) && !empty($post_data['mrp']) && !empty($post_data['sale_price']) && !empty($post_data['short_description']) && !empty($post_data['description']) && !empty($post_data['cat_id']) && !empty($post_data['brand']) && !empty($post_data['img_path']) && !empty($post_data['size'][0])&& !empty($post_data['product_id'])) {
                $product_data = array(
                    'product_name'      => $post_data['product_name'],
                    'slug'              => url_title(convert_accented_characters($post_data['product_name']), 'dash', true) . '_' . time(),
                    'cat_id'            => $post_data['cat_id'],
                    'brand_id'          => $post_data['brand'],
                    'product_price'     => $post_data['mrp'],
                    'images'            => json_encode($post_data['img_path']),
                    'sale_price'        => $post_data['sale_price'],
                    'description'       => $this->input->post('description'),
                    'short_description' => $post_data['short_description'],
                    'sizes'             => implode(',', $post_data['size']),
                    'fetured'           => $post_data['fetured'],
                );
                $where_data = array(
                    'id'    => $post_data['product_id']
                );

                $update = $this->common->update('products', $product_data, $where_data);

                if (!empty($update)) {
                    $response = array(
                        'status'   => 200,
                        'message'  => 'Product update successfully'
                    );
                } else {
                    $response = array(
                        'status'   => 400,
                        'message'  => 'Someting went worng..'
                    );
                }
            } else {
                $response = array(
                    'status'    => 400,
                    'message'   => 'Somefeilds are mandatory'
                );
            }
        } else {
            $response = array(
                'status'    => 400,
                'message'   => 'Please login'
            );
        }

        echo json_encode($response);
    }

    public function import(){
        if (is_loggedin_admin()) {

            $header_data['title'] = 'Import Products || ' . config_item('application_name');

            $header_data['form_validation'] = true;
            $footer_data['form_validation'] = true;


            $this->load->view('admin/common/header', $header_data);
            $this->load->view('admin/common/sidebar');
            $this->load->view('admin/products/import',);
            $this->load->view('admin/common/footer', $footer_data);
            $this->load->view('admin/validation/import_product');
        } else {
            $data['title'] = 'Login || ' . config_item('application_name');

            $this->load->view('admin/auth/login', $data);
        }
    }


    public function complate_import()
    {
        if (is_loggedin_admin()) {
            if (!empty($_FILES["productsfile"]["name"])) {
                $extensions = array("xlsx", "xls",'csv');
                $fileexe = explode(".", $_FILES["productsfile"]["name"]);
                if (in_array(end($fileexe), $extensions) === true){
                    $input_file = $_FILES["productsfile"]["tmp_name"];

                    $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($input_file);
                    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);

                    $spreadsheet = $reader->load($input_file);

                    $products = $spreadsheet->getActiveSheet()->toArray();

                    array_shift($products);
                    $valid = 0;
                    $invalid = 0;
                    if(!empty($products)){
                        foreach ($products as $key => $product) {
                            $product_data = array(
                                'product_name'      => $product['0'],
                                'slug'              => url_title(convert_accented_characters($product['0']), 'dash', true) . '_' . time(),
                                'cat_id'            => $product['4'],
                                'brand_id'          => $product['3'],
                                'product_price'     => $product['1'],
                                'images'            => '["no-image.jpg"]',
                                'sale_price'        => $product['2'],
                                'description'       => '<p></p>',
                                'short_description' => $product['5'],
                                'sizes'             => $product['6'],
                                'status'            => 1,
                                'created_by'        => get_admin_sessiondata('id')
                            );
                            $insert = $this->common->insert($product_data, 'products');
                            if (!empty($insert)) {
                                $valid = $valid + 1;
                            } else {
                                $invalid = $invalid + 1;
                            }
                        }

                        $response = array(
                            "status" => 200,
                            "message" => "Products Imported successfully.Total Products :" . count($products) . ' Failed Products :' . $invalid
                        );
                    } else {
                        $response = array(
                            'status'   => 400,
                            'message'  => 'No products found in file'
                        );
                    }
                } else {
                    $response = array(
                        'status'   => 400,
                        'message'  => 'Please select valid file'
                    );
                }
            } else {
                $response = array(
                    'status'   => 400,
                    'message'  => 'Please select products file'
                );
            }
        } else {
            $response = array(
                'status'   => 400,
                'message'  => 'Please Login'
            );
        }
        echo json_encode(@$response);
    }

    public function change_status()
    {
        if (is_loggedin_admin()) {
            $post_data = html_escape($this->input->post());

            if (!empty($post_data['status']) && !empty($post_data['id'])) {

                $product_data = array(
                    'status'    => $post_data['status'],
                );

                $where_data = array(
                    'id'    => $post_data['id']
                );
                if($post_data['status'] == 3){
                    //delete product 
                    $update = $this->common->deleteWhere('products', $where_data);
                } else {
                    $update = $this->common->update('products', $product_data, $where_data);
                }
                if (!empty($update)) {
                    $response = array(
                        'status'    => 200,
                        'message'   => 'Products data updated..'
                    );
                } else {
                    $response = array(
                        'status'    => 400,
                        'message'   => 'Someting went worng..'
                    );
                }
            } else {
                $response = array(
                    'status'    => 400,
                    'message'   => 'Some Data is missing..'
                );
            }
        } else {
            $response = array(
                'status'    => 400,
                'message'   => 'Please login again'
            );
        }

        echo json_encode(@$response);
    }
}
