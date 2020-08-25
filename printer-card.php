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
<link rel="shortcut icon" type="image/x-icon" href="template/coupon.gif">
    <title>พิมพ์บัตร</title>
    <style>
            .printsleep{
                font-size: 22px;
            }
            h3,h4 , h5{
                text-align:center;
            }

            .txtprint{
                text-align:left;
                margin-left:40px;
            }

            .txtleft{
                display: inline; /* the default for span */
            }

            .txtright{
                float:right;
                margin-right:0px;
            }

            hr{
                background-color:black;
            }

        


        @media all {
	    .page-break	{ display: none; }
        }

        @media print {
            @page { margin: 0; }
            body { margin: 2.0cm; }
            header, footer, aside, nav, form, iframe, .menu, .hero, .adslot , .modal-footer , .printable{
            display: none;
            }
        .page-break	{ display: block; page-break-before: always; }
        }

        .activity{
            font-size: 18px;
            margin-left: 44px;
        }

        .float_center {
        float: left;

        position: relative;
          /* or right 50% */
        text-align: left;
        }
        .float_center > .child {
        position: relative;
        left: 50%;
        }

       

        .main {
        width: 400px;
        height: 100%;
        border: 1px solid #c3c3c3;
        display: flex;
        font-size:13.5px;
        justify-content: center;
        }

        .main li {
        width: 100%;
        height: 280px;
        }
    
        
    </style>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- use QrCode -->

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    <!-- Multiple -->
    
