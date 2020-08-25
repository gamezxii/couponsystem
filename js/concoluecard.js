$(document).ready(function(){    
    $('#tbUser > tbody:last').on('change' , '#qty' , function(){
        var currow = $(this).closest('tr');
        var price = currow.find('#qty').val();
        var amount = currow.find('td:eq(3)').text();
        var result = price  * amount;
        currow.find('.total').html(result.toFixed(2));
        $('#total_sum').each(function() {
            var sum = 0;
            $(this).parents('table').find('.total').each(function() {
              var floted = parseFloat($(this).text());
              if (!isNaN(floted)) sum += floted;
            });
          
            $(this).html(sum.toFixed(2));
          });
    });

    $('#tbUser > tbody:last').on('change' , '#foc' , function(){
        var currow = $(this).closest('tr');
        var price = currow.find('#qty').val();
        var foc = currow.find('#foc').val();
        var amount = currow.find('td:eq(3)').text();
        var discount = amount - foc;
        var result = discount  * price;
        currow.find('.total').html(result.toFixed(2));
        $('#total_sum').each(function() {
            var sum = 0;
            $(this).parents('table').find('.total').each(function() {
              var floted = parseFloat($(this).text());
              if (!isNaN(floted)) sum += floted;
            });
            var resultsum = addCommas(sum)
            resultsum = parseFloat(resultsum);
            $(this).html(sum.toFixed(2));
          });
    });

    

    $('#save').on('click' , function(){
      var idcustomer = [];
      var namecustomer = [];
      var price = [];
      var amountcustomer = [];
      var amountactivity = [];
      var nameactivity = [];
      var foc =[];
      var cause = [];
      var sale = [];
      var total = [];
     
     $('#tbUser > tbody > tr').each(function(row, tr){
      idcustomer.push($(tr).find('td:eq(0)').text());  
      namecustomer.push($(tr).find('td:eq(1)').text());  
      price.push($(tr).find('#qty').val());  
      amountcustomer.push($(tr).find('td:eq(3)').text());  
      amountactivity.push($(tr).find('td:eq(4)').text());  
      nameactivity.push($(tr).find('td:eq(5)').text());  
      foc.push($(tr).find('#foc').val());  
      cause.push($(tr).find('#cause').val());  
      sale.push($(tr).find('td:eq(8)').text());  
      total.push($(tr).find('td:eq(9)').text());  
      });

     
      $.ajax({
        url: "./Model/index.php",
        method: "POST",
        data: {
            type : 'insertfoc',
            idcustomer : idcustomer,
            namecustomer : namecustomer,
            price :price,
            amountcustomer:amountcustomer,
            amountactivity:amountactivity,
            nameactivity:nameactivity,
            foc:foc,
            cause:cause,
            sale:sale,
            total:total
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
   


    

    $('#search').on('click' , function(){
        var customerid = $('#customerid-11').val();
        if(customerid != ''){
            list_SettingUsers(customerid);
        }else{
            alert('กรุณากรอก ID ของลูกค้า');
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
            type : 'focuser',
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
                //var id = item['id'];
                var customerid = item['groupid'];
                var namecustomer = item['groupname'];
                var amountcustomer = item['groupamount'];
                var namepackage = item['nameactivity'];
                var namesale = item['fname'];
                var amountActivity = item['group_amount_activity'];
                var userid = item['userid'];
                var tr ="<tr>";
                tr = tr + "<td id='customer'>" + customerid + "</td>";
                tr = tr + "<td>" + namecustomer + "</td>";
                tr = tr + "<td>" + '<input type="text" class="form-control"  id="qty" name="qty"/>' + "</td>";
                tr = tr + "<td class='amount' >" + amountcustomer + "</td>";
                tr = tr + "<td>" + amountActivity + "</td>";
                tr = tr + "<td>" + namepackage + "</td>";
                tr = tr + "<td>" + '<input type="text" class="form-control"  id="foc" name="foc"/>' + "</td>";
                tr = tr + "<td>" + '<input type="text" class="form-control"  id="cause" name="cause"/>' + "</td>";
                tr = tr + "<td>" + userid + "</td>";
                tr = tr + "<td class='total' >" + 0 + "</td>";
                tr = tr + "</tr>";
                $('#tbUser > tbody:last').append(tr);
            });
        }
        }
    });
}

function addCommas(x) {
  var parts = x.toString().split(".");
  parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  return parts.join(".");
}