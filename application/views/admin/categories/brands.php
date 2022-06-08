<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">All Brands</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item active">Brands</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-md-4">
                <div>
                    <a type="button" href="#" data-bs-toggle="modal" data-bs-target="#add_category_modal" class="btn btn-success waves-effect waves-light mb-3"><i class="mdi mdi-plus me-1"></i> Add Brand</a>
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

                                        <th>Brand ID</th>
                                        <th>Brand Name</th>
                                        <th style="width: 120px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($brands)) {
                                        $count = 1;
                                        foreach ($brands as $brand) {

                                    ?>
                                            <tr>
                                                <td><?php echo $brand->id ?></td>
                                                <td><?php echo $brand->brand_name ?></td>
                                                <td>
                                                    <button onclick="delete_category(<?php echo $brand->id ?>)" href="javascript:void(0);" class="btn btn-danger px-3">
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

<div class="modal fade bs-example-modal-center" id="add_category_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Brand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('cc_admin/categories/add_brand') ?>" method="post" id="add_category" name="add_category">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label" for="brand_name">Brand Name</label>
                                <input type="text" name="brand_name" id="brand_name" placeholder="Brand Name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary mx-auto d-block mt-3" type="submit" id="submit_button">Add Brand</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->