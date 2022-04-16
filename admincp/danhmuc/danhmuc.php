<?php 
    session_start();
    if (!isset($_SESSION['dangnhap'])){
        header('Location: ../pages/login.php');
    }
?>  
<!DOCTYPE html>
<html lang="en">
<head>
  <title>LADY - Quản lý danh mục</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
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
                  <li class="breadcrumb-item"><a href="../pages/dashboard.php">Quản trị</a></li>
                  <li class="breadcrumb-item"><a href="../pages/dashboard.php">Trang chủ</a></li>
                  <li class="breadcrumb-item active"><a href="#">Danh mục sản phẩm</a></li>
                </ol>
              </nav>
             
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
              <h2 class="h2">Quản lý danh mục sản phẩm</h2>
              <div>
                <a href="themmoidanhmuc.php" class="btn btn-lady btn-add mx-3"><i class="fas fa-plus"></i> Thêm mới danh mục</a>
                <form method="POST" action="xuly.php" class="float-end">
                    <button type="submit" name="export" class="btn btn-lady btn-add"><i class="far fa-file-excel"></i> Xuất excel</a>
                </form>
              </div>  
            </div>
            <form class="d-flex" method="GET">
              <input class="form-control search-input" name="search" type="search" placeholder="Nhập tên danh mục">
              <button class="btn btn-search" type="submit"><i class="fas fa-search"></i></button>
            </form>
            <div class="row">
                <div class="col-6">
                    <small class="float-start text-sm text-muted">Hiển thị kết quả</small> 
                </div>
                <div class="col-6">
                   
                   <form class="d-flex" method="GET" style=" margin-top: 0;">
                    <select class="form-select search-input" name="sort">
                        <option value="new">Danh mục mới</option>
                        <option value="old">Danh mục cũ</option>
                        <option value="show">Danh mục đang hiển thị</option>
                        <option value="hide">Danh mục đã ẩn</option>
                    </select>
                    <button class="btn btn-search" type="submit"><i class="fas fa-filter"></i></button>
                </form>
                </div>
            </div>
            <?php
            if (isset($_GET['result'])){
              if ($_GET['result'] == 'success'){
                  echo '<div class="alert alert-primary text-center" role="alert">
                           Cập nhật danh mục thành công!
                        </div>';
              }
              else {
               echo '<div class="alert alert-danger text-center" role="alert">
                 Vui lòng điền đầy đủ thông tin vào các trường!
            </div>';
              }
               
           }
           ?>
            <table class="table table-bordered table-hover">
                <thead class="text-center align-middle">
                  <tr>
                    <th>STT</th>
                    <th>Ảnh hiển thị</th>
                    <th>Mã cha</th>
                    <th>Tên danh mục</th>
                    <th>Slug</th>
                    <th>Trạng thái</th>
                    <th width="90px"></th>
                    <th width="90px"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                      require_once('../config/config.php');
                      
                      if (isset($_GET['search']) && $_GET['search'] != ''){
                        $sql = "SELECT * FROM danhmuc WHERE tendanhmuc LIKE '%".$_GET['search']."%'";
                      }
                      if (isset($_GET['sort']) && $_GET['sort'] != ''){
                        if ($_GET['sort'] == 'new'){
                          $sql = "SELECT * FROM danhmuc ORDER BY id DESC";
                        }
                        else if ($_GET['sort'] == 'old') {
                          $sql = "SELECT * FROM danhmuc ORDER BY id ASC";
                        }
                        else if ($_GET['sort'] == 'show') {
                          $sql = "SELECT * FROM danhmuc WHERE trangthai = '1'";
                        }
                        else {
                          $sql = "SELECT * FROM danhmuc WHERE trangthai = '0'";
                        }
                      }
                      else {
                        $sql = "SELECT * FROM danhmuc";
                      }
                      
                      $listdanhmuc = executeResult($sql);
                      $index = 1;
                      foreach ($listdanhmuc as $list){
                          echo '<tr>
                          <td>'.$index++.'</td>
                          <td><img src="uploads/'.$list['anhhienthi'].'" width="100px"></td>
                          <td>'.$list['madanhmuc'].'</td>
                          <td>'.$list['tendanhmuc'].'</td>
                          <td>'.$list['slug'].'</td>
                          <td>';
                                 if ($list['trangthai'] == 1) {
                                    echo '<p class="text-success">Hiển thị</p>';
                                 }
                                 else {
                                    echo '<p class="text-danger">Ẩn</p>';
                                 }  
                          echo'</td>
                          <td>
                              <a href="suadanhmuc.php?query=edit&id='.$list['id'].'" class="btn btn-lady btn-add btn-sm">
                                 <i class="fas fa-edit"></i> Sửa</a>
                          </td>
                          <td><button class="btn btn-lady btn-add btn-sm" type="button" onclick="deleteData('.$list['id'].')">
                               <i class="far fa-trash-alt"></i> Xóa</button>
                          </td>
                        </tr>';
                      }
                  ?>    
                </tbody>
              </table>
          </main>
        </div>
      </div>
    
      <?php
         include('../container/footer.php');
      ?>  
      <script type="text/javascript">
           function deleteData(id){
              option = confirm ('Bạn có muốn xóa danh mục này không?');
              if (!option) {
                return;
              }
              $.post('ajax_action.php',{
                'id':id
              }, function (data){
                alert(data);
                location.reload();
              })
           }
      </script> 
</body>
</html>
