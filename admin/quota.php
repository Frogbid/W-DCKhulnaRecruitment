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
    $sl_no = 0;
    //fetch data from employee info table for showing view of admit card
    $sql = "SELECT * FROM `employee_info_table` WHERE (quota != 'N/A' AND quota != 'na' AND quota != 'no' AND quota != '')";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $sl_no += 1;
        $output .= '<tr>
                        <td>' . $sl_no . '</td>
                        <td>' . $row["employee_name"] . '</td>  
                        <td>' . $row["employee_contactno"] . '</td>  
                        <td>' . $row["employee_designation"] . '</td>  
                        <td>' . $row["educational_qualification"] . '</td>  
                        <td>' . $row["quota"] . '</td>
                        <td><img class="img-fluid" src="../' . $row["emp_img"] . '" alt="No Logo Available" style="width:30px;height:30px;border-radius:50%;"></td>  
                    </tr>  
                    ';
    }
    return $output;
}
//fetch data from employee info table
$query = "SELECT * FROM `employee_info_table` WHERE (quota != 'N/A' AND quota != 'na' AND quota != 'no' AND quota != '')";
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
    $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
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

    $content .= '<div style="border: 1px solid #000000;">';
    $content .= '<table>';
    $content .= '<tr>  
                    <td width="10%" align="left"></td>
                    <td width="45%" align="left"></td>
                    <td width="45%" align="right"></td>
                </tr>';
    $content .= '<tr>  
                    <td width="10%" align="left">&nbsp;&nbsp;<img class="img-fluid" src="admitcardlogo.png" alt="No Logo Available" style="width:50px;height:50px;border-radius:50%;"></td>
                    <td width="45%" align="left" style="font-size: 9px;"><p>Government of the People`s Republic of Bangladesh<br><b>Prime Minister`s Office</b></p></td>
                    <td width="45%" align="right" style="font-size: 8px;">Reference : 5051/130-176(Personnel)-15, Date:01/09/2019&nbsp;&nbsp;&nbsp;</td>
                </tr>';
    $content .= '</table>';
    $content .= '</div>';

    $content .= '<table>';
    $content .= '<tr> 
                    <td width="100%" align="center"></td>
                </tr>';
    $content .= '<tr> 
                    <td width="100%" align="center"><h4>Admit Card</h4></td>
                </tr>';
    $content .= '<tr> 
                    <td width="100%" align="center"></td>
                </tr>';
    $content .= '</table>';

    $content .= '<div style="border: 1px solid #000000;">';
    $content .= '<table cellspacing="0" cellpadding="5">';
    $content .= '<tr>  
                    <td width="25%" align="left" style="font-size:10px;">
                        Roll No<br><br>
                        Name<br><br>
                        Father Name<br><br>
                        Mother Name<br><br>
                        Exam Center
                    </td>
                    <td width="40%" align="left" style="font-size:10px;">
                        <b>: ' . $roll_no . '</b><br><br>
                        : ' . strtoupper($employee_name) . '<br><br>
                        : ' . $father_name . '<br><br>
                        : ' . $mother_name . '<br><br>
                        : DC, Office Khulna
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

    $content .= '<table>';
    $content .= '<tr> 
                    <td width="50%" align="left"></td>
                    <td width="50%" align="right"></td>
                </tr>';
    $content .= '<tr> 
                    <td width="50%" align="left" style="font-size: 8px;">Date: ' . $currentdatetime . '</td>
                    <td width="50%" align="right" style="font-size: 8px;">System ID: ' . $system_id . '</td>
                </tr>';
    $content .= '</table>';

    $content .= '<br/><br/>';

    $content .= '<table cellpadding="5">';
    $content .= '<tr style="background-color: #d3cbcb;font-size:10px;">  
                    <th width="100%" align="center"><b>General instructions for applicants</b></th>     
                </tr>';
    $content .= '<tr style="background-color: #f7f4f4;font-size:8px;">  
                    <th width="5%" align="left">01</th> 
                    <th width="95%" align="left">This Admit Card will be applicable for preliminary examination.</th>    
                </tr>';
    $content .= '<tr style="background-color: #f7f4f4;font-size:8px;">  
                    <th width="5%" align="left">02</th> 
                    <th width="95%" align="left">Candidates must bring the Admit Card and show it to the invigilator(s) on duty.</th>    
                </tr>';
    $content .= '<tr style="background-color: #f7f4f4;font-size:8px;">  
                    <th width="5%" align="left">03</th> 
                    <th width="95%" align="left">Photograph contained in this admit card will be verified against the original submitted application form.</th>    
                </tr>';
    $content .= '<tr style="background-color: #f7f4f4;font-size:8px;">  
                    <th width="5%" align="left">04</th> 
                    <th width="95%" align="left">Candidates must sit in the examination hall at least 30 minutes prior to all examination. Candidates will not be allowed to leave the examination hall before
                        the termination of the test.
                    </th>    
                </tr>';
    $content .= '<tr style="background-color: #f7f4f4;font-size:8px;">  
                    <th width="5%" align="left">05</th> 
                    <th width="95%" align="left">Candidates should bring two Black Ballpoint Pens. Use of pencil is not allowed.</th>    
                </tr>';
    $content .= '<tr style="background-color: #f7f4f4;font-size:8px;">  
                    <th width="5%" align="left">06</th> 
                    <th width="95%" align="left">Candidates are NOT ALLOWED to bring mobile phone/calculator/digital watch or similar electronic devices in the exam hall.</th>    
                </tr>';
    $content .= '<tr style="background-color: #f7f4f4;font-size:8px;">  
                    <th width="5%" align="left">07</th> 
                    <th width="95%" align="left">Applicant will be expelled if the general instructions are not followed or if found guitty of misconduct, misbehavior or adopting unfair means. Applicant found
                        guitty of copying, adopting any type of unfair means or misconduct will be barred from applying in any future examination conducted by the government and
                        will not be allowed to apply for any other posts to be advertised by the government. Moreover, he/she may be handed over to the law enforcing agency for
                        taking legal action against him/her.
                    </th>    
                </tr>';
    $content .= '</table>';

    $content .= '<br/><br/>';

    $content .= '<table>';
    $content .= '<tr> 
                    <td width="33%"></td>
                    <td width="33%"></td>  
                    <td width="34%" align="right"><img src="' . $id_card_img . '" alt="No Logo Available" style="width:300px;height:80px;"><br>Authority<br></td>
                </tr>';
    $content .= '</table>';

    $content .= '<div style="border: 1px solid #000000;">';
    $content .= '<table>';
    $content .= '<tr> 
    <td width="100%"></td>
