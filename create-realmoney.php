<?php
include('Model/config.php');
include('Model/session.php');
$userDetails=$userClass->userDetails($session_uid);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>สร้างบัตร</title>
    <style>
            .printsleep{
                font-size: 22px;
            }
            h3,h4 , h5{
                text-align:center;
            }

            .txtprint{
                text-align:left;
                margin-left:40px;
            }

            .txtleft{
                display: inline; /* the default for span */
            }

            .txtright{
                float:right;
                margin-right:0px;
            }

            hr{
                background-color:black;
            }

        


        @media all {
	    .page-break	{ display: none; }
        }

        @media print {
            @page { margin: 0; }
            body { margin: 2.0cm; }
            header, footer, aside, nav, form, iframe, .menu, .hero, .adslot , .modal-footer , .printable{
            display: none;
            }
        .page-break	{ display: block; page-break-before: always; }
        }

        .activity{
            font-size: 18px;
            margin-left: 44px;
        }

        .float_center {
        float: left;

        position: relative;
          /* or right 50% */
        text-align: left;
        }
        .float_center > .child {
        position: relative;
        left: 50%;
        }

       

        .main {
        width: 400px;
        height: 100%;
        border: 1px solid #c3c3c3;
        display: flex;
        font-size:13.5px;
        justify-content: center;
        }

        .main li {
        width: 100%;
        height: 280px;
        }
    
        
    </style>
    <link rel="shortcut icon" type="image/x-icon" href="template/coupon.gif">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <script src="js/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>
<body>

<style type="text/css">


        #customerid{ text-transform:uppercase;}


</style>

  
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php
            include('sidebar.php');
        ?>
    
    <div id="content">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
    
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>ปิดแถบ เมนู</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
    
                    
    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item mt-2 ">
                                <strong> Welcome to : <?php echo $userDetails->fname; ?> </strong> 
                                <strong> No : <?php echo $userDetails->userid; ?> </strong> 
                                <input type="hidden" value="<?php echo $userDetails->userid; ?>" id="userid">
                            </li>
                            <li class="nav-item">
                                
                                <a class="nav-link" href="<?php echo BASE_URL; ?>/Model/logout.php"><i class="fas fa-sign-out-alt"></i></a>
                            </li>
                
                        </ul>
                    </div>
                </div>
            </nav>
            <h3 align="center"></h3><br />

