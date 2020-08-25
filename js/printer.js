$(document).ready(function(){
    
    var arrTxt = [];
    var codecustomer , namecustomer , datein , amount;
    var queryString = new Array();
    if (queryString.length == 0) {
        if (window.location.search.split('?').length > 1) {
            var params = window.location.search.split('?')[1].split('&');
            for (var i = 0; i < params.length; i++) {
                var key = params[i].split('=')[0];
                var value = decodeURIComponent(params[i].split('=')[1]);
                queryString[key] = value;
            }
        }
    }
    
    if (queryString["id"] != '' && queryString["name"] != ''
    && queryString["datein"] && queryString["dateout"] ) {
        codecustomer = queryString["id"];
        namecustomer = queryString["name"];
        datein = queryString["datein"];
        dateout = queryString["dateout"];
        amount = queryString["amount"];
        typecard = queryString["typecard"];
        $("#code-customer").val(codecustomer);
        $("#name-customer").val(namecustomer);
        $("#datein").val(datein);
        $("#dateout").val(dateout);
        $("#amountcus").val(amount);
        onLoad(codecustomer);
    }

    $('#chkx').click(function(){
        if($(this).prop("checked") == true){
            $('#x').show();
            $('#tableActivity').show();

        }
        else if($(this).prop("checked") == false){
            $('#x').hide();
            $('#tableActivity').hide();
        }
    });

    $('#chky').click(function(){
        if($(this).prop("checked") == true){
            $('#y').show();
            $('#tableActivity').show();
        }
        else if($(this).prop("checked") == false){
            $('#y').hide();
            $('#tableActivity').hide();
        }
    });

    $('#chkz').click(function(){
        if($(this).prop("checked") == true){
            $('#z').show();
            $('#tableActivity').show();
        }
        else if($(this).prop("checked") == false){
            $('#z').hide();
            $('#tableActivity').hide();
        }
    });

    $('#chkbigsale').click(function(){
        if($(this).prop("checked") == true){
            $('#big').show();
            $('#tableActivity').show();
        }
        else if($(this).prop("checked") == false){
            $('#big').hide();
            $('#tableActivity').hide();
        }
    });

    
   



    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    var qrcode = new QRCode("qrcode" , {
        width: 128,
        height: 128,
        colorDark : "#000000",
        colorLight : "#ffffff"
    });

    $('#btn-printer').on('click' , function(){
        var idcustomer =  $("#code-customer").val();
        var namecustomer = $("#name-customer").val();
        var dateincus = $("#datein").val();
        var dateoutcus = $("#dateout").val();
        var txt = [];
        var txtArea  = $("#listname").val();
        txt = txtArea;
        var res = txt.split("," , -1);
        var checkbox = '<input type="checkbox">';
        var txtpro1 = $("#txtPromote1").children("option:selected").text();
        var txtpro2 = $("#txtPromote2").children("option:selected").text();
        var typecard = $("#typeCard1").children("option:selected").text();
        var x = ["หมวด X เลือกได้ 1 กิจกรรม","ยิงธนู 10 ดอก" , "ปืนโบราณ 20 นัด" , "เจ็ทไรเดอร์ 4 รอบ" , "เกมส์โซน 1 เกมส์" , "จักรยานน้ำ 1 ท่าน" , "ปั้นดิน หรือ ทำเทียน" , "เก็บเห็ด"  , "เก็บผัก" , "หญ้า 1 กำ"];
        var y = ["หมวด Y เลือกได้ 1 กิจกรรม","ขับรถ ATV 1 รอบ","เลเซอร์เกมส์ 1 เกมส์" , "รถบั๊ม 1 รอบ" , "เพนท์บอลเป้านิ่ง 20 นัด" , "ซุปเปอร์บอล 1 รอบ" , "เพนท์กระถาง หรือ ทำสลัด" , "ทำสบู่เหลว หรือ เห็ดทอดเทมปุระ" , "อาหารสัตว์ 5 อย่าง"];
        var z = ["หมวด Z เลือกได้ 1 กิจกรรม","ฐานน้ำ" , "เพนท์บอลสนาม" , "ทำพิซ่า" , "ทำสวนขวด"];
        var bigsale = ["เอทีวี ATV" , "จักรยานน้ำ" , "ฐานน้ำ 4 ด่าน" , "ยิงธนู 5 ดอก" , 
        "ปืนโบราณ 10 นัด"  , "เจ็ทไรเดอร์ 2 รอบ" , "เกมส์โซน หรือ โบว์ลิ่ง" , "เพนท์บอลสนาม 20 นัด" ,"บัตรชมฟาร์ม"  , "ให้อาหารสัตว์" , "ทำทเียน" , "ปั้นดิน" , "ทำก้อนเห็ด" , "เพนท์กระถาง"];
        $('#typecard').html(typecard);
        $('#txtshowPromote1').html(txtpro1);
        $('#txtshowPromote2').html(txtpro2);
        $('#cusid').append(idcustomer);
        $('#cusname').append(namecustomer);
        $('#dateplay').append(dateincus);
        $('#dateendplay').append(dateoutcus);
        for (let index = 0; index < res.length; index++) {
            $('#txtArray').append(res[index] + "<br>");
        }
        for (let n = 0; n < x.length; n++) {
            $('#x').append(x[n] + "<br>");
        }
        for (let n = 0; n < y.length; n++) {
            $('#y').append(y[n] + "<br>");
        }
        for (let a = 0; a < z.length; a++) {
            $('#z').append(z[a] + "<br>");
        }
        for (let b = 0; b < bigsale.length; b++) {
            $('#big').append(bigsale[b] + "<br>");
        }
        
    });



    $('#print').on('click' , function(){       
        var amount = $("#amountcus").val();  
        var idcustomer =  $("#code-customer").val();
        var amountCoupon = $("#amountcou").val();
        var result = idcustomer + '-';
        var result_t = '';          
        for (amountCoupon; amountCoupon <= amount; amountCoupon++) {
            result_t = result + amountCoupon;
            $('#cusid-no').html(result_t);
            qrcode.makeCode(result_t); 
            window.print();
            qrcode.clear();
        }
        updatePrinter()
    });

    function updatePrinter()
    {
        var tdatein = $('#datein').val()
        var tdateout = $('#dateout').val()
        var update = 'updatePrintStatus';
            $.ajax({
            url: "./Model/index.php" , 
            method: "POST" , 
            data:{
                type : update,
                customerid : codecustomer,
                namecustomer : namecustomer,
                amount : amount,
                datein:tdatein,
                dateout:tdateout
            },
            success:function(data)
            {
                var obj = JSON.parse(data);
               if(obj != '')
               {
                   alert(obj.message);
               }
            }
        })
    }

  /*  $('#update_print').on('click' , function(){
        var tdatein = $('#datein').val()
        var tdateout = $('#dateout').val()
        var update = 'updatePrintStatus';
            $.ajax({
            url: "./Model/index.php" , 
            method: "POST" , 
            data:{
                type : update,
                customerid : codecustomer,
                namecustomer : namecustomer,
                amount : amount,
                datein:tdatein,
                dateout:tdateout
            },
            success:function(data)
            {
                var obj = JSON.parse(data);
               if(obj != '')
               {
                   alert(obj.message);
               }
            }
        })
    }); */



    $('#exampleModal').on('hidden.bs.modal', function (e) {
        $('#cusid').html('');
        $('#cusname').html('');
        $('#dateplay').html('');
        $('#dateendplay').html('');
        $('#txtArray').html('');
        $('#x').html('');
        $('#y').html('');
        $('#z').html('');
        $('#big').html('');
    })


});




function onLoad(codecustomer){
    $.ajax({
        url: "./Model/fetch_printer-card.php" , 
        method: "POST" , 
        data:{
            type : 'activity_type',
            customerid : codecustomer
        },
        success:function(data)
        {
            var obj = JSON.parse(data);
            var tr = "";
           if(obj != '')
           {
               $.each(obj , function(key , val) {
                   var count =  val["count_other"];
                   for (let index = 0; index < count; index++) {
                    tr = tr + val["idactivity"] + " " + val["nameactivity"]   + "," + '\n';
                   }
               });
               $('#listname').append(tr);
           }
        }
    })

}