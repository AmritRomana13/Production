<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="cache-control" content="max-age=604800" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <!-- <link rel="shortcut icon" href="<?php echo base_url('admin_assets/') ?>images/favicon.ico"> -->

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('admin_assets/') ?>libs/toastr/build/toastr.min.css">
    <!-- place here plugins start -->
    <?php
    if (isset($form_validation)) {
    ?>
        <link rel="stylesheet" href="<?php echo base_url(); ?>admin_assets/validation/formValidation.css">
    <?php
    }

    if (isset($datatable)) {
    ?>
        <!-- DataTables -->
        <link href="<?php echo base_url(); ?>admin_assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="<?php echo base_url(); ?>admin_assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <?php
    }
    if (isset($datatable_buttons)) {
    ?>
        <link href="<?php echo base_url(); ?>admin_assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <?php
    }
    if (isset($sweet_alert)) {
    ?>
        <!-- Sweet Alert-->
        <link href="<?php echo base_url(); ?>admin_assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <?php
    }

    if (isset($select_2)) {
    ?>
        <!-- Sweet Alert-->
        <link href="<?php echo base_url(); ?>admin_assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <?php
    }
    if (isset($datepicker)) {
    ?>
        <link href="<?php echo base_url(); ?>admin_assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

        <link rel="stylesheet" href="<?php echo base_url(); ?>admin_assets/libs/@chenfengyuan/datepicker/datepicker.min.css">
    <?php
    }

    if (isset($js_tree)) {
    ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
    <?php
    }

    if (isset($jq_ui)) {
    ?>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <?php
    }

    ?>
    <!-- place here plugins end -->
    <!-- Bootstrap Css -->
    <link href="<?php echo base_url('admin_assets/') ?>css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo base_url('admin_assets/') ?>css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('admin_assets/') ?>css/crcticons.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo base_url('admin_assets/') ?>css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <script>
        var base_url = '<?php echo base_url() ?>';
    </script>
    <style>
        small.help-block {
            color: #f46a6a;
        }

        /* .gradient-1 {
            background: #E8CBC0;
            background: -webkit-linear-gradient(to right, #636FA4, #E8CBC0);
            background: linear-gradient(to right, #636FA4, #E8CBC0);
            border-color: #E8CBC0 !important;
        } */

        body.modal-open .page-content,
        body.modal-open #page-topbar,
        body.modal-open footer {
            -webkit-filter: blur(3px);
            -moz-filter: blur(3px);
            -o-filter: blur(3px);
            -ms-filter: blur(3px);
            filter: blur(3px);
        }
    </style>
    <style>
        small.help-block {
            color: #f46a6a;
        }

        /* .gradient-1 {
            background: #E8CBC0;
            background: -webkit-linear-gradient(to right, #636FA4, #E8CBC0);
            background: linear-gradient(to right, #636FA4, #E8CBC0);
            border-color: #E8CBC0 !important;
        } */
        .thumbnail img {
            width: 150px;
            height: 150px;
            padding: .25rem;
            max-width: 100%;
            height: auto;
        }

        .btn-file {
            position: relative;
            overflow: hidden;
        }

        .btn-file input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            background: white;
            cursor: inherit;
            display: block;
        }

        .img-zone {
            background-color: #92f2da66;
            border: 5px dashed #28ae8d;
            border-radius: 5px;
            padding: 20px;

        }

        .img-zone h2 {
            margin-top: 0;
        }

        .progress,
        #img-preview {
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .col-file-manager {
            float: left;
            width: auto;
            padding: 5px;
        }

        .file-box {
            display: block;
            width: 100%;
            border: 1px solid #eee;
            cursor: pointer;
            text-align: center;
            position: relative;
            border-radius: 2px;
        }

        .file-box .image-container {
            display: block;
            width: 122px;
            height: 100px;
            overflow: hidden;
            text-align: center;
            border-radius: 2px;
        }

        .file-box .image-container img {
            margin: 0 auto;
            position: relative;
            width: auto;
            min-width: 100%;
            max-width: none;
            height: 100%;
            margin-left: 50%;
            transform: translateX(-50%);
            object-fit: cover;
        }

        .file-box .file-name {
            width: 100%;
            position: absolute;
            bottom: 0;
            left: 0;
            font-size: 12px;
            line-height: 14px;
            background-color: #f4f4f4;
            padding: 2px;
            display: block;
            text-align: center;
            word-break: break-all;
        }

        .file-manager-content .selected {
            box-shadow: 0 0 3px rgba(40, 174, 141, 1);
            border: 1px solid #28ae8d;
        }

        .pGalClose {
            /* position: absolute; */
            top: 0;
            padding: 0;
            margin-left: -11px;
            margin-top: -8px;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            line-height: 22px;
            text-align: center;
            background-color: #dc3545 !important;
            color: #fff !important;
            opacity: 1;
            font-size: 13px;
        }

        .btn-delete-additional-image {
            position: absolute;
            top: 0;
            padding: 0;
            margin-left: -11px;
            margin-top: -8px;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            line-height: 22px;
            text-align: center;
            background-color: #dc3545 !important;
            color: #fff !important;
        }

        .btn-delete-additional-image:hover {
            background-color: #bd2130 !important;
        }

        .additional-image-list {
            width: auto;
        }

        .additional-image-list .additional-item {
            display: inline-block;
            margin: 8px;
            position: relative;
            border: 1px solid #eee;
        }

        .img-additional {
            margin: 0 10px 10px 10px;
            width: 200px;
            height: 150px;
        }

        .hidden {
            display: none;
        }

        #block_ui_animation {
            animation-name: ckw;
            animation-duration: 3s;
            animation-iteration-count: infinite;
            transform-origin: 50% 50%;
            display: inline-block;
        }

        @keyframes ckw {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 1200px) {
            .additional-image-list .btn-delete-additional-image {
                left: 0 !important;
            }
        }
    </style>
    <?php
    $header_class = null;
    if (isset($hide_top_bar)) {
        $header_class = 'd-none';

    ?>
        <style>
            body[data-layout=horizontal] .page-content {
                margin-top: 10px;
                padding: calc(10px + 1.25rem) calc(0.55rem / 2) 60px calc(0.55rem / 2);
            }
        </style>
    <?php
    }
    ?>
