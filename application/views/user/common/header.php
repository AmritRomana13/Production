<?php
$cart_count = get_user_cart_count();
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $title ?></title>
    <meta name="description" content="description">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->

    <?php
    if (isset($form_validation)) {
    ?>
        <link rel="stylesheet" href="<?php echo base_url(); ?>admin_assets/validation/formValidation.css">
    <?php
    }
    ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>css/plugins.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Bootstap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>css/bootstrap.min.css">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>css/style.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>css/responsive.css">
    <style>
        .img:hover {
            backdrop-filter: blur(10px);
            filter: blur(4px);
            transition: 0.5s ease;
        }

        /* The sticky class is added to the navbar with JS when it reaches its scroll position */
        .sticky {
            position: fixed;
            top: 0;
            width: 100%;
        }

        /* Add some top padding to the page content to prevent sudden quick movement (as the navigation bar gets a new position at the top of the page (position:fixed and top:0) */
        .sticky+.content {
            padding-top: 60px;
        }

        li {
            font-weight: bolder;
        }

        body {
            font-family: zurichultraBlkExbt;


        }

        small.help-block {
            color: red;
        }

        .cart .list-view-item__title {
            color: #000;
            font-size: 11px;
            min-width: 100px;
        }
    </style>

    <script>
        const base_url = '<?php echo base_url() ?>';
    </script>
</head>

