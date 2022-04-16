<?php 
    session_start();
    if (!isset($_SESSION['dangnhap'])){
        header('Location: ../pages/login.php');
    }
?>  
<!DOCTYPE html>
<html lang="en">
<head>
  <title>LADY - Chi tiết sản phẩm</title>
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
    <div class="container mt-3">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="../pages/dashboard.php">Quản trị</a></li>
                  <li class="breadcrumb-item"><a href="../pages/dashboard.php">Trang chủ</a></li>
                  <li class="breadcrumb-item active"><a href="#">Chi tiết sản phẩm</a></li>
                </ol>
    </nav>
        <form class="d-flex">
            <input class="form-control search-input" type="search" placeholder="Nhập nội dung tìm kiếm">
            <button class="btn btn-search" type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>

    <?php
            require_once('../config/config.php');
            if (isset($_GET['id']) && $_GET['id'] != ''){
                $sql = "SELECT * FROM sanpham WHERE idsanpham = ".$_GET['id'];
                $list = executeResult($sql);
                $row = $list[0];
        ?>   
    <div class="container">
        <hr/>
        
        <div class="row">
            <div class="col-sm-4">
                <img src="uploads/<?php echo $row['hinhanh'] ?>" class="img-thumbnail img-current" id="imageBox">
            </div>
            <div class="col-sm-2">
                <img src="uploads/<?php echo $row['anhchitiet1'] ?>" class="img-thumbnail img-sm" onclick="myFunction(this)">
                <img src="uploads/<?php echo $row['anhchitiet2'] ?>" class="img-thumbnail img-sm" onclick="myFunction(this)">
                <img src="uploads/<?php echo $row['anhchitiet3'] ?>" class="img-thumbnail img-sm" onclick="myFunction(this)">
                <img src="uploads/<?php echo $row['anhchitiet4'] ?>" class="img-thumbnail img-sm" onclick="myFunction(this)">
                
            </div>
            <div class="col-sm-6 list-group details-box">
                <span class="product-name"><?php echo $row['tensanpham'] ?></span>
                <span class="product-price"><?php echo number_format($row['giaban']) ?> VND</span>
                <?php
                    if (isset($_GET['msp']) && strlen(strstr($_GET['msp'], 'DTP')) > 0){
                        echo '<label>Size:</label>
                        <ul class="list-group list-group-horizontal">
                            <li class="list-group-item size-choice">S</li>
                            <li class="list-group-item size-choice">M</li>
                            <li class="list-group-item size-choice">L</li>
                            <li class="list-group-item size-choice">XL</li>
                        </ul>';
                    }
                ?>
                <label class="my-2">Số lượng:</label>
                <input class="list-group-item mb-3" value="<?php echo $row['soluong'] ?>" readonly>
                <div class="content">
                    <p><?php echo $row['mota'] ?></p>
                </div>
                <a href="suasanpham.php?query=edit&id=<?php echo $row['idsanpham'] ?>" class="btn btn-lady btn-sm float-start"><i class="fas fa-edit icon-item"></i>Chỉnh sửa</a>
            </div>
            
        </div>
        <hr/>
          
    </div>
    
    <div class="container">
        <h4>Sản phẩm khác</h4>
           
        <div class="row">
            <?php
                $con = mysqli_connect("localhost","root","","ladyweb"); 
                $sql_product= "SELECT * FROM sanpham WHERE maphanloai = '".$row['maphanloai']."' AND idsanpham NOT IN ('".$row['idsanpham']."')";
                $result_list = mysqli_query ($con,$sql_product);
                $index = 0;
                while ($list = mysqli_fetch_array($result_list)){
                    $index ++;
                    echo ' <div class="col-sm-3 text-center box-product">
                               <img src="uploads/'.$list['hinhanh'].'" class="img-thumbnail">
                               <p class="name-product">'.$list['tensanpham'].'</p>
                               <p class="price-product">'.number_format($list['giaban']).' VND</p>
                           </div>';
                    if ($index == 4) break;       
                }
            ?>    
        </div>
    </div>
    <?php
        }
     ?> 
    <?php
       include('../container/footer.php');
    ?>
    <script type="text/javascript">
        function myFunction(smallImg){
            var fullImg = document.getElementById("imageBox");
            fullImg.src = smallImg.src;
        }
    </script>    
</body>
</html>
