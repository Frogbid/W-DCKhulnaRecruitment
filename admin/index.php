<?php
session_start();
require 'config/dbconfig.php';
$query = "SELECT * FROM `setting`";
$data = mysqli_query($con, $query);
$total = mysqli_num_rows($data);
$title = "";
$logo = "";
$favicon = "";
$office_name = "";
$ofiice_address = "";
$office_contact_no = "";
$office_email = "";
$start_time = "";
$end_time = "";
$est_year = "";
$contact_us = "";
$about_us = "";
$privacy_policy = "";
$terms = "";
if ($total != 0) {
   while ($result = mysqli_fetch_assoc($data)) {
      $title = $result['title'];
      $favicon = $result['favicon'];
      $logo = $result['logo'];
      $office_name = $result['office_name'];
      $ofiice_address = $result['ofiice_address'];
      $contact_us = $result['contact_us'];
      $about_us = $result['about_us'];
      $privacy_policy = $result['privacy_policy'];
      $terms = $result['terms'];
      $office_contact_no = $result['office_contact_no'];
      $start_time = $result['start_time'];
      $end_time = $result['end_time'];
      $office_email = $result['office_email'];
      $est_year = $result['est_year'];
   }
} else {
   "No Records Found!!!";
}
$error_msg = '';
if (isset($_POST['login'])) {
   $admin_email = $_POST['admin_email'];
   $admin_password = $_POST['admin_password'];
   $admin_email = mysqli_real_escape_string($con, $admin_email);
   $admin_password = mysqli_real_escape_string($con, $admin_password);
   $hashkey = "manageoffice";
   $hashpass = hash('gost', $admin_password . $hashkey);

   $query = "SELECT unique_id,admin_password,admin_type,admin_name FROM admin_table where admin_email = '$admin_email' and admin_password= '$hashpass'";
   $data = mysqli_query($con, $query);
   $total = mysqli_num_rows($data);

   $unique_id = "";

   $admin_type = "";
   if ($total != 0) {
      while ($result = mysqli_fetch_assoc($data)) {
         $unique_id = $result['unique_id'];

         $admin_type = $result['admin_type'];

         $admin_name = $result['admin_name'];
      }
   } else {
      "No Records Found!!!";
   }

   $sql = "SELECT unique_id,admin_password,admin_type from admin_table where admin_email = '$admin_email' and admin_password= '$hashpass' ";

   $login_match_query = mysqli_query($con, $sql);

   $row = mysqli_num_rows($login_match_query);

   if ($row == 1) {
      $_SESSION['unique_id'] = $unique_id;
      $_SESSION['last_active_time'] = time();
      if ($admin_type == 0) {
         $_SESSION['status'] = "Welcome!";
         $_SESSION['status_code'] = "success";
         header('location:viewemployee.php');
      }
   } else if ($_POST['admin_email'] != $_POST['admin_password']) {
      $error_msg = '<i class="fa fa-exclamation-triangle" aria-hidden="true">&nbsp;‌Wrong credentials! Try again!</i> ';
   }
}
?>
<!DOCTYPE html>
<html lang="en" data-kit-theme="default">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title>
      <?php echo $office_name; ?>
   </title>
   <link rel="icon" type="image/png" href="<?php echo $favicon; ?>" />
   <link href="https://fonts.googleapis.com/css?family=Mukta:400,700,800&amp;display=swap" rel="stylesheet">

   <!-- VENDORS -->
   <link rel="stylesheet" type="text/css" href="vendors/bootstrap/dist/css/bootstrap.css">
   <link rel="stylesheet" type="text/css" href="vendors/perfect-scrollbar/css/perfect-scrollbar.css">
   <link rel="stylesheet" type="text/css" href="vendors/ladda/dist/ladda-themeless.min.css">
   <link rel="stylesheet" type="text/css" href="vendors/bootstrap-select/dist/css/bootstrap-select.min.css">
   <link rel="stylesheet" type="text/css" href="vendors/select2/dist/css/select2.min.css">
   <link rel="stylesheet" type="text/css" href="vendors/tempus-dominus-bs4/build/css/tempusdominus-bootstrap-4.min.css">
   <link rel="stylesheet" type="text/css" href="vendors/fullcalendar/dist/fullcalendar.min.css">
   <link rel="stylesheet" type="text/css" href="vendors/bootstrap-sweetalert/dist/sweetalert.css">
   <link rel="stylesheet" type="text/css" href="vendors/summernote/dist/summernote.css">
   <link rel="stylesheet" type="text/css" href="vendors/owl.carousel/dist/assets/owl.carousel.min.css">
   <link rel="stylesheet" type="text/css" href="vendors/ionrangeslider/css/ion.rangeSlider.css">
   <link rel="stylesheet" type="text/css" href="cdn.datatables.net/v/bs4/dt-1.10.18/fc-3.2.5/r-2.2.2/datatables.min.css" />
   <link rel="stylesheet" type="text/css" href="vendors/c3/c3.min.css">
   <link rel="stylesheet" type="text/css" href="vendors/chartist/dist/chartist.min.css">
   <link rel="stylesheet" type="text/css" href="vendors/nprogress/nprogress.css">
   <link rel="stylesheet" type="text/css" href="vendors/jquery-steps/demo/css/jquery.steps.css">
   <link rel="stylesheet" type="text/css" href="vendors/dropify/dist/css/dropify.min.css">
   <link rel="stylesheet" type="text/css" href="vendors/font-feathericons/dist/feather.css">
   <link rel="stylesheet" type="text/css" href="vendors/font-linearicons/style.css">
   <link rel="stylesheet" type="text/css" href="vendors/font-icomoon/style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" />
   <link rel="stylesheet" href="vendors/toaster/css/toastr.css" />

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
   <script type="text/javascript" src="cdn.datatables.net/v/bs4/dt-1.10.18/fc-3.2.5/r-2.2.2/datatables.min.js"></script>
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
   <script src="vendors/toaster/js/toastr.min.js"></script>
   <script src="vendors/toaster/js/toastr.script.min.js"></script>

   <!-- AIR UI HTML ADMIN TEMPLATE MODULES-->
   <link rel="stylesheet" type="text/css" href="components/kit/vendors/style.css">
   <link rel="stylesheet" type="text/css" href="components/kit/core/style.css">
   <link rel="stylesheet" type="text/css" href="components/airui/styles/style.css">
   <link rel="stylesheet" type="text/css" href="components/kit/widgets/style.css">
   <link rel="stylesheet" type="text/css" href="components/kit/apps/style.css">
   <link rel="stylesheet" type="text/css" href="components/airui/ecommerce/style.css">
   <link rel="stylesheet" type="text/css" href="components/airui/dashboards/crypto-terminal/style.css">
   <link rel="stylesheet" type="text/css" href="components/airui/system/auth/style.css">

   <link rel="stylesheet" type="text/css" href="components/airui/layout/footer/style.css">
   <link rel="stylesheet" type="text/css" href="components/airui/layout/footer-dark/style.css">
   <link rel="stylesheet" type="text/css" href="components/airui/layout/menu-left/style.css">
   <link rel="stylesheet" type="text/css" href="components/airui/layout/menu-top/style.css">
   <link rel="stylesheet" type="text/css" href="components/airui/layout/sidebar/style.css">
   <link rel="stylesheet" type="text/css" href="components/airui/layout/support-chat/style.css">
   <link rel="stylesheet" type="text/css" href="components/airui/layout/topbar/style.css">
   <link rel="stylesheet" type="text/css" href="components/airui/layout/topbar-dark/style.css">
   <link rel="stylesheet" type="text/css" href="components/airui/layout/subbar/style.css">
   <link href="parsley.css" rel="stylesheet" />


   <script src="components/kit/core/index.js"></script>
   <script src="components/airui/layout/menu-left/index.js"></script>
   <script src="components/airui/layout/menu-top/index.js"></script>
   <script src="components/airui/layout/sidebar/index.js"></script>
   <script src="components/airui/layout/support-chat/index.js"></script>
   <script src="components/airui/layout/topbar/index.js"></script>

   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
   <!-- PRELOADER STYLES-->
   <style>
      .initial__loading {
         position: fixed;
         z-index: 99999;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background-position: center center;
         background-repeat: no-repeat;
         background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDFweCIgIGhlaWdodD0iNDFweCIgIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmlld0JveD0iMCAwIDEwMCAxMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89InhNaWRZTWlkIiBjbGFzcz0ibGRzLXJvbGxpbmciPiAgICA8Y2lyY2xlIGN4PSI1MCIgY3k9IjUwIiBmaWxsPSJub25lIiBuZy1hdHRyLXN0cm9rZT0ie3tjb25maWcuY29sb3J9fSIgbmctYXR0ci1zdHJva2Utd2lkdGg9Int7Y29uZmlnLndpZHRofX0iIG5nLWF0dHItcj0ie3tjb25maWcucmFkaXVzfX0iIG5nLWF0dHItc3Ryb2tlLWRhc2hhcnJheT0ie3tjb25maWcuZGFzaGFycmF5fX0iIHN0cm9rZT0iIzAxOTBmZSIgc3Ryb2tlLXdpZHRoPSIxMCIgcj0iMzUiIHN0cm9rZS1kYXNoYXJyYXk9IjE2NC45MzM2MTQzMTM0NjQxNSA1Ni45Nzc4NzE0Mzc4MjEzOCIgdHJhbnNmb3JtPSJyb3RhdGUoODQgNTAgNTApIj4gICAgICA8YW5pbWF0ZVRyYW5zZm9ybSBhdHRyaWJ1dGVOYW1lPSJ0cmFuc2Zvcm0iIHR5cGU9InJvdGF0ZSIgY2FsY01vZGU9ImxpbmVhciIgdmFsdWVzPSIwIDUwIDUwOzM2MCA1MCA1MCIga2V5VGltZXM9IjA7MSIgZHVyPSIxcyIgYmVnaW49IjBzIiByZXBlYXRDb3VudD0iaW5kZWZpbml0ZSI+PC9hbmltYXRlVHJhbnNmb3JtPiAgICA8L2NpcmNsZT4gIDwvc3ZnPg==);
         background-color: #fff;
      }

      [data-kit-theme='dark'] .initial__loading {
         background-color: #0c0c1b;
      }
   </style>
   <script>
      $(document).ready(function() {
         $('.initial__loading').delay(200).fadeOut(400)
      })
   </script>
