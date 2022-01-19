<!DOCTYPE html>
<html lang="en" data-kit-theme="default">

<head>
   <!---cdn css files area start-->
   <?php $page = '';
   require_once('includes/cssfiles.php');
   $unique_id = $_GET['unique_id'];
   $sql = "SELECT * FROM admin_table WHERE unique_id = '$unique_id'";
   $result =  mysqli_query($con, $sql);
   $row = mysqli_fetch_array($result);
   if (isset($_POST['adminProfileUpdate'])) {
      $admin_name = $_POST["admin_name"];
      $admin_email = $_POST["admin_email"];
      $admin_contact_no = $_POST["admin_contact_no"];

      $update_sql = "UPDATE admin_table SET admin_name='$admin_name',admin_email='$admin_email',admin_contact_no='$admin_contact_no'  WHERE unique_id='$unique_id' ";

      $update_result = mysqli_query($con, $update_sql);
      if ($update_result == TRUE) {
         $_SESSION['msg'] = "Profile!";
         $_SESSION['status'] = "Updated Successfully!";
         $_SESSION['status_code'] = "success";
   ?>
         <script>
            window.location.href = 'Profile';
         </script>
      <?php
      } else {
         $_SESSION['msg'] = "Sorry!";
         $_SESSION['status'] = "Sorry Something Went Wrong! Try again Later";
         $_SESSION['status_code'] = "error";
      ?>
         <script>
            window.location.href = 'Profile';
         </script>
   <?php
      }
   }
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
                        <a href="#" class="air__subbar__breadcrumbLink air__subbar__breadcrumbLink--current">Update Profile</a>
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
                     <span class="mr-3">Update Profile</span>
                  </h5>
               </div>
               <div class="card">
                  <div class="card-header bg-dark">
                     <h4 class="mb-0 text-white">Update Profile</h4>
                  </div>
                  <div class="card-body text-dark">
                     <form method="POST" action="">
                        <div class="form-group">
                           <label>Name*</label>
                           <input type="text" onKeyDown="javascript: var keycode = keyPressed(event); if(keycode==32){ return false; }" name="admin_name" id="admin_name" value="<?php echo $row['admin_name'] ?>" class="form-control" required />
                        </div>
                        <div class="form-group">
                           <label>Email*</label>
                           <input type="text" onKeyDown="javascript: var keycode = keyPressed(event); if(keycode==32){ return false; }" name="admin_email" id="admin_email" value="<?php echo $row['admin_email'] ?>" class="form-control" required />
                        </div>
                        <div class="form-group">
                           <label>Contact Number*</label>
                           <input type="text" onKeyDown="javascript: var keycode = keyPressed(event); if(keycode==32){ return false; }" name="admin_contact_no" id="admin_contact_no" value="<?php echo $row['admin_contact_no'] ?>" class="form-control" required />
                        </div>
                        <button type="submit" name="adminProfileUpdate" id="submit" class="btn btn-dark btn-rounded btn-block">Save Changes</button>
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
</body>

</html>