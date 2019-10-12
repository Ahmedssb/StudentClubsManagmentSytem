<?php 
session_start();
 
$id=$_SESSION["uid"];// get the user id 
  
 
 ?>
<!doctype html>
<html lang="ar">
    <head>
        <meta charset="UTF-8">
        <title>president dashboard</title>
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">
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
          </div>   ';   // this link go to profile page 
         ?>
     </header>
    <!-- end header -->
      <?php 
       include'../Database/clubs.php';
          $cc= new Clubs();
          $s =$cc->getPresidentClubName($id);
           
          $cId =$cc->getPresidentClubId($id); 
         // convert the array returned by getPresidentClubName && getPresidentClubId method into string 
          $clubName= implode("",$s);
          $clubId= implode("",$cId);
          $num= $cc->getClubMembersnum($clubName);
    
   
   /*<!-- start nav -->*/
	 echo '<nav>
      <div class="logo"><img src="../images/logo SCM 41-2(png).png" style="width:270px;height:80px;postion:fixed;"></div>
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
            
		</ul>
	</nav>';?>
 <!-- End nav -->
   
   <!-- start container -->  
  <div class="fix-float" ></div>
   <div class="container">
      <div class=" ">    
      <?php 
       // get all club adins info 
       $ss =$cc->getclubAdmins($clubId);     
        
        echo '<div class="club-info" > 
           <h3>'.$clubName.' </h3>  ';
       
        
           
         echo  '   <div class="club-admins">
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
                     <p>'.$ss[0]["name"].'</p>  
                   </div>       ';
    
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
                $ss =$cc-> getClubMembers($clubName); 
                 $n =$cc->getPresidentClubName($id);
                 // conver the array returned by getPresidentClubName into string 
                 $clubName= implode(" ",$n);
                // dispaly club memberes info 
                foreach($ss as $c){

                  echo ' 
                  <tr>
                        <td> 
                            <a style=" text-decoration: none;" href="presidentDashboard.php?memberId='.$c['id'].' "> <button class="iconbtn"type="submit" name="delete"><i class="far fa-trash-alt"   style="font-size:25px; color:#e1001f "></i></button>  
                            <a style=" text-decoration:none; " href="add.php?mId='.$c['id'].'&&name='.$clubName.' "><button class="iconbtn"type="submit" name="update"    ><i class="far fa-edit"   style="font-size:20px;color: #00e15c ;"></i></button></a>
                        </td>
                        <td>'.$c["postion"].'</td>
                        <td>'.$c["phone"].'</td>
                        <td>'.$c["year"].'</td>
                        <td> '.$c["college"].'</td>
                        <td>'.$c["uid"].'</td>
                        <td>'.$c["name"].'</td>
                 </tr>';  

               } 



                if ( isset($_GET['memberId'])){
                    $id = $_GET['memberId'];
                    $cc= new Clubs();
                    $delete =$cc-> deleteMemebr($id);

                    if($delete){
                     // echo "تم الحذف بنجاح ";

                              }else{
                      //echo "failed to delete member ";
                                   }


                 }                
         ?>
                
            </table>
             <!-- end table -->  
       
             <div class="buttons"  >
                 <?php echo '<form action="print.php?clubnName='.$clubName.' " method="post" target="_blank">
                 <button type="submit" name="print" >طباعة</button>   
                  </form>';?>
              </div>    
    </div>      
  <!-- end container -->    

</body>
</html>      
            