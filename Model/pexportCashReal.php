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
$stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM create_qrcodeuser as cre
INNER JOIN activity_type as act ON cre.idactivity = act.idactivity WHERE  datein BETWEEN :start_date AND :end_date  GROUP BY cre.idactivity");
$stmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
$stmt->bindParam(':end_date', $end_date, PDO::PARAM_STR);
$stmt->execute();
$records = $stmt->fetch();
$totalRecords = $records['allcount'];

## Total number of records with filtering
$stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM create_qrcodeuser as cre
INNER JOIN activity_type as act ON cre.idactivity = act.idactivity WHERE  1 ".$searchQuery . "GROUP BY cre.idactivity");
$stmt->execute($searchArray);

$records = $stmt->fetch();
$totalRecordwithFilter = $records['allcount'];

## Fetch records

$stmt = $conn->prepare("SELECT cre.datein, SUM(cre.other) as played, SUM(cre.count_other) as balance, act.idactivity as idac, act.nameactivity as name
FROM create_qrcodeuser as cre
INNER JOIN activity_type as act ON cre.idactivity = act.idactivity
WHERE datein BETWEEN :start_date AND :end_date    ".$searchQuery."GROUP BY cre.idactivity ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

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
$numbr = 0;
$resultArrayActivity = array();
foreach($empRecords as $row){
    //return data to Tables
   $played = $row['balance'] - $row['played'];
   $numbr = $numbr + 1;
   $data[] = array(
      "datein"=>$numbr,
      "played"=>$row['played'],
      "balance"=>$row['balance'],
      "idac"=>$row['idac'],
      "name"=>$row['name'],
      "allplayed"=>$played
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

