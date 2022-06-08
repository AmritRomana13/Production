<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Common_model extends CI_Model
{

    public function insert(array $details, $table)
    {
        if ($this->db->insert($table, $details)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function delete($id, $table)
    {
        $this->db->where('id', $id);
        $this->db->delete($table);
        return $this->db->affected_rows();
    }

    public function update($table_name, $data, $where)
    {
        $this->db->update($table_name, $data, $where);
        return $this->db->affected_rows();
    }



    // Get Review Details
    public function getnumrows($tableName, array $where)
    {
        $this->db->select("*");
        $this->db->from($tableName);
        if (!empty($where)) {
            foreach ($where as $key => $value) {
                $this->db->where($key, $value);
            }
        }

        $return = $this->db->get()->num_rows();

        // echo $this->db->last_query();
        return $return;
    }


    public function getdatabytable($tableName, array $where = null)
    {
        $this->db->select("*");
        $this->db->from($tableName);
        if($where != null){
            foreach ($where as $key => $value) {
                $this->db->where($key, $value);
            }
        }
        
        return $this->db->get()->row();
    }




    public function getdatabytableall($tableName, array $where = null,$index = 'id')
    {
        $this->db->select("*");
        $this->db->from($tableName);
        if ($where != null) {
            foreach ($where as $key => $value) {
                $this->db->where($key, $value);
            }
        }
        
        $this->db->order_by($index, "DESC");
        $return = $this->db->get()->result();
        
        return $return;
    }



    public function deleteWhere($tableName, array $where)
    {
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        $this->db->delete($tableName);
        return $this->db->affected_rows();
    }

    public function check_user(array $post_data)
    {
        $sql = "select * from users where (email  = ?) and password = ?";
        $result = $this->db->query($sql, array(
            $post_data['username'], md5($post_data['password'])
        ))->row();
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    
    public function check_admin(array $post_data)
    {
        $sql = "select * from admin where (phone_number = ? or email = ?) and password = ?";
        $result = $this->db->query($sql, array(
            $post_data['username'], $post_data['username'], md5($post_data['userpassword'])
        ))->row();
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }
    
    public function getallcategories()
    {
        $this->db->select("*");
        $this->db->from('categories');
        $this->db->order_by('position', "ASC");
        $return = $this->db->get()->result();
        return $return;
    }


    public function getproductsnyfilter($cats_array, $post_data = array())
    {
        $this->db->select('p.*');
        $this->db->from('products p');


        if ($cats_array[0] != 'all') {
            if (!empty($post_data['sub_category'])) {
                $this->db->where('find_in_set("' . $post_data['sub_category'] . '", p.cat_id) <> 0');
            } else {
                $this->db->group_start();
                //for top cats only..
                foreach ($cats_array as $id) {
                    # code...
                    $this->db->or_where('find_in_set("' . $id . '", p.cat_id) <> 0');
                }
                $this->db->group_end();
            }
        }

        $this->db->where('p.status !=', 3);
        $this->db->order_by('p.id', 'ASC');
        return $this->db->get()->result();
    }

    public function getAllProductsByCatNameRows($cats_array, $post_data = array()){
        $this->db->select('p.*');
        $this->db->from('products p');


        if ($cats_array[0] != 'all') {
            if (!empty($post_data['sub_category'])) {
                $this->db->where('find_in_set("' . $post_data['sub_category'] . '", p.cat_id) <> 0');
            } else {
                $this->db->group_start();
                //for top cats only..
                foreach ($cats_array as $id) {
                    # code...
                    $this->db->or_where('find_in_set("' . $id . '", p.cat_id) <> 0');
                }
                $this->db->group_end();
            }
        }

        $this->db->where('p.status =', 1);
        $this->db->order_by('p.id', 'ASC');
        return $this->db->get()->num_rows();
    }
    public function getAllProductsByCatName($limit, $start, $cats_array, $post_data = array())
    {
        $this->db->select('p.*');
        $this->db->from('products p');


        if ($cats_array[0] != 'all') {
            if (!empty($post_data['sub_category'])) {
                $this->db->where('find_in_set("' . $post_data['sub_category'] . '", p.cat_id) <> 0');
            } else {
                $this->db->group_start();
                //for top cats only..
                foreach ($cats_array as $id) {
                    # code...
                    $this->db->or_where('find_in_set("' . $id . '", p.cat_id) <> 0');
                }
                $this->db->group_end();
            }
        }

        $this->db->where('p.status =', 1);
        $this->db->order_by('p.id', 'ASC');
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }

    public function search_num_rows($keyword){
        $this->db->select('p.*');
        $this->db->from('products p');
        $this->db->join('categories c', 'c.id = p.cat_id');
        $this->db->like('lower(p.product_name)', strtolower($keyword), 'both');
        $this->db->or_like('lower(c.category_name)', strtolower($keyword), 'both');
        $this->db->where('p.status =', 1);
        return $this->db->get()->num_rows();
    }

    public function search_getproducts($keyword, $limit, $start)
    {
        $this->db->select('p.*');
        $this->db->from('products p');
        $this->db->join('categories c', 'c.id = p.cat_id');
        $this->db->like('lower(p.product_name)', strtolower($keyword), 'both');
        $this->db->or_like('lower(c.category_name)', strtolower($keyword), 'both');
        $this->db->where('p.status =', 1);
        $this->db->order_by('p.id', 'ASC');
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }

    public function getusercart($user_id){
        $this->db->select('p.*,c.size,c.qty');
        $this->db->from('products p');
        $this->db->join('cart c','c.product_id = p.id');
        $this->db->where('p.status =', 1);
        $this->db->where('c.user_id =', $user_id);
        $this->db->order_by('c.id', 'DESC');
        return $this->db->get()->result();
    }

    public function getuserorders($user_id){
        $this->db->select('o.*');
        $this->db->from('orders o');
        $this->db->where('o.user_id =', $user_id);
        $this->db->order_by('o.id', 'DESC');
        return $this->db->get()->result();
    }

    public function get_order_data($order_id, $user_id){
        $this->db->select('op.*,p.product_name,b.brand_name,p.slug,p.images');
        $this->db->from('order_products op');
        $this->db->join('orders o', 'o.id = op.order_id');
        $this->db->join('products p', 'p.id = op.product_id');
        $this->db->join('brands b', 'b.id = p.brand_id');
        $this->db->where('o.id =', $order_id);
        $this->db->where('o.user_id =', $user_id);
        return $this->db->get()->result();
    }

    public function get_order_product_data($user_id, $order_id, $product_id){
        $this->db->select('p.file,p.product_name');
        $this->db->from('order_products op');
        $this->db->join('orders o', 'o.id = op.order_id');
        $this->db->join('products p', 'p.id = op.product_id');
        $this->db->where('o.id =', $order_id);
        $this->db->where('o.user_id =', $user_id);
        $this->db->where('p.id =', $product_id);
        return $this->db->get()->row();
    }

    public function getsalesdata(array $post_data)
    {

        $startDate =  $post_data['from_date'];
        $endDate =  $post_data['to_date'];


        $this->db->select('*');
        $this->db->from('orders');

        if ($startDate == $endDate) {
            $this->db->where('date(created_at)', $startDate);
        } else {
            $this->db->where("date(created_at) BETWEEN '{$startDate}' AND '{$endDate}'");
        }

        $this->db->order_by("id", "desc");
        $test = $this->db->get()->result();
        return $test;
    }

    public function get_max_amount(){
        $this->db->select('sale_price');
        $this->db->from('products');
        $this->db->order_by("sale_price", "desc");
        $this->db->limit(1);
        return $this->db->get()->row();
    }

    public function getcatfilterproductsrows($cats_array, $get_data = array())
    {
        $this->db->select('p.*');
        $this->db->from('products p');


        if ($cats_array[0] != 'all') {
            if (!empty($post_data['sub_category'])) {
                $this->db->where('find_in_set("' . $post_data['sub_category'] . '", p.cat_id) <> 0');
            } else {
                $this->db->group_start();
                //for top cats only..
                foreach ($cats_array as $id) {
                    # code...
                    $this->db->or_where('find_in_set("' . $id . '", p.cat_id) <> 0');
                }
                $this->db->group_end();
            }
        }

        if (!empty($get_data['brand_name'])) {
            $brands = implode("','", explode(',', strtolower($get_data['brand_name'])));
            $this->db->where_in('p.brand_id', $brands);
        }

        if (!empty($get_data['sizes'])) {
            $sizes = explode(',', strtolower($get_data['sizes']));
            if(!empty($sizes)){
                $this->db->group_start();
                foreach ($sizes as $key => $size) {
                    $this->db->or_where('find_in_set("' . $size . '", p.sizes) <> 0');
                }
                $this->db->group_end();
            }
        }

        if(!empty($get_data['minamount'])){
            $this->db->where('p.sale_price >=', $get_data['minamount']);
        }

        if (!empty($get_data['maxamount'])) {
            $this->db->where('p.sale_price <=', $get_data['maxamount']);
        }


        $this->db->where('p.status =', 1);
        $this->db->order_by('p.id', 'ASC');
        $return  = $this->db->get()->num_rows();
        // echo $this->db->last_query();
        return $return;
    }

    public function getAllProductsByCatNameFilter($limit, $start, $cats_array, $get_data = array()){
        $this->db->select('p.*');
        $this->db->from('products p');


        if ($cats_array[0] != 'all') {
            if (!empty($post_data['sub_category'])) {
                $this->db->where('find_in_set("' . $post_data['sub_category'] . '", p.cat_id) <> 0');
            } else {
                $this->db->group_start();
                //for top cats only..
                foreach ($cats_array as $id) {
                    # code...
                    $this->db->or_where('find_in_set("' . $id . '", p.cat_id) <> 0');
                }
                $this->db->group_end();
            }
        }

        if (!empty($get_data['brand_name'])) {
            $brands = implode("','", explode(',', strtolower($get_data['brand_name'])));
            $this->db->where_in('p.brand_id', $brands);
        }

        if (!empty($get_data['sizes'])) {
            $sizes = explode(',', strtolower($get_data['sizes']));
            if (!empty($sizes)) {
                $this->db->group_start();
                foreach ($sizes as $key => $size) {
                    $this->db->or_where('find_in_set("' . $size . '", p.sizes) <> 0');
                }
                $this->db->group_end();
            }
        }

        if (!empty($get_data['minamount'])) {
            $this->db->where('p.sale_price >=', $get_data['minamount']);
        }

        if (!empty($get_data['maxamount'])) {
            $this->db->where('p.sale_price <=', $get_data['maxamount']);
        }


        $this->db->where('p.status =', 1);
        $this->db->order_by('p.id', 'ASC');
        $this->db->limit($limit, $start);
        $return  = $this->db->get()->result();
        // echo $this->db->last_query();
        return $return;
    }


    public function search_num_rows_filter($keyword,$get_data)
    {
        $this->db->select('p.*');
        $this->db->from('products p');
        $this->db->join('categories c', 'c.id = p.cat_id');

        $this->db->group_start();
        $this->db->like('lower(p.product_name)', strtolower($keyword), 'both');
        $this->db->or_like('lower(c.category_name)', strtolower($keyword), 'both');
        $this->db->group_end();

        if (!empty($get_data['brand_name'])) {
            $brands = implode("','", explode(',', strtolower($get_data['brand_name'])));
            $this->db->where_in('p.brand_id', $brands);
        }

        if (!empty($get_data['sizes'])) {
            $sizes = explode(',', strtolower($get_data['sizes']));
            if (!empty($sizes)) {
                $this->db->group_start();
                foreach ($sizes as $key => $size) {
                    $this->db->or_where('find_in_set("' . $size . '", p.sizes) <> 0');
                }
                $this->db->group_end();
            }
        }

        if (!empty($get_data['minamount'])) {
            $this->db->where('p.sale_price >=', $get_data['minamount']);
        }

        if (!empty($get_data['maxamount'])) {
            $this->db->where('p.sale_price <=', $get_data['maxamount']);
        }

        $this->db->where('p.status =', 1);
        return $this->db->get()->num_rows();
    }


    public function search_getproducts_filter($keyword, $limit, $start,$get_data)
    {
        $this->db->select('p.*');
        $this->db->from('products p');
        $this->db->join('categories c', 'c.id = p.cat_id');
        
        $this->db->group_start();
        $this->db->like('lower(p.product_name)', strtolower($keyword), 'both');
        $this->db->or_like('lower(c.category_name)', strtolower($keyword), 'both');
        $this->db->group_end();

        if (!empty($get_data['brand_name'])) {
            $brands = implode("','", explode(',', strtolower($get_data['brand_name'])));
            $this->db->where_in('p.brand_id', $brands);
        }

        if (!empty($get_data['sizes'])) {
            $sizes = explode(',', strtolower($get_data['sizes']));
            if (!empty($sizes)) {
                $this->db->group_start();
                foreach ($sizes as $key => $size) {
                    $this->db->or_where('find_in_set("' . $size . '", p.sizes) <> 0');
                }
                $this->db->group_end();
            }
        }

        if (!empty($get_data['minamount'])) {
            $this->db->where('p.sale_price >=', $get_data['minamount']);
        }

        if (!empty($get_data['maxamount'])) {
            $this->db->where('p.sale_price <=', $get_data['maxamount']);
        }
        $this->db->where('p.status =', 1);
        $this->db->order_by('p.id', 'ASC');
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }

    public function updateCartQty($user_id, $pid, $size){
        $this->db->where('user_id =', $user_id);
        $this->db->where('product_id =', $pid);
        $this->db->where('size =', $size);
        $this->db->set("qty", "qty + 1", FALSE);
        $this->db->update('cart');
        return $this->db->affected_rows();
    }

    public function updatecart_dec($user_id, $pid, $size)
    {
        $this->db->where('user_id =', $user_id);
        $this->db->where('product_id =', $pid);
        $this->db->where('size =', $size);
        $this->db->set("qty", "qty - 1", FALSE);
        $this->db->update('cart');
        return $this->db->affected_rows();
    }

    public function getuserwishlist($user_id)
    {
        $this->db->select('p.*,b.brand_name');
        $this->db->from('products p');
        $this->db->join('wishlist w', 'w.product_id = p.id');
        $this->db->join('brands b', 'b.id = p.brand_id');
        $this->db->where('p.status =', 1);
        $this->db->where('w.user_id =', $user_id);
        $this->db->order_by('w.id', 'DESC');
        return $this->db->get()->result();
    }

    public function getrelatedproducts($product_cats, $pid)
    {
        $this->db->select('p.*');
        $this->db->from('products p');
        // $this->db->join('stockinfodetails  s', 's.productid = p.id');
        $this->db->group_start();
        foreach ($product_cats as $id) {
            $this->db->or_where('find_in_set("' . $id . '", p.cat_id) <> 0');
        }
        $this->db->group_end();
        $this->db->where('p.status =', 1);
        $this->db->where('p.id !=', $pid);
        $this->db->order_by('p.id', 'ASC');
        $this->db->limit(15);
        return $this->db->get()->result();
    }

    public function getsizesincat($cats_array){
        $this->db->select('p.sizes');
        $this->db->from('products p');


        if ($cats_array[0] != 'all') {
            if (!empty($post_data['sub_category'])) {
                $this->db->where('find_in_set("' . $post_data['sub_category'] . '", p.cat_id) <> 0');
            } else {
                $this->db->group_start();
                //for top cats only..
                foreach ($cats_array as $id) {
                    # code...
                    $this->db->or_where('find_in_set("' . $id . '", p.cat_id) <> 0');
                }
                $this->db->group_end();
            }
        }

        $this->db->where('p.status =', 1);
        $this->db->group_by('p.sizes');
        $this->db->order_by('p.id', 'ASC');
        return $this->db->get()->result();
    }

    public function getproductdata($pid){
        $this->db->select('p.*,b.brand_name');
        $this->db->from('products p');
        // $this->db->join('wishlist w', 'w.product_id = p.id');
        $this->db->join('brands b', 'b.id = p.brand_id');
        // $this->db->where('p.status =', 1);
        $this->db->where('p.id =', $pid);
        // $this->db->order_by('w.id', 'DESC');
        return $this->db->get()->row();
    }

    public function get_fetured_product()
    {
        $this->db->select('p.*,b.brand_name');
        $this->db->from('products p');
        // $this->db->join('wishlist w', 'w.product_id = p.id');
        $this->db->join('brands b', 'b.id = p.brand_id');
        // $this->db->where('p.status =', 1);
        $this->db->where('p.fetured =', 1);
        // $this->db->order_by('w.id', 'DESC');
        return $this->db->get()->row();  
    }
}