</head>

<body class="">
   <div class="initial__loading"></div>
   <a href="javascript: void(0);" style="bottom: calc(50% + 60px)" class="air__sidebar__toggleButton air__sidebar__actionToggleTheme" data-toggle="tooltip" data-placement="left" title="Switch Dark / Light Theme">
      <i class=" fe fe-moon air__sidebar__on"></i>
      <i class="fe fe-sun air__sidebar__off"></i>
   </a>
   <div class="air__auth__authContainer">
      <div class="pt-5 pb-5 d-flex align-items-end mt-auto">
         <img src="website/2.png" alt="Website_Logo" style="width:100px;height:100px;">
      </div>
      <div class="air__auth__containerInner">
         <div class="card air__auth__boxContainer">
            <div class="text-dark font-size-32 mb-3">Sign In</div>
            <div class="bg-danger text-white font-weight-bold mb-1 text-center">
               <?php echo $error_msg ?>
            </div>
            <form method="POST" class="mb-4">
               <div class="form-group mb-4">
                  <input type="email" name="admin_email" class="form-control" placeholder="Email Address" required />
               </div>
               <div class="form-group mb-4">
                  <input id="passwordmatch" type="password" name="admin_password" minlength="6" class="form-control" placeholder="enter password" required data-parsley-trigger="keyup" />
               </div>
               <button type="submit" name="login" class="btn btn-dark text-danger text-center w-100">
                  <strong>Log in</strong>
               </button>
            </form>
         </div>
      </div>
      <div class="mt-auto pb-5 pt-5">
         <div class="text-center">
            Copyright ©2021 FrogBid
         </div>
      </div>
   </div>
   <script>
      ;
      (function($) {
         'use strict'
         $(function() {
            autosize($('#textarea'))

            $('#passwordmatch').password({
               eyeClass: '',
               eyeOpenClass: 'fe fe-eye',
               eyeCloseClass: 'fe fe-eye-off',
            })
         })
      })(jQuery)
   </script>
</body>

</html>