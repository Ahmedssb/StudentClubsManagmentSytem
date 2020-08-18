<?php 

class Connection {
    
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $charset;
    
    public function connect(){
        $this->servername ="nnmeqdrilkem9ked.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
        $this->username ="itvwm6hrxxsqxg1d";
        $this->password ="oolnj0jzjcvqtoxo	";
        $this->dbname ="mt4d5ucrye70yqzb";
		$this->charset="utf8mb4";
        
       $conn = new mysqli($this->servername, $this->username,$this->password,$this->dbname);
         $conn ->query("SET NAMES 'utf8'");
         $conn ->query('SET CHARACTER SET utf8');
        
        if ($conn->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}
       return $conn;

    }
	
	/*try {
		
    $dsn = "mysql:host=".$this->servername.";dbname=". $this->dbname."; charset=".$this->charset; 
	$conn= new PDO($dsn,$this->username,$this->password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
	return $conn;
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }*/
}
	
      
