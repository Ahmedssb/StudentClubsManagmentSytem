<?php  
 
session_start();
include "user.php";

  	 $log = new User();  

        if(isset($_POST['login'])){  
            //check for empty fields
            if(empty($_POST['id']) || empty($_POST['pwd'])){
                 $_SESSION["loginError"]= " الرجاء ادخال الحقول المطلوبة";
                 header("location:..\index.php?");
            }else{
                $id = $_POST['id'];  // get the user id from the login
                $pwd = $_POST['pwd'];  // get the user pass from the forum
            }
            
            // make sure the user exist in the system and his pass && id is correct  
            $user =$log->userLog($id, $pwd); 
            
          
             // direct the user into his dashbord depend on his postion 
             if ($user){
                   // get the user postin 
                        $pos = $log->getUserPostion($id, $pwd); 
                             $_SESSION["uid"]=$id;
                              $_SESSION["postion"]=$pos[0];
                              if(strcmp($pos[0],"supervisor")==0){
                                  header("location: ..\Views\Dashboard.php"); 

                                 } elseif(strcmp($pos[0],"president")==0){
                                     header("location: ..\Views\presidentDashboard.php"); 
                                 }elseif(strcmp($pos[0],"general-supervisor")==0){
                                     header("location: ..\Views\generalSupervisorDashboard.php"); 
                                 } else{      
                 
                                     header("location:..\index.php");
                                   }
                 
                      }
            else{     // if the id or pass is incorrect redirect the user to the login page and display error message
                 $_SESSION["loginError"]= " اسم المستخدم أو كلمة المرور غير صحيحة";
                 header("location:..\index.php?");
             
 
               }
        }  // end of if isset 


        
?>