<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Import Products</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Products</a></li>
                            <li class="breadcrumb-item active">Import Products</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-8 mx-auto">
                <form class="needs-validation" id="bulkproductsimport" name="bulkproductsimport" action="<?php echo base_url('cc_admin/products/complate_import') ?>">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Import Products</h4>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="productsfile">Select CSV File</label>
                                        <input type="file" class="form-control" id="productsfile" name="productsfile">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="dummy1">Download Sample File</label> <br>
                                    <a href="<?php echo base_url('uploads/templates/products.csv') ?>" class="btn btn-secondary" target="_blank" rel="noopener noreferrer">Download Sample File</a>
                                </div>
                            </div>
                            <button class="btn btn-primary mx-auto d-block mt-3" type="submit" id="submit_button">Import Numbers</button>
                        </div>
                    </div>
                    <!-- end card -->
                </form>
            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->