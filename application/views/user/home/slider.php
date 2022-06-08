<div id="carouselExampleControls" class="carousel slide d-none d-lg-block" data-ride="carousel">
    <div class="carousel-inner">
        <?php
        if (!empty($sliders)) {
            foreach ($sliders as $count => $slider) {
                if ($count == 0) {
                    $active = 'active';
                } else {
                    $active = null;
                }
        ?>
                <div class="carousel-item <?php echo $active ?>">
                    <img class="d-block w-100" style="height: 81vh;" src="<?php echo base_url('uploads/sliders/') . $slider->image ?>" alt="<?php echo $slider->top_title ?>">
                </div>
        <?php
            }
        }
        ?>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<!--mobile carousel-->
<div id="carouselExampleControls_mobile" class="carousel slide d-lg-none" data-ride="carousel">
    <div class="carousel-inner">
        <?php
        if (!empty($sliders)) {
            foreach ($sliders as $count => $slider) {
                if ($count == 0) {
                    $active = 'active';
                } else {
                    $active = null;
                }
        ?>
                <div class="carousel-item <?php echo $active ?>">
                    <img class="d-block w-100" style="height: 100vh;object-fit:cover;" src="<?php echo base_url('uploads/sliders/') . $slider->image ?>" alt="<?php echo $slider->top_title ?>">
                </div>
        <?php
            }
        }
        ?>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls_mobile" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls_mobile" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!--mobile carousel-->