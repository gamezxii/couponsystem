<?php
class userClass
{
/* User Login */
public function userLogin($usernameEmail,$password)
{
    require 'config.php';
try{
$db = getDB();
    //$hash_password= hash('sha256', $password); //Password encryption 
    $stmt = $db->prepare("SELECT userid , email , status, department  FROM users WHERE (email=:usernameEmail) AND password=:password"); 
    $stmt->bindParam("usernameEmail", $usernameEmail,PDO::PARAM_STR) ;
    $stmt->bindParam("password", $password,PDO::PARAM_STR) ;
    $stmt->execute();
    $count=$stmt->rowCount();
    $data=$stmt->fetch(PDO::FETCH_OBJ);
    $db = null;
    if($count)
    {
        $_SESSION['userid']=$data->userid; // Storing user session value
        $_SESSION['email']=$data->email; // Storing user session value
        $_SESSION['status']=$data->status; // Storing user session value
        $_SESSION['department'] = $data->department;

      //  $_SESSION['email']=$data->email;
        return true;
    }
    else
    {
        return false;
    } 
    }
    catch(PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
    }

    }

/* User Registration */
public function userRegistration($userid , $fname , $lname ,$email,$password,$status)
{
    require 'config.php';
try{
    $db = getDB();
    $st = $db->prepare("SELECT userid , email FROM users WHERE userid=:userid OR email=:email"); 
    $st->bindParam("userid", $userid,PDO::PARAM_STR);
    $st->bindParam("email", $email,PDO::PARAM_STR);
    $st->execute();
    $count=$st->rowCount();
    if($count<1)
    {
    $stmt = $db->prepare("INSERT INTO users(userid , fname, lname, email, password, status) VALUES (:userid, :fname , :lname, :email,:password,:status)");
    $stmt->bindParam("userid", $userid,PDO::PARAM_STR) ;
    $stmt->bindParam("fname", $fname,PDO::PARAM_STR) ;
    $stmt->bindParam("lname", $lname,PDO::PARAM_STR) ;
    $hash_password= hash('sha256', $password); //Password encryption
    $stmt->bindParam("password", $password,PDO::PARAM_STR) ;
    $stmt->bindParam("email", $email,PDO::PARAM_STR) ;
    $stmt->bindParam("status", $status,PDO::PARAM_STR) ;
    $stmt->execute();
    $db = null;
    return true;
    }
    else
    {
    $db = null;
    $response = 'รหัสพนักงาน หรือ อีเมล์ซ้ำ';
    return $response;
    }

} 
catch(PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

public function checkGroupcard($cusid){
    require 'config.php';
    try {
        $db = getDB();
        $stmt = $db->prepare("SELECT  groupid  FROM customer_group
        where groupid =:cusid "); 
        $stmt->bindParam("cusid", $cusid,PDO::PARAM_STR) ;
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $count=$stmt->rowCount();
        $db = null;
        if($count){
            return true;
        }else{
            return false;
        }
    } catch (PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function createGroupcard($cusid , $codecus , $amount , $package ,$change ,$datein ,$dateout , $getPermission, $getMoney, $note, $userid)
{
    require 'config.php';
    try {
        $db = getDB();
        $query = $db->prepare("SELECT groupid FROM create_qrcodeuser where groupid = :cusid"); 
        $query->bindParam("cusid",$cusid ,PDO::PARAM_STR) ;
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $count=$query->rowCount();
        if(!$count)
        {
            $status_print = '0';
            $stmt = $db->prepare("INSERT INTO customer_group(groupid,groupname,groupamount,idpackage,group_amount_activity ,datein ,dateout , status_print, permission_manager, money_customer, note, userid ) VALUES (:cusid,:codecus,:amount,:package ,:change , :datein, :dateout ,:status_print,:getPermission, :getMoney, :note, :userid)");
            $stmt->bindParam("cusid", $cusid,PDO::PARAM_STR) ;
            $stmt->bindParam("codecus", $codecus,PDO::PARAM_STR) ;
            $stmt->bindParam("amount", $amount,PDO::PARAM_STR) ;
            $stmt->bindParam("package", $package,PDO::PARAM_STR) ;
            $stmt->bindParam("change", $change,PDO::PARAM_STR) ;
            $stmt->bindParam("datein", $datein,PDO::PARAM_STR) ;
            $stmt->bindParam("dateout", $dateout,PDO::PARAM_STR) ;
            $stmt->bindParam("status_print", $status_print,PDO::PARAM_STR) ;
            $stmt->bindParam("getPermission", $getPermission, PDO::PARAM_STR);
            $stmt->bindParam("getMoney", $getMoney, PDO::PARAM_STR);
            $stmt->bindParam("note", $note, PDO::PARAM_STR);
            $stmt->bindParam("userid", $userid,PDO::PARAM_STR) ;
            $stmt->execute();
            $db = null;
            return true;
        }else{
            return $row['groupid'];
        }
        
    } catch (PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }   
}

public function createRealMoney($seniorsoft ,$cusid , $codecus , $amount , $package ,$change ,$datein ,$dateout , $discount , $userid)
{
    require 'config.php';
    try {
        $db = getDB();
        $query = $db->prepare("SELECT groupid FROM create_qrcodeuser where groupid = :cusid"); 
        $query->bindParam("cusid",$cusid ,PDO::PARAM_STR) ;
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $count=$query->rowCount();
        if(!$count)
        {
            $status_print = '1';
            $stmt = $db->prepare("INSERT INTO customer_group(groupid,groupname,groupamount,idpackage,group_amount_activity ,datein ,dateout , discount  , status_print , noseniorsoft, userid ) VALUES (:cusid,:codecus,:amount,:package ,:change , :datein, :dateout , :discount ,:status_print , :seniorsoft , :userid)");
            $stmt->bindParam("cusid", $cusid,PDO::PARAM_STR) ;
            $stmt->bindParam("codecus", $codecus,PDO::PARAM_STR) ;
            $stmt->bindParam("amount", $amount,PDO::PARAM_STR) ;
            $stmt->bindParam("package", $package,PDO::PARAM_STR) ;
            $stmt->bindParam("change", $change,PDO::PARAM_STR) ;
            $stmt->bindParam("datein", $datein,PDO::PARAM_STR) ;
            $stmt->bindParam("dateout", $dateout,PDO::PARAM_STR) ;
            $stmt->bindParam("discount" , $discount,PDO::PARAM_INT);
            $stmt->bindParam("status_print", $status_print,PDO::PARAM_STR) ;
            $stmt->bindParam("seniorsoft" , $seniorsoft,PDO::PARAM_STR);
            $stmt->bindParam("userid", $userid,PDO::PARAM_STR) ;
            $stmt->execute();
            $db = null;
            return true;
        }else{
            return $row['groupid'];
        }
        
    } catch (PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }   
}

/* User Details */
public function customerDetails()
{
    require 'config.php';
    try{
        $db = getDB();
        $status_print = '0';
        $stmt = $db->prepare("SELECT  s1.groupid , s1.groupname , s1.groupamount , s1.idpackage , s1.datein , s1.dateout , s1.status_print , s2.name FROM customer_group  as s1
        INNER JOIN package as s2 ON s1.idpackage = s2.idpackage where s1.status_print =:status_print "); 
        $stmt->bindParam("status_print", $status_print,PDO::PARAM_INT) ;
        $stmt->execute();

        $resultArray = array();
        
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {

           $temps['groupid'] = $data['groupid'];
           $temps['groupname'] = $data['groupname'];
           $temps['groupamount'] = $data['groupamount'];
           $temps['name'] = $data['name'];
           $temps['datein'] = date("d-m-Y" , strtotime($data['datein'])) ;
           $temps['dateout'] =  date("d-m-Y" , strtotime($data['dateout'])) ;
           $temps['status_print'] = $data['status_print'];

           array_push($resultArray  ,$temps);
        }
        $db = null;
        return $resultArray;

    }
    catch(PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function userTrackStutus($userid)
{
    require 'config.php';
    try{
        $db = getDB();
        $status_print = '1';
        $stmt = $db->prepare("SELECT  groupid , groupname , groupamount  , datein , dateout , status_print  FROM customer_group  where userid =:userid AND status_print =:status_print ORDER BY datein DESC limit 10 "); 
        $stmt->bindParam("userid", $userid,PDO::PARAM_INT) ;
        $stmt->bindParam("status_print", $status_print,PDO::PARAM_INT) ;
        $stmt->execute();
        //User data
        $resultArray = array();
        $countRecord = 10;
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
           
           $temps['id'] = $countRecord;
           $temps['groupid'] = $data['groupid'];
           $temps['groupname'] = $data['groupname'];
           $temps['groupamount'] = $data['groupamount'];
           $temps['datein'] = $data['datein'];
           $temps['dateout'] = $data['dateout'];
           $temps['status_print'] = $data['status_print'];
           $countRecord = $countRecord - 1;
           array_push($resultArray  ,$temps);
        }
        $db = null;
        return $resultArray;

      //  echo json_encode($resultArray);
   //    return $data;
        
    }
    catch(PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function userCancanleCard($userid)
{
    require 'config.php';
    try{
        $db = getDB();
        $status_print = '0';
        $stmt = $db->prepare("SELECT  groupid , groupname , groupamount  , datein , dateout , status_print  FROM customer_group  where userid =:userid AND status_print =:status_print ORDER BY datein DESC limit 10 "); 
        $stmt->bindParam("userid", $userid,PDO::PARAM_INT) ;
        $stmt->bindParam("status_print", $status_print,PDO::PARAM_INT) ;
        $stmt->execute();
        //User data
        $resultArray = array();
        $countRecord = 10;
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
           
           $temps['id'] = $countRecord;
           $temps['groupid'] = $data['groupid'];
           $temps['groupname'] = $data['groupname'];
           $temps['groupamount'] = $data['groupamount'];
           $temps['datein'] = $data['datein'];
           $temps['dateout'] = $data['dateout'];
           $temps['status_print'] = $data['status_print'];
           $countRecord = $countRecord - 1;
           array_push($resultArray  ,$temps);
        }
        $db = null;
        return $resultArray;

      //  echo json_encode($resultArray);
   //    return $data;
        
    }
    catch(PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function userDetails($uid)
{
try{
$db = getDB();
$stmt = $db->prepare("SELECT * FROM users WHERE userid=:uid");
$stmt->bindParam("uid", $uid,PDO::PARAM_INT);
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_OBJ); //User data
$db = null;
return $data;
}
catch(PDOException $e) {
    $db = null;
echo '{"error":{"text":'. $e->getMessage() .'}}';
}
}

public function settingUsers()
{
    require 'config.php';
try{
$db = getDB();
$stmt = $db->prepare("SELECT email,fname , lname ,userid,status FROM users order by userid ASC");
$stmt->execute();
$resultArray = array();
$countRecord = 0;
 //User data
while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $temps = array();
    $countRecord = $countRecord + 1;
    $temps['id'] = $countRecord;
    $temps['userid'] = $data['userid'];
    $temps['fname'] = $data['fname'];
    $temps['lname'] = $data['lname'];
    $temps['email'] = $data['email'];
    $temps['status'] = $data['status'];

    array_push($resultArray  ,$temps);
}
$db = null;
return $resultArray;
}
catch(PDOException $e) {
    $db = null;
echo '{"error":{"text":'. $e->getMessage() .'}}';
}
}

public function listHitoryCustomer($customerid)
{
    require 'config.php';
    try{
    $db = getDB();
    $stmt = $db->prepare("SELECT t1.id , t1.groupid_number , t1.idactivity ,t1.idactivity_play , t1.date , t1.time , t2.nameactivity as usecard ,t3.nameactivity FROM history as t1
    INNER JOIN activity_type as t2 ON t1.idactivity = t2.idactivity
    LEFT JOIN activity_type as t3 ON t1.idactivity_play = t3.idactivity
    WHERE groupid_number=:customerid order by t1.date DESC , t1.time DESC");
    $stmt->bindParam(':customerid' , $customerid,PDO::PARAM_STR);
    $stmt->execute();
    $resultArray = array();

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $temps = array();
            $temps = $data;
        
            array_push($resultArray  ,$temps);
        }
        $db = null;
        return $resultArray;

    }
    catch(PDOException $e) {
        $db = null;
    echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}



public function focUser($customerid)
{
    require 'config.php';
    try{
    $db = getDB();
    $stmt = $db->prepare("SELECT
    t1.groupid , t1.groupname , t1.groupamount , t1.idpackage , t1.userid , t2.fname , t1.group_amount_activity  , t1.userid
    FROM customer_group as t1
    INNER JOIN users as t2 ON t1.userid = t2.userid
    INNER JOIN create_qrcodeuser as t4 ON t1.groupid = t4.groupid 
    WHERE t1.groupid LIKE CONCAT('%', :customerid, '%') group by groupid order by t1.groupid ASC");
    $stmt->bindParam(':customerid' , $customerid,PDO::PARAM_STR);
    $stmt->execute();
    $resultArray = array();
    $resultname = array();
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $resulname = null;
            $userid = $data["groupid"];
            $query = $db->prepare("SELECT DISTINCT s1.count_other ,s2.nameactivity FROM create_qrcodeuser as s1 
            INNER JOIN activity_type as s2 ON s1.idactivity = s2.idactivity
            WHERE s1.groupid =:userid");
            $query->bindParam(':userid', $userid,PDO::PARAM_STR) ;
            $query->execute();
            while( $dataActivity = $query->fetch(PDO::FETCH_ASSOC))
            {   
                $temps1 = array();
                $temps1 = $dataActivity["nameactivity"] .' (' . $dataActivity["count_other"] .')<br>';
                $resulname[] = $temps1;
            }  

            $temps = array();
            $temps['groupid'] = $data['groupid'];
            $temps['groupname'] = $data['groupname'];
            $temps['groupamount'] = $data['groupamount'];
            $temps['idpackage'] = $data['idpackage'];
            $temps['group_amount_activity'] = $data['group_amount_activity'];
            $temps['fname'] = $data['fname'];
            $temps['userid'] = $data['userid'];
            $temps['nameactivity'] = $resulname;

            array_push($resultArray  ,$temps);
        }
        $db = null;
        return $resultArray;

    }
    catch(PDOException $e) {
        $db = null;
    echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function activityDetails()
{
    require 'config.php';
    try{
        $db = getDB();
        $stmt = $db->prepare("SELECT idactivity , nameactivity FROM activity_type ORDER BY CONVERT(nameactivity USING tis620) ASC");
        $stmt->execute();
        //User data
        $resultArray = array();
        
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
           $temps = $data;
           array_push($resultArray  ,$temps);
        }
        $db = null;
        return $resultArray;

      //  echo json_encode($resultArray);
   //    return $data;
        
    }
    catch(PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function activityDetailsFarmalone()
{
    require 'config.php';
    try{
        $db = getDB();
        $stmt = $db->prepare("SELECT idactivity , nameactivity FROM activity_type WHERE idactivity IN(6187,6134,6133,6151,6152,6153,6192) ORDER BY CONVERT(nameactivity USING tis620) ASC");
        $stmt->execute();
        //User data
        $resultArray = array();
        
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
           $temps = $data;
           array_push($resultArray  ,$temps);
        }
        $db = null;
        return $resultArray;

      //  echo json_encode($resultArray);
   //    return $data;
        
    }
    catch(PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function activityNewYear()
{
    require 'config.php';
    try{
        $db = getDB();
        $stmt = $db->prepare("SELECT idactivity , nameactivity FROM activity_type WHERE category_type = 'NEWY' ");
        $stmt->execute();
        //User data
        $resultArray = array();
        
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
           $temps = $data;
           array_push($resultArray  ,$temps);
        }
        $db = null;
        return $resultArray;

      //  echo json_encode($resultArray);
   //    return $data;
        
    }
    catch(PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function packageDetails()
{
    require 'config.php';
    try{
        $db = getDB();
        $stmt = $db->prepare("SELECT idpackage , name , price FROM package"); 
        $stmt->execute();
        //User data
        $resultArray = array();
        
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
           $temps = $data;
           array_push($resultArray  ,$temps);
        }
        $db = null;
        return $resultArray;

      //  echo json_encode($resultArray);
   //    return $data;
        
    }
    catch(PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function packageDetailsOnline()
{
    require 'config.php';
    try{
        $db = getDB();
        $stmt = $db->prepare("SELECT idpackage , name , price FROM package where idpackage in (0001,0002,0003,0004,0007,0008,0009,0010)"); 
        $stmt->execute();
        //User data
        $resultArray = array();
        
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
           $temps = $data;
           array_push($resultArray  ,$temps);
        }
        $db = null;
        return $resultArray;

      //  echo json_encode($resultArray);
   //    return $data;
        
    }
    catch(PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function packageDetailsGroup()
{
    require 'config.php';
    try{
        $db = getDB();
        $stmt = $db->prepare("SELECT idpackage , name , price FROM package where idpackage in (0006,0014)"); 
        $stmt->execute();
        //User data
        $resultArray = array();
        
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
           $temps = $data;
           array_push($resultArray  ,$temps);
        }
        $db = null;
        return $resultArray;

      //  echo json_encode($resultArray);
   //    return $data;
        
    }
    catch(PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function realMoneyPackage()
{
    require 'config.php';
    try{
        $db = getDB();
        $stmt = $db->prepare("SELECT idpackage , name , price FROM package WHERE idpackage = 0005"); 
        $stmt->execute();
        //User data
        $resultArray = array();
        
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
           $temps = $data;
           array_push($resultArray  ,$temps);
        }
        $db = null;
        return $resultArray;

      //  echo json_encode($resultArray);
   //    return $data;
        
    }
    catch(PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function SeleactLaserGame()
{
    require 'config.php';
    try{
        $db = getDB();
        $stmt = $db->prepare("SELECT idpackage , name , price FROM package WHERE idpackage = 0011"); 
        $stmt->execute();
        //User data
        $resultArray = array();
        
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
           $temps = $data;
           array_push($resultArray  ,$temps);
        }
        $db = null;
        return $resultArray;

      //  echo json_encode($resultArray);
   //    return $data;
        
    }
    catch(PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function SeleactStorefarm()
{
    require 'config.php';
    try{
        $db = getDB();
        $stmt = $db->prepare("SELECT idpackage , name , price FROM package WHERE idpackage = 0012"); 
        $stmt->execute();
        //User data
        $resultArray = array();
        
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
           $temps = $data;
           array_push($resultArray  ,$temps);
        }
        $db = null;
        return $resultArray;

      //  echo json_encode($resultArray);
   //    return $data;
        
    }
    catch(PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function SeleactStorefarm0015()
{
    require 'config.php';
    try{
        $db = getDB();
        $stmt = $db->prepare("SELECT idpackage , name , price FROM package WHERE idpackage = 0015"); 
        $stmt->execute();
        //User data
        $resultArray = array();
        
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
           $temps = $data;
           array_push($resultArray  ,$temps);
        }
        $db = null;
        return $resultArray;

      //  echo json_encode($resultArray);
   //    return $data;
        
    }
    catch(PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}



public function SeleactStoreNewYear()
{
    require 'config.php';
    try{
        $db = getDB();
        $stmt = $db->prepare("SELECT idpackage , name , price FROM package WHERE idpackage = 0013"); 
        $stmt->execute();
        //User data
        $resultArray = array();
        
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
           $temps = $data;
           array_push($resultArray  ,$temps);
        }
        $db = null;
        return $resultArray;

      //  echo json_encode($resultArray);
   //    return $data;
        
    }
    catch(PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function userList()
{
    require 'config.php';
    try{
        $db = getDB();
        $stmt = $db->prepare("SELECT userid , fname  FROM users"); 
        $stmt->execute();
        //User data
        $resultArray = array();
        
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
           $temps = $data;
           array_push($resultArray  ,$temps);
        }
        $db = null;
        return $resultArray;

        
    }
    catch(PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


public function createCustomer($cusid , $codecus , $amount  , $package  ,$idactivity,$change ,$datein ,$dateout , $userid)
{
    require 'config.php';
    try {
        $db = getDB();
        $newac = array();
        $newac = $idactivity;
        $countArray = count($newac);
        for ($i=0; $i <= $countArray ; $i++) { 
            
            $status_print = '0';
            $stmt = $db->prepare("INSERT INTO customer(groupid,groupname,groupamount,idpackage,idactivity,group_amount_activity ,datein ,dateout  , status_print, userid ) VALUES (:cusid,:codecus,:amount,:package ,:idactivity ,:change , :datein, :dateout ,:status_print , :userid)");
            $stmt->bindParam("cusid", $cusid,PDO::PARAM_STR) ;
            $stmt->bindParam("codecus", $codecus,PDO::PARAM_STR) ;
            $stmt->bindParam("amount", $amount,PDO::PARAM_STR) ;
            $stmt->bindParam("package", $package,PDO::PARAM_STR) ;
            $query->bindParam("idactivity",$newac[$array] ,PDO::PARAM_INT) ;
            $stmt->bindParam("change", $change,PDO::PARAM_STR) ;
            $stmt->bindParam("datein", $datein,PDO::PARAM_STR) ;
            $stmt->bindParam("dateout", $dateout,PDO::PARAM_STR) ;
            $stmt->bindParam("status_print", $status_print,PDO::PARAM_STR) ;
            $stmt->bindParam("userid", $userid,PDO::PARAM_STR) ;
            $stmt->execute();
        }
            $db = null;
            return true;
        
    } catch (PDOException $e) {
        //throw $th;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }   
}

public function createQrCode($groupid , $group_number , $amount ,$other , $idactivity ,$datein ,$dateout)
{
    require_once 'config.php';
    try {
            $db = getDB();
            $newac = array();
            $newac = $idactivity;
            $countArray = count($newac);
            $amount_loop = $amount;
            for ($array = 0; $array < $countArray; $array++)
            {
                for ($i = 1; $i <= $amount_loop; $i++) {
                    $cusnumber = $group_number . "-" . $i;
                    $query = $db->prepare("SELECT groupid_number , other , idactivity FROM create_qrcodeuser where groupid_number = :groupid_number and idactivity =:idactivity"); 
                    $query->bindParam("groupid_number",$cusnumber ,PDO::PARAM_STR) ;
                    $query->bindParam("idactivity",$newac[$array] ,PDO::PARAM_INT) ;
                    $query->execute();
                    $row = $query->fetch(PDO::FETCH_ASSOC);
                    if( ! $row)
                    {
                                $stmt = $db->prepare("INSERT INTO create_qrcodeuser(groupid , groupid_number , other , idactivity , count_other ,datein ,dateout) VALUES (:groupid,:group_number,:other ,:idactivity ,:other ,:datein ,:dateout)");
                                $stmt->bindParam("groupid",$groupid ,PDO::PARAM_STR) ;
                                $stmt->bindParam("group_number",$cusnumber ,PDO::PARAM_STR) ;
                                $stmt->bindParam("other",$other ,PDO::PARAM_STR) ;
                                $stmt->bindParam("idactivity",$newac[$array] ,PDO::PARAM_STR) ;
                                $stmt->bindParam("other",$other ,PDO::PARAM_STR) ;
                                $stmt->bindParam("datein",$datein ,PDO::PARAM_STR) ;
                                $stmt->bindParam("dateout",$dateout ,PDO::PARAM_STR) ;
                                $stmt->execute();
                    }else{
                                $stmt = $db->prepare("UPDATE create_qrcodeuser SET other = other + 1 , count_other = count_other + 1 WHERE groupid_number = :groupid_number and idactivity =:idactivity");
                                $stmt->bindParam("groupid_number",$cusnumber ,PDO::PARAM_STR) ;
                                $stmt->bindParam("idactivity",$newac[$array] ,PDO::PARAM_INT) ;
                                $stmt->execute();
                    }

            }
        }       
        $db = null;
        return true;
    } catch (\Throwable $th) {
        //throw $th;
        $db = null;
        return false;
    }   
}


public function fetch_customerQr($cusid)
{
    require 'config.php';
    try{
        
        $db = getDB();
        $stmt = $db->prepare("SELECT distinct t1.idactivity , t1.count_other , t2.nameactivity FROM create_qrcodeuser as t1
        INNER JOIN activity_type as t2 ON t1.idactivity = t2.idactivity
        WHERE groupid = :cusid       ");
        $stmt->bindParam(':cusid', $cusid,PDO::PARAM_STR) ;
        $stmt->execute();
        //User data
        $resultArray = array();
        
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
           $temps = $data;
           array_push($resultArray  ,$temps);
        }
        $db = null;
        return $resultArray;

      //  echo json_encode($resultArray);
   //    return $data;
        
    }
    catch(PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function serachReportTodate()
{
    require 'config.php';
    try{
        $db = getDB();
        $datein = '06/09/2019';
        $stmt = $db->prepare("SELECT groupid , groupid_number , SUM(other) , SUM(count_other) FROM create_qrcodeuser where datein = :datein  GROUP BY groupid "); 
        $stmt->bindParam("datein",$datein ,PDO::PARAM_STR) ;
        $stmt->execute();
        //User data
        $resultArray = array();
        $total_activity = 0;
        
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
           $temps['groupid'] = $data['groupid'];
           $temps['groupid_number'] = $data['groupid_number'];
           $temps['other'] = $data['SUM(other)'];
           $temps['count_other'] = $data['SUM(count_other)'];

           $total_activity = $total_activity + $data['SUM(other)'];
           $temps['all'] =  $total_activity;
           array_push($resultArray  ,$temps);
        }
        $db = null;
        return $resultArray;

      //  echo json_encode($resultArray);
   //    return $data;
        
    }
    catch(PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function editUser($userid , $fname , $lname ,$email ,$password , $status)
{
    require 'config.php';
    try {
        $db = getDB();
        $stmt = $db->prepare("UPDATE users SET fname =:fname , lname =:lname , 
        email =:email , password =:password , status =:status WHERE userid =:userid");
        $stmt->bindParam(":fname", $fname,PDO::PARAM_STR) ;
        $stmt->bindParam(":lname", $lname,PDO::PARAM_STR) ;
        $stmt->bindParam(":email", $email,PDO::PARAM_STR) ;
        $stmt->bindParam(":password", $password,PDO::PARAM_STR) ;
        $stmt->bindParam(":status", $status,PDO::PARAM_STR) ;
        $stmt->bindParam(":userid", $userid,PDO::PARAM_STR) ;
        if($stmt->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
        $db = null;
    } catch (PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function deleteUser($userid)
{
    require 'config.php';
    try {
        $db = getDB();
        $stmt = $db->prepare("DELETE FROM users where userid = :userid"); 
        $stmt->bindParam("userid",$userid ,PDO::PARAM_STR) ;
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
        $db = null;
    } catch (PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}





public function loadReinstate()
{
    require 'config.php';
try{
$db = getDB();
$stmt = $db->prepare("SELECT id,groupid_number , idactivity , date ,time FROM history order by time ASC");
$stmt->execute();
$resultArray = array();
$countRecord = 0;
 //User data
while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $temps = array();
    $temps['id'] = $data['id'];
    $temps['groupid_number'] = $data['groupid_number'];
    $temps['idactivity'] = $data['idactivity'];
    $temps['date'] = $data['date'];
    $temps['time'] = $data['time'];

    array_push($resultArray  ,$temps);
}
return $resultArray;
}
catch(PDOException $e) {
echo '{"error":{"text":'. $e->getMessage() .'}}';
}
}


public function closingReport($date)
{
    require 'config.php';
    try{
        $db = getDB();
        $resultArray = array();
        $idcashReal = '0005';
        $stmt = $db->prepare("SELECT t1.userid , t1.noseniorsoft , t1.groupid , t1.groupname , t1.groupamount , t1.idpackage , t1.discount , t1.datein 
        , t1.dateout , SUM(t2.count_other) as total_play
          , t2.idactivity  , t4.price , t4.name FROM customer_group as t1
        INNER JOIN create_qrcodeuser as t2 ON t1.groupid = t2.groupid
        INNER JOIN activity_type as t3 ON t2.idactivity = t3.idactivity
        INNER JOIN package as t4 ON t1.idpackage = t4.idpackage
        WHERE  t1.idpackage =:idcashReal AND t1.datein =:date AND daily_balance = 0
        group by groupid
        ");
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':idcashReal', $idcashReal, PDO::PARAM_INT);
        $stmt->execute();
        $number_filter_row  = $stmt->rowCount();
        $resultArray = array();
        $total = 0;
        $totalPriceAc = 0;
        $price = null;
        $resulname = array();
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $resulname = null;
            $resulprice = null;
            $price = null;
            $totalPriceAc = 0;
            $userid = $data["groupid"];
            $idactivity = $data["idactivity"];
            $query = $db->prepare("SELECT DISTINCT  s1.count_other , s2.nameactivity , s2.price FROM create_qrcodeuser as s1 
            INNER JOIN activity_type as s2 ON s1.idactivity = s2.idactivity
            WHERE s1.groupid =:userid");
            $query->bindParam(':userid', $userid,PDO::PARAM_STR) ;
            $query->execute();
            while( $dataActivity = $query->fetch(PDO::FETCH_ASSOC))
            {   
                $temps1 = array();
                $totalprice = array();
                $temps1 = $dataActivity["nameactivity"]. '(' . $dataActivity['count_other'] . ')' ."<br>" ;
                $priceActivity = ($dataActivity["count_other"] * $dataActivity["price"]) ;
                $totalPriceAc = $totalPriceAc + $priceActivity;
                $resulname[] = $temps1;
            }      
            $temps = array();
            $price_total = ($data["groupamount"] * $totalPriceAc);
            $price_100 = ($price_total * $data["discount"]) / 100;
            $result = $price_total - $price_100;
            $total =+ $total + $result;
            $temps['noseniorsoft'] = $data['noseniorsoft'];
            $temps['cusid'] = $data["userid"];
            $temps['cusamount'] = $data["groupamount"];
            $temps['cuspackage'] = $data["name"];
            $temps['cusnameactivity'] = $resulname;
            $temps['cusplay'] = $data["total_play"];
            $temps['cusprice'] = $totalPriceAc;
            $temps['cuscash'] = number_format($result , 2);;
            $temps['discountprice'] = $price_100;
            $temps['total'] = number_format($total , 2);
            $temps['datein'] = date("d-m-Y" , strtotime($data["datein"])) ;
            $temps['discount']  = $data["discount"].'%';
            array_push($resultArray , $temps);
        }

        return $resultArray;
     
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


public function closingReportLaserGame($date)
{
    require 'config.php';
    try{
        $db = getDB();
        $resultArray = array();
        $idcashReal = '0011';
        $stmt = $db->prepare("SELECT t1.userid , t1.noseniorsoft , t1.groupid , t1.groupname , t1.groupamount , t1.idpackage , t1.discount , t1.datein 
        , t1.dateout , SUM(t2.count_other) as total_play
          , t2.idactivity  , t4.price , t4.name FROM customer_group as t1
        INNER JOIN create_qrcodeuser as t2 ON t1.groupid = t2.groupid
        INNER JOIN activity_type as t3 ON t2.idactivity = t3.idactivity
        INNER JOIN package as t4 ON t1.idpackage = t4.idpackage
        WHERE  t1.idpackage =:idcashReal AND t1.datein =:date AND daily_balance = 0
        group by groupid
        ");
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':idcashReal', $idcashReal, PDO::PARAM_INT);
        $stmt->execute();
        $number_filter_row  = $stmt->rowCount();
        $resultArray = array();
        $total = 0;
        $totalPriceAc = 0;
        $price = null;
        $resulname = array();
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $resulname = null;
            $resulprice = null;
            $price = null;
            $totalPriceAc = 0;
            $userid = $data["groupid"];
            $idactivity = $data["idactivity"];
            $query = $db->prepare("SELECT DISTINCT  s1.count_other , s2.nameactivity , s2.price FROM create_qrcodeuser as s1 
            INNER JOIN activity_type as s2 ON s1.idactivity = s2.idactivity
            WHERE s1.groupid =:userid");
            $query->bindParam(':userid', $userid,PDO::PARAM_STR) ;
            $query->execute();
            while( $dataActivity = $query->fetch(PDO::FETCH_ASSOC))
            {   
                $temps1 = array();
                $totalprice = array();
                $temps1 = $dataActivity["nameactivity"]. '(' . $dataActivity['count_other'] . ')' ."<br>" ;
                $priceActivity = ($dataActivity["count_other"] * $dataActivity["price"]) ;
                $totalPriceAc = $totalPriceAc + $priceActivity;
                $resulname[] = $temps1;
            }      
            $temps = array();
            $price_total = ($data["groupamount"] * $totalPriceAc);
            $price_100 = ($price_total * $data["discount"]) / 100;
            $result = $price_total - $price_100;
            $total =+ $total + $result;
            $temps['noseniorsoft'] = $data['noseniorsoft'];
            $temps['cusid'] = $data["userid"];
            $temps['cusamount'] = $data["groupamount"];
            $temps['cuspackage'] = $data["name"];
            $temps['cusnameactivity'] = $resulname;
            $temps['cusplay'] = $data["total_play"];
            $temps['cusprice'] = $totalPriceAc;
            $temps['cuscash'] = number_format($result , 2);;
            $temps['discountprice'] = $price_100;
            $temps['total'] = number_format($total , 2);
            $temps['datein'] = date("d-m-Y" , strtotime($data["datein"])) ;
            $temps['discount']  = $data["discount"].'%';
            array_push($resultArray , $temps);
        }

        return $resultArray;
     
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function closingReportNewYear($date)
{
    require 'config.php';
    try{
        $db = getDB();
        $resultArray = array();
        $idcashReal = '0013';
        $stmt = $db->prepare("SELECT t1.userid , t1.noseniorsoft , t1.groupid , t1.groupname , t1.groupamount , t1.idpackage , t1.discount , t1.datein 
        , t1.dateout , t2.groupid_number, SUM(t2.count_other) as total_play
          , t2.idactivity  , t4.price , t4.name FROM customer_group as t1
        INNER JOIN create_qrcodeuser as t2 ON t1.groupid = t2.groupid
        INNER JOIN activity_type as t3 ON t2.idactivity = t3.idactivity
        INNER JOIN package as t4 ON t1.idpackage = t4.idpackage
        WHERE  t1.idpackage =:idcashReal AND t1.datein =:date AND daily_balance = 0
        group by groupid
        ");
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':idcashReal', $idcashReal, PDO::PARAM_INT);
        $stmt->execute();
        $number_filter_row  = $stmt->rowCount();
        $resultArray = array();
        $total = 0;
        $totalPriceAc = 0;
        $price = null;
        $resulname = array();
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $resulid = null;
            $resulname = null;
            $resulprice = null;
            $price = null;
            $totalPriceAc = 0;
            $userid = $data["groupid"];
            $idactivity = $data["idactivity"];
            $query = $db->prepare("SELECT DISTINCT  s1.count_other , s2.idactivity , s2.nameactivity , s2.price FROM create_qrcodeuser as s1 
            INNER JOIN activity_type as s2 ON s1.idactivity = s2.idactivity
            WHERE s1.groupid =:userid");
            $query->bindParam(':userid', $userid,PDO::PARAM_STR) ;
            $query->execute();
            while( $dataActivity = $query->fetch(PDO::FETCH_ASSOC))
            {   
                $temps1 = array();
                $totalprice = array();
                $tempsIdac = array();
                $temps1 = $dataActivity["nameactivity"]. '(' . $dataActivity['count_other'] . ')' ."<br>" ;
                $tempsIdac = $dataActivity["idactivity"];
                $priceActivity = ($dataActivity["count_other"] * $dataActivity["price"]) ;
                $totalPriceAc = $totalPriceAc + $priceActivity;
                $resulname[] = $temps1;
                $resulid[] = $tempsIdac;
            }      
            $temps = array();
    
            if($resulid[0] == 6184)
            {
                $price_total = 100;
            }else{
                $price_total = ($data["groupamount"] * $totalPriceAc);
            }
            
            $price_100 = ($price_total * $data["discount"]) / 100;
            $result = $price_total - $price_100;
            $total =+ $total + $result;
            $temps['groupid'] = $data['groupid_number'];
            $temps['noseniorsoft'] = $data['noseniorsoft'];
            $temps['cusid'] = $data["userid"];
            $temps['cusamount'] = $data["groupamount"];
            $temps['cuspackage'] = $data["name"];
            $temps['cusnameactivity'] = $resulname;
            $temps['cusplay'] = $data["total_play"];
            $temps['cusprice'] = $totalPriceAc;
            $temps['cuscash'] = number_format($result , 2);;
            $temps['discountprice'] = $price_100;
            $temps['total'] = number_format($total , 2);
            $temps['datein'] = date("d-m-Y" , strtotime($data["datein"])) ;
            $temps['discount']  = $data["discount"].'%';
            
            array_push($resultArray , $temps);
        }

        return $resultArray;
     
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


public function closingReportfarm($date)
{
    require 'config.php';
    try{
        $db = getDB();
        $resultArray = array();
        $idcashReal = '0012';
        $stmt = $db->prepare("SELECT t1.userid , t1.noseniorsoft , t1.groupid , t1.groupname , t1.groupamount , t1.idpackage , t1.discount , t1.datein 
        , t1.dateout , SUM(t2.count_other) as total_play
          , t2.idactivity  , t4.price , t4.name FROM customer_group as t1
        INNER JOIN create_qrcodeuser as t2 ON t1.groupid = t2.groupid
        INNER JOIN activity_type as t3 ON t2.idactivity = t3.idactivity
        INNER JOIN package as t4 ON t1.idpackage = t4.idpackage
        WHERE  t1.idpackage =:idcashReal AND t1.datein =:date AND daily_balance = 0
        group by groupid
        ");
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':idcashReal', $idcashReal, PDO::PARAM_INT);
        $stmt->execute();
        $number_filter_row  = $stmt->rowCount();
        $resultArray = array();
        $total = 0;
        $totalPriceAc = 0;
        $price = null;
        $resulname = array();
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $resulid = null;
            $resulname = null;
            $resulprice = null;
            $price = null;
            $totalPriceAc = 0;
            $userid = $data["groupid"];
            $idactivity = $data["idactivity"];
            $query = $db->prepare("SELECT DISTINCT  s1.count_other , s2.idactivity , s2.nameactivity , s2.price FROM create_qrcodeuser as s1 
            INNER JOIN activity_type as s2 ON s1.idactivity = s2.idactivity
            WHERE s1.groupid =:userid");
            $query->bindParam(':userid', $userid,PDO::PARAM_STR) ;
            $query->execute();
            while( $dataActivity = $query->fetch(PDO::FETCH_ASSOC))
            {   
                $temps1 = array();
                $totalprice = array();
                $tempsIdac = array();
                $temps1 = $dataActivity["nameactivity"]. '(' . $dataActivity['count_other'] . ')' ;
                $tempsIdac = $dataActivity["idactivity"];
                $priceActivity = ($dataActivity["count_other"] * $dataActivity["price"]) ;
                $totalPriceAc = $totalPriceAc + $priceActivity;
                $resulname[] = $temps1;
                $resulid[] = $tempsIdac;
            }      
            $temps = array();
    
            if($resulid[0] == 6136 && $resulid[1] == 6168 && $resulid[2] == 6169 && $resulid[3] == 6172 && $resulid[4] == 6177 )
            {
                $resulname = 'FarmBerry Tour 150 บาท';
                $totalPriceAc = 150;
            }elseif ($resulid[0] == 6136 && $resulid[1] == 6168 && $resulid[2] == 6169 && $resulid[3] == 6174 && $resulid[4] == 6173 && $resulid[5] == 6177 && $data['groupname'] == 'Farm Package1 200บาท') {
                $resulname = 'Farm Package1 200บาท';
                $totalPriceAc = 200;
            }elseif ($resulid[0] == 6136 && $resulid[1] == 6168 && $resulid[2] == 6169 && $resulid[3] == 6174 && $resulid[4] == 6173 && $resulid[5] == 6143  && $resulid[6] == 6177 || $data['groupname'] == 'Farm Package2 350บาท') {
                $resulname = 'Farm Package2 350บาท';
                $totalPriceAc = 350;
            }elseif ($resulid[0] == 6136 && $resulid[1] == 6168 && $resulid[2] == 6169 && $resulid[3] == 6174 && $resulid[4] == 6173 && $resulid[5] == 6129  && $resulid[6] == 6172 && $resulid[7] == 6171 && $resulid[8] == 6177) {
                $resulname = 'Farm Package3 500บาท';
                $totalPriceAc = 500;
            }elseif ($resulid[0] == 6136 && $resulid[1] == 6168 && $resulid[2] == 6169 && $resulid[3] == 6174 && $resulid[4] == 6173 && $resulid[5] == 6177 && $data['groupname'] == 'Farm Package1 160บาท(เด็ก)' ) {
                $resulname = 'Farm Package1 160บาท(เด็ก)';
                $totalPriceAc = 160;
            }elseif ($resulid[0] == 6136 && $resulid[1] == 6168 && $resulid[2] == 6169 && $resulid[3] == 6174 && $resulid[4] == 6173 && $resulid[5] == 6129  && $resulid[6] == 6177 && $data['groupname'] == 'Farm Package2 280บาท(เด็ก)') {
                $resulname = 'Farm Package1 280บาท(เด็ก)';
                $totalPriceAc = 280;
            }
            elseif ($resulid[0] == 6125 && $resulid[1] == 6129 && $resulid[2] == 6131 && $resulid[3] == 6144 && $resulid[4] == 6170 && $resulid[5] == 6197  && $resulid[6] == 6198 && $resulid[7] == 6199 && $data['groupname'] == 'Farm Together') {
                $resulname = 'Farm Together';
                $totalPriceAc = 490;
            }
            $price_total = ($data["groupamount"] * $totalPriceAc);
            $price_100 = ($price_total * $data["discount"]) / 100;
            $result = $price_total - $price_100;
            $total =+ $total + $result;
            $temps['noseniorsoft'] = $data['noseniorsoft'];
            $temps['cusid'] = $data["userid"];
            $temps['cusamount'] = $data["groupamount"];
            $temps['cuspackage'] = $data["groupname"];
            $temps['cusnameactivity'] = $resulname;
            $temps['cusplay'] = $data["total_play"];
            $temps['cusprice'] = $totalPriceAc;
            $temps['cuscash'] = number_format($result , 2);;
            $temps['discountprice'] = $price_100;
            $temps['total'] = number_format($total , 2);
            $temps['datein'] = date("d-m-Y" , strtotime($data["datein"])) ;
            $temps['discount']  = $data["discount"].'%';
            
            array_push($resultArray , $temps);
        }

        return $resultArray;
     
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function closingReportSheep($date)
{
    require 'config.php';
    try{
        $db = getDB();
        $resultArray = array();
        $idcashReal = '0015';
        $stmt = $db->prepare("SELECT t1.userid , t1.noseniorsoft , t1.groupid , t1.groupname , t1.groupamount , t1.idpackage , t1.discount , t1.datein 
        , t1.dateout , SUM(t2.count_other) as total_play
          , t2.idactivity  , t4.price , t4.name FROM customer_group as t1
        INNER JOIN create_qrcodeuser as t2 ON t1.groupid = t2.groupid
        INNER JOIN activity_type as t3 ON t2.idactivity = t3.idactivity
        INNER JOIN package as t4 ON t1.idpackage = t4.idpackage
        WHERE  t1.idpackage =:idcashReal AND t1.datein =:date AND daily_balance = 0
        group by groupid
        ");
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':idcashReal', $idcashReal, PDO::PARAM_INT);
        $stmt->execute();
        $number_filter_row  = $stmt->rowCount();
        $resultArray = array();
        $total = 0;
        $totalPriceAc = 0;
        $price = null;
        $resulname = array();
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $resulid = null;
            $resulname = null;
            $resulprice = null;
            $price = null;
            $totalPriceAc = 0;
            $userid = $data["groupid"];
            $idactivity = $data["idactivity"];
            $query = $db->prepare("SELECT DISTINCT  s1.count_other , s2.idactivity , s2.nameactivity , s2.price FROM create_qrcodeuser as s1 
            INNER JOIN activity_type as s2 ON s1.idactivity = s2.idactivity
            WHERE s1.groupid =:userid");
            $query->bindParam(':userid', $userid,PDO::PARAM_STR) ;
            $query->execute();
            while( $dataActivity = $query->fetch(PDO::FETCH_ASSOC))
            {   
                $temps1 = array();
                $totalprice = array();
                $tempsIdac = array();
                $temps1 = $dataActivity["nameactivity"]. '(' . $dataActivity['count_other'] . ')' ."<br>" ;
                $tempsIdac = $dataActivity["idactivity"];
                $priceActivity = ($dataActivity["count_other"] * $dataActivity["price"]) ;
                $totalPriceAc = $totalPriceAc + $priceActivity;
                $resulname[] = $temps1;
                $resulid[] = $tempsIdac;
            }      
            $temps = array();
    
            if($resulid[0] == 6136 && $resulid[1] == 6168 && $resulid[2] == 6169 && $resulid[3] == 6172 && $resulid[4] == 6177 )
            {
                $totalPriceAc = 150;
            }elseif ($resulid[0] == 6136 && $resulid[1] == 6168 && $resulid[2] == 6169 && $resulid[3] == 6174 && $resulid[4] == 6173 && $resulid[5] == 6177 ) {
                $totalPriceAc = 200;
            }elseif ($resulid[0] == 6136 && $resulid[1] == 6168 && $resulid[2] == 6169 && $resulid[3] == 6174 && $resulid[4] == 6173 && $resulid[5] == 6143  && $resulid[6] == 6177 ) {
                $totalPriceAc = 350;
            }elseif ($resulid[0] == 6136 && $resulid[1] == 6168 && $resulid[2] == 6169 && $resulid[3] == 6174 && $resulid[4] == 6173 && $resulid[5] == 6143  && $resulid[6] == 6172 && $resulid[7] == 6171 && $resulid[8] == 6177) {
                $totalPriceAc = 500;
            }
            $price_total = ($data["groupamount"] * $totalPriceAc);
            $price_100 = ($price_total * $data["discount"]) / 100;
            $result = $price_total - $price_100;
            $total =+ $total + $result;
            $temps['noseniorsoft'] = $data['noseniorsoft'];
            $temps['cusid'] = $data["userid"];
            $temps['cusamount'] = $data["groupamount"];
            $temps['cuspackage'] = $data["name"];
            $temps['cusnameactivity'] = $resulname;
            $temps['cusplay'] = $data["total_play"];
            $temps['cusprice'] = $totalPriceAc;
            $temps['cuscash'] = number_format($result , 2);;
            $temps['discountprice'] = $price_100;
            $temps['total'] = number_format($total , 2);
            $temps['datein'] = date("d-m-Y" , strtotime($data["datein"])) ;
            $temps['discount']  = $data["discount"].'%';
            
            array_push($resultArray , $temps);
        }

        return $resultArray;
     
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function closingReportGroup($userid)
{
    require 'config.php';
    try{
        $db = getDB();
        $resultArray = array();
        $idcashReal = '0006';
        $datenow = date("Y-m-d");
        $stmt = $db->prepare("SELECT t1.userid , t1.groupid , t1.groupname , t1.groupamount , t1.idpackage , t1.discount , t1.datein 
        , t1.dateout , SUM(t2.count_other) as total_play
          , t2.idactivity  , t4.price , t4.name FROM customer_group as t1
        INNER JOIN create_qrcodeuser as t2 ON t1.groupid = t2.groupid
        INNER JOIN activity_type as t3 ON t2.idactivity = t3.idactivity
        INNER JOIN package as t4 ON t1.idpackage = t4.idpackage
        WHERE  t1.idpackage =:idcashReal AND t1.userid =:userid  
        group by groupid
        ");
        $stmt->bindParam(':idcashReal', $idcashReal, PDO::PARAM_INT);
        $stmt->bindParam(':userid', $userid, PDO::PARAM_STR);
        $stmt->execute();
        $number_filter_row  = $stmt->rowCount();
        $resultArray = array();
        $total = 0;
        $totalPriceAc = 0;
        $price = null;
        $resulname = array();
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $resulname = null;
            $resulprice = null;
            $price = null;
            $totalPriceAc = 0;
            $userid = $data["groupid"];
            $idactivity = $data["idactivity"];
            $query = $db->prepare("SELECT DISTINCT  s1.count_other , s2.nameactivity , s2.price FROM create_qrcodeuser as s1 
            INNER JOIN activity_type as s2 ON s1.idactivity = s2.idactivity
            WHERE s1.groupid =:userid");
            $query->bindParam(':userid', $userid,PDO::PARAM_STR) ;
            $query->execute();
            while( $dataActivity = $query->fetch(PDO::FETCH_ASSOC))
            {   
                $temps1 = array();
                $totalprice = array();
                $temps1 = $dataActivity["nameactivity"]. '(' . $dataActivity['count_other'] . ')' ."<br>" ;
                $priceActivity = ($dataActivity["count_other"] * $dataActivity["price"]) ;
                $totalPriceAc = $totalPriceAc + $priceActivity;
                $resulname[] = $temps1;
            }      
            $temps = array();
            $price_total = ($data["groupamount"] * $totalPriceAc);
            $price_100 = ($price_total * $data["discount"]) / 100;
            $result = $price_total - $price_100;
            $total =+ $total + $result;
            $temps['cusid'] = $data["groupid"];
            $temps['cusname'] = $data['groupname'];
            $temps['cusamount'] = $data["groupamount"];
            $temps['cuspackage'] = $data["name"];
            $temps['cusnameactivity'] = $resulname;
            $temps['cusplay'] = $data["total_play"];
            $temps['cusprice'] = $totalPriceAc;
            $temps['cuscash'] = $result;
            $temps['discountprice'] = $price_100;
            $temps['total'] = number_format($total , 2);
            $temps['datein'] = date("d-m-Y" , strtotime($data["datein"])) ;
            $temps['discount']  = $data["discount"].'%';
            array_push($resultArray , $temps);
        }

        return $resultArray;
     
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function DeleteHistoryandGranuser($groupid_no ,$idactivity)
{
    require 'config.php';
    try {
        $db = getDB();
        $stmt = $db->prepare("DELETE FROM history where groupid_number =:groupid_no AND idactivity=:idactivity"); 
        $stmt->bindParam("groupid_no",$groupid_no ,PDO::PARAM_STR) ;
        $stmt->bindParam("idactivity",$idactivity ,PDO::PARAM_INT) ;
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
        $db = null;
    } catch (PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function updateGrantCustomer($groupid_no , $idactivity , $time)
{
    require 'config.php';
    try {
        $db = getDB();
        $check = $db->prepare("SELECT * FROM create_qrcodeuser WHERE groupid_number=:groupid_no AND idactivity=:idactivity");
        $check->bindParam("groupid_no",$groupid_no ,PDO::PARAM_STR) ;
        $check->bindParam("idactivity",$idactivity ,PDO::PARAM_INT) ;
        $check->execute();
        $count=$check->rowCount();
        if($count){
            $stmt = $db->prepare("UPDATE create_qrcodeuser SET other = other + 1 WHERE groupid_number = :groupid_no and idactivity =:idactivity");
            $stmt->bindParam("groupid_no",$groupid_no ,PDO::PARAM_STR) ;
            $stmt->bindParam("idactivity",$idactivity ,PDO::PARAM_INT) ;
            if($stmt->execute()){
                $queryD = $db->prepare("DELETE FROM history 
                where groupid_number =:groupid_no 
                AND idactivity=:idactivity
                AND time=:time"); 
                $queryD->bindParam("groupid_no",$groupid_no ,PDO::PARAM_STR) ;
                $queryD->bindParam("idactivity",$idactivity ,PDO::PARAM_INT) ;
                $queryD->bindParam("time",$time ,PDO::PARAM_STR) ;
                if($queryD->execute()){
                    $db = null;
                    return true;
                }else{
                    $db = null;
                    return false;
                }
            }else{
                $db = null;
                return false;
            }
            $db = null;
        }else{
            $db = null;
           return false;
        }

    } catch (PDOException $e) {
        $db = null;
        return false;
        echo '{"error":{"text":'. $e->getMessage() .'}}';    }
}



public function updatePrintstatus($customerid)
{
    require 'config.php';
    try {
        $db = getDB();
        $status_print = '1';
        $stmt = $db->prepare("UPDATE customer_group SET status_print =:status_print  WHERE groupid =:customerid");
        $stmt->bindParam("status_print",$status_print ,PDO::PARAM_INT);
        $stmt->bindParam("customerid",$customerid ,PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        return true;
    }
    catch(PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function sortAZ()
{
    require 'config.php';
    try {
        $db = getDB();
        $stmt = $db->prepare("SELECT idactivity , nameactivity FROM activity_type ORDER BY CONVERT(nameactivity USING tis620) ASC");
        $stmt->execute();
        $result = array();
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC)){
            $temp_Data = array();
            $temp_Data = $data;
            array_push($result , $temp_Data);
        }
        return $result;
        $db = null;
    } catch (PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}



public function insertfoc($groupid , $groupname , $price , $amount , $amount_activity , $nameactivity ,$foc ,$cause , $total ,$userid)
{
    require 'config.php';
    try {
        $db = getDB();
        $date = date("Y-m-d");
        $groupid_ar = array();
        $groupname_ar = array();
        $price_ar = array();
        $amount_ar = array();
        $amount_activity_ar = array();
        $foc_ar = array();
        $cause_ar = array();
        $total_ar = array();
        $userid_ar = array();
        $nameactivity_ar = array();
        $groupid_ar = $groupid;
        $groupname_ar = $groupname;
        $price_ar = $price;
        $amount_ar = $amount;
        $amount_activity_ar = $amount_activity;
        $foc_ar = $foc;
        $cause_ar = $cause;
        $total_ar = $total;
        $userid_ar = $userid;
        $nameactivity_ar = $nameactivity;

        $countArray = count($groupid_ar);
        for ($i=0; $i < $countArray ; $i++) { 
            $stmt = $db->prepare("INSERT INTO foc(groupid,groupname,price,amount,amount_activity, nameactivity,foc ,cause ,total , date ,userid) VALUES (:groupid,:groupname,:price,:amount ,:amount_activity,:nameactivity ,:foc , :cause, :total ,:date ,:userid )");
            $stmt->bindParam("groupid", $groupid_ar[$i],PDO::PARAM_STR);
            $stmt->bindParam("groupname", $groupname_ar[$i],PDO::PARAM_STR);
            $stmt->bindParam("price", $price_ar[$i],PDO::PARAM_INT);
            $stmt->bindParam("amount", $amount_ar[$i],PDO::PARAM_INT);
            $stmt->bindParam("amount_activity",$amount_activity_ar[$i] ,PDO::PARAM_INT);
            $stmt->bindParam("nameactivity",$nameactivity_ar[$i] ,PDO::PARAM_STR);
            $stmt->bindParam("foc", $foc_ar[$i],PDO::PARAM_INT);
            $stmt->bindParam("cause", $cause_ar[$i],PDO::PARAM_STR);
            $stmt->bindParam("total", $total_ar[$i],PDO::PARAM_INT);
            $stmt->bindParam("date", $date,PDO::PARAM_STR);
            $stmt->bindParam("userid", $userid_ar[$i],PDO::PARAM_INT);
            $stmt->execute();
        }
            $db = null;
            return true;
        
    } catch (PDOException $e) {
            $db = null;
            echo '{"error":{"text":'. $e->getMessage() .'}}';
    }   
}

//insert close group -------------------------------------------

public function insertCashClose($userid , $billSeniorsoft , $amountcus , $nameactivity , $price , $grant_activity , $dis_price ,$discount_price ,$total_cash  , $seniorsoft ,$programcashcard , $balance , $because , $date)
{
    require 'config.php';
    try {
        $db = getDB();
     //   $date = date("Y-m-d");
      //  $db->beginTransaction();
        for ($i=0; $i < count($userid) ; $i++) { 
            $stmt = $db->prepare("INSERT INTO close_cash(userid, billseniorsoft, amountcus, nameactivity, price, grant_activity,dis_price, discount_price, total_cash ,date_close , seniorsoft ,programcashcard ,balance ,because)
            VALUES (:userid,:billSeniorsoft,:amountcus,:nameactivity ,:price,:grant_activity ,:dis_price , :discount_price, :total_cash , :date , :seniorsoft ,:programcashcard ,:balance , :because)");
            $stmt->bindParam("userid", $userid[$i],PDO::PARAM_INT);
            $stmt->bindParam("billSeniorsoft", $billSeniorsoft[$i],PDO::PARAM_STR);
            $stmt->bindParam("amountcus", $amountcus[$i],PDO::PARAM_STR);
            $stmt->bindParam("nameactivity",$nameactivity[$i] ,PDO::PARAM_STR);
            $stmt->bindParam("price",$price[$i] ,PDO::PARAM_STR);
            $stmt->bindParam("grant_activity", $grant_activity[$i],PDO::PARAM_INT);
            $stmt->bindParam("dis_price", $dis_price[$i],PDO::PARAM_STR);
            $stmt->bindParam("discount_price", $discount_price[$i],PDO::PARAM_INT);
            $stmt->bindParam("total_cash", $total_cash[$i],PDO::PARAM_STR);
            $stmt->bindParam("date", $date,PDO::PARAM_STR);
            $stmt->bindParam("seniorsoft", $seniorsoft,PDO::PARAM_STR);
            $stmt->bindParam("programcashcard", $programcashcard,PDO::PARAM_STR);
            $stmt->bindParam("balance", $balance,PDO::PARAM_STR);
            $stmt->bindParam("because", $because,PDO::PARAM_STR);
            $stmt->execute();
            $query = $db->prepare("UPDATE customer_group SET daily_balance = daily_balance + 1  WHERE noseniorsoft=:billSeniorsoft");
            $query->bindParam("billSeniorsoft",$billSeniorsoft[$i] ,PDO::PARAM_STR);
            $query->execute();
          //  $db->commit();
        }
            $db = null;
            return true;
        
    } catch (PDOException $e) {
            $db = null;
           // $db->rollBack();
            echo '{"error":{"text":'. $e->getMessage() .'}}';
    }   
}

public function insertCashCloseFarm($userid , $billSeniorsoft , $amountcus , $nameactivity , $price , $grant_activity , $dis_price ,$discount_price ,$total_cash  , $seniorsoft ,$programcashcard , $balance , $because , $date)
{
    require 'config.php';
    try {
        $db = getDB();
     //   $date = date("Y-m-d");
      //  $db->beginTransaction();
        for ($i=0; $i < count($userid) ; $i++) { 
            $stmt = $db->prepare("INSERT INTO close_cash_farm(userid, billseniorsoft, amountcus, nameactivity, price, grant_activity,dis_price, discount_price, total_cash ,date_close , seniorsoft ,programcashcard ,balance ,because)
            VALUES (:userid,:billSeniorsoft,:amountcus,:nameactivity ,:price,:grant_activity ,:dis_price , :discount_price, :total_cash , :date , :seniorsoft ,:programcashcard ,:balance , :because)");
            $stmt->bindParam("userid", $userid[$i],PDO::PARAM_INT);
            $stmt->bindParam("billSeniorsoft", $billSeniorsoft[$i],PDO::PARAM_STR);
            $stmt->bindParam("amountcus", $amountcus[$i],PDO::PARAM_STR);
            $stmt->bindParam("nameactivity",$nameactivity[$i] ,PDO::PARAM_STR);
            $stmt->bindParam("price",$price[$i] ,PDO::PARAM_STR);
            $stmt->bindParam("grant_activity", $grant_activity[$i],PDO::PARAM_INT);
            $stmt->bindParam("dis_price", $dis_price[$i],PDO::PARAM_STR);
            $stmt->bindParam("discount_price", $discount_price[$i],PDO::PARAM_INT);
            $stmt->bindParam("total_cash", $total_cash[$i],PDO::PARAM_STR);
            $stmt->bindParam("date", $date,PDO::PARAM_STR);
            $stmt->bindParam("seniorsoft", $seniorsoft,PDO::PARAM_STR);
            $stmt->bindParam("programcashcard", $programcashcard,PDO::PARAM_STR);
            $stmt->bindParam("balance", $balance,PDO::PARAM_STR);
            $stmt->bindParam("because", $because,PDO::PARAM_STR);
            $stmt->execute();
        /*    $query = $db->prepare("UPDATE customer_group SET daily_balance = daily_balance + 1  WHERE noseniorsoft=:billSeniorsoft");
            $query->bindParam("billSeniorsoft",$billSeniorsoft[$i] ,PDO::PARAM_STR);
            $query->execute(); */
          //  $db->commit();
        }
            $db = null;
            return true;
        
    } catch (PDOException $e) {
            $db = null;
           // $db->rollBack();
            echo '{"error":{"text":'. $e->getMessage() .'}}';
    }   
}


public function insertCashCloseNewYear($userid , $billSeniorsoft , $amountcus , $nameactivity , $price , $grant_activity , $dis_price ,$discount_price ,$total_cash  , $seniorsoft ,$programcashcard , $balance , $because , $date)
{
    require 'config.php';
    try {
        $db = getDB();
     //   $date = date("Y-m-d");
      //  $db->beginTransaction();
        for ($i=0; $i < count($userid) ; $i++) { 
            $stmt = $db->prepare("INSERT INTO close_newyear(userid, billseniorsoft, amountcus, nameactivity, price, grant_activity,dis_price, discount_price, total_cash ,date_close , seniorsoft ,programcashcard ,balance ,because)
            VALUES (:userid,:billSeniorsoft,:amountcus,:nameactivity ,:price,:grant_activity ,:dis_price , :discount_price, :total_cash , :date , :seniorsoft ,:programcashcard ,:balance , :because)");
            $stmt->bindParam("userid", $userid[$i],PDO::PARAM_INT);
            $stmt->bindParam("billSeniorsoft", $billSeniorsoft[$i],PDO::PARAM_STR);
            $stmt->bindParam("amountcus", $amountcus[$i],PDO::PARAM_STR);
            $stmt->bindParam("nameactivity",$nameactivity[$i] ,PDO::PARAM_STR);
            $stmt->bindParam("price",$price[$i] ,PDO::PARAM_STR);
            $stmt->bindParam("grant_activity", $grant_activity[$i],PDO::PARAM_INT);
            $stmt->bindParam("dis_price", $dis_price[$i],PDO::PARAM_STR);
            $stmt->bindParam("discount_price", $discount_price[$i],PDO::PARAM_INT);
            $stmt->bindParam("total_cash", $total_cash[$i],PDO::PARAM_STR);
            $stmt->bindParam("date", $date,PDO::PARAM_STR);
            $stmt->bindParam("seniorsoft", $seniorsoft,PDO::PARAM_STR);
            $stmt->bindParam("programcashcard", $programcashcard,PDO::PARAM_STR);
            $stmt->bindParam("balance", $balance,PDO::PARAM_STR);
            $stmt->bindParam("because", $because,PDO::PARAM_STR);
            $stmt->execute();
            $query = $db->prepare("UPDATE customer_group SET daily_balance = daily_balance + 1  WHERE noseniorsoft=:billSeniorsoft");
            $query->bindParam("billSeniorsoft",$billSeniorsoft[$i] ,PDO::PARAM_STR);
            $query->execute();
          //  $db->commit();
        }
            $db = null;
            return true;
        
    } catch (PDOException $e) {
            $db = null;
           // $db->rollBack();
            echo '{"error":{"text":'. $e->getMessage() .'}}';
    }   
}

public function insertCloseGroup($userid , $customerid , $amount , $nameactivity , $grant_play , $price , $total_cash , $seniorsoft , $programcard , $balance , $because)
{
    require 'config.php';
    try {
        $db = getDB();
        $dateclose = date("Y-m-d");
      //  $db->beginTransaction();
        for ($i=0; $i < count($userid) ; $i++) { 
            $stmt = $db->prepare("INSERT INTO close_group(userid, customerid, amount, nameactivity, grant_play, price,total_cash, dateclose, seniorsoft, programcard , balance ,because)
            VALUES (:userid,:customerid,:amount,:nameactivity ,:grant_play, :price , :total_cash, :dateclose , :seniorsoft ,:programcard ,:balance , :because)");
            $stmt->bindParam("userid", $userid[$i],PDO::PARAM_INT);
            $stmt->bindParam("customerid", $customerid[$i],PDO::PARAM_STR);
            $stmt->bindParam("amount", $amount[$i],PDO::PARAM_STR);
            $stmt->bindParam("nameactivity",$nameactivity[$i] ,PDO::PARAM_STR);
            $stmt->bindParam("grant_play",$grant_play[$i] ,PDO::PARAM_STR);
            $stmt->bindParam("price", $price[$i],PDO::PARAM_INT);
            $stmt->bindParam("total_cash", $total_cash[$i],PDO::PARAM_STR);
            $stmt->bindParam("dateclose", $dateclose,PDO::PARAM_INT);
            $stmt->bindParam("seniorsoft", $seniorsoft,PDO::PARAM_STR);
            $stmt->bindParam("programcard", $programcard,PDO::PARAM_STR);
            $stmt->bindParam("balance", $balance,PDO::PARAM_STR);
            $stmt->bindParam("because", $because,PDO::PARAM_STR);
            $stmt->execute();
          /*  $query = $db->prepare("UPDATE customer_group SET daily_balance = daily_balance + 1  WHERE noseniorsoft=:billSeniorsoft");
            $query->bindParam("billSeniorsoft",$billSeniorsoft[$i] ,PDO::PARAM_STR);
            $query->execute(); */
          //  $db->commit();
        }
            $db = null;
            return true;
        
    } catch (PDOException $e) {
            $db = null;
           // $db->rollBack();
            echo '{"error":{"text":'. $e->getMessage() .'}}';
    }   
}

//-------------------------------------------------------close report

public function selectUserfoc($userid , $start_date , $end_date)
{
    require 'config.php';
    try {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM foc WHERE userid=:userid AND date BETWEEN :start_date AND :end_date");
        $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
        $stmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
        $stmt->bindParam(':end_date', $end_date, PDO::PARAM_STR);
        $stmt->execute();
        $number_filter_row  = $stmt->rowCount();
        $resultArray = array();
        while($result = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $temps = array();
            $temps[] = $result['groupid'];
            $temps[] = $result['groupname'];
            $temps[] = $result['price'];
            $temps[] = $result['amount'];
            $temps[] = $result['amount_activity'];
            $temps[] = $result['nameactivity'];
            $temps[] = $result['foc'];
            $temps[] = $result['cause'];
            $temps[] = $result['date'];
            $temps[] = $result['total'];
            $resultArray[] = $temps;
        }        

        function get_all_data($db)
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
        $db = null;
        return $output;
        } catch (PDOException $e) {
            $db = null;
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
}



public function getSumActivityX( $start_date , $end_date , $change)
{
    require 'config.php';
    try {
        $connect = getDB();
       
        $stmt = $connect->prepare("SELECT DISTINCT history.idactivity , history.idactivity_play , activity.nameactivity as name , activity_type.nameactivity 
        FROM history
        INNER JOIN activity_type as activity ON history.idactivity = activity.idactivity
        LEFT JOIN activity_type ON  history.idactivity_play = activity_type.idactivity
        WHERE history.idactivity =:change AND  date BETWEEN :start_date AND :end_date");
            $stmt->bindParam(':change', $change, PDO::PARAM_INT);
            $stmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
            $stmt->bindParam(':end_date', $end_date, PDO::PARAM_STR);
            $stmt->execute();
            $number_filter_row  = $stmt->rowCount();
            $resultArray = array();
            $resul = array();
            $total = 0;
            while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
            {   
                $resul = null;
                $idactivity_play = $data['idactivity_play'];
                $query = $connect->prepare("SELECT COUNT(idactivity_play) as total FROM history 
                WHERE idactivity =:change AND idactivity_play =:idactivity_play AND date BETWEEN :start_date AND :end_date");
                $query->bindParam(':change', $change, PDO::PARAM_INT);
                $query->bindParam(':idactivity_play', $idactivity_play, PDO::PARAM_INT);
                $query->bindParam(':start_date', $start_date, PDO::PARAM_STR);
                $query->bindParam(':end_date', $end_date, PDO::PARAM_STR);
                $query->execute();
                while($play = $query->fetch(PDO::FETCH_ASSOC)){
                    $resul[] = $play['total'];
                    $total = $total +$play['total'];
                }
               $temps = array();
               
               $temps[] = $data['name'];
               $temps[] = $data['nameactivity'];
               $temps[] = $resul;

               $resultArray[] = $temps;
            }
    
    
    function get_all_data($connect , $change , $start_date , $end_date)
    {
     $query = "SELECT idactivity_play FROM history WHERE idactivity =:change AND date BETWEEN :start_date AND :end_date";
     $statement = $connect->prepare($query);
     $statement->bindParam(':change', $change, PDO::PARAM_INT);
     $statement->bindParam(':start_date', $start_date, PDO::PARAM_STR);
     $statement->bindParam(':end_date', $end_date, PDO::PARAM_STR);
     $statement->execute();
     return $statement->rowCount();
    }
    $resultGet_all = get_all_data($connect ,$change ,$start_date , $end_date);
    $output = array(
     "draw"    => intval($_POST["draw"]),
     "recordsTotal"  =>  $resultGet_all,
     "recordsFiltered" => $number_filter_row,
     "data"    => $resultArray,
     "total" => $total
    );
    return $output;
    } catch (PDOException $e) {
        //throw $th;
    }
}

//close report --------------------------------------------

public function NotClosecash()
{
    require 'config.php';
    try{
        $db = getDB();
        $resultArray = array();
        $idcashReal = '0005';
        $datenow = date("Y-m-d");
        $stmt = $db->prepare("SELECT t1.userid , t1.noseniorsoft , t1.groupid , t1.groupname , t1.groupamount , t1.idpackage , t1.discount , t1.datein 
        , t1.dateout , SUM(t2.count_other) as total_play
          , t2.idactivity  , t4.price , t4.name FROM customer_group as t1
        INNER JOIN create_qrcodeuser as t2 ON t1.groupid = t2.groupid
        INNER JOIN activity_type as t3 ON t2.idactivity = t3.idactivity
        INNER JOIN package as t4 ON t1.idpackage = t4.idpackage
        WHERE  t1.idpackage =:idcashReal AND daily_balance = 0
        group by groupid
        ");
        $stmt->bindParam(':idcashReal', $idcashReal, PDO::PARAM_INT);
        $stmt->execute();
        $number_filter_row  = $stmt->rowCount();
        $resultArray = array();
        $total = 0;
        $totalPriceAc = 0;
        $price = null;
        $resulname = array();
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $resulname = null;
            $resulprice = null;
            $price = null;
            $totalPriceAc = 0;
            $userid = $data["groupid"];
            $idactivity = $data["idactivity"];
            $query = $db->prepare("SELECT DISTINCT  s1.count_other , s2.nameactivity , s2.price FROM create_qrcodeuser as s1 
            INNER JOIN activity_type as s2 ON s1.idactivity = s2.idactivity
            WHERE s1.groupid =:userid");
            $query->bindParam(':userid', $userid,PDO::PARAM_STR) ;
            $query->execute();
            while( $dataActivity = $query->fetch(PDO::FETCH_ASSOC))
            {   
                $temps1 = array();
                $totalprice = array();
                $temps1 = $dataActivity["nameactivity"]. '(' . $dataActivity['count_other'] . ')' ."<br>" ;
                $priceActivity = ($dataActivity["count_other"] * $dataActivity["price"]) ;
                $totalPriceAc = $totalPriceAc + $priceActivity;
                $resulname[] = $temps1;
            }      
            $temps = array();
            $price_total = ($data["groupamount"] * $totalPriceAc);
            $price_100 = ($price_total * $data["discount"]) / 100;
            $result = $price_total - $price_100;
            $total =+ $total + $result;
            $temps[] = $data["userid"];
            $temps[] = date("d-m-Y" , strtotime($data["datein"])) ;
            $temps[] = $data['noseniorsoft'];
            $temps[] = $data["groupamount"];
            $temps[] = $data["name"];
            $temps[] = $resulname;
            $temps[] = $data["total_play"];
            $temps[] = $totalPriceAc;
            $temps[]  = $data["discount"].'%';
            $temps[] = $price_100;
            $temps[] = number_format($result , 2);;
            $resultArray[] = $temps;
        }

        $output = array(
            "draw"    => intval($_POST["draw"]),
            "recordsTotal"  =>  0,
            "recordsFiltered" => 0,
            "data"    => $resultArray,
            "total" => number_format($total , 2)
           );

        return $output;
     
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function NotClosegroup()
{
    require 'config.php';
    try{
        $db = getDB();
        $resultArray = array();
        $idcashReal = '0006';
        $datenow = date("Y-m-d");
        $stmt = $db->prepare("SELECT t1.userid , t1.groupid , t1.groupname , t1.groupamount , t1.idpackage , t1.discount , t1.datein 
        , t1.dateout , SUM(t2.count_other) as total_play
          , t2.idactivity  , t4.price , t4.name FROM customer_group as t1
        INNER JOIN create_qrcodeuser as t2 ON t1.groupid = t2.groupid
        INNER JOIN activity_type as t3 ON t2.idactivity = t3.idactivity
        INNER JOIN package as t4 ON t1.idpackage = t4.idpackage
        WHERE  t1.idpackage =:idcashReal AND daily_balance = 0
        group by groupid
        ");
        $stmt->bindParam(':idcashReal', $idcashReal, PDO::PARAM_INT);
        $stmt->execute();
        $number_filter_row  = $stmt->rowCount();
        $resultArray = array();
        $total = 0;
        $totalPriceAc = 0;
        $price = null;
        $resulname = array();
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $resulname = null;
            $resulprice = null;
            $price = null;
            $totalPriceAc = 0;
            $userid = $data["groupid"];
            $idactivity = $data["idactivity"];
            $query = $db->prepare("SELECT DISTINCT  s1.count_other , s2.nameactivity , s2.price FROM create_qrcodeuser as s1 
            INNER JOIN activity_type as s2 ON s1.idactivity = s2.idactivity
            WHERE s1.groupid =:userid");
            $query->bindParam(':userid', $userid,PDO::PARAM_STR) ;
            $query->execute();
            while( $dataActivity = $query->fetch(PDO::FETCH_ASSOC))
            {   
                $temps1 = array();
                $totalprice = array();
                $temps1 = $dataActivity["nameactivity"]. '(' . $dataActivity['count_other'] . ')' ."<br>" ;
                $priceActivity = ($dataActivity["count_other"] * $dataActivity["price"]) ;
                $totalPriceAc = $totalPriceAc + $priceActivity;
                $resulname[] = $temps1;
            }      
            $temps = array();
            $price_total = ($data["groupamount"] * $totalPriceAc);
            $price_100 = ($price_total * $data["discount"]) / 100;
            $result = $price_total - $price_100;
            $total =+ $total + $result;
            $temps[] = $data["userid"];
            $temps[] = date("d-m-Y" , strtotime($data["datein"])) ;
            $temps[] = $data['groupid'];
            $temps[] = $data["groupamount"];
            $temps[] = $data["name"];
            $temps[] = $resulname;
            $temps[] = $data["total_play"];
            $temps[] = $totalPriceAc;
            $temps[]  = $data["discount"].'%';
            $temps[] = $price_100;
            $temps[] = number_format($result , 2);;
            $resultArray[] = $temps;
        }

        $output = array(
            "draw"    => intval($_POST["draw"]),
            "recordsTotal"  =>  0,
            "recordsFiltered" => 0,
            "data"    => $resultArray,
            "total" => number_format($total , 2)
           );

        return $output;
     
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function NotCloseOnline()
{
    require 'config.php';
    try{
        $db = getDB();
        $resultArray = array();
        $idcashReal = '0007';
        $datenow = date("Y-m-d");
        $stmt = $db->prepare("SELECT t1.userid , t1.groupid , t1.groupname , t1.groupamount , t1.idpackage , t1.discount , t1.datein 
        , t1.dateout , SUM(t2.count_other) as total_play
          , t2.idactivity  , t4.price , t4.name FROM customer_group as t1
        INNER JOIN create_qrcodeuser as t2 ON t1.groupid = t2.groupid
        INNER JOIN activity_type as t3 ON t2.idactivity = t3.idactivity
        INNER JOIN package as t4 ON t1.idpackage = t4.idpackage
        WHERE  t1.idpackage =:idcashReal AND daily_balance = 0
        group by groupid
        ");
        $stmt->bindParam(':idcashReal', $idcashReal, PDO::PARAM_INT);
        $stmt->execute();
        $number_filter_row  = $stmt->rowCount();
        $resultArray = array();
        $total = 0;
        $totalPriceAc = 0;
        $price = null;
        $resulname = array();
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $resulname = null;
            $resulprice = null;
            $price = null;
            $totalPriceAc = 0;
            $userid = $data["groupid"];
            $idactivity = $data["idactivity"];
            $query = $db->prepare("SELECT DISTINCT  s1.count_other , s2.nameactivity , s2.price FROM create_qrcodeuser as s1 
            INNER JOIN activity_type as s2 ON s1.idactivity = s2.idactivity
            WHERE s1.groupid =:userid");
            $query->bindParam(':userid', $userid,PDO::PARAM_STR) ;
            $query->execute();
            while( $dataActivity = $query->fetch(PDO::FETCH_ASSOC))
            {   
                $temps1 = array();
                $totalprice = array();
                $temps1 = $dataActivity["nameactivity"]. '(' . $dataActivity['count_other'] . ')' ."<br>" ;
                $priceActivity = ($dataActivity["count_other"] * $dataActivity["price"]) ;
                $totalPriceAc = $totalPriceAc + $priceActivity;
                $resulname[] = $temps1;
            }      
            $temps = array();
            $price_total = ($data["groupamount"] * $totalPriceAc);
            $price_100 = ($price_total * $data["discount"]) / 100;
            $result = $price_total - $price_100;
            $total =+ $total + $result;
            $temps[] = $data["userid"];
            $temps[] = date("d-m-Y" , strtotime($data["datein"])) ;
            $temps[] = $data['groupid'];
            $temps[] = $data["groupamount"];
            $temps[] = $data["name"];
            $temps[] = $resulname;
            $temps[] = $data["total_play"];
            $temps[] = $totalPriceAc;
            $temps[]  = $data["discount"].'%';
            $temps[] = $price_100;
            $temps[] = number_format($result , 2);;
            $resultArray[] = $temps;
        }

        $output = array(
            "draw"    => intval($_POST["draw"]),
            "recordsTotal"  =>  0,
            "recordsFiltered" => 0,
            "data"    => $resultArray,
            "total" => number_format($total , 2)
           );

        return $output;
     
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

//--------------------------------------------------------- pass close

public function passClosecash()
{
    require 'config.php';
    try{
        $db = getDB();
        $resultArray = array();
        $idcashReal = '0005';
        $datenow = date("Y-m-d");
        $stmt = $db->prepare("SELECT t1.userid , t1.noseniorsoft , t1.groupid , t1.groupname , t1.groupamount , t1.idpackage , t1.discount , t1.datein 
        , t1.dateout , SUM(t2.count_other) as total_play
          , t2.idactivity  , t4.price , t4.name FROM customer_group as t1
        INNER JOIN create_qrcodeuser as t2 ON t1.groupid = t2.groupid
        INNER JOIN activity_type as t3 ON t2.idactivity = t3.idactivity
        INNER JOIN package as t4 ON t1.idpackage = t4.idpackage
        WHERE  t1.idpackage =:idcashReal AND daily_balance = 1
        group by groupid
        ");
        $stmt->bindParam(':idcashReal', $idcashReal, PDO::PARAM_INT);
        $stmt->execute();
        $number_filter_row  = $stmt->rowCount();
        $resultArray = array();
        $total = 0;
        $totalPriceAc = 0;
        $price = null;
        $resulname = array();
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $resulname = null;
            $resulprice = null;
            $price = null;
            $totalPriceAc = 0;
            $userid = $data["groupid"];
            $idactivity = $data["idactivity"];
            $query = $db->prepare("SELECT DISTINCT  s1.count_other , s2.nameactivity , s2.price FROM create_qrcodeuser as s1 
            INNER JOIN activity_type as s2 ON s1.idactivity = s2.idactivity
            WHERE s1.groupid =:userid");
            $query->bindParam(':userid', $userid,PDO::PARAM_STR) ;
            $query->execute();
            while( $dataActivity = $query->fetch(PDO::FETCH_ASSOC))
            {   
                $temps1 = array();
                $totalprice = array();
                $temps1 = $dataActivity["nameactivity"]. '(' . $dataActivity['count_other'] . ')' ."<br>" ;
                $priceActivity = ($dataActivity["count_other"] * $dataActivity["price"]) ;
                $totalPriceAc = $totalPriceAc + $priceActivity;
                $resulname[] = $temps1;
            }      
            $temps = array();
            $price_total = ($data["groupamount"] * $totalPriceAc);
            $price_100 = ($price_total * $data["discount"]) / 100;
            $result = $price_total - $price_100;
            $total =+ $total + $result;
            $temps[] = $data["userid"];
            $temps[] = date("d-m-Y" , strtotime($data["datein"])) ;
            $temps[] = $data['noseniorsoft'];
            $temps[] = $data["groupamount"];
            $temps[] = $data["name"];
            $temps[] = $resulname;
            $temps[] = $data["total_play"];
            $temps[] = $totalPriceAc;
            $temps[]  = $data["discount"].'%';
            $temps[] = $price_100;
            $temps[] = number_format($result , 2);;
            $resultArray[] = $temps;
        }

        $output = array(
            "draw"    => intval($_POST["draw"]),
            "recordsTotal"  =>  0,
            "recordsFiltered" => 0,
            "data"    => $resultArray,
            "total" => number_format($total , 2)
           );

        return $output;
     
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function passClosegroup()
{
    require 'config.php';
    try{
        $db = getDB();
        $resultArray = array();
        $idcashReal = '0006';
        $datenow = date("Y-m-d");
        $stmt = $db->prepare("SELECT t1.userid , t1.groupid , t1.groupname , t1.groupamount , t1.idpackage , t1.discount , t1.datein 
        , t1.dateout , SUM(t2.count_other) as total_play
          , t2.idactivity  , t4.price , t4.name FROM customer_group as t1
        INNER JOIN create_qrcodeuser as t2 ON t1.groupid = t2.groupid
        INNER JOIN activity_type as t3 ON t2.idactivity = t3.idactivity
        INNER JOIN package as t4 ON t1.idpackage = t4.idpackage
        WHERE  t1.idpackage =:idcashReal AND daily_balance = 1
        group by groupid
        ");
        $stmt->bindParam(':idcashReal', $idcashReal, PDO::PARAM_INT);
        $stmt->execute();
        $number_filter_row  = $stmt->rowCount();
        $resultArray = array();
        $total = 0;
        $totalPriceAc = 0;
        $price = null;
        $resulname = array();
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $resulname = null;
            $resulprice = null;
            $price = null;
            $totalPriceAc = 0;
            $userid = $data["groupid"];
            $idactivity = $data["idactivity"];
            $query = $db->prepare("SELECT DISTINCT  s1.count_other , s2.nameactivity , s2.price FROM create_qrcodeuser as s1 
            INNER JOIN activity_type as s2 ON s1.idactivity = s2.idactivity
            WHERE s1.groupid =:userid");
            $query->bindParam(':userid', $userid,PDO::PARAM_STR) ;
            $query->execute();
            while( $dataActivity = $query->fetch(PDO::FETCH_ASSOC))
            {   
                $temps1 = array();
                $totalprice = array();
                $temps1 = $dataActivity["nameactivity"]. '(' . $dataActivity['count_other'] . ')' ."<br>" ;
                $priceActivity = ($dataActivity["count_other"] * $dataActivity["price"]) ;
                $totalPriceAc = $totalPriceAc + $priceActivity;
                $resulname[] = $temps1;
            }      
            $temps = array();
            $price_total = ($data["groupamount"] * $totalPriceAc);
            $price_100 = ($price_total * $data["discount"]) / 100;
            $result = $price_total - $price_100;
            $total =+ $total + $result;
            $temps[] = $data["userid"];
            $temps[] = date("d-m-Y" , strtotime($data["datein"])) ;
            $temps[] = $data['groupid'];
            $temps[] = $data["groupamount"];
            $temps[] = $data["name"];
            $temps[] = $resulname;
            $temps[] = $data["total_play"];
            $temps[] = $totalPriceAc;
            $temps[]  = $data["discount"].'%';
            $temps[] = $price_100;
            $temps[] = number_format($result , 2);;
            $resultArray[] = $temps;
        }

        $output = array(
            "draw"    => intval($_POST["draw"]),
            "recordsTotal"  =>  0,
            "recordsFiltered" => 0,
            "data"    => $resultArray,
            "total" => number_format($total , 2)
           );

        return $output;
     
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


public function passCloseOnline()
{
    require 'config.php';
    try{
        $db = getDB();
        $resultArray = array();
        $idcashReal = '0007';
        $datenow = date("Y-m-d");
        $stmt = $db->prepare("SELECT t1.userid , t1.groupid , t1.groupname , t1.groupamount , t1.idpackage , t1.discount , t1.datein 
        , t1.dateout , SUM(t2.count_other) as total_play
          , t2.idactivity  , t4.price , t4.name FROM customer_group as t1
        INNER JOIN create_qrcodeuser as t2 ON t1.groupid = t2.groupid
        INNER JOIN activity_type as t3 ON t2.idactivity = t3.idactivity
        INNER JOIN package as t4 ON t1.idpackage = t4.idpackage
        WHERE  t1.idpackage =:idcashReal AND daily_balance = 1
        group by groupid
        ");
        $stmt->bindParam(':idcashReal', $idcashReal, PDO::PARAM_INT);
        $stmt->execute();
        $number_filter_row  = $stmt->rowCount();
        $resultArray = array();
        $total = 0;
        $totalPriceAc = 0;
        $price = null;
        $resulname = array();
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $resulname = null;
            $resulprice = null;
            $price = null;
            $totalPriceAc = 0;
            $userid = $data["groupid"];
            $idactivity = $data["idactivity"];
            $query = $db->prepare("SELECT DISTINCT  s1.count_other , s2.nameactivity , s2.price FROM create_qrcodeuser as s1 
            INNER JOIN activity_type as s2 ON s1.idactivity = s2.idactivity
            WHERE s1.groupid =:userid");
            $query->bindParam(':userid', $userid,PDO::PARAM_STR) ;
            $query->execute();
            while( $dataActivity = $query->fetch(PDO::FETCH_ASSOC))
            {   
                $temps1 = array();
                $totalprice = array();
                $temps1 = $dataActivity["nameactivity"]. '(' . $dataActivity['count_other'] . ')' ."<br>" ;
                $priceActivity = ($dataActivity["count_other"] * $dataActivity["price"]) ;
                $totalPriceAc = $totalPriceAc + $priceActivity;
                $resulname[] = $temps1;
            }      
            $temps = array();
            $price_total = ($data["groupamount"] * $totalPriceAc);
            $price_100 = ($price_total * $data["discount"]) / 100;
            $result = $price_total - $price_100;
            $total =+ $total + $result;
            $temps[] = $data["userid"];
            $temps[] = date("d-m-Y" , strtotime($data["datein"])) ;
            $temps[] = $data['groupid'];
            $temps[] = $data["groupamount"];
            $temps[] = $data["name"];
            $temps[] = $resulname;
            $temps[] = $data["total_play"];
            $temps[] = $totalPriceAc;
            $temps[]  = $data["discount"].'%';
            $temps[] = $price_100;
            $temps[] = number_format($result , 2);;
            $resultArray[] = $temps;
        }

        $output = array(
            "draw"    => intval($_POST["draw"]),
            "recordsTotal"  =>  0,
            "recordsFiltered" => 0,
            "data"    => $resultArray,
            "total" => number_format($total , 2)
           );

        return $output;
     
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


//-------------------------------------------------------

public function listTypeActivity()
{
    require 'config.php';
    try{
        $db = getDB();
        $stmt = $db->prepare("SELECT idactivity , nameactivity  FROM activity_type WHERE idactivity = 6137 OR idactivity = 6138 OR idactivity = 6139"); 
        $stmt->execute();
        //User data
        $resultArray = array();
        
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
           $temps = $data;
           array_push($resultArray  ,$temps);
        }
        $db = null;
        return $resultArray;

        
    }
    catch(PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function getRecard($customerid)
{
    require 'config.php';
    try{
    $db = getDB();
    $stmt = $db->prepare("SELECT t1.groupid , t1.groupid_number , t1.other , t1.idactivity , t1.count_other , t2.nameactivity 
    FROM create_qrcodeuser as t1
    INNER JOIN activity_type as t2 ON t1.idactivity = t2.idactivity
    WHERE groupid_number=:customerid");
    $stmt->bindParam(':customerid' , $customerid,PDO::PARAM_STR);
    $stmt->execute();
    $resultArray = array();

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $temps = array();
            $temps = $data;
        
            array_push($resultArray  ,$temps);
        }
        $db = null;
        return $resultArray;

    }
    catch(PDOException $e) {
        $db = null;
    echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}



public function editQrCode($groupid , $group_number , $amount ,$other , $idactivity ,$datein ,$dateout)
{
    require 'config.php';
    try {
        $db = getDB();            
                for ($i = 1; $i <= $amount; $i++) {
                    $cusnumber = $group_number . "-" . $i;
                    
                                $stmt = $db->prepare("INSERT INTO create_qrcodeuser(groupid , groupid_number , other , idactivity , count_other ,datein ,dateout) VALUES (:groupid,:group_number,:other ,:idactivity ,:other ,:datein ,:dateout)");
                                $stmt->bindParam("groupid",$groupid ,PDO::PARAM_STR) ;
                                $stmt->bindParam("group_number",$cusnumber ,PDO::PARAM_STR) ;
                                $stmt->bindParam("other",$other ,PDO::PARAM_STR) ;
                                $stmt->bindParam("idactivity",$idactivity ,PDO::PARAM_INT) ;
                                $stmt->bindParam("other",$other ,PDO::PARAM_STR) ;
                                $stmt->bindParam("datein",$datein ,PDO::PARAM_STR) ;
                                $stmt->bindParam("dateout",$dateout ,PDO::PARAM_STR) ;
                                $stmt->execute();
            }
           
        $db = null;
        return true;
    } catch (PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
        $db = null;
        return false;
    }   
}

public function moneyReal()
{
    require 'config.php';
    try {
        $db = getDB();
        $query = $db->prepare("SELECT * FROM customer_group where idpackage = 0005 or idpackage = 0011 order by groupid ASC "); 
        $query->execute();
        $count=$query->rowCount();
        if(!$count){
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $temp = array();
                $temp = $row['groupid'];
            }
            $maxId = "00000";
            $yearMonth = substr(date("Y")+543 , -2).date("m");
            $test = $yearMonth.$maxId + 1;
        }else{
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $temp = array();
                $temp = $row['groupid'];
            }
            $maxId = substr($temp, -5);
            $yearMonth = substr(date("Y")+543 , -2).date("m");
            $test = $yearMonth.$maxId + 1;
        }
        
       
        
        return $test;
        
    } catch (PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }    
}

public function moneyNewyear()
{
    require 'config.php';
    try {
        $db = getDB();
        $query = $db->prepare("SELECT * FROM customer_group where idpackage = 0013 order by groupid ASC "); 
        $query->execute();
        $count=$query->rowCount();
        if(!$count){
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $temp = array();
                $temp = $row['groupid'];
            }
            $maxId = "99000";
            $yearMonth = substr(date("Y")+543 , -2).date("m");
            $test = $yearMonth.$maxId + 1;
        }else{
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $temp = array();
                $temp = $row['groupid'];
            }
            $maxId = substr($temp, -5);
            $yearMonth = substr(date("Y")+543 , -2).date("m");
            $test = $yearMonth.$maxId + 1;
        }
        
       
        
        return $test;
        
    } catch (PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }    
}

public function moneyFarmRealBill()
{
    require 'config.php';
    try {
        $db = getDB();
        $query = $db->prepare("SELECT * FROM customer_group where idpackage IN (0012,0015) order by groupid ASC "); 
        $query->execute();
        $count=$query->rowCount();
        if(!$count){
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $temp = array();
                $temp = $row['groupid'];
            }
            $maxId = "000000";
            $yearMonth = substr(date("Y")+543 , -2).date("m");
            $test = $yearMonth.$maxId + 1;
        }else{
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $temp = array();
                $temp = $row['groupid'];
            }
            $maxId = substr($temp, -6);
            $yearMonth = substr(date("Y")+543 , -2).date("m");
            $test =  $yearMonth.$maxId + 1;
        }
        
       
        
        return $test;
        
    } catch (PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }    
}



public function getNoseniorsoftById($id)
{
    require 'config.php';
    try {
        $db = getDB();
        $query = $db->prepare("SELECT * FROM customer_group where groupid =:id"); 
        $query->bindParam('id' , $id , PDO::PARAM_STR);
        $query->execute();
        $count=$query->rowCount();
        $output = array();
        if($count){
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $temp = array();
                $temp = $row;
                array_push($output , $temp);
            }
        }else{
           return false;
        }
        
       
        $db = null;
        return $output;
        
    } catch (PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }    
}

public function updateSenior($Idbill , $seniorsoft)
{
    require 'config.php';
    try {
        $connect = getDB();
        $stmt = $connect->prepare('UPDATE customer_group SET  noseniorsoft=:seniorsoft WHERE groupid=:Idbill');
        $stmt->bindParam('seniorsoft' , $seniorsoft ,PDO::PARAM_STR);
        $stmt->bindParam('Idbill' , $Idbill , PDO::PARAM_STR);
        if($stmt->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
        
    } catch (PDOEception $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function getNumberRang()
{
    require 'config.php';
    try {
        $db = getDB();
        $query = $db->prepare("SELECT * FROM customer_group WHERE noseniorsoft = '0' AND idpackage = '0011'"); 
        $query->execute();
        $result=$query->fetchAll();
        return $query->rowCount();
        
        
    } catch (PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }    
}


public function PackageBerry_Tour()
{
    require 'config.php';
    try{
        $db = getDB();
        $stmt = $db->prepare("SELECT idactivity , nameactivity FROM activity_type 
        WHERE idactivity = 6136 "); 
        $stmt->execute();
        //User data
        $resultArray = array();
        
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
           $temps = $data;
           array_push($resultArray  ,$temps);
        }
        $db = null;
        return $resultArray;

    }
    catch(PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function PackageBerry_Tour2()
{
    require 'config.php';
    try{
        $db = getDB();
        $stmt = $db->prepare("SELECT idactivity , nameactivity FROM activity_type 
        WHERE  idactivity = 6168 "); 
        $stmt->execute();
        //User data
        $resultArray = array();
        
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
           $temps = $data;
           array_push($resultArray  ,$temps);
        }
        $db = null;
        return $resultArray;

    }
    catch(PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function PackageBerry_Tour3()
{
    require 'config.php';
    try{
        $db = getDB();
        $stmt = $db->prepare("SELECT idactivity , nameactivity FROM activity_type 
        WHERE  idactivity = 6169 "); 
        $stmt->execute();
        //User data
        $resultArray = array();
        
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
           $temps = $data;
           array_push($resultArray  ,$temps);
        }
        $db = null;
        return $resultArray;

    }
    catch(PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function PackageBerry_Tour4()
{
    require 'config.php';
    try{
        $db = getDB();
        $stmt = $db->prepare("SELECT idactivity , nameactivity FROM activity_type 
        WHERE idactivity = 6172"); 
        $stmt->execute();
        //User data
        $resultArray = array();
        
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
           $temps = $data;
           array_push($resultArray  ,$temps);
        }
        $db = null;
        return $resultArray;

    }
    catch(PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


public function PackageFarm_Tour1()
{
    require 'config.php';
    try{
        $db = getDB();
        $stmt = $db->prepare("SELECT idactivity , nameactivity FROM activity_type 
        WHERE idactivity = 6173"); 
        $stmt->execute();
        //User data
        $resultArray = array();
        
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
           $temps = $data;
           array_push($resultArray  ,$temps);
        }
        $db = null;
        return $resultArray;

    }
    catch(PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


public function PackageFarm_Tour2()
{
    require 'config.php';
    try{
        $db = getDB();
        $stmt = $db->prepare("SELECT idactivity , nameactivity FROM activity_type 
        WHERE idactivity = 6174"); 
        $stmt->execute();
        //User data
        $resultArray = array();
        
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
           $temps = $data;
           array_push($resultArray  ,$temps);
        }
        $db = null;
        return $resultArray;

    }
    catch(PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function PackageFarm_Tour21()
{
    require 'config.php';
    try{
        $db = getDB();
        $stmt = $db->prepare("SELECT idactivity , nameactivity FROM activity_type 
        WHERE idactivity = 6143"); 
        $stmt->execute();
        //User data
        $resultArray = array();
        
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
           $temps = $data;
           array_push($resultArray  ,$temps);
        }
        $db = null;
        return $resultArray;

    }
    catch(PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


public function PackageFarm_Pizza()
{
    require 'config.php';
    try{
        $db = getDB();
        $stmt = $db->prepare("SELECT idactivity , nameactivity FROM activity_type 
        WHERE idactivity = 6129"); 
        $stmt->execute();
        //User data
        $resultArray = array();
        
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
           $temps = $data;
           array_push($resultArray  ,$temps);
        }
        $db = null;
        return $resultArray;

    }
    catch(PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function FarmPackage3()
{
    require 'config.php';
    try{
        $db = getDB();
        $stmt = $db->prepare("SELECT idactivity , nameactivity FROM activity_type 
        WHERE idactivity = 6172"); 
        $stmt->execute();
        //User data
        $resultArray = array();
        
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
           $temps = $data;
           array_push($resultArray  ,$temps);
        }
        $db = null;
        return $resultArray;

    }
    catch(PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function FarmPackage32()
{
    require 'config.php';
    try{
        $db = getDB();
        $stmt = $db->prepare("SELECT idactivity , nameactivity FROM activity_type 
        WHERE idactivity = 6171"); 
        $stmt->execute();
        //User data
        $resultArray = array();
        
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
           $temps = $data;
           array_push($resultArray  ,$temps);
        }
        $db = null;
        return $resultArray;

    }
    catch(PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function FarmTogether()
{
    require 'config.php';
    try{
        $db = getDB();
        $stmt = $db->prepare("SELECT idactivity , nameactivity FROM activity_type 
        WHERE idactivity in (6170, 6197, 6129, 6144, 6131, 6125, 6198, 6199)"); 
        $stmt->execute();
        //User data
        $resultArray = array();
        
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
           $temps = $data;
           array_push($resultArray  ,$temps);
        }
        $db = null;
        return $resultArray;

    }
    catch(PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

public function CountDoor()
{
    require 'config.php';
    try{
        $db = getDB();
        $stmt = $db->prepare("SELECT idactivity , nameactivity FROM activity_type 
        WHERE idactivity = 6177"); 
        $stmt->execute();
        //User data
        $resultArray = array();
        
        while( $data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
           $temps = $data;
           array_push($resultArray  ,$temps);
        }
        $db = null;
        return $resultArray;

    }
    catch(PDOException $e) {
        $db = null;
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


    public function getDetailCustomer($draw,$start_date, $end_date)
    {
        require 'config.php';
        try {
            $connect = getDB();
            $query = $connect->prepare("SELECT cus.groupid, cus.groupname, cus.groupamount, 
            cus.group_amount_activity, cus.datein, cus.dateout, cus.money_customer, cus.permission_manager,
            cus.note
            FROM customer_group  as cus
            WHERE cus.idpackage IN (0001,0002,0003,0004,0006,0007,0008,0009,0010) AND cus.datein BETWEEN :start_date AND :end_date
            GROUP BY cus.groupid ");
            $query->bindParam(':start_date', $start_date, PDO::PARAM_STR);
            $query->bindParam(':end_date', $end_date, PDO::PARAM_STR);
            $query->execute();
            $resultArray = array();
            $resultArrayActivity = array();
            while($data = $query->fetch(PDO::FETCH_ASSOC))
            {
                $resultArrayActivity = null;
                $customerid = $data['groupid'];
                $selectActivity = $connect->prepare('SELECT DISTINCT cre.count_other, ac.idactivity , ac.nameactivity FROM create_qrcodeuser as cre
                INNER JOIN activity_type as ac ON cre.idactivity = ac.idactivity
                WHERE groupid=:customerid');
                $selectActivity->bindParam("customerid",$customerid,PDO::PARAM_STR);
                $selectActivity->execute();
                while($show = $selectActivity->fetch(PDO::FETCH_ASSOC))
                {
                    $activity = array();
                    $countActivity = null;
                    $countActivity = $show['count_other'];
                    $activity[] = $show['idactivity'];
                    $activity[] = $show['nameactivity'] . ' (' . $show['count_other'] . ')';
                    $resultArrayActivity[] = $activity;
                }

                $create = array();
                $create[] = $data['groupid'];
                $create[] = $data['groupname'];
                $create[] = $data['groupamount'];
                $create[] = $data['group_amount_activity'];
                $create[] = $resultArrayActivity;
                $create[] = $data['datein'];
                $create[] = $data['dateout'];
                $create[] = $data['money_customer'];
                $create[] = $data['permission_manager'];
                $create[] = $data['note'];
                
                array_push($resultArray, $create);
            }

            $output = array(
                "draw"    => intval($draw),
                "recordsTotal"  =>  0,
                "recordsFiltered" => 0,
                "data"    => $resultArray
               );
            $connect = null;
            return $output;
        } catch (PDOException $e) {
            $connect = null;
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }

    public function exportDataCashCard()
    {
        require 'config.php';
        try {
            $connect = getDB();
            $sql = $connect->prepare('SELECT  SUM(c.other) as play ,SUM(c.count_other) as total, a.nameactivity
            FROM activity_type as a
            INNER JOIN create_qrcodeuser as c ON c.idactivity = a.idactivity
            GROUP BY a.idactivity');
            $sql->execute();
            $output = array();
            $row = $sql->fetchAll();
            $i = 0;
            foreach ($row as $data) {
                $get = array();
                $i = $i +1 ;
                $get['no'] = $i;
                $get['play']     = $data['play'];
                $get['count_other11']     = $data['total'];
                $get['nameactivity'] = $data['nameactivity'];
                $output[] = $get;
            }
            return $output;
        } catch (PDOEXception $e) {
            $connect = null;
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }


}
?>
