<?php 
    session_start();
    if (!isset($_SESSION['dangnhap'])){
        header('Location: ../pages/login.php');
    }
?>    
<!DOCTYPE html>
<html lang="en">
<head>
  <title>LADY - Trang quản trị</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
  <link href="../../css/style.css" rel="stylesheet" type="text/css">
  <script src="https://kit.fontawesome.com/9fec2b5230.js" crossorigin="anonymous"></script>
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
                  <li class="breadcrumb-item active"><a href="#">Trang chủ</a></li>
                </ol>
              </nav>
          
            <div class="align-items-center pb-2 border-bottom">
              <h2 class="h2">Chào mừng bạn tới trang quản trị Admin</h2>
              <small class="blockquote-desc" >Cùng khám phá Trang quản trị trước khi bạn bắt đầu công việc kinh doanh của mình</small>
            </div>
            <div class="row setting-row">
              <h4>Tạo sản phẩm và bán hàng</h4>
              <div class="col-sm-3">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Danh mục sản phẩm</h5>
                    <p class="card-text">Thêm mới và quản lý danh mục sản phẩm</p>
                    <a href="../danhmuc/themmoidanhmuc.php" class="btn btn-lady">Tạo ngay</a>
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Loại sản phẩm</h5>
                    <p class="card-text">Thêm mới và quản lý các loại sản phẩm của từng danh mục</p>
                    <a href="../loaisanpham/themmoiloaisanpham.php" class="btn btn-lady">Tạo ngay</a>
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Sản phẩm</h5>
                    <p class="card-text">Thêm mới và quản lý sản phẩm thuộc các loại sản phẩm hiện có</p>
                    <a href="../sanpham/themmoisanpham.php" class="btn btn-lady">Tạo ngay</a>
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Đơn hàng</h5>
                    <p class="card-text">Quản lý các đơn đặt hàng của khách hàng</p>
                    <a href="#" class="btn btn-lady">Xem thêm</a>
                  </div>
                </div>
              </div>
            </div>
            
              <div class="row category">
                <div class="row">
                  <div class="col-6">
                    <h4>Danh mục sản phẩm</h4>
                  </div>
                  <div class="col-6">
                    <a class="float-end detail-span" href="../danhmuc/danhmuc.php"><small class=" text-sm text-muted">Đi tới trang danh mục</small> </a>
                  </div>
                </div>
                <?php 
                    include('../config/config.php');
                    $sql = "SELECT * FROM danhmuc ORDER BY id ASC";
                    $list = executeResult($sql);
                    foreach ($list as $row){
                        echo ' <div class="col text-center category-box">
                                  <img src="../danhmuc/uploads/'.$row['anhhienthi'].'" style="max-width: 100%;">
                                  <h4 style="margin:15px auto;   ">'.$row['tendanhmuc'].'</h4>
                               </div>';
                    }
                ?>    
              </div>
              <div class="row category">
                <div class="row">
                  <div class="col-6">
                  <h4>Sản phẩm mới</h4>
                  </div>
                  <div class="col-6">
                  <a class="float-end detail-span" href="../sanpham/sanpham.php"><small class=" text-sm text-muted">Đi tới trang sản phẩm</small> </a>
                  </div>
                </div>
                <?php 
                    $con = mysqli_connect("localhost","root","","ladyweb");
                    $sql_newproduct = "SELECT * FROM sanpham ORDER BY idsanpham DESC";
                    $list_newproduct = mysqli_query($con,$sql_newproduct);
                    echo '<div class="row">';
                    $index = 0;
                    while ($list_new = mysqli_fetch_array($list_newproduct)){
                        $index++;
                        echo '<div class="col-sm-3 box-product">
                        <div class="icons">
                            <a href="#"><i class="fas fa-pen"></i></a>
                            <a href="#"><i class="far fa-eye"></i></a>
                            <a href="#"><i class="far fa-trash-alt"></i></a>
                        </div>
                        <a class="text-center" href="/product-details.html">
                          <img src="../sanpham/uploads/'.$list_new['hinhanh'].'" class="img-thumbnail" style="width:280px;height: 400px;">
                          <p class="name-product">'.$list_new['tensanpham'].'</p>
                          <p class="price-product">'.number_format($list_new['giaban']).' VND</p>
                        </a>
                        </div>';
                        if ($index == 8) break;
                    }
                    echo '</div>';
                ?>    
              </div>
              
              <div class="row category">
                <div class="row">
                  <div class="col-6">
                  <h4>Sản phẩm nổi bật</h4>
                  </div>
                  <div class="col-6">
                  <a class="float-end detail-span" href="../sanpham/sanpham.php"><small class=" text-sm text-muted">Đi tới trang sản phẩm</small> </a>
                  </div>
                </div>
                <?php 
                    $con1 = mysqli_connect("localhost","root","","ladyweb");
                    $sql_featuredproduct = "SELECT * FROM sanpham ORDER BY preorder DESC";
                    $list_featuredproduct = mysqli_query($con1,$sql_featuredproduct);
                    echo '<div class="row">';
                    $index = 0;
                    while ($list_featured = mysqli_fetch_array($list_featuredproduct)){
                        $index++;
                        echo '<div class="col-sm-3 text-center box-product">
                        <div class="icons">
                          <a href="#"><i class="fas fa-pen"></i></a>
                          <a href="#"><i class="far fa-eye"></i></a>
                          <a href="#"><i class="far fa-trash-alt"></i></a>
                        </div>
                        <a class="" href="/product-details.html">
                          <img src="../sanpham/uploads/'.$list_featured['hinhanh'].'" class="img-thumbnail" style="width:280px;height: 400px;">
                          <p class="name-product">'.$list_featured['tensanpham'].'</p>
                          <p class="price-product">'.number_format($list_featured['giaban']).' VND</p>
                        </a>
                        </div>';
                        if ($index == 8) break;
                    }
                    echo '</div>';
                ?>    
              </div>
            <div class="row setting-row">
              <h4>Khuyến mại</h4>
              <div class="col-sm-3">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Mã giảm giá</h5>
                    <p class="card-text">Thêm mới và quản lý các chương trình khuyến mại dành cho khách hàng</p>
                    <a href="khuyenmai.html" class="btn btn-lady">Tạo ngay</a>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row setting-row">
              <h4>Cấu hình</h4>
              <div class="col-sm-3">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Quản lý Doanh nghiệp</h5>
                    <p class="card-text">Thêm mới và điều chỉnh thông tin của doanh nghiệp</p>
                    <a href="#" class="btn btn-lady">Xem thêm</a>
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Tài khoản ngân hàng</h5>
                    <p class="card-text">Thêm và điều chỉnh tài khoản ngân hàng cho hóa đơn</p>
                    <a href="#" class="btn btn-lady">Xem thêm</a>
                  </div>
                </div>
              </div>
            </div>
          </main>
        </div>
      </div>
    
      <?php
         include('../container/footer.php');
      ?>   
</body>
</html>
