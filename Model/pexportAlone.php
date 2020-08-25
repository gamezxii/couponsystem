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
   $searchQuery = " AND (nameactivity LIKE :groupid or 
        idactivity LIKE :groupname OR 
        date LIKE :datein ) ";
   $searchArray = array( 
        'date'=>"%$searchValue%", 
        'date'=>"%$searchValue%",
        'date'=>"%$searchValue%",
   );
}


## Total number of records without filtering
$stmt = $conn->prepare("SELECT  COUNT(DISTINCT his.idactivity) AS allcount FROM history as his
INNER JOIN activity_type as act ON his.idactivity = act.idactivity WHERE  date BETWEEN :start_date AND :end_date");
$stmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
$stmt->bindParam(':end_date', $end_date, PDO::PARAM_STR);
$stmt->execute();
$records = $stmt->fetch();
$totalRecords = $records['allcount'];

## Total number of records with filtering
$stmt = $conn->prepare("SELECT  COUNT(DISTINCT his.idactivity), act.nameactivity AS allcount FROM history as his
INNER JOIN activity_type as act ON his.idactivity = act.idactivity WHERE  1 ".$searchQuery . "");
$stmt->execute($searchArray);

$records = $stmt->fetch();
$totalRecordwithFilter = $records['allcount'];

## Fetch records
/*SELECT * COUNT(history.idactivity) FROM history
INNER JOIN activity_type ON history.idactivity = activity_type.idactivity ORDER BY history.idactivity
*/
$stmt = $conn->prepare("SELECT  count(his.idactivity) as total_id , his.idactivity , act.nameactivity
FROM history as his
INNER JOIN activity_type as act ON his.idactivity = act.idactivity
WHERE date BETWEEN :start_date AND :end_date ".$searchQuery."GROUP BY his.idactivity ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");
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
   $played = 0;
   $numbr = $numbr + 1;
   $data[] = array(
      "idactivity"=>$row['idactivity'],
      "total_id"=>$row['total_id'],
      "nameactivity"=>$row['nameactivity']
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

