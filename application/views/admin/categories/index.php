<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">All Categories</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item active">categories</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-md-4">
                <div>
                    <a type="button" href="#" data-bs-toggle="modal" data-bs-target="#add_category_modal" class="btn btn-success waves-effect waves-light mb-3"><i class="mdi mdi-plus me-1"></i> Add Category</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive mb-4">
                            <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="categories">
                                <thead>
                                    <tr>

                                        <th>Category Id</th>
                                        <th>Category Name</th>
                                        <th>Featured</th>
                                        <th>Position</th>
                                        <th style="width: 120px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($categories)) {
                                        $count = 1;
                                        foreach ($categories as $category) {


                                            if ($category->parent_category_id != 0) {
                                                $cat_name =  getcatname($category->parent_category_id) . ' / ' . $category->category_name;
                                            } else {
                                                $cat_name = $category->category_name;
                                            }
                                    ?>
                                            <tr>
                                                <td><?php echo $category->id ?></td>
                                                <td><?php echo $cat_name ?></td>
                                                <td><?php echo ($category->featured == 2) ? 'Yes' : 'No' ?></td>
                                                <td><?php echo $category->position ?></td>
                                                <td>
                                                    <button onclick="edit_category(<?php echo $category->id ?>)" href="javascript:void(0);" class="btn btn-info px-3">
                                                        Edit <i class="uil uil-edit font-size-18"></i>
                                                    </button>
                                                    <button onclick="delete_category(<?php echo $category->id ?>)" href="javascript:void(0);" class="btn btn-danger px-3">
                                                        <i class="uil uil-trash font-size-18"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                    <?php
                                            $count++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- end row -->

    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

<div class="modal fade bs-example-modal-center cat_popup" id="add_category_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('cc_admin/categories/add') ?>" method="post" id="add_category" name="add_category">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label" for="category_name">Category Name</label>
                                <input type="text" name="category_name" id="category_name" placeholder="Category Name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label" for="category_position">Category Position</label>
                                <input type="text" name="category_position" id="category_position" placeholder="Category Position" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label" for="parent_category">Parent Category</label>
                                <select name="parent_category" id="parent_category" class="form-control parent_category">
                                    <option value="">Select Parent Category</option>
                                    <?php
                                    $categorys = getallparentcats();
                                    if (!empty($categorys)) {
                                        foreach ($categorys as $key => $category) {
                                            echo '<option value="' . $category->id . '">' . $category->category_name . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label" for="featured">Featured Category</label>
                                <select name="featured" id="featured" class="form-control featured_select">
                                    <option value="1">No</option>
                                    <option value="2">Yes</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary mx-auto d-block mt-3" type="submit" id="submit_button">Add Category</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade bs-example-modal-center cat_popup" id="edit_category_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('cc_admin/categories/update') ?>" method="post" id="edit_category_form" name="edit_category_form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label" for="category_nameedit">Category Name</label>
                                <input type="text" name="category_nameedit" id="category_nameedit" placeholder="Category Name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label" for="category_position_edit">Category Position</label>
                                <input type="text" name="category_position_edit" id="category_position_edit" placeholder="Category Position" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label" for="parent_category_edit">Parent Category</label>
                                <select name="parent_category_edit" id="parent_category_edit" class="form-control parent_category_2">
                                    <option value="">Select Parent Category</option>
                                    <?php
                                    $categorys = getallparentcats();
                                    if (!empty($categorys)) {
                                        foreach ($categorys as $key => $category) {
                                            echo '<option value="' . $category->id . '">' . $category->category_name . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label" for="featured_edit">Featured Category</label>
                                <select name="featured_edit" id="featured_edit" class="form-control featured_select_edit">
                                    <option value="1">No</option>
                                    <option value="2">Yes</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="cat_id" id="cat_id">
                    </div>
                    <button class="btn btn-primary mx-auto d-block mt-3" type="submit" id="submit_button">Update Category</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->