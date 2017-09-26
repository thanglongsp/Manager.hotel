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

 $q21 = "DELETE from thongke";

                  $r21 = pg_query($q21);

                  if($r21)
                  {
                    // Chèn dữ liệu từ bảng thuephong và bảng sudungdichvu

                 $q22 = "INSERT INTO thongke
                (thangden,makh,thangdi,thangsddv)
                select substring(ngayden from 1 for 7), tp.makh,substring(ngaydi from 1 for 7),
                substring(ngaysd from 1 for 7)
                from thuephong as tp left join sudungdichvu as sddv on tp.makh = sddv.makh
                order by makh";

                  $r22 = pg_query($q22);
                  if($r22)

                  {
              //-- Thống kê thời điểm(tháng) mà khách hàng đến đông nhất

                $q23 = "SELECT thangden , count(distinct makh) as soluong
                from thongke
                group by thangden
                order by soluong";

                //having count(*) >= all (select count(distinct makh) from thongke group by thangden)";



                $r23 = pg_query($q23);

                //-- thống kê thời điểm( tháng) mà khách hàng đi nhiều nhất
                $q24 = "SELECT thangdi , count(distinct makh) as soluong
                from thongke
                group by thangdi
                order by soluong";
                //having count(*) >= all (select count(distinct makh) from thongke group by thangdi)";

                $r24 = pg_query($q24);


                //-- Thống kê thời điểm (tháng) mà khách hàng sử dụng dịch vụ nhiều nhất

                $q25 = "SELECT thangsddv , count(distinct makh) as soluong
                from thongke
                where thangsddv !=''
                group by thangsddv
                order by soluong";
                //having count(*) >= all (select count(distinct makh) from thongke group by thangsddv)";

                $r25 = pg_query($q25);


                  }

                  }


?>



<td colspan="2"><div align="center"><strong>LƯỢNG KHÁCH ĐẾN</strong></div></td>

<div style="overflow-x:auto;">
    <table  width="700" border="2">
        <tr>
            <th>STT</th>
            <th>Tháng</th>
            <th>Số lượng khách</th>
        </tr>

    <tbody>
        <?php 
            $b = 0;
            while ($row = pg_fetch_array($r23)) :
              $b = $b + 1 ;
              ?>
            <tr>
                <td><?php echo "$b"; ?></td>
                <td><?php echo $row['thangden']; ?></td>
                <td><?php echo $row['soluong']; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
    </table>
</div>

<td colspan="2"><div align="center"><strong>LƯỢNG KHÁCH ĐI</strong></div></td>

<div style="overflow-x:auto;">
    <table  width="700" border="2">
        <tr>
            <th>STT</th>
            <th>Tháng</th>
            <th>Số lượng khách</th>
        </tr>

    <tbody>
        <?php 
            $b = 0;
            while ($row = pg_fetch_array($r24)) :
              $b = $b + 1 ;
              ?>
            <tr>
                <td><?php echo "$b"; ?></td>
                <td><?php echo $row['thangdi']; ?></td>
                <td><?php echo $row['soluong']; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
    </table>
</div>


<td colspan="2"><div align="center"><strong>LƯỢNG KHÁCH SỬ DỤNG DỊCH VỤ</strong></div></td>

<div style="overflow-x:auto;">
    <table  width="700" border="2">
        <tr>
            <th>STT</th>
            <th>Tháng</th>
            <th>Số lượng khách</th>
        </tr>

    <tbody>
        <?php 
            $b = 0;
            while ($row = pg_fetch_array($r25)) :
              $b = $b + 1 ;
              ?>
            <tr>
                <td><?php echo "$b"; ?></td>
                <td><?php echo $row['thangsddv']; ?></td>
                <td><?php echo $row['soluong']; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
    </table>
</div>







</div>
</body>
</html>