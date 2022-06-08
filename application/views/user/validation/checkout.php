 <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

 <script>
     function razorPayPopup(rzpoptions) {
         var options = rzpoptions;
         options.handler = function(response) {
             complete_payment(response.razorpay_payment_id, response.razorpay_signature, response.razorpay_order_id);
         };

         options.modal = {
             // ondismiss: function() {
             //     console.log("This code runs when the popup is closed")
             // },
             escape: true,
             backdropclose: false
         };

         var rzp = new Razorpay(options);
         rzp.open();
     }

     function complete_payment(razorpay_payment_id, razorpay_signature, razorpay_order_id) {
         var form = $('#checkout')[0];
         var formData = new FormData(form);
         formData.append('razorpay_payment_id', razorpay_payment_id);
         formData.append('razorpay_signature', razorpay_signature);
         formData.append('razorpay_order_id', razorpay_order_id);
         $.ajax({
             url: "<?php echo base_url(); ?>checkout/complete_payment",
             type: "POST",
             data: formData,
             contentType: false,
             cache: false,
             processData: false,
             success: function(result) {
                 var data = JSON.parse(result)
                 if (data.status == 200) {
                     $('#alert_message').addClass('alert-success').removeClass('d-none').text(data.message);

                     setTimeout(function() {
                         $('#alert_message').removeClass('alert-success').addClass('d-none').text(null);
                         window.location.href = '<?php echo base_url(); ?>myaccount/';
                     }, 3000);

                 } else {
                     $('#alert_message').addClass('alert-danger').removeClass('d-none').text(data.message);
                     setTimeout(function() {
                         $('#alert_message').removeClass('alert-danger').addClass('d-none').text(null);
                     }, 3000);
                 }
             },
             error: function(result) {
                 $('#alert_message').removeClass('d-none').addClass('alert-danger').html(result.statusText);
                 setTimeout(function() {
                     $("#submit_button").removeAttr("disabled").removeClass("disabled");
                     $('#alert_message').html('').removeClass('alert-danger').addClass('d-none');
                 }, 3000);
             }
         });
     }

     //   $('#place_order').on('click', function() {
     //       $.ajax({
     //           url: "<?php echo base_url(); ?>checkout/getdata",
     //           type: "POST",
     //           contentType: false,
     //           cache: false,
     //           processData: false,
     //           success: function(result) {
     //               var data = JSON.parse(result)
     //               if (data.status == 200) {
     //                   var razorpayData = JSON.parse(data.razorpayData)
     //                   var razorpayDataUpdated = JSON.stringify(razorpayData)
     //                   razorpayDataUpdated = JSON.parse(razorpayDataUpdated)
     //                   razorPayPopup(razorpayDataUpdated)
     //               } else {
     //                   toastr["error"]("Error", obj.message);
     //                   setTimeout(function() {
     //                       location.reload();
     //                   }, 3000);
     //               }

     //           },
     //           error: function(result) {
     //               $('#alert_message').removeClass('d-none').addClass('alert-danger').html(result.statusText);
     //               setTimeout(function() {
     //                   $("#submit_button").removeAttr("disabled").removeClass("disabled");
     //                   $('#alert_message').html('').removeClass('alert-danger').addClass('d-none');
     //               }, 3000);
     //           }
     //       });
     //   });


     $('#checkout').formValidation({
         message: 'This value is not valid',
         icon: {
             validating: 'glyphicon glyphicon-refresh'
         },
         fields: {
             firstname: {
                 validators: {
                     notEmpty: {
                         message: 'Please enter First Name'
                     }
                 }
             },
             order_note: {
                 validators: {
                     notEmpty: {
                         message: 'Please enter order note'
                     }
                 }
             }
         }
     }).on('success.form.fv', function(e) {
         // Prevent form submission
         e.preventDefault();

         // Get the form instance
         var $form = $(e.target);

         // Get the FormValidation instance
         var bv = $form.data('formValidation');

         // Use Ajax to submit form data
         $.ajax({
             url: "<?php echo base_url(); ?>checkout/getdata",
             type: "POST",
             contentType: false,
             cache: false,
             processData: false,
             success: function(result) {
                 var data = JSON.parse(result)
                 if (data.status == 200) {
                     var razorpayData = JSON.parse(data.razorpayData)
                     var razorpayDataUpdated = JSON.stringify(razorpayData)
                     razorpayDataUpdated = JSON.parse(razorpayDataUpdated)
                     razorPayPopup(razorpayDataUpdated)
                 } else {
                     toastr["error"]("Error", obj.message);
                     setTimeout(function() {
                         location.reload();
                     }, 3000);
                 }

             },
             error: function(result) {
                 $('#alert_message').removeClass('d-none').addClass('alert-danger').html(result.statusText);
                 setTimeout(function() {
                     $("#submit_button").removeAttr("disabled").removeClass("disabled");
                     $('#alert_message').html('').removeClass('alert-danger').addClass('d-none');
                 }, 3000);
             }
         });
     });
 </script>