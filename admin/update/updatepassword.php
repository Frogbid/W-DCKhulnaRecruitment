<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
   header("location:Welcome");
}
include('../config/dbconfig.php');
//Account settings*
if (isset($_POST['passwordupdate'])) {
   $unique_id = $_SESSION['unique_id'];

   $pass = $_POST['oldpwd'];

   $hashkey = "manageoffice";

   $old = hash('gost', $pass . $hashkey);

   $newpwd = $_POST['newpwd'];

   $confrmpwd = $_POST['confrmpwd'];

   $new = hash('gost', $newpwd . $hashkey);

   $query = "SELECT admin_password FROM admin_table WHERE unique_id=$unique_id ";

   $result = mysqli_query($con, $query);

   while ($row = mysqli_fetch_array($result)) {
      $pass = $row['admin_password'];

      if ($pass == $old) {
         if ($newpwd == $confrmpwd) {
            $q = " UPDATE admin_table SET admin_password= '$new' WHERE unique_id=$unique_id ";
            $update = mysqli_query($con, $q);

            if ($update) {
               $_SESSION['msg'] = "Thank You!";
               $_SESSION['status'] = "Password changed Successfully!";
               $_SESSION['status_code'] = "success";
               header('location:../Changepassword');
            } else {
               $_SESSION['msg'] = "Sorry!";
               $_SESSION['status'] = "Something Went Wrong! Try again Later";
               $_SESSION['status_code'] = "error";
               header('location:../Changepassword');
            }
         } else {
            $_SESSION['msg'] = "Sorry!";
            $_SESSION['status'] = "New & Confirm Password doesnot match! Try again Later";
            $_SESSION['status_code'] = "error";
            header('location:../Changepassword');
         }
      } else {
         $_SESSION['msg'] = "Sorry!";
         $_SESSION['status'] = "Old Password doesnot match! Try again Later";
         $_SESSION['status_code'] = "error";
         header('location:../Changepassword');
      }
   }
}
//Account settings end
