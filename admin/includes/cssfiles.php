<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
   header("location:Welcome");
}
include('config/dbconfig.php');
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
$unique_id = $_SESSION['unique_id'];
$query = "SELECT * FROM `admin_table` where unique_id=$unique_id ";
$data = mysqli_query($con, $query);
$total = mysqli_num_rows($data);

$admin_name = "";
$admin_type = "";
if ($total != 0) {
   while ($result = mysqli_fetch_assoc($data)) {
      $admin_name = $result['admin_name'];
      $admin_type = $result['admin_type'];
   }
} else {
   "No Records Found!!!";
}
?>
<?php
//print bangladesi currency format
function formatcurrency($floatcurr, $curr = "BDT")
{
   $currencies['BDT'] = array(2, '.', ',');          //  Bangladesh, Taka

   function formatinr($input)
   {
      //CUSTOM FUNCTION TO GENERATE ##,##,###.##
      $dec = "";
      $pos = strpos($input, ".");
      if ($pos === false) {
         //no decimals   
      } else {
         //decimals
         $dec = substr(substr($input, $pos), 2);
         $input = substr($input, 0, $pos);
      }
      $num = substr($input, -3); //get the last 3 digits
      $input = substr($input, 0, -3); //omit the last 3 digits already stored in $num
      while (strlen($input) > 0) //loop the process - further get digits 2 by 2
      {
         $num = substr($input, -2) . "," . $num;
         $input = substr($input, 0, -2);
      }
      return $num . $dec;
   }


   if ($curr == "BDT") {
      return formatinr(($floatcurr));
   } else {
      return number_format($floatcurr, $currencies[$curr][0], $currencies[$curr][1], $currencies[$curr][2]);
   }
}
?>
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
<link rel="stylesheet" href="vendors/toaster/css/toastr.css" />
<link href="parsley.css" rel="stylesheet" />

<!-- Morris Chart Css-->
<link href="vendors/morrisjs/morris.css" rel="stylesheet" />

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