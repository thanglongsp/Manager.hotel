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

    <form action="timkiemdoiphong.php" method="POST">
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


        $sql = "SELECT dp.makh , kh.hotenkh , dp.ngaydoi ,dp.mapcu , dp.mapmoi FROM doiphong as dp join khachhang as kh on dp.makh = kh.makh ";
        $result = pg_query($db, $sql);

        if(!$result)
            {
                 die('Query error: [' . $db->error . ']');
            }

        
    ?>
    <center><h2>Danh sách đổi phòng</h2></center>

    <div style="overflow-x:auto;">

    <table  width="600" border="2">
        <tr>
            <th>STT</th>
            <th>Mã khách hàng</th>
            <th>Họ tên KH</th>
            <th>Ngày đổi</th>
            <th>Mã phòng cũ</th>
            <th>Mã phòng mới</th>
            
        </tr>

    <tbody>
        <?php 
        
            $b = 0 ;
            ;
            while ($row = pg_fetch_row($result)) :
            $b = $b + 1 ; ; ?>
            <tr>

                <td><?php echo "".$b."" ?></td>
                <td><?php echo $row[0]; ?></td>
                <td><?php echo $row[1]; ?></td>
                <td><?php echo $row[2]; ?></td>
                <td><?php echo $row[3]; ?></td>
                <td><?php echo $row[4]; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
</div>

</body>
</html>

