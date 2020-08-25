<?php
include('DbOperation.php');

    $user = new userClass();
    $bj = $user->activityDetails();
    echo json_encode($bj);

   

?>

