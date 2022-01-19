<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("location:Welcome");
}
include('config/dbconfig.php');
if (isset($_POST["employee_id"])) {
    $output = '';

    $query1 = "SELECT * FROM employee_info_table WHERE employee_id = '" . $_POST["employee_id"] . "'";
    $result = mysqli_query($con, $query1);


    while ($row = mysqli_fetch_array($result)) {
        $output .= '
            <h2 class="text-center">Applicant Information</h2>
            <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
            <tr>
                <td><img src=../' . $row["emp_img"] . ' height=150px width=150px style="border-radius:50%;"></td>
                <td><img src=../' . $row["id_card_img"] . ' height=150px width=150px style="border-radius:50%;"></td>
             </tr>
            </table>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">
                    <tr>
                        <td>Roll Number</td>
                        <td>' . $row["roll_no"] . '</td>
                    </tr>
                    <tr>
                        <td>System ID</td>
                        <td>' . $row["system_id"] . '</td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>' . $row["employee_name"] . '</td>
                    </tr>
                    <tr>
                        <td>Father Name</td>
                        <td>' . $row["father_name"] . '</td>
                    </tr>
                    <tr>
                        <td>Mother Name</td>
                        <td>' . $row["mother_name"] . '</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>' . $row["employee_address"] . '</td>
                    </tr>
                    <tr>
                        <td>Contact Number</td>
                        <td>' . $row["employee_contactno"] . '</td>
                    </tr>
                    <tr>
                        <td>Designation</td>
                        <td>' . $row["employee_designation"] . '</td>
                    </tr>
                    
                    <tr>
                        <td>Qualification</td>
                        <td>' . $row["educational_qualification"] . '</td>
                    </tr>
                    <tr>
                        <td>Quota</td>
                        <td>' . $row["quota"] . '</td>
                    </tr>
                </table>
            </div>
            <hr>
            <center><img src=../' . $row["certificate"] . ' height=150px width=150px style="border-radius:50%;"></center>
            <hr>
        ';
    }
    echo $output;
}
