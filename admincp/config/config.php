<?php
    
    function execute($sql){
        require_once('db.php');
        mysqli_query($conn,$sql);
        mysqli_close($conn);
    }
    function executeResult($sql){
        require_once('db.php');
        $resultset = mysqli_query($conn,$sql);
        $list = [];
        while ($row = mysqli_fetch_array($resultset,1)){
            $list [] = $row;
        }
        mysqli_close($conn);
        return $list;
    }
?>