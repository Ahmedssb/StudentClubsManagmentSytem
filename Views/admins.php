<?php 
session_start();
   $id=$_SESSION['uid'];  // get the user id  
  // $pos=$_SESSION['postion'] ; // get the pos  
     
?>

<!doctype html>
<html lang="en">
  <head>
	<meta charset="UTF-8">
	<title>Admins</title>
	<link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/club.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">   
    <style>
    body {background-color:  #f0f3f4;}
    </style>
 
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
    <?php
     // default value for every check box is unchecked 
      $statA=$statB=$statC=$statD=$statE=$statF="unchecked";
      $pos1=$pos2=$pos3=$pos4=$type1=$type2="Nothing";
     
      if(isset($_POST['submit'])) {
         
          if(isset($_POST['filter']))
          {
              
          $values = $_POST['filter'];
          }
           else{
               $values="";
               }
        
    //Checking whether a particular check box is selected
        //See the IsChecked() function below
          if(is_array($values)){ 
             
                    if(in_array("A", $values))
                    {    $type2="تخصصي";
                         $statA="checked";
                    }
                    if(in_array("B", $values))
                    {   
                        $pos1="مشرف";
                         $statB="checked";
                    } 
                  if(in_array("C", $values))
                    {   
                       $pos2="رئيس نادي";
                         $statC="checked";
                    }
                  if(in_array("D", $values))
                    {   
                       $pos3="نائب الرئيس";
                         $statD="checked";
                    }
                  if(in_array("E", $values))
                    {
                      $pos4="أمين سر";
                         $statE="checked";
                    }
                    if(in_array("F", $values))
                    {  //echo "f is checked";
                        $type1="عام";
                         $statF="checked";
                    } // end of isarray 
                            }
          else{
           $pos1="مشرف";
            $pos2="رئيس نادي";
            $pos3="نائب الرئيس";
            $pos4="أمين سر";
             $type1="عام";
              $type2="تخصصي";
             }
                            }// end of isset
    
    else{
        $pos1="مشرف";
        $pos2="رئيس نادي";
        $pos3="نائب الرئيس";
        $pos4="أمين سر";
        $type2="تخصصي";
        $type1="عام";
       }
 ?>
    
     
     <div  class="filter">
        
        <form action="#"  method="post">
           <label>أندية عامة<input type="checkbox"  id="A" class="special" name="filter[]"   value="A" <?php echo $statA; ?>    > </label> 
           <label>أندية تخصصية<input type="checkbox"  id="B"   class="public" name="filter[]"   value="B"   <?php echo $statB; ?>   >  </label>  
           <label>مشرفي الأندية<input type="checkbox"    id="C"   class="public" name="filter[]" value="C" <?php echo $statC; ?>   > </label> 
           <label> رؤساء الأندية<input type="checkbox"   id="D"   class="public" name="filter[]"  value="D"  <?php echo $statD; ?>  > </label> 
           <label>نواب الأندية<input type="checkbox"    id="E"   class="public" name="filter[]"  value="E" <?php echo $statE; ?>    > </label> 
           <label>أمناء السر<input type="checkbox"  id="F"   class="public"  name="filter[]" value="F" <?php echo $statF; ?>    > </label> <br>
           <button type="submit"   name="submit"  value="فلترة"> فلترة</button>
        </form>
        
    </div>
   <!-- start container -->  
   <div class="generalcontainer">
           <!-- start table -->      
            <table id="#datatable">
              <caption>مسؤولي الأندية</caption>
              <tr>
                 <th> الصفة الادارية </th>
                 <th> رقم الجوال </th> 
                 <th> صفة النادي </th>
                 <th> النادي </th>
                 <th>الرقم الجامعي </th>
                 <th>الاسم</th>
             </tr>
       
    <?php 
       include_once'../Database/clubs.php';

          $cc= new Clubs();
            
        
           if( ($type1=="عام" || $type2=="تخصصي" )&& ($pos1== "Nothing" && $pos2== "Nothing" && $pos3== "Nothing" && $pos4== "Nothing")) {
            $pos1="مشرف";
            $pos2="رئيس نادي";
            $pos3="نائب الرئيس";
            $pos4="أمين سر";
            
      /* echo $pos1;
        echo $pos2;
        echo $pos3;
        echo $pos4;
        echo $type1;
        echo $type2;*/
            }  
        
        if($type1=="Nothing" && $type2=="Nothing"){
            $type2="تخصصي";
            $type1="عام";
        }        
                
         $ss =$cc->getAdmins($pos1,$pos2,$pos3,$pos4,$type1,$type2);        
        //  check if there is array returned from get alladmins method
             if (is_array($ss)){
                 foreach($ss as $c){

                  echo ' 
                  <tr>
                        <td>'.$c["postion"].'</td>
                        <td>'.$c["phone"].'</td>
                        <td> '.$c["type"].'</td>
                         <td> '.$c["clubName"].'</td>
                        <td>'.$c["uid"].'</td>
                        <td>'.$c["name"].'</td>
                  </tr>';  

               } 
                            }
           else{
                 echo "<div>لايوجد أعضاء حاليا</div>";
                } 
          
?>   
          
        
            </table>
             <!-- end table -->      
         
            <div class="buttons" >
               <?php echo '
                 <form action="adminsPrint.php?pos1='.$pos1.' &&pos2='.$pos2.' &&pos3='.$pos3.' &&pos4='.$pos4.'  && type1='.$type1.'  &type2='.$type2.' " method="post" target="_blank">
                     <button type="submit" name="print"  id="print">طباعة</button>   
                 </form> ' ; ?>
             </div>  
    
    
   </div>    
   <!-- end container -->    

</body>
</html>