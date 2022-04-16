<?php
      require_once('../config/config.php');
      $maphanloai = $tenphanloai = $slug ='';
      if (isset($_POST['btnsave'])){
          $maphanloai = $_POST['maphanloai'];
          $tenphanloai = $_POST['tenphanloai'];
          $slug = $_POST['slug'];
          $madanhmuc = $_POST['madanhmuc'];
          $trangthaihienthi = $_POST['trangthaihienthi'];

          if ($maphanloai==''||$tenphanloai==''|| $slug==''){
              header('Location: themmoiloaisanpham.php?result=error');
          }
          else {
              $sql = "INSERT INTO loaisanpham(maphanloai,tenphanloai,slug,madanhmuc,trangthaihienthi)
                  VALUES ('".$maphanloai."','".$tenphanloai."','".$slug."','".$madanhmuc."','".$trangthaihienthi."')";
              execute($sql);
              header('Location: themmoiloaisanpham.php?result=success');
          }
      }

      if (isset($_POST['btnupdate'])){
          $maphanloai = $_POST['maphanloai'];
          $tenphanloai = $_POST['tenphanloai'];
          $slug = $_POST ['slug'];
          $madanhmuc = $_POST['madanhmuc'];
          $trangthaihienthi = $_POST['trangthaihienthi'];

          if ($maphanloai==''||$tenphanloai==''||$slug==''){
              header('Location: loaisanpham.php?result=error');
          }
          else {
              if (isset($_GET['id'])){
                $sql = "UPDATE loaisanpham SET maphanloai = '".$maphanloai."',tenphanloai = '".$tenphanloai."', slug = '".$slug."', 
                madanhmuc = '".$madanhmuc."', trangthaihienthi = '".$trangthaihienthi."' WHERE idphanloai = ".$_GET['id'];
                execute($sql);
                header('Location: loaisanpham.php?result=success');
              }
          }
      }

      if (isset($_POST['export'])){

        require('../../Classes/PHPExcel.php');

        $objExcel = new PHPExcel;
        $objExcel->setActiveSheetIndex(0);
        $sheet = $objExcel->getActiveSheet()->setTitle('Loại sản phẩm');

        $rowCount = 1;
        $sheet->setCellValue('A'.$rowCount,'Mã phân loại');
        $sheet->setCellValue('B'.$rowCount,'Tên phân loại');
        $sheet->setCellValue('C'.$rowCount,'Slug');
        $sheet->setCellValue('D'.$rowCount,'Danh mục');
        $sheet->setCellValue('E'.$rowCount,'Trạng thái');

        $sql ="SELECT * FROM loaisanpham LEFT JOIN danhmuc ON loaisanpham.madanhmuc = danhmuc.madanhmuc";
        $result = executeResult($sql);
        foreach ($result as $list){
           $rowCount++;
           $sheet->setCellValue('A'.$rowCount,$list['maphanloai']);
           $sheet->setCellValue('B'.$rowCount,$list['tenphanloai']);
           $sheet->setCellValue('C'.$rowCount,$list['slug']);
           $sheet->setCellValue('D'.$rowCount,$list['tendanhmuc']);
           $sheet->setCellValue('E'.$rowCount,$list['trangthai']);
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