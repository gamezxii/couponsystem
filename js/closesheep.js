$(document).ready(function(){

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    $('#search').on('click' , function(){
      var dateout = new Date($('#date').val());
      day = dateout.getDate();
      month = dateout.getMonth() + 1;
      year = dateout.getFullYear();
      if (day < 10) 
      day = "0" + day;
      var dateout1  = [year , month , day].join('-');
    
     getData(dateout1);
  
    });
  
     /*  $('#pdf').on('click',function(){
     
      var divToPrint=document.getElementById("myTable");
      newWin= window.open("");
      newWin.document.write(divToPrint.outerHTML);
      newWin.print();
      newWin.close();
    }) 
   */
    $('#pdf').on('click' , function(){
      var divToPrint=document.getElementById("myTable");
      newWin= window.open("");
      newWin.document.write(divToPrint.outerHTML);
      newWin.print();
      newWin.close();
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
      var intputSeniorsoft = $("#seniorsoft").text();
      var outcash = $("#outcash").text();
      var balance = $("#balance").text();
      var because = $(".because").text();
      var res = outcash.replace(/,/g, "");
      var ba = balance.replace(/,/g, "");
  
      var dateout = new Date($('#date').val());
      day = dateout.getDate();
      month = dateout.getMonth() + 1;
      year = dateout.getFullYear();
      if (day < 10) 
      day = "0" + day;
      var dateout1  = [year , month , day].join('-');
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
        
     /*   $.ajax({
          url: "./Model/index.php",
          method: "POST",
          data: {
              type : 'insertCashCloseFarm',
              idcasher : idcasher,
              billSeniorsoft : billSeniorsoft,
              amount : amount,
              nameactivity :nameactivity,
              price:price,
              grantactivity:grantactivity,
              discount:discount,
              discount_cash:discount_cash,
              totalcash:total_cash , 
              seniorsoft:intputSeniorsoft,
              programcashcard:res,
              balance:ba,
              because:because,
              date:dateout1
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
              getData(dateout1);
              $('#total_all').html(0.00);
  
          }
  
        }) */
      });
  
    
  
      
      $('#because').change(function(){
          var cause = $('#because').val();
          $('#cause').html(cause);
      });
              
   
      $("#seniorsoft").keyup(function(){
          var senior = $(this).text();
          var outcash = $('#outcash').text();
          var number = Number(outcash.replace(/[^0-9.-]+/g,""));
          var result = senior - number  ;
          $('#balance').html(result.toFixed(2));
      });
      
       
   
     
     
     
      
      
      });
  
  
      function getData(date) {
          $.ajax({
              url: "Model/index.php" , 
              method: "POST" , 
              data:{
                  type:'LoadCloseSheep',
                  date:date
              }, 
              success:function(data)
              {
                      var obj = JSON.parse(data);
  
                      if(obj.error == true){
  
                      
                     $("#myBody").empty();
                     $.each(obj.message , function(key , val) {
                      var tr = "<tr>";
                      var cuscash = val["total"];
                      var date = val["datein"];
                      tr = tr + "<td>" + val["cusid"] + "</td>";
                      tr = tr + "<td>" + val["noseniorsoft"] + "</td>";
                      tr = tr + "<td>" + val["cusamount"] + "</td>";
                      tr = tr + "<td>" + val["cuspackage"] + "</td>";
                      tr = tr + "<td>" + val["cusnameactivity"] + "</td>";
                      tr = tr + "<td>" + val["cusprice"] + "</td>";
                      tr = tr + "<td>" + val["cusplay"] + "</td>";
                      tr = tr + "<td>" + val["discount"] + "</td>";
                      tr = tr + "<td>" + val["discountprice"] + "</td>";
                      tr = tr + "<td  class='total'>" + val["cuscash"] + "</td>";
                      tr = tr + "</tr>";
                      $('#myTable > tbody:last').append(tr);
                      $('#total_all').html(cuscash);
                      $('#outcash').html(cuscash);
                      $('.datenow').html(date);
                     });
                    }else{
                      $("#myBody").empty();
                      $("#seniorsoft").html('0.00');
                      $('#total_all').html('0.00');
                      $('#outcash').html('0.00');
                      $('.datenow').html('');
                      alert(obj.message);
                    }
                 
              }
          })
      }