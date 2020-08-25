$(document).ready(function () {
  var department = $("#department").text();
  list_SettingUsers();

  onload_Package(department);

  loadFunction();

  $("#tpye-card-ac").change(function () {
    var chageTypeCard = $(this).val();
    //alert(chageTypeCard);
    switch (chageTypeCard) {
      case "1":
        $("#amount-activity").val(1);
        $("#price-discount").val("0");
        fetch_nameactivity(department);
        HideCombobox();
        break;
      case "2":
        $("#price-discount").val("17");
        fetch_nameactivity(department);
        break;
      case "3":
        $("#price-discount").val("2");
        fetch_nameactivity(department);
        break;

      case "4":
        $("#price-discount").val("0");
        $("#amount-activity").val(5);
        showCombobox5();
        Package_Tour();
        Package_Tour2();
        Package_Tour3();
        Package_Tour4();
        countDoorP();
        break;

      case "5":
        $("#price-discount").val("0");
        $("#amount-activity").val(6);
        showComboBox6();
        Package_Tour();
        Package_Tour2();
        Package_Tour3();
        Farm_Package2();
        Farm_Package1();
        countDoorP1();
        break;

      case "6":
        $("#price-discount").val("0");
        $("#amount-activity").val(7);
        showComboBox7();
        Package_Tour();
        Package_Tour2();
        Package_Tour3();
        Farm_Package2();
        Farm_Package1();
        //Farm_Package21();
        countDoorP2();
        Farm_PackagePizza();
        break;

      case "7":
        $("#price-discount").val("0");
        $("#amount-activity").val(9);
        showComboBox9();
        Package_Tour();
        Package_Tour2();
        Package_Tour3();
        Farm_Package2();
        Farm_Package1();
        Farm_Package21();
        Farm_Package3();
        Farm_Package32();
        countDoorP3();
        break;

      case "8":
        $("#price-discount").val("0");
        $("#amount-activity").val(6);
        showComboBox6();
        Package_Tour();
        Package_Tour2();
        Package_Tour3();
        Farm_Package2();
        Farm_Package1();
        countDoorP1();
        break;

      case "9":
        $("#price-discount").val("0");
        $("#amount-activity").val(7);
        showComboBox7();
        Package_Tour();
        Package_Tour2();
        Package_Tour3();
        Farm_Package2();
        Farm_Package1();
        //Farm_Package21();
        countDoorP2();
        Farm_PackagePizza();
        break;

      case "10":
        $("#price-discount").val("0");
        $("#amount-activity").val(8);
        showComboBox8();
        FarmTogether()
        break;

      default:
        alert("กรุณาเลือกประเภทบัตร");
        break;
    }
  });

  function loadFunction() {
    // body...
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();

    if (dd < 10) {
      dd = "0" + dd;
    }
    if (mm < 10) {
      mm = "0" + mm;
    }

    var today = [yyyy, mm, dd].join("-");
    document.getElementById("datein").defaultValue = today + "";
    document.getElementById("dateout").defaultValue = today + "";
  }

  $("#chkx").click(function () {
    if ($(this).prop("checked") == true) {
      $("#x").show();
      $("#tableActivity").show();
    } else if ($(this).prop("checked") == false) {
      $("#x").hide();
      $("#tableActivity").hide();
    }
  });

  $("#chky").click(function () {
    if ($(this).prop("checked") == true) {
      $("#y").show();
      $("#tableActivity").show();
    } else if ($(this).prop("checked") == false) {
      $("#y").hide();
      $("#tableActivity").hide();
    }
  });

  $("#chkz").click(function () {
    if ($(this).prop("checked") == true) {
      $("#z").show();
      $("#tableActivity").show();
    } else if ($(this).prop("checked") == false) {
      $("#z").hide();
      $("#tableActivity").hide();
    }
  });

  var result = [];
  var valText = [];
  $("#btn-create").click(function () {
    var addcard = "createRealMoney";
    var senior = $("#senior").val();
    var cusid = $("#customerid").val().toUpperCase();
    var codecus = $("#tpye-card-ac").children("option:selected").text();
    var codecusvalue = $("#tpye-card-ac").val();
    var amountCustomer = $("#countcustomer").val();
    var changeAmountActivity = $("#amount-activity").val();
    var package = $("#id-package").val();
    var userid1 = $("#userid").val();
    var discount = $("#price-discount").val();
    result = checkValiateSelected();
    valText = checkValiateSelectedText();

    var tdatein = new Date($("#datein").val());
    day = tdatein.getDate();
    month = tdatein.getMonth() + 1;
    year = tdatein.getFullYear();
    var datein1 = [year, month, day].join("-");
    var showin = [day, month, year].join("-");

    var dateout = new Date($("#dateout").val());
    dayout = dateout.getDate();
    monthout = dateout.getMonth() + 1;
    yearout = dateout.getFullYear();
    var dateout1 = [yearout, monthout, dayout].join("-");
    var showout = [dayout, monthout, year].join("-");
    if (day < 10) day = "0" + day;
    if (dayout < 10) dayout = "0" + dayout;

    if (
      cusid != "" &&
      codecusvalue != "" &&
      datein != "" &&
      amountCustomer != "" &&
      changeAmountActivity != "" &&
      tdatein != "" &&
      dateout1 != "" &&
      result != "" &&
      package != ""
    ) {
      $.ajax({
        url: "Model/index.php",
        method: "POST",
        data: {
          type: addcard,
          seniorsoft: senior,
          cusid: cusid,
          codecus: codecus,
          amount: amountCustomer,
          change: changeAmountActivity,
          datein: datein1,
          dateout: dateout1,
          package: package,
          listactivity: result,
          discount: discount,
          userid: userid1,
        },
        beforeSend: function () {
          $("#btn-create").attr("disabled", "disabled");
          $("#process").css("display", "block");
        },
        success: function (data) {
          var percentage = 0;
          var responseObject = jQuery.parseJSON(data);
          if (responseObject.error === false) {
            alert(responseObject.message);
          } else {
            var percentage = 0;
            var timer = setInterval(function () {
              percentage = percentage + 20;
              progress_bar_process(
                percentage,
                timer,
                responseObject.message,
                cusid,
                codecus,
                showin,
                showout,
                result,
                valText,
                amountCustomer
              );
            }, 1000);
          }

          list_SettingUsers();
          onload_Package(department);
        },
      });
    } else {
      alert("กรุณากรอกข้อมูล");
    }
  });

  $("#amount-activity").change(function () {
    var chageActivity = $(this).val();
    switch (chageActivity) {
      case "1":
        HideCombobox();
        break;
      case "2":
        showComboBox2();
        break;
      case "3":
        showCombobox3();
        break;
      case "4":
        showCombobox4();
        break;
      case "5":
        showCombobox5();
        break;
      case "6":
        showComboBox6();
        break;
      case "7":
        showComboBox7();
        break;
      case "8":
        showComboBox8();
        break;
      case "9":
        showComboBox9();
        break;
      case "10":
        showComboBox10();
        break;
      case "11":
        showComboBox11();
        break;
      case "12":
        showComboBox12();
        break;
      case "13":
        showComboBox13();
        break;
      case "14":
        showComboBox14();
        break;
      case "15":
        showComboBox15();
        break;
      default:
        alert("Not found..");
        break;
    }
  });

  $("#id-activity-1").change(function () {
    var showValue = $(this).val();
    $("#txt_id-1").val(showValue);
  });
  $("#id-activity-2").change(function () {
    var showValue = $(this).val();
    $("#txt_id-2").val(showValue);
  });
  $("#id-activity-3").change(function () {
    var showValue = $(this).val();
    $("#txt_id-3").val(showValue);
  });
  $("#id-activity-4").change(function () {
    var showValue = $(this).val();
    $("#txt_id-4").val(showValue);
  });
  $("#id-activity-5").change(function () {
    var showValue = $(this).val();
    $("#txt_id-5").val(showValue);
  });
  $("#id-activity-6").change(function () {
    var showValue = $(this).val();
    $("#txt_id-6").val(showValue);
  });
  $("#id-activity-7").change(function () {
    var showValue = $(this).val();
    $("#txt_id-7").val(showValue);
  });
  $("#id-activity-8").change(function () {
    var showValue = $(this).val();
    $("#txt_id-8").val(showValue);
  });
  $("#id-activity-9").change(function () {
    var showValue = $(this).val();
    $("#txt_id-9").val(showValue);
  });
  $("#id-activity-10").change(function () {
    var showValue = $(this).val();
    $("#txt_id-10").val(showValue);
  });
  $("#id-activity-11").change(function () {
    var showValue = $(this).val();
    $("#txt_id-11").val(showValue);
  });
  $("#id-activity-12").change(function () {
    var showValue = $(this).val();
    $("#txt_id-12").val(showValue);
  });
  $("#id-activity-13").change(function () {
    var showValue = $(this).val();
    $("#txt_id-13").val(showValue);
  });
  $("#id-activity-14").change(function () {
    var showValue = $(this).val();
    $("#txt_id-14").val(showValue);
  });

  $("#id-activity-15").change(function () {
    var showValue = $(this).val();
    $("#txt_id-15").val(showValue);
  });

  $("#sidebarCollapse").on("click", function () {
    $("#sidebar").toggleClass("active");
  });
});

