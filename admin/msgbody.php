<!DOCTYPE html>
<html lang="en" data-kit-theme="default">

<head>
    <!---cdn css files area start-->
    <?php $page = '';
    require_once('includes/cssfiles.php');
    if (isset($_POST['submit'])) {
        $query = "SELECT * FROM `employee_info_table`";
        $data = mysqli_query($con, $query);
        $total = mysqli_num_rows($data);

        $employee_designation = "";
        if ($total != 0) {
            while ($result = mysqli_fetch_assoc($data)) {
                $employee_designation = $result['employee_designation'];
                if ($employee_designation == "Office Support Staff" || $employee_designation == "Bearer" || $employee_designation == "Security Guard") {
                    $message = "আপনার $employee_designation পদের চাকুরীর পরীক্ষার প্রবেশপত্র পেতে https://dcokhulnarecruitment.com/ এ লগ ইন করে তথ্যগুলি প্রদান করুন।আপনার আইডিঃ $roll_no,পাসওয়ার্ডঃ $password.পরীক্ষার তারিখঃ ১৯/০২/২১ -ডি.সি. অফিস,খুলনা।";
                } else {
                    echo "Dear Applicant,your application for the post of:Cleaner is accepted. Please log in to: https://www.dcokhulnarecruitment.com and download admit card by providing your image and signature.Your applicant id:10001,password:12345678.Exam Date:19/02/21</br>";
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
    <!---cdn css files area end-->
</head>

<body class="air__menu--gray air__layout--contentMaxWidth">
    <!---preloader area start-->
    <?php require_once('includes/preloader.php'); ?>00
    <!---main page content write here-->
    <div class="air__layout__content">
        <div class="air__utils__content">
            <div class="kit__utils__heading">
                <h5>
                    <span class="mr-3">Preparing Message Body</span>
                </h5>
            </div>
            <div class="card">
                <div class="card-header bg-dark">
                    <h4 class="mb-0 text-white">Preparing Message Body</small></h4>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <button name="submit" type="submit" class="btn btn-success btn-block">Preparing Message Body</button>
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