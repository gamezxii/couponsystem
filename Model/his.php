<?php
//fetch.php
try {
    require 'config.php';
    $connect = getDB();
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $userid = $_POST['userid'];

$stmt = $connect->prepare("SELECT * FROM foc WHERE  userid =:userid AND date BETWEEN :start_date AND :end_date");

        $stmt->bindParam(':userid', $userid, PDO::PARAM_STR);
        $stmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
        $stmt->bindParam(':end_date', $end_date, PDO::PARAM_STR);
        $stmt->execute();
        $number_filter_row  = $stmt->rowCount();
        $resultArray = array();
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {     
            $temps = array();
            $temps[] = $data["groupid"];
            $temps[] = $data["groupname"];
            $temps[] = $data["price"];
            $temps[] = $data["amount"];
            $temps[] = $data["amount_activity"];
            $temps[] = $data["nameactivity"];
            $temps[] = $data["foc"];
            $temps[] = $data["cause"];
            $temps[] = $data["date"];
            $temps[] = $data["total"];

            $resultArray[] = $temps;
        }

function get_all_data($connect)
{
 $query = "SELECT groupid FROM foc";
 $statement = $connect->prepare($query);
 $statement->execute();
 return $statement->rowCount();
}
$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $resultArray
);
} catch (PDOException $e) {
    //throw $th;
}


echo json_encode($output);

?>
