<?php
$connect = mysqli_connect('localhost', 'root', 'root', 'artgallery');
      if(!$connect){
        die("Connection Failed: " . mysqli_connect_error());
      }
     
?>