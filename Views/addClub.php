<?php 
session_start();
ob_start ();

 //$clubName=$_SESSION["name"];
  $id=$_SESSION["uid"];// get the user id 
  $pos=$_SESSION['postion'] ; // get the pos  
 

 
?>
<!doctype html>
<html lang="ar">
    <head>
        <meta charset="UTF-8">
        <title>Add Club</title>
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
                       
                    <form action="addClub.php" method="post" enctype="multipart/form-data"> 
                        <fieldset>
                                   <label class="input"><input type="text" name="cname" id="name"  required >اسم النادي </label>
                                   <label class="input"><input type="text" name="cdate"   required>سنة التأسيس</label>
                                   <label class="input"><input type="radio" name="type" id="special"  value="عام"  required>تخصصي  
                                   <input type="radio" name="type"  id ="general" value="تخصصي" required  >عام  </label> 
                                   <label class="input"><input type="file" name="logo"   required>شعار النادي </label>
                                 <!--  <label class="input"style="visibility:hidden" id="collegelabel"><input  type="text" name="college"  required >الكلية</label>-->
                       </fieldset>
                        
                        <fieldset>
                                   <label class="admins1"><input type="text" name="sname"    required >مشرف النادي </label>
                                   <label class="admins1"><input type="num" name="sid"   required>الرقم الجامعي </label>
                                   <label class="admins1"><input type="text" name="sid1"  required>رقم الهوية</label>
                                   <label class="admins1"><input type="tel"  name="sphone"   required>رقم الجوال </label>
                           
                        </fieldset>   
                            
                        <fieldset>

                                   <label class="admins1"><input type="tel"  name="pname"   required>رئيس النادي  </label>
                                   <label class="admins1"><input type="tel"  name="pid"   required>الرقم الجامعي </label>
                                   <label class="admins1"><input type="tel"  name="pid1"  required >رقم الهوية</label>
                                   <label class="admins1"><input type="text" name="pphone"  required>رقم الجوال</label>
                                   <label class="admins1"><input type="tel"  name="college" required >الكلية</label>
                                   <label class="admins1"   >  
                                        السنة الدراسية
                                        <select  class="input" name="year" id="ye"  required>
                                          <option value=" 1">1 </option>
                                          <option value="2">2</option>
                                          <option value=" 3"  selected> 3</option>
                                         <option value=" 4"> 4</option>
                                         <option value=" 5"> 5</option>
                                         <option value=" 6"> 6</option>
                                         <option value=" 7"> 7</option>

                                        </select>
                                   </label>
                                    
                            
                        </fieldset>     
                        
                        <fieldset>
                                  <label class="textarea"> الرؤية</label> <br>
                                  <textarea class="textarea" rows="4" cols="70" name="vission" required></textarea>
                                  <label class="textarea" > الرسالة</label> <br>
                                  <textarea class="textarea" rows="4" cols="70" name="mission" required></textarea>
                                  <label class="textarea"> أهداف النادي</label> <br>
                                  <textarea class="textarea" rows="4" cols="70" name="goals" required></textarea>
                       </fieldset> 
                        
                        
                     <div class="addupdatebtn" >
                       <button type="submit" name="addClub" > إضافة</button>
                     </div>

                 </form>
                  
        </div> 
             
    <!-- end con -->  
<?php 
      include'../Database/clubs.php';
         if(isset($_POST['addClub'])){
                     // get the form data 
                     $cname=$_POST['cname'];
                     $date=$_POST['cdate'];
                     $type=$_POST['type'];

                     $sname=$_POST['sname'];
                     $sid=$_POST['sid'];
                     $sid1=$_POST['sid1'];
                     $sphone=$_POST['sphone'];

                     $pname=$_POST['pname'];
                     $pid=$_POST['pid'];
                     $pid1=$_POST['pid1'];
                     $pphone=$_POST['pphone'];
                     $college=$_POST['college'];
                     $year=$_POST['year'];
                     $vission=$_POST['vission'];
                     $mission=$_POST['mission'];
                     $goals=$_POST['goals'];
           
           
           
                   // name of the uploaded file
                    $filename = $_FILES['logo']['name'];

                    // destination of the file on the server
                    $destination = '../Logos/' .$filename;
                    
                    // get the file extension
                    $extension = pathinfo($filename, PATHINFO_EXTENSION);

                    // the physical file on a temporary uploads directory on the server
                    $file = $_FILES['logo']['tmp_name'];
                    $size = $_FILES['logo']['size'];
                     // Get Image Dimension
                    $fileinfo = @getimagesize($_FILES["logo"]["tmp_name"]);
                    $width = $fileinfo[0];
                    $height = $fileinfo[1];
                     $supported_image = array('gif','jpg','jpeg','png');
  
                    if (!in_array($extension, $supported_image)) {
                        echo "You file extension must be .gif, .jpg or .jpeg, pr png";
                                                                 }
                     else if ($width > "4000" || $height > "4000")
                       {
                             echo "u exceede dimensions";

                       }
                     else if (! file_exists($_FILES["logo"]["tmp_name"])){
                                         echo "الرجاء اختيار صورة";
                                                                          }
                     else {
                        // move the uploaded (temporary) file to the specified destination
                            if (move_uploaded_file($file, $destination)) {
                                  // echo "logo uploaded ";
                                                            //call funs here 
                                         $club= new Clubs();
                                         // add the sup and pre to the users table 
                                         $sup =$club->addSup($sid,$sname,$sid1);
                                         $pre =$club->addPre($pid,$pname,$pid1);

                                         // add the club into club table 
                                        $newClub=$club->addClub($cname,$sname,$pname,$type,$date,$vission,$mission,$goals,$filename,$sid,$pid);

                                         /* add the sup & pre to the clubmembers  
                                          first get the club id from the method getPresidentClubId($pid)*/
                                           $id=$club->getPresidentClubId($pid);
                                           $clubId= implode(" ",$id);
                                           echo $clubId;
                                           $member1=$club->addMember($sid,$sname,"",$sphone,0,$cname,"مشرف",$clubId);
                                           $member2= $club->addMember($pid,$pname,$college,$pphone,$year,$cname,"رئيس نادي",$clubId);

                                           if($sup && $pre && $newClub && $id    && $member1 && $member2 ){
                                              echo "تمت إضافة النادي بنجاح ";
                                             header("location: ..\Views\generalSupervisorDashboard.php?"); 
                                              ob_end_flush();
                                              }/*else if($sup == false  ){
                                               echo "sup not added to users";
                                              }else if(!$pre){
                                               echo "pre not added to useres";
                                              
                                              }else if(!$newClub){
                                               echo "problem in adding new club";
                                              }else if(!$id){
                                               echo "error with id";
                                              } else if(!$member1){
                                                echo "sup not added to memberes";
                                              }else{
                                            echo "pre not added to memberes";
                                              }*/
                                                                                  } 
                         else {
                                echo "Failed to upload file";
                              }
                         
                        }         
              
           
                                                   }// end of if set 
            
            

            
            
    ?>
                      
  </div>      
 <!-- end container -->    

    
    
  </body>
    
</html>      
 
            