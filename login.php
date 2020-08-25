<?php
include('Model/config.php');
if(!empty($_SESSION['userid']))
{
$session_uid=$_SESSION['userid'];
$url=BASE_URL.'/index.php';
header("Location: $url");
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="css/bootstrap.css" >
<link rel="shortcut icon" type="image/x-icon" href="template/coupon.gif">
  </head>
<body>

    <div class="container">

                <h1 class="text-center"></h1>
                <div class="container mt-5 pt-5">
                    <div class="row justify-content-sm-center">
                        <div class="col-sm-6 col-md-4">
                            <div class="card border-info text-center">
                                <div class="card-header">Fountaintree resort</div>
                                <div class="card-body">
                                    <img src="https://www.chillpainai.com/src/wewakeup/scoop/img_scoop/scoop/Tuk/scoop/Hotel/foutaintree/waterball.jpg" width="200" height="170">
                                    <h4 class="text-center">CashCard ft</h4>
                                    <div class="form-signin" >
                                        <input type="email" id="email" name="email" class="form-control mb-2" placeholder="Email.." required autofocus>
                                        <input type="password" id="password"  name="password"  class="form-control mb-2" placeholder="Password.." required>
                                        <button class="btn btn-lg btn-primary btn-block mb-1" id="btn_login" type="submit">Sign in</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
    </div>
    

  </body>
</html>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="js/login.js"></script>