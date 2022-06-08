<?php

function is_loggedin_user()
{
    $CI = &get_instance();
    $user = $CI->session->userdata('user_details_user');
    if ($user) {
        return true;
    } else {
        return false;
    }
}

function get_userdetails($uid = null)
{
    if ($uid == null) {
        $uid = get_user_sessiondata('id');
    }

    $CI = &get_instance();
    $CI->load->model('Common_model', 'common');
    $where = array(
        'id' => $uid
    );
    $user = $CI->common->getdatabytable('users', $where);
    if (!empty($user)) {
        return $user;
    } else {
        return null;
    }
}

function get_user_sessiondata($row)
{
    $CI = &get_instance();
    $user = $CI->session->userdata('user_details_user');
    if ($user) {
        // print_r($user);
        return $user->$row;
    } else {
        return false;
    }
}




function is_loggedin_admin()
{
    $CI = &get_instance();
    $user = $CI->session->userdata('user_details_admin');
    if ($user) {
        return true;
    } else {
        return false;
    }
}

function get_admindetails($uid = null)
{
    if ($uid == null) {
        $uid = get_admin_sessiondata('id');
    }

    $CI = &get_instance();
    $CI->load->model('Common_model', 'common');
    $where = array(
        'id' => $uid
    );
    $user = $CI->common->getdatabytable('admin', $where);
    if (!empty($user)) {
        return $user;
    } else {
        return null;
    }
}

function get_admin_sessiondata($row)
{
    $CI = &get_instance();
    $user = $CI->session->userdata('user_details_admin');
    if ($user) {
        // print_r($user);
        return $user->$row;
    } else {
        return false;
    }
}


function getallcats(){
    $CI = &get_instance();
    $CI->load->model('Common_model', 'common');
    $user = $CI->common->getdatabytableall('categories');
    if (!empty($user)) {
        return $user;
    } else {
        return null;
    }
}

function getIPAddress()
{
    //whether ip is from the share internet  
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from the remote address  
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function getallparentcats()
{
    $CI = &get_instance();
    $CI->load->model('Common_model', 'common');

    $where_data = array(
        'parent_category_id' => 0
    );

    $categorys = $CI->common->getdatabytableall('categories', $where_data);
    if (!empty($categorys)) {
        return $categorys;
    } else {
        return null;
    }
}


function getcatname($cat_id)
{

    $CI = &get_instance();
    $CI->load->model('Common_model', 'common');

    $where_data = array(
        'id' => $cat_id
    );

    $categorys = $CI->common->getdatabytable('categories', $where_data);
    if (!empty($categorys)) {
        return $categorys->category_name;
    } else {
        return null;
    }
}

function get_categorys_admin()
{
    $CI = &get_instance();
    $CI->load->model('Common_model', 'common');

    $categorys = $CI->common->getdatabytableall('categories');
    if (!empty($categorys)) {
        return $categorys;
    } else {
        return null;
    }
}

function getsubcats($top_cats)
{
    $CI = &get_instance();
    $CI->load->model('Common_model', 'common');

    $where_data = array(
        'parent_category_id =' => $top_cats
    );

    $categorys = $CI->common->getdatabytableall('categories', $where_data);
    if (!empty($categorys)) {
        return $categorys;
    } else {
        return null;
    }
}

function get_user_cart_count(){
    if(is_loggedin_user()){
        $CI = &get_instance();
        $CI->load->model('Common_model', 'common');

        $where_data = array(
            'user_id'   => get_user_sessiondata('id')
        );
        $cart_items = $CI->common->getnumrows('cart', $where_data);
        return $cart_items;
    } else {
        return 0;
    }
}

function check_cart_item($pid){
    if(is_loggedin_user()){

        $CI = &get_instance();
        $CI->load->model('Common_model', 'common');
        $where_data = array(
            'user_id'   => get_user_sessiondata('id'),
            'product_id'=> $pid
        );
        $cart_items = $CI->common->getdatabytableall('cart', $where_data);
        if(!empty($cart_items)){
            return false;
        } else {
            return true;
        }
    } else {
        return true;
    }
}

function get_brands()
{
    $CI = &get_instance();
    $CI->load->model('Common_model', 'common');

    $categorys = $CI->common->getdatabytableall('brands');
    if (!empty($categorys)) {
        return $categorys;
    } else {
        return null;
    }
}

function limit_character($string, $n, $end = '...')
{
    if (strlen($string) > $n) {
        $string = substr($string, 0, $n) . $end;
    }
    return $string;
}

function getgalimage()
{
    $CI = &get_instance();
    $CI->load->model('Common_model', 'common');
    $query = $CI->common->getdatabytableall('gallery');

    if (!empty($query)) {
        return $query;
    } else {
        return 0;
    }
}

function get_max_amount(){
    $CI = &get_instance();
    $CI->load->model('Common_model', 'common');
    $query = $CI->common->get_max_amount();
    if(!empty($query)){
        return $query->sale_price;
    } else {
        return 0;
    }
}

function checkwishlistb2c($product_id)
{
    if (is_loggedin_user()) {
        $CI = &get_instance();
        $CI->load->model('Common_model', 'common');

        $where_data = array(
            'product_id'    => $product_id,
            'user_id'       => get_user_sessiondata('id')
        );
        $check_wishlist = $CI->common->getdatabytable('wishlist', $where_data);
        if (!empty($check_wishlist)) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function getproductsincaat($cat_id){
    $CI = &get_instance();
    $CI->load->model('Common_model', 'common');

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

    return $CI->common->getAllProductsByCatName(20, 0, $sub_cats_array);
}

function getproductdata($pid){
    $CI = &get_instance();
    $CI->load->model('Common_model', 'common');
    $product_data = $CI->common->getproductdata($pid);
    return $product_data;
}