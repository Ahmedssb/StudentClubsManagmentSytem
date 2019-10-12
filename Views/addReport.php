<?php 
session_start();

    $id=$_SESSION["uid"];// get the user id 

    //$clubId=$_SESSION["clubId"];  // club reports will be used to fetch club reports
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
        <title>Add Report</title>
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
   
        
        echo'    <ul>
        <div class="logo"><img src="../images/logo SCM 41-2(png).png"  style="width:100%;height:100%;postion:fixed;"></div>
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
  
        
        ?>
	</nav>
 <!-- End nav -->
   
   <!-- start container -->  
  <div class="fix-float" ></div>
        <div class="container">
            <h3 style="  text-align: center;">تقرير جديد</h3>
            <div class="report"> 
               <?php  
                
                echo'
                <form action="addReport.php?name='.$clubName.' &&id='.$clubId.'" method="post"  enctype="multipart/form-data">';?>
                    <label > <input type="text"  name="reportName" class="report-data" required> اسم التقرير</label><br>
                    <label > <input type="date"  name="date"  class="report-data" required>  تاريخ التنفيذ</label><br>
                        <label> 
                        <select class="report-data"  name="type" required>
                         <option>تقريرنشاط</option>
                         <option>مذكرة تنفيذ نشاط</option>
                         </select>
                        نوع التقرير</label><br>
                
                     <label > <input type="file" name="file"  class="report-data" required> استعراض تقرير </label>
                     <br>
                    <label > <input type="file" name="images[]" multiple class="report-data"  >رفع الصور </label><br>
                    <button type= "submit" class="report-data" name="save">ارسال</button> 
                </form>
 
            </div>       
           <!-- end report -->   
                       
       </div>      
    <!-- end container -->  
<?php 
                
          include'../Database/reportsData.php';
           
              $r= new ReportsData();
            
                //code for  Uploads files
                if (isset($_POST['save'])) { // if save button on the form is clicked
                     // get the form data 
                    $reportName=$_POST["reportName"];
                    $executionDate=$_POST["date"];
                    $type=$_POST["type"];
                     // name of the uploaded file
                    $filename = $_FILES['file']['name'];

                    // destination of the file on the server
                    $destination = '../Uploads/' . $filename;
                    
                    // get the current date of the day
                   $publishDate=   date("Y/m/d");
 
                    // get the file extension
                    $extension = pathinfo($filename, PATHINFO_EXTENSION);

                    // the physical file on a temporary uploads directory on the server
                    $file = $_FILES['file']['tmp_name'];
                    $size = $_FILES['file']['size'];
  
                    if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
                        echo "You file extension must be .zip, .pdf or .docx";
                                                                       } 
                    elseif ($_FILES['file']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
                        echo "File too large!";
                                                               } 
                    else{
                        // move the uploaded (temporary) file to the specified destination
                        echo '<div style="position:absolute;right:600px;">'.$clubId.'</div>';
                        if (move_uploaded_file($file, $destination)) {
                             $report=$r->addReportandActivities($reportName,$clubId,$publishDate,$type,$filename,$size,$executionDate);
                              // $id= $r->getLastid();
                                  if($report){
                                       echo $report ."<div style='position:absolute;right:300px;'> تم الرفع بنجاح  </div>";
                                            
                                     
                                             }else{
                                         echo "<div style='position:absolute;right:300px;'> خطا في رفع الملف خطا خطا </div>";
                                 }
          
                                                                     }
                        else {
                            echo "<div  style='position:absolute;right:500px;'>Failed to upload file</div>";
                             }
                         }
                    
                    // images upload code 
                    // File upload configuration
                    $targetDir = "../ReportsImages/";
                    $allowTypes = array('jpg','png','jpeg','gif');

                    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
                    if(!empty(array_filter($_FILES['images']['name']))){
                        foreach($_FILES['images']['name'] as $key=>$val){
                            // File upload path
                            $fileName = basename($_FILES['images']['name'][$key]);
                            $targetFilePath = $targetDir . $fileName;

                            // Check whether file type is valid
                            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                            if(in_array($fileType, $allowTypes)){
                                // Upload file to server
                                if(move_uploaded_file($_FILES["images"]["tmp_name"][$key], $targetFilePath)){
                                    // Image db insert sql
                                    $insertValuesSQL .= "('".$fileName."', NOW(),'".$report."'),";
                                }else{
                                    $errorUpload .= $_FILES['images']['name'][$key].', ';
                                }
                            }else{
                                $errorUploadType .= $_FILES['images']['name'][$key].', ';
                            }
                        }

                        if(!empty($insertValuesSQL)){
                            $insertValuesSQL = trim($insertValuesSQL,',');
                            // Insert image file name into database
                            
                            $query = $r->addReportImages("INSERT INTO reportsimages (fileName,updateOn,rid) VALUES $insertValuesSQL");
                            if($query){
                                $errorUpload = !empty($errorUpload)?'Upload Error: '.$errorUpload:'';
                                $errorUploadType = !empty($errorUploadType)?'File Type Error: '.$errorUploadType:'';
                                $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType;
                                $statusMsg = "Files are uploaded successfully.".$errorMsg;
                               
                            }else{
                                $statusMsg = "Sorry, there was an error uploading your file.";
                            }
                        }
                    }else{
                        //$statusMsg = 'Please select a file to upload.';
                    }

                    // Display status message
                    echo $statusMsg;
                                    }// end of if isset method 
?>

</body>
</html>   