<div class="col-sm-6 offset-sm-3 ">
        <div class="info-form">
            <form action="" class="form-inlin justify-content-center">

                <div class="form-group">
                    <label for="customerid" >รหัสบิล Seniorsoft</label>
                    <input type="text" class="form-control " id="senior" name="senior"  placeholder="เลขบิล seniorsoft">
                </div>

                <div class="form-group">
                    <label for="customerid" >รหัสลูกค้า/กลุ่ม</label>
                    <input type="text" class="form-control " id="customerid" name="customerid" readonly="readonly"  placeholder="รหัสลูกค้า/กลุ่ม">
                </div>

                <div class="form-group">
                        <label for="code-customer">ประเภทบัตร</label>
                        <select class="form-control" id="tpye-card-ac">โปรดเลือก
                                <option value="" >โปรดเลือก</option>
                                <option value="1" >บัตรกิจกรรมเดี่ยว</option>
                                <option value="2" >บัตรชุด 1X2Y</option>
                                <option value="3" >บัตรชุด 1X1Y1Z</option>
                        </select>
                </div>


                <div class="form-group">
                        <label for="price-discount">ลดราคา %</label>
                        <input type="text" class="form-control" id="price-discount" placeholder="0">
                </div>

                
                <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="name-customer">วันที่เข้าเล่น</label>
                        <input class="form-control" id="datein" name="datein" placeholder="DD/MM/YYY" type="date"/>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name-customer">วันที่ออก</label>
                            <input class="form-control" id="dateout" name="datein" placeholder="DD/MM/YYY" type="date"/>
                        </div>
                        <div class="form-group col-md-6">
                        <label for="count-customer">จำนวนลูกค้า</label>
                        <input type="number" class="form-control" id="countcustomer" value="1" >
                        </div>

                        <div class="form-group col-md-6">
                        <label for="count-customer">จำนวนกิจกรรมที่เล่น</label>
                            <select class="form-control" id="amount-activity">โปรดเลือก
                                <option value="1" >1</option>
                                <option value="2" >2</option>
                                <option value="3" >3</option>
                                <option value="4" >4</option>
                                <option value="5" >5</option>
                                <option value="6" >6</option>
                                <option value="7" >7</option>
                                <option value="8" >8</option>
                                <option value="9" >9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                    <div class="col-sm-4">
                    <input type="checkbox" id="chkx" name="x[]" value="0"> ใบปะหน้า X <br>
                    </div>
                    <div class="col-sm-4">
                    <input type="checkbox" id="chky" name="y[]" value="1"> ใบปะหน้า Y <br>
                    </div>
                    <div class="col-sm-4">
                    <input type="checkbox" id="chkz" name="z[]" value="2"> ใบปะหน้า Z <br>
                    </div>
                    
                    </div>

                    <div class="form-group">
                            <div class="input-group-prepend">
                                    <label class="input-group-text" id="lb-n-package" for="id-package">แพคเกจ</label>
                                    <input class="form-control col-md-2" id="txt_package" name="txt_package" readonly="readonly"  type="text"/>
                                    <select id="id-package" class="form-control"></select>
                            </div>
                        </div>
                
                    <div class="form-group">
                            <div class="input-group-prepend">
                                    <label class="input-group-text" id="lb-n-1" for="id-activity-1">ประเภทกิจกรรม 1</label>
                                    <input class="form-control col-md-2" id="txt_id-1" name="txt_id-1" readonly="readonly"  type="text"/>
                                    <select id="id-activity-1" class="form-control"></select>

                            </div>
                        </div>

                    <div class="hide-combobox-2" style="display:none" >
                            <div class="form-group">
                                    <div class="input-group-prepend">
                                            <label class="input-group-text"  id="lb-n-2" for="id-activity-2">ประเภทกิจกรรม 2</label>
                                            <input class="form-control col-md-2" id="txt_id-2" name="txt_id-2" readonly="readonly"  type="text"/>
                                            <select id="id-activity-2" class="form-control"></select>
                                    </div>
                            </div>
                    </div>
                    
                    <div class="hide-combobox-3" style="display:none">
                            <div class="form-group">
                                    <div class="input-group-prepend">
                                            <label class="input-group-text" id="lb-n-3" for="id-activity-3">ประเภทกิจกรรม 3</label>
                                            <input class="form-control col-md-2" id="txt_id-3" name="txt_id-3" readonly="readonly"  type="text"/>
                                            <select id="id-activity-3" class="form-control"></select>
                                    </div>
                            </div>
                    </div>
                    

                    <div class="hide-combobox-4" style="display:none">
                            <div class="form-group">
                                    <div class="input-group-prepend">
                                            <label class="input-group-text"  id="lb-n-4" for="id-activity-4">ประเภทกิจกรรม 4</label>
                                            <input class="form-control col-md-2" id="txt_id-4" name="txt_id-4" readonly="readonly"  type="text"/>
                                            <select id="id-activity-4" class="form-control"></select>
                                    </div>
                            </div>
                    </div>
                    <div class="hide-combobox-5" style="display:none">
                            <div class="form-group">
                                    <div class="input-group-prepend">
                                            <label class="input-group-text"  id="lb-n-5" for="id-activity-5">ประเภทกิจกรรม 5</label>
                                            <input class="form-control col-md-2" id="txt_id-5" name="txt_id-5" readonly="readonly"  type="text"/>
                                            <select id="id-activity-5" class="form-control"></select>
                                    </div>
                            </div>
                    </div>
                    <div class="hide-combobox-6" style="display:none">
                            <div class="form-group">
                                    <div class="input-group-prepend">
                                            <label class="input-group-text"  id="lb-n-6" for="id-activity-6">ประเภทกิจกรรม 6</label>
                                            <input class="form-control col-md-2" id="txt_id-6" name="txt_id-6" readonly="readonly"  type="text"/>
                                            <select id="id-activity-6" class="form-control"></select>
                                    </div>
                            </div>
                    </div>
                    <div class="hide-combobox-7" style="display:none">
                            <div class="form-group">
                                    <div class="input-group-prepend">
                                            <label class="input-group-text"  id="lb-n-7" for="id-activity-7">ประเภทกิจกรรม 7</label>
                                            <input class="form-control col-md-2" id="txt_id-7" name="txt_id-7" readonly="readonly"  type="text"/>
                                            <select id="id-activity-7" class="form-control"></select>
                                    </div>
                            </div>
                    </div>
                    <div class="hide-combobox-8" style="display:none">
                            <div class="form-group">
                                    <div class="input-group-prepend">
                                            <label class="input-group-text"  id="lb-n-8" for="id-activity-8">ประเภทกิจกรรม 8</label>
                                            <input class="form-control col-md-2" id="txt_id-8" name="txt_id-8" readonly="readonly"  type="text"/>
                                            <select id="id-activity-8" class="form-control"></select>
                                    </div>
                            </div>
                    </div>
                    <div class="hide-combobox-9" style="display:none">
                            <div class="form-group">
                                    <div class="input-group-prepend">
                                            <label class="input-group-text"  id="lb-n-9" for="id-activity-9">ประเภทกิจกรรม 9</label>
                                            <input class="form-control col-md-2" id="txt_id-9" name="txt_id-9" readonly="readonly"  type="text"/>
                                            <select id="id-activity-9" class="form-control"></select>
                                    </div>
                            </div>
                    </div>
                    <div class="hide-combobox-10" style="display:none">
                            <div class="form-group">
                                    <div class="input-group-prepend">
                                            <label class="input-group-text"  id="lb-n-10" for="id-activity-10">ประเภทกิจกรรม 10</label>
                                            <input class="form-control col-md-2" id="txt_id-10" name="txt_id-10" readonly="readonly"  type="text"/>
                                            <select id="id-activity-10" class="form-control"></select>
                                    </div>
                            </div>
                    </div>
                    <div class="hide-combobox-11" style="display:none">
                            <div class="form-group">
                                    <div class="input-group-prepend">
                                            <label class="input-group-text"  id="lb-n-11" for="id-activity-11">ประเภทกิจกรรม 11</label>
                                            <input class="form-control col-md-2" id="txt_id-11" name="txt_id-11" readonly="readonly"  type="text"/>
                                            <select id="id-activity-11" class="form-control"></select>
                                    </div>
                            </div>
                    </div>
                    <div class="hide-combobox-12" style="display:none">
                            <div class="form-group">
                                    <div class="input-group-prepend">
                                            <label class="input-group-text"  id="lb-n-12" for="id-activity-12">ประเภทกิจกรรม 12</label>
                                            <input class="form-control col-md-2" id="txt_id-12" name="txt_id-12" readonly="readonly"   type="text"/>
                                            <select id="id-activity-12" class="form-control"></select>
                                    </div>
                            </div>
                    </div>
                    <div class="hide-combobox-13" style="display:none">
                            <div class="form-group">
                                    <div class="input-group-prepend">
                                            <label class="input-group-text"  id="lb-n-13" for="id-activity-13">ประเภทกิจกรรม 13</label>
                                            <input class="form-control col-md-2" id="txt_id-13" name="txt_id-13" readonly="readonly"  type="text"/>
                                            <select id="id-activity-13" class="form-control"></select>
                                    </div>
                            </div>
                    </div>
                    <div class="hide-combobox-14" style="display:none">
                            <div class="form-group">
                                    <div class="input-group-prepend">
                                            <label class="input-group-text"  id="lb-n-14" for="id-activity-14">ประเภทกิจกรรม 14</label>
                                            <input class="form-control col-md-2" id="txt_id-14" name="txt_id-14" readonly="readonly"  type="text"/>
                                            <select id="id-activity-14" class="form-control"></select>
                                    </div>
                            </div>
                    </div>
                    <div class="hide-combobox-15" style="display:none">
                            <div class="form-group">
                                    <div class="input-group-prepend">
                                            <label class="input-group-text"  id="lb-n-15" for="id-activity-15">ประเภทกิจกรรม 15</label>
                                            <input class="form-control col-md-2" id="txt_id-15" name="txt_id-15" readonly="readonly"  type="text"/>
                                            <select id="id-activity-15" class="form-control"></select>
                                    </div>
                            </div> 
                    </div>
                <button type="button" id="btn-create" class="btn btn-primary btn-lg">บันทึก</button>
                <br>
                <br>
            </form>
        </div>
