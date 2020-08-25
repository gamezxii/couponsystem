<?php
include('DbOperation.php');
 $user = new userClass();
 $obj = $user->settingUsers();
 echo json_encode($obj);

?>