</head>
<body>
    
  
    <div class="wrapper">
        <!-- Sidebar  -->
                <!-- Sidebar  -->
                <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Card System</h3>
            </div>
    
            <ul class="list-unstyled components">
                <p>Main Menu</p>
                <li  class="#">
                <a href="index.php">เมนู</a>
                </li>
                <?php
                    if($userDetails->status == 2 || $userDetails->status == 4 ){
                                            //element class level 2  = sale
                ?>
                <li class="#" >
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">ใบเบิก - คืน</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li class="#">
                            <a href="create-cashcard.php">ใบเบิกบัตรกิจกรรมลูกค้า</a>
                        </li>
                        <li class="#">
                            <a href="generate-card.php">พิมพ์บัตร</a>
                        </li>
                        <li class="#">
                            <a href="trackstatus.php">ตรวจสอบสถานะ</a>
                        </li>
                        <li class="#">
                            <a href="cancelcard.php">ยกเลิกบัตร</a>
                        </li>
                    </ul>
                </li>
                <?php
                    }
                    if($userDetails->status == 0 || $userDetails->status == 4 ){

                    //element class level 2  = printer
                ?>
                <li  class="#">
                <a href="#realmoney" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">บัตรเงินสด</a>
                <ul class="collapse list-unstyled" id="realmoney">
                        <li class="#">
                            <a href="create-realmoney.php">เบิกบัตรเงินสด</a>
                        </li>
                    </ul>
                </li>
                <?php
                    }
                    if($userDetails->status == 3 || $userDetails->status == 4 ){
                ?>
                <li  class="#">
                <a href="#laser" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">บัตรโรงเลเซอร์</a>
                <ul class="collapse list-unstyled" id="laser">
                        <li class="#">
                            <a href="create-lasergame.php">เบิกบัตรเลเซอร์เกมส์</a>
                        </li>
                    </ul>
                </li>
                <?php
                    }
                    if($userDetails->status == 1 || $userDetails->status == 4 ){

                    //element class level 2  = printer
                ?>
                <li  class="#">
                <a href="#printercard" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">พิมพ์บัตร</a>
                <ul class="collapse list-unstyled" id="printercard">
                        <li class="#">
                            <a href="closing-report.php">ใบรายงานปิดยอด</a>
                        </li>
                        <li class="#">
                            <a href="closefarm.php">ใบรายงานปิดร้านค้าฟาร์ม</a>
                        </li>
                        <li class="#">
                            <a href="closelaser.php">ใบรายงานปิดยอดเลเซอร์เกม</a>
                        </li>
                        <li class="#">
                            <a href="edit-seniorsoft.php">เพิ่มรหัสบัตรซ๊เนียรซอฟต์</a>
                        </li>
                    </ul>
                </li>
                <?php
                    }
                    if($userDetails->status == 3 || $userDetails->status == 4 ){
                ?>
                <li  class="#">
                <a href="#reportList" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">รายงาน</a>
                <ul class="collapse list-unstyled" id="reportList">
                        <li class="#">
                            <a href="report-customer-datein.php">รายงานวันที่ลูกค้าเข้า</a>
                        </li>
                        <li class="#">
                            <a href="report-cou.php">รายงานบัตรคงเหลือ</a>
                        </li>
                        <li class="#">
                            <a href="edit-grantCustomer.php">แก้ไขสิทธิ์การสแกน</a>
                        </li>
                        <li class="#">
                            <a href="report-xyz.php">สรุปยอดบัตร XYZ</a>
                        </li>
                        <li class="#">
                             <a href="chart.php">รายงานสรุปผลยอดรายวัน</a>
                        </li>
                    </ul>
                </li>
                <?php
                    }
                ?>
                <?php

                if($userDetails->status == 4 ){

                ?>
                <li class="#" >
                <a href="#test" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" >ตั้งค่า</a>
                <ul class="collapse list-unstyled" id="test">
                    <li class="#">
                        <a href="setting.php">สมาชิก</a>
                    </li>
                    <li class="#">
                            <a href="chart.php">รายงาน</a>
                    </li>
                    <li><a href="history-foc.php">ประวัติ FOC</a></li>
                </ul>
                </li>
                <li class="#" >
                <a href="#conclude" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" >สรุปการใช้บัตร</a>
                <ul class="collapse list-unstyled" id="conclude">
                    <li class="#">
                        <a href="concoluecard.php">การใช้บัตร</a>
                    </li>
                    <li class="#">
                        <a href="chart.php">การคืน</a>
                    </li>
                </ul>
                </li>
                <?php
                }
                ?>
            </ul>
    
         
        </nav>
    
    
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
            <form action="" class="form-inlin justify-content-center">
                

                    <div class="form-group">
                    <label for="code-customer">รหัสลูกค้า/กลุ่ม</label>
                    <input type="text" class="form-control" id="code-customer" placeholder="รหัสลูกค้า/กลุ่ม">
                    </div>
                    
                    <div class="form-group">
                    <label for="code-customer-card">ชื่อลูกค้า/กลุ่ม</label>
                    <input type="text" class="form-control" id="name-customer" placeholder="ชื่อลูกค้า/กลุ่ม">
                    </div>
            
                  <div class="form-row">
                    <div class="form-group col-md-6">
                    <label for="name-customer">วันที่เข้าเล่น</label>
                    <input class="form-control" id="datein" name="datein" placeholder="DD/MM/YYY" type="text"/>
                    </div>
                    <div class="form-group col-md-6">
                    <label for="count-customer">วันที่ออก</label>
                    <input class="form-control" id="dateout" name="dateout" placeholder="DD/MM/YYY" type="text"/>
                    </div>
                  </div> 

                  <div class="form-row">
                    <div class="form-group col-md-6">
                    <label for="name-customer">จำนวนลูกค้า</label>
                    <input class="form-control" id="amountcus" name="amountcus" placeholder="" type="text"/>
                    </div>
                    <div class="form-group col-md-6">
                    <label for="count-customer">จำนวนใบ</label>
                    <input class="form-control" id="amountcou" name="amountcou" value="1" type="text"/>
                    </div>
                  </div>
                
            
                  <!-- Combobox -->
                  <div>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="txtPromote1">ข้อความโปรโมทบรรทัดที่ 1</label>
                    </div>
                    <select class="custom-select " id="txtPromote1">
                        <option selected>Choose...</option>
                        <option value="1">พบกับกิจกรรมเปิดใหม่ สุดฮิต!!!</option>
                        <option value="2">สินค้าออแกนนิกจากสวน</option>
                        <option value="3">สินค้าเพื่อสุขภาพ</option>
                        <option value="4">Online Express</option>
                        <option value="5">สินค้าเพื่อสุขภาพ</option>
                        <option value="6">ผลิตภัณฑ์จากสมุนไพรธรรมชาติ</option>
                    </select>
                    </div>
            
                    <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="txtPromote2">ข้อความโปรโมทบรรทัดที่ 2</label>
                    </div>
                    <select class="custom-select" id="txtPromote2">
                        <option selected>Choose...</option>
                        <option value="1">เลเซอร์คอมแบท</option>
                        <option value="2">เมลอนตัดใหม่จากสวน</option>
                        <option value="3">เทศกาลชิมมัลเบอรี่สด ๆ จากสวน</option>
                        <option value="4">ชาถังเช่าสีทอง ยาอายุวัฒนะ</option>
                        <option value="5">ชาสมุนไพรหลากชนิด</option>
                        <option value="6">ส่งเป็นของฝาก เราก็มีบริการจัดส่งนะคะ</option>
                        <option value="7">สบู่เหลวขมิ้นชัน , แซมพูอันชัน , น้ำยาล้างจานมะกรูด</option>
                    </select>
                    </div>

                    <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="typeCard1">ประเภทบัตร</label>
                    </div>
                    <select class="custom-select" id="typeCard1">
                        <option selected>Choose...</option>
                        <option value="1">บัตรกิจกรรม</option>
                        <option value="2">บัตร Big Sale</option>
                        <option value="3">บัตรมัลเบอรี่ฟาร์มทัวร์</option>
                    </select>
                    </div>

                    <div class="form-group row">
                    <div class="col-sm-4">
                    <input type="checkbox" id="chkx" name="x[]" value="0"> ใบปะหน้า X <br>
                    </div>
                    <div class="col-sm-4">
                    <input type="checkbox" id="chky" name="y[]" value="1"> ใบปะหน้า Y <br>
                    </div>
                    <div class="col-sm-4">
                    <input type="checkbox" id="chkz" name="z[]" value="2"> ใบปะหน้า Z <br>
                    </div>
                    <div class="col-sm-4">
                    <input type="checkbox" id="chkbigsale" name="chkbigsale[]" value="3"> ใบปะหน้า Bigsale <br>
                    </div>
                    
                    </div>

                    <div class="form-group">
                        <label for="listname">รายชื่อกิจกรรม</label>
                       <textarea name="listname" id="listname" rows="15" class="form-control"></textarea>
                    </div>

                    
            
                <button type="button" id="btn-printer" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#exampleModal">พิมพ์บัตร</button>
                <button style="display:none" type="button" id="update_print" class="btn btn-primary btn-lg" >ปริ้นแล้ว</button>

            </form>
        </div>
