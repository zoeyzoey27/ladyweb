<!DOCTYPE html>
<html lang="en">
<head>
  <title>LADY - Đăng nhập</title>
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
<style>
    body::after{
      content : "";
      display: block;
      position: absolute;
      top: 0;
      left: 0;
      background-image: linear-gradient(rgba(0, 0, 0, 0.2),rgba(0, 0, 0, 0.5)),url(../../images/background.jpg); 
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
      width: 100%;
      height: 100%;
      opacity : 0.8;
      z-index: -1;
    }
</style>
<body>
    <div class="logo text-center">
        <h2 style="color: #000;">Trang quản trị Lady</h2>
        <small class="blockquote-desc" style="color: #000;">- Hệ thống bán hàng thông minh -</small>
    </div>
    <div class="container container-login">
        <?php
              if (isset($_GET['login'])){
                if ($_GET['login'] == 'error01'){
                    echo '<div class="alert alert-danger text-center" role="alert">
                             Vui lòng điền đầy đủ thông tin đăng nhập vào các trường!
                          </div>';    
                         
                }
                else {
                 echo '<div class="alert alert-danger text-center" role="alert">
                   Email hoặc mật khẩu không đúng!
              </div>';
                }
                 
             }
        ?>
        <form method="POST" autocomplete="off" action="xuly.php">
            <div class="form-group">
              <label style="color: #000;">Địa chỉ Email</label>
              <input type="email" class="form-control" placeholder="Địa chỉ Email" name="email">
            </div>
            <div class="form-group">
              <label style="color: #000;">Mật khẩu</label>
              <input type="password" class="form-control" placeholder="Mật khẩu" name="password">
            </div>
            <a href="" class="float-end reset-password">Quên mật khẩu?</a>
            <button type="submit" name="loginbtn" class="btn btn-lady text-center">Đăng nhập</button>
        </form>
    </div>
   
</body>
</html>
