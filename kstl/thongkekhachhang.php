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

              // Số lượng khách hàng đã và đang thuê phòng
              $q6 = "SELECT count(*) as soluong
                      FROM thuephong";

              $r6 = pg_query($q6);

              // Số lượng khách hàng đang lưu trú

              $q7 = "SELECT count(*) as soluong
                    FROM sudungphong";

              $r7 =pg_query($q7);


              // Khách hàng có tổng tiền thanh toán lớn nhất
              $q8 = "SELECT kh.* , (tongtientt||'đ') as tongtientt
                    FROM hoadon as hd natural join khachhang as kh
                    WHERE tongtientt >= all (select tongtientt from hoadon)
                    ";

              $r8 = pg_query($q8);


              // Khách hàng có số tiền đặt cọc nhiều nhất

              $q9 = "SELECT kh.* , (tiendat||'đ') as tiendat
                      FROM thuephong as tp natural join khachhang as kh
                      WHERE tiendat >= all (select tiendat from thuephong)
                      ";

                $r9 = pg_query($q9);


                // Khách hàng sử dụng nhiều dịch vụ nhất

                $q10 = "SELECT kh.*, count(*) as sodichvusudung
                        FROM khachhang as kh natural join sudungdichvu as sddv
                        group by makh, hotenkh
                        having count(*) >= ALL (select count(*) from sudungdichvu group by makh)
                        ";

                $r10 = pg_query($q10);

                // Khách hàng có số tiền dịch vụ lớn nhất
                $q11 = "SELECT kh.* , (tiendv||'đ') as tiendv
                        FROM hoadon as hd natural join khachhang as kh
                        WHERE tiendv >= all (select tiendv from hoadon)
                        ";

                $r11 = pg_query($q11);

                // Khách hàng lưu trú tại khách sạn lâu nhất

                $q12 = "SELECT kh.* , ngayden, ngaydi, songaythue
                        from thuephong as tp natural join khachhang as kh
                        where songaythue >= all (Select songaythue from thuephong)
                        ";

                $r12 = pg_query($q12);

                // Thống kê về giới tính

                $q15 = "SELECT gioitinh, count(*) as soluongkh
                        from khachhang
                        group by gioitinh";

                $r15 = pg_query($q15);


                // Khách hàng góp ý nhiều nhất
                  $q20 = "SELECT kh.*, count(*) as solangopy
                  from khachhang as kh natural join gopy
                  group by kh.makh
                  having count(*) >= all (select count(*) from gopy group by makh)";

                  $r20 = pg_query($q20);




  ?>


<td colspan="2"><div align="center"><strong>SỐ LƯỢNG KHÁCH HÀNG ĐÃ VÀ ĐANG THUÊ PHÒNG</strong></div></td>

<div style="overflow-x:auto;">
    <table  width="700" border="2">
        <tr>
            <th>STT</th>
            <th>Số lượng</th>
        </tr>

    <tbody>
        <?php 
            $b = 0;
            while ($row = pg_fetch_array($r6)) :
              $b = $b + 1 ;
              ?>
            <tr>
                <td><?php echo "$b"; ?></td>
                <td><?php echo $row['soluong']; ?></td>
             

            </tr>
        <?php endwhile; ?>
    </tbody>
    </table>
</div>


<td colspan="2"><div align="center"><strong>SỐ LƯỢNG KHÁCH HÀNG ĐANG THUÊ PHÒNG</strong></div></td>

<div style="overflow-x:auto;">
    <table  width="700" border="2">
        <tr>
            <th>STT</th>
            <th>Số lượng</th>
        </tr>

    <tbody>
        <?php 
            $b = 0;
            while ($row = pg_fetch_array($r7)) :
              $b = $b + 1 ;
              ?>
            <tr>
                <td><?php echo "$b"; ?></td>
                <td><?php echo $row['soluong']; ?></td>
             

            </tr>
        <?php endwhile; ?>
    </tbody>
    </table>
</div>


<td colspan="2"><div align="center"><strong>THÔNG TIN KHÁCH HÀNG CÓ TỔNG TIỀN THANH TOÁN LỚN NHẤT</strong></div></td>
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
            <th>Tổng tiền thanh toán</th>
            <th>Chi tiết</th>
        </tr>

    <tbody>
        <?php 
        
            $b = 0 ;
            ;
            while ($row = pg_fetch_array($r8)) :
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
                <td><?php echo $row['tongtientt']; ?></td>
                <td> <a = href='thongtinluutrukh.php?ID=<?php echo $row['makh']; ?>'>Chi tiết</a></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
    </table>
