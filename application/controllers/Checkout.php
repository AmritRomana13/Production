<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . '../vendor/autoload.php';

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class Checkout extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Common_model', 'common');
    }

    public function index()
    {
        if (is_loggedin_user()) {
            $data['products'] = $this->common->getusercart(get_user_sessiondata('id'));
            if (!empty($data['products'])) {
                $header_data['title'] = 'Checkout || ' . config_item('application_name');

                $header_data['form_validation'] = true;
                $footer_data['form_validation'] = true;

                $this->load->view('user/common/header', $header_data);
                $this->load->view('user/checkout/index', $data);
                $this->load->view('user/common/footer', $footer_data);
                $this->load->view('user/validation/checkout');
            } else {
                redirect('/');
            }
        } else {
            redirect('auth/login');
        }
    }

    public function getdata()
    {
        if (is_loggedin_user()) {
            $products = $this->common->getusercart(get_user_sessiondata('id'));
            if(!empty($products)){

                $total_array = array();
                $total_amount = 0;

                foreach ($products as $product) {
                    $total_array[] = $product->sale_price * $product->qty;
                }

                $total_amount = array_sum($total_array);

                if ($total_amount > 0) {
                    $razorpayPopup = 1;

                    $keyId = config_item('razorpay_key');
                    $keySecret = config_item('razorpay_sec');


                    $displayCurrency = 'INR';

                    $api = new Api($keyId, $keySecret);

                    $orderData = [
                        'amount'          => $total_amount * 100,
                        'currency'        => 'INR',
                        'payment_capture' => 1
                    ];

                    $razorpayOrder = $api->order->create($orderData);
                    $razorpayOrderId = $razorpayOrder['id'];
                    $_SESSION['razorpay_order_id'] = $razorpayOrderId;
                    $displayAmount = $amount = $orderData['amount'];


                    // if ($displayCurrency !== 'INR') {

                    //     $displayAmount = $amount / 100;
                    // }

                    $user_data = get_userdetails();

                    $data = [
                        "key"               => $keyId,
                        "amount"            => $amount,
                        "name"              => config_item('application_name'),
                        "description"       => "Pay with Card / Net Banking / Wallets",
                        "image"             => base_url() . "admin_assets/images/logo-light.png",
                        "prefill"           => [
                            "name"              => $user_data->first_name.' ' . $user_data->last_name,
                            "email"             => $user_data->email,
                        ],
                        "notes"             => [
                            "address"           => config_item('application_name'),

                        ],
                        "theme"             => [
                            "color"             => "#00002d"
                        ],
                        "order_id"          => $razorpayOrderId,
                    ];

                    if ($displayCurrency !== 'INR') {
                        $data['display_currency']  = $displayCurrency;
                        $data['display_amount']    = $displayAmount;
                    }

                    $response = array(
                        "status" => 200,
                        "razorpayPopup" => $razorpayPopup,
                        "razorpayData" => json_encode($data)
                    );
                } else {
                    $response = array(
                        'status'    => 400,
                        'message'   => 'Need min amount..'
                    );
                }

            } else {
                $response = array(
                    'status'    => 400,
                    'message'   => 'Please add some products to cart..'
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

    public function complete_payment()
    {
        if (is_loggedin_user()) {
            $post_data = html_escape($this->input->post());
            if (!empty($post_data['razorpay_payment_id']) && !empty($post_data['razorpay_signature']) && !empty($post_data['razorpay_order_id'])) {
                if ($this->check_payid($post_data['razorpay_payment_id'])) {
                    $keyId = config_item('razorpay_key');
                    $keySecret = config_item('razorpay_sec');

                    $api = new Api($keyId, $keySecret);

                    $products = $this->common->getusercart(get_user_sessiondata('id'));
                    if (!empty($products)) {
                        $total_array = array();
                        foreach ($products as $product) {
                            $total_array[] = $product->sale_price * $product->qty  ;
                        }
                        try {
                            $attributes = array(
                                'razorpay_order_id' => $post_data['razorpay_order_id'],
                                'razorpay_payment_id' => $post_data['razorpay_payment_id'],
                                'razorpay_signature' => $post_data['razorpay_signature']
                            );

                            $res = $api->utility->verifyPaymentSignature($attributes);

                            $order_id__ = $order_id = explode('_', $post_data['razorpay_order_id'])[1];
                            $this->db->trans_start();

                            $order_data = array(
                                'order_id '             => $order_id__,
                                'user_id'               => get_user_sessiondata('id'),
                                'first_name'            => $post_data['firstname'],
                                'last_name'             => $post_data['lastname'],
                                'email'                 => $post_data['email'],
                                'phone'                 => $post_data['telephone'],
                                'company'               => $post_data['company'],
                                'address_1'             => $post_data['address_1'],
                                'address_2'             => $post_data['address_2'],
                                'city'                  => $post_data['city'],
                                'postcode'              => $post_data['postcode'],
                                'country_id'            => $post_data['country_id'],
                                'zone_id'               => $post_data['zone_id'],
                                'order_note'            => $post_data['order_note'],
                                'razorpay_payment_id'   => $post_data['razorpay_payment_id'],
                                'razorpay_signature'    => $post_data['razorpay_signature'],
                                'razorpay_order_id'     => $post_data['razorpay_order_id'],
                                'total_amount'          => array_sum($total_array)
                            );
                            $order_id = $this->common->insert($order_data, 'orders');

                            if (!empty($order_id)) {

                                foreach ($products as $product) {
                                    $order_product_data = array(
                                        'user_id'       => get_user_sessiondata('id'),
                                        'order_id'      => $order_id,
                                        'product_id'    => $product->id,
                                        'size'          => $product->size,
                                        'item_price'    => $product->sale_price,
                                        'qty'           => $product->qty,
                                        'total_price'   => $product->qty * $product->sale_price,
                                    );

                                    $order_product_id = $this->common->insert($order_product_data, 'order_products');
                                    if (empty($order_product_id)) {
                                        $this->db->trans_rollback();
                                        $response = array(
                                            "status" => 400,
                                            "message" => "Someting wentr wrong.."
                                        );
                                        echo json_encode($response);
                                        die;
                                    } else {
                                        $where_data = array(
                                            'product_id'    => $product->id,
                                            'size'          => $product->size,
                                            'user_id'       => get_user_sessiondata('id')
                                        );

                                        $delete_item = $this->common->deleteWhere('cart', $where_data);
                                    }
                                }

                                if ($this->db->trans_status() === FALSE) {

                                    $this->db->trans_rollback();

                                    $response = array(
                                        'status'    => 400,
                                        'message'   => 'Some db error'
                                    );
                                } else {

                                    $this->db->trans_complete();



                                    $response = array(
                                        'status'    => 200,
                                        'message'   => 'Order Placed Successfully',
                                    );
                                }
                            } else {
                                $this->db->trans_rollback();

                                $response = array(
                                    "status" => 400,
                                    "message" => "Someting wentr wrong.."
                                );
                            }
                        } catch (SignatureVerificationError $e) {

                            $response = array(
                                "status" => 400,
                                "message" => $e->getMessage()
                            );
                        }
                    } else {
                        $response = array(
                            "status" => 400,
                            "message" => "Cart is empty"
                        );
                    }
                } else {
                    $response = array(
                        "status" => 400,
                        "message" => "This Payment is duplicated."
                    );
                }
            } else {
                $response = array(
                    'status'    => 400,
                    'message'   => 'Access Denied'
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

    private function check_payid($payid)
    {
        if (!empty($payid)) {
            $where_data = array(
                'razorpay_payment_id'    => $payid
            );
            $get_payment_details = $this->common->getdatabytable('orders', $where_data);
            // print_r($get_payment_details);
            if (empty($get_payment_details)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
