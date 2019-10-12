<?php 
session_start();
 
  $pos=$_SESSION['postion'] ; // get the pos  
  $id=$_SESSION["uid"];// get the user id 

  

    if( isset($_GET['name'])){
      $clubName=$_GET["name"]; // get the club name send with the link
    }else {
        $clubName="";
    }
    if( isset($_GET['id'])){
    $clubId=$_GET["id"];  // get the club id  send with the link

    }else{
            $clubId="";
    }

  ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>menu</title>
	<link rel="stylesheet" href="../css/club.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">    
  
</head>
<body>
    <!-- start header -->
     <header>
         
        <?php 
        echo'
          <div class="headerDiv">
                <div class="headerLogout"><a href="logout.php"> تسجيل الخروج <i class="fas fa-sign-out-alt" style="font-size:20px;"></i></a></div>
                <div class="headerTitle"><h3> نظام إدارة الأندية الطلابية</h3></div>
                <div class="profile"><a href="profile.php"> عرض الملف الشخصي <i class="far fa-user" style="color:#062052;"></i></a></div> 
          </div> '; // this link go to profile page 
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
    $supNav='<ul>
           <div class="logo"><img src="../images/logo SCM 41-2(png).png"  style="width:100%;height:100%;postion:fixed;"></div>
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
            
		</ul>';
         if(strcmp($pos,"supervisor")==0  or strcmp($pos,"general-supervisor")==0){
             echo $supNav;
         }elseif(strcmp($pos,"president")==0){
             echo $preNav;
         }
        
        ?>
	</nav>
 <!-- End nav -->
     
 <!-- end container -->
    <?php 
       include'../Database/reportsData.php';
          $r= new ReportsData();
     // reade files
        if (isset($_GET['file_id'])) {
            $id = $_GET['file_id'];
           
          $report= $r->getSpecificReports($id);
          $repostPath='../Uploads/'.$report;
        
    
 ?>
            <div class="container">
             <div class=" ">
    <div class="documents">
         
     <p>المستندات المرفقة</p>
     <a  href="<?php echo  $repostPath ?>" download class="reportdocument" >    <?php echo $report ?>  <i class="fas fa-paperclip" style="font-size:35px;"></i> </a> 
        </div>
       <?php
     
        $images=$r->getReportImages($id);
       if(is_array($images)){
           echo'<div class="reportsimages">';
           echo '    <p>الصور المرفقة</p> ';
          foreach($images as $img){
             echo '<div class="hovereffect">';
             echo '<a href="../ReportsImages/'. $img.'" download >  <img src="../ReportsImages/'.$img.'" alt=""  > </a>';
              echo '<div class="overlay">
           
           <a class="info" href="../ReportsImages/'. $img.'" download>تحميل الصورة</a>
         </div>
        </div>';
             
         }        
                echo '</div>';  
        }
            
        else{
            echo "لاتوجد صور مرفقة";
        }
            
        }// end of if isset 
    
                 ?>             
    </div>
    </div>
   </body>
    
    
    
</html>