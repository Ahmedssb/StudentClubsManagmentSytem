<?php 
session_start();
 
$id=$_SESSION["uid"];// get the user id 
//echo $id;
 $pos=$_SESSION['postion']; // get the pos 
 /* make varible link dynamic depend on the user postion so 
 when he click back button he will be redirected to his main page*/
    if(strcmp($pos,"supervisor")==0){   
       
              $link="Dashboard.php" ;
       
              } elseif(strcmp($pos,"president")==0){
                $link="presidentDashboard.php" ;    
                                                   
               }elseif(strcmp($pos,"general-supervisor")==0){
                $link="generalSupervisorDashboard.php" ;    
                                                   
               }
               else{

                         }

    
 
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>menu</title>
	<link rel="stylesheet" href="../css/club.css">
      
</head>
<body>
    <!-- start header -->
     <header class="profileHeader">
         
        <?php 
         echo'
        
          <div><a href="logout.php"> تسجيل الخروج</a></div>
            <div><h3> نظام ادارة الأندية الطللابية</h3></div>
           '; // this link go to profile page with id of the user
         ?>
     </header>
    <!-- end header -->
      <?php 
       include'../Database/clubs.php';
         $c= new Clubs();
          $name =$c->getUserName($id);
             ?>
 <!-- End nav -->
   
   <!-- start container -->  
  <div class="fix-float" ></div>
        <div class="container">
              <div class="con">    
      <?php 
    
     //  $ss =$cc->getclubAdmins($clubName);   
                  
         
        echo '  ';
       ?>   
                            <h3>الملف الشخصي </h3>
                                  <fieldset class="profieldset">
                                             <input type="text" value=<?php echo $name['name']; ?>>  
                                             <label>الاسم </label> 
                                 </fieldset>

                                   <fieldset class="profieldset">
                                    <input type="text" value=<?php echo $pos; ?>>  
                                     <label>الصفة الادارية</label> 

                                      </fieldset>
                             <h3>تغيير كلمة السر </h3>
                      <form action="../Database/changepassword.php" method="post"  >
                                   <fieldset class="profieldset">
                                             <input type="password"  name="currentpassword" >  
                                             <label>كلمة السر الحالية </label> 
                                     
                                   </fieldset>
                          
                                    <fieldset class="profieldset">
                                    <input type="password" name="password" >  
                                     <label>كلمة السر الجديدة</label> 
                                     </fieldset>

                                   
                      
                                <fieldset class="profieldset">
                                    <input type="password"  name="conformpassword" >  
                                     <label>تأكيد كلمة السر</label> 
                                 </fieldset> 
                          <input type="submit"  value="تغيير" name="changepwd">
                        </form>
                   
                  
                 <?php    
                  // dispaly error message if the user enter incorrect info 
                     if(isset($_SESSION['error'])) {
                         echo '<br>
                        <div class="error">'.$_SESSION['error'].'</div>';
                        unset($_SESSION['error']);
                                            }

                ?>
                  <!--when user click this button he will be redirected to his main page 
                       depend on the link varible which is contain the user main page link based on his postion -->
              <div class="buttons"  >
                 <?php // href should be dynamic depend on the postion 
                 echo '<a href="'.$link.'" method="post">
                 <button type="submit" name="changepwd" >رجوع </button>   
                  </a>';?>
              </div> 
                  
                  
                  
            </div> 

 
                
  </div>      
              <!-- end container -->    

</body>
</html>      
 
            