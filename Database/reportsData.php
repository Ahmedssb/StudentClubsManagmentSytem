<?php 
include 'Connection.php';
class ReportsData {
    
  
    
    
    public function getClubReports($clubId){
        $conn = new Connection();  
        $db = $conn->connect();
        $sql="SELECT num,reportName,publishDate,status FROM  reports WHERE clubId='".$clubId."'";
        $result= $db->query($sql);
        $numRows=$result->num_rows;
        $empty = "empty";
        if($numRows > 0 ){
            
            while($row= $result->fetch_assoc()){
                $data[]=$row;
            }
           return $data;    
        }else{
            return $empty;   // if there is no reports found then the function will return empty ;
        }

    }
    
    /*this function take id of specific report and retrive it's path preview it */
       public function getSpecificReports($id){
        $conn = new Connection();  
        $db = $conn->connect();
        // fetch file to download from database
          $sql = "SELECT * FROM reports WHERE num=$id";
          $result= $db->query($sql);

        $file = mysqli_fetch_assoc($result);
        $filepath = $file['fileName'];
           
        return $filepath;
    }
     
        public function addReportandActivities($reportName,$clubId,$publishDate,$type,$fileName,$size,$executionDate){
                $conn = new Connection();  
                $db = $conn->connect();
                //insert into     
                $sql="INSERT INTO reports (reportName,clubId,publishDate,type,fileName,size,executionDate) VALUES ('$reportName','$clubId','$publishDate','$type','$fileName','$size','$executionDate')";
                 /*$db->query($sql);
                 $lastid =$db->insert_id; 
                   return $lastid;*/
                if($db->query($sql)){
                    return $db->insert_id;  // return the report id to use it when upload report images
                }else{
                    return false;
                }
         }
    
    
     function updateReportStatus($id,$status){
        $conn = new Connection();  
        $db = $conn->connect();
         
         $sql="UPDATE reports SET status='".$status."'  WHERE num='".$id."' ";
         
          $result= $db->query($sql);

            if($result){
                return true;
            }else{
                return false;
            }
    }
    
    
   function addReportImages($query){
       $conn = new Connection();  
       $db = $conn->connect();
                if($db->query($query)){
                    return true;  
                }else{
                    return false;
                }
   }
    
    function getReportImages($rid){
        $conn = new Connection();  
        $db = $conn->connect();
        $sql="SELECT fileName FROM reportsimages WHERE rid='".$rid."'";
        $result= $db->query($sql);
        $numRows=$result->num_rows;
        $empty = "empty";
        if($numRows > 0 ){

                while($row= $result->fetch_assoc()){
                     $imageURL[] = $row['fileName'];
                }
               return $imageURL;    
        }else{
                 return $empty;   // if there is no images belong to the report then the function will return empty ;
        }

    }
    
    
    
}
 
    
 
?>