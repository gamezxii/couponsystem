<?php
//fetch.php
$output = array();
if(isset($_POST['type'])){
    try {
        require 'config.php';
        $connect = getDB();
        $start_date = $_POST['start'];
        $end_date = $_POST['end'];
    
    $stmt = $connect->prepare("SELECT 
    SUM(idactivity = 6101) as id6101 ,  SUM(idactivity = 6102) as id6102  , SUM(idactivity = 6103) as id6103 , SUM(idactivity = 6104) as id6104 ,   SUM(idactivity = 6105) as id6105 
    , SUM(idactivity = 6106) as id6106 , SUM(idactivity = 6107) as id6107 , SUM(idactivity = 6108) as id6108 , SUM(idactivity = 6109) as id6109 , SUM(idactivity = 6110) as id6110 ,
    SUM(idactivity = 6111) as id6111 ,  SUM(idactivity = 6112) as id6112  , SUM(idactivity = 6113) as id6113 , SUM(idactivity = 6114) as id6114 ,   SUM(idactivity = 6115) as id6115 
    , SUM(idactivity = 6116) as id6116 , SUM(idactivity = 6117) as id6117 , SUM(idactivity = 6118) as id6118 , SUM(idactivity = 6119) as id6119 , SUM(idactivity = 6120) as id6120,
    SUM(idactivity = 6121) as id6121 ,  SUM(idactivity = 6122) as id6122  , SUM(idactivity = 6123) as id6123 , SUM(idactivity = 6124) as id6124 ,   SUM(idactivity = 6125) as id6125 
    , SUM(idactivity = 6126) as id6126 , SUM(idactivity = 6127) as id6127 , SUM(idactivity = 6128) as id6128 , SUM(idactivity = 6129) as id6129 , SUM(idactivity = 6130) as id6130,
    SUM(idactivity = 6131) as id6131 ,  SUM(idactivity = 6132) as id6132  , SUM(idactivity = 6133) as id6133 , SUM(idactivity = 6134) as id6134 ,   SUM(idactivity = 6135) as id6135 
    , SUM(idactivity = 6136) as id6136 , SUM(idactivity = 6137) as id6137 , SUM(idactivity = 6138) as id6138 , SUM(idactivity = 6139) as id6139 , SUM(idactivity = 6140) as id6140 , 
    SUM(idactivity = 6141) as id6141 , SUM(idactivity = 6142) as id6142 , SUM(idactivity = 6143) as id6143 , SUM(idactivity = 6144) as id6144 , SUM(idactivity = 6145) as id6145 , 
    SUM(idactivity = 6146) as id6146 , SUM(idactivity = 6147) as id6147 , SUM(idactivity = 6148) as id6148 , SUM(idactivity = 6149) as id6149 , SUM(idactivity = 6150) as id6150 ,
    SUM(idactivity = 6151) as id6151 ,  SUM(idactivity = 6152) as id6152 , SUM(idactivity = 6153) as id6153 , SUM(idactivity = 6154) as id6154 
    FROM history  WHERE date BETWEEN :start_date AND :end_date");
            $stmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
            $stmt->bindParam(':end_date', $end_date, PDO::PARAM_STR);
            $stmt->execute();
            while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
            {    
                $temps = array();
                $temps = $data;
                array_push($output , $temps);
            }
            

    } catch (PDOException $e) {
        //throw $th;
    }
}
echo json_encode($output);

?>
