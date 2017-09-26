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

<div id = "left">
  <form action="timkiemsudungphong.php" method="POST">
  <input type="text" name="search" placeholder="Tìm kiếm...">
    <input type="submit" name="ok" value="Tìm kiếm">
</form>
</div>



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


        $sql = "SELECT kh.makh , hotenkh , ngayden, p.map, p.tenp , p.loaip FROM khachhang as kh natural join sudungphong as sdp natural join phong as p natural join thuephong order by makh asc  ";
        $result = pg_query($db, $sql);

        if(!$result)
            {
                 die('Query error: [' . $db->error . ']');
            }

        
    ?>
    <center><h2>Sử dụng phòng</h2></center>
<div style="overflow-x:auto;">
    <table  width="800" border="2">
        <tr>
            <th>STT</th>
            <th>Mã KH</th>
            <th>Họ tên KH</th>
            <th>Ngày nhận phòng</th>
            <th>Mã phòng</th>
            <th>Kiểu phòng</th>
            <th>Loại Phòng</th>
        </tr>

    <tbody>
        <?php 
        
            $b = 0 ;
            ;
            while ($row = pg_fetch_assoc($result)) :
            $b = $b + 1 ; ; ?>
            <tr>

                <td><?php echo "".$b."" ?></td>
                <td><?php echo $row['makh']; ?></td>
                <td><?php echo $row['hotenkh']; ?></td>
                <td><?php echo $row['ngayden']; ?></td>
                <td><?php echo $row['map']; ?></td>
                <td><?php echo $row['tenp']; ?></td>
                <td><?php echo $row['loaip']; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
</div>

</body>
</html>



