<?php
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
