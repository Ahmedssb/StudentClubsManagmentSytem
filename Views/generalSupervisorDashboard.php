<?php 
session_start();
   $id=$_SESSION['uid'];  // get the user id  
   $pos=$_SESSION['postion'] ; // get the pos  
     
?>

<!doctype html>
<html lang="ar">
<head>
        <meta charset="UTF-8">
        <title>general suprevisor dashboard</title>
        <link rel="stylesheet" href="../css/general.css">
        <link rel="stylesheet" href="../css/club.css">
       <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">    

      <script>
           function isChecked() {
              var public = document.getElementById("public");
              var special =document.getElementById("special");
              var all =document.getElementById("all");
               if (public.checked == true && special.checked == true && all.checked  ){
                       window.location.href ="generalSupervisorDashboard.php?filter=all"; 

              }
              else if (special.checked == true){
                   window.location.href ="generalSupervisorDashboard.php?filter=special"; 
                   document.getElementById("special").checked = true;
              }else if(public.checked == true){
                      window.location.href ="generalSupervisorDashboard.php?filter=public"; 
                       document.getElementById("public").checked = true;
              }else if(all.checked == true){
                      window.location.href ="generalSupervisorDashboard.php?filter=all"; 
                       document.getElementById("all").checked = true;
              }else {

              }
            }

       
   </script>

    </head>
 <body>
    <!-- start header -->
     <header>
        <?php 
         echo'
          <div class="headerDiv">
                <div class="headerLogout"><a href="logout.php"> تسجيل الخروج <i class="fas fa-sign-out-alt" style="font-size:20px;"></i></a></div>
                <div class="headerTitle"> نظام إدارة الأندية الطلابية</div>
                <div class="profile"><a href="profile.php"> عرض الملف الشخصي <i class="far fa-user" style="color:#062052;"></i></a></div> 
          </div>  ';   // this link go to profile page 
         ?>
    </header>
     
    <!-- end header -->
    <nav>
      <div class="logo"><img src="../images/logo SCM 41-2(png).png"  style="width:100%;height:100%;postion:fixed;"></div>
         <ul>
			<li>
                <a href="generalSupervisorDashboard.php?name='.$clubName.'&&id='.$clubId.'" >
				<div class="barra"></div>
				<p class="menu"> الرئيسية </p>
                </a>
			</li>
			 
            
			<a href="addClub.php">
			<li>
				<div class="barra"></div>
				<p class="menu">إضافة نادي</p>
			</li>
			</a>
            <li>
                <a href="admins.php" >
				<div class="barra"></div>
				<p class="menu">مسؤولي الأندية</p>
                </a>
            </li>      
          <li>
                <a href="addTemplate.php" >
				<div class="barra"></div>
				<p class="menu">إضافة نموذج</p>
                </a>
            </li> 
             
               <li>
                <a href="templates.php" >
				<div class="barra"></div>
				<p class="menu">النماذج المرفوعة</p>
                </a>
            </li> 
            <li>
                <a href="upload.php" target="_blank" >
				<div class="barra"></div>
				<p class="menu"> upload</p>
                </a>
            </li> 

		</ul>
	</nav>
     
     
   <?php 
             include_once'../Database/clubs.php';
       
            $cc= new Clubs();
            $num1=$cc->getNumOfClubs('تخصصي');
            $num2=$cc->getNumOfClubs('عام');

     
                ?>
    <div  class="filter" style="color:#062052;font-size:17px;">
        <form>
       
       <label >الكل<input  style="margin-right:6%;" type="checkbox"  value="أندية عامة" id="special" class="special"  onclick="isChecked()"  >  
       <label>أندية تخصصية<input style="margin-right:6%;" type="checkbox"  value="أندية عامة" id="public"   class="public"  onclick="isChecked()"> </label> 
        <label>أندية عامة<input style="margin-right:6%;" type="checkbox"  value="أندية عامة" id="all"   class="all"  onclick="isChecked()"> </label> 
        
        <label style="float:left;margin-left:7%;" ><span style="color: #cc0126  ;text-decoration: underline;"><?php echo $num1 ?> </span> عدد الأندية التخصصية  </label> 
        <label style="float:left;margin-left:7%;"> <span style="color: #cc0126  ;text-decoration: underline;"><?php echo $num2  ?> </span> عدد الأندية العامة  </label> 
        <label style="float:left;margin-left:7%;"> <span style="color: #cc0126  ;text-decoration: underline;"><?php echo $num2+$num1 ?> </span> عدد الأندية    </label> 

        </form>
    </div>
  <!-- start container -->  
   <div class="generalcontainer">
       

    
       <?php
               if(isset($_GET['filter'])){ 
                    if($_GET['filter']=="special"){
                         $ss =$cc->getSpecialClub();
                    }else if($_GET['filter']=="public"){
                         $ss =$cc->getPublicClub();
                    }else{
                        $ss =$cc->getAllClub(); 
                    }
                                      }
                 else{
                    $ss =$cc->getAllClub(); 
                     }
                // check if there is array returned by getAllClub method other wise dispaly there is no club exit yet 
                 if (is_array($ss)){
                        
                   foreach($ss as $c){
                      echo  '<div class="container-cities"  >
                                         
                                         <a href = "club_page.php?name='.$c["name"].'&&id='.$c["id"].' ">
                                                <img src="../Logos/'.$c['logo'].'"  alt="club logo">
                                                <div class="imghead">  <span>'.$c["name"].'</span> <br><span class="clubType">'.$c["type"].'</span></div>   </a>
                                                 
                                                    <a style=" text-decoration: none " href="generalSupervisorDashboard.php?cId='.$c['id'].'&&pid='.$c['pId'].'&&sid='.$c['sid'].'&&path='.$c['logo'].' " onClick=\'return confirm("سيتم حذف النادي هل أنت متاكد من ذلك؟")\'>
                                                    <i class="far fa-trash-alt"   style="font-size:27px; color:#e1001f ;position:absolute; bottom:5px;left:5px;   ;border-radius: 5px;"  type="submit" name="deleteClub"  ></i> </a> 
                                                    
                                                     <a style=" text-decoration: none" href="updateClub.php?cId='.$c['id'].' ">
                                                       <i class="far fa-edit"   type="submit" name="updateClub" style="font-size:25px;color: #00e15c ;position:absolute; bottom:5px;right:5px;  ;border-radius: 5px;"></i> </a>     
                                                  
                                       


                             </div>  ';
                       
 
                                  }
                                   }else{
                                          echo "<div>لاتوجد أندية  حاليا</div>";
                                          }
       
       
           if(isset($_GET['cId'])){
           
           // include_once'..\Database\user.php';
            //$user= new User();
            // delete the pre and sup from useres table 
            $cc->deleteUser($_GET['sid']);
            $cc->deleteUser($_GET['pid']);
            // delete the logo of the club from the logo folder
            if(isset($_GET['path'])){
            $logo= "../Logos/".$_GET['path'];
              if (file_exists($logo)) {
                     
                      unlink("../Logos/".$_GET['path']);
                  }
            }
              // delete pre and sup from club memberes table 
           // $cc->deleteMemebr($_GET['sid'])
           // $cc->deleteMemebr($_GET['pid'])
            //$cc->deleteClub($_GET['cId']);
            // bcoz in data base the refernces restricion is cascade we nedd just from the user table and it will the club and clubmemberes by cascading
            if(  $cc->deleteUser($_GET['sid']) && $cc->deleteUser($_GET['pid'])){
               // echo "تم حذف النادي";
                                                                               }
            else{
               // echo "error";
            }
            
           
                             }
       
            ?>   

       
     
    
    </div>    
  <!-- end container -->   
  
</body>
</html>