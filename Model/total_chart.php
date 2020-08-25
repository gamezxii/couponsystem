<?php
//fetch.php
$output = array();
if(isset($_POST['type'])){
    try {
        require 'config.php';
        $connect = getDB();
        $start_date = $_POST['start'];
        $end_date = $_POST['end'];
        $idactivity = 6123;
        $idactivity_play = 6123;
    $stmt = $connect->prepare("SELECT 
       SUM(idactivity_play = 6123) as play6123
    FROM history  WHERE  date BETWEEN :start_date AND :end_date AND idactivity=:idactivity and idactivity_play=:idactivity_play");

            $stmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
            $stmt->bindParam(':end_date', $end_date, PDO::PARAM_STR);
            $stmt->bindParam(':idactivity', $idactivity, PDO::PARAM_INT);
            $stmt->bindParam(':idactivity_play', $idactivity_play, PDO::PARAM_INT);
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
}
echo json_encode($output);

?>
