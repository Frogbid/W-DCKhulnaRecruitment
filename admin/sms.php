<?php 
$json_smsdata = [];

// প্রথমে আপনার সুবিধে মত করে loop এ ডেটাবেজ হতে ডেটা নিন অথবা অ্যাপ্লিকেশনের ইনপুট থেকে ডেটা নিন । ডেটাটি এরপর loop ব্যবহার করে ফরম্যাট করুন: এখানে while loop দেখানো হয়েছে আপনারা foreach loop ব্যবহার করতে পারেন । 

$dblink = mysqli_connect("localhost", "dbusername", "dbpassword", "dbname");
/* If connection fails throw an error */
if (mysqli_connect_errno()) {
    echo "Could  not connect to database: Error: ".mysqli_connect_error();
    exit();
}

//চাইলে LIMIT দিয়ে  ৫০০ এসএমএস একসাথে ডেটাবেজ থেকে যাবে এমন লিমিট করে নিতে পারেন ।
$sqlquery = "SELECT name,number FROM table_name";
if ($result = mysqli_query($dblink, $sqlquery)) {
    /* fetch associative array */
    while ($row = mysqli_fetch_assoc($result)) {
       $name = $row["name"];
       $number = $row["number"];

// আমরা উপরে loop করে ডেটাবেজ থেকে name এবং number কলামের ডেটা নিলাম, এখন dynamic ম্যাসেজ লিখুন rawurlencode() funtion must use করতে হবে
$message = rawurlencode("Hi $name,
your message 
Regards
bdsms.net
");

$json_smsdata[]= ['to'=>$number,'message'=>$message];
	  }
	  
}

$smsdata = json_encode($json_smsdata);

// $smsdata হলো আমাদের কাংখিত format করা ডেটা যা এখন সেন্ড করা হবে । 

			
			//এবার এসএমএস প্রেরন করুন নিচে শুধু টোকেন বদল করবেন
$token = "yourtokenhere_xxxxxxxxxxxxxxxxxxx";
$smsdata = $smsdata;

$url = "http://api.greenweb.com.bd/api2.php";


$data= array(
'smsdata'=>"$smsdata",
'token'=>"$token"
); // Add parameters in key value
$ch = curl_init(); // Initialize cURL
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_ENCODING, '');
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$smsresult = curl_exec($ch);

//Result
echo $smsresult;

//Error Display
echo curl_error($ch);
