<?php
include 'config.php';
$conn = getDB();

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$searchArray = array();



## Search 
$searchQuery = " ";
if($searchValue != ''){
   $searchQuery = " AND (groupid LIKE :groupid or 
        groupname LIKE :groupname OR 
        datein LIKE :datein ) ";
   $searchArray = array( 
        'groupid'=>"%$searchValue%", 
        'groupname'=>"%$searchValue%",
        'datein'=>"%$searchValue%",
   );
}


## Total number of records without filtering
$stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM customer_group WHERE idpackage IN (0001,0002,0003,0004,0006,0007,0008,0009,0010)
AND datein BETWEEN :start_date AND :end_date  ");
$stmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
$stmt->bindParam(':end_date', $end_date, PDO::PARAM_STR);
$stmt->execute();
$records = $stmt->fetch();
$totalRecords = $records['allcount'];

## Total number of records with filtering
$stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM customer_group WHERE idpackage IN (0001,0002,0003,0004,0006,0007,0008,0009,0010) 
AND 1 ".$searchQuery);
$stmt->execute($searchArray);

$records = $stmt->fetch();
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$stmt = $conn->prepare("SELECT * FROM customer_group
WHERE idpackage IN (0001,0002,0003,0004,0006,0007,0008,0009,0010) AND datein BETWEEN :start_date AND :end_date   AND 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

// Bind values
foreach($searchArray as $key=>$search){
   $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
}
$stmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
$stmt->bindParam(':end_date', $end_date, PDO::PARAM_STR);
$stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
$stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
$stmt->execute();
$empRecords = $stmt->fetchAll();

$data = array();
$resultArrayActivity = array();
foreach($empRecords as $row){

    //join data inner
    $resultArrayActivity = null;
    $customerid = $row['groupid'];
    $selectActivity = $conn->prepare('SELECT DISTINCT cre.count_other, ac.idactivity , ac.nameactivity FROM create_qrcodeuser as cre
    INNER JOIN activity_type as ac ON cre.idactivity = ac.idactivity
    WHERE groupid=:customerid');
    $selectActivity->bindParam("customerid",$customerid,PDO::PARAM_STR);
    $selectActivity->execute();
    $ac = $selectActivity->fetchAll();
    foreach ($ac as $show) {
        $activity = array();
        $activity[] = $show['nameactivity'] . ' (' . $show['count_other'] . ')';
        $resultArrayActivity[] = $activity;
    }

    //return data to Tables
   $data[] = array(
      "groupid"=>$row['groupid'],
      "groupname"=>$row['groupname'],
      "groupamount"=>$row['groupamount'],
      "amount_activity"=>$row['group_amount_activity'],
      "acitivty"=> $resultArrayActivity,
      "datein"=>$row['datein'],
      "dateout"=>$row['dateout'],
      "money_customer"=> number_format($row['money_customer'], 2) ,
      "permission_manager"=>$row['permission_manager'],
      "note"=>$row['note']
   );
}

## Response
$response = array(
   "draw" => intval($draw),
   "iTotalRecords" => $totalRecords,
   "iTotalDisplayRecords" => $totalRecordwithFilter,
   "aaData" => $data
);

echo json_encode($response);

