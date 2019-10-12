 <?php 
include 'Connection.php';
class Clubs {
    
  
    // variable connection and db sholud be global so we can use them in any function
    
            public function getAllClub(){
                $conn = new Connection();  
                $db = $conn->connect();
                $sql="SELECT * FROM  clubs ";
                $result= $db->query($sql);
                $numRows=$result->num_rows;

                if($numRows > 0 ){

                    while($row= $result->fetch_assoc()){
                        $data[]=$row;
                    }
                   return $data;    
                }

            }

    
           public function getPublicClub(){
                $conn = new Connection();  
                $db = $conn->connect();
                $sql="SELECT * FROM  clubs  WHERE type='عام' ";
                $result= $db->query($sql);
                $numRows=$result->num_rows;

                if($numRows > 0 ){

                    while($row= $result->fetch_assoc()){
                        $data[]=$row;
                    }
                   return $data;    
                }

            }
           public function getSpecialClub(){
                    $conn = new Connection();  
                    $db = $conn->connect();
                    $sql="SELECT * FROM  clubs  WHERE type='تخصصي' ";
                    $result= $db->query($sql);
                    $numRows=$result->num_rows;

                    if($numRows > 0 ){

                        while($row= $result->fetch_assoc()){
                            $data[]=$row;
                        }
                       return $data;    
                    }

                }
        // this fun add new club from the add club forum
                function addClub($name,$sup,$pre,$type,$date,$vission,$mission,$goals,$logo,$sid,$pid){
                           $conn = new Connection();  
                            $db = $conn->connect();
                             $sql=" INSERT INTO clubs (name,supervisor,establishdate,type,vission,mission,goals,logo,sid,pid,p ) VALUES ('$name','$sup','$date','$type','$vission','$mission','$goals','$logo','$sid','$pid','$pre')";


                           if($db->query($sql)){
                                    return true;
                                }else{
                                    return false;
                             }
                }

              function deleteClub($cid){
                  $conn = new Connection();  
                  $db = $conn->connect();
                    $sql="DELETE FROM clubs WHERE id='".$cid."' ";

                    if($db->query($sql)){
                            return true;
                        }else{
                            return false;
                        }
              }
             function getClub($cid){
                $conn = new Connection();  
                $db = $conn->connect();
                $sql="SELECT* FROM clubs  WHERE   id='".$cid."' "; 
                $result= $db->query($sql);
                $numRows=$result->num_rows;

                if($numRows > 0 ){

                    while($row= $result->fetch_assoc()){
                        $data[]=$row;
                    }
                    $member=$this->array_flatten($data);
                    return $member;
                }
             }
 
         function getSupClusb($sid){
                $conn = new Connection();  
                $db = $conn->connect();
                $sql="SELECT name,id,logo FROM  clubs  WHERE   sid= '".$sid."'"; 
                $result= $db->query($sql);
                $numRows=$result->num_rows;

                if($numRows > 0 ){

                    while($row= $result->fetch_assoc()){
                        $data[]=$row;
                    }
                   return $data;    
                }
         } 



         function getPresidentClubName($pid){
              $conn = new Connection();  
                $db = $conn->connect();
                $sql="SELECT name FROM  clubs  WHERE   pId= '".$pid."'"; 
                $result= $db->query($sql);
                $numRows=$result->num_rows;

                if($numRows > 0 ){

                    while($row= $result->fetch_assoc()){
                        $data[]=$row;
                    }


                    $clubNmae=$this->array_flatten($data);
                   return $clubNmae;    
                }
         }

         function getPresidentClubId($pid){
                $conn = new Connection();  
                $db = $conn->connect();
                $sql="SELECT id FROM  clubs  WHERE   pId= '".$pid."'"; 
                $result= $db->query($sql);
                $numRows=$result->num_rows;

                if($numRows > 0 ){

                    while($row= $result->fetch_assoc()){
                        $data[]=$row;
                    }


                    $clubId=$this->array_flatten($data);
                   return $clubId;    
                }
         }

        function getclubAdmins($clubId){

                $conn = new Connection();   
                $db = $conn->connect();
                $sql="SELECT name,postion  FROM clubsmembers WHERE  ( postion ='مشرف' or  postion ='رئيس نادي'  or  postion ='نائب الرئيس' or  postion ='أمين سر') AND clubId='".$clubId."' ORDER BY postion"; 
                $result= $db->query($sql);
                $numRows=$result->num_rows;

                if($numRows > 0 ){

                    while($row= $result->fetch_assoc()){
                        $data[]=$row;
                    }
                     return $data;
  
                } 
        } 
    
