<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
   header("location:Welcome");
}
include('config/dbconfig.php');
if (isset($_POST['employee_id'])) {
   $unique_id =  $_SESSION['unique_id'];
   $employee_id = trim($_POST['employee_id']);
   $values = explode(',', $employee_id);
   foreach ($values as $value) {
      $sql = "UPDATE `employee_info_table` SET `selected`= 1 WHERE employee_id='$value'";
      $resultset = mysqli_query($con, $sql) or die("database error:" . mysqli_error($con));
      if ($resultset == TRUE) {
         $_SESSION['msg'] = "Employee!";
         $_SESSION['status'] = "Selected Successfully!";
         $_SESSION['status_code'] = "success";
      } else {
         $_SESSION['msg'] = "Sorry!";
         $_SESSION['status'] = "Sorry Something Went Wrong! Try again Later";
         $_SESSION['status_code'] = "error";
      }
   }
}
