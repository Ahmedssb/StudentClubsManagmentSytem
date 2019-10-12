<?php 
include 'Connection.php';
// the name of class should be chnge into user
class User {
	
	  
 	// check the user id && pass is correct 
  public function userLog($emailid, $password){  
	       	$conn = new Connection();  
               $db = $conn->connect();
            // use pass verify 
             // sq= selet * where id then in if condition cheeck for the pass match using passverify
                    //$userdata = $this->getUserDataByUserId($emailid);

 	   $query ="SELECT * FROM users WHERE id = '".$emailid."'  ";
             $res = $db->query($query);  
            $user_data = mysqli_fetch_array($res);             
             $no_rows = mysqli_num_rows($res);  
         
             if ($no_rows == 1)   
            {      $userdata = $this->getUserDataByUserId($emailid);  
                 // check if the pass user write match the one stored on the data base using verify pass method 
               if(password_verify($password,  $userdata['pwd'])) {
                    $_SESSION['uid'] = $user_data['id'];  
                    $_SESSION['postion'] = $user_data['postion'];  
                      return TRUE; 
                }
            
                   /* $_SESSION['uid'] = $user_data['id'];  
                    $_SESSION['postion'] = $user_data['postion'];  
                     return password_verify($password,  $userdata['pwd']); */
              }  
 
            else  
            {  
                return FALSE;  
            }  
               
         }      
       
	   
/* function that return the postion of the user so he can be directed to his page */
	public function getUserPostion ($emailid, $password){
		 $conn = new Connection();  
         $db = $conn->connect();
		 $query ="SELECT postion FROM users WHERE id = '".$emailid."'  ";
          $res = $db->query($query);
		  $pos = mysqli_fetch_array($res);             

		 return $pos;
	}
    
     function getUserDataByUserId($id) {
         $conn = new Connection();  
         $db = $conn->connect();

        
        $sql = "SELECT * FROM users WHERE id = $id";
        $query = $db->query($sql);
        $result = $query->fetch_assoc();
        return $result; 
 
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

    // this fun check if the pass user provided match the one stored on the dat base 
    function passwordMatch($id, $password) {
  
           $userdata = $this->getUserDataByUserId($id);
            
    // use pass word verify to decrypt the pass stored in the database and compare it eith the one user provided
            if(password_verify($password,$userdata['pwd'])) {
                    return true;
                } else {
                    return false;
                }
              
 
        }
            
    function changePassword($id, $password) {

         $conn = new Connection();  
        $db = $conn->connect();
        // use passhash fun to encrypt pass 
        $hash=password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "UPDATE users SET pwd = '$hash' WHERE id = $id";
        $query = $db->query($sql);

        if($query === TRUE) {
            return true;
        } else {
            return false;
          }
      }
            
    
}



?>