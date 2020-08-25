
$(document).ready(function(){


    var dataTable = $('#list_category').DataTable({
    responsive: true,
    dom: 'lBfrtip',
    buttons:[
        'pdf',
        'print'
    ],
    "processing":true,
    "serverSide":true,
    "bDestroy": true,
    "order":[],
    "ajax":{
     url:"./Model/edit-senior.php",
     type:"POST"
    },
    "columnDefs":[
     {
      "targets":[0, 2],
      "orderable":false,
     },
    ],
    "oLanguage": {

        "sLengthMenu": "แสดง _MENU_ เร็คคอร์ด ต่อหน้า",
        
        "sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
        
        "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ เร็คคอร์ด",
        
        "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
        
        "sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",
        
        "sSearch": "ค้นหา" ,

        "oPaginate": {
            "sFirst": "หน้าแรก",
             "sLast": "หน้าสุดท้าย",
             "sNext": "ถัดไป",
             "sPrevious": "กลับ"
                   }
     }
  
   });

   $(document).on('submit', '#category_form', function(event){
    event.preventDefault();
    var cateid = $('#Idbill').val();
    var catename = $('#noseniofsoft').val();
    if(cateid != '' && catename != '')
    {
        $.ajax({
            url:"./Model/index.php",
            method:'POST',
            data:new FormData(this),
            contentType:false,
            processData:false,
            dataType:"json",
            success:function(data)
            {
                        alert(data.message);
                        $('#category_form')[0].reset();
                        $('#categoryModal').modal('hide');
                        dataTable.ajax.reload();
            }
        });
    }
    else
    {
        alert("กรุณากรอกข้อมูล");
    }
});  

$(document).on('click', '.update', function(){
    var billid = $(this).attr("id");
    $.ajax({
        url:"./Model/index.php",
        method:"POST",
        data:{
            type : 'selectCategoryUpdateId',
            idbill:billid
        },
        dataType:"json",
        success:function(data)
        {          
            $.each(data.message , function(k , v){
                var userid ,  bill;
                userid = v['groupid'];
                bill = v['noseniorsoft'];
                $('#categoryModal').modal('show');
                $('#Idbill').val(userid);
                $('#noseniorsoft').val(bill);
                $('#type').val("updateProduct");
            });
             
           
        }
    })
});


});

