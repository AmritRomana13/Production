<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Common_model', 'common');
    }

    public function login()
    {
        if (!is_loggedin_user()) {
            $header_data['title'] = 'login';

            $header_data['form_validation'] = true;
            $footer_data['form_validation'] = true;


            $this->load->view('user/common/header', $header_data);
            $this->load->view('user/auth/login');
            $this->load->view('user/common/footer', $footer_data);
            $this->load->view('user/validation/auth');
        } else {
            redirect('/');
        }
    }

    public function register()
    {
        if (!is_loggedin_user()) {
            $header_data['title'] = 'Register';

            $header_data['form_validation'] = true;
            $footer_data['form_validation'] = true;

            $this->load->view('user/common/header', $header_data);
            $this->load->view('user/auth/register');
            $this->load->view('user/common/footer', $footer_data);
            $this->load->view('user/validation/auth');
        } else {
            redirect('/');
        }
    }

    public function check_email()
    {
        $post_data = html_escape($this->input->post());
        if (!empty($post_data)) {
            $where_data = array(
                'email' => $post_data['email']
            );

            $check_email = $this->common->getdatabytable('users', $where_data);
            if (!empty($check_email)) {
                echo json_encode(array(
                    'valid' => FALSE,
                ));
            } else {
                echo json_encode(array(
                    'valid' => true,
                ));
            }
        }
    }

    public function complete_signup()
    {
        $post_data = html_escape($this->input->post());
        if (!empty($post_data['first_name']) && !empty($post_data['last_name']) && !empty($post_data['email']) && !empty($post_data['password'])) {
            $user_data = array(
                'first_name'  => $post_data['first_name'],
                'last_name'   => $post_data['last_name'],
                'email'       => $post_data['email'],
                'password'      => md5($post_data['password'])
            );

            $insert = $this->common->insert($user_data, 'users');

            if (!empty($insert)) {
                $response = array(
                    'status'    => 200,
                    'message'   => 'Account created successfuly.'
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
                'message'   => 'Please fill all details...'
            );
        }

        echo json_encode($response);
    }


    public function complete_signin()
    {
        if (!is_loggedin_user()) {
            $post_data = html_escape($this->input->post());
            if (!empty($post_data['username']) && !empty($post_data['password'])) {
                $user_details = $this->common->check_user($post_data);
                if (!empty($user_details)) {
                    $this->session->set_userdata('user_details_user', $user_details);

                    $response = array(
                        "status" => 200,
                        "message" => "Successfully logged in..."
                    );
                } else {
                    $response = array(
                        "status" => 400,
                        "message" => "Incorrect Username/Email or Password..!"
                    );
                }
            } else {
                $response = array(
                    'status'    => 400,
                    'message'   => 'Please fill form..'
                );
            }
        } else {
            $response = array(
                'status'    => 400,
                'message'   => 'Alredy Loged in..'
            );
        }
        echo json_encode(@$response);
    }
}
