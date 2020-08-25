$(document).ready(function(){

    /*   $('#pdf').on('click',function(){
     
      var divToPrint=document.getElementById("myTable");
      newWin= window.open("");
      newWin.document.write(divToPrint.outerHTML);
      newWin.print();
      newWin.close();
    }) */

    $('#myTable > tbody:last').on('keyup' , '.price' , function(){
      var currow = $(this).closest('tr');
     // var price = currow.find('#qty').val();
      var price = currow.find('.price').text();
      var amount = currow.find('td:eq(2)').text();
      var result = (price * amount);
      currow.find('.total').html(result.toFixed(2));
     // currow.find('.amountmoneyfoc').html(moneyFoc.toFixed(2));
     $('#total_all').each(function() {
      var sum = 0;
      $(this).parents('table').find('.total').each(function() {
        var floted = parseFloat($(this).text());
        if (!isNaN(floted)) sum += floted;
      });
      $(this).html(sum.toFixed(2));
      $('#outcash').html(sum.toFixed(2));
    });
  });
  
    $('#pdf').on('click' , function(){
      var idcasher = [];
      var billSeniorsoft = [];
      var amount = [];
      var nameactivity = [];
      var price = [];
      var grantactivity = [];
      var discount = [];
      var discount_cash = [];
      var total_cash = [];
      var dis = [];
      //var nameactivity = [];
      
     
     $('#myTable > tbody > tr').each(function(row, tr){
      idcasher.push($(tr).find('td:eq(0)').text()); 
      billSeniorsoft.push($(tr).find('td:eq(1)').text());   
      amount.push($(tr).find('td:eq(2)').text());  
      nameactivity.push($(tr).find('td:eq(4)').text());  
      price.push($(tr).find('td:eq(5)').text());  
      grantactivity.push($(tr).find('td:eq(6)').text());  
      discount.push($(tr).find('td:eq(7)').text());  
      discount_cash.push($(tr).find('td:eq(8)').text());  
      total_cash.push($(tr).find('td:eq(9)').text());
      });
             //  dis = discount.toString().replace(/%/g,'');
  
      /*  for (let index = 0; index < idcasher.length; index++) {
          console.log(idcasher[index] + amount[index] + nameactivity[index] + price[index] + grantactivity[index] + discount[index] + discount_cash[index] + total_cash[index]);
        } */
        $.ajax({
          url: "./Model/index.php",
          method: "POST",
          data: {
              type : 'insertCloseCash',
              idcasher : idcasher,
              blseniorsoft : billSeniorsoft,
              amount : amount,
              nameactivity :nameactivity,
              price:price,
              grantactivity:grantactivity,
              discount:discount,
              discount_cash:discount_cash,
              totalcash:total_cash
          },
          success:function(response)
          {
            var userObject = jQuery.parseJSON(response);
              if(userObject.error === false){
                  Swal.fire(
                      userObject.message
                    )
              }else{
                Swal.fire(
                      userObject.message
                )
              }
          }
  
        })
      });
  
  
      
      $('#because').change(function(){
          var cause = $('#because').val();
          $('#cause').html(cause);
      });
              
      getData();
   
      $("#seniorsoft").keyup(function(){
          var senior = $(this).text();
          var outcash = $('#outcash').text();
          var number = Number(outcash.replace(/[^0-9.-]+/g,""));
          var result = senior - number  ;
          $('#balance').html(result.toFixed(2));
      });
      
       
   
     
      function addCommas(x) {
          var parts = x.toString().split(".");
          parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          return parts.join(".");
        }
     
      
      
      });
  
  
      function getData() {
       var  userid = $('#userno').text();
          $.ajax({
              url: "Model/index.php" , 
              method: "POST" , 
              data:{
                  type:'closegroup',
                  userid : userid
              }, 
              success:function(data)
              {
                      var obj = JSON.parse(data);
  
                     $("#myBody").empty();
                     $.each(obj.message , function(key , val) {
                      var tr = "<tr>";
                      var cuscash = val["total"];
                      var date = val["datein"];
                      tr = tr + "<td>" + val["cusid"] + "</td>";
                      tr = tr + "<td>" + val["cusname"] + "</td>";
                      tr = tr + "<td>" + val["cusamount"] + "</td>";
                      tr = tr + "<td>" + val["cuspackage"] + "</td>";
                      tr = tr + "<td>" + val["cusnameactivity"] + "</td>";
                      tr = tr + "<td>" + val["cusplay"] + "</td>";
                      tr = tr + "<td contenteditable='true' class='price'>" +  "</td>";
                      tr = tr + "<td  class='total'>" + 0.00 + "</td>";
                      tr = tr + "</tr>";
                      $('#myTable > tbody:last').append(tr);
                      $('#total_all').html(0.00);
                      $('#outcash').html(0.00);
                      $('.datenow').html(date);
                     });
                 
              }
          })
      }