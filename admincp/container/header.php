<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="../pages/dashboard.php">Lady</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link nav-title text-dark" aria-current="page" href="../pages/dashboard.php">Trang chủ</a>
            </li>
              <li class="nav-item dropdown">
                  <a class="nav-link nav-title dropdown-toggle text-dark" data-bs-toggle="dropdown" href="">Sản phẩm</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="../danhmuc/danhmuc.php">Quản lý danh mục cha</a></li>
                    <li><a class="dropdown-item" href="../loaisanpham/loaisanpham.php">Quản lý phân loại sản phẩm</a></li>
                    <li><a class="dropdown-item" href="../sanpham/sanpham.php">Quản lý sản phẩm</a></li>
                  </ul>
              </li>
              <li class="nav-item">
                  <a class="nav-link nav-title text-dark" href="#">Đơn hàng</a>
              </li>
              <li class="nav-item">
                <a class="nav-link nav-title text-dark" href="#">Vận chuyển</a>
              </li>
              <li class="nav-item">
                <a class="nav-link nav-title text-dark" href="#">Thành viên</a>
              </li>
        </ul>
        <ul class="nav justify-content-end">
            <?php
                 if (isset($_GET['action'])=='dangxuat'){
                     unset($_SESSION['dangnhap']);
                     header('Location: ../pages/login.php');
                 } 
                 if (isset($_SESSION['dangnhap'])){
                     echo '<li class="nav-item"><a class="nav-link" href=""><i class="fas fa-user-circle icon-item"></i>'.$_SESSION['dangnhap'].'</a></li>';
                 }
            ?>   
            <li class="nav-item">
            <a class="nav-link" href="../pages/dashboard.php?action=dangxuat"><i class="fas fa-sign-out-alt icon-item"></i>Đăng xuất</a>
            </li>
        </ul>
        
        </div>
        
    </div>
</nav>