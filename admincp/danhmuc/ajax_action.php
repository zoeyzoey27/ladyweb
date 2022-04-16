<?php
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        require_once('../config/config.php');
        $sql = "DELETE FROM danhmuc WHERE id = ".$id;
        execute($sql);
        echo 'Xóa danh mục thành công!';
    }
?>