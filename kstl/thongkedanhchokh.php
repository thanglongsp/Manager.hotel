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
          <a href="#" class="dropbtn">Quản lý</a>
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

        include("connection.php") ;

          // THỐNG KÊ DÀNH CHO KHÁCH HÀNG
          // DỊCH VỤ ĐƯỢC SỬ DỤNG NHIỀU NHẤT
          $q1 = "SELECT madv, tendv, dongia, loaidv,(dongia||'đ') as dongia
                    from sudungdichvu as sddv
                    natural join dichvu as dv
                    group by madv , tendv,dongia, loaidv
                    having count(*) >= all (select count(*)
                    from sudungdichvu as sddv group by madv)";

          $r1 = pg_query($q1);


          //Phòng được sử dụng nhiều nhất
          $q2 ="SELECT map, tenp , loaip, (gia||'đ') as gia
                FROM thuephong natural join phong as p
                GROUP BY map ,tenp , loaip, gia
                having count(*) >= all ( select count(*) from thuephong group by map)
                ";

          $r2 = pg_query($q2);

          // Loại phòng được sủ dụng nhiều nhất
          $q3 = "SELECT tenp, loaip , (gia||'đ') as gia
                from thuephong as sdp natural join phong as p
                group by tenp , loaip, gia
                having count (*) >= all (select count(*) from thuephong natural join phong group by tenp, loaip)
                ";

           $r3 = pg_query($q3);

           // Phòng được đổi nhiều nhất
           $q4 = "SELECT doiphong.mapmoi , tenp , loaip, (gia||'đ') as gia
                  from doiphong join phong on doiphong.mapmoi = phong.map
                  group by mapmoi,tenp , loaip, gia
                  having count(*) >= all (select count(*) from doiphong group by mapmoi)
                  ";

            $r4 =pg_query($q4);


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


<td colspan="2"><div align="center"><strong>PHÒNG ĐƯỢC ƯA THÍCH NHẤT</strong></div></td>
    <div style="overflow-x:auto;">
    <center>
        <table  width="600" border="2">
            <tr>
                <th>STT</th>
                <th>Mã Phòng</th>
                <th>Kiểu phòng</th>
                <th>Loại phòng</th>
                <th>Giá phòng</th>
            </tr>

          <tbody>
              <?php 
              
                  $b = 0 ;                
                  while ($row = pg_fetch_array($r2)) :
                  $b = $b + 1 ; ?>
                  <tr>

                      <td><?php echo "".$b."" ?></td>
                      <td><?php echo $row['map']; ?></td>
                      <td><?php echo $row['tenp']; ?></td>
                      <td><?php echo $row['loaip']; ?></td>
                      <td><?php echo $row['gia']; ?></td>
                  </tr>
              <?php endwhile; ?>
          </tbody>
      </table>
    </center>

</div>

<td colspan="2"><div align="center"><strong>LOẠI PHÒNG ĐƯỢC ƯA THÍCH NHẤT</strong></div></td>
    <div style="overflow-x:auto;">
    <center>
        <table  width="600" border="2">
            <tr>
                <th>STT</th>
                <th>Kiểu phòng</th>
                <th>Loại phòng</th>
                <th>Giá phòng</th>
            </tr>

          <tbody>
              <?php 
              
                  $b = 0 ;                
                  while ($row = pg_fetch_array($r3)) :
                  $b = $b + 1 ; ?>
                  <tr>

                      <td><?php echo "".$b."" ?></td>
                      <td><?php echo $row['tenp']; ?></td>
                      <td><?php echo $row['loaip']; ?></td>
                      <td><?php echo $row['gia']; ?></td>
                  </tr>
              <?php endwhile; ?>
          </tbody>
      </table>
    </center>

</div>

<td colspan="2"><div align="center"><strong>LOẠI PHÒNG ĐƯỢC ĐỔI SANG NHIỀU NHẤT</strong></div></td>
    <div style="overflow-x:auto;">
    <center>
        <table  width="600" border="2">
            <tr>
                <th>STT</th>
                <th>Mã phòng</th>
                <th>Kiểu phòng</th>
                <th>Loại phòng</th>
                <th>Giá phòng</th>
            </tr>

          <tbody>
              <?php 
              
                  $b = 0 ;                
                  while ($row = pg_fetch_array($r4)) :
                  $b = $b + 1 ; ?>
                  <tr>

                      <td><?php echo "".$b."" ?></td>
                      <td><?php echo $row['mapmoi']; ?></td>
                      <td><?php echo $row['tenp']; ?></td>
                      <td><?php echo $row['loaip']; ?></td>
                      <td><?php echo $row['gia']; ?></td>
                  </tr>
              <?php endwhile; ?>
          </tbody>
      </table>
    </center>

</div>


</div>