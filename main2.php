<?php
//add user data to database
include('config/dbconfig.php');
$error_msg = '';
if (isset($_POST['submit'])) {
    $employee_contactno = mysqli_real_escape_string($con, $_POST["employee_contactno"]);

    $query = "SELECT employee_contactno,emp_img,id_card_img,certificate FROM `employee_info_table` where employee_contactno= '$employee_contactno' ";
    $data = mysqli_query($con, $query);
    $total = mysqli_num_rows($data);

    $existing_employee_contactno = "";
    $existing_emp_img = "";
    $existing_id_card_img = "";
    $existing_certificate = "";
    if ($total != 0) {
        while ($result = mysqli_fetch_assoc($data)) {
            $existing_employee_contactno = $result['employee_contactno'];
            $existing_emp_img = $result['emp_img'];
            $existing_id_card_img = $result['id_card_img'];
            $existing_certificate = $result['certificate'];
        }
    } else {
        "No Records Found!!!";
    }

    if ($employee_contactno != $existing_employee_contactno) {
        $error_msg = '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>দুঃ‌খিত!</strong> আপনার মোবাইল নম্বর‌টি খু‌জে পাওয়া যায় নাই। দয়া ক‌রে স‌ঠিক নম্বর‌টি দিন।
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        ';
    } else {
        if (($existing_emp_img == "") && ($existing_id_card_img == "")) {
            header("location:main.php?contactno=$employee_contactno");
        } else {
            header("Location:viewadmitcard.php?contactno=$employee_contactno");
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>DCO-Recruitment, Khulna</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" />
    <link href="css/parsley.css" rel="stylesheet" />
</head>

<body>
    <div class="jumbotron jumbotron-fluid text-center">
        <div class="container">
            <img src="images/admitcardlogo.png" alt="No Image" class="img-fluid" width="150px" height="150px">
            <h1 class="display-5 mt-4">খুলনা জেলা প্রশাসকের কার্যালয়</h1>
            <h4 class="lead font-weight-bold">নিয়োগ বিজ্ঞপ্তি ২০২১</h4>
        </div>
    </div>
    <div class="card container p-3">
        <h5 class="card-header"><strong>প্রবেশ পত্র পেতে নিচের তথ্যগুলি পূরন করে আবেদন করুন</strong></h5>
        <div class="card-body">
            <div class="text-center">
                <?php echo $error_msg; ?>
            </div>
            <form method="POST" id="validate_form">

                <div class="form-group mb-3">
                    <label for="contactnumber font-weight-bold">প্রার্থীর মোবাইল নম্বর<strong class="text-danger">(*)</strong></label>
                    <input type="text" name="employee_contactno" class="form-control" data-parsley-pattern="^\+?(88)?0?1[3456789][0-9]{8}\b" placeholder="মোবাইল নম্বর" aria-label="মোবাইল নম্বর" aria-describedby="basic-addon1" required>
                </div>
                <button type="submit" name="submit" id="submit" class="btn btn-primary btn-block">আবেদন করুন</button>
            </form>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="http://parsleyjs.org/dist/parsley.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {
            $('#validate_form').parsley();
        });
    </script>
</body>

</html>