<?php
include('config/dbconfig.php');
$unique_id = $_SESSION['unique_id'];
$query = "SELECT * FROM `admin_table` where unique_id=$unique_id ";
$data = mysqli_query($con, $query);
$total = mysqli_num_rows($data);

$admin_hash_password = "";
$admin_name = "";
$admin_email = "";
if ($total != 0) {
   while ($result = mysqli_fetch_assoc($data)) {
      $admin_name = $result['admin_name'];
      $admin_email = $result['admin_email'];
      $admin_hash_password = $result['admin_password'];
   }
} else {
   "No Records Found!!!";
}
?>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/popper.js/dist/umd/popper.js"></script>
<script src="vendors/jquery-ui/jquery-ui.min.js"></script>
<script src="vendors/bootstrap/dist/js/bootstrap.js"></script>
<script src="vendors/jquery-mousewheel/jquery.mousewheel.min.js"></script>
<script src="vendors/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
<script src="vendors/spin.js/spin.js"></script>
<script src="vendors/ladda/dist/ladda.min.js"></script>
<script src="vendors/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="vendors/select2/dist/js/select2.full.min.js"></script>
<script src="vendors/html5-form-validation/dist/jquery.validation.min.js"></script>
<script src="vendors/jquery-typeahead/dist/jquery.typeahead.min.js"></script>
<script src="vendors/jquery-mask-plugin/dist/jquery.mask.min.js"></script>
<script src="vendors/autosize/dist/autosize.min.js"></script>
<script src="vendors/bootstrap-show-password/dist/bootstrap-show-password.min.js"></script>
<script src="vendors/moment/min/moment.min.js"></script>
<script src="vendors/tempus-dominus-bs4/build/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="vendors/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="vendors/bootstrap-sweetalert/dist/sweetalert.min.js"></script>
<script src="vendors/remarkable-bootstrap-notify/dist/bootstrap-notify.min.js"></script>
<script src="vendors/summernote/dist/summernote.min.js"></script>
<script src="vendors/owl.carousel/dist/owl.carousel.min.js"></script>
<script src="vendors/ionrangeslider/js/ion.rangeSlider.min.js"></script>
<script src="vendors/nestable/jquery.nestable.js"></script>
<script type="text/javascript" src="cdn.datatables.net/v/bs4/dt-1.10.18/fc-3.2.5/r-2.2.2/datatables.min.js">
</script>
<script src="vendors/editable-table/mindmup-editabletable.js"></script>
<script src="vendors/d3/d3.min.js"></script>
<script src="vendors/c3/c3.min.js"></script>
<script src="vendors/chartist/dist/chartist.min.js"></script>
<script src="vendors/peity/jquery.peity.min.js"></script>
<script src="vendors/chartist-plugin-tooltips-updated/dist/chartist-plugin-tooltip.min.js"></script>
<script src="vendors/jquery-countTo/jquery.countTo.js"></script>
<script src="vendors/nprogress/nprogress.js"></script>
<script src="vendors/jquery-steps/build/jquery.steps.min.js"></script>
<script src="vendors/chart.js/dist/Chart.bundle.min.js"></script>
<script src="vendors/dropify/dist/js/dropify.min.js"></script>
<script src="vendors/d3-dsv/dist/d3-dsv.js"></script>
<script src="vendors/d3-time-format/dist/d3-time-format.js"></script>
<script src="vendors/techan/dist/techan.min.js"></script>
<script src="vendors/jqvmap/dist/jquery.vmap.js"></script>
<script src="vendors/jqvmap/dist/maps/jquery.vmap.usa.js" charset="utf-8"></script>


<script src="components/kit/core/index.js"></script>
<script src="components/airui/layout/menu-left/index.js"></script>
<script src="components/airui/layout/menu-top/index.js"></script>
<script src="components/airui/layout/sidebar/index.js"></script>
<script src="components/airui/layout/support-chat/index.js"></script>
<script src="components/airui/layout/topbar/index.js"></script>
<script src="https://cdn.ckeditor.com/4.5.1/standard/ckeditor.js"></script>
<script src="http://parsleyjs.org/dist/parsley.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="vendors/toaster/js/toastr.min.js"></script>
<script src="vendors/toaster/js/toastr.script.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

<!-- Morris Plugin Js -->
<script src="vendors/raphael/raphael.min.js"></script>
<script src="vendors/morrisjs/morris.js"></script>
<script>
   $(document).ready(function() {
      $('.initial__loading').delay(200).fadeOut(400)
   })
</script>
<script>
   $(document).ready(function() {
      $('#validate_form').parsley();
   });
</script>
<script>
   ;
   (function($) {
      'use strict'
      $(function() {
         $('.dropify').dropify()
      })
   })(jQuery)
</script>

<script>
   ;
   (function($) {
      'use strict'
      $(function() {
         $('.select2').select2()
         $('.select2-tags').select2({
            tags: true,
            tokenSeparators: [',', ' '],
         })
      })
   })(jQuery)
</script>
<script type="text/javascript">
   function keyPressed() {
      return key;
   }
