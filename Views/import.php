<?php
   include'db.php';
if(isset($_POST["Import"])){
		

		echo $filename=$_FILES["file"]["tmp_name"];
		

		 if($_FILES["file"]["size"] > 0)
		 {
 		  	$file = fopen($filename, "r");
             $emapData = fgetcsv($file, 10000, ",");
             print_r($emapData);
              echo  "<br>";
              echo $emapData[0]."<br>";//name
             echo $emapData[1]."<br>";//id
             echo $emapData[2]."<br>";//college
              echo $emapData[3]."<br>";//year
             echo $emapData[4]."<br>";//phone
            // echo $emapData[5]."<br>";//clubname
            

              $pos="عضو";
              $club="النادي الصحي";
             $clubId="141";
	        while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {

                //$ss =$cc->addMember('$emapData[1]','$emapData[0]','$emapData[2]','$emapData[4]','$emapData[3]',  '$club','$pos', '$clubId');
	          //It wiil insert a row to our subject table from our csv file`
                //uid,name,college,phone,year,clubName,postion,clubId
	           $sql = "INSERT into clubsmembers (uid,name,college,phone,year,clubName,postion,clubId) 
	            	values('$emapData[1]','$emapData[0]','$emapData[2]','$emapData[4]','$emapData[3]','$club','$pos','$clubId')";
	         //we are using mysql_query function. it returns a resource on true else False on error
	         $result = $db->query( $sql);
				if(!$result )
				{
					echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload CSV File.\");
							window.location = \"index.php\"
						</script>";
				
				}

	         }
			 
			 
	         fclose($file);
	         //throws a message if data successfully imported to mysql database from excel file
	         echo "<script type=\"text/javascript\">
						alert(\"CSV File has been successfully Imported.\");
						window.location = \"index.php\"
					</script>";
	        
			 

			 //close of connection
			mysql_close($conn); 
				
		 	
			
		 }
	}	 
?>		 