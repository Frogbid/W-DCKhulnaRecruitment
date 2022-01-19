<?php
require('config/dbconfig.php');
require 'conversion.php';
function fetch_data()
{
    $output = '';
    require('config/dbconfig.php');
    $invoice = $_GET['invoice'];
    $serial_no = 1;
    $sql = "SELECT * FROM invoice_table,invoice_item_table,product WHERE invoice_table.invoice_id = invoice_item_table.invoice_id AND product.product_id = invoice_item_table.item_name AND invoice_table.invoice_id = '$invoice'";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $output .= '<tr>  
                        <td>' . $serial_no . '</td> 
                        <td>' . $row["product_name"] . '</td>  
                        <td>' . $row["chalan_no"] . '</td>  
                        <td>' . $row["item_size"] . '</td>  
                        <td>' . $row["item_quantity"] . '</td>  
                        <td>' . $row["unit"] . '</td>
                        <td>' . $row["selling_price"] . '</td>    
                        <td>' . $row["finalTotal"] . '</td>    
                    </tr>  
                    ';
        $serial_no++;
    }
    return $output;
}
$invoice = $_GET['invoice'];
$query = "SELECT * FROM invoice_table,invoice_item_table,product,customer_table WHERE invoice_table.invoice_id = invoice_item_table.invoice_id AND invoice_table.customer_id = customer_table.customer_id AND product.product_id = invoice_item_table.item_name AND invoice_table.invoice_id = '$invoice' ";
$data = mysqli_query($con, $query);
$total = mysqli_num_rows($data);
$invoice_id = "";
$invoice_date = "";
$customer_id = "";
$customer_name = "";
$customer_contact_no = "";
$customer_address = "";
$total_amount = "";
$paid_amount = "";
$due_amount = "";
$item_quantity = "";
$totalQuantity = 0;
if ($total != 0) {
    while ($result = mysqli_fetch_assoc($data)) {
        $invoice_id = $result['invoice_id'];
        $invoice_date = $result['invoice_date'];
        $customer_id = $result['customer_id'];
        $customer_name = $result['customer_name'];
        $customer_contact_no = $result['customer_contact_no'];
        $customer_address = $result['customer_address'];
        $item_quantity = $result['item_quantity'];
        $total_amount = $result["total_amount"];
        $paid_amount = $result['paid_amount'];
        $due_amount = $result["due_amount"];
        $totalQuantity = $totalQuantity + $item_quantity;
        $convertAmount = round($result["total_amount"]);
    }
} else {
    "No Records Found!!!";
}
if (isset($_POST["create_pdf"])) {
    require_once('pdflibrary/tcpdf.php');
    require_once('includes/webinfo.php');
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
                    <td width="10%" align="left">&nbsp;&nbsp;<img class="img-fluid" src="admitcardlogo.png" alt="No Logo Available" style="width:30px;height:30px;border-radius:50%;"></td>
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
                        Mother Name<br>
                    </td>
                    <td width="40%" align="left" style="font-size:10px;">
                        <b>25183962</b><br><br>
                        BIPLOB KUMAR MONDOL<br><br>
                        BIMAL KUMAR MONDOL<br><br>
                        BANANI RANI MONDOL<br>
                    </td>
                    <td width="35%" align="right"><img class="img-fluid" src="' . $logo . '" alt="No Logo Available" style="width:100px;height:100px;"></td>
                </tr>';
    $content .= '<tr>
                    <td align="left" width="100%" style="font-size:10px;">
                        <img class="img-fluid" src="' . $favicon . '" alt="No Logo Available" style="width:200px;height:80px;">
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
                    <td width="50%" align="left" style="font-size: 8px;">Date: 2019-03-12 19:12:56</td>
                    <td width="50%" align="right" style="font-size: 8px;">User ID: VTRDFEYHK | System ID: JSUHSJHSYSJASHAYSS48744</td>
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
                    <td width="34%" align="right"><img src="' . $favicon . '" alt="No Logo Available" style="width:300px;height:80px;"><br>Authority<br></td>
                </tr>';
    $content .= '</table>';

    $content .= '<div style="border: 1px solid #000000;">';
    $content .= '<table>';
    $content .= '<tr>  
                    <td width="100%" style="font-size:10px;">&nbsp;
                        &#169; 2021, Prime Ministers Office, All Rights Reserved.
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;
                        Powered by<img src="logo.jpg" alt="No Logo Available" style="width:40px;height:40px;">
                    </td>
                </tr>';
    $content .= '</table>';
    $content .= '</div>';

    $obj_pdf->writeHTML($content);
    $obj_pdf->Output('' . $invoice_id . '.pdf', 'I');
}
?>
<!DOCTYPE html>
<html>
<!--check session ---->
<?php require_once('includes/session.php'); ?>
<!--check session ---->
<!--website info---->
<?php require_once('includes/webinfo.php'); ?>
<!--website info---->
<!--authenticate user info---->
<?php require_once('includes/authenticuserinfo.php'); ?>
<!--authenticate user info---->
<!--set default timezone---->
<?php require_once('includes/timezone.php'); ?>
<!--set default timezone---->

