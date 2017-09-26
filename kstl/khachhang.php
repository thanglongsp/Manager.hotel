<?php
session_start();
?>

<DOCTYPE html>
<html>
<head>
<link href="css/styleservice.css" rel="stylesheet" type="text/css" media="screen,print" />
</head>
<title>Khách hàng</title>
    <meta charset="utf-8">

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
            <a href="khachhang.php" class="dropbtn">Thủ tục</a>
      <div class="dropdown-content">
            <a href="checkinkh.php">Checkin</a>
            <a href="changeroom.php">Đổi phòng</a>
            <a href="usedservice.php">Sử dụng dịch vụ</a>
      </div>
    </li>

    <li class="dropdown">
    <a href="#" class="dropbtn">Quản lý</a>
    <div class="dropdown-content">
      <a href="showsudungdichvu2.php">Sử dụng dịch vụ</a>
      <a href="showsudungphong2.php">Sử dụng phòng</a>
      <a href="showdoiphong2.php">Đổi phòng</a>
      <a href="hoadon.php">Hóa đơn</a>
      </div>
  </li>

      <li style="float:right"><a class="active" href="manager.php">Quay lại</a></li>
</ul>
<div id="main">

<div id = "left">
  <center>
    <form action="timkiemkh.php" method="POST">
  <input type="text" name="search" placeholder="Tìm kiếm...">
  <input type="submit" name="ok" value="Tìm kiếm">

</form>
  </center>

</div>
     <!--Ket noi database-->
    <?php

         include("connection.php") ;
        $sql = "SELECT kh.*  , ngayden FROM khachhang as kh natural join thuephong
                where thanhtoan !='Đã TT' order by makh asc   ";
        $result = pg_query($db, $sql);

        if(!$result)
            {
                 die('Query error: [' . $db->error . ']');
            }
        
    ?>

    <center><h2>DS KHÁCH HÀNG ĐANG LƯU TRÚ</h2></center>
<div style="overflow-x:auto;">
    <table  width="700" border="2">
        <tr>
            <th>STT</th>
            <th>Mã khách hàng</th>
            <th>Họ tên khách hàng</th>
            <th>Địa chỉ</th>
            <th>Số CMND</th>
            <th>Số điện thoại</th>
            <th>Giới tính</th>
            <th>Quốc tịch</th>
            <th>Ngày nhận phòng</th>
            <th>Sửa</th>
            <th>Checkout</th>
        </tr>

    <tbody>
        <?php 
        
            $b = 0 ;
            ;
            while ($row = pg_fetch_array($result)) :
            $b = $b + 1;
              ?>
            <tr>

                <td><?php echo "".$b."" ?></td>
                <td><?php echo $row['makh']; ?></td>
                <td><?php echo $row['hotenkh']; ?></td>
                <td><?php echo $row['dc']; ?></td>
                <td><?php echo $row['cmnd']; ?></td>
                <td><?php echo $row['tel']; ?></td>
                <td><?php echo $row['gioitinh']; ?></td>
                <td><?php echo $row['quoctich']; ?></td>
                <td><?php echo $row['ngayden']; ?></td>
                <td> <a = href='suathongtinkh.php?ID=<?php echo $row['makh']; ?>'>Sửa</a></td>
                <td> <a = href='checkoutkhachhang.php?ID=<?php echo $row['makh']; ?>'>Checkout</a></td>
              

            </tr>
        <?php endwhile; ?>
    </tbody>
    </table>
</div>



</body>
</html>


