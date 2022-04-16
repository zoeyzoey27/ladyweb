<?php
   if (isset($_POST['idphanloai'])) {
        $id = $_POST['idphanloai'];

        require_once('../config/config.php');
        $sql = "DELETE FROM loaisanpham WHERE idphanloai = ".$id;
        execute($sql);
        echo 'Xóa loại sản phẩm thành công!';
    }
?>