<body class="template-product home8-jewellery belle <?php echo @$body_class ?>">

    <div id="pre-loader">
        <img src="<?php echo base_url('assets/') ?>images/loader.gif" alt="Loading..." />
    </div>
    <div style="background-color: black; color: white; text-align: center;padding: 5px;">
        <span style="font-size:9px;font-weight: bolder;letter-spacing: 0.08em;"><a href="" style="color: white;"> SALE: EXTRA 15% OFF SALE ITEMS AT CHECKOUT </a>
        </span>

    </div>
    <div class="pageWrapper">

        <div id="navbar" style="z-index: 1;">

            <!--Search Form Drawer-->
            <div class="search">

                <div class="search__form">
                    <form class="search-bar__form" action="<?php echo base_url('search') ?>" method="get">
                        <button class="go-btn search__button" type="submit"><i class="icon anm anm-search-l"></i></button>
                        <input class="search__input" type="search" name="keyword" required placeholder="Search entire store..." aria-label="Search" autocomplete="off">
                    </form>
                    <button type="button" class="search-trigger close-btn"><i class="anm anm-times-l"></i></button>
                </div>
            </div>
            <!--End Search Form Drawer-->
            <!--Top Header-->

            <!--End Top Header-->
            <!-- mobile header -->
            <div class="d-lg-none" style="padding: 10px;background-color: white;">

                <div class="container">
                    <!-- desktop nav -->
                    <div class="row ">
                        <div class="col d-lg-none float-left">
                            <button type="button" class="btn--link site-header__menu js-mobile-nav-toggle mobile-nav--open">
                                <i class="icon anm anm-times-l"></i>
                                <i class="anm anm-bars-r"></i>
                            </button>

                        </div>
                        <div class="col " style="object-fit: contain; position: relative;">
                            <a href="<?php echo base_url() ?>"><img src="<?php echo base_url('assets/') ?>images/logo/logo.svg" style="max-width: 400px;" alt=""></a>
                        </div>
                        <div class="col">
                            <div class="site-cart d-block" style=" margin-left: 1vw;">
                                <a href="<?php echo base_url('cart/') ?>" class="site-header__cart" title="Cart">
                                    <img class="icon anm anm-bag-l" src="<?php echo base_url('assets/') ?>images/logo/Bag.svg"></img>
                                    <span id="CartCount" class="site-header__cart-count" data-cart-render="item_count"><?php echo $cart_count ?></span>
                                </a>
                            </div>
                            <button type="button" style="border: none;float:right; position:relative;" class="search-trigger"><i style="font-size: 1.3em;" class="icon anm anm-search-l"></i></button>

                        </div>



                    </div>
                </div>
            </div>

            <!-- mobile header ends -->
            <!--Header-->
            <div style="padding: 22px;background-color: white;" class="nav d-none d-lg-block">

                <div class="container">
                    <!-- desktop nav -->
                    <div class="row align-items-start">



                        <div class="col d-none d-lg-block float-left">
                            <a href="<?php echo base_url('wishlist/') ?>"><img src="<?php echo base_url('assets/') ?>\images\logo\star.svg" style="margin-right: 1vw;" alt=""></a>
                            <a href="<?php echo base_url('myaccount/') ?>"><img src="<?php echo base_url('assets/') ?>\images\logo\profile.svg" alt=""></a>

                        </div>

                        <div class="col d-none d-lg-block" style="margin-left: 10vw;">
                            <a href="<?php echo base_url() ?>"><img src="<?php echo base_url('assets/') ?>images/logo/logo.svg" style="width: 200px;" alt=""></a>
                        </div>
                        <div class="col float-right">
                            <div class="site-cart d-block" style=" margin-left: 1vw;">
                                <a href="<?php echo base_url('cart/') ?>" class="site-header__cart" title="Cart">
                                    <img class="icon anm anm-bag-l" src="<?php echo base_url('assets/') ?>images/logo/Bag.svg"></img>
                                    <span id="CartCount" class="site-header__cart-count" data-cart-render="item_count"><?php echo $cart_count ?></span>
                                </a>
                            </div>
                            <button type="button" style="border: none;float:right; position:relative;" class="search-trigger"><img style="font-size: 1.3em;" src="<?php echo base_url('assets/') ?>images/logo/Search .svg" class="icon anm anm-search-l"></img></button>

                        </div>
                    </div>
                </div>



            </div>






            <nav class="belowlogo" id="AccessibleNav" style="background-color: white;">
                <ul id="siteNav" class="site-nav medium center hidearrow">

                    <li class="lvl1 parent megamenu"><a href="<?php echo base_url() ?>">Home<i class="anm anm-angle-down-l"></i></a>
                    </li>
                    <?php
                    $top_cats = getallparentcats();
                    if (!empty($top_cats)) {
                        foreach ($top_cats as $top_cat) {
                            $sub_cats = getsubcats($top_cat->id);
                    ?>
                            <li class="lvl1 parent dropdown"><a href="<?php echo base_url('categories/products/') . $top_cat->id ?>"><?php echo $top_cat->category_name ?> <i class="anm anm-angle-down-l"></i></a>
                                <ul class="dropdown">

                                    <?php
                                    if (!empty($sub_cats)) {
                                        foreach ($sub_cats as $sub_cat) {
                                    ?>
                                            <li><a href="<?php echo base_url('categories/products/') . $sub_cat->id ?>" class="site-nav"><?php echo $sub_cat->category_name ?></a></li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </nav>
            <!--End Desktop Menu-->
            <!--End Header-->


            <!--Mobile Menu-->
            <div class="mobile-nav-wrapper" role="navigation">
                <div class="closemobileMenu"><i class="icon anm anm-times-l pull-right"></i> Close Menu</div>
                <ul id="MobileNav" class="mobile-nav">
                    <li class="lvl1"><a href="<?php echo base_url() ?>"><b>Home</b></a>
                    </li>
                    <?php
                    $top_cats = getallparentcats();
                    if (!empty($top_cats)) {
                        foreach ($top_cats as $top_cat) {
                            $sub_cats = getsubcats($top_cat->id);
                    ?>
                            <li class="lvl1 parent megamenu">
                                <a href="<?php echo base_url('categories/products/') . $top_cat->id ?>"><?php echo $top_cat->category_name ?> <i class="anm anm-plus-l"></i></a>
                                <ul>

                                    <?php
                                    if (!empty($sub_cats)) {
                                        foreach ($sub_cats as $sub_cat) {
                                    ?>
                                            <li><a href="<?php echo base_url('categories/products/') . $sub_cat->id ?>" class="site-nav"><?php echo $sub_cat->category_name ?></a></li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </li>
                    <?php
                        }
                    }
                    ?>

                </ul>
            </div>
            <!--End Mobile Menu-->

        </div>


        <!--Body Content-->
        <div id="page-content">
