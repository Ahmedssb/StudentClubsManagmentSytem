<?php 
 session_start();
 //$clubName=$_SESSION["name"];
  $id=$_SESSION["uid"];// get the user id 
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
        <title>add memeber</title>
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
         </div>'; // this link go to profile page 
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
   
   <!-- start container -->  
  <div class="fix-float" ></div>
        <div class="container">
             <div class="con">    
                    <div>
                     <h3 id="title"   style="">بيانات العضو</h3>
                    </div>
                    <form action="#"   method="post"> 
                               <fieldset>
                                   <label class="input"><input type="text" name="name" id="name"  required >الاسم </label>
                                   <label class="input"><input type="num" name="id" id="id" required>الرقم الجامعي </label>
                                   <label class="input"><input type="text" name="college"  id ="college" required>الكلية </label>
                                   <label class="input"><input type="tel"  name="phone"  id="phone">رقم الجوال </label>
                                </fieldset>
                        
                                <fieldset>
                                    <label class="input"> الصفة لادارية </label>
                                    <select  class="input" name="postion" id="pos"  required>
									      <option value="عضو">عضو</option>
                                          <option value="أمين سر"> أمين سر </option>
                                          <option value="نائب الرئيس">  نائب الرئيس</option>
                                     </select>
                                    
                                    <label class="input"> السنة الدراسية </label>
                                    <select  class="input" name="year" id="ye"  required>
                                          <option value=" 1">1 </option>
                                          <option value="2">2</option>
                                          <option value=" 3"> 3</option>
                                         <option value=" 4"> 4</option>
                                         <option value=" 5"> 5</option>
                                     </select>
                                </fieldset> 
                                <input type="submit" class="input" name="submit" value="تسجيل"  id="button"> 

                    </form>
                    

         </div> 
<!-- end con -->  
    </div>  
   <!-- end container -->    
   <div class="fix-float" ></div>

  <?php
   include'../Database/clubs.php';

    if (isset($_POST['submit'])) {

        $name=$_POST["name"];
        $id=$_POST["id"];
        $college=$_POST["college"];
        $phone=$_POST["phone"];
        $pos=$_POST["postion"];
        $year=$_POST["year"];
        // echo $clubId;
        // echo $clubName;
        $cc= new Clubs();
        $ss =$cc->addMember($id,$name,$college,$phone,$year,$clubName,$pos,$clubId);  
        if($ss){
             echo "<div class='successMessage'>  تم التسجيل بنجاح </div>" ;
         }else{
              echo "<div class='successMessage  errorMessage'  > خطأ في التسجيل  </div>";
          }

    } 
    
    
    // if member id send with the link when user click update memeber from club_page  or president dashboard 
    if(isset($_GET['mId'])){
        $id= $_GET['mId'];   
        $cc= new Clubs();
        $ss =$cc->getClubMemebr($id);  
        
        echo $ss["year"];
  
        echo'<script>

              document.getElementById("name").value = "'.$ss['name'].'";
              document.getElementById("id").value = "'.$ss['uid'].'";
              document.getElementById("college").value = "'.$ss['college'].'";
              document.getElementById("phone").value = "'.$ss['phone'].'";
              document.getElementById("pos").value = "'.$ss['postion'].'";
              document.getElementById("ye").value = "'.$ss['year'].'";
              document.getElementById("button").value = "حفظ التعديل";
              document.getElementById("button").name = "update";
            </script>';
    } 
    
    // code to update member info 
    if (isset($_POST['update'])){
        $uname=$_POST["name"];
        $uid=$_POST["id"];
        $ucollege=$_POST["college"];
        $uphone=$_POST["phone"];
        $upos=$_POST["postion"];
        $uyear=$_POST["year"];
        if(isset($_GET['mId'])){
        $id= $_GET['mId'];
        }
        
         $cc= new Clubs();
         $ss =$cc->updateMember($uid,$uname,$ucollege,$uphone,$uyear,$upos,$clubName,$id); 
        
      if ($ss){
            echo "updated";
        }else{
            echo "problem in update";
        }
        
    }


?>
             
                
               
       
           
  </body>
    
</html>      
 
            