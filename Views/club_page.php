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
   echo  '
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
        
       
        
        ?>
	</nav>
 <!-- End nav -->
   
   <!-- start container -->  
  <div class="fix-float" ></div>
        
   <div class="container">
     <div class=" ">    
      <?php 
       include'../Database/clubs.php';
         $cc= new Clubs();
          $ss =$cc-> getclubAdmins($clubId);  
            $num= $cc->getClubMembersnum($clubName);
         
       // the name should be fetched from method get club name
       // check if the returned value from array $SS is empty replace it with "" to avoid error 
        // if(strcmp(.$clubName.,"")==0){
            // str_replace("","accept",$c["status"]);
         //}
                // print_r($ss); 
         // check if the club has all admins 
         echo '<div class="club-info" > 
           <h3>'.$clubName.' </h3>  ';
          if( count($ss)==2){
               echo  '<div class="club-admins">
                     <span>مشرف النادي</span> 
                     <p>'.$ss[0]["name"].'</p>  
                  </div>    
                   <div class="club-admins">
                     <span>رئيس النادي</span> 
                     <p>'.$ss[1]["name"].'</p>  
                  </div> 
                   <div class="club-admins">
                     <span>نائب الرئيس</span> 
                     <p>""</p>  
                  </div> 
                   <div class="club-admins">
                     <span>أمين السر</span> 
                     <p> ""</p>  
                     </div>       ';
          } else if( count($ss)==3){
               echo  '<div class="club-admins">
                     <span>مشرف النادي</span> 
                     <p>'.$ss[1]["name"].'</p>  
                  </div>    
                   <div class="club-admins">
                     <span>رئيس النادي</span> 
                     <p>'.$ss[0]["name"].'</p>  
                  </div> 
                   <div class="club-admins">
                     <span>نائب الرئيس</span> 
                     <p> '.$ss[2]["name"].'</p>  
                  </div> 
                   <div class="club-admins">
                     <span>أمين السر</span> 
                     <p> ""</p>  
                     </div>       ';
          }else if( count($ss)==4){
               echo  '<div class="club-admins">
                     <span>مشرف النادي</span> 
                     <p>'.$ss[2]["name"].'</p>  
                  </div>    
                   <div class="club-admins">
                     <span>رئيس النادي</span> 
                     <p>'.$ss[1]["name"].'</p>  
                  </div> 
                   <div class="club-admins">
                     <span>نائب الرئيس</span> 
                     <p>'.$ss[3]["name"].'</p>  
                  </div> 
                   <div class="club-admins">
                     <span>أمين السر</span> 
                     <p> '.$ss[0]["name"].'</p>  
                     
                     
                   </div>       ';
          }    
            
                    
    ?>   
                    

    </div> 
    
      <!-- start table -->      
            <table id="#datatable">
               <caption>عدد أعضاء النادي<br>  <span style="text-align:center;color:  #d63c3c ;font-size:22px;text-decoration: underline;"><?php echo $num-1 ;?>   </span>  </caption>
              <tr>
                  
                <th> تعديل/حذف</th>
                <th> الصفة الادارية </th>
                <th> رقم الجوال </th>      
                <th> السنة الدراسية </th>
                <th> الكلية </th>
                <th>الرقم الجامعي </th>
                <th>الاسم</th>

              </tr>
          
            <?php 
                
                 $cc= new Clubs();
                 $s =$cc-> getClubMembers($clubName); 
                 // check if getClubMembers returns an array otherwise display there is no club memberes 
                 if (is_array($s)){

                     foreach($s as $c){

                      echo ' <tr>
                        <td> <a style=" text-decoration: none;"href="club_page.php?memberId='.$c['id'].'&&name='.$clubName.'&&id='.$clubId.'   "  onClick=\'return confirm("سيتم حذف العضو هل أنت متاكد من ذلك؟")\'> <button class="iconbtn" type="submit" name="delete"><i class="far fa-trash-alt"   style="font-size:25px; color:#e1001f "></i></button>  
                         <a style=" text-decoration: none;"href="add.php?mId='.$c['id'].'&&name='.$clubName.' "><button class="iconbtn" type="submit" name="update"><i class="far fa-edit"  style="font-size:20px;color: #00e15c ;"></i></button></a></td>
                        <td>'.$c["postion"].'</td>
                        <td>'.$c["phone"].'</td>
                        <td>'.$c["year"].'</td>
                        <td> '.$c["college"].'</td>
                        <td>'.$c["uid"].'</td>
                        <td>'.$c["name"].'</td>
                          </tr>';  
                   }// end of the loop 
                     
                 }else{
                     echo "<div>لايوجد أعضاء حاليا</div>";
                     } 

                
                if ( isset($_GET['memberId'])){
                    
                    $id = $_GET['memberId'];
                    $cc= new Clubs();
                    $delete =$cc-> deleteMemebr($id);

                    if($delete){
                      //echo "تم الحذف بنجاح ";

                    }else{

                    }


                 }  
                
                ?>    
                
            </table>
             <!-- end table -->   
       
           <div class="buttons"     >
               <?php echo '
                 <form action="print.php?clubnName='.$clubName.' "  method="post" target="_blank">
                 
                 <button type="submit" name="print"  id="print">طباعة</button>   
                 
                 </form> ' ;
               ?>
           </div>    
    </div>      
 <!-- end container -->    
 </body>
    
</html>