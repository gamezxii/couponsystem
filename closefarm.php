<?php
include('Model/config.php');
include('Model/session.php');
$userDetails=$userClass->userDetails($session_uid);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>รายงานปิดยอดเงินสดของร้านค้าฟาร์ม</title>
    <link rel="shortcut icon" type="image/x-icon" href="template/coupon.gif">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    

</head>
<body>

  
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php
            include('sidebar.php');
        ?>
    
        <!-- Page Content  -->
        <div id="content">
    
          
       
    
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
    
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>ปิดแถบ เมนู</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
    
                    
    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item mt-2 ">
                            <strong> Welcome : <?php echo $userDetails->fname; ?> </strong>      
                            <strong> No : <?php echo $userDetails->userid; ?> </strong> 
                            <strong> Class : <?php echo $userDetails->status; ?> </strong> 

                                                    </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo BASE_URL; ?>/Model/logout.php"><i class="fas fa-sign-out-alt"></i></a>
                            </li>
                
                        </ul>
                    </div>
                </div>
            </nav>

            

            <form class="justify-content-center">
            <div class="input-dateranger">
                <div class="form-row">
                
                    <div class="col-md-3">
                        <input class="form-control" id="date" name="date" placeholder="DD/MM/YYY" type="date"/>
                    </div>
                    <div class="col-md-0">
                    <input type="button" name="search" id="search" value="Search" class="btn btn-info" />
                    </div>
                </div>
            </div>
            </form>

            <br>

            
            <div class="table-responsive">
                <table border="1" class="table table-sm table-bordered  table-hover gridtable" cellspacing="0" id="myTable" >
                    <!-- head table -->
                    <thead>
                      <tr align="center">
                        <th width="10">รหัสบิล seniorsoft</th>
                        <th width="5">จนลค.</th>
                        <th width="15%"> ชื่อแพคเกจ</th>
                        <th width="25%"> ชื่อบัตรกิจกรรม</th>
                        <th width="5%"> ราคา</th>
                        <th width="10%"> สิทธิ์การเล่นทั้งหมด</th>
                        <th width="5%"> ลดราคา</th>
                        <th width="5%"> ส่วนลด</th>
                        <th width="10%" > รวม</th>
                      </tr>
                    </thead>
                    <!-- body dynamic rows -->
                    <tbody id="myBody" align="center" >
                    
                    </tbody>

                    <tfoot>
                    <tr >
                    <td colspan="8" align="right">รวม</td>
                    <td  align="right" id="total_all">0</td>
                    </tr>
                    <tr>
                    <th colspan="2">สรุปยอดประจำวัน</th>
                    <td colspan="2" align="right" class="datenow"></td>
                    </tr>
                    <tr>
                    <th colspan="2">SeniorSoft</th>
                    <td colspan="2" align="right" contenteditable="true" id="seniorsoft"></td>
                    </tr>
                    <tr>
                    <th colspan="2">โปรแกรมออกบัตร</th>
                    <td colspan="2" align="right" id="outcash">0.00</td>
                    </tr>
                    <tr>
                    <th colspan="2">Balance</th>
                    <td colspan="2" align="right" id="balance">0.00</td>
                    </tr>
                    <tr>
                    <th colspan="2" align="center" >* หมายเหตุ</th>
                    <td colspan="8" contenteditable="true" class="because"></td>
                    </tr>
                    </tfoot>
                    </table>
                   
     
            </div>
            
            <br>
            <button id="pdf" class="btn btn-danger">พิมพ์</button>
            
            
        </div>
    </div>
    
    
    


   
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
   
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
   <!-- Bootstrap JS -->
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>


</body>
</html>
<script src="js/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="css/sweetalert2.min.css">
<script src="js/bootstrap.min.js"></script>
<script src="js/closefarm.js"></script>


