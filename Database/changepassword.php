<?php 
 
 include "user.php";
 //session_start();

   $user= new User();
   $id=$_SESSION['uid'];  // get the user id  
  
    if(isset($_POST['changepwd'])) {
            $currentpassword = $_POST['currentpassword'];
            $newpassword = $_POST['password'];
            $conformpassword = $_POST['conformpassword'];
                 if($currentpassword == "") {
                  $_SESSION["error"]="الرجاء ادخال كلمة المرور الحالية";
                 header("location:../Views/profile.php");
                

                }

                if($newpassword == "") {
                $_SESSION["error"]="الرجاء ادخال كلمة المرور الجديدة";
                 header("location:../Views/profile.php");                }

                if($conformpassword == "") {
                 $_SESSION["error"]="الرجاء تأكيد كلمة المرور الجديدة";
                 header("location:../Views/profile.php");                }

                if($currentpassword && $newpassword && $conformpassword) {
                    if($user->passwordMatch($id,$currentpassword) === TRUE) {

                        if($newpassword != $conformpassword) {
                            $_SESSION["error"]="لايوجد تطابق بين كلمة المرور";
                            header("location:../Views/profile.php");  
                        } else {
                            //if($user->changePassword($_SESSION['id'], $newpassword) === TRUE)
                            if($user->changePassword($id, $newpassword) === TRUE) {
                                 $_SESSION["error"]= "Successfully updated";
                                header("location:../Views/profile.php");
                            } else {
                                echo "Error while updating the information <br />";
                            }
                        }

                    } else {
                         $_SESSION["error"]= "كلمة المرور الحالية غير صحيحة <br />";
                        header("location:../Views/profile.php");
                    }
                }
    }else{
        echo "not set";
    }
 
?>