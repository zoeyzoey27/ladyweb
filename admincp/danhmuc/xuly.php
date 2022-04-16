<?php

     require_once('../config/config.php');
     $madanhmuc = $tendanhmuc = $slug = '';
     if (isset($_POST['btnsave'])){
        $madanhmuc = $_POST['madanhmuc'];
        $tendanhmuc = $_POST['tendanhmuc'];
        $slug = $_POST['slug'];
        $trangthai = $_POST['trangthai'];

        $hinhanh = $_FILES['hinhanh']['name'];
        $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];

         if ($madanhmuc=='' || $tendanhmuc=='' || $slug =='' || $hinhanh == ''){
            header('Location: themmoidanhmuc.php?result=error');
         }
         else {
            $sql = "INSERT INTO danhmuc(madanhmuc,tendanhmuc,slug,trangthai,anhhienthi) 
            VALUES ('".$madanhmuc."','".$tendanhmuc."','".$slug."','".$trangthai."','".$hinhanh."')";
            execute($sql);
            move_uploaded_file($hinhanh_tmp,'uploads/'.$hinhanh);
            header('Location: themmoidanhmuc.php?result=success');
         }
     }
     if (isset($_POST['btnupdate'])){
      $madanhmuc = $_POST['madanhmuc'];
      $tendanhmuc = $_POST['tendanhmuc'];
      $slug = $_POST['slug'];
      $trangthai = $_POST['trangthai']; 

      $hinhanh = $_FILES['hinhanh']['name'];
      $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];

      if ($madanhmuc=='' || $tendanhmuc=='' || $slug ==''){
         header('Location: danhmuc.php?result=error');
      }
      else {
         if (isset($_GET['id'])){
            
            if ($hinhanh == '') {
               $sql = "UPDATE danhmuc SET madanhmuc='".$madanhmuc."',tendanhmuc ='".$tendanhmuc."', slug='".$slug."',trangthai='".$trangthai."'
               WHERE id = ".$_GET['id'];
            }
            else {
               $sql = "UPDATE danhmuc SET madanhmuc='".$madanhmuc."',tendanhmuc ='".$tendanhmuc."', slug='".$slug."',trangthai='".$trangthai."',
               anhhienthi = '".$hinhanh."' WHERE id = ".$_GET['id'];
               move_uploaded_file($hinhanh_tmp,'uploads/'.$hinhanh);
            }
            execute($sql);
            header('Location: danhmuc.php?result=success');
         }
         
      }
     }

     if (isset($_POST['export'])){

        require('../../Classes/PHPExcel.php');

        $objExcel = new PHPExcel;
        $objExcel->setActiveSheetIndex(0);
        $sheet = $objExcel->getActiveSheet()->setTitle('Danh mục');

        $rowCount = 1;
        $sheet->setCellValue('A'.$rowCount,'Mã danh mục');
        $sheet->setCellValue('B'.$rowCount,'Tên danh mục');
        $sheet->setCellValue('C'.$rowCount,'Slug');
        $sheet->setCellValue('D'.$rowCount,'Trạng thái');

        $sql = "SELECT * FROM danhmuc";
        $result = executeResult($sql);
        foreach ($result as $list){
           $rowCount++;
           $sheet->setCellValue('A'.$rowCount,$list['madanhmuc']);
           $sheet->setCellValue('B'.$rowCount,$list['tendanhmuc']);
           $sheet->setCellValue('C'.$rowCount,$list['slug']);
           $sheet->setCellValue('D'.$rowCount,$list['trangthai']);
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