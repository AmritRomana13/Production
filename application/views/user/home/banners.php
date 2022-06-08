<div class="section featured-column" style="margin-top: 10vh;">
    <div class="container">
        <div class="row">
            <!-- <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="section-header ">
                            <h2 class="h2">Brands</h2>
                        </div>
                    </div> -->
        </div>
        <div class="row">
            <!--Featured Item-->

            <?php
            if (!empty($banners)) {
                foreach ($banners as $banner) {
            ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 ">
                        <p>
                            <a href="#">
                                <img class="blur-up lazyload" style="width: 400px;height: 400px;" data-src="<?php echo base_url('uploads/banners/') . $banner->image ?>" alt="feature-row__image">
                            </a>
                        </p>
                        <h3 class="h4"><a href="#" style="font-weight:550;font-size:1em;letter-spacing: 0.15em;"><?php echo $banner->title ?></a></h3>

                    </div>
            <?php
                }
            }
            ?>
            <!--End Featured Item-->
        </div>
    </div>
</div>