function list_SettingUsers() {
  $.ajax({
    url: "./Model/index.php",
    method: "POST",
    data: {
      type: "checkautoNumberFarm",
    },
    success: function (user) {
      var userObject = jQuery.parseJSON(user);
      $("#customerid").val(userObject.message);
    },
  });
}

function showModel(
  cusid,
  codecus,
  showin,
  showout,
  activity,
  textActivity,
  amountCustomer
) {
  $("#exampleModal").modal("show");
  $("#typecard").html("บัตรขายเงินสด");
  $("#cusid").append(cusid);
  $("#cusname").append(codecus);
  $("#dateplay").append(showin);
  $("#dateendplay").append(showout);
  var x = [
    "หมวด X เลือกได้ 1 กิจกรรม",
    "ยิงธนู 10 ดอก",
    "ปืนโบราณ 20 นัด",
    "เจ็ทไรเดอร์ 4 รอบ",
    "เกมส์โซน 1 เกมส์",
    "จักรยานน้ำ 1 ท่าน",
    "ปั้นดิน หรือ ทำเทียน",
    "เก็บเห็ด",
    "เก็บผัก",
    "หญ้า 1 กำ",
  ];
  var y = [
    "หมวด Y เลือกได้ 1 กิจกรรม",
    "ขับรถ ATV 1 รอบ",
    "เลเซอร์เกมส์ 1 เกมส์",
    "รถบั๊ม 1 รอบ",
    "เพนท์บอลเป้านิ่ง 20 นัด",
    "ซุปเปอร์บอล 1 รอบ",
    "เพนท์กระถาง หรือ ทำสลัด",
    "ทำสบู่เหลว หรือ เห็ดทอดเทมปุระ",
    "อาหารสัตว์ 5 อย่าง",
  ];
  var z = [
    "หมวด Z เลือกได้ 1 กิจกรรม",
    "ฐานน้ำ",
    "เพนท์บอลสนาม",
    "ทำพิซ่า",
    "ทำสวนขวด",
  ];
  var no = 1;
  var chageTypeCard = $("#tpye-card-ac").val();
  for (let index = 0; index < activity.length; index++) {
    if (index == 2 && chageTypeCard == 4) {
      $("#txtArray").append(no + "." + "ชิมมัลเบอรี่สด ๆ จากต้น" + "<br>");
      no = no + 1;
      $("#txtArray").append("เดือนธันวาคม 62 - มกราคม 63 แถมพิเศษ" + "<br>");
      $("#txtArray").append(
        no + "." + activity[index] + textActivity[index] + "<br>"
      );
    } else if (index == 1 && chageTypeCard == 5) {
      $("#txtArray").append(no + "." + "ชิมมัลเบอรี่สด ๆ จากต้น" + "<br>");
      no = no + 1;
      $("#txtArray").append(
        no + "." + activity[index] + textActivity[index] + "<br>"
      );
    } else if (index == 1 && chageTypeCard == 6) {
      $("#txtArray").append(no + "." + "ชิมมัลเบอรี่สด ๆ จากต้น" + "<br>");
      no = no + 1;
      $("#txtArray").append(
        no + "." + activity[index] + textActivity[index] + "<br>"
      );
    } else if (index == 1 && chageTypeCard == 7) {
      $("#txtArray").append(no + "." + "ชิมมัลเบอรี่สด ๆ จากต้น" + "<br>");
      no = no + 1;
      $("#txtArray").append(
        no + "." + activity[index] + textActivity[index] + "<br>"
      );
    } else {
      $("#txtArray").append(
        no + "." + activity[index] + textActivity[index] + "<br>"
      );
    }

    no = no + 1;
  }
  for (let n = 0; n < x.length; n++) {
    $("#x").append(x[n] + "<br>");
  }
  for (let n = 0; n < y.length; n++) {
    $("#y").append(y[n] + "<br>");
  }
  for (let a = 0; a < z.length; a++) {
    $("#z").append(z[a] + "<br>");
  }
  setTimeout(function () {
    createqrCode(cusid, activity, amountCustomer);
  }, 2000);
}

