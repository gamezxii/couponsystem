<?php
//fetch.php
try {
    require 'config.php';
    $connect = getDB();
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

$stmt = $connect->prepare("SELECT t1.groupid , count(DISTINCT t1.groupid) as rowCountG , t1.groupname , t1.groupamount , t1.group_amount_activity , t1.dateout , SUM(t2.other) as total_play
          , t2.idactivity , SUM(t2.count_other) as total_all , t3.nameactivity  FROM customer_group as t1
        INNER JOIN create_qrcodeuser as t2 ON t1.groupid = t2.groupid
        INNER JOIN activity_type as t3 ON t2.idactivity = t3.idactivity
        WHERE t1.datein BETWEEN :start_date AND :end_date
        group by t1.groupid
        ");
        $stmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
        $stmt->bindParam(':end_date', $end_date, PDO::PARAM_STR);
        $stmt->execute();
        $number_filter_row  = $stmt->rowCount();
        $resultArray = array();
        $resul = array();
        $total_group = null;
        $total_customer =0;
        $total_type_card = 0;
        $total_totalAll = 0;
        $total_amountwaitplay = 0;
        $total_playpass = 0;
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $resul = null;
            $userid = $data["groupid"];
            $query = $connect->prepare("SELECT DISTINCT s1.count_other, s2.idactivity , s2.nameactivity FROM create_qrcodeuser as s1 
            INNER JOIN activity_type as s2 ON s1.idactivity = s2.idactivity 
            where s1.groupid =:userid
            ");
            $query->bindParam(':userid', $userid,PDO::PARAM_STR) ;
            $query->execute();
            while( $dataActivity = $query->fetch(PDO::FETCH_ASSOC))
            {
                $countActivity = null;
                $countActivity = $dataActivity['count_other'];
                $temps1 = array();
                $temps1[] = $dataActivity["nameactivity"] . ' ( '. $countActivity  .' )  '   .'<br>';
                $resul[] = $temps1;
            }      
            $temps = array();
            $dis = $data["total_all"] - $data["total_play"];
            $temps[] = $data["groupid"];
            $temps[] = $data["groupname"];
            $temps[] = $data["groupamount"];
            $temps[] = $resul;
            $temps[] = $data["total_all"];
            $temps[] = $data["total_play"];
            $temps[] = $dis;
            $total_group = $total_group + $data["rowCountG"];
            $total_customer = $total_customer + $data["groupamount"];
            $total_totalAll = $total_totalAll + $data["total_all"];
            $total_amountwaitplay = $total_amountwaitplay + $data["total_play"];
            $total_playpass = $total_playpass + $dis;
            $resultArray[] = $temps;
        }

function get_all_data($connect)
{
 $query = "SELECT groupid FROM customer_group";
 $statement = $connect->prepare($query);
 $statement->execute();
 return $statement->rowCount();
}
$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $resultArray,
 "total_group"    => number_format($total_group, 2),
 "total_customer"    => number_format($total_customer, 2),
 "total_type_card"    => number_format($total_type_card, 2),
 "total_totalAll"    => number_format($total_totalAll, 2),
 "total_amountwaitplay"    => number_format($total_amountwaitplay, 2),
 "total_playpass"    => number_format($total_playpass, 2)
);
} catch (PDOException $e) {
    //throw $th;
}


echo json_encode($output);

?>
