<?php 
    session_start();
    if (!isset($_SESSION['dangnhap'])){
        header('Location: ../pages/login.php');
    }
?>  
<!DOCTYPE html>
<html lang="en">
<head>
  <title>LADY - Thống kê</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
  <link href="../../css/style.css" rel="stylesheet" type="text/css">
  <script src="https://kit.fontawesome.com/9fec2b5230.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;500;700&display=swap" rel="stylesheet">
</head>
<body>

    <?php
        include('../container/header.php');
    ?>    
    <div class="container-fluid">
        <div class="row">
        <?php
            include('../container/sidebar.php');
         ?> 
          <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
           
              <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Quản trị</a></li>
                  <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                  <li class="breadcrumb-item active"><a href="#">Quản lý thống kê</a></li>
                </ol>
              </nav>
              <div class="my-5">
                 <h4>Tổng số lượng sản phẩm tồn kho theo phân loại</h4>
                 <div id="chart" style="height: 250px;"></div>
              </div>    
              <div class="my-5">
                 <h4>Thống kê sản phẩm</h4>
                 <div class="row">
                    <div class="col-4"></div>
                    <div class="col-8"> 
                     <form class="d-flex" style=" margin-top: 0;">
                        <select class="form-select search-input" name="sort">
                            <option value="featured">Sản phẩm bán chạy</option>
                            <option value="quantity">Sản phẩm tồn nhiều</option>
                        </select>
                        <button class="btn btn-search" type="submit"><i class="fas fa-filter"></i></button>
                     </form>
                   </div>
                     
                </div>
                <div class="row">
                     <div class="col-4"> 
                     <small class="float-start text-sm text-muted">Hiển thị kết quả</small> 
                   </div>
                   <div class="col-4"> 
                     <form class="d-flex" style=" margin-top: 0;">
                        <select class="form-select search-input" name="category">
                            <option>Loại sản phẩm</option>
                            <?php
                                $con = mysqli_connect("localhost","root","","ladyweb");
                                $sql = "SELECT * FROM loaisanpham";
                                $result = mysqli_query($con,$sql);
                                while ($row = mysqli_fetch_array($result)){
                                    echo '<option value="'.$row['maphanloai'].'">'.$row['tenphanloai'].'</option>';
                                } 
                                mysqli_close($con); 
                            ?>
                        </select>
                        <button class="btn btn-search" type="submit"><i class="fas fa-filter"></i></button>
                     </form>
                   </div>
                   <div class="col-4"> 
                     <form class="d-flex" style=" margin-top: 0;">
                        <select class="form-select search-input" name="status">
                            <option>Trạng thái</option>
                            <option value="show">Hiển thị</option>
                            <option value="hide">Ẩn</option>
                        </select>
                        <button class="btn btn-search" type="submit"><i class="fas fa-filter"></i></button>
                     </form>
                   </div>
                </div>
                <table class="table table-bordered table-hover">
                <thead class="text-center align-middle">
                  <tr>
                    <th>STT</th>
                    <th>Hình ảnh</th>
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Slug</th>
                    <th>Loại sản phẩm</th>
                    <th>Giá bán</th>
                    <th>Giá nhập</th>
                    <th>Số lượng</th>
                    <th>Pre-Order</th>
                    <th>Trạng thái</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                       $con = mysqli_connect("localhost","root","","ladyweb");

                       if (isset($_GET['sort']) && $_GET['sort'] != '') {
                         if ($_GET['sort'] == 'featured'){
                            $sql = "SELECT * FROM sanpham LEFT JOIN loaisanpham ON sanpham.maphanloai = loaisanpham.maphanloai ORDER BY preorder DESC";
                         } 
                         else if ($_GET['sort'] == 'quantity'){
                            $sql = "SELECT * FROM sanpham LEFT JOIN loaisanpham ON sanpham.maphanloai = loaisanpham.maphanloai ORDER BY soluong DESC";
                         } 
                       }
                       else if (isset($_GET['category']) && $_GET['category'] != ''){
                            $sql = "SELECT * FROM sanpham LEFT JOIN loaisanpham ON sanpham.maphanloai = loaisanpham.maphanloai WHERE sanpham.maphanloai = '".$_GET['category']."'";
                       }
                       else if (isset($_GET['status']) && $_GET['status'] != ''){
                           if ($_GET['status']=='show'){
                            $sql = "SELECT * FROM sanpham LEFT JOIN loaisanpham ON sanpham.maphanloai = loaisanpham.maphanloai WHERE sanpham.trangthaisanpham = '1'";
                           }
                           else {
                            $sql = "SELECT * FROM sanpham LEFT JOIN loaisanpham ON sanpham.maphanloai = loaisanpham.maphanloai WHERE sanpham.trangthaisanpham = '0'";
                           }
                       }
                       else {
                          $sql = "SELECT * FROM sanpham LEFT JOIN loaisanpham ON sanpham.maphanloai = loaisanpham.maphanloai";
                       }
                       
                       $listsanpham = mysqli_query($con,$sql);
                       
                       $index = 1;
                       while ($list = mysqli_fetch_array($listsanpham)){
                         echo ' <tr>
                         <td>'.$index ++.'</td>
                         <td><img src="../sanpham/uploads/'.$list['hinhanh'].'" width="100px"></td>
                         <td>'.$list['masanpham'].'</td>
                         <td>'.$list['tensanpham'].'</td>
                         <td>'.$list['slugsanpham'].'</td>
                         <td>'.$list['tenphanloai'].'</td>
                         <td>'.number_format($list['giaban']).'</td>
                         <td>'.number_format($list['gianhap']).'</td>
                         <td>'.$list['soluong'].'</td>
                         <td>'.$list['preorder'].'</td>
                         <td>';
                         if ($list['trangthaisanpham'] == 1) {
                            echo '<p class="text-success">Hiển thị</p>';
                         }
                         else {
                            echo '<p class="text-danger">Ẩn</p>';
                         }  
                         echo'</td>   
                         <td class="text-center"><a href="../sanpham/chitietsanpham.php?msp='.$list['masanpham'].'&id='.$list['idsanpham'].'">Xem chi tiết</td>
                       </tr>';
                       }
                    ?>
                     
                  
                </tbody>
              </table>
              <?php
                   if (mysqli_num_rows($listsanpham)==0) echo '<p class="text-center text-sm text-muted">Không có dữ liệu hiển thị</p>';
              ?>
              </div> 
               
          </main>
        </div>
      </div>
      
      <?php
         include('../container/footer.php');
      ?>   
      <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
      <script type="text/javascript">
           new Morris.Bar({
             // ID of the element in which to draw the chart.
             element: 'chart',
             // Chart data records -- each entry in this array corresponds to a point on
             // the chart.
             data: [
                <?php 
                    require_once('../config/config.php');
                    $sql = "SELECT loaisanpham.maphanloai, loaisanpham.tenphanloai, SUM(sanpham.soluong) as tongsoluong FROM sanpham,loaisanpham WHERE loaisanpham.maphanloai=sanpham.maphanloai GROUP BY sanpham.maphanloai";
                    $result = executeResult($sql);
                    foreach($result as $list){
                        echo '{ category: "'.$list['tenphanloai'].'", quantity: '.$list['tongsoluong'].'},';
                    }
                ?>        
             ],
             // The name of the data record attribute that contains x-values.
             xkey: 'category',
             // A list of names of data record attributes that contain y-values.
             ykeys: ['quantity'],
             // Labels for the ykeys -- will be displayed when you hover over the
             // chart.
             labels: ['Tổng số sản phẩm']
           });
      </script>    
</body>
</html>