</div>


<td colspan="2"><div align="center"><strong>THÔNG TIN KHÁCH HÀNG CÓ TỔNG TIỀN CỌC LỚN NHẤT</strong></div></td>
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
            <th>Tiền cọc</th>
            <th>Chi tiết</th>
        </tr>

    <tbody>
        <?php 
        
            $b = 0 ;
            ;
            while ($row = pg_fetch_array($r9)) :
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
                <td><?php echo $row['tiendat']; ?></td>
                <td> <a = href='thongtinluutrukh.php?ID=<?php echo $row['makh']; ?>'>Chi tiết</a></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
    </table>
</div>


<td colspan="2"><div align="center"><strong>THÔNG TIN KHÁCH HÀNG SỬ DỤNG NHIỀU DỊCH VỤ NHẤT</strong></div></td>
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
            <th>Tổng số DV</th>
            <th>Chi tiết</th>
        </tr>

    <tbody>
        <?php 
        
            $b = 0 ;
            ;
            while ($row = pg_fetch_array($r10)) :
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
                <td><?php echo $row['sodichvusudung']; ?></td>
                <td> <a = href='thongtinluutrukh.php?ID=<?php echo $row['makh']; ?>'>Chi tiết</a></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
    </table>
</div>


<td colspan="2"><div align="center"><strong>THÔNG TIN KHÁCH HÀNG CÓ TỔNG TIỀN DỊCH VỤ LỚN NHẤT</strong></div></td>
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
            <th>Tổng tiền DV</th>
            <th>Chi tiết</th>
        </tr>

    <tbody>
        <?php 
        
            $b = 0 ;
            ;
            while ($row = pg_fetch_array($r11)) :
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
                <td><?php echo $row['tiendv']; ?></td>
                <td> <a = href='thongtinluutrukh.php?ID=<?php echo $row['makh']; ?>'>Chi tiết</a></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
    </table>
</div>

<td colspan="2"><div align="center"><strong>THÔNG TIN KHÁCH HÀNG LƯU TRÚ LÂU NHẤT</strong></div></td>
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
            <th>Ngày đến</th>
            <th>Ngày đi</th>
            <th>Số ngày lưu trú</th>
            <th>Chi tiết</th>
        </tr>

    <tbody>
        <?php 
        
            $b = 0 ;
            ;
            while ($row = pg_fetch_array($r12)) :
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
                <td><?php echo $row['ngaydi']; ?></td>
                <td><?php echo $row['songaythue']; ?></td>
                <td> <a = href='thongtinluutrukh.php?ID=<?php echo $row['makh']; ?>'>Chi tiết</a></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
    </table>
</div>

<td colspan="2"><div align="center"><strong>THÔNG TIN VỀ SỐ LƯỢNG GIỚI TÍNH KHÁCH HÀNG </strong></div></td>
<div style="overflow-x:auto;">
    <table  width="700" border="2">
        <tr>
            <th>STT</th>
            <th>Giới tính</th>
            <th>Số lượng</th>
        </tr>

    <tbody>
        <?php 
        
            $b = 0 ;
            ;
            while ($row = pg_fetch_array($r15)) :
            $b = $b + 1;
              ?>
            <tr>

                <td><?php echo "".$b."" ?></td>
                <td><?php echo $row['gioitinh']; ?></td>
                <td><?php echo $row['soluongkh']; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
    </table>
</div>


<td colspan="2"><div align="center"><strong>THÔNG TIN KHÁCH HÀNG GÓP Ý NHIỀU NHẤT</strong></div></td>
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
            <th>Số lần góp ý</th>
            <th>Chi tiết</th>
        </tr>

    <tbody>
        <?php 
        
            $b = 0 ;
            ;
            while ($row = pg_fetch_array($r20)) :
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
                <td><?php echo $row['solangopy']; ?></td>
                <td> <a = href='thongtinluutrukh.php?ID=<?php echo $row['makh']; ?>'>Chi tiết</a></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
    </table>
</div>













  </div>
  </body>
  </html>
