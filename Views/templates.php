<?php 
session_start();
   $id=$_SESSION['uid'];  // get the user id  
   $pos=$_SESSION['postion'] ; // get the pos  
     
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

		</ul>
	</nav>
 
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
                <th> حذف</th>
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
                           echo '
                           <tr>
                                                    <td> <a href="templates.php?num='.$c['num'].'&&path='.$c['path'].'" onClick=\'return confirm("سيتم حذف النموذج هل أنت متاكد من ذلك؟")\'> حذف</a></td>
                                                     <td>  <a  href="'.$templat.' " download  > <?php echo $report ?>تحميل النموذج</a>
                                                     </td>
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
                           }
              else{
                //  echo "not";
              }
          }
    
    ?>

</body>
    
    
    
</html>