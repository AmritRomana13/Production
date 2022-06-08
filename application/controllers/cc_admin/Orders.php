<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Orders extends CI_Controller
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

            $header_data['form_validation'] = true;
            $footer_data['form_validation'] = true;

            $header_data['select_2'] = true;
            $footer_data['select_2'] = true;

            $header_data['datatable'] = true;
            $footer_data['datatable'] = true;

            $header_data['datatable_buttons'] = true;
            $footer_data['datatable_buttons'] = true;

            $header_data['datepicker'] = true;
            $footer_data['datepicker'] = true;

            $this->load->view('admin/common/header', $header_data);
            $this->load->view('admin/common/sidebar');
            $this->load->view('admin/orders/index',);
            $this->load->view('admin/common/footer', $footer_data);
            $this->load->view('admin/validation/orders');
        } else {
            $data['title'] = 'Login || ' . config_item('application_name');

            $this->load->view('admin/auth/login', $data);
        }
    }


    public function sales_report_data()
    {
        if (is_loggedin_admin()) {

            $post_data = html_escape($this->input->post());
            if (!empty($post_data['from_date']) && !empty($post_data['to_date'])) {

                $sales_data = $this->common->getsalesdata($post_data);

                $data = array();

                $total_array = array();

                $meta = array(
                    'total_sale'    => 0,
                );

                if (!empty($sales_data)) {
                    foreach ($sales_data as $sale) {
                        $data[] = array(
                            $sale->created_at,
                            $sale->order_id,
                            $sale->razorpay_payment_id,
                            $sale->first_name.' '. $sale->last_name,
                            $sale->email,
                            $sale->total_amount,
                            '<button type="button" class="btn btn-dark waves-effect waves-light w-100" onclick="print_invoice(\'' . $sale->id . '\')"><i class="uil uil-print me-2"></i> Print Invoice</button>'
                        );

                        $total_array[] = $sale->total_amount;
                    }

                    $total_sale = array_sum($total_array);

                    $meta = array(
                        'total_sale'    =>  array_sum($total_array),
                    );
                }

                $respose = array(
                    'status'    => 200,
                    'message'   => 'Data found..!',
                    'data'      => $data,
                    'meta'      => $meta
                );
            } else {
                $respose = array(
                    'status'    => 400,
                    'message'   => 'Data error..!',
                    'data'      => array()
                );
            }
        } else {
            $respose = array(
                'status'    => 400,
                'message'   => 'please login',
                'data'      => array()
            );
        }
        echo json_encode(@$respose);
    }

    public function print_invoice($oid){
        if (is_loggedin_admin()){
            $where_data = array(
                'id'    => $oid
            );
            $order_data = $this->common->getdatabytable('orders', $where_data);
            if(!empty($order_data)){
                $order_products = $this->common->get_order_data($oid,$order_data->user_id);
                if(!empty($order_products)){
                    $data['order_data']  = $order_data;
                    $data['order_products'] = $order_products;
                    $data['title'] = 'Invoice -'. $order_data->order_id;
                    $this->load->view('admin/invoices/style1',$data);

                    $this->load->library('pdf');

                    $html = $this->output->get_output();
                    $this->pdf->loadHtml($html);
                    $this->pdf->setPaper('A4', 'portrait');

                    $this->pdf->render();
                    $this->pdf->stream("Invoice " . $order_data->order_id . ".pdf", array("Attachment" => 0));
                }
            }
        }
    }
}