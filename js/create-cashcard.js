$(document).ready(function(){
    //toggle
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });
    var activity = []

    var department = $('#department').text()

    onload_Package(department); 

    var count = 0;
      $('.item_category').each(function(){
          var count = 1;

          if($(this).val() == '')
          {
            error += '<p>Select Item Category at '+count+' row</p>';
            return false;
          }

          count = count + 1;

        });
//add table dynamic multiple
    $(document).on('change', '#amount-activity', function(){
        var id = $(this).val();
        fetch_nameactivity()
        for (let index = 0; index < id; index++) {
            count++;
            var html = '';
            html += '<tr>';
            html += '<td>' +count +'</td>';
            html += '<td><input type="text" name="item_name[]" class="form-control item_name" /></td>';
            html += '<td><select name="item_category[]" class="form-control item_category" data-sub_category_id="'+count+'"></select></td>';
            html += '<td><button type="button" name="remove" class="btn btn-danger btn-xs remove"><span class="glyphicon glyphicon-minus"></span></button></td>';
            $('#item_table').append(html);
        }
        
    })
//add table 1 row
    $(document).on('click', '.add', function(){
        count++;
        fetch_nameactivity()
        var html = '';
        html += '<tr>';
        html += '<td>' +count +'</td>';
        html += '<td><input type="text" name="item_name[]" class="form-control item_name" /></td>';
        html += '<td><select name="item_category[]" class="form-control item_category" data-sub_category_id="'+count+'"></select></td>';
        html += '<td><button type="button" name="remove" class="btn btn-danger btn-xs remove"><span class="glyphicon glyphicon-minus"></span></button></td>';
        html += '</tr>';
        $('#item_table').append(html);
      });
//remove row
      $(document).on('click', '.remove', function(){
        count--;
        $(this).closest('tr').remove();
        return false;
      });

      //change activity to Table
      $('#item_table > tbody:last').on('change' , '.item_category' , function(){
        var currow = $(this).closest('tr');
        var category_id = $(this).val();
       // console.log(category_id)
        currow.find('.item_name').val(category_id);
      
    }); 

    

    $(document).on('change' , '#id-package' , function(){
        var id = $(this).val();
        $('#txt_package').val(id);
    })

    $('#insert_form').on('submit', function(event){
        event.preventDefault();
        var error = '';
        $('.item_name').each(function(){
          var count = 1;
          if($(this).val() == '')
          {
            error += '<p>กรุณาเลือกกิจกรรม '+count+' Row</p>';
            return false;
          }
          count = count + 1;
        });

        $('.item_category').each(function(){
          var count = 1;

          if($(this).val() == '')
          {
            error += '<p>กรุณาเลือกกิจกรรม '+count+' </p>';
            return false;
          }

         // activity.push($(this).val())

          count = count + 1;

        });


        var form_data = $(this).serialize();

        $('#item_table > tbody > tr').each(function(row, tr){
            activity.push($(tr).find('.item_category').val()); 
        });   

        var addcard = "create";
       // activity = $('.item_category').val()
        var cusid = $('#customerid').val().toUpperCase();
        var codecus = $('#codecustomer').val();
        var amountCustomer = $('#countcustomer').val();
        var changeAmountActivity = $('#amount-activity').val();
        var department = $('#id-package').val();
        var package = $('#id-package').val();
        var userid1 = $('#userid').val();
        var radioValue = $("#permission:checked").val();
        var note = $("#note").val();
        if(radioValue == 1){
            radioValue = 'ราคาปกติ';
        }else if(radioValue == 2){
            radioValue = 'ขออนุมัติ ส่วนลด จาก GM ใน WRIKE แล้ว';
        }else if(radioValue == 3){
            radioValue = 'ขออนุมัติ ส่วนลด จากคุณเล็ก ใน Line แล้ว';
        }
        var getMoney = $('#getMoney').val();
        if(department == '0008')
        {
            department = 'ขายออนไลน์ BigSale'
        }else if(department == '0006')
        {
            department = 'ขายกรุ๊ป'
        }else if(department == '0014')
        {
            department = 'ขายกรุ๊ป BigSale'
        }
        else if(department == '0007')
        {
            department = 'ขายออนไลน์'
        }else if(department == '0001')
        {
            department = 'ขายออนไลน์  Extream Gang'
        }else if(department == '0002')
        {
            department = 'ขายออนไลน์  Adventure Gang '
        }else if(department == '0003')
        {
            department = 'ขายออนไลน์ Super3 (วันธรรมดา)'
        }else if(department == '0003')
        {
            department = 'ขายออนไลน์ Super3 (วันธรรมดา)'
        }else if(department == '0009')
        {
            department = 'ขายออนไลน์ FarmMe'
        }else if(department == '0010')
        {
            department = 'ขายออนไลน์ Go-Khaoyai'
        }
        var tdatein = new Date($('#datein').val());
        day = tdatein.getDate();
        month = tdatein.getMonth() + 1;
        year = tdatein.getFullYear() ;
        

        var dateout = new Date($('#dateout').val());
        dayout = dateout.getDate();
        monthout = dateout.getMonth() + 1;
        yearout = dateout.getFullYear();
        if (day < 10) 
        day = "0" + day;
        if (dayout < 10) 
        dayout = "0" + dayout;
        var checkin  = [year , month , day].join('-');
        var checkout  = [yearout , monthout , dayout].join('-');


      //  var debuging = cusid + '=>' + codecus + '=>' + amountCustomer + '=>' + changeAmountActivity + '=>' + package + '=>' + userid1 + '=>' + note + '=>' + checkin + '=>' + checkout + '=>' + activity
      //  console.log(debuging)
        if(cusid == '' && codecus == '' && amountCustomer == '' && amountCustomer == 0 && changeAmountActivity == 0 && changeAmountActivity == ''&& radioValue == undefined &&
        package == '' && userid1 == '' && note == '' && checkin == '' && checkin == isNaN && checkout == '' && checkout == isNaN && activity == 0 && activity == '' && getMoney == '')
        {
            alert('กรุณาตรวจสอบข้อมูล');
        }
        if(error == '')
        {
            $.ajax({
                url: "Model/index.php" , 
                method: "POST" , 
                data:{
                    type:addcard,
                    cusid:cusid,
                    codecus:codecus,
                    amount:amountCustomer ,
                    change:changeAmountActivity,
                    datein: checkin,
                    dateout: checkout,
                    package: package,
                    listactivity:activity,
                    permiss : radioValue,
                    money : getMoney,
                    departner : department,
                    note : note,
                    userid:userid1
                } , 
                dataType :'json',
                beforeSend:function()
                {
                $('#btn-create').attr('disabled', 'disabled');
                $('#process').css('display', 'block');
                },
                success:function(data)
                {
                    var percentage = 0;
                    if(data.error === false){
                        $('#error').html('<div class="alert alert-danger">' + data.message + '</div>');
                        $('#process').css('display', 'none');
                        $('.progress-bar').css('width', '0%');
                        $('#btn-create').attr('disabled', false);
                        activity = []
                    }else{
                        var timer = setInterval(function(){
                            percentage = percentage + 20;
                            progress_bar_process(percentage, timer , data.message, cusid, codecus, amountCustomer, checkin, checkout);
                           
                        }, 1000);
                        
                    }
                 
                }
            })
        }
        else
        {
          $('#error').html('<div class="alert alert-danger">'+error+'</div>');
        }

      });


      //fetch activity
      function fetch_nameactivity()
{
        $.ajax({
            url: "./Model/fetch_create.php" , 
            method: "POST" , 
            data:{
                type : 'activity_type'
            },
            
            success:function(data)
            {
                var obj = jQuery.parseJSON(data);
                $('.item_category').empty();
                $('.item_category').append("<option value=''>เลือกกิจกรรม</option>");
                $.each(obj , function(i , item){
                   
                var id = item['idactivity'];
                var name = item['nameactivity'];
                $('.item_category').append('<option value="' +  id +'"> '+ name +' </option>');
                });
            }
        })
}

