<?php 
    session_start();
    if (!isset($_SESSION['dangnhap'])){
        header('Location: ../pages/login.php');
    }
?>  
<!DOCTYPE html>
<html lang="en">
<head>
  <title>LADY - Loại sản phẩm</title>
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
                  <li class="breadcrumb-item"><a href="dashboard.html">Quản trị</a></li>
                  <li class="breadcrumb-item"><a href="dashboard.html">Trang chủ</a></li>
                  <li class="breadcrumb-item active"><a href="#">Loại sản phẩm</a></li>
                </ol>
              </nav>
          
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
              <h2 class="h2">Quản lý loại sản phẩm</h2>
              <div>
              <a href="themmoiloaisanpham.php" class="btn btn-lady btn-add mx-3"><i class="fas fa-plus"></i> Thêm mới</a>
                <form method="POST" action="xuly.php" class="float-end">
                    <button type="submit" name="export" class="btn btn-lady btn-add"><i class="far fa-file-excel"></i> Xuất excel</a>
                </form>
              </div>  
              
            </div>
            <form method ="GET" class="d-flex">
              <input class="form-control search-input" name="search" type="search" placeholder="Nhập tên phân loại">
              <button class="btn btn-search" type="submit"><i class="fas fa-search"></i></button>
          </form>
          <div class="row">
            <div class="col-6">
                <small class="float-start text-sm text-muted">Hiển thị kết quả</small> 
            </div>
            <div class="col-6">
               
               <form class="d-flex" method="GET" style=" margin-top: 0;">
                <select class="form-select search-input" name="sort">
                    <option value="new">Loại sản phẩm mới</option>
                    <option value="old">Loại sản phẩm cũ</option>  
                    <option value="show">Loại sản phẩm đang hiển thị</option>  
                    <option value="hide">Loại sản phẩm đã ẩn</option>  
                </select>
                <button class="btn btn-search" type="submit"><i class="fas fa-filter"></i></button>
            </form>
            </div>
        </div>
        <?php
                if (isset($_GET['result'])){
                   if ($_GET['result'] == 'success'){
                       echo '<div class="alert alert-primary text-center" role="alert">
                                Chỉnh sửa thành công!
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
                    <th>Mã phân loại</th>
                    <th>Tên phân loại</th>
                    <th>Slug</th>
                    <th>Danh mục</th>
                    <th>Trạng thái</th>
                    <th width="90px"></th>
                    <th width="90px"></th>
                  </tr>
                </thead>
                <tbody>
                <?php
                   require_once('../config/config.php');

                   if (isset($_GET['search']) && $_GET['search'] != ''){
                     $sql = "SELECT * FROM loaisanpham LEFT JOIN danhmuc ON loaisanpham.madanhmuc = danhmuc.madanhmuc
                       WHERE tenphanloai LIKE '%".$_GET['search']."%'";
                   }
                   else if (isset($_GET['sort']) && $_GET['sort'] != ''){
                     if ($_GET['sort'] == 'new'){
                      $sql = "SELECT * FROM loaisanpham LEFT JOIN danhmuc ON loaisanpham.madanhmuc = danhmuc.madanhmuc ORDER BY idphanloai DESC";
                     }
                     else if ($_GET['sort'] == 'old') {
                      $sql = "SELECT * FROM loaisanpham LEFT JOIN danhmuc ON loaisanpham.madanhmuc = danhmuc.madanhmuc ORDER BY idphanloai ASC";
                     }
                     else if ($_GET['sort'] == 'show') {
                       $sql = "SELECT * FROM loaisanpham LEFT JOIN danhmuc ON loaisanpham.madanhmuc = danhmuc.madanhmuc WHERE loaisanpham.trangthaihienthi ='1'";
                     }
                     else {
                      $sql = "SELECT * FROM loaisanpham LEFT JOIN danhmuc ON loaisanpham.madanhmuc = danhmuc.madanhmuc WHERE loaisanpham.trangthaihienthi ='0'";
                     }
                   }
                   else {
                    $sql = "SELECT * FROM loaisanpham LEFT JOIN danhmuc ON loaisanpham.madanhmuc = danhmuc.madanhmuc";
                   }
                   
                   $listphanloai = executeResult($sql);
                   $index = 1;
                   foreach ($listphanloai as $list){
                        
                        echo '<tr>
                           <td>'.$index++.'</td>
                           <td>'.$list['maphanloai'].'</td>
                           <td>'.$list['tenphanloai'].'</td>
                           <td>'.$list['slug'].'</td>
                           <td>'.$list['tendanhmuc'].'</td>
                           <td>';
                                 if ($list['trangthaihienthi'] == 1) {
                                    echo '<p class="text-success">Hiển thị</p>';
                                 }
                                 else {
                                    echo '<p class="text-danger">Ẩn</p>';
                                 }  
                          echo'</td>
                           <td>
                              <a href="sualoaisanpham.php?query=edit&id='.$list['idphanloai'].'" class="btn btn-lady btn-add btn-sm">
                              <i class="fas fa-edit"></i> Sửa</a>
                           </td>
                           <td><button class="btn btn-lady btn-add btn-sm" type="button" onclick="deleteData('.$list['idphanloai'].')">
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
           function deleteData(idphanloai){
             console.log(idphanloai);
              option = confirm ('Bạn có muốn xóa phân loại sản phẩm này không?');
              if (!option) {
                return;
              }
              $.post('ajax_action.php',{
                'idphanloai':idphanloai
              }, function (data){
                alert(data);
                location.reload();
              })
           }
      </script>  
</body>
</html>