</head>


<body data-layout="horizontal" data-topbar="dark">
    <!-- Begin page -->
    <div id="layout-wrapper">


        <header class="<?php echo $header_class ?>" id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="<?php echo base_url('cc_admin') ?>" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="<?php echo base_url('admin_assets/') ?>images/logo-sm.png" alt="" height="50">
                            </span>
                            <span class="logo-lg">
                                <img src="<?php echo base_url('admin_assets/') ?>images/logo-dark.png" alt="" height="50">
                            </span>
                        </a>

                        <a href="<?php echo base_url('cc_admin') ?>" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="<?php echo base_url('admin_assets/') ?>images/logo-sm.png" alt="" height="50" class="rounded-3">
                            </span>
                            <span class="logo-lg">
                                <img src="<?php echo base_url('admin_assets/images/logo-light.png') ?>" alt="" height="50" class="rounded-3">
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                </div>

                <div class="d-flex">


                    <div class="dropdown d-none d-lg-inline-block ms-1">
                        <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                            <i class="uil-minus-path"></i>
                        </button>
                    </div>




                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="<?php echo base_url('admin_assets/') ?>images/users/vamsi.svg" alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15"><?php echo get_admindetails()->full_name ?></span>
                            <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <!-- <a class="dropdown-item" href="<?php echo base_url('cc_admin/settings') ?>"><i class="uil uil-wrench font-size-18 align-middle text-muted me-1"></i> <span class="align-middle">Settings</span></a> -->
                            <a class="dropdown-item" href="<?php echo base_url('cc_admin/common/logout') ?>"><i class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle">Sign out</span></a>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            $this->load->view('admin/common/sidebar_hor');
            ?>
        </header>
        <div class="main-content">