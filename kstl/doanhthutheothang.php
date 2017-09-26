<?php
session_start();
//tiến hành kiểm tra là người dùng đã đăng nhập hay chưa
//nếu chưa, chuyển hướng người dùng ra lại trang đăng nhập
if (!isset($_SESSION['username'])) {
     header('Location: login.php');
}
else if ($_SESSION['chucvu']!="Giám đốc") header('Location: login.php');
$username = $_SESSION['username'];
$hoten = $_SESSION['hoten'];
?>

<DOCTYPE html>
<html>
<head>
<link href="css/styleservice.css" rel="stylesheet" type="text/css" media="screen,print" />

<title>Thống kê khách hàng</title>
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
          <a class="dropbtn">Quản lý</a>
          <div class="dropdown-content">
            <a href="showsudungdichvu2.php">Sử dụng dịch vụ</a>
            <a href="showsudungphong2.php">Sử dụng phòng</a>
            <a href="showdoiphong2.php">Đổi phòng</a>
            <a href="hoadon.php">Hóa đơn</a>
            </div>
        </li>


             <li class="dropdown">
          <a  class="dropbtn">Thống kê</a>
          <div class="dropdown-content">
            <a href="thongkedanhchokh.php">Dành cho khách hàng</a>
            <a href="thongkedichvu.php">Dịch vụ</a>
            <a href="thongkekhachhang.php">Khách hàng</a>
            <a href="thongkethoidiem.php">Thời điểm</a>
            <a href="doanhthutheothang.php">Doanh thu theo tháng</a> 
            </div>
        </li>
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

         $q1 = "DELETE from thongke2";

                  $r1 = pg_query($q1);

                  if($r1)
                  {


                 $q2 = "INSERT INTO thongke2
                        (thang,makh)
                        select substring(ngaytt from 1 for 7),makh
                        from hoadon
                        order by makh";

                  $r2 = pg_query($q2);
                  if($r2)

                  {

                $q3 = "SELECT thang , ((sum(tienp)+ sum(tiendv) +sum(tienthue))||'đ') as doanhthu
                        from hoadon natural join thongke2
                        group by thang
                        order by thang";



                $r3 = pg_query($q3);

              }

            }



?>

<td colspan="2"><div align="center"><strong>DOANH THU THEO THÁNG</strong></div></td>

<div style="overflow-x:auto;">
    <table  width="700" border="2">
        <tr>
            <th>STT</th>
            <th>Tháng</th>
            <th>DOANH THU</th>
        </tr>

    <tbody>
        <?php 
            $b = 0;
            while ($row = pg_fetch_array($r3)) :
              $b = $b + 1 ;
              ?>
            <tr>
                <td><?php echo "$b"; ?></td>
                <td><?php echo $row['thang']; ?></td>
                <td><?php echo $row['doanhthu']; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
    </table>
</div>


</div>
</body>
</html>
</DOCTYPE>
