<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Categories extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Common_model', 'common');
    }

    public function index()
    {
        if (is_loggedin_admin()) {

            $header_data['title'] = 'Categories || ' . config_item('application_name');

            $data['categories'] = $this->common->getdatabytableall('categories');

            $header_data['datatable'] = true;
            $footer_data['datatable'] = true;

            $header_data['sweet_alert'] = true;
            $footer_data['sweet_alert'] = true;

            $header_data['select_2'] = true;
            $footer_data['select_2'] = true;

            $header_data['form_validation'] = true;
            $footer_data['form_validation'] = true;

            $this->load->view('admin/common/header', $header_data);
            $this->load->view('admin/common/sidebar');
            $this->load->view('admin/categories/index',$data);
            $this->load->view('admin/common/footer');
            $this->load->view('admin/validation/categories');
        } else {
            $data['title'] = 'Login || ' . config_item('application_name');

            $this->load->view('admin/auth/login', $data);
        }
    }

    public function brands()
    {
        if (is_loggedin_admin()) {

            $header_data['title'] = 'Brands || ' . config_item('application_name');

            $data['brands'] = $this->common->getdatabytableall('brands');

            $header_data['datatable'] = true;
            $footer_data['datatable'] = true;

            $header_data['sweet_alert'] = true;
            $footer_data['sweet_alert'] = true;

            $header_data['select_2'] = true;
            $footer_data['select_2'] = true;

            $header_data['form_validation'] = true;
            $footer_data['form_validation'] = true;

            $this->load->view('admin/common/header', $header_data);
            $this->load->view('admin/common/sidebar');
            $this->load->view('admin/categories/brands', $data);
            $this->load->view('admin/common/footer');
            $this->load->view('admin/validation/brands');
        } else {
            $data['title'] = 'Login || ' . config_item('application_name');

            $this->load->view('admin/auth/login', $data);
        }
    }

    public function add(){
        if (is_loggedin_admin()) {
            $post_data = html_escape($this->input->post());
            if (!empty($post_data['category_name']) && !empty($post_data['category_position'])) {
                $slider_data = array(
                    'category_name'     => $post_data['category_name'],
                    'position'          => $post_data['category_position'],
                    'parent_category_id'=> $post_data['parent_category'],
                    'featured'          => $post_data['featured']

                );

                $insert = $this->common->insert($slider_data, 'categories');
                if (!empty($insert)) {
                    $response = array(
                        'status'   => 200,
                        'message'  => 'Category created successfully'
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
                    'message'  => 'Please  fill form'
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

    public function add_brand()
    {
        if (is_loggedin_admin()) {
            $post_data = html_escape($this->input->post());
            if (!empty($post_data['brand_name'])) {
                $slider_data = array(
                    'brand_name'     => $post_data['brand_name']

                );

                $insert = $this->common->insert($slider_data, 'brands');
                if (!empty($insert)) {
                    $response = array(
                        'status'   => 200,
                        'message'  => 'Brand created successfully'
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
                    'message'  => 'Please  fill form'
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


    public function delete()
    {
        if (is_loggedin_admin()) {
            $post_data = html_escape($this->input->post());
            if (!empty($post_data['cat_id'])) {
                $where = array(
                    'id'    => $post_data['cat_id']
                );
                $delete = $this->common->deleteWhere('categories', $where);
                if (!empty($delete)) {
                    $response = array(
                        'status'   => 200,
                        'message'  => 'Category deleted successfully'
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
                    'message'  => 'Please select Category'
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

    public function delete_brand()
    {
        if (is_loggedin_admin()) {
            $post_data = html_escape($this->input->post());
            if (!empty($post_data['cat_id'])) {
                $where = array(
                    'id'    => $post_data['cat_id']
                );
                $delete = $this->common->deleteWhere('brands', $where);
                if (!empty($delete)) {
                    $response = array(
                        'status'   => 200,
                        'message'  => 'Brand deleted successfully'
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
                    'message'  => 'Please select Category'
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
    public function getsubcats()
    {
        if (is_loggedin_admin()) {
            $post_data = html_escape($this->input->post());
            if (!empty($post_data['top_category']) && $post_data['top_category'] != 'all') {
                $where_data = array(
                    'parent_category_id =' => $post_data['top_category']
                );
                $categorys = $this->common->getdatabytableall('categories', $where_data);
                if (!empty($categorys)) {
                    $options = '<option value="">Select Sub Category </option>';
                    foreach ($categorys as $key => $category) {
                        # code...
                        $options .= '<option value="' . $category->id . '">' . $category->category_name . '</option>';
                    }

                    $response = array(
                        'status'    => 200,
                        'options'   => $options,
                    );
                } else {
                    $response = array(
                        'status'    => 200,
                        'options'   => '<option value="">No Category Found</option>',
                    );
                }
            } else {
                $response = array(
                    'status'    => 200,
                    'options'   => '<option value="">No Category Found</option>',
                );
            }
        } else {
            $response = array(
                'status'    => 400,
                'message'   => 'Please login again',
            );
        }
        echo json_encode(@$response);
    }

    public function get_data()
    {
        if (is_loggedin_admin()) {
            $post_data = html_escape($this->input->post());
            if(!empty($post_data['cat_id'])){
                $where_data = array(
                    'id'    => $post_data['cat_id']
                );
                $cat_data = $this->common->getdatabytable('categories', $where_data);
                if(!empty($cat_data)){
                    $response = array(
                        'status'    => 200,
                        'message'   => '..',
                        'data'      => $cat_data
                    );
                } else {
                    $response = array(
                        'status'    => 400,
                        'message'   => 'Please select cat id',
                    );
                }
            } else {
                $response = array(
                    'status'    => 400,
                    'message'   => 'Please select cat id',
                );
            }
        } else {
            $response = array(
                'status'    => 400,
                'message'   => 'Please login again',
            );
        }
        echo json_encode(@$response);
    }

    public function update()
    {
        if (is_loggedin_admin()) {
            $post_data = html_escape($this->input->post());
            if (!empty($post_data['category_nameedit'])&& !empty($post_data['category_position_edit']) && !empty($post_data['cat_id'])) {
                $slider_data = array(
                    'category_name'         => $post_data['category_nameedit'],
                    'position'              => $post_data['category_position_edit'],
                    'parent_category_id'    => @$post_data['parent_category_edit'],
                    'featured'              => $post_data['featured_edit']
                );

                $where_data = array(
                    'id'    => $post_data['cat_id']
                );

                $update = $this->common->update('categories', $slider_data, $where_data);
                if (!empty($update)) {
                    $response = array(
                        'status'   => 200,
                        'message'  => 'Category update.. successfully'
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
                    'message'  => 'Please  fill form'
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