function createqrCode(cusid, activity, amountCustomer) {
  var qrcode = new QRCode("qrcode", {
    width: 128,
    height: 128,
    colorDark: "#000000",
    colorLight: "#ffffff",
  });

  var result = cusid + "-";
  var result_t = "";
  for (i = 1; i <= amountCustomer; i++) {
    result_t = result + i;
    $("#cusid-no").html(result_t);
    qrcode.makeCode(result_t);
    window.print();
    qrcode.clear();
  }
  $("#exampleModal").modal("hide");
  location.reload();
}

function onload_Package(department) {
  var data1 = parseInt(department);
  $.ajax({
    url: "./Model/index.php",
    method: "POST",
    data: {
      type: data1,
    },
    dataType: "json",
    success: function (data) {
      if (data.error === false) {
        alert(data.message);
      } else {
        $.each(data.message, function (i, item) {
          var you = item["idpackage"];
          var name = item["name"];
          $("#id-package").append(
            '<option value="' + you + '"> ' + name + " </option>"
          );
          $("#txt_package").val(you);
        });
      }
    },
  });
}

function Package_Tour() {
  $.ajax({
    url: "./Model/index.php",
    method: "POST",
    data: {
      type: "PackageBerry_Tour",
    },

    success: function (data) {
      var obj = jQuery.parseJSON(data);
      $("#id-activity-1").empty();
      $.each(obj.message, function (i, item) {
        var you = item["idactivity"];
        var name = item["nameactivity"];
        $("#id-activity-1").append(
          '<option value="' + you + '"> ' + name + " </option>"
        );
        $("#txt_id-1").val(you);
      });
    },
  });
}

