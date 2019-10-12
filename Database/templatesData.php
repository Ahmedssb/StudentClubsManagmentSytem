<?php 
include 'Connection.php';
class TemplatesData {
    
    function addTemplate($name,$type,$path){
          $conn = new Connection();  
                $db = $conn->connect();
                //insert into     
                $sql="INSERT INTO templates(name,type,path) VALUES ('$name','$type','$path')";
                 /*$db->query($sql);
                 $lastid =$db->insert_id; 
                   return $lastid;*/
                if($db->query($sql)){
                    return true;  // return the report id to use it when upload report images
                }else{
                    return false;
                }
    }
    
    
    

     public function getTemplates(){
        $conn = new Connection();  
        $db = $conn->connect();
        $sql="SELECT * FROM templates ";
        $result= $db->query($sql);
        $numRows=$result->num_rows;
        $empty = "empty";
        if($numRows > 0 ){
            
            while($row= $result->fetch_assoc()){
                $data[]=$row;
            }
           return $data;    
        }

    }
    
    
      /*this function take id of specific report and retrive it's path preview it */
       public function getSpecificTemplate($id){
        $conn = new Connection();  
        $db = $conn->connect();
        // fetch file to download from database
          $sql = "SELECT * FROM templates WHERE num=$id";
          $result= $db->query($sql);

        $file = mysqli_fetch_assoc($result);
        $filepath = '../Templates/'.$file['path'];
           
        return $filepath;
    }
    
    
    function deleteTemplate($num){
             $conn = new Connection();  
             $db = $conn->connect();
             $sql="DELETE FROM templates WHERE num='".$num."' ";

            if($db->query($sql)){
                    return true;
                }else{
                    return false;
                }
        }
 
}

?>