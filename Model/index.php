<?php

require_once('DbOperation.php');
$response = array(); 
$input = file_get_contents('php://input');
define('LINE_API',"https://notify-api.line.me/api/notify");
if(!empty($_POST['type']))
{
    
    $type = $_POST['type'];

   switch ($type) {
       case 'login':
            if(isset($_POST['email']) && isset($_POST['password']))
            {
                $user = new userClass();
                $email = $_POST['email'];
                $pass = $_POST['password'];
                $result = $user->userLogin($email , $pass);
                if($result === TRUE)
                {
                    $response['error'] = true;
                }
                else
                {
                    $response['error'] = false;
                    $response['message'] = 'กรุณาตรวจสอบ อีเมล์ หรือ รหัสผ่าน ! !';
                }
            }
           break;
        case 'checkgroup':
        $user = new userClass();
        $customerid = $_POST['cusid'];
        $check = $user->checkGroupcard($customerid);
        if($check === TRUE){
            echo $check;
        }else{
            echo $check;
        }

        break;
        case 'create':
            if(isset($_POST['cusid']) && isset($_POST['codecus']) && isset($_POST['amount']) && isset($_POST['change'])
            && isset($_POST['userid']) && isset($_POST['package']) && isset($_POST['departner']) && isset($_POST['note']))
            {
                $user = new userClass();
                $customerid = $_POST['cusid'];
                $codecus = $_POST['codecus'];
                $amount = $_POST['amount'];
                $chagebx = $_POST['change'];
                $datein = $_POST['datein'];
                $dateout = $_POST['dateout'];
                $listActivity = $_POST['listactivity'];
                $userid = $_POST['userid'];
                $package = $_POST['package'];
                $getPermission = $_POST['permiss'];
                $getMoney = $_POST['money'];
                $department = $_POST['departner'];
                $note = $_POST['note'];
                
                    $create = $user->createGroupcard($customerid , $codecus , $amount , $package , $chagebx , $datein ,$dateout , $getPermission, $getMoney, $note, $userid);
                    if($create === TRUE)    
                    {
                        $grant_Ac = 1;
                        $result = $user->createQrCode($customerid , $customerid , $amount ,$grant_Ac , $listActivity ,$datein , $dateout);
                        if($result === TRUE){
                            $response['error'] = true;
                            $response['message'] = 'บันทึกข้อมูลเรียบร้อย';
                            $token = "zlei15X0rJ6O4eFNvgAwfGz683zTk0rxQh8IHSDn1pd"; //ใส่Token ที่copy เอาไว้
                            $str ="\n". "รหัสกรุ๊ป : " .$customerid . "\n"."ชื่อกรุ๊ป : " .$codecus."\n". "จำนวนบัตร " . $amount . "ใบคะ" ."\n". "เช็คอิน : " . date("d-m-Y" , strtotime($datein)) ."\n". "เช็คเอ้าท์ : ".date("d-m-Y" , strtotime($dateout)); 
                            //send notify printer
                            notify_message($str,$token);
                            $qrcodeMoney ="\n" ."แผนก : " .$department . "\n". "รหัสกรุ๊ป : " .$customerid . "\n"."ชื่อกรุ๊ป : " .$codecus."\n". "จำนวนบัตร : " . $amount . "ใบคะ" ."\n". "เช็คอิน : " . date("d-m-Y" , strtotime($datein))
                             ."\n". "เช็คเอ้าท์ : ".date("d-m-Y" , strtotime($dateout)) . "\n" ."จำนวนที่เก็บลูกค้า : " . number_format($getMoney , 2) . "\n" . "ผู้อนุญาติ : " . $getPermission . "\n" . "หมายเหตุ : " .$note; 
                            $token_money = "vjPvbnRB4LnGtsRBDnaaalLOMYwAoZVFEfnFybWEmg7"; //Token ของจริง แจ้งMD คุณเล็ก
                            //send notify money = >
                            notify_message($qrcodeMoney , $token_money);
                        }else{
                            $response['error'] = false;
                            $response['message'] = 'ไม่สามารถบันทึกข้อมูลได้กรุณาลองใหม่อีกครั้ง ! !';
                        }
                    }
                    else
                    {
                        $response['error'] = false;
                        $response['message'] = $create . 'ท่านได้เพิ่มข้อมูล ID กรุ๊ปนี้แล้ว';
                    }
                
                
               
            }
            else
            {
                $response['error'] = false;
                $response['message'] ='กรุณาตรวจสอบข้อมูล';
            }
            break;

            case 'createRealMoney':
            if(isset($_POST['cusid']) && isset($_POST['codecus']) && isset($_POST['amount']) && isset($_POST['change'])
            && isset($_POST['userid']) && isset($_POST['package']) && isset($_POST['seniorsoft']))
            {
                $user = new userClass();
                $seniorsoft = $_POST['seniorsoft'];
                $customerid = $_POST['cusid'];
                $codecus = $_POST['codecus'];
                $amount = $_POST['amount'];
                $chagebx = $_POST['change'];
                $datein = $_POST['datein'];
                $dateout = $_POST['dateout'];
                $listActivity = $_POST['listactivity'];
                $userid = $_POST['userid'];
                $package = $_POST['package'];
                $discount = $_POST['discount'];
                
                    $create = $user->createRealMoney($seniorsoft ,$customerid , $codecus , $amount , $package , $chagebx , $datein ,$dateout , $discount , $userid);
                    if($create === TRUE)    
                    {
                        $grant_Ac = 1;
                        $result = $user->createQrCode($customerid , $customerid , $amount ,$grant_Ac , $listActivity ,$datein , $dateout);
                        if($result === TRUE){
                            $response['error'] = true;
                            $response['message'] = 'บันทึกข้อมูลเรียบร้อย';
                        }else{
                            $response['error'] = false;
                            $response['message'] = 'ไม่สามารถบันทึกข้อมูลได้กรุณาลองใหม่อีกครั้ง ! !';
                        }
                    }
                    else
                    {
                        $response['error'] = false;
                        $response['message'] = $create . 'ท่านได้เพิ่มข้อมูล ID กรุ๊ปนี้แล้ว';
                    }
                
                
               
            }
            else
            {
                $response['error'] = false;
                $response['message'] ='กรุณาตรวจสอบข้อมูล';
            }
            break;
        
        case 'register':
            
            if(!empty($_POST['userid']) || !empty($_POST['fname']) || !empty($_POST['lname']) 
            && !empty($_POST['email']) || empty($_POST['password']) || !empty($_POST['status']))
            {
                $userid = $_POST['userid'];
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $status = $_POST['status'];
                $user = new userClass();
                $addUserRegister = $user->userRegistration($userid , $fname , $lname ,$email , $password ,$status);
                if($addUserRegister === TRUE)
                {
                    $response['error'] = true;
                    $response['message'] = 'บันทึกข้อมูลเรียบร้อย';
                }
                else
                {
                    $response['error'] = false;
                    $response['message'] = $addUserRegister;
                }
            }
            else
            {
                    $response['error'] = false;
                    $response['message'] = 'กรุณาตรวจสอบข้อมูล';
            }
           
            
            break;

        case 'editUser':
                    $userid = $_POST['userid'];
                    $fname = $_POST['fname'];
                    $lname = $_POST['lname'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $status = $_POST['status'];
                    $user = new userClass();
                    $editUsers = $user->editUser($userid , $fname , $lname , $email , $password , $status);
                    if($editUsers === TRUE)
                    {
                        $response['error'] = true;
                        $response['message'] = 'บันทึกข้อมูลเรียบร้อย';
                    }
                    else
                    {
                        $response['error'] = false;
                        $response['message'] = 'ขออภัย อัพเดทข้อมูลล้มเหลว กรุณาลองใหม่อีกครั้ง ! !';
                    }

            break;

        case 'activity_type':
            $user = new userClass();
            $bj = $user->activityDetails();
            echo json_encode($bj);
            break;
        
        case 'setting_user':
            $user = new userClass();
            $obj = $user->settingUsers();
            $response['message'] = $obj;
            break;

        case 'list_historyCustomer':
            
            if(isset($_POST['customerid'])){
                $customerid = $_POST['customerid'];
                $user = new userClass();
                $listName = $user->listHitoryCustomer($customerid);
                
                if(count($listName) <= 0){
                    $response['error'] = false;
                    $response['message'] = 'ไม่พบข้อมูลผู้ใช้ ID ' .$customerid.' นี้';
                }else{
                    $response['message'] = $listName;
                }
            }else{
                $response['message'] = 'กรุณาตรวจสอบ ID ของลูกค้า';
            }
            break;

           

        case 'delete':
            if(!empty($_POST['userid']))
            {
                $userid = $_POST['userid'];
                $user = new UserClass();
                $userObject = $user->deleteUser($userid);
                if($userObject === TRUE)
                {
                    $response['error'] = TRUE;
                    $response['message'] = 'ลบข้อมูลสำเร็จ';
                }
                else
                {
                    $response['error'] = FALSE;
                    $response['message'] = 'ขออภัย ลบข้อมูลล้มเหลว ! !';
                }
            }
            break;

           

        case 'qrcode':
            $data1 = $_POST['data1'];
            $data2 = $_POST['data2'];
            $countother = $_POST['other'];
            $idactivity = $_POST['idactivity'];
            $user = new userClass();
            $result = $user->createQrCode($data1 , $data2 , $countother , $idactivity);
            if($result){
                echo $result;
            }else
            {
                echo $result;
            }
            break;

        case 'loadReinstate':
            $user = new userClass();
            $obj = $user->loadReinstate();
            $response['message'] = $obj;
            break;

        case 'updateReinstate':
            if(!empty($_POST['groupid_no']) && !empty($_POST['idactivity']))
            {
                $userid = $_POST['groupid_no'];
                $idactivity = $_POST['idactivity'];
                $time = $_POST['time'];
                $user = new userClass();
                $updateGrant = $user->updateGrantCustomer($userid , $idactivity , $time);
                if($updateGrant === TRUE){
                    $response['message'] = 'คืนสิทธิ์เรียบร้อย';
                }else{
                    $response['message'] = 'คืนสิทธิ์ล้มเหลว กรุณาลองใหม่อีกครั้ง !';
                }
            }else{
                $response['message'] = 'กรุณาตรวจสอบข้อมูล';
            }
            break;
        
        case 'loadPackage' :
            $user = new userClass();
            $obj = $user->packageDetails();
            $response['message'] = $obj;
            break;

        case 0007 :
                $user = new userClass();
                $obj = $user->packageDetailsOnline();
                $response['message'] = $obj;
        break;

        case 0006 :
            $user = new userClass();
            $obj = $user->packageDetailsGroup();
            $response['message'] = $obj;
        break;

            case 'realMoneyPackage' :
            $user = new userClass();
            $obj = $user->realMoneyPackage();
            $response['message'] = $obj;
            break;

        case 'SeleactLaserGame' :
                $user = new userClass();
                $obj = $user->SeleactLaserGame();
                $response['message'] = $obj;
        break;

        case 1212 :
            $user = new userClass();
            $obj = $user->SeleactStorefarm();
            $response['message'] = $obj;
        break;

        case 1515 :
            $user = new userClass();
            $obj = $user->SeleactStorefarm0015();
            $response['message'] = $obj;
        break;


        case 'SeleactStoreNewYear' :
            $user = new userClass();
            $obj = $user->SeleactStoreNewYear();
            $response['message'] = $obj;
        break;

        case 'activityNewYear' :
            $user = new userClass();
            $obj = $user->activityNewYear();
            $response['message'] = $obj;
        break;

        case 'PackageBerry_Tour' :
            $user = new userClass();
            $obj = $user->PackageBerry_Tour();
            $response['message'] = $obj;
        break;

        case 'PackageBerry_Tour2' :
            $user = new userClass();
            $obj = $user->PackageBerry_Tour2();
            $response['message'] = $obj;
        break;

        case 'PackageBerry_Tour3' :
            $user = new userClass();
            $obj = $user->PackageBerry_Tour3();
            $response['message'] = $obj;
        break;

        case 'PackageBerry_Tour4' :
            $user = new userClass();
            $obj = $user->PackageBerry_Tour4();
            $response['message'] = $obj;
        break;

        case 'PackageFarm_Tour1' :
            $user = new userClass();
            $obj = $user->PackageFarm_Tour1();
            $response['message'] = $obj;
        break;

        case 'PackageFarm_Tour2' :
            $user = new userClass();
            $obj = $user->PackageFarm_Tour2();
            $response['message'] = $obj;
        break;
        
        case 'PackageFarm_Tour2-1' :
            $user = new userClass();
            $obj = $user->PackageFarm_Tour21();
            $response['message'] = $obj;
        break;

        case 'PackageFarm_TourPizza' :
            $user = new userClass();
            $obj = $user->PackageFarm_Pizza();
            $response['message'] = $obj;
        break;

        case 'FarmPackage3' :
            $user = new userClass();
            $obj = $user->FarmPackage3();
            $response['message'] = $obj;
        break;

        case 'FarmPackage32' :
            $user = new userClass();
            $obj = $user->FarmPackage32();
            $response['message'] = $obj;
        break;

        case 'Farmtogether' :
            $user = new userClass();
            $obj = $user->FarmTogether();
            $response['message'] = $obj;
        break;

        case 'countDoor' :
            $user = new userClass();
            $obj = $user->CountDoor();
            $response['message'] = $obj;
        break;
            
        case 'userList' :
        $user = new userClass();
        $obj = $user->userList();
        $response['message'] = $obj;
            break;

        case 'type-activity' :
            $user = new userClass();
            $obj = $user->listTypeActivity();
            $response['message'] = $obj;
        break;

        case 'selectUserfoc' :
            if(isset($_POST['userid']) && isset($_POST['start_date']) && isset($_POST['end_date']))
            {
                $userid = $_POST['userid'];
                $start_date = $_POST['start_date'];
                $end_date = $_POST['end_date'];
                $user = new userClass();
                $obj = $user->selectUserfoc($userid , $start_date , $end_date);
                echo json_encode($obj);
            }else{
                $response['message'] = 'กรุณาตรวจสอบข้อมูล';
            }
            
            
        break;

        case 'loadClosing' :
            if(isset($_POST['date'])){
                $user = new userClass();
                $obj = $user->closingReport($_POST['date']);
                if(count($obj) > 0){
                    $response['error'] = true;
                    $response['message'] = $obj;
                }else{
                    $response['error'] = false;
                    $response['message'] = 'ไม่พบข้อมูลวันที่เลือก';
                }
              
            }else{
                $response['error'] = false;
                $response['message'] = 'ไม่พบข้อมูลคะ';
            }
            break;

            case 'LoadCloseLaser' :
                if(isset($_POST['date'])){
                    $user = new userClass();
                    $obj = $user->closingReportLaserGame($_POST['date']);
                    if(count($obj) > 0){
                        $response['error'] = true;
                        $response['message'] = $obj;
                    }else{
                        $response['error'] = false;
                        $response['message'] = 'ไม่พบข้อมูลวันที่เลือก';
                    }
                  
                }else{
                    $response['error'] = false;
                    $response['message'] = 'ไม่พบข้อมูลคะ';
                }
                break;

                case 'LoadClosefarm' :
                    if(isset($_POST['date'])){
                        $user = new userClass();
                        $obj = $user->closingReportfarm($_POST['date']);
                        if(count($obj) > 0){
                            $response['error'] = true;
                            $response['message'] = $obj;
                        }else{
                            $response['error'] = false;
                            $response['message'] = 'ไม่พบข้อมูลวันที่เลือก';
                        }
                      
                    }else{
                        $response['error'] = false;
                        $response['message'] = 'ไม่พบข้อมูลคะ';
                    }
                    break;


                    case 'LoadCloseSheep' :
                        if(isset($_POST['date'])){
                            $user = new userClass();
                            $obj = $user->closingReportSheep($_POST['date']);
                            if(count($obj) > 0){
                                $response['error'] = true;
                                $response['message'] = $obj;
                            }else{
                                $response['error'] = false;
                                $response['message'] = 'ไม่พบข้อมูลวันที่เลือก';
                            }
                          
                        }else{
                            $response['error'] = false;
                            $response['message'] = 'ไม่พบข้อมูลคะ';
                        }
                        break;

                    case 'LoadCloseNewYear' :
                        if(isset($_POST['date'])){
                            $user = new userClass();
                            $obj = $user->closingReportNewYear($_POST['date']);
                            if(count($obj) > 0){
                                $response['error'] = true;
                                $response['message'] = $obj;
                            }else{
                                $response['error'] = false;
                                $response['message'] = 'ไม่พบข้อมูลวันที่เลือก';
                            }
                          
                        }else{
                            $response['error'] = false;
                            $response['message'] = 'ไม่พบข้อมูลคะ';
                        }
                        break;
    
        
            case 'closegroup' :
            if(isset($_POST['userid'])){
                $userid = $_POST['userid'];
                $user = new userClass();
                $obj = $user->closingReportGroup($userid);
                $response['message'] = $obj;
            }else{
                $response['message'] = 'กรุณากรอกข้อมูล';
            }
            break;

            case 'trackstatus':
                if(isset($_POST['userid'])){
                    $userid = $_POST['userid'];
                    $user = new userClass();
                    $obj = $user->userTrackStutus($userid);
                    if(count($obj) <= 0){
                        $response['message'] = 'ไม่พบข้อมูล';
                    }else{
                        $response['message'] = $obj;
                    }
                }else{
                        $response['message'] = 'กรุณาตรวจสอบข้อมูล';
                }
                
            break;

            case 'userCancanleCards':
                if(isset($_POST['userid'])){
                    $userid = $_POST['userid'];
                    $user = new userClass();
                    $obj = $user->userCancanleCard($userid);
                    if(count($obj) <= 0){
                        $response['message'] = 'ไม่พบข้อมูล';
                    }else{
                        $response['message'] = $obj;
                    }
                }else{
                        $response['message'] = 'กรุณาตรวจสอบข้อมูล';
                }
                
            break;

            case 'updatePrintStatus';
            if(isset($_POST['customerid'])){
                $user = new userClass();
                $customerid = $_POST['customerid'];
                $namecustomer = $_POST['namecustomer'];
                $amount = $_POST['amount'];
                $datein = $_POST['datein'];
                $dateout = $_POST['dateout'];
                $update = $user->updatePrintstatus($customerid);
                if($update === TRUE)
                {
                    $response['message'] = 'อัพเดทเรียบร้อย';
                    $token = "ITkTiTqo3WZLfu3xm849KWMzi0cGWZV3xsTzv7hf9xT"; //ใส่Token ที่copy เอาไว้
                    $str = "\n". "รหัสกรุ๊ป : " .$customerid . "\n". "ชื่อกรุ๊ป : " .$namecustomer . "\n". "เช็คอิน : " . $datein ."\n"."เช็คเอ้าท์ : ".$dateout ."\n". "จำนวนบัตร : " . $amount . "ใบ ปริ้นเรียบร้อยแล้วครับ" ; 
                    notify_message($str , $token);
                }else{
                    $response['message'] = 'อัพเดทล้มเหลว';
                }
            }else{
                $response['message'] = 'กรุณาตรวจสอบข้ออมูล';
            }
            

            break;

            

            case 'sort':
                
                    $user = new userClass();
                    $obj = $user->sortAZ();
                    $response['error'] = true;
                    $response['message'] = $obj;
                
            break;

           

            case 'focuser':
            
            if(isset($_POST['customerid'])){
                $customerid = $_POST['customerid'];
                $user = new userClass();
                $listName = $user->focUser($customerid);
                
                if(count($listName) <= 0){
                    $response['error'] = false;
                    $response['message'] = 'ไม่พบข้อมูลผู้ใช้ ID ' .$customerid.' นี้';
                }else{
                    $response['message'] = $listName;
                }
            }else{
                $response['message'] = 'กรุณาตรวจสอบ ID ของลูกค้า';
            }
            break;

            case 'insertfoc':
                
                    if(isset($_POST['idcustomer'])){
                        $groupid = $_POST['idcustomer'];
                        $groupname = $_POST['namecustomer'];
                        $price = $_POST['price'];
                        $amount = $_POST['amountcustomer'];
                        $amount_activity = $_POST['amountactivity'];
                        $nameactivity = $_POST['nameactivity'];
                        $foc = $_POST['foc'];
                        $cause = $_POST['cause'];
                        $total = $_POST['total'];
                        $userid = $_POST['sale'];
                        $user = new userClass();
                        $insertfoc = $user->insertfoc($groupid , $groupname , $price , $amount , $amount_activity , $nameactivity ,$foc ,$cause , $total ,$userid);
                        if($insertfoc === TRUE){
                            $response['error'] = true;
                            $response['message'] = 'บันทึกข้อมูลเรียบร้อย';
                        }else{
                            $response['error'] = false;
                            $response['message'] = 'บันทึกข้อมูล้มเหลว กรุณาลองใหม่อีกครั้ง';
                        }
                    }else{
                        $response['message'] = 'กรุณาตรวจสอบ ข้อมูล';
                    }
                
            break;

            case 'insertCloseCash':
                
            if(isset($_POST['idcasher'])){
                $billSeniorsoft = $_POST['billSeniorsoft'];
                $idcasher = $_POST['idcasher'];
                $amount = $_POST['amount'];
                $nameactivity = $_POST['nameactivity'];
                $price = $_POST['price'];
                $grantactivity = $_POST['grantactivity'];
                $discount = $_POST['discount'];
                $discount_cash = $_POST['discount_cash'];
                $total_cash = $_POST['totalcash'];
                $seniorsoft = $_POST['seniorsoft'];
                $programcashcard = $_POST['programcashcard'];
                $balance = $_POST['balance']; 
                $because = $_POST['because'];
                $date = $_POST['date'];
                $user = new userClass();
                $result = $user->insertCashClose($idcasher , $billSeniorsoft , $amount , $nameactivity , $price , $grantactivity , $discount ,$discount_cash ,$total_cash , $seniorsoft ,$programcashcard , $balance , $because , $date);
                if($result ===TRUE){
                    $response['error'] = true;
                    $response['message'] = 'บันทึกข้อมูลเรียบร้อย';
                }else{
                    $response['error'] = false;
                    $response['message'] = 'บันทึกข้อมูล้มเหลว กรุณาลองใหม่อีกครั้ง';
                }
            }else{
                $response['message'] = 'กรุณาตรวจสอบ ข้อมูล';
            }
        
    break;

    case 'insertCashCloseFarm':
                
        if(isset($_POST['idcasher'])){
            $billSeniorsoft = $_POST['billSeniorsoft'];
            $idcasher = $_POST['idcasher'];
            $amount = $_POST['amount'];
            $nameactivity = $_POST['nameactivity'];
            $price = $_POST['price'];
            $grantactivity = $_POST['grantactivity'];
            $discount = $_POST['discount'];
            $discount_cash = $_POST['discount_cash'];
            $total_cash = $_POST['totalcash'];
            $seniorsoft = $_POST['seniorsoft'];
            $programcashcard = $_POST['programcashcard'];
            $balance = $_POST['balance']; 
            $because = $_POST['because'];
            $date = $_POST['date'];
            $user = new userClass();
            $result = $user->insertCashCloseFarm($idcasher , $billSeniorsoft , $amount , $nameactivity , $price , $grantactivity , $discount ,$discount_cash ,$total_cash , $seniorsoft ,$programcashcard , $balance , $because , $date);
            if($result ===TRUE){
                $response['error'] = true;
                $response['message'] = 'บันทึกข้อมูลเรียบร้อย';
            }else{
                $response['error'] = false;
                $response['message'] = 'บันทึกข้อมูล้มเหลว กรุณาลองใหม่อีกครั้ง';
            }
        }else{
            $response['message'] = 'กรุณาตรวจสอบ ข้อมูล';
        }
    
break;

case 'insertCashCloseNewYear':
                
    if(isset($_POST['idcasher'])){
        $billSeniorsoft = $_POST['billSeniorsoft'];
        $idcasher = $_POST['idcasher'];
        $amount = $_POST['amount'];
        $nameactivity = $_POST['nameactivity'];
        $price = $_POST['price'];
        $grantactivity = $_POST['grantactivity'];
        $discount = $_POST['discount'];
        $discount_cash = $_POST['discount_cash'];
        $total_cash = $_POST['totalcash'];
        $seniorsoft = $_POST['seniorsoft'];
        $programcashcard = $_POST['programcashcard'];
        $balance = $_POST['balance']; 
        $because = $_POST['because'];
        $date = $_POST['date'];
        $user = new userClass();
        $result = $user->insertCashCloseNewYear($idcasher , $billSeniorsoft , $amount , $nameactivity , $price , $grantactivity , $discount ,$discount_cash ,$total_cash , $seniorsoft ,$programcashcard , $balance , $because , $date);
        if($result ===TRUE){
            $response['error'] = true;
            $response['message'] = 'บันทึกข้อมูลเรียบร้อย';
        }else{
            $response['error'] = false;
            $response['message'] = 'บันทึกข้อมูล้มเหลว กรุณาลองใหม่อีกครั้ง';
        }
    }else{
        $response['message'] = 'กรุณาตรวจสอบ ข้อมูล';
    }

break;

    case 'selectCategoryUpdateId';
        if(isset($_POST['idbill']))
        {
            $IdBill = $_POST['idbill'];
            $user = new userClass();
            $getSelect = $user->getNoseniorsoftById($IdBill);
            if($getSelect >= 0)
            {
                $response['message'] = $getSelect;
            }
            else
            {
                $response['message'] = 'error false';
            }
        }


    break;

    case 'insertCloseGroup':
                
            if(isset($_POST['customerid']) && isset($_POST['userid']) && isset($_POST['price'])){
                $userid = $_POST['userid'];
                $customerid = $_POST['customerid'];
                $amount = $_POST['amount'];
                $nameactivity = $_POST['nameactivity'];
                $grant_play = $_POST['grantactivity'];
                $price = $_POST['price'];
                $total_cash = $_POST['totalcash'];
                $seniorsoft = $_POST['seniorsoft'];
                $programcard = $_POST['programcashcard'];
                $balance = $_POST['balance']; 
                $because = $_POST['because'];
                $user = new userClass();
                
                    $response['error'] = false;
                    $response['message'] = $userid . '/' . $customerid . $amount;
                
            }else{
                $response['message'] = 'กรุณาตรวจสอบ ข้อมูล';
            }
        
    break;

            case 'getActivityCus':
                    $user = new userClass();
                    $result = $user->customerDetails();
                    $response['message'] = $result;
            break;

            case 'getSumActivityX':
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $change_activity = $_POST['change'];
            $user = new userClass();
            $result = $user->getSumActivityX($start_date , $end_date , $change_activity);
            $response = $result;
            break;

            case 'NotClosecash':
            $user = new userClass();
            $result = $user->NotClosecash();
            $response = $result;
            break;

            case 'NotClosegroup':
            $user = new userClass();
            $result = $user->NotClosegroup();
            $response = $result;
            break;

            case 'passClosecash':
            $user = new userClass();
            $result = $user->passClosecash();
            $response = $result;
            break;

            case 'passClosegroup':
            $user = new userClass();
            $result = $user->passClosegroup();
            $response = $result;
            break;


            case 'getRecard':
            
            if(isset($_POST['customerid'])){
                $customerid = $_POST['customerid'];
                $user = new userClass();
                $listName = $user->getRecard($customerid);
                
                if(count($listName) <= 0){
                    $response['error'] = false;
                    $response['message'] = 'ไม่พบข้อมูลผู้ใช้ ID ' .$customerid.' นี้';
                }else{
                    $response['message'] = $listName;
                }
            }else{
                $response['message'] = 'กรุณาตรวจสอบ ID ของลูกค้า';
            }
            break;

            case 'tt':
           
                $user = new userClass();
                $customerid = $_POST['cusid'];
                $amount = $_POST['amount'];
                $datein = $_POST['datein'];
                $dateout = $_POST['dateout'];
                $listActivity = $_POST['listactivity'];
                $grant_Ac = 1;
                $result = $user->editQrCode($customerid , $customerid , $amount ,$grant_Ac , $listActivity ,$datein , $dateout);
                        if($result === TRUE){
                            $response['error'] = true;
                            $response['message'] = 'บันทึกข้อมูลเรียบร้อย';
                        }else{
                            $response['error'] = false;
                            $response['message'] = 'ไม่สามารถบันทึกข้อมูลได้กรุณาลองใหม่อีกครั้ง ! !';
                        }
                   
                
                
               
            
           
            break;


            case 'checkautoNumber':
           
                $user = new userClass();
                $result = $user->moneyReal();
                $response['message'] = $result;
            break;

            case 'checkautoNumberFarm':
           
                $user = new userClass();
                $result = $user->moneyFarmRealBill();
                $response['message'] = $result;
            break;

            case 'checkautoNewYear':
                $user = new userClass();
                $result = $user->moneyNewyear();
                $response['message'] = $result;
            break;

            case 'updateProduct':
                if(isset($_POST['Idbill']) && isset($_POST['noseniorsoft']))
                {
                    $user = new userClass();
                    $BIll = $_POST['Idbill'];
                    $seniorsoft = $_POST['noseniorsoft'];
                    $update = $user->updateSenior($BIll , $seniorsoft);
                    if($update === TRUE)
                    {
                        $response['error'] = true;
                        $response['message'] = 'อัพเดทข้อมูลเรียบร้อย';
                    }
                    else
                    {
                        $response['error'] = false;
                        $response['message'] = 'อัพเดทข้อมูลล้มเหลว';
                    }
                }
                else
                {
                    $response['error'] = false;
                    $response['message'] = 'การอัพเดทข้อมูลล้มเหลว กรุณาลองใหม่อีกครั้ง';
                }
            break;

            case 'd1234':
                    $user = new userClass();
                    $result = $user->getNumberRang();
                    if($result > 0)
                    {
                        $response['message'] = $result;
                    }
                    else
                    {
                        $response['message'] = 0;
                    }
                    
            break;

            case 'test1123454':

                $user = new userClass();
                $result  = $user->exportDataCashCard();
                $response['error'] = true;
                $response['message'] = $result;

            break;
            
       
       
       default:
            $response['error'] = false;
            $response['message'] = 'กรุณาตรวจสอบข้อมูล'.'//'.$type;
           break;
   }
   
    
    
}
else
{
    echo ' not found';
}

 

function notify_message($message,$token){
 $queryData = array('message' => $message);
 $queryData = http_build_query($queryData,'','&');
 $headerOptions = array( 
         'http'=>array(
            'method'=>'POST',
            'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                      ."Authorization: Bearer ".$token."\r\n"
                      ."Content-Length: ".strlen($queryData)."\r\n",
            'content' => $queryData
         ),
 );
 $context = stream_context_create($headerOptions);
 $result = file_get_contents(LINE_API,FALSE,$context);
 $res = json_decode($result);
 return $res;
}

echo json_encode($response);


?>