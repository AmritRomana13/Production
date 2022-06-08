<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Cart extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Common_model', 'common');
    }

    public function add_to_cart()
    {
        if (is_loggedin_user()) {
            $post_data = html_escape($this->input->post());
            if (!empty($post_data['product_id']) && !empty($post_data['selected_sizes'])) {
                $cart_data = array(
                    'user_id'       => get_user_sessiondata('id'),
                    'product_id'    => $post_data['product_id'],
                    'size'          => $post_data['selected_sizes']
                );

                $check_cart = $this->common->getdatabytableall('cart', $cart_data);
                if (empty($check_cart)) {
                    $cart_data['qty'] = 1;
                    $cart_id = $this->common->insert($cart_data, 'cart');
                    if (!empty($cart_id)) {
                        $response = array(
                            'status'    => 200,
                            'message'   => 'Product added to cart.'
                        );
                    } else {
                        $response = array(
                            'status'    => 400,
                            'message'   => 'Something went wrong.'
                        );
                    }
                } else {
                    $response = array(
                        'status'    => 400,
                        'message'   => 'Item already added to cart.'
                    );
                }
            } else {
                $response = array(
                    'status'    => 400,
                    'message'   => 'Invalid Product..'
                );
            }
        } else {
            $response = array(
                'status'    => 400,
                'message'   => 'Please login to add item to cart.'
            );
        }
        echo json_encode(@$response);
    }

    public function index()
    {
        if (is_loggedin_user()) {
            $header_data['title'] = 'Cart || ' . config_item('application_name');

            $data['products'] = $this->common->getusercart(get_user_sessiondata('id'));

            $this->load->view('user/common/header', $header_data);

            $this->load->view('user/cart/index', $data);
            $this->load->view('user/common/footer');
            $this->load->view('user/validation/cart');
        } else {
            redirect('auth/login');
        }
    }

    public function remove_from_cart()
    {
        if (is_loggedin_user()) {
            $post_data = html_escape($this->input->post());
            if (!empty($post_data['product_id']) && !empty($post_data['size'])) {
                $cart_data = array(
                    'user_id'       => get_user_sessiondata('id'),
                    'product_id'    => $post_data['product_id'],
                    'size'          => $post_data['size']
                );

                $delete_item = $this->common->deleteWhere('cart', $cart_data);
                if (!empty($delete_item)) {
                    $response = array(
                        'status'    => 200,
                        'message'   => 'Item removed from cart'
                    );
                } else {
                    $response = array(
                        'status'    => 400,
                        'message'   => 'Something went wrong.'
                    );
                }
            } else {
                $response = array(
                    'status'    => 400,
                    'message'   => 'Invalid Product..'
                );
            }
        } else {
            $response = array(
                'status'    => 400,
                'message'   => 'Please login to add item to cart.'
            );
        }
        echo json_encode(@$response);
    }

    public function inc_cart_qty()
    {
        if (is_loggedin_user()) {
            $post_data = html_escape($this->input->post());
            if (!empty($post_data['product_id']) && !empty($post_data['size'])) {
                $update_cart_qty = $this->common->updateCartQty(get_user_sessiondata('id'), $post_data['product_id'], $post_data['size']);
                if (!empty($update_cart_qty)) {
                    $response = array(
                        "status" => 200,
                        "message" => "Quntity Updated.."
                    );
                } else {
                    $response = array(
                        "status" => 400,
                        "message" => "Someting went worng when removing"
                    );
                }
            } else {
                $response = array(
                    'status'    => 400,
                    'message'   => 'Invalid Product..'
                );
            }
        } else {
            $response = array(
                'status'    => 400,
                'message'   => 'Please login to add item to cart.'
            );
        }
        echo json_encode(@$response);
    }


    public function des_cart_qty()
    {
        if (is_loggedin_user()) {
            $post_data = html_escape($this->input->post());
            if (!empty($post_data['product_id']) && !empty($post_data['size'])) {
                $check_cart_where = array(
                    "user_id"       => get_user_sessiondata('id'),
                    "product_id"    => $post_data['product_id'],
                    'size'          => $post_data['size']
                );

                $check_cart = $this->common->getdatabytable('cart', $check_cart_where);
                if (!empty($check_cart)) {

                    $new_qty = $check_cart->qty - 1;
                    if ($new_qty <= 0) {
                        //delete this item
                        $where = array(
                            "user_id"       => get_user_sessiondata('id'),
                            "product_id"    => $post_data['product_id'],
                            'size'          => $post_data['size']
                        );
                        $delete = $this->common->deleteWhere('cart', $where);

                        if (!empty($delete)) {
                            $response = array(
                                "status" => 200,
                                "message" => "Item Removed."
                            );
                        } else {
                            $response = array(
                                "status" => 400,
                                "message" => "Someting went worng when removing"
                            );
                        }
                    } else {
                        $update_cart_qty = $this->common->updatecart_dec(get_user_sessiondata('id'), $post_data['product_id'], $post_data['size']);
                        if (!empty($update_cart_qty)) {
                            $response = array(
                                "status" => 200,
                                "message" => "Quntity Updated.."
                            );
                        } else {
                            $response = array(
                                "status" => 400,
                                "message" => "Someting went worng when updateing.."
                            );
                        }
                    }
                } else {
                    $response = array(
                        'status'    => 400,
                        'message'   => 'No products found in cart..'
                    );
                }
            } else {
                $response = array(
                    'status'    => 400,
                    'message'   => 'Invalid Product..'
                );
            }
        } else {
            $response = array(
                'status'    => 400,
                'message'   => 'Please login to add item to cart.'
            );
        }
        echo json_encode(@$response);
    }

    public function add_to_wishlist()
    {
        if (is_loggedin_user()) {
            $post_data = html_escape($this->input->post());
            if (!empty($post_data['product_id'])) {
                $cart_data = array(
                    'user_id'       => get_user_sessiondata('id'),
                    'product_id'    => $post_data['product_id'],
                );

                $check_wishlist = $this->common->getdatabytableall('wishlist', $cart_data);
                if (empty($check_wishlist)) {
                    $insert = $this->common->insert($cart_data, 'wishlist');
                    if(!empty($insert)){
                        $response = array(
                            'status'    => 200,
                            'message'   => 'item added to wishlist',
                            'btn_text'  => 'Wishlisted'
                        );
                    } else {
                        $response = array(
                            'status'    => 400,
                            'message'   => 'Someting went worng.'
                        );
                    }
                } else {
                    $delete_wishlist = $this->common->deleteWhere('wishlist', $cart_data);
                    if (!empty($delete_wishlist)) {
                        $response = array(
                            'status'    => 200,
                            'message'   => 'item removed from wishlist',
                            'btn_text'  => 'Add To Wishlist'
                        );
                    } else {
                        $response = array(
                            'status'    => 400,
                            'message'   => 'Someting went worng.'
                        );
                    }
                }
            } else {
                $response = array(
                    'status'    => 400,
                    'message'   => 'Invalid Product..'
                );
            }
        } else {
            $response = array(
                'status'    => 400,
                'message'   => 'Please login to add item to cart.'
            );
        }
        echo json_encode(@$response);
    }

    public function wishlist()
    {
        if (is_loggedin_user()) {
            $header_data['title'] = 'Wishlist || ' . config_item('application_name');

            $data['products'] = $this->common->getuserwishlist(get_user_sessiondata('id'));

            $this->load->view('user/common/header', $header_data);

            $this->load->view('user/cart/wishlist', $data);
            $this->load->view('user/common/footer');
            $this->load->view('user/validation/cart');
        } else {
            redirect('auth/login');
        }
    }


    public function remove_from_wishlist()
    {
        if (is_loggedin_user()) {
            $post_data = html_escape($this->input->post());
            if (!empty($post_data['product_id'])) {
                $cart_data = array(
                    'user_id'       => get_user_sessiondata('id'),
                    'product_id'    => $post_data['product_id']
                );

                $delete_item = $this->common->deleteWhere('wishlist', $cart_data);
                if (!empty($delete_item)) {
                    $response = array(
                        'status'    => 200,
                        'message'   => 'Item removed from wishlist'
                    );
                } else {
                    $response = array(
                        'status'    => 400,
                        'message'   => 'Something went wrong.'
                    );
                }
            } else {
                $response = array(
                    'status'    => 400,
                    'message'   => 'Invalid Product..'
                );
            }
        } else {
            $response = array(
                'status'    => 400,
                'message'   => 'Please login'
            );
        }
        echo json_encode(@$response);
    }
}
