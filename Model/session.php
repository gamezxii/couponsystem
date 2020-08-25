<?php
if(!empty($_SESSION['userid']))
{
$session_uid=$_SESSION['userid'];
include('DbOperation.php');
$userClass = new userClass();
}

if(empty($session_uid))
{
$url=BASE_URL.'/login.php';
header("Location: $url");
}


?>