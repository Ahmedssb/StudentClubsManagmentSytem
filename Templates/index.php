<?php  

        session_start();

?>
<!DOCTYPE html>
<html lang="ar">
    <head>
        <title>نظام ادارة الأندية الطلابية</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->	
            <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
        <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
        <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
        <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
        <!--===============================================================================================-->	
            <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
        <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
        <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
        <!--===============================================================================================-->	
            <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
        <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="css/util.css">
            <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
    </head>
    <body style="background-color: #666666;">

        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100">
                   
                    <!-- send the form data to test class to check the user credential --> 
                    <form action=" Database\test.php" method="post" class="login100-form validate-form">
                         
                           <div class="title">
                            <span class="login100-form-title p-b-43">
                                <img src="images/iaulogo33.png" style="width:450px;height:150px;  border-radius: 20px; ">                            </span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate = "الرجاء ادخال اسم المستخدم ">
                                <input class="input100" type="text" name="id">
                                <span class="focus-input100"></span>
                                <span class="label-input100">اسم المستخدم</span>
                            </div>


                            <div class="wrap-input100 validate-input" data-validate="الرجاء ادخال كلمة مرور صحيحة">
                                <input class="input100" type="password" name="pwd">
                                <span class="focus-input100"></span>
                                <span class="label-input100">كلمة المرور</span>
                            </div>

                            <div class="flex-sb-m w-full p-t-3 p-b-32">
                               <!-- <div class="contact100-form-checkbox">
                                  <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">

                                    <label class="label-checkbox100" for="ckb1">
                                        تذكرني
                                    </label>

                                </div>-->

                                <!--<div>
                                    <a href="#" class="txt1">
                                        نسيت كلمة السر
                                    </a>
                                </div>-->
                            </div>


                            <div class="container-login100-form-btn">
                                <input type="submit" name="login" value="تسجيل الدخول" class="login100-form-btn">

                            </div> 
                         <?php   

                  // dispaly error message if the user enter incorrect info 
                     if(isset($_SESSION['loginError'])) {
                          echo '<br>
                        <div class="error">'.$_SESSION['loginError'].'</div>';
                        unset($_SESSION['error']);
                                            }

                ?>

                   </form>
                    
           

           

                    <div class="login100-more" style="background-image: url('images/logo SCM 41-23.png');">
                        
                    </div>


                </div>


            </div>
        </div>


        


    <!--===============================================================================================-->
        <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
        <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
        <script src="vendor/bootstrap/js/popper.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
        <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
        <script src="vendor/daterangepicker/moment.min.js"></script>
        <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
        <script src="vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
        <script src="js/main.js"></script>

    </body>
</html>