<head>
    <!---cdn css files area start-->
    <?php $page = '';
    require_once('includes/cdnfiles.php'); ?>
    <!---cdn css files area end-->
</head>

<body class="air__menu--gray air__layout--contentNoMaxWidth">
    <!---preloader area start-->
    <?php require_once('includes/preloader.php'); ?>
    <!---preloader area end-->
    <div class="air__layout air__layout--hasSider">
        <!--left sidebar area start-->
        <?php require_once('includes/sidebar.php'); ?>
        <!---left sidebar area ends-->

        <!---mobile menu area start-->
        <div class="air__menuLeft__backdrop air__menuLeft__mobileActionToggle"></div>
        <!---mobile menu area end-->

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
                                <a href="#" class="air__subbar__breadcrumbLink air__subbar__breadcrumbLink--current">Page Name</a>
                            </li>
                        </ul>
                        <div class="air__subbar__divider mr-4 d-none d-xl-block"></div>
                        <div class="air__subbar__amount d-none ml-auto d-sm-flex">
                            <!-- <p class="air__subbar__amountText">
                                <a href="Dashboard">Dashboard</a>
                            </p> -->
                        </div>
                    </div>
                    <!---page titile area end-->
                </div>
            </div>
            <!---main page content write here-->
            <div class="air__layout__content">
                <div class="air__utils__content">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <h4 class="mb-0 text-white">Print Selling Invoice</small></h4>
                        </div>
                        <div class="row p-3">
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                                <table>
                                    <thead>
                                        <td>
                                            <img class="img-fluid mr-3" src="<?php echo $logo; ?>" alt="No Logo Available" style="width:100px;height:100px;border-radius:50%;">
                                        </td>
                                        <td>
                                            <h5><?php echo $office_name; ?></h5>
                                            <h5><?php echo $office_contact_no; ?></h5>
                                            <h5><?php echo $office_email; ?></h5>
                                            <h5><?php echo $ofiice_address; ?></h5>
                                        </td>
                                    </thead>
                                </table>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 text-right">
                                <div>
                                    <h5>Bill No : <b>&nbsp;<?php echo $invoice_id; ?></b></h5>
                                </div>
                                <div>
                                    <h5>Date : <b>&nbsp;<?php echo date_format(date_create_from_format('Y-m-d', $invoice_date), 'd-m-Y'); ?></b></h5>
                                </div>
                            </div>
                        </div>
                        <center>
                            <div style="border: 1px solid #000000; width: 60px;">
                                <h4 class="text-dark">Bill</h4>
                            </div>
                        </center>
                        <b class="text-dark pt-3 pl-3">Favour Of :</b>
                        <div class="row p-2">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 text-left">
                                <h5>Customer Name:&nbsp;<?php echo $customer_name ?></h5>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                                <h5>Customer Contact Number:
                                    <?php
                                    if ($customer_contact_no == NULL) {
                                        echo "Not Given";
                                    } else {
                                    ?>
                                        <?php echo $customer_contact_no ?>
                                    <?php
                                    }
                                    ?>
                                </h5>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                                <h5>Customer Address:
                                    <?php
                                    if ($customer_address == NULL) {
                                        echo "Not Given";
                                    } else {
                                    ?>
                                        <?php echo $customer_address ?>
                                    <?php
                                    }
                                    ?>
                                </h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="5%">Sl No.</th>
                                        <th width="20%">Item Name</th>
                                        <th width="10%">Chalan No</th>
                                        <th width="10%">Item Size</th>
                                        <th width="10%">Quantity</th>
                                        <th width="10%">Unit</th>
                                        <th width="15%">Item Rate</th>
                                        <th width="20%">Amount (Tk)</th>
                                    </tr>
                                    <?php
                                    echo fetch_data();
                                    ?>
                                </table>
                                <br />
                                <form method="post">
                                    <input type="submit" name="create_pdf" class="btn btn-danger" value="Generate PDF" />
                                </form>
                            </div>
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

    <!---additional scripts area end-->
</body>

</html>