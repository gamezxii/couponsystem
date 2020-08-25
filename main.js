jQuery(document).ready(function($){

   

    //-------------------------create-cashcard.html
    var department;
    
    var getValueSelectArray = [];
    var result = [];
    $('#btn-create').click(function(){
        var addcard = "create";
        var cusid = $('#customerid').val().toUpperCase();
        var codecus = $('#codecustomer').val();
        var amountCustomer = $('#countcustomer').val();
        var changeAmountActivity = $('#amount-activity').val();
        var package = $('#id-package').val();
        var userid1 = $('#userid').val();
        var radioValue = $("input[name='permission']:checked").val();
        var note = $("#note").val();
        console.log(note)
        if(radioValue == 1){
            radioValue = 'ราคาปกติ';
        }else if(radioValue == 2){
            radioValue = 'ขออนุมัติ ส่วนลด จาก GM ใน WRIKE แล้ว';
        }else if(radioValue == 3){
            radioValue = 'ขออนุมัติ ส่วนลด จากคุณเล็ก ใน Line แล้ว';
        }
        var getMoney = $('#getMoney').val();

        if(getMoney == ''){
                $('#getMoney').addClass().css('background-color', 'red');
                Swal.fire('กรุณากรอกช่องเก็บเงินลูกค้า')
        }else{
            $('#getMoney').addClass().css('background-color', 'white');
        }

        if(department == '0008')
        {
            department = 'ขายออนไลน์ BigSale'
        }else if(department == '0006')
        {
            department = 'ขายกรุ๊ป'
        }else if(department == '0007')
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
        
        //console.log(department);

        result =  checkValiateSelected();

        var tdatein = new Date($('#datein').val());
        day = tdatein.getDate();
        month = tdatein.getMonth() + 1;
        year = tdatein.getFullYear() ;
        var datein1  = [year , month , day].join('-');

        var dateout = new Date($('#dateout').val());
        dayout = dateout.getDate();
        monthout = dateout.getMonth() + 1;
        yearout = dateout.getFullYear();
        var dateout1  = [yearout , monthout , dayout].join('-');
        if (day < 10) 
        day = "0" + day;
        if (dayout < 10) 
        dayout = "0" + dayout;
        
       
        if(cusid != '' && codecus != '' && datein != '' && amountCustomer !='' && changeAmountActivity != '' && tdatein != '' 
        && dateout1 != '' && result != '' && package != '' && getMoney != '' && radioValue != '' && radioValue != undefined && note != '')
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
                    datein: datein1,
                    dateout: dateout1,
                    package: package,
                    listactivity:result,
                    permiss : radioValue,
                    money : getMoney,
                    departner : department,
                    note : note,
                    userid:userid1
                } , 
                success:function(data)
                {
                    var responseObject = jQuery.parseJSON(data);
                    if(responseObject.error === false){
                        alert(responseObject.message);
                    }else{
                        Swal.fire({
                            type: 'success',
                            title: responseObject.message,
                            showConfirmButton: false,
                            timer: 1500
                          })
                        $('#customerid').val('');
                        $('#codecustomer').val('');
                        $('#countcustomer').val('');
                        $('#id-package').val('');
                        $('#dateout').val('');
                        $('#datein').val('');
                        $('#id-activity-1').val('');
                        $('#id-activity-2').val('');
                        $('#id-activity-3').val('');
                        $('#id-activity-4').val('');
                        $('#id-activity-5').val('');
                        $('#id-activity-6').val('');
                        $('#id-activity-7').val('');
                        $('#id-activity-8').val('');
                        $('#id-activity-9').val('');
                        $('#id-activity-10').val('');
                        $('#id-activity-11').val('');
                        $('#id-activity-12').val('');
                        $('#id-activity-13').val('');
                        $('#id-activity-14').val('');
                        $('#id-activity-15').val('');
                        $('#txt_package').val('');
                        $('#txt_id-1').val('');
                        $('#txt_id-2').val('');
                        $('#txt_id-3').val('');
                        $('#txt_id-4').val('');
                        $('#txt_id-5').val('');
                        $('#txt_id-6').val('');
                        $('#txt_id-7').val('');
                        $('#txt_id-8').val('');
                        $('#txt_id-9').val('');
                        $('#txt_id-10').val('');
                        $('#txt_id-11').val('');
                        $('#txt_id-12').val('');
                        $('#txt_id-13').val('');
                        $('#txt_id-14').val('');
                        $('#txt_id-15').val('');
                        $('#getMoney').val(0);
                        $('#note').val('');

                    }
                }
            })
        }
        else
        {
            Swal.fire('กรุณากรอกข้อมูล')
        }  

    });


    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    
   //getDataFromDb();
   

 //Combobox 1-15

  $('#amount-activity').change(function(){
    var chageActivity = $(this).val();
    switch(chageActivity){
        case '1':
               HideCombobox();
        break;
        case '2':
                showComboBox2();
        break;
        case '3':
                showCombobox3();
        break;
        case '4':
                showCombobox4();
        break;
        case '5':
                showCombobox5();
        break;
        case '6':
                showComboBox6();
        break;
        case '7':
                showComboBox7();
        break;
        case '8':
                showComboBox8();
        break;
        case '9':
                showComboBox9();
        break;
        case '10':
                showComboBox10();
        break;
        case '11':
                showComboBox11();
        break;
        case '12':
                showComboBox12();
        break;
        case '13':
                showComboBox13();
        break;
        case '14':
                showComboBox14();
        break;
        case '15':
                showComboBox15();
        break;
        default:
            alert('Not found..');
        break;
    }


  });

  $('#id-package').change(function(){
    var showValue = $(this).val()
    var showParameter = $(this).val()
    $('#txt_package').val(showValue);
    department = showValue; // $( "#id-package option:selected" ).text();

  });

  $('#id-activity-1').change(function(){
    var showValue = $(this).val()
    $('#txt_id-1').val(showValue);
  });
  $('#id-activity-2').change(function(){
    var showValue = $(this).val()
    $('#txt_id-2').val(showValue);
  });
  $('#id-activity-3').change(function(){
    var showValue = $(this).val()
    $('#txt_id-3').val(showValue);
  });
  $('#id-activity-4').change(function(){
    var showValue = $(this).val()
    $('#txt_id-4').val(showValue);
  });
  $('#id-activity-5').change(function(){
    var showValue = $(this).val()
    $('#txt_id-5').val(showValue);
  });
  $('#id-activity-6').change(function(){
    var showValue = $(this).val()
    $('#txt_id-6').val(showValue);
  });
  $('#id-activity-7').change(function(){
    var showValue = $(this).val()
    $('#txt_id-7').val(showValue);
  });
  $('#id-activity-8').change(function(){
    var showValue = $(this).val()
    $('#txt_id-8').val(showValue);
  });
  $('#id-activity-9').change(function(){
    var showValue = $(this).val()
    $('#txt_id-9').val(showValue);
  });
  $('#id-activity-10').change(function(){
    var showValue = $(this).val()
    $('#txt_id-10').val(showValue);
  });
  $('#id-activity-11').change(function(){
    var showValue = $(this).val()
    $('#txt_id-11').val(showValue);
  });
  $('#id-activity-12').change(function(){
    var showValue = $(this).val()
    $('#txt_id-12').val(showValue);
  });
  $('#id-activity-13').change(function(){
    var showValue = $(this).val()
    $('#txt_id-13').val(showValue);
  });
  $('#id-activity-14').change(function(){
    var showValue = $(this).val()
    $('#txt_id-14').val(showValue);
  });
  
  $('#id-activity-15').change(function(){
    var showValue = $(this).val()
    $('#txt_id-15').val(showValue);
  });
  
  $('#btn-addUser').click(function(){
    
  });


  

