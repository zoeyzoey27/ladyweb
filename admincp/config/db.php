<?php
   $conn = mysqli_connect("localhost","root","","ladyweb");
   if (mysqli_connect_errno()){
     echo 'Kết nối tới cơ sở dữ liệu thất bại: '.mysqli_connect_error();
   }
?>  