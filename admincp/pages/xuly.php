<?php
    session_start();
    if (isset($_POST['loginbtn'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        if ($email == '' || $password == ''){
            header('Location: login.php?login=error01');
        }
        else {
            require_once('../config/db.php');
            $sql = "SELECT * FROM user WHERE email = '".$email."'AND password = '".$password."' LIMIT 1";
            $row = mysqli_query($conn,$sql);
            $count = mysqli_num_rows($row);
            if ($count>0){
               while ($r_user = mysqli_fetch_array($row)){
                    $_SESSION['dangnhap'] = $r_user['hoten'];   
               }
                header('Location: dashboard.php');
            }
            else {
                header('Location: login.php?login=error02');
            }
        }
    }
?>