//   $('#btn-test').click(function(){
//     result =  checkValiateSelected();

//     if(result  != 'undefined' && result != ''){
//         alert(result);
//     }else{
//         alert('กรุณาเลือกกิจกรรม');
//     }

//   });
/* Setting user function Pages  */
list_SettingUsers();



$('#openAdduser').click(function(){
    $("#myModal").modal('toggle');
    document.getElementById("titlehead").innerHTML = 'เพิ่มสมาชิก'; 
    $('.addUsertxt').show();
    $('.editUsertxt').hide();
});

$('#btn-addUser').click(function(){
    var userid = $('#userid').val();
    var fname = $('#fname').val();
    var lname = $('#lname').val();
    var email = $('#email').val();
    var password = $('#password').val();
    var status = $("#status-class").children("option:selected").val();
    if(userid != '' && fname != '' && lname !='' && email !='' && password != '' && status != '' ){
        $.ajax({
            url: 'Model/index.php',
            method: 'POST',
            data:{
                type:'register',
                userid:userid,
                fname:fname,
                lname:lname,
                email:email,
                password:password,
                status:status
            },
            success:function(response)
            {
                var responseObject = jQuery.parseJSON(response);
                if(responseObject.error == 'true'){
                    alert(responseObject.message);
                }else{
                    alert(responseObject.message);
                }
                $("#myModal").modal('hide');
                $("#formAddorEdit")[0].reset();
                list_SettingUsers();
            }
        });
    }else{
        alert('กรุณาตรวจสอบข้อมูล')
    }
});

