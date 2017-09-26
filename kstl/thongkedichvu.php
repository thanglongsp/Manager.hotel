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

<style>
  #left{
     width: 40%;
     height: 100%;
     border: none;
     float:left;
     background-color: white;
}
</style>
<title>Quản trị</title>
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
          <a class="dropbtn">Thống kê</a>
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

      include("connection.php");
                // DỊCH VỤ ĐƯỢC SỬ DỤNG NHIỀU NHẤT
          $q1 = "SELECT madv, tendv, (dongia||'đ') as dongia, loaidv,(dongia||'đ') as dongia
                    from sudungdichvu as sddv
                    natural join dichvu as dv
                    group by madv , tendv,dongia, loaidv
                    having count(*) >= all (select count(*)
                    from sudungdichvu as sddv group by madv)";

          $r1 = pg_query($q1);

                // Tổng số lượng sản phẩm của từng loại đc sử dụng
            $q5 = "SELECT  madv, tendv, (dongia||'đ') as dongia, loaidv, sum(soluong) as tongso
                  from sudungdichvu as sddv
                  natural join dichvu as dv
                  group by madv , tendv,dongia, loaidv
                  ORDER BY tongso desc";

            $r5 = pg_query($q5);

?>

<td colspan="2"><div align="center"><strong>DỊCH VỤ ĐƯỢC YÊU THÍCH NHẤT</strong></div></td>

<div style="overflow-x:auto;">
    <table  width="700" border="2">
        <tr>
            <th>STT</th>
            <th>Mã DV</th>
            <th>Tên DV</th>
            <th>Loại DV</th>
            <th>Giá DV</th>
        </tr>

    <tbody>
        <?php 
            $b = 0;
            while ($row = pg_fetch_array($r1)) :
              $b = $b + 1 ;
              ?>
            <tr>
                <td><?php echo "$b"; ?></td>
                <td><?php echo $row['madv']; ?></td>
                <td><?php echo $row['tendv']; ?></td>
                <td><?php echo $row['loaidv']; ?></td>
                <td><?php echo $row['dongia']; ?></td>               

            </tr>
        <?php endwhile; ?>
    </tbody>
    </table>
</div>


<td colspan="2"><div align="center"><strong>TỔNG SỐ LƯỢNG TỪNG LOẠI SẢN PHẨM</strong></div></td>

<div style="overflow-x:auto;">
    <table  width="700" border="2">
        <tr>
            <th>STT</th>
            <th>Mã DV</th>
            <th>Tên DV</th>
            <th>Loại DV</th>
            <th>Giá DV</th>
            <th>Tổng số lượng</th>
        </tr>

    <tbody>
        <?php 
            $b = 0;
            while ($row = pg_fetch_array($r5)) :
              $b = $b + 1 ;
              ?>
            <tr>
                <td><?php echo "$b"; ?></td>
                <td><?php echo $row['madv']; ?></td>
                <td><?php echo $row['tendv']; ?></td>
                <td><?php echo $row['loaidv']; ?></td>
                <td><?php echo $row['dongia']; ?></td>               
                <td><?php echo $row['tongso']; ?></td>  
            </tr>
        <?php endwhile; ?>
    </tbody>
    </table>
</div>


</div>
</body>
</html>