      function getAllAdmins(){
               $conn = new Connection();   
                $db = $conn->connect();
                $sql="SELECT * FROM clubsmembers WHERE postion ='مشرف' or  postion ='رئيس نادي'  or  postion ='نائب رئيس' or  postion = 'أمين سر'  ORDER BY clubId"; 
          
               
                $result= $db->query($sql);
                $numRows=$result->num_rows;

                if($numRows > 0 ){

                    while($row= $result->fetch_assoc()){
                    $data[]=$row;
                    }
                   return $data;    
                } 
      }
     function getAdmins($pos1,$pos2,$pos3,$pos4,$type1,$type2){
                $conn = new Connection();   
                $db = $conn->connect();
                   
                     $sql="SELECT clubsmembers.name,clubsmembers.uid,clubsmembers.phone,clubsmembers.clubName,clubsmembers.postion ,clubs.type  FROM clubsmembers INNER JOIN clubs ON clubs.id=clubsmembers.clubId WHERE (clubsmembers.postion ='".$pos1."' or clubsmembers.postion ='".$pos2."' or clubsmembers.postion ='".$pos3."' or clubsmembers.postion ='".$pos4."') AND (clubs.type='".$type1."' OR clubs.type='".$type2."') ";
                $result= $db->query($sql);
                $numRows=$result->num_rows;

                if($numRows > 0 ){

                    while($row= $result->fetch_assoc()){
                        $data[]=$row;
                    }
                   return $data;    
                } 
      }
      
        function getClubMembers($name){

                $conn = new Connection();  
                $db = $conn->connect();
                $sql="SELECT id,name,college,phone,year,postion,uid FROM clubsmembers  WHERE   clubName= '".$name."'"; 
                $result= $db->query($sql);
            $numRows=$result->num_rows;
                 if($numRows > 0 ){

                    while($row= $result->fetch_assoc()){
                        $data[]=$row;
                    }
                   return $data;    
                }  

        } 
      function getClubMembersnum($name){

                $conn = new Connection();  
                $db = $conn->connect();
                $sql="SELECT id,name,college,phone,year,postion,uid FROM clubsmembers  WHERE   clubName= '".$name."'"; 
                $result= $db->query($sql);
            $numRows=$result->num_rows;
                 if($numRows > 0 ){

                    return $numRows;
                    }
                 } 
    
          function getNumOfClubs($type){

                $conn = new Connection();  
                $db = $conn->connect();
               $sql="SELECT * FROM  clubs  WHERE type='$type' ";
                $result= $db->query($sql);
                $numRows=$result->num_rows;
                 if($numRows > 0 ){

                    return $numRows;
                    }
                 }  

        

        function addMember($uid,$name,$college,$phone,$year,$clubName,$postion,$clubId){
                $conn = new Connection();  
                $db = $conn->connect();
                $sql=" INSERT INTO clubsmembers (uid,name,college,phone,year,clubName,postion,clubId) VALUES ('$uid','$name','$college','$phone','$year','$clubName','$postion','$clubId')";

                if($db->query($sql)){
                    return true;
                }else{
                    return false;
                }

        }   


        function deleteMemebr($id){
             $conn = new Connection();  
             $db = $conn->connect();
             $sql="DELETE FROM clubsmembers WHERE id='".$id."' ";

            if($db->query($sql)){
                    return true;
                }else{
                    return false;
                }
        }
         /* get meber information and send to fill input types in the addmember page to let the user update */   
        function getClubMemebr($id){
                $conn = new Connection();  
                $db = $conn->connect();
            $sql="SELECT id,uid,name,college,phone,year,postion FROM clubsmembers  WHERE   id= '".$id."'"; 
                $result= $db->query($sql);
                $numRows=$result->num_rows;

                if($numRows > 0 ){

                    while($row= $result->fetch_assoc()){
                        $data[]=$row;
                    }
                    $member=$this->array_flatten($data);
                    return $member;
                }
        }


        function updateMember($uid,$name,$college,$phone,$year,$postion,$cname,$id){
            $conn = new Connection();  
            $db = $conn->connect();

            $sql="UPDATE clubsmembers
            SET uid='$uid' ,name='$name' ,college='$college'  ,phone='$phone'   ,year='$year'   ,postion ='$postion' 
            WHERE clubName='".$cname."'  and  id='".$id."'  "   ;
            $result= $db->query($sql);

            if($result){
                return true;
            }else{
                return false;
            }


        }
    
      function getMemberId($cname,$uid){
           $conn = new Connection();  
                $db = $conn->connect();
 
                $sql="SELECT id FROM  clubsmembers  WHERE  clubName='$cname'  AND  uid='$uid' "; 
                $result= $db->query($sql);
                $numRows=$result->num_rows;

                if($numRows == 1 ){

                    while($row= $result->fetch_assoc()){
                        $data[]=$row;
                    }


                    $id=$this->array_flatten($data);
                   return $id;    
                }
      }
    
