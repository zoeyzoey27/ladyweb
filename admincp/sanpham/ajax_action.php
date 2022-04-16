<?php
   if (isset($_POST['idsanpham'])) {
        $id = $_POST['idsanpham'];

        require_once('../config/config.php');
        $sql = "DELETE FROM sanpham WHERE idsanpham = ".$id;
        execute($sql);
        echo 'Xóa sản phẩm thành công!';
    }
?>