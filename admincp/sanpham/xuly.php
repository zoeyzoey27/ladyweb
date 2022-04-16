<?php
     require_once('../config/config.php');
     $masanpham = $tensanpham = $slug = $gianhap = $giaban = $hinhanh = $anhchitiet1 = $anhchitiet2 = $anhchitiet3
     = $anhchitiet4 = $soluong = $preorder = $mota = '';

    if (isset($_POST['btnsave'])){

        $masanpham = $_POST['masanpham'];
        $tensanpham = $_POST['tensanpham'];
        $slug = $_POST['slug'];
        $maphanloai = $_POST['maphanloai'];
        $gianhap = $_POST['gianhap'];
        $giaban = $_POST['giaban'];
            
        $hinhanh = $_FILES['hinhanh']['name'];
        $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];

        $soluong = $_POST['soluong'];
        $preorder = $_POST['preorder'];
        $mota = $_POST['mota'];
        $trangthai = $_POST['trangthai'];


        $anhchitiet1 = $_FILES['anhchitiet1']['name'];
        $anhchitiet1_tmp = $_FILES['anhchitiet1']['tmp_name'];

        $anhchitiet2 = $_FILES['anhchitiet2']['name'];
        $anhchitiet2_tmp = $_FILES['anhchitiet2']['tmp_name'];

        $anhchitiet3 = $_FILES['anhchitiet3']['name'];
        $anhchitiet3_tmp = $_FILES['anhchitiet3']['tmp_name'];

        $anhchitiet4 = $_FILES['anhchitiet4']['name'];
        $anhchitiet4_tmp = $_FILES['anhchitiet4']['tmp_name'];

        if ($masanpham==''||$tensanpham==''||$slug==''||$giaban==''||$gianhap=='' ||$soluong==''||$preorder==''||$mota==''||
        $hinhanh==''||$anhchitiet1==''||$anhchitiet2==''||$anhchitiet3==''||$anhchitiet4==''){
            header('Location: themmoisanpham.php?result=error');
        }
        else {
            
            $sql = "INSERT INTO sanpham(masanpham,tensanpham,slugsanpham,maphanloai,gianhap,giaban,soluong,preorder,
            trangthaisanpham,hinhanh,anhchitiet2,anhchitiet3,anhchitiet1,anhchitiet4,mota) VALUES ('".$masanpham."',
            '".$tensanpham."','".$slug."','".$maphanloai."','".$gianhap."','".$giaban."','".$soluong."','".$preorder."',
            '".$trangthai."','".$hinhanh."','".$anhchitiet2."','".$anhchitiet3."','".$anhchitiet1."','".$anhchitiet4."','".$mota."')";

            execute($sql);

            move_uploaded_file($hinhanh_tmp,'uploads/'.$hinhanh);
            move_uploaded_file($anhchitiet1_tmp,'uploads/'.$anhchitiet1);
            move_uploaded_file($anhchitiet2_tmp,'uploads/'.$anhchitiet2);
            move_uploaded_file($anhchitiet3_tmp,'uploads/'.$anhchitiet3);
            move_uploaded_file($anhchitiet4_tmp,'uploads/'.$anhchitiet4);

            header('Location: themmoisanpham.php?result=success');
        }
    }
    if (isset($_POST['btnupdate'])){
        $masanpham = $_POST['masanpham'];
        $tensanpham = $_POST['tensanpham'];
        $slug = $_POST['slug'];
        $maphanloai = $_POST['maphanloai'];
        $gianhap = $_POST['gianhap'];
        $giaban = $_POST['giaban'];
            
        $hinhanh = $_FILES['hinhanh']['name'];
        $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];

        $soluong = $_POST['soluong'];
        $preorder = $_POST['preorder'];
        $mota = $_POST['mota'];
        $trangthai = $_POST['trangthai'];


        $anhchitiet1 = $_FILES['anhchitiet1']['name'];
        $anhchitiet1_tmp = $_FILES['anhchitiet1']['tmp_name'];

        $anhchitiet2 = $_FILES['anhchitiet2']['name'];
        $anhchitiet2_tmp = $_FILES['anhchitiet2']['tmp_name'];

        $anhchitiet3 = $_FILES['anhchitiet3']['name'];
        $anhchitiet3_tmp = $_FILES['anhchitiet3']['tmp_name'];

        $anhchitiet4 = $_FILES['anhchitiet4']['name'];
        $anhchitiet4_tmp = $_FILES['anhchitiet4']['tmp_name'];
        
        if ($masanpham==''||$tensanpham==''||$slug==''||$giaban==''||$gianhap=='' ||$soluong==''||$preorder==''||$mota==''){
            header('Location: sanpham.php?result=error');
        }
        else {
            if (isset($_GET['id'])){
                $con = mysqli_connect("localhost","root","","ladyweb");
                $sql_sp = "SELECT * FROM sanpham WHERE idsanpham = ".$_GET['id'];
                $result = mysqli_query($con,$sql_sp);
                while ($row = mysqli_fetch_array($result)){
                    if ($hinhanh == '') $hinhanh = $row['hinhanh'];
                    if ($anhchitiet1 == '') $anhchitiet1 = $row['anhchitiet1'];
                    if ($anhchitiet2 == '') $anhchitiet2 = $row['anhchitiet2'];
                    if ($anhchitiet3 == '') $anhchitiet3 = $row['anhchitiet3'];
                    if ($anhchitiet4 == '') $anhchitiet4 = $row['anhchitiet4'];
                }
                
                 $sql = "UPDATE sanpham SET masanpham='".$masanpham."', tensanpham='".$tensanpham."',
                 slugsanpham='".$slug."', maphanloai = '".$maphanloai."', gianhap = '".$gianhap."',
                 giaban = '".$giaban."', soluong = '".$soluong."', preorder = '".$preorder."', trangthaisanpham = '".$trangthai."', 
                 hinhanh = '".$hinhanh."',anhchitiet2='".$anhchitiet2."',anhchitiet3='".$anhchitiet3."',
                 anhchitiet1='".$anhchitiet1."',anhchitiet4='".$anhchitiet4."',mota='".$mota."' WHERE idsanpham = " .$_GET['id'];
                 execute($sql);

                 move_uploaded_file($hinhanh_tmp,'uploads/'.$hinhanh);
                 move_uploaded_file($anhchitiet1_tmp,'uploads/'.$anhchitiet1);
                 move_uploaded_file($anhchitiet2_tmp,'uploads/'.$anhchitiet2);
                 move_uploaded_file($anhchitiet3_tmp,'uploads/'.$anhchitiet3);
                 move_uploaded_file($anhchitiet4_tmp,'uploads/'.$anhchitiet4);
     
                 header('Location: sanpham.php?result=success');

            }
        }
    }

    if (isset($_POST['export'])){

        require('../../Classes/PHPExcel.php');

        $objExcel = new PHPExcel;
        $objExcel->setActiveSheetIndex(0);
        $sheet = $objExcel->getActiveSheet()->setTitle('Sản phẩm');

        $rowCount = 1;
        $sheet->setCellValue('A'.$rowCount,'Mã sản phẩm');
        $sheet->setCellValue('B'.$rowCount,'Tên sản phẩm');
        $sheet->setCellValue('C'.$rowCount,'Slug');
        $sheet->setCellValue('D'.$rowCount,'Loại sản phẩm');
        $sheet->setCellValue('E'.$rowCount,'Giá bán');
        $sheet->setCellValue('F'.$rowCount,'Giá nhập');
        $sheet->setCellValue('G'.$rowCount,'Số lượng');
        $sheet->setCellValue('H'.$rowCount,'Pre-Order');
        $sheet->setCellValue('I'.$rowCount,'Mô tả');
        $sheet->setCellValue('J'.$rowCount,'Trạng thái');

        $sql ="SELECT * FROM sanpham LEFT JOIN loaisanpham ON sanpham.maphanloai = loaisanpham.maphanloai";
        $result = executeResult($sql);
        foreach ($result as $list){
           $rowCount++;
           $sheet->setCellValue('A'.$rowCount,$list['masanpham']);
           $sheet->setCellValue('B'.$rowCount,$list['tensanpham']);
           $sheet->setCellValue('C'.$rowCount,$list['slugsanpham']);
           $sheet->setCellValue('D'.$rowCount,$list['tenphanloai']);
           $sheet->setCellValue('E'.$rowCount,$list['giaban']);
           $sheet->setCellValue('F'.$rowCount,$list['gianhap']);
           $sheet->setCellValue('G'.$rowCount,$list['soluong']);
           $sheet->setCellValue('H'.$rowCount,$list['preorder']);
           $sheet->setCellValue('I'.$rowCount,$list['mota']);
           $sheet->setCellValue('J'.$rowCount,$list['trangthaisanpham']);
        } 
        
        $objWrite = new PHPExcel_Writer_Excel2007($objExcel);
        ob_end_clean();
        $filename = 'export.xlsx';
        $objWrite->save($filename);

        header('Content-Disposition: attachment; filename="'.$filename.'"');
        header('Content-Type: application/vnd.openxmlformatsofficedocument.spreadsheetml.sheet'); 
        header('Content-Length: '.filesize($filename));
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate');
        header('Pragma: no-cache');
        readfile($filename);
        return;
     }
?>