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


    <title>รายงานบัตรคงเหลือ</title>


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
                <div class="form-group">
                    <div class="input-group-prepend">
                                    <label class="input-group-text" id="lb-n-1" for="type-activity">รหัสกิจกรรม</label>
                                    <input class="form-control col-md-2" id="type" name="type"  type="text"/>
                                    <select id="type-activity" class="form-control"></select>
                    </div>
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
            
            <table id="order_data" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr align="center">
                <th>บัตรที่ใช้</th>
                <th>กิจกรรมที่เล่น</th>
                <th>จำนวน</th>
            </tr>
            </thead>
                <tbody align="center"></tbody>

                <tfoot>
                <tr align="right" >
                <th colspan="2" >รวม</th>
                <th id="total"></th>
                </tr>
                </tfoot>
            </table>
            </div>     
        </div>
    </div>
    
    
    


    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
   
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
    
    $('#type-activity').change(function(){
        var showValue = $(this).val()
        $('#type').val(showValue);
      });
   
      loadTypeactivity();
  
    fetch_data('no');

function fetch_data(is_date_search, start_date='', end_date='' , changeType='')
{

    var dataTable = $('#order_data').DataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "ajax" : {
     url:"Model/index.php",
     type:"POST",
     data:{
        type:'getSumActivityX',
        start_date:start_date, 
        end_date:end_date,
        change:changeType
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


$('#search').click(function(){
    var changeType  = $('#type-activity').val();
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
  if(start_date != '' && end_date !='' && changeType != '')
  {
   $('#order_data').DataTable().destroy();
   fetch_data('yes', start_date, end_date , changeType );
  }
  else
  {
   alert("กรุณาเลือกวันที่ ! !");
  }
 }); 

 function loadTypeactivity(){
        $('#type-activity').empty();
        $('#type-activity').append("<option>Loading...</option>");
        $.ajax({
            url: "./Model/index.php" , 
            method: "POST" , 
            data:{
                type : 'type-activity'
            },
            
            success:function(data)
            {
                var obj = jQuery.parseJSON(data);
                $('#type-activity').empty();
                $('#type-activity').append("<option value=''>เลือกโหมดกิจกรรม</option>"); 
                $.each(obj.message , function(i , item){    
                var userid = item['idactivity'];
                var name = item['nameactivity'];
                $('#type-activity').append('<option value="' +  userid +'"> '+ name +' </option>');
                });
            }
        })
    }
   
  
 });
 
</script>
