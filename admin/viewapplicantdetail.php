<?php

require('config/dbconfig.php');
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("location:index.php");
}
$unique_id = $_SESSION['unique_id'];
$dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
$currentdatetime = $dt->format('d/m/Y h:i:s A');
function fetch_data()
{
    $output = '';
    require('config/dbconfig.php');
    //fetch data from employee info table for showing view of admit card
    $roll_no = $_GET['roll_no'];
    $sql = "SELECT * FROM `employee_info_table` WHERE `roll_no` = '$roll_no'";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $output .= '<tr>  
                        <td>' . $row["employee_name"] . '</td>  
                        <td>' . $row["employee_contactno"] . '</td>  
                        <td>' . $row["employee_designation"] . '</td>  
                        <td>' . $row["educational_qualification"] . '</td>  
                        <td>' . $row["quota"] . '</td>
                        <td><img class="img-fluid" src="' . $row["id_card_img"] . '" alt="No Logo Available" style="width:30px;height:30px;border-radius:50%;"></td>    
                        <td><img class="img-fluid" src="' . $row["certificate"] . '" alt="No Logo Available" style="width:30px;height:30px;border-radius:50%;"></td>    
                    </tr>  
                    ';
    }
    return $output;
}
$roll_no = $_GET['roll_no'];
//fetch data from employee info table
$query = "SELECT * FROM `employee_info_table` WHERE `roll_no` = '$roll_no'";
$data = mysqli_query($con, $query);
$total = mysqli_num_rows($data);

$system_id = "";
$employee_name = "";
$father_name = "";
$mother_name = "";
$employee_address = "";
$employee_contactno = "";
$employee_designation = "";
$educational_qualification = "";
$quota = "";
$emp_img = "";
$id_card_img = "";
$certificate = "";
$roll_no = "";
$selected = "";
if ($total != 0) {
    while ($result = mysqli_fetch_assoc($data)) {
        $system_id = $result['system_id'];
        $employee_name = $result['employee_name'];
        $father_name = $result['father_name'];
        $mother_name = $result['mother_name'];
        $employee_address = $result['employee_address'];
        $employee_contactno = $result['employee_contactno'];
        $emp_img = $result['emp_img'];
        $employee_designation = $result["employee_designation"];
        $educational_qualification = $result['educational_qualification'];
        $quota = $result["quota"];
        $id_card_img = $result["id_card_img"];
        $certificate = $result["certificate"];
        $roll_no = $result["roll_no"];
        $selected = $result["selected"];
    }
} else {
    "No Records Found!!!";
}
if (isset($_POST["create_pdf"])) {
    require_once('pdflibrary/tcpdf.php');
    $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', true);
    $obj_pdf->SetCreator(PDF_CREATOR);
    $obj_pdf->SetTitle("Selling Invoice");
    $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
    $obj_pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $obj_pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $obj_pdf->SetDefaultMonospacedFont('helvetica');
    $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
    $obj_pdf->setPrintHeader(false);
    $obj_pdf->setPrintFooter(false);
    $obj_pdf->SetAutoPageBreak(TRUE, 10);
    $obj_pdf->SetFont('helvetica', '', 12);
    $obj_pdf->AddPage();
    $content = '';

    $content .= '<div align="center">';
    $content .= '<b>Government of the People`s Republic of Bangladesh</b>  <br>';
    $content .= '<b>Office of the Deputy Commissioner, Khulna</b>  <br>';
    $content .= '<b>Nezarat Section</b>  <br><br>';
    $content .= '<b>Application Form (Office Copy)</b>';
    $content .= '</div>';

    $content .= '<div style="border: 1px solid #000000;">';
    $content .= '<table cellspacing="0" cellpadding="5">';
    $content .= '<tr>  
                    <td width="25%" align="left" style="font-size:10px;">
                        Roll No<br><br>
                        Name<br><br>
                        Father Name<br><br>
                        Mother Name<br><br>
                        Address<br><br>
                        Education<br><br>
                        Designation<br><br>
                        Quota<br><br>
                        Contact No.<br><br>
                    </td>
                    <td width="40%" align="left" style="font-size:10px;">
                        <b>: ' . $roll_no . '</b><br><br>
                        : ' . strtoupper($employee_name) . '<br><br>
                        : ' . $father_name . '<br><br>
                        : ' . $mother_name . '<br><br>
                        : ' . $employee_address . '<br><br>
                        : ' . $educational_qualification . '<br><br>
                        : ' . $employee_designation . '<br><br>
                        : ' . $quota . '<br><br>
                        : ' . $employee_contactno . '<br><br>
                    </td>
                    <td width="35%" align="right"><img class="img-fluid" src="' . $emp_img . '" alt="No Logo Available" style="width:100px;height:100px;"></td>
                </tr>';
    $content .= '<tr>
                    <td align="left" width="100%" style="font-size:10px;">
                        <img class="img-fluid" src="' . $id_card_img . '" alt="No Logo Available" style="width:200px;height:80px;">
                        <br> 
                        Applicant`s Signature
                    </td> 
                </tr>';
    $content .= '</table>';
    $content .= '</div>';

    $obj_pdf->writeHTML($content);
    $obj_pdf->Output('' . $employee_name . '.pdf', 'I');
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Download Admit Card</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="card shadow p-3 mt-2">
        <div class="card-header bg-dark">
            <div class="row">
                <div class="col-md-4 col-sm-12 col-12"></div>
                <div class="col-md-4 col-sm-12 col-12">
                    <h4 class="mb-0 text-white text-center"><?php echo $employee_name; ?>&nbsp;Admit Card</small></h4>
                </div>
                <div class="col-md-4 col-sm-12 col-12 text-right">
                    <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
                </div>
            </div>
        </div>
        <div class="row p-3">
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                <table>
                    <thead>
                        <td>
                            <img class="img-fluid mr-3" src="<?php echo $emp_img; ?>" alt="No Logo Available" style="width:100px;height:100px;border-radius:50%;">
                        </td>
                        <td>
                            <h5>Name : <?php echo $employee_name; ?></h5>
                            <h5>Father Name: <?php echo $father_name; ?></h5>
                            <h5>Father Name: <?php echo $mother_name; ?></h5>
                            <h5>Address: <?php echo $employee_address; ?></h5>
                        </td>
                    </thead>
                </table>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 text-right">
                <div>
                    <h5>Roll No : <b>&nbsp;<?php echo $roll_no; ?></b></h5>
                </div>
                <div>
                    <h5>System ID : <b>&nbsp;<?php echo $system_id; ?></b></h5>
                </div>
                <div>
                    <h5>Date : <b>&nbsp;<?php echo $dt->format('M, d'); ?></b></h5>
                </div>
            </div>
        </div>
        <center>
            <div style="border: 1px solid #000000; width: 160px;">
                <h4 class="text-dark">Information</h4>
            </div>
        </center>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <tr>
                        <th width="20%">Name</th>
                        <th width="15%">Contact No</th>
                        <th width="10%">Designation</th>
                        <th width="10%">Qualification</th>
                        <th width="10%">Quota</th>
                        <th width="15%">Signature</th>
                        <th width="20%">Certificate</th>
                    </tr>
                    <?php
                    echo fetch_data();
                    ?>
                </table>
                <br />
                <form method="post">
                    <input type="submit" name="create_pdf" class="btn btn-info btn-block" value="Download Admit Card" />
                </form>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>