<?php 
session_start();
   $id=$_SESSION['uid'];  // get the user id  
   $pos=$_SESSION['postion'] ; // get the pos  
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
<html lang="ar">
    <head>
        <meta charset="UTF-8">
        <title>Templates</title>
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
	<?php 
    echo '
    <nav>
     <div class="logo"><img src="../images/logo SCM 41-2(png).png"  style="width:100%;height:100%;postion:fixed;"></div>
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
                <a  href="presidentTemplates.php?name='.$clubName.'&&id='.$clubId.'" >
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
            
		</ul>
	</nav>';?>
 <!-- End nav -->
   
   <!-- start container -->  
      <div class="fix-float" ></div>
      <div class="container">
                  <div class="con">    
  
                  </div> 
             <!-- end con -->  
          
          <!-- start table -->      
            <table id="#datatable">
             <caption> </caption> 
             <tr>
                <th> تحميل  </th>
                <th> نوع النموذج</th>
                <th>اسم النموذج</th>
              </tr>
          
            <?php 
                
           include'../Database/templatesData.php';
              $t= new TemplatesData();
              $templates=$t->getTemplates();
          
                /*code to check if there is no report 
                it can be by checking if there is array returned by the method getClubReports or not */
               if (is_array($templates)){
                    foreach($templates as $c){
                         $templat= $t->getSpecificTemplate($c['num']);
                                     echo '<tr>  
                                                 <td>  <a  href="'.$templat.' " download  > <?php echo $report ?>تحميل النموذج</a></td>
                                                 <td>'.$c["type"].'</td>
                                                 <td>'.$c["name"].'</td>
                                            </tr>';
                          
                                             }  // end of the loop 
          
                                         }// end of if array condition 
                // if there is no array returned by the method getClubReports 
               else{  
                
                    echo "<div>لاتوجد نماذج حاليا   </div>";
                   }
                    
                ?>    
                
            </table>
            <!-- end table -->      
                 
    </div>  
    <!-- end container -->
    <?php 
    
          // check of the id of report is send when user clik delete 
          if(isset($_GET['num']) && isset($_GET['path']))
          {
              $result=$t->deleteTemplate($_GET['num']);
              
              if($result){
                   $path= "../Templates/".$_GET['path'];
                  if (file_exists($path)) {
                     
                      unlink("../Templates/".$_GET['path']);
                  } 
                       }else{
                //  echo "not";
                           }
          }
     
    ?>

</body>
    
</html>