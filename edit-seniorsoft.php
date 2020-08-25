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

    <title>เมนู</title>
    <link rel="shortcut icon" type="image/x-icon" href="template/coupon.gif">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/edit-senior.js"></script>
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
                            <strong> ยินดีต้อนรับคุณ : <?php echo $userDetails->fname; ?> </strong>      
                            <strong> รหัส : <?php echo $userDetails->userid; ?> </strong> 
                            <strong> ระดับ : <?php 

                            switch ($userDetails->status) {
                                case '1':
                                    echo 'พนักงานปริ้น';
                                    break;
                                case '2':
                                    echo 'เซลล์';
                                    break;
                                case '3':
                                    echo 'หัวหน้า';
                                    break;
                                case '4':
                                    echo 'แอดมิน';
                                    break;
                                
                                default:
                                     echo 'ไม่พบข้อมูล';
                                    break;
                            }
                            
                            
                             ?> </strong> 

                                                    </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo BASE_URL; ?>/Model/logout.php"><i class="fas fa-sign-out-alt"></i></a>
                            </li>
                
                        </ul>
                    </div>
                </div>
            </nav>
    

            <div class="container">
            <div class="table-responsive ">
           
            <br/>
                <table id="list_category" class="table" >
                        <thead align="center">
                            <tr>
                                <th>รหัสผู้ขาย</th>
                                <th>รหัสบิล</th>
                                <th>รหัสบิล seniorsoft	</th>
                                <th>วันที่</th>
                                <th>สถานะ</th>
                            </tr>
                        </thead>
                        <tbody align="center">
                    
                          </tbody>
                    </table>
        </div>
    </div>
    
            
            
        </div>
    </div>
    
    
    


   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->


</body>
</html>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="main.js"></script>
<script src="js/bootstrap.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>  
<script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>  
<script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.print.min.js"></script>  

<div id="categoryModal" class="modal fade">
    <div class="modal-dialog">
     <form method="post" id="category_form" enctype="multipart/form-data">
      <div class="modal-content">
       <div class="modal-header">
        <h4 align="center" class="modal-title">แก้ไขรายการใบเสร็จ</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       </div>
       <div class="modal-body">
        <label>รหัสใบเสร็จของโปรแกรมออกบัตร</label>
        <input type="text" name="Idbill" id="Idbill" class="form-control" />
        <br />
        <label>รหัสใบเสร็จของซีเนียรซอฟต์</label>
        <input type="text" name="noseniorsoft" id="noseniorsoft" class="form-control" />
        
       <div class="modal-footer">
        <input type="hidden" name="user_id" id="user_id" />
        <input type="hidden" name="type" id="type" />
        <input type="submit"  name="action" id="action" class="btn btn-success" value="บันทึก" />
        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
       </div>
      </div>
     </form>
    </div>
   </div>