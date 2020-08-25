$(document).ready(function(){
//getData();


$('#sidebarCollapse').on('click', function () {
    $('#sidebar').toggleClass('active');
});

/*$(document).on('click', '.view', function(){
    var user_id = $(this).attr("id");
    alert(user_id)
    var url = "printer-card.php?id=" + encodeURIComponent(cusid) + "&name=" + encodeURIComponent(cusname) + "&amount=" + encodeURIComponent(cusamount) +  "&typecard=" + encodeURIComponent(typecard)  + "&datein=" + encodeURIComponent(datein) + "&dateout=" + encodeURIComponent(dateout);
    window.location.href = url;
})
*/
$('#myTable > tbody:last').on('click' , '.btn' , function(){
    var currow = $(this).closest('tr');
    var cusid = currow.find('td:eq(0)').html();
    var cusname = currow.find('td:eq(1)').text();
    var cusamount = currow.find('td:eq(2)').text();
    var typecard = currow.find('td:eq(3)').text();
    var datein = currow.find('td:eq(4)').text();
    var dateout = currow.find('td:eq(5)').text();
    var url = "printer-card.php?id=" + encodeURIComponent(cusid) + "&name=" + encodeURIComponent(cusname) + "&amount=" + encodeURIComponent(cusamount) +  "&typecard=" + encodeURIComponent(typecard)  + "&datein=" + encodeURIComponent(datein) + "&dateout=" + encodeURIComponent(dateout);
    window.location.href = url;
}); 

var department = $('#department').text()

$('#myTable').DataTable({
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    'ajax': {
        'url':'Model/generate-card.php',
        data:{
            department : department
        }
    },
    'columns': [
       { data: 'groupid' },
       { data: 'groupname' },
       { data: 'groupamount' },
       { data: 'namepackage' },
       { data: 'datein'},
       { data: 'dateout'},
       { data: 'statusprint'},
       { data: 'id'},
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


});



function getData() {
    $.ajax({
        url: "Model/index.php" , 
        method: "POST" , 
        data:{
            type:'getActivityCus'
        }, 
        success:function(data)
        {
           var obj = jQuery.parseJSON(data);
           if(obj != '')
           {
               $("#myBody").empty();
               $.each(obj.message , function(key , val) {
                var t;
                if(val['status_print'] == "0")
                {
                    t = '&#x2718;';
                }
                else
                {
                    t= '&#10003' ;
                }

                var tr = "<tr>";
				tr = tr + "<td>" + val["groupid"] + "</td>";
				tr = tr + "<td>" + val["groupname"] + "</td>";
                tr = tr + "<td>" + val["groupamount"] + "</td>";
                tr = tr + "<td>" + val["name"] + "</td>";
                tr = tr + "<td>" + val["datein"] + "</td>";
                tr = tr + "<td>" + val["dateout"] + "</td>";
                tr = tr + "<td>" + t + "</td>";
                tr = tr + "<td>" + "<button type='button' class='btn btn-success'>View</button>" + "</td>";
				tr = tr + "</tr>";
				$('#myTable > tbody:last').append(tr);
               });
           }
        }
    })
}