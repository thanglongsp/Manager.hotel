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
<link href="css/styleservice.css" rel="stylesheet" type="text/css" media="screen,print" />
</head>
<title>Khách hàng</title>
    <meta charset="utf-8">

<body>
<div id="main">

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


<center><h1> Sử dụng Dịch Vụ</h1></center>

 <!--Ket noi database-->
    <?php
       $host        = "host=127.0.0.1";
       $port        = "port=5432";
       $dbname      = "dbname=qlkstloff3";
       $credentials = "user=postgres password=''";
       $db = pg_connect( "$host $port $dbname $credentials"  );
           if(!$db)
               {
                  echo "Error : Unable to open database\n";
               }//ket noi database


        $sql = "SELECT kh.makh , hotenkh, dv.madv, tendv, ngaysd, (dongia||'đ'), soluong,((dongia*soluong)||'đ') as thanhtien
        FROM thuephong as tp natural join  khachhang as kh join sudungdichvu as sddv on kh.makh = sddv.makh join dichvu as dv on sddv.madv = dv.madv
        WHERE kh.makh = '$username'
        order by kh.makh asc ";

        $result = pg_query($db, $sql);

        if(!$result)
            {
                 die('Query error: [' . $db->error . ']');
            }

       
    ?>


<div style="overflow-x:auto;">
        <center>
    <table  width="800" border="2">
        <tr>
            <th>STT</th>
            <th>Mã khách hàng</th>
            <th>Họ tên khách hàng</th>
            <th>Mã dịch vụ</th>
            <th>Tên dịch vụ</th>
            <th>Ngày sử dụng </th>
            <th>Đơn giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
        </tr>

    <tbody>
        <?php 
        
            $b = 0 ;
            while ($row = pg_fetch_row($result)) :
            $b = $b + 1 ; ?>
            <tr>

                <td><?php echo "".$b.""   ?></td>
                <td><?php echo $row[0]; ?></td>
                <td><?php echo $row[1]; ?></td>
                <td><?php echo $row[2]; ?></td>
                <td><?php echo $row[3]; ?></td>
                <td><?php echo $row[4]; ?></td>
                <td><?php echo $row[5]; ?></td>
                <td><?php echo $row[6]; ?></td>
                <td><?php echo $row[7]; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</center>
</div>

</body>
</html>