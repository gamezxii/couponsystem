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
                    <select name="use-farm" id="use-farm" class="form-control">
                    <option value="WORKSHOP">WORKSHOP</option>
                    <option value="FARMSHEEP">ฟาร์มแกะ</option>
                    <option value="FARMTOUR">ฟาร์มทัวร์</option>
                    <option value="FARMFOOD">ห้องอาหาร</option>
                    </select>
                    </div>
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
                        <th width="20%">รหัสลูกค้า</th>
                        <th width="20%">รหัสบัตรที่ใช้</th>
                        <th width="20%">ชื่อบัตรที่ใช้</th>
                        <th width="20%">รหัสกิจกรรมที่เล่น</th>
                        <th width="20%">ชื่อกิจกรรมที่เล่น</th>
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
        var id_usefarm = $("#use-farm option:selected").val();
        $('#empTable').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                url:'Model/summaryfarm.php',
               // type : 'POST',
                data:{
                    id_usefarm: id_usefarm,
                    start_date:start_date,
                    end_date:end_date 
                }
            },
            lengthMenu: [[10,25,50,100, 10000], [10,25,50, 100, "All"]],
            pageLength: 10,
            'columns': [
            { data: 'groupid_number'},
            { data: 'user_useidac'},
            { data: 'user_usename'},
            { data: 'idactivity_play'},
            { data: 'nameactivity_play'},
          
            
            ],
            dom: 'Blfrtip',
            buttons: [
                {
                               "extend": 'copy',
                               "text": '<i class="fa fa-files" style="color: green;"></i>',
                               "titleAttr": 'Copy',                               
                               "action": newexportaction
                           },
                           {
                               "extend": 'excel',
                               "text": '<i class="fa fa-file-excel" style="color: green;"></i>',
                               "titleAttr": 'Excel',                               
                               "action": newexportaction,
                               "title": id_usefarm
                           },
                           {
                               "extend": 'csv',
                               "text": '<i class="fa fa-file-text" style="color: green;"></i>',
                               "titleAttr": 'CSV',                               
                               "action": newexportaction
                           },
                           {
                               "extend": 'pdf',
                               "text": '<i class="fa fa-file-pdf" style="color: green;"></i>',
                               "titleAttr": 'PDF',                               
                               "action": newexportaction
                           },
                           {
                                "extend": 'print',
                                "text": '<i class="fa fa-print" style="color: green;"></i>',
                                "titleAttr": 'Print',                                
                                "action": newexportaction
                           }
        ],
        modifier: {
            order: 'current',
            page: 'all',
            selected:null,
    },
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

    function newexportaction(e, dt, button, config) {
    var self = this;
    var oldStart = dt.settings()[0]._iDisplayStart;
    dt.one('preXhr', function (e, s, data) {
        // Just this once, load all data from the server...
        data.start = 0;
        data.length = 2147483647;
        dt.one('preDraw', function (e, settings) {
            // Call the original action function
            if (button[0].className.indexOf('buttons-copy') >= 0) {
                $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-excel') >= 0) {
                $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                    $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                    $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                    $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
                    $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-print') >= 0) {
                $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
            }
            dt.one('preXhr', function (e, s, data) {
                // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                // Set the property to what it was before exporting.
                settings._iDisplayStart = oldStart;
                data.start = oldStart;
            });
            // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
            setTimeout(dt.ajax.reload, 0);
            // Prevent rendering of the full data to the DOM
            return false;
        });
    });
    // Requery the server with the new one-time export settings
    dt.ajax.reload();
};

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
