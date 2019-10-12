<?php 
session_start();
   $id=$_SESSION['uid'];  // get the user id  
   $pos=$_SESSION['postion'] ; // get the pos  
     
?>

<!doctype html>
<html lang="ar">
 <head>
        <meta charset="UTF-8">
        <title>suprevisor dashboard </title>
            <link rel="stylesheet" href="../css/general.css">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">    


</head>
  <body>
    <!-- start header -->
     <header>
        <?php 
         echo'
          <div class="gheaderDiv">
                <div class="headerLogout"><a href="logout.php"> تسجيل الخروج <i class="fas fa-sign-out-alt" style="font-size:20px;"></i> </a></div>
                <div class="gheaderTitle"><h3> نظام ادارة الأندية الطلابية</h3></div>
                <div class="gprofile"><a href="profile.php"> عرض الملف الشخصي  <i class="far fa-user" style="color:#062052;"></i>  </a></div> 
          </div>  ';   // this link go to profile page 
         ?>
    </header>
    <!-- end header -->
  
  <!-- start container -->  
       <div class="supContainer ">
       
       
    <?php 
       include_once'../Database/clubs.php';

          $cc= new Clubs();
          $ss =$cc->getSupClusb($id); // get all clubs belong to the supervisor
            
           foreach($ss as $c){
               /*display club logos and names
               when user click any club redirect him to the club page "club_page.php" */
              echo  '<div class="container-cities"  >
                                 <a href = "club_page.php?name='.$c["name"].'&&id='.$c["id"].' ">  
                                     <img src="../Logos/'.$c['logo'].'"  alt="club logo">
                                    <div class="imghead">  <span>'.$c["name"].'</span> </div>

                                </a>


                    </div>  ';

          }

    
      ?>   
         
    
      </div>    
  
      <!-- end container -->    

 </body>
    
</html>