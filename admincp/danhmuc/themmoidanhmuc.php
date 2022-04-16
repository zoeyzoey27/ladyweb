<?php 
    session_start();
    if (!isset($_SESSION['dangnhap'])){
        header('Location: ../pages/login.php');
    }
?>  
<!DOCTYPE html>
<html lang="en">
<head>
  <title>LADY - Thêm mới danh mục</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                  <li class="breadcrumb-item active"><a href="#">Thêm mới danh mục</a></li>
                </ol>
              </nav>
          
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
              <h2 class="h2">Thêm mới danh mục sản phẩm</h2>
              <a href="danhmuc.php" class="btn btn-lady btn-add"><i class="far fa-list-alt"></i> Xem danh mục</a>
            </div>
            <?php
                if (isset($_GET['result'])){
                   if ($_GET['result'] == 'success'){
                       echo '<div class="alert alert-primary text-center" role="alert">
                                Thêm danh mục thành công!
                             </div>';
                   }
                   else {
                    echo '<div class="alert alert-danger text-center" role="alert">
                      Vui lòng điền đầy đủ thông tin vào các trường!
                 </div>';
                   }
                    
                }
            ?>
            <form method="POST" action="xuly.php" style="margin: 20px 0;">
                <div class="mb-3">
                  <label class="form-label">Mã danh mục</label>
                  <input type="text" name="madanhmuc" class="form-control" placeholder="Mã danh mục" >
                </div>
                <div class="mb-3">
                  <label class="form-label">Tên danh mục</label>
                  <input type="text" name="tendanhmuc" id="slug" class="form-control" placeholder="Tên danh mục" onkeyup="ChangeToSlug()" >
                </div>
                <div class="mb-3">
                  <label class="form-label">Slug</label>
                  <input type="text" name="slug" id="convert_slug" class="form-control" placeholder="slug-danh-muc">
                </div>
                <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
                    <select class="form-select" name="trangthai">
                        <option value="1">Hiển thị</option>
                        <option value="0">Ẩn</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Ảnh hiển thị</label>
                    <input type="file" class="form-control" name="hinhanh">
                </div>
                <button type="submit" name="btnsave" class="btn btn-lady btn-add">Lưu</button>
            </form>
          </main>
        </div>
      </div>
    
      <?php
         include('../container/footer.php');
      ?>  
      
      <script type="text/javascript">
        function ChangeToSlug(){
            var slug;
            //Lấy text từ thẻ input tittle
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
            document.getElementById('convert_slug').value = slug;
        }
    </script>

</body>
</html>
