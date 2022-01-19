<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
   header("location:../Welcome");
}
include('../config/dbconfig.php');
$unique_id = $_SESSION['unique_id'];

if (isset($_POST['submit'])) {
   $department_name = $_POST['department_name'];
   $department_insert_query = "INSERT INTO `department_table` (`unique_id`, `department_name`) VALUES ('$unique_id', '$department_name')";
   $result = mysqli_query($con, $department_insert_query);
   if ($result == true) {
      $query2 = "SELECT department_id FROM `department_table`";
      $data = mysqli_query($con, $query2);
      $total = mysqli_num_rows($data);

      $department_id = "";
      if ($total != 0) {
         while ($result = mysqli_fetch_assoc($data)) {
            $department_id = $result['department_id'];
         }
      } else {
         "No Records Found!!!";
      }

      $activityquery = "INSERT INTO `activity_table`(`unique_id`, `department_id`,`activity_description`) VALUES ('$unique_id','$department_id','Department has been added')";
      $result2 = mysqli_query($con, $activityquery);
      if ($result2) {
         $_SESSION['msg'] = "Department!";
         $_SESSION['status'] = "Added Successfully!";
         $_SESSION['status_code'] = "success";
         header('location:../ViewDepartment');
      } else {
         $_SESSION['msg'] = "Oops!";
         $_SESSION['status'] = "Sorry Something Went Wrong! Try again Later";
         $_SESSION['status_code'] = "error";
         header('location:../ViewDepartment');
      }
   } else {
      $_SESSION['msg'] = "Sorry!";
      $_SESSION['status'] = "Sorry Something Went Wrong! Try again Later";
      $_SESSION['status_code'] = "error";
      header('location:../ViewDepartment');
   }
}
