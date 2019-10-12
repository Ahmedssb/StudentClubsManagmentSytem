<?php
   session_start();
  session_unset();
  session_destroy();
  session_write_close();
 $_SESSION['message']="You are now logged out";
  header('location:../index.php');

?>