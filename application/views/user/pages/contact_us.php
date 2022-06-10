<style>
    .home8-jewellery .social-icons .icon {
        color: unset;
    }
</style>
<!--Page Title-->
<div class="page section-header text-center">
    <div class="page-title">
        <div class="wrapper">
            <h1 class="page-width" style="font-weight:bold">Contact Us</h1>
        </div>
    </div>
</div>
<!--End Page Title-->

<div class="bredcrumbWrap">
    <div class="container breadcrumbs">
        <a href="<?php echo base_url() ?>" title="Back to the home page">Home</a><span aria-hidden="true">›</span><span>Contact Us</span>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-8 col-lg-8 mb-4">
            <h2>Drop Us A Line</h2>
            
            <div class="formFeilds contact-form form-vertical">
                <form action="<?Php echo base_url('home/submit_contact_form') ?>" method="post" id="contact_form" class="contact-form">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <input type="text" id="ContactFormName" name="name" placeholder="Name" value="" required="">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <input type="email" id="ContactFormEmail" name="email" placeholder="Email" value="" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <input required="" type="tel" id="ContactFormPhone" name="phone" pattern="[0-9\-]*" placeholder="Phone Number" value="">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <input required="" type="text" id="ContactSubject" name="subject" placeholder="Subject" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <textarea required="" rows="10" id="ContactFormMessage" name="message" placeholder="Your Message"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <input type="submit" class="btn" value="Send Message">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-4 col-lg-4">
            <div class="open-hours">
                <strong>Opening Hours</strong><br>
                Mon - Sat : 9am - 11pm<br>
                Sunday: 11am - 5pm
            </div>
            <hr />
            <ul class="addressFooter">
                
                <li class="phone"><i class="icon anm anm-phone-s"></i>
                    <p>+91-9137800013</p>
                </li>
                <li class="email"><i class="icon anm anm-envelope-l"></i>
                    <p>support@reppin.co.in</p>
                </li>
                <li><a class="social-icons__link" href="#" target="_blank" title="Belle Multipurpose Bootstrap 4 Template on Instagram"><i class="icon icon-instagram"></i> <span class="icon__fallback-text">Instagram</span></a>
            <a href="https://www.instagram.com/reppin.co/?hl=en" target="blank"><p>Instagram</p></a></li>
            </ul>
            <hr />
            <ul class="list--inline site-footer__social-icons social-icons">

               

            </ul>
        </div>
    </div>
</div>