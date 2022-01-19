<?php
include('config/dbconfig.php');
session_start();
if (!isset($_SESSION['employee_id'])) {
    header("location:index.php");
}
//add user data to database

$error_msg = "";
$employee_id = $_SESSION['employee_id'];
if (isset($_POST['submit'])) {
    $emp_image = uniqid() . $_FILES["emp_img"]["name"];
    $emp_img_tmp_file = $_FILES["emp_img"]["tmp_name"];
    $target_dir = "applicantimage/";
    $emp_img_url = $target_dir . $emp_image;
    $target_file = $target_dir . basename($emp_image);
    $check_emp_image = move_uploaded_file($emp_img_tmp_file, $target_file);

    $id_card_img = uniqid() . $_FILES["id_card_img"]["name"];
    $id_card_img_tmp_file = $_FILES["id_card_img"]["tmp_name"];
    $target_dir = "applicantsignature/";
    $id_card_img_url = $target_dir . $id_card_img;
    $target_file = $target_dir . basename($id_card_img);
    $check_id_card_img = move_uploaded_file($id_card_img_tmp_file, $target_file);

    $certificate_img = uniqid() . $_FILES["certificate_img"]["name"];
    $certificate_img_tmp_file = $_FILES["certificate_img"]["tmp_name"];
    $target_dir = "applicantcertificate/";
    $certificate_img_url = $target_dir . $certificate_img;
    $target_file = $target_dir . basename($certificate_img);
    $check_certificate_img = move_uploaded_file($certificate_img_tmp_file, $target_file);

    $query = "SELECT emp_img,id_card_img,certificate,employee_designation FROM employee_info_table where employee_id = '$employee_id'";
    $data = mysqli_query($con, $query);
    $total = mysqli_num_rows($data);

    $existing_emp_img = "";
    $existing_id_card_img = "";
    $existing_certificate = "";
    $existing_employee_designation = "";
    if ($total != 0) {
        while ($result = mysqli_fetch_assoc($data)) {
            $existing_emp_img = $result['emp_img'];
            $existing_id_card_img = $result['id_card_img'];
            $existing_certificate = $result['certificate'];
            $existing_employee_designation = $result['employee_designation'];
        }
    } else {
        "No Records Found!!!";
    }

    if (($existing_employee_designation == 'Office Support Staff' || $existing_employee_designation == 'Bearer' || $existing_employee_designation == 'Security Guard')) {
        if ($check_emp_image && $check_id_card_img && $check_certificate_img) {
            $query = "UPDATE `employee_info_table` SET `emp_img`='$emp_img_url',`id_card_img`='$id_card_img_url',`certificate`='$certificate_img_url' WHERE employee_id = '$employee_id' ";
            $result = mysqli_query($con, $query);
            if ($result == TRUE) {
                $_SESSION['msg'] = "Your Admit!";
                $_SESSION['status'] = "Card is Ready!";
                $_SESSION['status_code'] = "success";
                header("location:viewadmitcard.php");
            } else {
                $_SESSION['msg'] = "Sorry!";
                $_SESSION['status'] = "Sorry Something Went Wrong! Try again Later";
                $_SESSION['status_code'] = "error";
            }
        } else {
            $error_msg = '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>দুঃ‌খিত !</strong>আপনার আ‌বেদনকৃত প‌দের জন্য অবশ্যই মাধ্য‌মিক বা সমমা‌নের পরীক্ষার সা‌র্টি‌ফি‌কেটের স্কান করা ছ‌বি প্রদান কর‌তে হ‌বে।
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            ';
        }
    } else {
        if ($certificate_img_tmp_file == '') {
            if ($check_emp_image && $check_id_card_img) {
                $query = "UPDATE `employee_info_table` SET `emp_img`='$emp_img_url',`id_card_img`='$id_card_img_url' WHERE  employee_id = '$employee_id'";
                $result = mysqli_query($con, $query);
                if ($result == TRUE) {
                    $_SESSION['msg'] = "Your Admit!";
                    $_SESSION['status'] = "Card is Ready!";
                    $_SESSION['status_code'] = "success";
                    header("location:viewadmitcard.php");
                } else {
                    $_SESSION['msg'] = "Sorry!";
                    $_SESSION['status'] = "Sorry Something Went Wrong! Try again Later";
                    $_SESSION['status_code'] = "error";
                }
            }
        } else {
            if ($check_emp_image && $check_id_card_img && $check_certificate_img) {
                $query = "UPDATE `employee_info_table` SET `emp_img`='$emp_img_url',`id_card_img`='$id_card_img_url',`certificate`='$certificate_img_url' WHERE employee_id = '$employee_id'";
                $result = mysqli_query($con, $query);
                if ($result == TRUE) {
                    $_SESSION['msg'] = "Your Admit!";
                    $_SESSION['status'] = "Card is Ready!";
                    $_SESSION['status_code'] = "success";
                    header("location:viewadmitcard.php?contactno=$employee_contactno&roll_no=$roll_no&employee_designation=$employee_designation");
                } else {
                    $_SESSION['msg'] = "Sorry!";
                    $_SESSION['status'] = "Sorry Something Went Wrong! Try again Later";
                    $_SESSION['status_code'] = "error";
                }
            }
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
            <h1 class="display-5 mt-4">খুলনা জেলা প্রশাসকের কার্যালয়<?php echo $employee_id ?></h1>
            <h4 class="lead font-weight-bold">নিয়োগ বিজ্ঞপ্তি ২০২১</h4>
            <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>
    <div class="card container p-3">
        <h5 class="card-header"><strong>প্রবেশ পত্র পেতে নিচের তথ্যগুলি পূরন করে আবেদন করুন</strong></h5>
        <h6 class="card-header"><strong class="text-danger">আবেদন পত্রের ছবি ও স্বাক্ষর এবং এখানে প্রদত্ত ছবি ও স্বাক্ষর একই হতে হবে।</strong></h6>
        <div class="card-body">
            <div class="text-center">
                <?php echo $error_msg; ?>
            </div>
            <br>
            <form method="POST" id="validate_form" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="contactnumber font-weight-bold">প্রার্থীর ছবি<strong class="text-danger">(ছবির সাইজ (৩০০X৩০০) পিক্সেল এবং ৫০ কিলোবাইটের ভিতর হতে হবে*)</strong></label>
                    <input type="file" name="emp_img" class="form-control" accept="image/*" id="picture" required>
                    <span class="text-danger font-weight-bold" id="wrong_image"></span>
                </div>

                <div class="form-group">
                    <label for="contactnumber font-weight-bold">প্রার্থীর স্বাক্ষর<strong class="text-danger">(স্বাক্ষরের সাইজ (৩০০X৮০) পিক্সেল এবং ২৫ কিলোবাইটের ভিতর হতে হবে*)</strong></label>
                    <input type="file" name="id_card_img" class="form-control" accept="image/*" id="signature" required>
                    <span class="text-danger font-weight-bold" id="wrong_signature"></span>
                </div>

                <div class="form-group">
                    <label for="contactnumber font-weight-bold">এস এস সি বা সমমানের সার্টিফিকেটের স্ক্যান কপি (অফিস সহকারী, নিরাপত্তা কর্মী এবং বেয়ারার পদের জন্য বাধ্যতামূলক)<strong class="text-danger">(সার্টিফিকেটের ছবির সাইজ ৫০ কিলোবাইটের ভিতর হতে হবে*)</strong></label>
                    <input type="file" name="certificate_img" class="form-control" accept="image/*" id="sscertificate">
                    <span class="text-danger font-weight-bold" id="wrong_certificate"></span>
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
    <script>
        $(document).ready(function() {
            $('#picture').bind('change', function() {
                var imageSize = (this.files[0].size);
                if (imageSize > 50 * 1024) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'ছবির সাইজ ভুল হয়েছে। পুনরায় নিশ্চিত করুন।',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    $("#wrong_image").html('ছবির সাইজ ভুল হয়েছে। পুনরায় নিশ্চিত করুন।');
                    $("#submit").prop("disabled", true);
                } else {
                    $("#wrong_image").html('');
                    $("#submit").prop("disabled", false);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#signature').bind('change', function() {
                var signatureSize = (this.files[0].size);
                if (signatureSize > 25 * 1024) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'স্বাক্ষরের সাইজ ভুল হয়েছে। পুনরায় নিশ্চিত করুন।',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    $("#wrong_signature").html('স্বাক্ষরের সাইজ ভুল হয়েছে। পুনরায় নিশ্চিত করুন।');
                    $("#submit").prop("disabled", true);
                } else {
                    $("#wrong_signature").html('');
                    $("#submit").prop("disabled", false);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#sscertificate').bind('change', function() {
                var certificateSize = (this.files[0].size);
                if (certificateSize > 50 * 1024) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'সার্টিফিকেটের ছবির সাইজ ভুল হয়েছে। পুনরায় নিশ্চিত করুন।',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    $("#wrong_certificate").html('সার্টিফিকেটের ছবির সাইজ ভুল হয়েছে। পুনরায় নিশ্চিত করুন।');
                    $("#submit").prop("disabled", true);
                } else {
                    $("#wrong_certificate").html('');
                    $("#submit").prop("disabled", false);
                }
            });
        });
    </script>
</body>

</html>