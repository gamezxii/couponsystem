<?php
include('Model/config.php');
include('Model/session.php');
$userDetails=$userClass->userDetails($session_uid);
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.2.61/jspdf.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="template/coupon.gif">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <style>
            body {
    margin: 0;
    }

    .container {
    }

    .chart-wrapper {
    width: 100%;
    height: 100%;
    margin: 0 auto;
    }
    

    </style>
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
                    
            
                    <div class="container d-flex flex-column justify-content-center align-items-center">
                    <div class="chart-wrapper">
                    <canvas id="myChart" >
                    <canvas id="chartAll" >
                    </div>
                    </div>
                    
                    <button type="button" id="download-pdf2" >PDF</button>                
               
                    
                </div>
            </div>
            
          
            
        
        
           
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
            <!-- Bootstrap JS -->
       

</body>

</html>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="main.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){


    var point , activity_play;
    document.getElementById('download-pdf2').addEventListener("click", downloadPDF2);
    var labels = [
    'ขับรถเอทีวี1รอบ/ท่าน' , 'ขับรถโกคาร์ท3รอบสนาม/ท่าน' , 'ซุปเปอร์บอล1รอบ/ท่าน' , 'พาวน์เวอร์โบ๊ท1รอบ/ท่าน' , 'เจ็ทไรเดอร์ 4รอบ/ท่าน' , 'เจ็ทไรเดอร์ 2 รอบ/ท่าน' ,'เพนท์บอลเป้านิ่ง 20 นัด' , 'เพนท์บอลเป้านิ่ง 10 นัด' , 'ยิงธนู 10 ดอก' , 'ยิงธนู 5 ดอก'
 , 'ยิงปืนโบราณ 20 นัด' , 'ยิงปืนโบราณ 10 นัด' , 'จักรยานน้ำ 30 นาที / ท่าน' , 'บั๊มคาร์คอมแบท 1 รอบ / ท่าน' , 'เกมส์โซน 1 เกมส์'  ,'เพนท์บอลสนาม 40 นัด/ท่าน' , 'เพนท์บอลสนาม 20 นัด/ท่าน' , 'เพิ่มกระสุนเพนท์บอลสนาม 10 นัด' , 'เพิ่มกระสุนเพทน์บอลสนาม 20 นัด' , 'ฐานน้ำ 4 ด่าน / ท่าน' 
 , 'ฐานน้ำ 2 ด่าน / ท่าน' , 'ฐานน้ำ 1 ด่าน / ท่าน','เลเซอร์คอมแบท 1 ท่าน' , 'ทำเทียน' , 'ปั้นดิน' , 'เก็บไข่ไก่' , 'เก็บเห็ด' , 'ทำก้อนเชื้อเห็ด' , 'ทำพิซซ่า' , 'ทำสลัด'
  , 'เพนท์กระถาง' , 'ตัดเมล่อน 1 ลูก','บัตรเข้าฟาร์มแกะ + หญ้า 1 กำ'  , 'บัตรให้อาหารสัตว์ 1 ชนิด'  , 'บัตรเข้าฟาร์มแกะ 1 ท่าน' , 'บัตรนั่งรถรางชมไร่1ท่าน' , 'กิจกรรม X' , 'กิจกรรม Y' , 'กิจกรรม Z' , 'ทำสบู่ / แชมพู' 
  , 'นั่งรถรางชมไร่+เก็บมัลเบอรี่1กระปุก',  'ร้อยมาลัย 1 พวง' , 'DIY Cooking Class 1 อย่าง' , 'ปลูกผัก' , 'วอร์คแรลลี่ฐาน A ละลายพฤติกรรม' , 'วอร์คแรลลี่ฐาน A ไม่ละลายพฤติกรรม' , 'วอร์คแรลลี่ฐาน B' , 'วอร์คแรลลี่ฐาน C' , 'วิทยากร' , 'ฐานน้ำ' , 'หญ้า 1 กำ' , 'นม 1 ขวด' , 'อาหารกระต่าย 1 กระปุก' , 'จัดสวน'];
    //download pdf form hidden canvas
    function downloadPDF2() {
        var newCanvas = document.querySelector('#myChart');

        var newCanvasImg = newCanvas.toDataURL("image/jpeg", 1.0);    
        var doc = new jsPDF('landscape');
        doc.setFontSize(20);
        doc.text(15, 15, "Super Cool Chart");
        doc.addImage(newCanvasImg, 'JPEG', 10, 10, 0, 0 );
        doc.save('รายงานสรุปผลประจำวัน.pdf');

    }


