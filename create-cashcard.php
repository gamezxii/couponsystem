<?php
include('Model/config.php');
include('Model/session.php');
$userDetails=$userClass->userDetails($session_uid);
$userDetails=$userClass->userDetails($session_uid);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>สร้างบัตร</title>
    <link rel="shortcut icon" type="image/x-icon" href="template/coupon.gif">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <script src="js/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>
<body>

<style type="text/css">


        #customerid{ text-transform:uppercase;}


</style>

  
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
                                <strong> Welcome to : <?php echo $userDetails->fname; ?> </strong> 
                                <strong> No : <?php echo $userDetails->userid; ?> </strong> 
                                <strong style="display:none" id="department"> <?php echo $userDetails->department; ?> </strong>
                                <input type="hidden" value="<?php echo $userDetails->userid; ?>" id="userid">
                            </li>
                            <li class="nav-item">
                                
                                <a class="nav-link" href="<?php echo BASE_URL; ?>/Model/logout.php"><i class="fas fa-sign-out-alt"></i></a>
                            </li>
                
                        </ul>
                    </div>
                </div>
            </nav>
    
            <h3 align="center"></h3><br />

<div class="col-sm-6 offset-sm-3 ">
        <div class="info-form">
            <form method="post" id="insert_form" class="form-inlin justify-content-center">

                <div class="form-group">
                    <label for="customerid" >รหัสลูกค้า/กลุ่ม</label>
                    <input type="text" class="form-control " id="customerid" name="customerid"  placeholder="รหัสลูกค้า/กลุ่ม" required>
                </div>

                <div class="form-group">
                        <label for="code-customer">ชื่อลูกค้า/กลุ่ม</label>
                        <input type="text" class="form-control" id="codecustomer" placeholder="ชื่อลูกค้า/กลุ่ม" required>
                </div>
                
                <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="permission[]" id="permission" value="1" required>
                        <label class="form-check-label" for="permission">ราคาปกติ</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="permission[]" id="permission" value="2" required>
                        <label class="form-check-label" for="permission">ขออนุมัติ ส่วนลด จาก GM ใน WRIKE แล้ว</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="permission[]" id="permission" value="3" required>
                        <label class="form-check-label" for="permission">ขออนุมัติ ส่วนลด จากคุณเล็ก ใน Line แล้ว</label>
                </div>

                <hr>

                <div class="form-group">
                        <label for="note">หมายเหตุ</label>
                        <input type="text" class="form-control" id="note" placeholder="หมายเหตุ" required>
                </div>

                <div class="form-group">
                        <label for="getMoney">จำนวนเงินที่เก็บลูกค้า</label>
                        <input type="text" class="form-control" id="getMoney" placeholder="จำนวนเงินที่เก็บลูกค้า" required>
                </div>

                
                <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="name-customer">วันที่เข้าเล่น</label>
                        <input class="form-control" id="datein" name="datein" placeholder="MM/DD/YYY" type="date"/ required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name-customer">วันที่ออก</label>
                            <input class="form-control" id="dateout" name="datein" placeholder="MM/DD/YYY" type="date"/ required>
                        </div>
                        <div class="form-group col-md-6">
                        <label for="count-customer">จำนวนลูกค้า</label>
                        <input type="number" class="form-control" id="countcustomer" placeholder="จำนวน" required>
                        </div>

                        <div class="form-group col-md-6">
                        <label for="count-customer">จำนวนกิจกรรมที่เล่น</label>
                            <select class="form-control" id="amount-activity" required>โปรดเลือก
                                <option value="1" >1</option>
                                <option value="2" >2</option>
                                <option value="3" >3</option>
                                <option value="4" >4</option>
                                <option value="5" >5</option>
                                <option value="6" >6</option>
                                <option value="7" >7</option>
                                <option value="8" >8</option>
                                <option value="9" >9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                            <div class="input-group-prepend">
                                    <label class="input-group-text" id="lb-n-package" for="id-package">แพคเกจ</label>
                                    <input class="form-control col-md-2" id="txt_package" name="txt_package"  type="text"/>
                                    <select id="id-package" class="form-control" required></select>
                            </div>
                        </div>

                        <span id="error"></span>

                
                    <div class="form-group">
                        <div class="table-responseive">
                            <table class="table table-bordered table-sm" id="item_table" >
                            <thead align="center">
                            <tr>
                                <th width="10%">ลำดับ</th>
                                <th width="20%">รหัสกิจกรรม</th>
                                <th width="50%">รายการ</th>
                                <th wdith="20%"><button type="button" name="add" class="btn btn-success btn-xs add"><span class="glyphicon glyphicon-plus"></span></button></th>
                            </tr>
                            </thead>
                            <tbody align="center">

                            </tbody>
                            
                            </table>
                        </div>
                    </div>
                    
                    
                    

                <button type="submit" id="btn-create" class="btn btn-primary btn-lg">บันทึก</button>
                <br>
                <br>
            </form>

            <div class="form-group" id="process" style="display:none;">
                <div class="progress">
                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="">
            </div>
        </div>
</div>    
            
        </div>
    </div>
    
    
    


    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>


</body>
</html>



<script src="js/create-cashcard.js"></script>


