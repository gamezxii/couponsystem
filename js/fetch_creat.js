$(document).ready(function(){

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    fetch_nameactivity();
});


function fetch_nameactivity()
{
        var type1 = 'activity_type';
        $('#inputState').empty();
        $('#inputState').append("<option>Loading...</option>");

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
                $('#inputState').empty();
                $('#inputState').append("<option value='0'>Select Activity</option>");
                $.each(obj , function(i , item){
                   
                    var you = item['idactivity'];
                    var name = item['nameactivity'];

                    $('#inputState').append('<option value="' +  you +'"> '+ name +' </option>');
                 //   alert(you);
                });
            }
        })
}