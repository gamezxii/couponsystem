jQuery(document).ready(function($){
fetch_nameactivity();

onload_Package();



}); 

function fetch_nameactivity()
{
        var type1 = 'activity_type';
        $('#id-activity-1').empty();
        $('#id-activity-1').append("<option>Loading...</option>");
        $('#id-activity-2').empty();
        $('#id-activity-2').append("<option>Loading...</option>");
        $.ajax({
            url: "./Model/fetch_create.php" , 
            method: "POST" , 
            data:{
                type : 'activity_type'
            },
            
            success:function(data)
            {
                var yourval = jQuery.parseJSON(JSON.stringify(data));
                var obj = jQuery.parseJSON(data);
                $('#id-activity-1').empty();
                $('#id-activity-2').empty();
                $('#id-activity-3').empty();
                $('#id-activity-4').empty();
                $('#id-activity-5').empty();
                $('#id-activity-6').empty();
                $('#id-activity-7').empty();
                $('#id-activity-8').empty();
                $('#id-activity-9').empty();
                $('#id-activity-10').empty();
                $('#id-activity-11').empty();
                $('#id-activity-12').empty();
                $('#id-activity-13').empty();
                $('#id-activity-14').empty();
                $('#id-activity-15').empty();
                $('#id-activity-1').append("<option value=''>เลือกกิจกรรม</option>");
                $('#id-activity-2').append("<option value=''>เลือกกิจกรรม</option>");
                $('#id-activity-3').append("<option value=''>เลือกกิจกรรม</option>");
                $('#id-activity-4').append("<option value=''>เลือกกิจกรรม</option>");
                $('#id-activity-5').append("<option value=''>เลือกกิจกรรม</option>");
                $('#id-activity-6').append("<option value=''>เลือกกิจกรรม</option>");
                $('#id-activity-7').append("<option value=''>เลือกกิจกรรม</option>");
                $('#id-activity-8').append("<option value=''>เลือกกิจกรรม</option>");
                $('#id-activity-9').append("<option value=''>เลือกกิจกรรม</option>");
                $('#id-activity-10').append("<option value=''>เลือกกิจกรรม</option>");
                $('#id-activity-11').append("<option value=''>เลือกกิจกรรม</option>");
                $('#id-activity-12').append("<option value=''>เลือกกิจกรรม</option>");
                $('#id-activity-13').append("<option value=''>เลือกกิจกรรม</option>");
                $('#id-activity-14').append("<option value=''>เลือกกิจกรรม</option>");
                $('#id-activity-15').append("<option value=''>เลือกกิจกรรม</option>");

                $.each(obj , function(i , item){
                   
                var you = item['idactivity'];
                var name = item['nameactivity'];
                $('#id-activity-1').append('<option value="' +  you +'"> '+ name +' </option>');
                $('#id-activity-2').append('<option value="' +  you +'"> '+ name +' </option>');
                $('#id-activity-3').append('<option value="' +  you +'"> '+ name +' </option>');
                $('#id-activity-4').append('<option value="' +  you +'"> '+ name +' </option>');
                $('#id-activity-5').append('<option value="' +  you +'"> '+ name +' </option>');
                $('#id-activity-6').append('<option value="' +  you +'"> '+ name +' </option>');
                $('#id-activity-7').append('<option value="' +  you +'"> '+ name +' </option>');
                $('#id-activity-8').append('<option value="' +  you +'"> '+ name +' </option>');
                $('#id-activity-9').append('<option value="' +  you +'"> '+ name +' </option>');
                $('#id-activity-10').append('<option value="' +  you +'"> '+ name +' </option>');
                $('#id-activity-11').append('<option value="' +  you +'"> '+ name +' </option>');
                $('#id-activity-12').append('<option value="' +  you +'"> '+ name +' </option>');
                $('#id-activity-13').append('<option value="' +  you +'"> '+ name +' </option>');
                $('#id-activity-14').append('<option value="' +  you +'"> '+ name +' </option>');
                $('#id-activity-15').append('<option value="' +  you +'"> '+ name +' </option>');
                 //   alert(you);
                });
            }
        })
}

function onload_Package(){
    $('#id-package').empty();
    $('#id-package').append("<option>Loading...</option>");
    $.ajax({
        url: "./Model/index.php" , 
        method: "POST" , 
        data:{
            type : 'loadPackage'
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