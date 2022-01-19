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
<!DOCTYPE html>
<html lang="en" data-kit-theme="default">

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
                                <a href="#" class="air__subbar__breadcrumbLink air__subbar__breadcrumbLink--current">List OF Invoices</a>
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
                            <h4 class="mb-0 text-white">Invoices</small></h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="listofgovtadmitcard.php">
                                <div class="form-group col-xl-6 col-md-6 col-lg-6 col-12 m-auto d-block">
                                    <label for="name">Search by Invoice No</label>
                                    <input type="text" name="invoice_id" class="form-control" id="invoice_id" placeholder="Search by Invoice No." autocomplete="off">
                                </div>
                                <br>
                                <center><input type="submit" value="Search by invoice no." name="submit" class="btn btn-dark btn-rounded"></center>
                            </form>
                            <br>
                            <div class="table-responsive">
                                <table class="table text-center table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Invoice no.</th>
                                            <th>Invoice date.</th>
                                            <th>Customer name</th>
                                            <th>Total Amount</th>
                                            <th>Paid Amount</th>
                                            <th>Due Amount</th>
                                            <th>Print</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_POST["submit"])) {
                                            $invoice_id = $_POST["invoice_id"];

                                            if ($invoice_id != "") {
                                                $query = "SELECT * FROM invoice_table,customer_table WHERE invoice_table.customer_id = customer_table.customer_id AND invoice_table.invoice_id = '$invoice_id' ORDER BY invoice_table.invoice_id DESC";

                                                $data = mysqli_query($con, $query);

                                                if (mysqli_num_rows($data) > 0) {
                                                    while ($row = mysqli_fetch_assoc($data)) {
                                                        if (($row["payment_status"] == "Due")) {
                                        ?>
                                                            <tr class="text-dark">
                                                                <td><?php echo $row["invoice_id"]; ?></td>
                                                                <td><?php echo date_format(date_create_from_format('Y-m-d', $row["invoice_date"]), 'd-m-Y'); ?></td>
                                                                <td><?php echo $row["customer_name"]; ?></td>
                                                                <td>
                                                                    <?php
                                                                    $amount = $row["total_recv_amount"];
                                                                    echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", round($amount));
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    $amount = $row["paid_amount"];
                                                                    echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", round($amount));
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    $amount = $row["due_amount"];
                                                                    echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", round($amount));
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <a href="govtadmitcard.php?invoice=<?php echo $row["invoice_id"]; ?>" target="_blank" class="btn btn-primary btn-rounded"><i class="fa fa-print" aria-hidden="true"></i></a>
                                                                </td>
                                                            </tr>

                                                        <?php
                                                        } else if (($row["payment_status"] == "Paid")) {
                                                        ?>

                                                            <tr class="text-dark">
                                                                <td><?php echo $row["invoice_id"]; ?></td>
                                                                <td><?php echo date_format(date_create_from_format('Y-m-d', $row["invoice_date"]), 'd-m-Y'); ?></td>
                                                                <td><?php echo $row["customer_name"]; ?></td>
                                                                <td>
                                                                    <?php
                                                                    $amount = $row["total_recv_amount"];
                                                                    echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", round($amount));
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    $amount = $row["paid_amount"];
                                                                    echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", round($amount));
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    $amount = $row["due_amount"];
                                                                    echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", round($amount));
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <a href="govtadmitcard.php?invoice=<?php echo $row["invoice_id"]; ?>" target="_blank" class="btn btn-primary btn-rounded"><i class="fa fa-print" aria-hidden="true"></i></a>
                                                                </td>
                                                            </tr>
                                                    <?php
                                                        }
                                                    }
                                                } else {
                                                    ?>
                                                    <td>Records not found</td>
                                                    <?php
                                                }
                                            }
                                        } else {
                                            $query = "SELECT * FROM invoice_table,customer_table WHERE invoice_table.customer_id = customer_table.customer_id ORDER BY invoice_table.invoice_id DESC";

                                            $data = mysqli_query($con, $query);

                                            if (mysqli_num_rows($data) > 0) {
                                                while ($row = mysqli_fetch_assoc($data)) {
                                                    if (($row["payment_status"] == "Due")) {
                                                    ?>

                                                        <tr class="text-dark">
                                                            <td><?php echo $row["invoice_id"]; ?></td>
                                                            <td><?php echo date_format(date_create_from_format('Y-m-d', $row["invoice_date"]), 'd-m-Y'); ?></td>
                                                            <td><?php echo $row["customer_name"]; ?></td>
                                                            <td>
                                                                <?php
                                                                $amount = $row["total_recv_amount"];
                                                                echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", round($amount));
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $amount = $row["paid_amount"];
                                                                echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", round($amount));
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $amount = $row["due_amount"];
                                                                echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", round($amount));
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <a href="govtadmitcard.php?invoice=<?php echo $row["invoice_id"]; ?>" target="_blank" class="btn btn-primary btn-rounded"><i class="fa fa-print" aria-hidden="true"></i></a>
                                                            </td>
                                                        </tr>

                                                    <?php
                                                    } else if (($row["payment_status"] == "Paid")) {
                                                    ?>

                                                        <tr class="text-dark">
                                                            <td><?php echo $row["invoice_id"]; ?></td>
                                                            <td><?php echo date_format(date_create_from_format('Y-m-d', $row["invoice_date"]), 'd-m-Y'); ?></td>
                                                            <td><?php echo $row["customer_name"]; ?></td>
                                                            <td>
                                                                <?php
                                                                $amount = $row["total_recv_amount"];
                                                                echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", round($amount));
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $amount = $row["paid_amount"];
                                                                echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", round($amount));
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $amount = $row["due_amount"];
                                                                echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", round($amount));
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <a href="govtadmitcard.php?invoice=<?php echo $row["invoice_id"]; ?>" target="_blank" class="btn btn-primary btn-rounded"><i class="fa fa-print" aria-hidden="true"></i></a>
                                                            </td>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                            } else {
                                                ?>
                                                <td>Records not found</td>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
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