         function getUserName($id){
            $conn = new Connection();  
            $db = $conn->connect();
            
                $sql="SELECT name FROM users  WHERE   id= '".$id."'"; 
                $result= $db->query($sql);
                $numRows=$result->num_rows;

                if($numRows > 0 ){

                    while($row= $result->fetch_assoc()){
                        $data[]=$row;
                    }
                    $member=$this->array_flatten($data);
                    return $member;
                }
        }
    
    
        function getUser($id){
            $conn = new Connection();  
            $db = $conn->connect();
            
                $sql="SELECT pwd FROM users  WHERE   id= '".$id."'"; 
                $result= $db->query($sql);
                $numRows=$result->num_rows;

                if($numRows > 0 ){

                    while($row= $result->fetch_assoc()){
                        $data[]=$row;
                    }
                    $member=$this->array_flatten($data);
                    return $member;
                }
        }
       // this function take the id of the supervisor & the president of the club from add club forum
       function addSup($sid,$name,$pwd){
            $conn = new Connection();  
            $db = $conn->connect();
           // use passhash fun to encrypt pass 
            $hash=password_hash($pwd, PASSWORD_DEFAULT);
             $sql=" INSERT INTO users (id,pwd,postion,name ) VALUES ('$sid','$hash','supervisor','$name')";
           
           if($db->query($sql)){
                    return true;
                }else{
                    return false;
             }
           
       }
        // $newId is the id user will write when updating the forum sid is id that already retrived from the data
        function updateSup($sid,$name,$pwd,$newId){
            $conn = new Connection();  
                $db = $conn->connect();
                 $sql="UPDATE users
                SET id=$newId ,name='$name' ,pwd='$pwd'  
                WHERE id=$sid  ";
                $result= $db->query($sql);

                if($result){
                    return true;
                }else{
                    return false;
                }  
        }
    
        function addPre($pid,$name,$pwd){
                    $conn = new Connection();  
                    $db = $conn->connect();
                     // use passhash fun to encrypt pass 
                      $hash=password_hash($pwd, PASSWORD_DEFAULT);
                     $sql=" INSERT INTO users (id,pwd,postion,name ) VALUES ('$pid','$hash','president','$name')";

                   if($db->query($sql)){
                            return true;
                        }else{
                            return false;
                     }

               }
     // $newId is the id user will write when updating the forum pid is id that already retrived from the data
    function updatePre($pid,$name,$pwd,$newId){
        $conn = new Connection();  
            $db = $conn->connect();
             $sql="UPDATE users
            SET id=$newId ,name='$name' ,pwd='$pwd'  
            WHERE id=$pid  ";
            $result= $db->query($sql);

            if($result){
                return true;
            }else{
                return false;
            }  
    }
        
         function updateClub($name,$supervisor,$establishdate,$type,$vission,$mission,$goals,$logo, $p
         ,$cid,$sid,$pid){
            $conn = new Connection();  
            $db = $conn->connect();
             $sql="UPDATE clubs
            SET name='$name' ,supervisor='$supervisor' ,establishdate='$establishdate'   ,type='$type'   ,vission ='$vission' 
            ,mission='$mission' ,goals='$goals',logo='$logo', p='$p', sid='$sid' , pId='$pid'
            WHERE id=$cid  ";
            $result= $db->query($sql);

            if($result){
                return true;
            }else{
                return false;
            }  
       }
       
            function deleteUser($uid){
                        $conn = new Connection();  
                        $db = $conn->connect();
                        $sql="DELETE FROM users WHERE id='".$uid."' ";

                             if($db->query($sql)){
                                     return true;
                                  }else{
                                    return false;
                                        }
                    }
    
        function updateUser($id,$newID,$name){
             $conn = new Connection();  
              $db = $conn->connect();
             
            $query ="SELECT * FROM users WHERE id = '".$id."'  ";
             $res = $db->query($query);  
            $userdata = mysqli_fetch_array($res); 
            
             $no_rows = mysqli_num_rows($res);  
         
             if ($no_rows == 1) {
                                
         $sql="UPDATE users SET id='$newID', name= '$name'   WHERE id='$id'  "   ;
               
             $result= $db->query($sql);

                        if($result){
                                     
                         return $id;
                                    }
                        else{
                            $u="not updated";
                            return $u;
                             }
                      }
        }
    
     function changePass($id, $pwd) {

          $conn = new Connection();  
          $db = $conn->connect();
          // use passhash fun to encrypt pass 
          $hash=password_hash($pwd, PASSWORD_DEFAULT);
        
          $sql = "UPDATE users SET pwd = '$hash' WHERE id = '$id'";
        $query = $db->query($sql);

            if($query === TRUE) {
                return true;
            } else {
                return false;
              }
      }

        //this function convert multudimensiol array into single array 
        function array_flatten($array) { 
              if (!is_array($array)) { 
                return FALSE; 
              } 
              $result = array(); 
              foreach ($array as $key => $value) { 
                if (is_array($value)) { 
                  $result = array_merge($result, $this->array_flatten($value)); 
                } 
                else { 
                  $result[$key] = $value; 
                } 
              } 
              return $result; 
        }
    
    

}