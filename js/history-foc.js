jQuery(document).ready(function($){
    
    onload_Package();    
    $('#userid-ch').change(function(){
        var showValue = $(this).val()
        $('#userid-1').val(showValue);
      });

      fetch_data('no');

      //ค้นหาข้อมูล

      $('#search').click(function(){
        var userid = $('#userid-ch').val();
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
       fetch_data('yes', userid ,start_date, end_date);
      }
      else
      {
       alert("กรุณาเลือกวันที่ ! !");
      }
     });   

}); 


function fetch_data(userid='', start_date='', end_date='')
{
    var userid = $('#userid-ch').val();
    var dataTable = $('#order_data').DataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "ajax" : {
     url:"Model/his.php",
     type:"POST",
     data:{
        userid:userid,
        start_date:start_date, 
        end_date:end_date 
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
     $('#total_group').html(settings.json.total_group);
     $('#total_customer').html(settings.json.total_customer);
     $('#total_totalAll').html(settings.json.total_totalAll);
     $('#total_amountwaitplay').html(settings.json.total_amountwaitplay);
     $('#total_playpass').html(settings.json.total_playpass);
    }
   });
}

    
    function onload_Package(){
        $('#userid-ch').empty();
        $('#userid-ch').append("<option>Loading...</option>");
        $.ajax({
            url: "./Model/index.php" , 
            method: "POST" , 
            data:{
                type : 'userList'
            },
            
            success:function(data)
            {
                var obj = jQuery.parseJSON(data);
                $('#userid-ch').empty();
                $('#userid-ch').append("<option value=''>เลือกชื่อพนักงาน</option>"); 
                $.each(obj.message , function(i , item){    
                var userid = item['userid'];
                var name = item['fname'];
                $('#userid-ch').append('<option value="' +  userid +'"> '+ name +' </option>');
                });
            }
        })
    }