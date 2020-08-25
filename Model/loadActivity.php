<?php
//fetch.php
$output = array();

    try {
        require 'config.php';
        $connect = getDB();
        $start_date = $_POST['start'];
        $end_date = $_POST['end'];
    
    $stmt = $connect->prepare("SELECT  nameactivity  FROM activity_type order by idactivity ASC ");
         
            $stmt->execute();
            while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
            {    
                $temps = array();
                $temps = $data;
                array_push($output , $temps);
            }
            

    } catch (PDOException $e) {
        //throw $th;
    }

echo json_encode($output);

?>
