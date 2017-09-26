<?php
session_start();
//tiến hành kiểm tra là người dùng đã đăng nhập hay chưa
//nếu chưa, chuyển hướng người dùng ra lại trang đăng nhập
if (!isset($_SESSION['username'])) {
     header('Location: login.php');
}
$username = $_SESSION['username'];
?>

<DOCTYPE html>
<html>
<head>
<link href="css/manager.css" rel="stylesheet" type="text/css" media="screen,print" />
<title>Khách hàng</title>
    <meta charset="utf-8">
</head>
<body>


        <?php
              include("connection.php");


              $sql = "SELECT kh.*, tp.ngayden,tp.ngaydi,tp.thanhtoan, p.map,p.tenp,p.loaip,(p.gia||'đ') as gia
                       FROM khachhang as kh join thuephong as tp on kh.makh = tp.makh join phong as p on tp.map = p.map
                       WHERE kh.makh = '$username'
                       ";
                      $result = pg_query($db, $sql);

                      if(!$result)
                          {
                               die('Query error: [' . $db->error . ']');
                          }

          ?>


<ul>
          <li class="dropdown">
    <a href="homepage.php" class="dropbtn">Home</a>
    <div class="dropdown-content">
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
   <li><a href="huongdan.php">Hướng dẫn</a></li>

   
             <li class="dropdown">
          <li style="float:right;" class="dropdown"> <a class="dropbtn" value ="<?php echo $username;?> "><?php echo $username;?></a>
          <div class="dropdown-content">
          <a href="thongtinkhachhang.php">Thông tin</a>
          <a href="logout.php">Thoát</a>
          </div>
          </li>
          </li>
</ul>



    <center><h2>Thông tin khách hàng</h2></center>
<div style="overflow-x:auto;">
    <table  width="auto" border="2">
        <tr>
            <th>Mã KH</th>
            <th>Họ tên KH</th>
            <th>Địa chỉ</th>
            <th>CMND</th>
            <th>Số ĐT</th>
            <th>Giới tính</th>
            <th>Quốc tịch</th>
            <th>Ngày đến</th>
            <th>Ngày đi</th>
            <th>Thanh toán</th>
            <th>Mã phòng</th>
            <th>Loại phòng</th>
            <th>Kiểu phòng</th>
            <th>Giá phòng</th>
        </tr>

    <tbody>
        <?php 
        
            while ($row = pg_fetch_row($result)) : ; ?>
            <tr>
                <td><?php echo $row[0]; ?></td>
                <td><?php echo $row[1]; ?></td>
                <td><?php echo $row[2]; ?></td>
                <td><?php echo $row[3]; ?></td>
                <td><?php echo $row[4]; ?></td>
                <td><?php echo $row[5]; ?></td>
                <td><?php echo $row[6]; ?></td>
                <td><?php echo $row[7]; ?></td>
                <td><?php echo $row[8]; ?></td>
                <td><?php echo $row[9]; ?></td>
                <td><?php echo $row[10]; ?></td>
                <td><?php echo $row[11]; ?></td>
                <td><?php echo $row[12]; ?></td>
                <td><?php echo $row[13]; ?></td>

            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
</div>



</body>
</html>
