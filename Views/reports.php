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
<html lang="ar">
    <head>
        <meta charset="UTF-8">
        <title>Reports</title>
        
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
        
     // $supNav && $preNav are varible containing the nav for differnt user postion      
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
         if(strcmp($pos,"supervisor")==0  or strcmp($pos,"general-supervisor")==0){
             echo $supNav;
         }elseif(strcmp($pos,"president")==0){
             echo $preNav;
         }
        
        ?>
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
                 
                <th>معاينة </th>      
                <th> الحالة</th>
                <th> تاريخ الاصدار </th>
                <th>اسم التقرير</th>
                <th>رقم التقرير</th>

              </tr>
          
            <?php 
                
           include'../Database/reportsData.php';
             $r= new ReportsData();
              $report=$r->getClubReports($clubId);
          
                /*code to check if there is no report 
                it can be by checking if there is array returned by the method getClubReports or not */
            if (is_array($report)){
                
                 foreach($report as $c){
                     
                           /*check the status of report if it is (تم القبول)repalcee it with accept and save it in variable accept as well as 
						   if it is (تم الرفض)relace it with reject and save it with variable reject 
						   function replace needed here bcoz strcmp does not work with arabic char*/
                          $accept = str_replace("تم القبول","accept",$c["status"]);
                          

                          if(strcmp($accept, "accept")!=0 ){
                             $reject = str_replace("تم الرفض","reject",$c["status"]);
                          }

                          /*after replacement check if status is accept or reject just display the status 
						  otherwise dispaly two buttons (button "قبول "  & button "رفض")to let the user take his acction by clicking one of the buttons */
                           if(strcmp($accept, "accept")==0  ){
                                          $td=' <td style="color:#00e15c;font-weight:600;">'.$c["status"].'</td>';
                               $sgtd= ' <td style="color:#00e15c;font-weight:600;">'.$c["status"].'</td>';
                          }elseif (strcmp($reject,"reject")==0){
                                $td=' <td style="color: #e1001f;font-weight:600;">'.$c["status"].'</td>';
                                  $sgtd= ' <td style="color:#e1001f;font-weight:600;">'.$c["status"].'</td>';

                           }else{

                                 $sgtd= ' <td style="color:#062052;font-weight:600;">'.$c["status"].'</td>';
                                $td='<td><a style=" text-decoration: none;"href="reports.php?reportDeleteId='.$c['num'].' && name='.$clubName.'&&id='.$clubId.' "> <button class="iconbtn" type="submit" name="reject"><i class="fas fa-times" style="font-size:20px;color: #e1001f;"  ></i></button></a> 
                              <a style=" text-decoration: none;" href="reports.php?reportAcceptId='.$c['num'].' && name='.$clubName.'&&id='.$clubId.' "><button class="iconbtn" type="submit" name="accept"><i class="fas fa-check" style="font-size:20px;color:#00e15c;"></i></button></a></td>';
                           }
                     
                     
                          /* the table should be dynamic depend on the user postion 
                           check the postion of the user */ 
                         if(strcmp($pos,"supervisor")==0){
                                      $tr ='<tr>
                                                    <td> <a href="reportsDetails.php?file_id='.$c['num'].'"> المرفقات</a></td>
                                                     '.$td.'
                                                    <td> '.$c["publishDate"].'</td>
                                                    <td>'.$c["reportName"].'</td>
                                                    <td>'.$c["num"].'</td>
                                            </tr>';  
                                                        } else{
                                                               $tr='<tr>
                                                                            <td> <a  href="reportsDetails.php?file_id='.$c['num'].'"> المرفقات</a></td>
                                                                              '.$sgtd.'
                                                                            <td> '.$c["publishDate"].'</td>
                                                                            <td>'.$c["reportName"].'</td>
                                                                            <td>'.$c["num"].'</td>
                                                                    </tr>';
                                                               }


                            echo $tr;
                                           } // end of the loop 

                         } // end of if array condition 
                
                // if there is no array returned by the method getClubReports 
                else{
                
                    echo "<div>لايوجد أعضاء حاليا</div>";
                 }
                
                
                
                ?>    
                
            </table>
             <!-- end table -->      
                 
    </div>  
 <!-- end container -->
    <?php 
    
          // check of the id of report is send when user clik delete 
          if(isset($_GET['reportDeleteId']))
          {
               $Status ="تم الرفض";
              $result=$r->updateReportStatus($_GET['reportDeleteId'],$Status);
              
              if($result){
                 // echo "updated";
              }else{
                //  echo "not";
              }
          }
    
         // check of the id of report is send when user clik accept 
        if(isset($_GET['reportAcceptId']))
          {
               $Status ="تم القبول";
            
              $result=$r->updateReportStatus($_GET['reportAcceptId'],$Status);
              
              if($result){
                  //echo "updated";
              }else{
                 // echo "not";
              }

          }
      
    
    
    ?>

   </body>
    
    
    
</html>