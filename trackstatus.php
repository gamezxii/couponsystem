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

    <title>สถานะ</title>
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
                                <strong style="display: none;" id="userno"> <?php echo $userDetails->userid; ?> </strong> 
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
                <div class="form-row float-right">
                <div class="col-auto">
                    </div>
                        <!--end of col-->
                        <div class="col mb-3">
                        <input style="display:none" id="customerid" class="form-control form-control-lg form-control-borderless" type="search" placeholder="รหัสลูกค้า">
                        </div>
                        <div class="col-auto">
                        <button style="display:none" id="search" class="btn btn-lg btn-success" type="button">ค้นหา</button>
                        </div>
            </div>
            </form>

            <br>
            <br>


            <div class="table-responsive">
                <table class="table table-striped table-bordered  table-hover" cellspacing="0" width="100%"  id="myTable" >
                    <!-- head table -->
                    <thead>
                      <tr>
                      <td > <div align="center">ลำดับ</div></td>
                        <td > <div align="center">รหัสลูกค้า / กลุ่ม </div></td>
                        <td > <div align="center">ชื่อลูกค้า / กลุ่ม </div></td>
                        <td> <div align="center">จำนวน</div></td>
                        <td > <div align="center">วันที่เข้าเล่น</div></td>
                        <td > <div align="center">วันที่ออก</div></td>
                        <td > <div align="center">สถานะปริ้น</div></td>
                      </tr>
                    </thead>
                    <!-- body dynamic rows -->
                    <tbody id="myBody" align="center" ></tbody>
                    </table>
                   
                  
     
            </div>
              
  
            
        </div>
    </div>
    
    
    


    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>


</body>
</html>

<script src="js/trackuser.js"></script>