function Package_Tour2() {
  $.ajax({
    url: "./Model/index.php",
    method: "POST",
    data: {
      type: "PackageBerry_Tour2",
    },

    success: function (data) {
      var obj = jQuery.parseJSON(data);
      $("#id-activity-2").empty();
      $.each(obj.message, function (i, item) {
        var you = item["idactivity"];
        var name = item["nameactivity"];

        $("#id-activity-2").append(
          '<option value="' + you + '"> ' + name + " </option>"
        );
        $("#txt_id-2").val(you);
      });
    },
  });
}

function Package_Tour3() {
  $.ajax({
    url: "./Model/index.php",
    method: "POST",
    data: {
      type: "PackageBerry_Tour3",
    },

    success: function (data) {
      var obj = jQuery.parseJSON(data);
      $("#id-activity-3").empty();
      $.each(obj.message, function (i, item) {
        var you = item["idactivity"];
        var name = item["nameactivity"];
        $("#id-activity-3").append(
          '<option value="' + you + '"> ' + name + " </option>"
        );
        $("#txt_id-3").val(you);
      });
    },
  });
}

function Package_Tour4() {
  $.ajax({
    url: "./Model/index.php",
    method: "POST",
    data: {
      type: "PackageBerry_Tour4",
    },

    success: function (data) {
      var obj = jQuery.parseJSON(data);
      $("#id-activity-4").empty();
      $.each(obj.message, function (i, item) {
        var you = item["idactivity"];
        var name = item["nameactivity"];
        var you1 = item["idactivity"];
        var name1 = item["nameactivity"];
        $("#id-activity-4").append(
          '<option value="' + you + '"> ' + name + " </option>"
        );
        $("#txt_id-4").val(you);
      });
    },
  });
}

