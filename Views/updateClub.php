<?php 
session_start();
 //$clubName=$_SESSION["name"];
ob_start ();
  $id=$_SESSION["uid"];// get the user id 
  $pos=$_SESSION['postion'] ; // get the pos  
 

 
?>
<!doctype html>
<html lang="ar">
<head>
	<meta charset="UTF-8">
	<title>menu</title>
	<link rel="stylesheet" href="../css/club.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">    
  
  <script>
            
           function showLogo(event){
               
            var reader = new FileReader();
             reader.onload = function()
             {
              var output = document.getElementById('logo');
              output.src = reader.result;
             }
             reader.readAsDataURL(event.target.files[0]);

                       } 
        function showDiv() {
          var x = document.getElementById("hiddenDiv1");
          var y = document.getElementById("hiddenDiv2");

        if (x.style.display === "none" ) {
            x.style.display = "block";
          } else {
            x.style.display = "none";
          }
        if (y.style.display === "none" ) {
            y.style.display = "block";
          } else {
            y.style.display = "none";
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
                <div class="headerTitle"><h3> نظام إدارة الأندية الطلابية</h3></div>
                <div class="profile"><a href="profile.php"> عرض الملف الشخصي <i class="far fa-user" style="color:#062052;"></i></a></div> 
          </div> '; // this link go to profile page 
         ?>
     </header>
    <!-- end header -->
    
   <!-- start nav -->
	 <!-- start nav -->
	<nav>
             <nav>
       <div class="logo"><img src="../images/logo SCM 41-2(png).png" style="width:270px;height:80px;postion:fixed;"></div>
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
           

		</ul>
	</nav>
	</nav>
 <!-- End nav -->
   
   <!-- start container -->  
  <div class="fix-float" ></div>
        <div class="container">
              <div class="con">    
                      <div>
                     <h3 id="title"   >بيانات النادي</h3>
                    </div>
  <?php          
                  
              include'../Database/clubs.php';  
              if(isset($_GET['cId'])){
                  
               $club= new Clubs();
                 $c=$club->getClub($_GET['cId']);
               $suprivisor=$club->getClubMemebr($c['sid']);
               $president=$club->getClubMemebr($c['pId']);
               // get president and sup pwd 
               $supid2=$club->getUser($c['sid']);
               $preid2=$club->getUser($c['pId']);
               $sid2= implode(" ",$supid2);
               $pid2=implode(" ",$preid2);
                  
               // <label class="admins1"><input type="date" name="cdate"    value="'.$c['establishdate'].'">سنة التأسيس</label>
                  echo '<form action="updateClub.php?cId='.$_GET['cId'].'&&logo='.$c['logo'].' " method="post" enctype="multipart/form-data"> 
                        <fieldset>
                                   <label class="admins1"><input type="text" name="cname" id="name"  value="'.$c['name'].'" >اسم النادي </label>
                                   <label class="admins1"><input type="text" name="cdate"    value="'.$c['establishdate'].'">سنة التأسيس</label>
                                 <label class="admins1" style="margin-top:0;"> <div class="updateLogo"><img id="logo" name="logo" src="../Logos/'.$c['logo'].'"   style="width:230px; height:200px;" > 
                                 <input type="file" name="image"   onchange="showLogo(event)" > </div></label>';?>
                  
                                  <label class="admins1"><input type="radio" name="type" id="special"  value="عام"  required <?php if ($c['type']=="تخصصي") { echo "checked"; } ?>>تخصصي  
                                    <input type="radio" name="type"  id ="general" value="تخصصي" <?php if ($c['type']=="عام") { echo "checked"; } ?>required>  عام</label> 
                               
                                </fieldset>
                          <?php
                   // <button onclick="showDiv()">إعادة تعيين كلمة مرور للمشرف</button>
                           echo '
                           <fieldset>
                                   <label class="admins1"><input type="text" name="sname"  value="'.$c['supervisor'].'"     >مشرف النادي </label>
                                   <label class="admins1"><input type="num" name="sid"   value="'.$c['sid'].'" >الرقم الجامعي </label>
                                    <label class="admins1"><input type="tel"  name="sphone"   value="'.$suprivisor['phone'].'" >رقم الجوال </label>

                           </fieldset>   
                              <fieldset>
                             
                             <button  >إعادة تعيين كلمة مرور للمشرف</button>

                                                <div id="hiddenDiv1"  ><br>
                                                 <input type="password" name="supass"  >
                                                 </div><br>
                             </fieldset>
                        
                           <fieldset>

                                   <label class="admins1"><input type="tel"  name="pname"    value="'.$c['p'].'" >رئيس النادي  </label>
                                   <label class="admins1"><input type="tel"  name="pid"    value="'.$c['pId'].'" >الرقم الجامعي </label>
                                     <label class="admins1"><input type="text" name="pphone"  value="'.$president['phone'].'" required>رقم الجوال</label>
                                    

                                    <label class="admins1"><input type="tel"  name="college" value=" '.$president['college'].'" required >الكلية</label>
                                    <label class="admins1">  
                                     السنة الدراسية
                                      ';?>
                      
                           <!--                                  <label class="admins1"><input type="num" name="sid1"   value="'.$sid2.'" >رقم الهوية</label>-->

                            <!--<label class="admins1"><input type="num" name="pid1"   value="'.$pid2.'" >رقم الهوية</label>-->
                                   <select  class="input" name="year" id="ye"  required>
                                          <option value=" 1" <?php if($president['year']== "1"){echo "selected";} ?> >1 </option>
                                          <option value="2"  <?php if($president['year']== "2"){echo "selected";} ?> >2</option>
                                          <option value=" 3" <?php if($president['year']== "3"){echo "selected";} ?> > 3</option>
                                         <option value=" 4" <?php if($president['year']== "4"){echo "selected";} ?> > 4</option>
                                         <option value=" 5" <?php if($president['year']== "5"){echo "selected";} ?> > 5</option>
                                         <option value=" 6"  <?php if($president['year']== "6"){echo "selected";} ?> > 6</option>
                                         <option value=" 7" <?php if($president['year']== "7"){echo "selected";} ?> > 7</option>

                                     </select>
                                      </label>
                                    
                            
                                </fieldset>  
                               <fieldset>
                                      <!-- <button onclick="showDiv()">إعادة تعيين كلمة مرور لرئيس النادي</button>-->
                                   <button  >إعادة تعيين كلمة مرور لرئيس النادي</button>
                                               <!-- <div id="hiddenDiv2" style="display:none"><br>-->
                                                <div id="hiddenDiv2"  ><br>
                                                 <input type="password" name="prepass" >
                                                 </div><br>
                              </fieldset>
                           <?php               
                        echo '
                        <fieldset>
                                    <label class="textarea" > الرؤية</label> <br>
                                     <textarea class="textarea" name="vission"   required> "'.$c['vission'].'" </textarea>
                                      <label class="textarea" > الرسالة</label> <br>
                                      <textarea class="textarea"  name="mission" required>"'.$c['mission'].'"</textarea>
                                       <label class="textarea"> أهداف النادي</label> <br>
                                      <textarea class="textarea" name="goals"   required>"'.$c['goals'].'"</textarea>
                                        </fieldset> 
                        
                         <div class="addupdatebtn" >
                                <button type="submit" name="updateClub" > تعديل
                                                                        </button>
                           </div>
                     </form>
                  
                
            
            </div> ';
              }
                  
//<!-- end con -->  
        if(isset($_POST['updateClub'])){
           $clubId=$_GET['cId'];
            $cname=$_POST['cname'];
           $date=$_POST['cdate'];
           $type=$_POST['type'];
            
             $sname=$_POST['sname'];
             $sid=$_POST['sid'];
            
             $sphone=$_POST['sphone'];

             $pname=$_POST['pname'];
             $pid=$_POST['pid'];
             //$pid1=$_POST['pid1'];
             $pphone=$_POST['pphone'];
             $college=$_POST['college'];
             $year=$_POST['year'];
             $vission=$_POST['vission'];
             $mission=$_POST['mission'];
             $goals=$_POST['goals'];
          
            
           // get new passwords if there any
            if(isset($_POST['supass'])){
                if(!empty($_POST['supass'])) {
                 $club->changePass($c['sid'],$_POST['supass']);

                   }
               // echo $_POST['supass'];
                //call fun to update here 
            }
            if(isset($_POST['prepass'])){
                if(!empty($_POST['prepass'])){
                     $club->changePass($c['pId'],$_POST['prepass']);
                }
                //echo $_POST['prepass'];
                //call fun to update here         
            }
            
            // name of the uploaded file
                    $filename = $_FILES['image']['name'];
  
                    // destination of the file on the server
                    $destination = '../Logos/' .$filename;
                    
                    // get the file extension
                    $extension = pathinfo($filename, PATHINFO_EXTENSION);
                 if(is_uploaded_file($_FILES['image']['tmp_name'])){
                      // delete the old logo from the folder 
                     $logoPath= "../Logos/".$c['logo'];
                      if (file_exists($logoPath)) {

                              unlink("../Logos/".$c['logo']);
                          }
                         //echo "uploaded";
                    // if the user didnot choose a new logo no need to update the logo
                
                        // the physical file on a temporary uploads directory on the server
                    $file = $_FILES['image']['tmp_name'];
                    $size = $_FILES['image']['size'];
                     // Get Image Dimension
                    $fileinfo = @getimagesize($_FILES["image"]["tmp_name"]);
                    $width = $fileinfo[0];
                    $height = $fileinfo[1];
                     $supported_image = array('gif','jpg','jpeg','png');
  
                    if (!in_array($extension, $supported_image)) {
                        echo "You file extension must be .gif, .jpg or .jpeg, pr png";
                      }else if ($width > "3000" || $height > "3000")
                       {
                             echo "u exceede dimensions";

                                        }
       
                     else {
                        // move the uploaded (temporary) file to the specified destination
                            if (move_uploaded_file($file, $destination)) {
                              //   echo "logo uploaded ";
                              

                            }else {
                               // echo "Failed to upload file";
                            }
                       }        
                 
            
                       }else{
                    // echo "not uploaded";
                     $filename=$c['logo'];
                     //echo $filename;
                 }
               
                     
               

             
                    
                  //call updates here 
                 /* first update user table for sup && pre  where $c['sid'] && $c['pId'] are the old pass && *$sid && $pid are the new one if the user update them*/
                /* */
                 // $pass1=$club->changePass($c['sid'], $sid1);
                //  $pass2=$club->changePass($c['pId'], $pid1);
                 /// or the solution is to delte the pass first then add it 
                $user1=$club->updateUser($c['sid'],$sid,$sname);
               // echo "pass send is".$user1."<br>";
                $user2=$club->updateUser($c['pId'],$pid,$pname);
                /* print_r($user1);
                 echo " this is <br>";
                 print_r($user2);*/

              
                 //echo "sup id".$c['name'];
            
                 $ssid=$club->getMemberId($c['name'],$c['sid']);
                 $ppid=$club->getMemberId($c['name'],$c['pId']);
                 
                 /* print_r($ssid);
                  echo "<br>";*/
                 
                 // print_r($ppid); 
                 $supid=implode(" ",$ssid);
                 $preid=implode(" ",$ppid);
                 /* then update sup $$  pre in clubmember table */
 
                 $member1=$club->updateMember($sid,$sname,"",$sphone,$year,"مشرف",$cname,$supid);
                 $member2= $club->updateMember($pid,$pname,$college,$pphone,$year,"رئيس نادي",$cname,$preid);
                  /* update the sup and pre to the users table
                   where $c['sid'] && $c['pId'] are the old pass && *$sid1 && $pid1 are the new one if the user update them*/
                // $sup =$club->updateSup($pid,$pname,$c['sid'],$sid1);
                 //$pre =$club->addPre($pid,$pname,$c['pId'],$pid1);
                 // update the club  info 
               /* finally update the club info */
           // echo $sid."<br>";
             //echo $pid."<br>";

                 $newClub=$club->updateClub($cname,$sname,$date,$type,$vission,$mission,$goals,$filename,$pname
                  ,$clubId,$sid,$pid);
                  // header("location: ..\Views\generalSupervisorDashboard.php?"); 
                 //ob_end_flush();
               
             /* update the sup & pre info in clubmembers  table
              first get the club id from the method getPresidentClubId($pid)*/
            
            //  $supid=implode(" ",$ssid);
              
         
            }// end of if set 
            
            

            
            
            ?>
             
                
               
    </div>      
              <!-- end container -->    
    
    
   </body>
    
</html>      
 
            