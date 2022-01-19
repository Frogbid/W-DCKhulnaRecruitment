<!DOCTYPE html>
<html lang="en" data-kit-theme="default">

<head>
   <!---cdn css files area start-->
   <?php $page = '';
   require_once('includes/cssfiles.php'); ?>
   <!---cdn css files area end-->
</head>

<body class="air__menu--gray air__layout--contentMaxWidth">
   <!---preloader area start-->
   <?php require_once('includes/preloader.php'); ?>
   <!---preloader area end-->
   <div class="air__layout air__layout--hasSider">
      <!--left sidebar area start-->
      <?php require_once('includes/leftsidebar.php'); ?>
      <!---left sidebar area ends-->

      <!---mobile menu area start-->
      <div class="air__menuLeft__backdrop air__menuLeft__mobileActionToggle"></div>
      <!---mobile menu area end-->

      <!---dark theme activation area start-->
      <?php require_once('includes/darkthemeactivation.php'); ?>
      <!---dark theme activation area end-->

      <div class="air__layout">
         <div class="air__layout__header">
            <div class="air__utils__header">
               <!---top navigation bar area start-->
               <?php require_once('includes/topnavbar.php'); ?>
               <!---top navigation bar area end-->
               <!---page titile area start-->
               <div class="air__subbar">
                  <ul class="air__subbar__breadcrumbs mr-4">
                     <li class="air__subbar__breadcrumb">
                        <a href="#" class="air__subbar__breadcrumbLink air__subbar__breadcrumbLink--current">Profile</a>
                     </li>
                  </ul>
                  <div class="air__subbar__divider mr-4 d-none d-xl-block"></div>

               </div>
               <!---page titile area end-->
            </div>
         </div>
         <!---main page content write here-->
         <div class="air__layout__content">
            <div class="air__utils__content">
               <div class="kit__utils__heading">
                  <h5>
                     <span class="mr-3">My Profile</span>
                  </h5>
               </div>
               <div class="card">
                  <div class="card-body">
                     <div class="table-responsive">
                        <table id="example1" class="table table-striped table-bordered text-center">
                           <thead>
                              <tr>
                                 <th>Serial no.</th>
                                 <th>Name</th>
                                 <th>Email</th>
                                 <th>Contact Number</th>
                                 <th><i class="fa fa-pencil-square-o" aria-hidden="true"></i></th>
                              </tr>
                           </thead>

                           <tbody>
                              <?php
                              $unique_id = $_SESSION['unique_id'];
                              $query = "SELECT * FROM admin_table WHERE unique_id='$unique_id'";
                              $data = mysqli_query($con, $query);
                              $serial_no = 1;
                              if (mysqli_num_rows($data) > 0) {
                                 while ($row = mysqli_fetch_assoc($data)) {
                              ?>
                                    <tr>
                                       <td><?php echo $serial_no; ?></td>
                                       <td><?php echo $row["admin_name"]; ?></td>
                                       <td><?php echo $row["admin_email"]; ?></td>
                                       <td><?php echo $row['admin_contact_no']; ?></td>
                                       <td><a href="Changeprofile?unique_id=<?php echo $row["unique_id"]; ?>" class="btn btn-dark btn-rounded"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                    </tr>
                              <?php
                                    $serial_no++;
                                 }
                              }
                              ?>

                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!---main page content write here area end-->
         <!---footer area starts here-->
         <?php require_once('includes/footer.php'); ?>
         <!---footer area starts here-->
      </div>
   </div>
   <!---Scripts area start-->
   <?php require_once('includes/jsfiles.php'); ?>
   <!---Scripts area end-->
   <!---additional scripts area start-->
   <script>
      ;
      (function($) {
         'use strict'
         $(function() {
            $('#example1').DataTable({
               responsive: true,
            })
         })
      })(jQuery)
   </script>
   <!--- alert pop up area --->
   <?php
   if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
   ?>
      <script>
         toastr.<?php echo $_SESSION['status_code']; ?>("<?php echo $_SESSION['status']; ?>", "<?php echo $_SESSION['msg']; ?>", {
            progressBar: !0
         });
      </script>
   <?php
      unset($_SESSION['status']);
   }
   ?>
   <!--- alert pop up end--->
   <!---additional scripts area end-->
</body>

</html>