function fetch_nameactivity(department) {
  var type1 = "activity_type";
  $("#id-activity-1").empty();
  $("#id-activity-1").append("<option>Loading...</option>");
  $("#id-activity-2").empty();
  $("#id-activity-2").append("<option>Loading...</option>");
  $.ajax({
    url: "./Model/fetch_create1.php",
    method: "POST",
    data: {
      type: department,
    },

    success: function (data) {
      var yourval = jQuery.parseJSON(JSON.stringify(data));
      var obj = jQuery.parseJSON(data);
      $("#id-activity-1").empty();
      $("#id-activity-2").empty();
      $("#id-activity-3").empty();
      $("#id-activity-4").empty();
      $("#id-activity-5").empty();
      $("#id-activity-6").empty();
      $("#id-activity-7").empty();
      $("#id-activity-8").empty();
      $("#id-activity-9").empty();
      $("#id-activity-10").empty();
      $("#id-activity-11").empty();
      $("#id-activity-12").empty();
      $("#id-activity-13").empty();
      $("#id-activity-14").empty();
      $("#id-activity-15").empty();
      $("#id-activity-1").append("<option value=''>เลือกกิจกรรม</option>");
      $("#id-activity-2").append("<option value=''>เลือกกิจกรรม</option>");
      $("#id-activity-3").append("<option value=''>เลือกกิจกรรม</option>");
      $("#id-activity-4").append("<option value=''>เลือกกิจกรรม</option>");
      $("#id-activity-5").append("<option value=''>เลือกกิจกรรม</option>");
      $("#id-activity-6").append("<option value=''>เลือกกิจกรรม</option>");
      $("#id-activity-7").append("<option value=''>เลือกกิจกรรม</option>");
      $("#id-activity-8").append("<option value=''>เลือกกิจกรรม</option>");
      $("#id-activity-9").append("<option value=''>เลือกกิจกรรม</option>");
      $("#id-activity-10").append("<option value=''>เลือกกิจกรรม</option>");
      $("#id-activity-11").append("<option value=''>เลือกกิจกรรม</option>");
      $("#id-activity-12").append("<option value=''>เลือกกิจกรรม</option>");
      $("#id-activity-13").append("<option value=''>เลือกกิจกรรม</option>");
      $("#id-activity-14").append("<option value=''>เลือกกิจกรรม</option>");
      $("#id-activity-15").append("<option value=''>เลือกกิจกรรม</option>");

      $.each(obj, function (i, item) {
        var you = item["idactivity"];
        var name = item["nameactivity"];
        $("#id-activity-1").append(
          '<option value="' + you + '"> ' + name + " </option>"
        );
        $("#id-activity-2").append(
          '<option value="' + you + '"> ' + name + " </option>"
        );
        $("#id-activity-3").append(
          '<option value="' + you + '"> ' + name + " </option>"
        );
        $("#id-activity-4").append(
          '<option value="' + you + '"> ' + name + " </option>"
        );
        $("#id-activity-5").append(
          '<option value="' + you + '"> ' + name + " </option>"
        );
        $("#id-activity-6").append(
          '<option value="' + you + '"> ' + name + " </option>"
        );
        $("#id-activity-7").append(
          '<option value="' + you + '"> ' + name + " </option>"
        );
        $("#id-activity-8").append(
          '<option value="' + you + '"> ' + name + " </option>"
        );
        $("#id-activity-9").append(
          '<option value="' + you + '"> ' + name + " </option>"
        );
        $("#id-activity-10").append(
          '<option value="' + you + '"> ' + name + " </option>"
        );
        $("#id-activity-11").append(
          '<option value="' + you + '"> ' + name + " </option>"
        );
        $("#id-activity-12").append(
          '<option value="' + you + '"> ' + name + " </option>"
        );
        $("#id-activity-13").append(
          '<option value="' + you + '"> ' + name + " </option>"
        );
        $("#id-activity-14").append(
          '<option value="' + you + '"> ' + name + " </option>"
        );
        $("#id-activity-15").append(
          '<option value="' + you + '"> ' + name + " </option>"
        );
        //   alert(you);
      });
    },
  });
}

