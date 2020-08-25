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


    <title>รายงานยังไม่ได้ปิดยอดขายกรุ๊ป</title>


    <link rel="shortcut icon" type="image/x-icon" href="template/coupon.gif">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Font Awesome JS -->
    <script defer src="fontawesome/solid.js"></script>
    <script defer src="fontawesome/fontawesome.js"></script>
</head>
<body>

  
    <div class="wrapper">
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
                            <a href="generate-card.php">พิมพ์บัตร</a>
                        </li>
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
    
        
            <p class="text-center">รายงานที่ยังไม่ได้ปิดยอด ขายกรุ๊ป</p>


            
            <div class="table-responsive">
            
            <table id="order_data" class="table" style="width:100%">
        <thead>
            <tr align="center">
                <th>รหัสผู้ขาย</th>
                <th>วัน/เดือน/ปี</th>
                <th>รหัสลูกค้า</th>
                <th>จำนวนลูกค้า</th>
                <th>ชื่อแพคเกจ</th>
                <th>ประเภทบัตรกิจกรรม</th>
                <th>ราคา</th>
                <th>สิทธิ์การเล่นทั้งหมด</th>
                <th>ลดราคา</th>
                <th>ส่วนลดราคา</th>
                <th>รวมเงินสด</th>

            </tr>
            </thead>
                <tbody align="center"></tbody>

                <tfoot>
                <tr align="right" >
                <th ></th>
                <th ></th>
                <th ></th>
                <th ></th>
                <th ></th>
                <th ></th>
                <th ></th>
                <th ></th>
                <th ></th>

                <th >รวม</th>
                <th id="total"></th>
                </tr>
                </tfoot>
            </table>
            </div>     
        </div>
    </div>
    
    
    


    <script src="http://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->

<script src="DataTables/DataTables/js/jquery.dataTables.min.js"></script>
<script src="DataTables/DataTables/js/dataTables.bootstrap4.min.js"></script>  
<link rel="stylesheet" href="DataTables/DataTables/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" href="DataTables/Buttons-1.5.6/css/buttons.dataTables.min.css" />
</body>
</html>

<script src="js/bootstrap.min.js"></script>
<script src="main.js"></script>

<!-- Expor -->
<script src="DataTables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>  
<script src="DataTables/Buttons-1.5.6/js/buttons.print.min.js"></script>  
<script src="DataTables/Buttons-1.5.6/js/buttons.html5.min.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>  
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>  
<script src='DataTables/pdfmake-0.1.36/pdfmake.min.js'></script>
<script src='DataTables/pdfmake-0.1.36/vfs_fonts.js'></script>




<script type="text/javascript" language="javascript" >
 $(document).ready(function(){
    
    fetch_data();

function fetch_data()
{

    var dataTable = $('#order_data').DataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "ajax" : {
     url:"Model/index.php",
     type:"POST",
     data:{
        type:'NotClosegroup'
     }
    },
    dom: 'lBfrtip',
    buttons: [
        { extend: 'excel', footer: true },
        { extend: 'pdf', footer: true },
        { extend: 'print', footer: true }
   ],
   "pageLength": 100,
   
  // "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]
    //,
    "oLanguage": {

"sLengthMenu": "แสดง _MENU_ เร็คคอร์ด ต่อหน้า",

"sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",

"sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ เร็คคอร์ด",

"sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",

"sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",

"sSearch": "ค้นหา"
    },
    drawCallback:function(settings)
    {
     $('#total').html(settings.json.total);
    }
   });
}


   
  
 });
 
</script>
