<!--Page Title-->
<div class="page section-header text-center">
    <div class="page-title">
        <div class="wrapper">
            <h1 class="page-width">Login</h1>
        </div>
    </div>
</div>
<!--End Page Title-->

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 main-col offset-md-3">
            <div class="mb-4">
                <form method="post" action="<?php echo base_url('auth/complete_signin') ?>" id="signin" name="signin" accept-charset="UTF-8" class="contact-form">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="username">Email</label>
                                <input type="email" name="username" placeholder="" id="username" class="" autocorrect="off" autocapitalize="off" autofocus="">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" value="" name="password" placeholder="" id="password" class="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div id="notification-message" class="d-none alert rounded">
                        </div>
                        <div class="text-center col-12 col-sm-12 col-md-12 col-lg-12">
                            <input type="submit" class="btn mb-3" value="Sign In">
                            <p class="mb-4">
                                <a href="#" id="RecoverPassword">Forgot your password?</a> &nbsp; | &nbsp;
                                <a href="<?php echo base_url('auth/register') ?>" id="customer_register_link">Create account</a>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>