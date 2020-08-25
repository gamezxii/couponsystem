<?php
include('config.php');
$session_uid='';
$_SESSION['userid']='';
if(empty($session_uid) && empty($_SESSION['userid']))
{
$url='../index.php';
header("Location: $url");
//echo "<script>window.location='$url'</script>";
}
?>