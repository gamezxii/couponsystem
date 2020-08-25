<?php
require 'config.php';
$conn = getDB();

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value
$searchArray = array();
$department = $_POST['department'];

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

## Fetch records
if($department == 0007)
{
    ## Total number of records without filtering
    $stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM customer_group WHERE idpackage IN (".$department." , 0001,0002,0003,0004,0007,0008,0009,0010) AND  status_print = 0");
    $stmt->execute();
    $records = $stmt->fetch();
    $totalRecords = $records['allcount'];
    ## Total number of records with filtering
    $stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM customer_group WHERE idpackage IN (".$department."  , 0001,0002,0003,0004,0007,0008,0009,0010) AND  status_print = 0
    AND 1 ".$searchQuery);
    $stmt->execute($searchArray);
    $records = $stmt->fetch();
    $totalRecordwithFilter = $records['allcount'];
    $stmt = $conn->prepare("SELECT cus.groupid, cus.groupname, cus.groupamount, cus.datein, cus.dateout, cus.status_print, pack.name FROM customer_group as cus
    INNER JOIN package as pack ON cus.idpackage = pack.idpackage
    WHERE status_print = 0 AND cus.idpackage IN (".$department." , 0001,0002,0003,0004,0007,0008,0009,0010)  AND 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");    
}else{
    $stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM customer_group WHERE idpackage IN (".$department.",0014) AND  status_print = 0 ");
    $stmt->execute();
    $records = $stmt->fetch();
    $totalRecords = $records['allcount'];
    ## Total number of records with filtering
    $stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM customer_group WHERE idpackage IN (".$department.",0014) AND  status_print = 0
    AND 1 ".$searchQuery);
    $stmt->execute($searchArray);
    $records = $stmt->fetch();
    $totalRecordwithFilter = $records['allcount'];
    $stmt = $conn->prepare("SELECT cus.groupid, cus.groupname, cus.groupamount, cus.datein, cus.dateout, cus.status_print, pack.name FROM customer_group as cus
    INNER JOIN package as pack ON cus.idpackage = pack.idpackage
    WHERE status_print = 0 AND cus.idpackage IN (".$department.",0014)  AND 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");
}


// Bind values
foreach($searchArray as $key=>$search){
   $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
}
//$stmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
//$stmt->bindParam(':end_date', $end_date, PDO::PARAM_STR);
$stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
$stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
$stmt->execute();
$empRecords = $stmt->fetchAll();

$data = array();
$resultArrayActivity = array();
$status = null;
foreach($empRecords as $row){
    //return data to Tables
    $status = null;
    if($row['status_print'] == "0")
    {
        $status = '&#x2718;';
    }
    else
    {
        $status = '&#10003' ;
    }
   $data[] = array(
      "groupid"=>$row['groupid'],
      "groupname"=>$row['groupname'],
      "groupamount"=>$row['groupamount'],
      "namepackage"=>$row['name'],
      "datein"=> date("d-m-Y" , strtotime($row['datein'])),
      "dateout"=>date("d-m-Y" , strtotime($row['dateout'])),
      "statusprint"=>$status,
      "id"=> '<button type="button" name="view" id="'.$row["groupid"].'" class="btn btn-warning btn-xs view">พิมพ์</button>'
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

