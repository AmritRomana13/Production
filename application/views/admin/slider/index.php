<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">All Products</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Products</a></li>
                            <li class="breadcrumb-item active">All Products</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-md-4">
                <div>
                    <a type="button" href="<?php echo base_url('cc_admin/sliders/add') ?>" class="btn btn-success waves-effect waves-light mb-3"><i class="mdi mdi-plus me-1"></i> Add Slider</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive mb-4">
                            <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;" id="sliders">
                                <thead>
                                    <tr class="bg-transparent">
                                        <th>#</th>
                                        <th>Title</th>
                                        <!-- <th>Middle Text</th> -->
                                        <!-- <th>Bottom Text</th> -->
                                        <th>Image</th>
                                        <th style="width: 120px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($sliders)) {
                                        $count = 1;
                                        foreach ($sliders as $slider) {
                                    ?>
                                            <tr>
                                                <td><?php echo $count ?></td>
                                                <td><?php echo $slider->top_title ?></td>
                                                <!-- <td><?php echo $slider->middle_title ?></td> -->
                                                <!-- <td><?php echo $slider->bottom_title ?></td> -->
                                                <td>
                                                    <img src="<?php echo base_url('uploads/sliders/') . $slider->image ?>" alt="" class="rounded avatar-lg">
                                                </td>
                                                <td>
                                                    <button onclick="delete_slider(<?php echo $slider->id ?>)" href="javascript:void(0);" class="btn px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></button>
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