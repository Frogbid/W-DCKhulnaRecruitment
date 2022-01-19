<!DOCTYPE html>
<html lang="en" data-kit-theme="default">

<head>
   <!---cdn css files area start-->
   <?php $page = '';
   require_once('includes/cssfiles.php');
   ?>
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
                        <a href="#" class="air__subbar__breadcrumbLink air__subbar__breadcrumbLink--current">Change Password</a>
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
                     <span class="mr-3">Update password</span>
                  </h5>
               </div>
               <div class="card">
                  <div class="card-header bg-dark">
                     <h4 class="mb-0 text-white">Update Password &nbsp;(Hint: Please, use strong passsword!)</h4>
                  </div>
                  <div class="card-body text-dark">
                     <form action="update/updatepassword.php" method="POST" class="p-2">
                        <div class="form-group">
                           <label class="font-weight-bold">Old Password*</label>
                           <input type="password" id="password" name="oldpwd" minlength="6" class="form-control" placeholder="old password" autocomplete="off" required>
                        </div>

                        <div class="form-group">
                           <label class="font-weight-bold">New password*</label>
                           <input type="password" id="cpassword" name="newpwd" minlength="6" class="form-control" minlength="3" placeholder="new password" autocomplete="off" required>
                        </div>

                        <div class="form-group">
                           <label class="font-weight-bold">Confirm Password*</label>
                           <input type="password" id="ccpassword" name="confrmpwd" minlength="6" class="form-control" placeholder="confirm password" autocomplete="off" required>
                        </div>
                        <input type="submit" name="passwordupdate" class="btn btn-dark btn-block btn-rounded" value="Submit">
                     </form>
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
            autosize($('#textarea'))

            $('#password').password({
               eyeClass: '',
               eyeOpenClass: 'fe fe-eye',
               eyeCloseClass: 'fe fe-eye-off',
            })
         })
      })(jQuery)
   </script>
   <script>
      ;
      (function($) {
         'use strict'
         $(function() {
            autosize($('#textarea'))
            $('#cpassword').password({
               eyeClass: '',
               eyeOpenClass: 'fe fe-eye',
               eyeCloseClass: 'fe fe-eye-off',
            })
         })
      })(jQuery)
   </script>
   <script>
      ;
      (function($) {
         'use strict'
         $(function() {
            autosize($('#textarea'))
            $('#ccpassword').password({
               eyeClass: '',
               eyeOpenClass: 'fe fe-eye',
               eyeCloseClass: 'fe fe-eye-off',
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