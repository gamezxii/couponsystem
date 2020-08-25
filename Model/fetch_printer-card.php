<?php
$customerid = $_POST['customerid'];
include('DbOperation.php');
$user = new userClass();

$result = $user->fetch_customerQr($customerid);
echo json_encode($result);
 
?>