function Farm_Package1() {
  $.ajax({
    url: "./Model/index.php",
    method: "POST",
    data: {
      type: "PackageFarm_Tour1",
    },

    success: function (data) {
      var obj = jQuery.parseJSON(data);
      $("#id-activity-5").empty();
      $.each(obj.message, function (i, item) {
        var you = item["idactivity"];
        var name = item["nameactivity"];
        $("#id-activity-5").append(
          '<option value="' + you + '"> ' + name + " </option>"
        );
        $("#txt_id-5").val(you);
      });
    },
  });
}
function Farm_Package2() {
  $.ajax({
    url: "./Model/index.php",
    method: "POST",
    data: {
      type: "PackageFarm_Tour2",
    },

    success: function (data) {
      var obj = jQuery.parseJSON(data);
      $("#id-activity-4").empty();
      $.each(obj.message, function (i, item) {
        var you = item["idactivity"];
        var name = item["nameactivity"];
        $("#id-activity-4").append(
          '<option value="' + you + '"> ' + name + " </option>"
        );
        $("#txt_id-4").val(you);
      });
    },
  });
}
function Farm_Package21() {
  $.ajax({
    url: "./Model/index.php",
    method: "POST",
    data: {
      type: "PackageFarm_Tour2-1",
    },

    success: function (data) {
      var obj = jQuery.parseJSON(data);
      $("#id-activity-6").empty();
      $.each(obj.message, function (i, item) {
        var you = item["idactivity"];
        var name = item["nameactivity"];
        $("#id-activity-6").append(
          '<option value="' + you + '"> ' + name + " </option>"
        );
        $("#txt_id-6").val(you);
      });
    },
  });
}

function Farm_PackagePizza() {
  $.ajax({
    url: "./Model/index.php",
    method: "POST",
    data: {
      type: "PackageFarm_TourPizza",
    },

    success: function (data) {
      var obj = jQuery.parseJSON(data);
      $("#id-activity-6").empty();
      $.each(obj.message, function (i, item) {
        var you = item["idactivity"];
        var name = item["nameactivity"];
        $("#id-activity-6").append(
          '<option value="' + you + '"> ' + name + " </option>"
        );
        $("#txt_id-6").val(you);
      });
    },
  });
}

function FarmTogether() {
  $.ajax({
    url: "./Model/index.php",
    method: "POST",
    data: {
      type: "Farmtogether",
    },

    success: function (data) {
      var obj = jQuery.parseJSON(data);
      $.each(obj.message, function (i, item) {
        i  = i + 1
        console.log(i , item)
        $("#id-activity-" + i).empty();
        var you = item["idactivity"];
        var name = item["nameactivity"];
        $("#id-activity-" + i).append(
          '<option value="' + you + '"> ' + name + " </option>"
        );
        $("#txt_id-" + i).val(you);
      });
    },
  });
}

function Farm_Package3() {
  $.ajax({
    url: "./Model/index.php",
    method: "POST",
    data: {
      type: "FarmPackage3",
    },

    success: function (data) {
      var obj = jQuery.parseJSON(data);
      $("#id-activity-7").empty();
      $.each(obj.message, function (i, item) {
        var you = item["idactivity"];
        var name = item["nameactivity"];
        $("#id-activity-7").append(
          '<option value="' + you + '"> ' + name + " </option>"
        );
        $("#txt_id-7").val(you);
      });
    },
  });
}

