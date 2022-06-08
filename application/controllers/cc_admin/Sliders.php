<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Sliders extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Common_model', 'common');
        $this->load->helper('string');
    }

    public function index()
    {
        if (is_loggedin_admin()) {

            $header_data['title'] = 'Dashboard || ' . config_item('application_name');

            $header_data['datatable'] = true;
            $footer_data['datatable'] = true;

            $header_data['sweet_alert'] = true;
            $footer_data['sweet_alert'] = true;

            $data['sliders'] = $this->common->getdatabytableall('sliders');
            $this->load->view('admin/common/header', $header_data);
            $this->load->view('admin/common/sidebar');
            $this->load->view('admin/slider/index',$data);
            $this->load->view('admin/common/footer', $footer_data);
            $this->load->view('admin/validation/slider_list');
        } else {
            $data['title'] = 'Login || ' . config_item('application_name');

            $this->load->view('admin/auth/login', $data);
        }
    }


    public function add()
    {
        if (is_loggedin_admin()) {

            $header_data['title'] = 'Add Slider || ' . config_item('application_name');

            $header_data['form_validation'] = true;
            $footer_data['form_validation'] = true;

            $this->load->view('admin/common/header', $header_data);
            $this->load->view('admin/common/sidebar');
            $this->load->view('admin/slider/add',);
            $this->load->view('admin/common/footer', $footer_data);
            $this->load->view('admin/validation/slider');
        } else {
            $data['title'] = 'Login || ' . config_item('application_name');

            $this->load->view('admin/auth/login', $data);
        }
    }

    public function add_slider()
    {
        if (is_loggedin_admin()) {
            $post_data = html_escape($this->input->post());
            if(!empty($post_data)){
                $fileexe = explode(".", $_FILES["image"]["name"]);
                if (in_array(end($fileexe), config_item('img_extensions')) === true){
                    $output_dir = FCPATH . 'uploads/sliders/';
                    $fileName = date('YmdHis') . '.' . end($fileexe);
                     if (move_uploaded_file($_FILES["image"]["tmp_name"], $output_dir . $fileName)){
                         $slider_data = array(
                            'top_title'     => $post_data['top_title'],
                            'image'         => $fileName,
                         );

                         $slider_id = $this->common->insert($slider_data, 'sliders');

                         if(!empty($slider_id)){
                            $resposnse = array(
                                'status'    => 200,
                                'message'   => 'Slider created successfully'
                            );
                         } else {
                            $resposnse = array(
                                'status'    => 400,
                                'message'   => 'Someting went worng..'
                            );
                         }
                     } else {
                        $resposnse = array(
                            'status'    => 400,
                            'message'   => 'Image Upload failed..'
                        );
                     }
                } else {
                    $resposnse = array(
                        'status'    => 400,
                        'message'   => 'Please select Valid file..'
                    );
                }
            } else {
                $resposnse = array(
                    'status'    => 400,
                    'message'   => 'Some data is missed..'
                );
            }
        } else {
            $resposnse = array(
                'status'    => 400,
                'message'   => 'Please Login..'
            );
        }
        echo json_encode($resposnse);
    }

    public function product_banners(){
        if (is_loggedin_admin()) {

            $header_data['title'] = 'Add Product Banners || ' . config_item('application_name');

            $header_data['form_validation'] = true;
            $footer_data['form_validation'] = true;

            $header_data['select_2'] = true;
            $footer_data['select_2'] = true;

            $data['products'] = $this->common->getdatabytableall('products');

            $where_data = array(
                'banner_id' => 1
            );
            $data['banners_1'] = $this->common->getdatabytable('product_banners', $where_data);

            

            $where_data = array(
                'banner_id' => 2
            );
            $data['banners_2'] = $this->common->getdatabytable('product_banners', $where_data);

            $this->load->view('admin/common/header', $header_data);
            $this->load->view('admin/common/sidebar');
            $this->load->view('admin/slider/product_banners',$data);
            $this->load->view('admin/common/footer', $footer_data);
            $this->load->view('admin/validation/product_banners');
        } else {
            $data['title'] = 'Login || ' . config_item('application_name');

            $this->load->view('admin/auth/login', $data);
        }
    }

    public function add_product_banners()
    {
        if (is_loggedin_admin()) {
            $post_data = html_escape($this->input->post());
            if(!empty($post_data)){
                $output_dir_pdf = FCPATH . 'uploads/banners/';


                $banner_1_data = array(
                    'product_1' => $post_data['product_1_1'],
                    'product_2' => $post_data['product_1_2'],
                    'product_3' => $post_data['product_1_3'],
                    'product_4' => $post_data['product_1_4'],
                    'title'     => $post_data['banner_title_1']
                );

                $banner_2_data = array(
                    'product_1' => $post_data['product_2_1'],
                    'product_2' => $post_data['product_2_2'],
                    'product_3' => $post_data['product_2_3'],
                    'product_4' => $post_data['product_2_4'],
                    'title'     => $post_data['banner_title_2']
                );

                if (!empty($_FILES["image_1"]["name"])) {
                    $fileexe_1 = explode(".", $_FILES["image_1"]["name"]);
                    if (in_array(end($fileexe_1), config_item('img_extensions')) === true) {
                        $fileName = date('YmdHis') . random_string('alnum', 16) . '.' . end($fileexe_1);
                        if (move_uploaded_file($_FILES["image_1"]["tmp_name"], $output_dir_pdf . $fileName)) {
                            $banner_1_data['image'] = $fileName;
                        }
                    } else {
                        $resposnse = array(
                                'status'    => 400,
                                'message'   => 'Image Not Valid'
                            );
                        echo json_encode(@$resposnse);
                        die;
                    }
                }


                if (!empty($_FILES["image_2"]["name"])) {
                    $fileexe_2 = explode(".", $_FILES["image_2"]["name"]);
                    if (in_array(end($fileexe_2), config_item('img_extensions')) === true) {
                        $fileName_2 = date('YmdHis') . random_string('alnum', 16) . '.' . end($fileexe_2);
                        if (move_uploaded_file($_FILES["image_2"]["tmp_name"], $output_dir_pdf . $fileName_2)) {
                            $banner_2_data['image'] = $fileName_2;
                        }
                    } else {
                        $resposnse = array(
                            'status'    => 400,
                            'message'   => 'Image Not Valid'
                        );
                        echo json_encode(@$resposnse);
                        die;
                    }
                }


                $where_data_1 = array(
                    'banner_id' => 1
                );
                $where_data_2 = array(
                    'banner_id' => 2
                );


                $update = $this->common->update('product_banners', $banner_1_data, $where_data_1);
                $update = $this->common->update('product_banners', $banner_2_data, $where_data_2);

                $resposnse = array(
                    'status'    => 200,
                    'message'   => 'Banner Data updated..'
                );

            } else {
                $resposnse = array(
                    'status'    => 400,
                    'message'   => 'Post Data is missed..'
                );
            }
        } else {
            $resposnse = array(
                'status'    => 400,
                'message'   => 'Please Login..'
            );
        }

        echo json_encode(@$resposnse);
    }

    public function banners()
    {
        if (is_loggedin_admin()) {

            $header_data['title'] = 'Banners || ' . config_item('application_name');

            $header_data['datatable'] = true;
            $footer_data['datatable'] = true;

            $header_data['sweet_alert'] = true;
            $footer_data['sweet_alert'] = true;

            
            $data['banners'] = $this->common->getdatabytableall('banners');
            $this->load->view('admin/common/header', $header_data);
            $this->load->view('admin/common/sidebar');
            $this->load->view('admin/slider/banners', $data);
            $this->load->view('admin/common/footer', $footer_data);
            $this->load->view('admin/validation/slider_list');
        } else {
            $data['title'] = 'Login || ' . config_item('application_name');

            $this->load->view('admin/auth/login', $data);
        }
    }

    public function add_banner()
    {
        if (is_loggedin_admin()) {

            $header_data['title'] = 'Add Banner || ' . config_item('application_name');

            $header_data['form_validation'] = true;
            $footer_data['form_validation'] = true;

            
            $this->load->view('admin/common/header', $header_data);
            $this->load->view('admin/common/sidebar');
            $this->load->view('admin/slider/add_banner',);
            $this->load->view('admin/common/footer', $footer_data);
            $this->load->view('admin/validation/banner');
        } else {
            $data['title'] = 'Login || ' . config_item('application_name');

            $this->load->view('admin/auth/login', $data);
        }
    }

    public function submit_banner()
    {
        if (is_loggedin_admin()) {
            $post_data = html_escape($this->input->post());
            if (!empty($post_data)) {
                $fileexe = explode(".", $_FILES["image"]["name"]);
                if (in_array(end($fileexe), config_item('img_extensions')) === true) {
                    $output_dir = FCPATH . 'uploads/banners/';
                    $fileName = date('YmdHis') . '.' . end($fileexe);
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $output_dir . $fileName)) {
                        $slider_data = array(
                            'title'     => $post_data['top_title'],
                            'image'         => $fileName,
                        );

                        $slider_id = $this->common->insert($slider_data, 'banners');

                        if (!empty($slider_id)) {
                            $resposnse = array(
                                'status'    => 200,
                                'message'   => 'Banner created successfully'
                            );
                        } else {
                            $resposnse = array(
                                'status'    => 400,
                                'message'   => 'Someting went worng..'
                            );
                        }
                    } else {
                        $resposnse = array(
                            'status'    => 400,
                            'message'   => 'Image Upload failed..'
                        );
                    }
                } else {
                    $resposnse = array(
                        'status'    => 400,
                        'message'   => 'Please select Valid file..'
                    );
                }
            } else {
                $resposnse = array(
                    'status'    => 400,
                    'message'   => 'Some data is missed..'
                );
            }
        } else {
            $resposnse = array(
                'status'    => 400,
                'message'   => 'Please Login..'
            );
        }
        echo json_encode($resposnse);
    }


    public function delete_banner()
    {
        if (is_loggedin_admin()) {
            $post_data = html_escape($this->input->post());
            if (!empty($post_data['cat_id'])) {
                $where = array(
                    'id'    => $post_data['cat_id']
                );
                $delete = $this->common->deleteWhere('banners', $where);
                if (!empty($delete)) {
                    $response = array(
                        'status'   => 200,
                        'message'  => 'Banner deleted successfully'
                    );
                } else {
                    $response = array(
                        'status'   => 400,
                        'message'  => 'Someting went worng..'
                    );
                }
            } else {
                $response = array(
                    'status'   => 400,
                    'message'  => 'Please select Banner'
                );
            }
        } else {
            $response = array(
                'status'   => 400,
                'message'  => 'Please Login..'
            );
        }
        echo json_encode(@$response);
    }

    public function delete_slider()
    {
        if (is_loggedin_admin()) {
            $post_data = html_escape($this->input->post());
            if (!empty($post_data['cat_id'])) {
                $where = array(
                    'id'    => $post_data['cat_id']
                );
                $delete = $this->common->deleteWhere('sliders', $where);
                if (!empty($delete)) {
                    $response = array(
                        'status'   => 200,
                        'message'  => 'Slider deleted successfully'
                    );
                } else {
                    $response = array(
                        'status'   => 400,
                        'message'  => 'Someting went worng..'
                    );
                }
            } else {
                $response = array(
                    'status'   => 400,
                    'message'  => 'Please select Slider'
                );
            }
        } else {
            $response = array(
                'status'   => 400,
                'message'  => 'Please Login..'
            );
        }
        echo json_encode(@$response);
    }
}