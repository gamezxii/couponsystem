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


    <title>รายงานลูกค้าเข้า</title>


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
                <th>ชื่อกรุ๊ป</th>
                <th>จำนวนลูกค้า</th>
                <th>ประเภทบัตรกิจกรรม</th>
                <th>จำนวนทั้งหมด</th>
                <th>จำนวนรอเล่น</th>
                <th>จำนวนเล่นแล้ว</th>
            </tr>
        </thead>
                <tbody align="center">
                </tbody>
                <tfoot>
                <tr align="right">
              <th id="total_group"></th>
              <th id="total_customer"></th>
              <th id="total_typeactivity"></th>
              <th id="total_all"></th>
              <th id="total_withplay"></th>
              <th id="total_previewplay"></th>
              </tr>
                </tfoot>
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
<script src="main.js"></script>

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


   
    
  
    fetch_data('no');

function fetch_data(is_date_search, start_date='', end_date='')
{
 var dataTable = $('#order_data').DataTable({
  //  "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
  "pageLength": 100,
  dom: 'lBfrtip',
  buttons:[
      'excel',
      'pdf',
      'print'
  ],
  "processing" : true,
  "serverSide" : true,
  "order" : [],
  "ajax" : {
   url:"Model/cusdatein.php",
   type:"POST",
   data:{
    is_date_search:is_date_search, start_date:start_date, end_date:end_date
   },
   drawCallback:function(data)
   {
    var text= "รวม "
      var text1= "คงเหลือ "
      var text2= "ใช้ไป "
      var result  = settings.json.total_count
      var resukt = settings.json.total
      var ans  = result - resukt
     $('#total_group').html(text   + " กลุ่ม");
     $('#total_customer').html(text + " ใบ");
     $('#total_typeactivity').html(text1  );
     $('#total_all').html(text2 );
     $('#total_withplay').html(text1   );
     $('#total_previewplay').html(text2  );
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
   $('#order_data').DataTable().destroy();
   fetch_data('yes', start_date, end_date);
  }
  else
  {
   alert("กรุณาเลือกวันที่ ! !");
  }
 }); 

   
  
 });
 
</script>