$('#search').click(function(){
var tdatein = new Date($('#start_date').val());
    day = tdatein.getDate();
    if (day < 10) 
        day = "0" + day;
    month = tdatein.getMonth() + 1;
    year = tdatein.getFullYear() ;
    var start_date  = [year , month , day].join('-');
    var dateout = new Date($('#end_date').val());
    dayout = dateout.getDate();
    if (dayout < 10) 
    dayout = "0" + dayout;
    monthout = dateout.getMonth() + 1;
    yearout = dateout.getFullYear();
    var end_date  = [yearout , monthout , dayout].join('-');
    if(tdatein == '' && dateout == ''){
       alert('Plase Select Date')
    }else{
        $.ajax({
                url: 'Model/report-chart.php',
                method: 'POST',
                data:{
                    type: 'search',
                    start: start_date , 
                    end: end_date
                },
                success:function(data){
                   var response = jQuery.parseJSON(data);
                   $.each(response ,  function(i , item){
                    var id6101 = item.id6101;
                    var id6102 = item.id6102;
                    var id6103 = item.id6103;
                    var id6104 = item.id6104;
                    var id6105 = item.id6105;
                    var id6106 = item.id6106;
                    var id6107 = item.id6107;
                    var id6108 = item.id6108;
                    var id6109 = item.id6109;
                    var id6110 = item.id6110;
                    var id6111 = item.id6111;
                    var id6112 = item.id6112;
                    var id6113 = item.id6113;
                    var id6114 = item.id6114;
                    var id6115 = item.id6115;
                    var id6116 = item.id6116;
                    var id6117 = item.id6117;
                    var id6118 = item.id6118;
                    var id6119 = item.id6119;
                    var id6120 = item.id6120;
                    var id6121 = item.id6121;
                    var id6122 = item.id6122;
                    var id6123 = item.id6123;
                    var id6124 = item.id6124;
                    var id6125 = item.id6125;
                    var id6126 = item.id6126;
                    var id6127 = item.id6127;
                    var id6128 = item.id6128;
                    var id6129 = item.id6129;
                    var id6130 = item.id6130;
                    var id6131 = item.id6131;
                    var id6132 = item.id6132;
                    var id6133 = item.id6133;
                    var id6134 = item.id6134;
                    var id6135 = item.id6135;
                    var id6136 = item.id6136;
                    var id6137 = item.id6137;
                    var id6138 = item.id6138;
                    var id6139 = item.id6139;
                    var id6140 = item.id6140;
                    var id6141 = item.id6141;
                    var id6142 = item.id6142;
                    var id6143 = item.id6143;
                    var id6144 = item.id6144;
                    var id6145 = item.id6145;
                    var id6146 = item.id6146;
                    var id6147 = item.id6147;
                    var id6148 = item.id6148;
                    var id6149 = item.id6149;
                    var id6150 = item.id6150;
                    var id6151 = item.id6151;
                    var id6152 = item.id6152;
                    var id6153 = item.id6153;
                    var id6154 = item.id6154;
                    point = [id6101 , id6102 , id6103 ,id6104 ,id6105 ,id6106 ,id6107 ,id6108 ,id6109 ,id6110,
                    id6111 , id6112 , id6113 ,id6114 ,id6115 ,id6116 ,id6117 ,id6118 ,id6119 ,id6120,
                    id6121 , id6122 , id6123 ,id6124 ,id6125 ,id6126 ,id6127 ,id6128 ,id6129 ,id6130,
                    id6131 , id6132 , id6133 ,id6134 ,id6135 ,id6136 ,id6137 ,id6138 ,id6139 ,id6140,
                    id6141 , id6142 , id6143 , id6144 , id6145 , id6146 , id6147 , id6148 , id6149 , id6150 , id6151 , id6152 ,id6153 ,id6154];
                    
                    showChart1(point);
                //    showChart2(activity_play)
                   });
                }
            });
    }
    
}); 