function Farm_Package32() {
  $.ajax({
    url: "./Model/index.php",
    method: "POST",
    data: {
      type: "FarmPackage32",
    },

    success: function (data) {
      var obj = jQuery.parseJSON(data);
      $("#id-activity-8").empty();
      $.each(obj.message, function (i, item) {
        var you = item["idactivity"];
        var name = item["nameactivity"];
        $("#id-activity-8").append(
          '<option value="' + you + '"> ' + name + " </option>"
        );
        $("#txt_id-8").val(you);
      });
    },
  });
}
function countDoorP() {
  $.ajax({
    url: "./Model/index.php",
    method: "POST",
    data: {
      type: "countDoor",
    },

    success: function (data) {
      var obj = jQuery.parseJSON(data);
      $("#id-activity-5").empty();
      $.each(obj.message, function (i, item) {
        var you = item["idactivity"];
        var name = item["nameactivity"];
        $("#id-activity-5").append(
          '<option value="' + you + '"> ' + name + " </option>"
        );
        $("#txt_id-5").val(you);
      });
    },
  });
}
function countDoorP1() {
  $.ajax({
    url: "./Model/index.php",
    method: "POST",
    data: {
      type: "countDoor",
    },

    success: function (data) {
      var obj = jQuery.parseJSON(data);
      $("#id-activity-6").empty();
      $.each(obj.message, function (i, item) {
        var you = item["idactivity"];
        var name = item["nameactivity"];
        $("#id-activity-6").append(
          '<option value="' + you + '"> ' + name + " </option>"
        );
        $("#txt_id-6").val(you);
      });
    },
  });
}
function countDoorP2() {
  $.ajax({
    url: "./Model/index.php",
    method: "POST",
    data: {
      type: "countDoor",
    },

    success: function (data) {
      var obj = jQuery.parseJSON(data);
      $("#id-activity-7").empty();
      $.each(obj.message, function (i, item) {
        var you = item["idactivity"];
        var name = item["nameactivity"];
        $("#id-activity-7").append(
          '<option value="' + you + '"> ' + name + " </option>"
        );
        $("#txt_id-7").val(you);
      });
    },
  });
}

function countDoorP3() {
  $.ajax({
    url: "./Model/index.php",
    method: "POST",
    data: {
      type: "countDoor",
    },

    success: function (data) {
      var obj = jQuery.parseJSON(data);
      $("#id-activity-9").empty();
      $.each(obj.message, function (i, item) {
        var you = item["idactivity"];
        var name = item["nameactivity"];
        $("#id-activity-9").append(
          '<option value="' + you + '"> ' + name + " </option>"
        );
        $("#txt_id-9").val(you);
      });
    },
  });
}

function progress_bar_process(
  percentage,
  timer,
  message,
  cusid,
  codecus,
  showin,
  showout,
  result,
  valText,
  amountCustomer
) {
  $(".progress-bar").css("width", percentage + "%");
  if (percentage > 100) {
    clearInterval(timer);
    $("#process").css("display", "none");
    $(".progress-bar").css("width", "0%");
    $("#btn-create").attr("disabled", false);
    $("#item_table").find("tr:gt(0)").remove();
    $("#error").html('<div class="alert alert-success">' + message + "</div>");
    $("#customerid").val("");
    $("#codecustomer").val("");
    $("#countcustomer").val(1);
    $("#id-package").val("");
    $("#id-activity-1").val("");
    $("#id-activity-2").val("");
    $("#id-activity-3").val("");
    $("#id-activity-4").val("");
    $("#id-activity-5").val("");
    $("#id-activity-6").val("");
    $("#id-activity-7").val("");
    $("#id-activity-8").val("");
    $("#id-activity-9").val("");
    $("#id-activity-10").val("");
    $("#id-activity-11").val("");
    $("#id-activity-12").val("");
    $("#id-activity-13").val("");
    $("#id-activity-14").val("");
    $("#id-activity-15").val("");
    $("#txt_package").val("");
    $("#txt_id-1").val("");
    $("#txt_id-2").val("");
    $("#txt_id-3").val("");
    $("#txt_id-4").val("");
    $("#txt_id-5").val("");
    $("#txt_id-6").val("");
    $("#txt_id-7").val("");
    $("#txt_id-8").val("");
    $("#txt_id-9").val("");
    $("#txt_id-10").val("");
    $("#txt_id-11").val("");
    $("#txt_id-12").val("");
    $("#txt_id-13").val("");
    $("#txt_id-14").val("");
    $("#txt_id-15").val("");
    setTimeout(function () {
      $("#error").html("");
    }, 5000);
    showModel(cusid, codecus, showin, showout, result, valText, amountCustomer);
  }
}