</script>
<script>
   function checkvalidUsersalary() {
      pass1 = "<?php echo $admin_hash_password; ?>";
      console.log(pass1);
      password = prompt('Please Enter your password');
      $.ajax({
         url: 'passwordfetch.php',
         type: 'POST',
         data: {
            password: password
         },
         success: function(result) {
            if (result === "Password match") {
               window.location = "Givesalary";
            } else {
               alert(result);
               window.location = "Dashboard";
            }
         }
      });
   }
</script>

<script>
   function checkvalidUserexpense() {
      pass1 = "<?php echo $admin_hash_password; ?>";
      console.log(pass1);
      password = prompt('Please Enter your password');
      $.ajax({
         url: 'passwordfetch.php',
         type: 'POST',
         data: {
            password: password
         },
         success: function(result) {
            if (result === "Password match") {
               window.location = "Expense";
            } else {
               alert(result);
               window.location = "Dashboard";
            }
         }
      });
   }
</script>

<script>
   function checkvalidUserdueInvoice() {
      pass1 = "<?php echo $admin_hash_password; ?>";
      console.log(pass1);
      password = prompt('Please Enter your password');
      $.ajax({
         url: 'passwordfetch.php',
         type: 'POST',
         data: {
            password: password
         },
         success: function(result) {
            if (result === "Password match") {
               window.location = "Dueinvoices";
            } else {
               alert(result);
               window.location = "Dashboard";
            }
         }
      });
   }
</script>

<script>
   function checkvalidUserLoan() {
      pass1 = "<?php echo $admin_hash_password; ?>";
      console.log(pass1);
      password = prompt('Please Enter your password');
      $.ajax({
         url: 'passwordfetch.php',
         type: 'POST',
         data: {
            password: password
         },
         success: function(result) {
            if (result === "Password match") {
               window.location = "Addloan";
            } else {
               alert(result);
               window.location = "Dashboard";
            }
         }
      });
   }
</script>

<script>
   function checkvalidUserMakeinvoice() {
      pass1 = "<?php echo $admin_hash_password; ?>";
      console.log(pass1);
      password = prompt('Please Enter your password');
      $.ajax({
         url: 'passwordfetch.php',
         type: 'POST',
         data: {
            password: password
         },
         success: function(result) {
            if (result === "Password match") {
               window.location = "Invoice";
            } else {
               alert(result);
               window.location = "Dashboard";
            }
         }
      });
   }
</script>

<script>
   function checkvalidUserMakebuyinvoice() {
      pass1 = "<?php echo $admin_hash_password; ?>";
      console.log(pass1);
      password = prompt('Please Enter your password');
      $.ajax({
         url: 'passwordfetch.php',
         type: 'POST',
         data: {
            password: password
         },
         success: function(result) {
            if (result === "Password match") {
               window.location = "buyinginvoicemake.php";
            } else {
               alert(result);
               window.location = "Dashboard";
            }
         }
      });
   }
</script>

<script>
   function checkvalidUserIncomeVoucher() {
      pass1 = "<?php echo $admin_hash_password; ?>";
      console.log(pass1);
      password = prompt('Please Enter your password');
      $.ajax({
         url: 'passwordfetch.php',
         type: 'POST',
         data: {
            password: password
         },
         success: function(result) {
            if (result === "Password match") {
               window.location = "IncomeVoucher";
            } else {
               alert(result);
               window.location = "Dashboard";
            }
         }
      });
   }
</script>

<script>
   function checkvalidUserCash() {
      pass1 = "<?php echo $admin_hash_password; ?>";
      console.log(pass1);
      password = prompt('Please Enter your password');
      $.ajax({
         url: 'passwordfetch.php',
         type: 'POST',
         data: {
            password: password
         },
         success: function(result) {
            if (result === "Password match") {
               window.location = "Cash";
            } else {
               alert(result);
               window.location = "Dashboard";
            }
         }
      });
   }
</script>

<script>
   function checkvalidUserMakeinvoicebuy() {
      pass1 = "<?php echo $admin_hash_password; ?>";
      console.log(pass1);
      password = prompt('Please Enter your password');
      $.ajax({
         url: 'passwordfetch.php',
         type: 'POST',
         data: {
            password: password
         },
         success: function(result) {
            if (result === "Password match") {
               window.location = "buyinginvoicemake.php";
            } else {
               alert(result);
               window.location = "Dashboard";
            }
         }
      });
   }
</script>

<script>
   function checkvalidUserupdateinvoicebuy() {
      pass1 = "<?php echo $admin_hash_password; ?>";
      console.log(pass1);
      password = prompt('Please Enter your password');
      $.ajax({
         url: 'passwordfetch.php',
         type: 'POST',
         data: {
            password: password
         },
         success: function(result) {
            if (result === "Password match") {
               window.location = "recievablebuyinginvoice.php";
            } else {
               alert(result);
               window.location = "Dashboard";
            }
         }
      });
   }
</script>

<!-- check user inactivity -->
<script>
   setInterval(function() {
      check_user();
   }, 18000000);

   function check_user() {
      jQuery.ajax({
         url: 'user_auth.php',
         type: "post",
         data: 'type=ajax',
         success: function(result) {
            if (result === 'logout') {
               toastr.info('Your Session Has Timed Out! Please Log In Again');
               window.location = "logout.php";
               console.log(result);
            }
         }
      });
   }
</script>