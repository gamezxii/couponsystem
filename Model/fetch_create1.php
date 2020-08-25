<?php
include('DbOperation.php');
    $type = $_POST['type'];
    $user = new userClass();
    switch ($type) {
        case 1212:
            
            $bj = $user->activityDetails();
        break;
            
        case 1515:
            $bj = $user->activityDetailsFarmalone();
        break;
        
        default:
            # code...
        break;
    }
    
    echo json_encode($bj);

   

?>

