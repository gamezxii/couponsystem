<?php
 require 'config.php';
 $connect = getDB();
$query = '';
$output = array();
$query .= "SELECT * FROM history ";
if(isset($_POST["search"]["value"]))
{
 $query .= 'WHERE groupid_number LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR idactivity LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY id DESC ';
}
if($_POST["length"] != -1)
{
 $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$stmt = $connect->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll();
$data = array();
$filtered_rows = $stmt->rowCount();
foreach($result as $row)
{
 $sub_array = array();
 $sub_array[] = $row["id"];
 $sub_array[] = $row["groupid_number"];
 $sub_array[] = $row["date"];
 $sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
 $data[] = $sub_array;
}
$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  $filtered_rows,
 "recordsFiltered" => get_total_all_records(),
 "data"    => $data
);
echo json_encode($output);
?>