</div>    
            
        </div>
    </div>
    
    
    


    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>


</body>
</html>

<script src="js/real-money.js"></script>
<script src="js/function.js"></script>
<script type="text/javascript" src="js/qrcode.js"></script>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog" role="document" >
          <div class="modal-content">  
            <div class="modal-body">
                <div class="printsleep">
                <h4 id="txtshowPromote1"></h4>
                <h5 id="txtshowPromote2"></h5>
                <hr>
                <h3 id="typecard">บัตรกิจกรรม</h3>
                    <br>
                    <div class="txtprint">
                    <h6 class="txtleft">รหัสกรุ๊ป : </h6>
                    <h6 class="txtleft" id="cusid"></h6> 
                    <h6 class="txtleft">No: </h6>
                    <h6 class="txtleft" id="cusid-no">1</h6>
                    </div>
                    <div class="txtprint">
                    <h6 class="txtleft">ชื่อกรุ๊ป : </h6>
                    <h6 class="txtleft"id="cusname"></h6> 
                    </div>
                    <div class="txtprint">
                    <h6 class="txtleft">วันที่เข้าเล่น : </h6>
                    <h6 class="txtleft" id="dateplay"></h6>
                    <h6 class="txtleft">วันที่ออก : </h6>
                    <h6 class="txtleft" id="dateendplay"></h6>
                    </div>
                    <br>
                    <h4>รายชื่อกิจกรรมที่สามารถเล่นได้</h4>
                    <br>
                    <div class="activity" id="txtArray"></div>
                    <br>
                    <div id="qrcode" align="center"></div>
                    <br>
                </div>
                <div style="display:none" id="tableActivity" class="main">
                        <li class="main" style="display:none" id="x"></li>
                        <li class="main" style="display:none" id="y"></li>
                        <li class="main" style="display:none" id="z"></li>
                        </div>
                <div class="clear"></div>
                    
                    
            <div class="page-break"></div>
                    
            </div>
           
            
          </div>
        </div>
      </div>


