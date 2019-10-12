<?php 
session_start();
// there sholud be if isset get  then add get data into links in every page 
    $id=$_SESSION["uid"];// get the user id 

     $pos=$_SESSION['postion'] ; // get the pos  
      if( isset($_GET['name'])){
          $clubName=$_GET["name"]; // get the club name send with the link

           $_SESSION['name']=$clubName;
    }
    if( isset($_GET['id'])){
        $clubId=$_GET["id"];  // get the club id  send with the link
        $_SESSION['clubId'] =$clubId;

    }

    $id=$_SESSION['uid'];  // get the user id  
    $pos=$_SESSION['postion'] ; // get the pos  

?>
<!doctype html>
<html lang="ar">
 <head>
	<meta charset="UTF-8">
	<title>club page </title>
	<link rel="stylesheet" href="../css/club.css">
             <link rel="stylesheet" href="../css/general.css">
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">   
      
 </head>
 <body >
   
    <!-- start header -->
     <header>
         
         <?php 
         echo'
          <div class="headerDiv">
                <div class="headerLogout"><a href="logout.php"> تسجيل الخروج <i class="fas fa-sign-out-alt" style="font-size:20px;"></i></a></div>
                <div class="headerTitle"><h3> نظام إدارة الأندية الطلابية</h3></div>
                <div class="profile"><a href="profile.php"> عرض الملف الشخصي <i class="far fa-user" style="color:#062052;"></i></a></div> 
          </div>  ';   // this link go to profile page 
         ?>
     </header>
    <!-- end header -->
      
   <!-- start nav -->
	<nav>
                   
  
<?php 
    if(strcmp($pos,"supervisor")==0 ){
         $main = "Dashboard.php";
     }else{
         $main = "generalSupervisorDashboard.php";
     }
    // $supNav && $preNav are varible containing the nav for differnt user postion   
    $supNav='
    <div class="logo"><img src="../images/logo SCM 41-2(png).png"  style="width:100%;height:100%;postion:fixed;"></div>
    <ul>
    
          <a href="'.$main.'?name='.$clubName.'&&id='.$clubId.'">
			<li>
				<div class="barra"></div>
				<p class="menu"> الرئيسية</p>
			</li>
			</a>
            
			<a href="reports.php?name='.$clubName.'&&id='.$clubId.'">
			<li>
				<div class="barra"></div>
				<p class="menu"> مذكرات وتقارير النادي</p>
			</li>
			</a>
            
			<li>
                <a href="add.php?name='.$clubName.'&&id='.$clubId.'" >
				<div class="barra"></div>
				<p class="menu">اضافة عضو</p>
                </a>
			</li>  
              <li>
                <a   href="aboutClub.php?name='.$clubName.'&&id='.$clubId.'" >
				<div class="barra"></div>
				<p class="menu"> عن النادي</p>
                </a>    
                
			</li>

		</ul>';

            $preNav='    
            <div class="logo"><img src="../images/logo SCM 41-2(png).png" style="width:273px;height:80px;postion:fixed;"></div>
            <ul>
			<li>
                <a href="presidentDashboard.php?name='.$clubName.'&&id='.$clubId.'" >
				<div class="barra"></div>
				<p class="menu"> الرئيسية </p>
                </a>
			</li>
			 
            
			<a href="reports.php?name='.$clubName.'&&id='.$clubId.'">
			<li>
				<div class="barra"></div>
				<p class="menu">التقارير والمذكرات الصادرة</p>
			</li>
			</a>
            <a href="addReport.php?name='.$clubName.'&&id='.$clubId.'">
			<li>
				<div class="barra"></div>
				<p class="menu">اضافة تقريراو مذكرة تنفيذ</p>
			</li>
			</a>
            
			<li>
                <a href="add.php?name='.$clubName.'&&id='.$clubId.'" >
				<div class="barra"></div>
				<p class="menu">اضافة عضو</p>
                </a>
            <li>
                <a   href="presidentTemplates.php?name='.$clubName.'&&id='.$clubId.'" >
				<div class="barra"></div>
				<p class="menu"> نماذج التقارير</p>
                </a>    
                
			</li> 
            <li>
                <a   href="aboutClub.php?name='.$clubName.'&&id='.$clubId.'" >
				<div class="barra"></div>
				<p class="menu"> عن النادي</p>
                </a>    
                
			</li>
		</ul>';
        
         // dispaly the menue based on the user postion 
         if(strcmp($pos,"supervisor")==0 or strcmp($pos,"general-supervisor")==0){
             echo $supNav;
         }elseif(strcmp($pos,"president")==0){
             echo $preNav;
         }

            ?>
	</nav>
 <!-- End nav -->

   <div class="fix-float" ></div>
        
      
 <!-- end container1 -->    
      <?php 
       include'../Database/clubs.php';
         $cc= new Clubs();
         $club=$cc->getClub($clubId);
          $num= $cc->getClubMembersnum($clubName);
             //print_r($club);
     ?>
 
        <div  class="filter" style=" 
       background-repeat: no-repeat;	background-position:left;height:110px;border-radius: 15px;object-fit: contain;"  >
             <div style="float:left;">  
                 
                 <div  style="display:inline-block;text-align: center; margin-right:190px; " > 
                           <img src="../Logos/<?php echo $club['logo']?>" style=" width:350px;height: 100px; object-fit: fill;">    
                           
                    </div> 
                 
                     <div  style="display:inline-block; margin-left:40px; text-align: center;" > 
                           <h3> صفة النادي</h3>  
                            <span  style="color:  #d63c3c   ;"><?php echo $club['type']?>  </span>
                    </div> 

                     <div  style=" display:inline-block; margin-left:40px;    text-align: center;"   > 
                           <h3>عدد الأعضاء</h3>  
                            <span style="color: #d63c3c ;"><?php echo $num   ?></span>
                    </div> 
                     <div  style=" display:inline-block;  margin-left:40px;  text-align: center;" > 
                           <h3><?php echo $clubName ?></h3>  
                            <span  style="color:  #d63c3c;font-weight:500;"><?php echo $club['establishdate']?> تأسس عام</span>
                    </div> 

           </div> 
         </div>
     <!-- end filter1 -->    

     
     <!-- start filter2 -->           
      <div  class="filter">
             <div class="aboutclub"  >    
                   <h3>الرؤية  </h3>  
                  <p class="clubinfop"><?php echo $club['vission']?></p>
            </div> 
      </div>
     <!-- end filter2 --> 
     
     
    <!-- start filter3 -->           
     <div  class="filter">
             <div class="aboutclub"  >    
                   <h3>الرسالة  </h3>  
                  <p class="clubinfop"><?php echo $club['mission']?></p>
            </div> 
     </div>
     <!-- end filter3 -->   
     
     
    <!-- start filter4 -->           
     <div  class="filter"  style="margin-bottom:20px;">
             <div class="aboutclub"   >    
                   <h3>الأهداف  </h3>  
                  <p class="clubinfop"><?php echo $club['goals']?></p>
            </div> 
     </div>
     <!-- end filter4 -->   

  
 </body>
    
</html>