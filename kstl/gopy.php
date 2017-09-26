<?php
session_start();
//tiến hành kiểm tra là người dùng đã đăng nhập hay chưa
//nếu chưa, chuyển hướng người dùng ra lại trang đăng nhập
if (!isset($_SESSION['username'])) {
     header('Location: login.php');
}
$username = $_SESSION['username'];
$hoten = $_SESSION['hoten'];
?>

<DOCTYPE html>
<html>
<head>
<link href="css/styleservice.css" rel="stylesheet" type="text/css" media="screen,print" />

<style>
  #left{
     width: 40%;
     height: 100%;
     border: none;
     float:left;
     background-color: white;
}
</style>
<title>Thống kê</title>
    <meta charset="utf-8">
</head>
<body>

<div id="main">   

<ul>
          <li class="dropdown">
    <a href="manager.php" class="dropbtn">Home</a>
    <div class="dropdown-content">
     <a href="khachhang.php">Khách hàng</a>
      <a href="room.php">Phòng</a>
      <a href="service.php">Dịch vụ</a>
    </div>
    </li>

        <li class="dropdown">
    <a href="thongtinkhachhang.php" class="dropbtn">Thông tin</a>
    <div class="dropdown-content">
      <a href="showsudungdichvu2.php">Sử dụng dịch vụ</a>
      <a href="showsudungphong2.php">Sử dụng phòng</a>
      <a href="showdoiphong2.php">Đổi phòng</a>
      <a href="hoadon.php">Hóa đơn</a>
      </div>
  </li>

   <li><a href="gopy.php">Góp ý - Đánh giá</a></li>
   <li><a href="thongkedanhchokh.php">Thống kê</a></li>

   
             <li class="dropdown">
          <li style="float:right;" class="dropdown"> <a class="dropbtn" value ="<?php echo $hoten;?> "><?php echo $hoten;?></a>
          <div class="dropdown-content">
          <a href="quantri.php">Quản trị</a>
          <a href="logout.php">Thoát</a>
          </div>
          </li>
          </li>
</ul>


 <?php

        include("connection.php") ;

          // THỐNG KÊ DÀNH CHO KHÁCH HÀNG
          // DỊCH VỤ ĐƯỢC SỬ DỤNG NHIỀU NHẤT
          $q1 = "SELECT * FROM gopy ";

          $r1 = pg_query($q1);



?>


<td colspan="2"><div align="center"><strong>ĐÓNG GÓP CỦA KHÁCH HÀNG</strong></div></td>

<div style="overflow-x:auto;">
    <table  width="700" border="2">
        <tr>
            <th>STT</th>
            <th>Mã góp ý</th>
            <th>Mã KH</th>
            <th>Chất lượng phòng</th>
            <th>Chất lượng DV</th>
            <th>Thái độ NV</th>
            <th>Đóng góp khác</th>
        </tr>

    <tbody>
        <?php 
            $b = 0;
            while ($row = pg_fetch_array($r1)) :
              $b = $b + 1 ;
              ?>
            <tr>
                <td><?php echo "$b"; ?></td>
                <td><?php echo $row['magopy']; ?></td>
                <td><?php echo $row['makh']; ?></td>
                <td><?php echo $row['clp']; ?></td>               
                <td><?php echo $row['cldv']; ?></td>
                <td><?php echo $row['tdnv']; ?></td>
                <td><?php echo $row['gopykhac']; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
    </table>
</div>


</div>

</body>
</html>