$('#btn-editUser').click(function(){
    var userid = $('#userid').val();
    var fname = $('#fname').val();
    var lname = $('#lname').val();
    var email = $('#email').val();
    var password = $('#password').val();
    var status = $("#status-class").children("option:selected").val();
    if(userid != '' && fname != '' && lname !='' && email !='' && password != '' && status != '' ){
        $.ajax({
            url: 'Model/index.php',
            method: 'POST',
            data:{
                type:'editUser',
                userid:userid,
                fname:fname,
                lname:lname,
                email:email,
                password:password,
                status:status
            },
            success:function(response)
            {
                var responseObject = jQuery.parseJSON(response);
                if(responseObject.error == true){
                    alert(responseObject.message);
                }else{
                    alert(responseObject.message);
                }
                $("#myModal").modal('hide');
                $("#formAddorEdit")[0].reset();
                list_SettingUsers();
            }
        });
    }else{
        alert('กรุณาตรวจสอบข้อมูล')
    }
});

$('#tbUser > tbody:last').on('click' , '#openEdit' , function(){
    var currow = $(this).closest('tr');
    var userid = currow.find('td:eq(1)').text();
    var fname = currow.find('td:eq(2)').text();
    var lname = currow.find('td:eq(3)').text();
    var email = currow.find('td:eq(4)').text();
    var status = currow.find('td:eq(5)').text();
    $("#myModal").modal('toggle');
    $('.addUsertxt').hide();
    $('.editUsertxt').show();
    document.getElementById("titlehead").innerHTML = 'แก้ไข'; 
    $("#userid").val(userid);
    $("#fname").val(fname);
    $("#lname").val(lname);
    $("#email").val(email);
    $("#status-class").val('<option value="' +  status +'">  </option>');
    $('#form_action').val('บันทึก');
});


$('#tbUser > tbody:last').on('click' , '#delete' , function(){
    var currow = $(this).closest('tr');
    var userid = currow.find('td:eq(1)').text();
    if(userid != ''){

        if(confirm("คุณแน่ว่าต้องการลบข้อมูล ? ")){
            $.ajax({
                url: 'Model/index.php',
                method: 'POST',
                data:{
                    type: 'delete',
                    userid:userid
                },
                success:function(response){
                    var responseObject = jQuery.parseJSON(response);
                    if(responseObject.error == 'true'){
                        alert(responseObject.message);
                        
                    }else{
                        alert(responseObject.message);
                    }
                    list_SettingUsers();
                }
            });
        }else{
            
        }
        
    }else{
        alert('ขออภัยไม่สามารถลบข้อมูลได้ ! !');
    }
});


}); 
/* Setting user function Pages  */
function list_SettingUsers()
{
    $.ajax({
        url: "Model/index.php",
        method: "POST",
        data: {
            type : 'setting_user'
        },
        success:function(user)
        {               
            $("#st-user").empty();
            var userObject = jQuery.parseJSON(user);
            $.each(userObject.message , function(i , item){
                var id = item['id'];
                var userid = item['userid'];
                var fname = item['fname'];
                var lname = item['lname'];
                var email = item['email'];
                var status = item['status'];
                var tr ="<tr>";
                tr = tr + "<td>" + id + "</td>";
                tr = tr + "<td>" + userid + "</td>";
                tr = tr + "<td>" + fname + "</td>";
                tr = tr + "<td>" + lname + "</td>";
                tr = tr + "<td>" + email + "</td>";
                tr = tr + "<td>" + status + "</td>";
                tr = tr + "<td>" + "<button type='button' id='openEdit' class='btn btn-info'>แก้ไข</button>" + "</td>";
                tr = tr + "<td>" + "<button type='button' id='delete' class='btn btn-danger'>ลบ</button>" + "</td>";
                tr = tr + "</tr>";
                $('#tbUser > tbody:last').append(tr);
            });
        }
    });
}
/* Close-> Setting user function Pages  */

