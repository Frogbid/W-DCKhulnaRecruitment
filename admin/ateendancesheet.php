<?php
require('config/dbconfig.php');
$dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
$currentdatetime = $dt->format('d/m/Y h:i:s A');
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" />
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
                        $query = "SELECT employee_name,roll_no,emp_img FROM `employee_info_table`";
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
                                            <img style="border:1px solid black;width:100px;height:100px;" class="img-fluid" src="<?php echo $row["emp_img"]; ?>">
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
                <button id="printPageButton" onclick="window.print()" class="btn btn-rounded btn-block btn-dark"><i class="fa fa-print" aria-hidden="true"></i></button>
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