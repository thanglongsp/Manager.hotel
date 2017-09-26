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


      <li style="float:right"><a class="active" href="khachhang.php">Quay lại</a></li>
</ul>
<div id="main">

<div id = "left">
  <center>
    <form action="timkiemsddv.php" method="POST">
  <input type="text" name="search" placeholder="Tìm kiếm...">
  <input type="submit" name="ok" value="Tìm kiếm">

</form>
  </center>

</div>

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
        WHERE thanhtoan != 'Đã TT'
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