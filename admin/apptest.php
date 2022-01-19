<?php
include('config/dbconfig.php');
$email  = $_GET['email'];

$sql = "select * from MemoOnlineData where email like '%$email%'";

$res = mysqli_query($con, $sql);

$result = array();

while ($row = mysqli_fetch_array($res)) {
    array_push($result, array(
        'title' => $row[3],
        'date' => $row[4],
        'data' => $row[5],
        'id' => $row[0]

    ));
}

echo json_encode(array("result" => $result));

mysqli_close($con);
