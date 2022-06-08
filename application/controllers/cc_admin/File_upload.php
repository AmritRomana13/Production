<?php
defined('BASEPATH') or exit('No direct script access allowed');


class File_upload extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Common_model', 'common');
        $this->load->helper('string');
        $this->load->library('image_lib');
    }
    public function index()
    {
        if (is_loggedin_admin()) {
            $output_dir_pdf = FCPATH . 'uploads/products/';
            $img = '';
            $error = '';
            $extensions = array("jpeg", "jpg", "png");
            // print_r($files_data);

            if (isset($_FILES['images']['name'][0])) {
                //echo 'OK';  
                foreach ($_FILES['images']['name'] as $keys => $values) {
                    $fileexe = explode(".", $_FILES["images"]["name"][$keys]);
                    $fileName = date('YmdHis') . random_string('alnum', 16) . '.' . end($fileexe);
                    if (in_array(end($fileexe), config_item('img_extensions')) === true) {
                        if (move_uploaded_file($_FILES["images"]["tmp_name"][$keys], $output_dir_pdf . $fileName)) {

                            $file_data = array(
                                "path" => $fileName,
                                "file_name" => $_FILES["images"]["name"][$keys],
                                "thumbnail" => $fileName
                            );

                            $add_Url = $this->common->insert($file_data, 'gallery');
                            $img .= '
                                <div class="col-file-manager" id="img_col_id_' . $add_Url . '">
                                    <div class="file-box" data-file-id="' . $add_Url . '" data-file-path="' . $fileName . '" data-file-thumb="' . $fileName . '">
                                        <div class="image-container">
                                            <img src="' . base_url('uploads/'). 'products/' . $fileName . '" alt="" class="img-responsive gimg" data-file-path="' . $fileName . '">
                                        </div>
                                        <span class="file-name">' . limit_character($_FILES["images"]["name"][$keys], 25, '..') . '</span>
                                    </div>
                                </div>
                        ';
                        } else {
                            $error = 'Error in uploading few files. Some files couldn\'t be uploaded.';
                        }
                    } else {
                        $error ='Error in uploading few files. File type is not allowed.';
                    }
                }
            }
            echo (json_encode(array('error' => $error, 'img' => $img)));
        }
    }

    public function loadImages()
    {
        if (is_loggedin_admin()) {
            $get_gal_images = getgalimage();
            if ($get_gal_images != 0) {
                foreach ($get_gal_images as $image) {
                    // echo '<option data-img-src="' . base_url() . $image->path. '" value="'. $image->path.'" data-img-class="img-thumbnail"></option>';
                    echo '
				
					<div class="col-file-manager" id="img_col_id_' . $image->id . '">
					<div class="file-box" data-file-id="' . $image->id . '" data-file-path="' . $image->path . '" data-file-thumb="' . $image->thumbnail . '">
						<div class="image-container">
							<img src="' .  base_url('uploads/'). 'products/' . $image->thumbnail . '" alt="" class="img-responsive gimg" data-file-path="' . $image->path . '">
						</div>
						<span class="file-name">' . limit_character($image->file_name, 25, '..') . '</span>
					</div>
					</div>
				
			';
                }
            }
        }
    }
}
