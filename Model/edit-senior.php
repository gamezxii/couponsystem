<?php
$connection = new PDO( 'mysql:host=localhost;dbname=cashcard', "korn", "lasergamE1234" );
$connection->exec("set names utf8");
require_once('DbOperation.php');
$user = new userClass();
$query = '';
$output = array();
$idpackage = 0005;
$noseniorsoft = 1;
$query .= "SELECT * FROM customer_group WHERE noseniorsoft = '0' AND idpackage = '0011' ";
if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY idpackage DESC ';
}
if($_POST["length"] != -1)
{
 $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
 
 $sub_array = array();
 $sub_array[] = $row['userid'];
 $sub_array[] = $row['groupid'];
 $sub_array[] = $row["noseniorsoft"];
 $sub_array[] = $row["datein"];
 $sub_array[] = '<button type="button" name="update" id="'.$row["groupid"].'" class="btn btn-danger  update">แก้ไข</button>';
 $data[] = $sub_array;
}
$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  $filtered_rows,
 "recordsFiltered" => $user->getNumberRang(),
 "data"    => $data
);
echo json_encode($output);
?>