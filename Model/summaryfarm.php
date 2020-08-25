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
$id_usefarm = $_POST['id_usefarm'];
$searchArray = array();
$item = null;
if($id_usefarm == 'WORKSHOP')
{
    $item = '6124,6125,6126,6127,6128,6131,6140,6144,6154,6155,6161,6162,6163,6164,6182';
}elseif($id_usefarm == 'FARMSHEEP')
{
    $item = '6133,6134,6135,6151,6152,6153,6159,6160,6167,6169,6170,6174';
}elseif ($id_usefarm == 'FARMTOUR') {
    $item = '6132,6136,3141,6172,6173,6177,6179,6180';
}else if($id_usefarm == 'FARMFOOD'){
    $item = '6129,6130,6143,6156,6157,6158,6168,6171,6175,6176';
}



## Search 
$searchQuery = " ";
if($searchValue != ''){
   $searchQuery = " AND (
      date BETWEEN :start_date AND :end_date OR
        nameactivity LIKE :groupid or 
        idactivity LIKE :groupname OR 
        date LIKE :datein ) ";
   $searchArray = array( 
        'date'=>"%$searchValue%", 
        'date'=>"%$searchValue%",
        'date'=>"%$searchValue%",
   );
}


## Total number of records without filtering
$stmt = $conn->prepare("SELECT COUNT(DISTINCT  idactivity) AS allcount FROM history WHERE date BETWEEN :start_date AND :end_date  ");
$stmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
$stmt->bindParam(':end_date', $end_date, PDO::PARAM_STR);
$stmt->execute();
$records = $stmt->fetch();
$totalRecords = $records['allcount'];

## Total number of records with filtering
$stmt = $conn->prepare("SELECT COUNT(DISTINCT idactivity) AS allcount FROM history WHERE  1 ".$searchQuery);
$stmt->execute($searchArray);

$records = $stmt->fetch();
$totalRecordwithFilter = $records['allcount'];

## Fetch records
/*
count(if(his.idactivity_play = 6137,1, 0)) as total_x,
count(case when his.idactivity_play = 6137 then 1 else 0 end) as countKindOne,
COUNT(IF(his.idactivity_play = 6124, 1, null)) as total_z, */
$stmt = $conn->prepare("SELECT
his.groupid_number, 
his.idactivity as activityuse , act.nameactivity as nameuse  ,
his.idactivity_play as player, play.nameactivity as playername
FROM history as his
INNER JOIN activity_type as act ON his.idactivity = act.idactivity
INNER JOIN activity_type as play ON his.idactivity_play = play.idactivity
WHERE his.idactivity_play IN ($item) 
AND  his.date BETWEEN :start_date AND :end_date ".$searchQuery."ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");
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
$datax = array();
foreach($empRecords as $row){

   $data[] = array(
      "groupid_number"=>$row['groupid_number'],
      "user_useidac"=>$row['activityuse'],
      "user_usename"=>$row['nameuse'],
      "idactivity_play"=>$row['player'],
      "nameactivity_play"=> $row['playername']
   );

    //return data to Tables
   
}

## Response
$response = array(
   "draw" => intval($draw),
   "iTotalRecords" => $totalRecords,
   "iTotalDisplayRecords" => $totalRecordwithFilter,
   "aaData" => $data
);

echo json_encode($response);