</div>    
            
    
    
<div id="userInfo" style="display: none;"></div>



<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>


</body>
</html>




<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog" role="document" >
          <div class="modal-content">  
            <div class="modal-body">
                <div class="printsleep">
                <h4 id="txtshowPromote1"></h4>
                <h5 id="txtshowPromote2"></h5>
                <hr>
                <h3 id="typecard">บัตรกิจกรรม</h3>
                    <br>
                    <div class="txtprint">
                    <h4 class="txtleft">ชื่อเล่น : ......................................................... </h4>
                    <br>
                    <h6 class="txtleft">รหัสกรุ๊ป : </h6>
                    <h6 class="txtleft" id="cusid"></h6> 
                    <h6 class="txtleft">No: </h6>
                    <h6 class="txtleft" id="cusid-no">1</h6>
                    </div>
                    <div class="txtprint">
                    <h6 class="txtleft">ชื่อกรุ๊ป : </h6>
                    <h6 class="txtleft"id="cusname"></h6> 
                    </div>
                    <div class="txtprint">
                    <h6 class="txtleft">วันที่เข้าเล่น : </h6>
                    <h6 class="txtleft" id="dateplay"></h6>
                    <h6 class="txtleft">วันที่ออก : </h6>
                    <h6 class="txtleft" id="dateendplay"></h6>
                    </div>
                    <br>
                    <h4>รายชื่อกิจกรรมที่สามารถเล่นได้</h4>
                    <div class="activity" id="txtArray"></div>
                    <div id="qrcode" align="center"></div>
                    <br>
                </div>
                    
                   

                        <div style="display:none" id="tableActivity" class="main">
                        <li class="main" style="display:none" id="x"></li>
                        <li class="main" style="display:none" id="y"></li>
                        <li class="main" style="display:none" id="z"></li>
                        <li class="main" style="display:none" id="big"></li>
                        </div>
                        <div class="clear"></div>

                    
                    
            <div class="page-break"></div>
                    
            </div>
            <div class="printable">
            <div class="modal-footer">
              <button type="button" id="closeModal" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
              <button type="button" id="print" class="btn btn-primary">สั่งปริ้น</button>
            </div>
            </div>
            
          </div>
        </div>
      </div>

<script src="js/printer.js"></script>
<script type="text/javascript" src="js/qrcode.js"></script>