function onload_Package(department){
    //  console.log(department)
      $('#id-package').empty();
      $('#id-package').append("<option>Loading...</option>");
      $.ajax({
          url: "./Model/index.php" , 
          method: "POST" , 
          data:{
              type : department,
          },
          
          success:function(data)
          {
              var obj = jQuery.parseJSON(data);
              $('#id-package').empty();
              $('#id-package').append("<option value=''>เลือกแพคเกจ</option>"); 
              $.each(obj.message , function(i , item){    
              var you = item['idpackage'];
              var name = item['name'];
              $('#id-package').append('<option value="' +  you +'"> '+ name +' </option>');
              });
          }
      })
  }

  function progress_bar_process(percentage, timer, message, cusid, codecus, amountCustomer, checkin, checkout)
  {
    var url = "printer-card.php?id=" + encodeURIComponent(cusid) + "&name=" + encodeURIComponent(codecus) + "&amount=" + encodeURIComponent(amountCustomer) +  "&typecard=" + encodeURIComponent('')  + "&datein=" + encodeURIComponent(checkin) + "&dateout=" + encodeURIComponent(checkout);
   $('.progress-bar').css('width', percentage + '%');
   if(percentage > 100)
   {
    clearInterval(timer);
    $('#process').css('display', 'none');
    $('.progress-bar').css('width', '0%');
    $('#btn-create').attr('disabled', false);
    $('#item_table').find('tr:gt(0)').remove();
    $('#error').html('<div class="alert alert-success">' + message +'</div>');
    $('#customerid').val('');
    $('#codecustomer').val('');
    $('#countcustomer').val('');
    $('#id-package').val('');
    $('#dateout').val('');
    $('#datein').val('');
    $('.item_category').val('');
    $('#txt_package').val('');
    $('#getMoney').val(0);
    $('#note').val('');
    activity=[];
    count = 0
    setTimeout(function(){
     $('#error').html('');
     Swal.fire({
        title: 'คุณแน่ใจ ?',
        text: "ว่าต้องการพิมพ์บัตร",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ใช่, ฉันต้องการพิมพ์บัตร',
        cancelButtonText: 'ยกเลิก'
      }).then((result) => {
        if (result.value) {
            window.location.href = url;
        }
      })
     
    }, 2000);
   }
  }



})