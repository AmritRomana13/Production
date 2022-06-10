  </div>
  <!--End Body Content-->
  </div>
  <!--Footer-->
  <footer id="footer" class="footer-3">
      <div class="site-footer">
          <div class="container">
              <!--Footer Links-->
              <div class="footer-top">
                  <div class="row">
                      <div class="col-12 col-sm-12 col-md-3 col-lg-3 contact-box">
                          <h4 class="h4" style="font-family: zurichultraBlkExbt;">Contact Us</h4>
                          <ul class="addressFooter" style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">

                              <li class="phone"><i class="icon anm anm-phone-s"></i>
                                  <p>(123) 000 000 0000</p>
                              </li>
                              <li class="email"><i class="icon anm anm-envelope-l"></i>
                                  <p>email</p>
                              </li>
                              <li><i class="fa-brands fa-instagram"></i> Reppin.co</li>
                          </ul>

                      </div>
                      <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
                          <h4 class="h4" style="font-family: zurichultraBlkExbt;">Informations</h4>
                          <ul style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                              <li><a href="<?php echo base_url('contact_us') ?>">Contact us</a></li>
                              <li><a href="<?php echo base_url('about') ?>">About us</a></li>
                              <li><a href="#">Privacy policy</a></li>
                              <li><a href="#">Terms &amp; condition</a></li>
                          </ul>
                      </div>
                      <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
                          <h4 class="h4" style="font-family: zurichultraBlkExbt;">Customer Services</h4>
                          <ul style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                              <li><a href="#">Refund & Returns </a></li>
                              <li><a href="#">Shipping policy</a></li>
                              <li><a href="#">Other Policies</a></li>
                          </ul>
                      </div>
                      <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
                          <h4 class="h4" style="font-family: zurichultraBlkExbt;">Stay Connected </h4>
                          <ul style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">

                              <li>
                                  <a href="#"> <img src="<?php echo base_url('assets/') ?>images/footer/insta.jpeg" style="height: 20vh;" alt=""> </a>
                              </li>
                          </ul>
                      </div>
                  </div>
              </div>
              <!--End Footer Links-->
              <hr>
              <div class="footer-bottom">
                  <div class="row">

                  </div>
              </div>
          </div>
      </div>
  </footer>
  <!--End Footer-->
  <!--Scoll Top-->
  <span id="site-scroll"><i class="icon anm anm-angle-up-r"></i></span>
  <!--End Scoll Top-->





  <!-- Including Jquery -->
  <script src="<?php echo base_url('admin_assets/') ?>libs/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url('assets/') ?>js/vendor/modernizr-3.6.0.min.js"></script>
  <script src="<?php echo base_url('assets/') ?>js/vendor/jquery.cookie.js"></script>
  <script src="<?php echo base_url('assets/') ?>js/vendor/wow.min.js"></script>
  <script src="<?php echo base_url('assets/') ?>js/vendor/instagram-feed.js"></script>
  <!-- Including Javascript -->
  <script src="<?php echo base_url('assets/') ?>js/bootstrap.min.js"></script>
  <script src="<?php echo base_url('assets/') ?>js/plugins.js"></script>
  <script src="<?php echo base_url('assets/') ?>js/popper.min.js"></script>
  <script src="<?php echo base_url('assets/') ?>js/lazysizes.js"></script>
  <script src="<?php echo base_url('assets/') ?>js/main.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <script>
      window.onscroll = function() {
          myFunction()
      };

      // Get the navbar
      var navbar = document.getElementById("navbar");

      // Get the offset position of the navbar
      var sticky = navbar.offsetTop;

      // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
      function myFunction() {
          if (window.pageYOffset >= sticky) {
              navbar.classList.add("sticky")
          } else {
              navbar.classList.remove("sticky");
          }
      }
  </script>

  <?php
    if (isset($form_validation)) {
    ?>
      <script src="<?php echo base_url('admin_assets/') ?>libs/jquery/jquery-2.0.0.min.js"></script>
      <script src="<?php echo base_url(); ?>admin_assets/validation/formValidation.js"></script>
      <script src="<?php echo base_url(); ?>admin_assets/validation/bootstrap.js"></script>
  <?php
    }
    ?>
  </div>

  <script>
      function toast_success(msg) {
          Toastify({
              text: msg,
              duration: 3000,
              close: true,
              gravity: "top", // `top` or `bottom`
              position: "right", // `left`, `center` or `right`
              stopOnFocus: true, // Prevents dismissing of toast on hover
              style: {
                  background: "linear-gradient(to right, #00b09b, #00b09b)",
              },
              onClick: function() {} // Callback after click
          }).showToast();
      }

      function toast_danger(msg) {
          Toastify({
              text: msg,
              duration: 3000,
              close: true,
              gravity: "top", // `top` or `bottom`
              position: "right", // `left`, `center` or `right`
              stopOnFocus: true, // Prevents dismissing of toast on hover
              style: {
                  background: "linear-gradient(to right, #ff5f6d, #ff5f6d)",
              },
              onClick: function() {} // Callback after click
          }).showToast();
      }
  </script>

  <?php
  $flash_message = $this->session->flashdata('message');
//   echo $flash_message;
  if(!empty($flash_message)){
    $this->session->set_flashdata('message', null);
        echo "<script>alert('{$flash_message}');</script>";
  }
  ?>
  </body>

  </html>