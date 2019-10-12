<?php 
session_start();
   $id=$_SESSION['uid'];  // get the user id  
   $pos=$_SESSION['postion'] ; // get the pos  
     
?>
<!doctype html>
<html lang="ar">
 <head>
	<meta charset="UTF-8">
	<title>Add Tempalte</title>
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
            <h3 style="  text-align: center;">إضافة نموذج جديد</h3>
            <div class="report"> 
               <?php  echo'
                  <form action="addTemplate.php?" method="post"  enctype="multipart/form-data">';?>
                
                        <label > <input type="text"  name="reportName" class="report-data" required> اسم النموذج</label><br>
                            <label> 
                            <select class="report-data"  name="type" required>
                             <option>تقريرنشاط</option>
                             <option>مذكرة تنفيذ نشاط</option>
                             <option>أخرى</option>
                             </select>
                         نوع النموذج</label><br>

                            <label > <input type="file" name="file"  class="report-data" required> استعراض النموذج </label>
                            <br>

                           <button type= "submit" class="report-data" name="save">إضافة</button> 
                   </form>
 
            </div> 
               
           <!-- end report -->   
                       
  </div>      
              <!-- end container -->  
<?php 
                
          include'../Database/templatesData.php';
           
               $template= new TemplatesData();
            
       
                // Uploads files
                if (isset($_POST['save'])) { // if save button on the form is clicked
                     // get the form data 
                    $name=$_POST["reportName"];
                    $type=$_POST["type"];
                     // name of the uploaded file
                    $filename = $_FILES['file']['name'];

                    // destination of the file on the server
                    $destination = '../Templates/' . $filename;
                    
 
                    // get the file extension
                    $extension = pathinfo($filename, PATHINFO_EXTENSION);

                    // the physical file on a temporary uploads directory on the server
                    $file = $_FILES['file']['tmp_name'];
                    $size = $_FILES['file']['size'];
  
                    if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
                        echo "You file extension must be .zip, .pdf or .docx";
                    }elseif ($_FILES['file']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
                        echo "File too large!";
                    }
                    else {
                            // move the uploaded (temporary) file to the specified destination
                            
                            if (move_uploaded_file($file, $destination)) {
                                     $t=$template->addTemplate($name,$type,$filename);
                                      // $id= $r->getLastid();
                                          if($t){
                                               echo "<div style='position:absolute;right:300px;'> تم الرفع بنجاح  </div>";


                                                  } else{
                                                 echo "<div style='position:absolute;right:300px;'> خطا في رفع الملف خطا خطا </div>";
                                         }

                            } else {
                                echo "<div  style='position:absolute;right:500px;'>Failed to upload file</div>";
                            }
                    }
                    
                  
                                }// end of if isset method 
?>

</body>
</html>