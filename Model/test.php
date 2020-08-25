<?php
include('DbOperation.php');
$user = new userClass();

$result = $user->customerDetails();
echo json_encode($result);

?>

