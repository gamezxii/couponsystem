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

            <input type="button" id="openAdduser" class="btn btn-primary float-right" value="เพิ่มข้อมูล"> 
            <br>
            <br>
    
            <div class="table-responsive">
                    <table id="tbUser" class="table table-bordered">
                    <thead>
                        <tr align="center">
                            <th>ลำดับ</th>
                            <th>รหัสพนักงาน</th>
                            <th>ชื่อ</th>
                            <th>นามสกุล</th>
                            <th>อีเมล์</th>
                            <th>ระดับ</th>
                            <th>แก้ไข</th>
                            <th>ลบ</th>
                        </tr>
                        </thead>
                        <tbody align="center"  id="st-user">
                        
                        </tbody>
                    </table>
            </div>
            
            
        </div>
    </div>
    
    
    


   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->


</body>
</html>

<div id="myModal" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <div class="modal-title" id="titlehead">sdfdsfs</div>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <form id="formAddorEdit">
                                    <div class="form-group row">
                                        <label for="userid" class="col-sm-4 col-form-label">รหัสพนักงาน</label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" id="userid" maxlength="6" placeholder="...">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-4 col-form-label">ชื่อ</label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" id="fname" placeholder="...">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lname" class="col-sm-4 col-form-label">นามสกุล</label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" id="lname" placeholder="...">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-4 col-form-label">อีเมล์</label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" id="email" placeholder="...">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-4 col-form-label">รหัสผ่าน</label>
                                        <div class="col-sm-8">
                                        <input type="password" class="form-control" id="password" placeholder="...">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="class" class="col-sm-4 col-form-label">ระดับ</label>
                                        <div class="col-sm-8">
                                        <select name="status-class" id="status-class" class="form-control">
                                            <option value="">โปรดเลือก</option>
                                            <option value="1">พนักงานปริ้นบัตร</option>
                                            <option value="2">เซล</option>
                                            <option value="3">หัวหน้า</option>
                                            <option value="4">แอดมิน</option>
                                        </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                            <div class="addUsertxt">
                            <button type="button" id="btn-addUser" class="btn btn-primary">บันทึก</button>
                             </div>
                             <div class="editUsertxt">
                            <button type="button" id="btn-editUser" class="btn btn-primary">บันทึก</button>
                             </div>
                            
                            </div>
                        </div>
                    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="main.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>
$(document).ready(function(){

})
</script>