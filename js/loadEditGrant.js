$(document).ready(function(){
   

    $('#search').on('click' , function(){
        var customerid = $('#customerid-11').val();
        if(customerid != ''){
            list_SettingUsers(customerid);
        }else{
            alert('กรุณากรอก ID ของลูกค้า');
        }
    });

    $('#tbUser > tbody:last').on('click' , '#delete' , function(){
        var currow = $(this).closest('tr');
        var userid = currow.find('td:eq(1)').text();
        var idactivity = currow.find('td:eq(2)').text();
        var time = currow.find('td:eq(6)').text();
                      
        
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
          })
          if(userid != ''){
          swalWithBootstrapButtons.fire({
            title: 'คุณแน่ใจว่าต้องการคืนสิทธิ์',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'ตกลง',
            cancelButtonText: 'ยกเลิก',
            reverseButtons: true
          }).then((result) => {
            if (result.value) {
              swalWithBootstrapButtons.fire(
                  
                    $.ajax({
                        url: "./Model/index.php",
                        method: "POST",
                        data: {
                            type : 'updateReinstate',
                            groupid_no : userid,
                            idactivity : idactivity,
                            time :time
                        },
                        success:function(response)
                        {
                            var userObject = jQuery.parseJSON(response);
                            Swal.fire(
                                userObject.message
                              )
                              list_SettingUsers(userid);
                        }
        
                    })
                
              )
            } else if (
              /* Read more about handling dismissals below */
              result.dismiss === Swal.DismissReason.cancel
            ) {
              swalWithBootstrapButtons.fire(
                'ยกเลิก',
                'คุณได้กดยกเลิกการคืนสิทธิ์'
              )
            }
          })

        }else{
            Swal.fire(
                'กรุณาตรวจสอบข้อมูล'
              )
        }
        
        
    });
    
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });  
});
    
    
function list_SettingUsers(customerid)
{
    $.ajax({
        url: "./Model/index.php",
        method: "POST",
        data: {
            type : 'list_historyCustomer',
            customerid : customerid
        },
        success:function(user)
        {               
            $('#tbUser > tbody:last').empty();
            var userObject = jQuery.parseJSON(user);
            if(userObject.error === false){
                Swal.fire(
                    userObject.message
                  )
            }
            else{

            $.each(userObject.message , function(i , item){
                var id = item['id'];
                var userid = item['groupid_number'];
                var idactivity = item['idactivity'];
                var namecard = item['usecard'];
                var datescan = item['date'];
                var name = item['nameactivity'];
                var time = item['time'];
                var tr ="<tr>";
                tr = tr + "<td>" + id + "</td>";
                tr = tr + "<td>" + userid + "</td>";
                tr = tr + "<td>" + idactivity + "</td>";
                tr = tr + "<td>" + namecard + "</td>";
                tr = tr + "<td>" + name + "</td>";
                tr = tr + "<td>" + datescan + "</td>";
                tr = tr + "<td>" + time + "</td>";
                tr = tr + "<td>" + "<button type='button' id='delete' class='btn btn-danger'>คืนสิทธิ์</button>" + "</td>";
                tr = tr + "</tr>";
                $('#tbUser > tbody:last').append(tr);
            });
        }
        }
    });
}