var ctx = document.getElementById('myChart').getContext('2d');

function showChart1(point){
    var myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: point,
                            backgroundColor:backgroundColor ,
                            borderColor: 'white',
                            borderWidth: 3
                        }]
                    },
                    showDatapoints: true,
                    options:{
                        title: {
                            display: true,
                            text: 'รายงานสรุปยอดกิจกรรม',
                            fontSize : 30
                        },
                        tooltips:{
                            enabled:false
                        },
                       
                        responsive: true,
                        maintainAspectRatio:true,
                        responsiveAnimationDuration:0,
                        legend:{
                            position:'left',
                        },

                        animation:{
                            animateScale:true,
                            animateRotate:true
                        }
                        ,
                        plugins: {
                        legend: false,
                        labels:[
                            {
                                render: 'label',
                                position: 'outside',
                                precision: 0,
                                shadowOffsetX: -5,
                                shadowOffsetY: 5,
                                overlap: true,
                                textMargin: 7,
                                render: (args) => {
                                return `${args.label}: ${args.percentage}%  : ${args.value} ครั้ง`;
                            }
                            }
                        ]
                        }
                    },
                })
}

var ctx1 = document.getElementById('chartAll').getContext('2d');

function showChart2(activity_play){
    var myPieChart = new Chart(ctx1, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: activity_play,
                            backgroundColor:backgroundColor ,
                            borderColor: 'white',
                            borderWidth: 3
                        }]
                    },
                    showDatapoints: true,
                    options:{
                        title: {
                            display: true,
                            text: 'รายงานสรุปยอดกิจกรรม',
                            fontSize : 30
                        },
                        tooltips:{
                            enabled:false
                        },
                       
                        responsive: true,
                        maintainAspectRatio:true,
                        responsiveAnimationDuration:0,
                        legend:{
                            position:'left',
                        },

                        animation:{
                            animateScale:true,
                            animateRotate:true
                        }
                        ,
                        plugins: {
                        legend: false,
                        labels:[
                            {
                                render: 'label',
                                position: 'outside',
                                precision: 0,
                                shadowOffsetX: -5,
                                shadowOffsetY: 5,
                                overlap: true,
                                textMargin: 7,
                                render: (args) => {
                                return `${args.label}: ${args.percentage}%  : ${args.value} ครั้ง`;
                            }
                            }
                        ]
                        }
                    },
                })
}

var backgroundColor = [
                '#FFCCE5',
                '#CCCCFF',
                '#CCFFFF',
                '#CCFFCC',
                '#FFFFCC',
                '#FFCCCC',
                '#E0E0E0',
                '#FF99CC',
                '#FF99FF',
                '#9999FF',
                '#99CCFF',
                '#99FFFF',
                '#99FFCC',
                '#CCFF99',
                '#FFCC99',
                '#FF9999',
                '#C0C0C0',
                '#FF66B2',
                '#B266FF',
                '#6666FF',
                '#66B2FF',
                '#66FF66',
                '#FFFF66',
                '#FFB266',
                '#FF6666',
                '#FF3333',
                '#FF9933',
                '#FFFF33',
                '#33FF33',
                '#33FF99',
                '#3399FF',
                '#3333FF',
                '#9933FF',
                '#FF33FF',
                '#FF3399',
                '#A0A0A0',
                '#404040',
                '#99004C',
                '#990099',
                '#4C0099',
                '#000066',
                '#006666',
                '#006600',
                '#666600'
            ];




});

</script>