$(document).ready(function(){

 //login-------------------------------------

 $('#btn_login').click(function(){
    var username = $('#email').val();
    var password = $('#password').val();
    if(username != "" && password !="")
    {
        $.ajax({
            url:"./Model/index.php" , 
            method:"POST",
            data:{
                type:'login',
                email:username,
                password:password
            },
            success:function(response) {
                var responseObject = jQuery.parseJSON(response);
                if(responseObject.error == true){
                    window.location.href = 'index.php';
                }else{
                    alert(responseObject.message);
                }
                
            }
        });
    }else{
        alert('กรุณากรอกข้อมูล');
    }
})

//login-------------------------------------


});