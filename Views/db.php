<?php
 
// Create database connection
$db = new mysqli("fdb21.awardspace.net", "3108952_studentclub", "2150010521student", "3108952_studentclub" );
 $db ->query("SET NAMES 'utf8'");
 $db ->query('SET CHARACTER SET utf8');
// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>