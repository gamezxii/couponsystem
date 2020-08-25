$(document).ready(function(){
    var userno = $('#userno').text();
    var track = 'trackstatus';
    getData(track ,userno)
    
    
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });  
});
    
    
    function getData(trackstatus , userno) {
        $.ajax({
            url: "./Model/index.php" , 
            method: "POST" , 
            data: {
                type: trackstatus,
                userid: userno, 
            },
            success:function(data)
            {
               var obj = jQuery.parseJSON(data);
               if(obj != '')
               {
                   $("#myBody").empty();
                   $.each(obj.message , function(key , val) {
                    console.log(val);
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
                    tr = tr + "<td>" + val["id"] + "</td>";
                    tr = tr + "<td>" + val["groupid"] + "</td>";
                    tr = tr + "<td>" + val["groupname"] + "</td>";
                    tr = tr + "<td>" + val["groupamount"] + "</td>";
                    tr = tr + "<td>" + val["datein"] + "</td>";
                    tr = tr + "<td>" + val["dateout"] + "</td>";
                    tr = tr + "<td>" + t + "</td>";
                    tr = tr + "</tr>";
                    $('#myTable > tbody:last').append(tr);
                   });
               }
            }
        })
    }