<!DOCTYPE html>
<html lang="en" data-kit-theme="default">

<head>
    <!---cdn css files area start-->
    <?php $page = '';
    require_once('includes/cssfiles.php');
    /* if (isset($_POST['submit'])) {
        $query = "SELECT * FROM `employee_info_table` ";
        $data = mysqli_query($con, $query);
        $total = mysqli_num_rows($data);

        $employee_contactno = "";
        $employee_name = "";
        $employee_id = "";
        if ($total != 0) {
            while ($result = mysqli_fetch_assoc($data)) {
                $employee_contactno = $result['employee_contactno'];

                $update_query = "SELECT `employee_contactno` FROM `employee_info_table` WHERE employee_contactno = '$employee_contactno'";
                $update_result = mysqli_query($con, $update_query);
                $num = mysqli_num_rows($update_result);
                if ($num > 1) {
                    //echo $employee_contactno;
                }
            }
            $_SESSION['msg'] = "Thanks";
            $_SESSION['status'] = "Query executed Successfully!";
            $_SESSION['status_code'] = "success";
            echo "Query executed Successfully!";
        } else {
            $_SESSION['msg'] = "Sorry";
            $_SESSION['status'] = "Query execution failed!";
            $_SESSION['status_code'] = "error";
            echo "Query execution Failed!";
        }
    } */
    ?>
    <!---cdn css files area end-->
</head>

<body class="air__menu--gray air__layout--contentMaxWidth">
    <!---preloader area start-->
    <?php require_once('includes/preloader.php'); ?>
    <!---preloader area end-->
    <div class="air__layout air__layout--hasSider">
        <!--left sidebar area start-->
        <?php require_once('includes/leftsidebar.php'); ?>
        <!---left sidebar area ends-->

        <!---mobile menu area start-->
        <div class="air__menuLeft__backdrop air__menuLeft__mobileActionToggle"></div>
        <!---mobile menu area end-->

        <!---dark theme activation area start-->
        <?php require_once('includes/darkthemeactivation.php'); ?>
        <!---dark theme activation area end-->

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
                                <a href="#" class="air__subbar__breadcrumbLink air__subbar__breadcrumbLink--current">Checking Duplicate Values</a>
                            </li>
                        </ul>
                        <div class="air__subbar__divider mr-4 d-none d-xl-block"></div>

                    </div>
                    <!---page titile area end-->
                </div>
            </div>
            <!---main page content write here-->
            <div class="air__layout__content">
                <div class="air__utils__content">
                    <div class="kit__utils__heading">
                        <h5>
                            <span class="mr-3">Checking Duplicate Values</span>
                        </h5>
                    </div>
                    <div class="card">
                        <div class="card-header bg-dark">
                            <h4 class="mb-0 text-white">Checking Duplicate Values</small></h4>
                        </div>
                        <div class="card-body">
                            <?php

                            if (isset($_POST['submit'])) {
                                $query = "SELECT employee_contactno,employee_designation FROM `employee_info_table` WHERE employee_designation='Office Support Staff' ";
                                $data = mysqli_query($con, $query);
                                $total = mysqli_num_rows($data);

                                $employee_contactno = "";
                                if ($total != 0) {
                                    while ($result = mysqli_fetch_assoc($data)) {
                                        $employee_contactno = $result['employee_contactno'];

                                        $select_employee = "SELECT `employee_contactno`,`employee_designation` FROM `employee_info_table` WHERE employee_contactno = '$employee_contactno' AND employee_designation='Office Support Staff' AND employee_contactno != 'N/A'";
                                        $result = mysqli_query($con, $select_employee);

                                        if (mysqli_num_rows($result) > 1) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo $row['employee_contactno'] . '&nbsp;&nbsp;';
                                            }
                                        }
                                    }
                                    $_SESSION['msg'] = "Thanks";
                                    $_SESSION['status'] = "Query executed Successfully!";
                                    $_SESSION['status_code'] = "success";
                                    echo "Query executed Successfully!";
                                } else {
                                    $_SESSION['msg'] = "Sorry";
                                    $_SESSION['status'] = "Query execution failed!";
                                    $_SESSION['status_code'] = "error";
                                    echo "Query execution Failed!";
                                }
                            }

                            ?>
                            <form action="" method="post">
                                <button name="submit" type="submit" class="btn btn-success btn-block">Checking Duplicate Values</button>
                            </form>
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

    <?php
    if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
    ?>
        <script>
            toastr.<?php echo $_SESSION['status_code']; ?>("<?php echo $_SESSION['status']; ?>", "<?php echo $_SESSION['msg']; ?>", {
                progressBar: !0
            });
        </script>
    <?php
        unset($_SESSION['status']);
    }
    ?>
    <!---additional scripts area end-->
</body>

</html>