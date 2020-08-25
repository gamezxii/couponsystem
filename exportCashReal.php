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


    <title>รายงาน</title>


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
    
        
            <form class="justify-content-center">
            <div class="input-dateranger">
                <div class="form-row">
                    <div class="col-md-3">
                    <input type="date" id="start_date" name="start_date" class="form-control" >
                    </div>
                    <div class="col-md-3">
                    <input type="date" id="end_date" name="end_date" class="form-control" >
                    </div>
                    <div class="col-md-0">
                    <input type="button" name="search" id="search" value="Search" class="btn btn-info" />
                    </div>
                </div>
            </div>
            </form>
            
                <br>

            
            <div class="table-responsive">
            
            <table id="empTable" class="table table-striped table-sm" cellspacing="0" style="width:100%">
                <thead class="thead-dark">
                    <tr align="center">
                        <th width="15%">ลำดับ</th>
                        <th width="20%">รหัสกิจกรรม</th>
                        <th width="20%">ชื่อกิจกรรม</th>
                        <th width="15%">จำนวนบัตรทั้งหมด</th>
                        <th width="15%">จำนวนบัตรคงเหลือ</th>
                        <th width="15%">จำนวนบัตรที่เล่นแล้ว</th>
                        
                    </tr>
                </thead>
                <tbody align="center"></tbody>

            </table>
            </div>



          
              
  
            
        </div>
    </div>
    
    
    


    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>  
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" />
</body>
</html>



<script src="js/bootstrap.min.js"></script>

<!-- Expor -->
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>  
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>  
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>  
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>  
<script src='DataTables/pdfmake-0.1.36/pdfmake.min.js'></script>
  <script src='DataTables/pdfmake-0.1.36/vfs_fonts.js'></script>




<script type="text/javascript" language="javascript" >
 $(document).ready(function(){

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    fetch_Data('no');


    function fetch_Data(is_date_search,start_date = '', end_date = '')
    {
        $('#empTable').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                url:'Model/pexportCashReal.php',
               // type : 'POST',
                data:{
                    start_date:start_date,
                    end_date:end_date 
                }
            },
            lengthMenu: [[10,25,50,100, 100000], [10,25,50, 100, "All"]],
            pageLength: 25,
            'columns': [
            { data: 'datein'},
            { data: 'idac'},
            { data: 'name'},
            { data: 'balance' },
            { data: 'played' },
            { data: 'allplayed'},
            
            ],
            dom: 'Blfrtip',
            buttons: [
                { extend: 'excel', className:'btn btn-primary', footer:true},
                { extend: 'pdf', className:'btn btn-primary', footer: true },
                { extend: 'print', className:'btn btn-primary', footer: true }
        ],
        "oLanguage": {
            "sEmptyTable":     "ไม่มีข้อมูลในตาราง",
            "sInfo":           "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
            "sInfoEmpty":      "แสดง 0 ถึง 0 จาก 0 แถว",
            "sInfoFiltered":   "(กรองข้อมูล _MAX_ ทุกแถว)",
            "sInfoPostFix":    "",
            "sInfoThousands":  ",",
            "sLengthMenu":     "แสดง _MENU_ แถว",
            "sLoadingRecords": "กำลังโหลดข้อมูล...",
            "sProcessing":     "กำลังดำเนินการ...",
            "sSearch":         "ค้นหา: ",
            "sZeroRecords":    "ไม่พบข้อมูล",
                "oPaginate": {
                    "sFirst":    "หน้าแรก",
                "sPrevious": "ก่อนหน้า",
                    "sNext":     "ถัดไป",
                "sLast":     "หน้าสุดท้าย"
            }
        }

        });
    }

$('#search').click(function(){
    var tdatein = new Date($('#start_date').val());
    day = tdatein.getDate();
    month = tdatein.getMonth() + 1;
    year = tdatein.getFullYear() ;
    if(day < 10)
    day = "0" + day;
    var start_date  = [year , month , day].join('-');

    var dateout = new Date($('#end_date').val());
    dayout = dateout.getDate();
    monthout = dateout.getMonth() + 1;
    yearout = dateout.getFullYear();
    if(dayout < 10)
    dayout = "0" + dayout;
    var end_date  = [yearout , monthout , dayout].join('-');
  if(start_date != '' && end_date !='')
  {
   $('#empTable').DataTable().destroy();
   fetch_Data('yes', start_date, end_date);
  }
  else
  {
   alert("กรุณาเลือกวันที่ ! !");
  }
 }); 

    

});
 
</script>
