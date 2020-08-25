<?php
//fetch.php
try {
    require 'config.php';
    $connect = getDB();
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

$stmt = $connect->prepare("SELECT   t1.dateout , SUM(t2.other) as total_play
          , t2.idactivity , SUM(t2.count_other) as total_all , SUM(t2.idactivity = t2.idactivity) as total_cus , t3.nameactivity , count(t3.nameactivity) as rowCount FROM customer_group as t1
        INNER JOIN create_qrcodeuser as t2 ON t1.groupid = t2.groupid
        INNER JOIN activity_type as t3 ON t2.idactivity = t3.idactivity
        WHERE t1.datein BETWEEN :start_date AND :end_date
        group by t2.idactivity order by t2.other DESC
        ");
        $stmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
        $stmt->bindParam(':end_date', $end_date, PDO::PARAM_STR);
        $stmt->execute();
        $number_filter_row  = $stmt->rowCount();
        $resultArray = array();
        $total_played = 0;
        $total_waitplay = 0;
        $total_all = 0;
        $total_amountcus = 0;
        $total_typecard = 0;
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {    
            $temps = array();
            $dis = $data["total_all"] - $data["total_play"];
            $temps[] = $data["nameactivity"];
            $temps[] = $data["total_cus"];
            $temps[] = $data["total_all"];
            $temps[] = $data["total_play"];
            $temps[] = $dis;
            $total_typecard = $total_typecard + $data["rowCount"];
            $total_amountcus = $total_amountcus + $data["total_cus"];
            $total_all = $total_all + $data["total_all"];
            $total_waitplay = $total_waitplay + $data["total_play"];
            $total_played = $total_played + $dis;
            $resultArray[] = $temps;
        }

function get_all_data($connect)
{
 $query = "SELECT COUNT(DISTINCT idactivity) FROM create_qrcodeuser  ";
 $statement = $connect->prepare($query);
 $statement->execute();
 return $statement->rowCount();
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $resultArray,
 "total_typecard"    => number_format($total_typecard, 2) ,
 "total_amountcus" => number_format($total_amountcus, 2),
 "total_all" => number_format($total_all, 2),
 "total_waitplay" => number_format($total_waitplay, 2),
 "total_played" => number_format($total_played, 2) 
);
} catch (PDOException $e) {
    //throw $th;
}


echo json_encode($output);

?>
