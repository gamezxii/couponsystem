$(document).ready(function(){

    fetch_name();
});

function fetch_name()
{
        var type1 = 'activity_type';
        $('#id-activity-1').empty();
        $('#id-activity-1').append("<option>Loading...</option>");

        $.ajax({
            url: "./Model/fetch_activity.php" , 
            method: "POST" , 
            data:{
                type : 'activity_type'
            },
            
            success:function(data)
            {
                var yourval = jQuery.parseJSON(JSON.stringify(data));
                var obj = jQuery.parseJSON(data);
                $('#id-activity-1').empty();
                $('#id-activity-1').append("<option value=''>Select Activity</option>");
                $.each(obj , function(i , item){
                   
                    var you = item['idactivity'];
                    var name = item['nameactivity'];

                    $('#id-activity-1').append('<option value="' +  you +'"> '+ name +' </option>');
                 //   alert(you);
                });
            }
        })
}