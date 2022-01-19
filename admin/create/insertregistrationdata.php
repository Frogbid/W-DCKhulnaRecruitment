<?php
session_start();
include('../config/dbconfig.php');
if (isset($_POST['submit'])) {
   $admin_name = mysqli_real_escape_string($con, $_POST["admin_name"]);

   $admin_email = mysqli_real_escape_string($con, $_POST["admin_email"]);

   $admin_contact_no = mysqli_real_escape_string($con, $_POST["admin_contact_no"]);

   $admin_password = mysqli_real_escape_string($con, $_POST["admin_password"]);
   $hashkey = "manageoffice";
   $hashpass = hash('gost', $admin_password . $hashkey);

   $query = "SELECT * FROM `admin_table`";
   $data = mysqli_query($con, $query);
   $total = mysqli_num_rows($data);

   $existing_email = "";
   $existing_mobile = "";
   if ($total != 0) {
      while ($result = mysqli_fetch_assoc($data)) {
         $existing_email = $result['admin_email'];
         $existing_mobile = $result['admin_contact_no'];
      }
   } else {
      "No Records Found!!!";
   }

   if ($_POST["admin_email"] == $existing_email) {
      $_SESSION['msg'] = "Sorry!";
      $_SESSION['status'] = "This Email has been already registered!";
      $_SESSION['status_code'] = "error";
      header('location:../Register');
   } else if ($_POST["admin_contact_no"] == $existing_mobile) {
      $_SESSION['msg'] = "Sorry!";
      $_SESSION['status'] = "This Contact Number has been already taken!";
      $_SESSION['status_code'] = "error";
      header('location:../Register');
   } else {
      $signup_query = "INSERT INTO `admin_table` (`admin_name`,`admin_email`,`admin_contact_no`,`admin_password`) VALUES ('$admin_name', '$admin_email', '$admin_contact_no', '$hashpass')";
      $result = mysqli_query($con, $signup_query);
      if ($result == true) {
         $_SESSION['msg'] = "Thank You!";
         $_SESSION['status'] = "Registration completed Successfully!";
         $_SESSION['status_code'] = "success";
         header('location:../Register');
      } else {
         $_SESSION['msg'] = "Sorry!";
         $_SESSION['status'] = "Sorry Something Went Wrong! Try again Later";
         $_SESSION['status_code'] = "error";
         header('location:../Register');
      }
   }
}