</tr>';
    $content .= '<tr> 
    <td width="50%" style="font-size:10px;" align="left">&nbsp;
        &#169; 2021, Prime Ministers Office, All Rights Reserved.
    </td>
    <td width="50%" style="font-size:10px;" align="right">
        Powered by FrogBid&nbsp;&nbsp;
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
    <title>Quota Applicant List</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        @media print {
            #printPageButton {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="card shadow p-3 mt-2">
        <div class="card-header bg-dark">
            <div class="row">
                <div class="col-md-4 col-sm-12 col-12"></div>
                <div class="col-md-4 col-sm-12 col-12">
                    <h4 class="mb-0 text-white text-center">Attendance Sheet</small></h4>
                </div>
            </div>
        </div>
        <div class="text-center p-3">
            <h6>জেলা প্রশাস‌কের কার্যালয় খুলনা নি‌য়োগ(২০ তম গ্রেড) পরীক্ষা ২০২১</h6>
            <h6>(সাধারণ প্রশাসন)</h6>
            <h6>নেজারত শাখা</h6>
            <h6>প‌দের নাম: <b>অফিস সহায়ক</b></h6>
        </div>
        <div class="row p-3">
            <div class="col-md-6 col-12 text-left">
                <h6>‌কে‌ন্দ্রের নাম : Govt. Coronation Girls High School</h6>
            </div>
            <div class="col-md-6 col-12 text-right">
                <h6>‌কক্ষ নম্বর : 1005</h6>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <tr>
                        <th>ছ‌বি</th>
                        <th>নাম</th>
                        <th>রোল</th>
                        <th>স্বাক্ষর</th>
                    </tr>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM `employee_info_table` where (roll_no between 10001 and 10500)";
                        $data = mysqli_query($con, $query);
                        $serial_no = 1;
                        if ($count = mysqli_num_rows($data) > 0) {
                            $rowcount = mysqli_num_rows($data);
                            while ($row = mysqli_fetch_assoc($data)) {
                        ?>
                                <tr>
                                    <td>
                                        <?php
                                        if ($row["emp_img"] == '') {
                                        ?>
                                            <img style="border:1px solid black;width:100px;height:100px;" class="img-fluid" src="">
                                        <?php
                                        } else {
                                        ?>
                                            <img style="border:1px solid black;width:100px;height:100px;" class="img-fluid" src="../' . $row[" emp_img"] . '">
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $row["employee_name"]; ?></td>
                                    <td><?php echo $row["roll_no"]; ?></td>
                                    <td></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="row p-2">
                <div class="col-md-6 col-12 text-left">
                    মোট পরীক্ষার্থীর সংখ্যা : <?php echo $rowcount; ?><br>
                    উপস্থিত :
                </div>
                <div class="col-md-6 col-12 text-right">
                    <br>প‌রিদর্শ‌কের স্বাক্ষর
                </div>
            </div>
            <div class="m-2">
                <button id="printPageButton" onclick="window.print()" class="btn btn-rounded btn-block btn-dark">Print</button>
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