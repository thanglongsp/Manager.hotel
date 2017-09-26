<DOCTYPE html>
<html>
<head>
<link href="css/styleservice.css" rel="stylesheet" type="text/css" media="screen,print" />
</head>
<title>Giả trí-Thư giãn</title>
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
    <a href="service.php" class="dropbtn">Menu</a>
    <div class="dropdown-content">
      <a href="food.php">Đồ ăn</a>
      <a href="drink.php">Đồ uống</a>
      <a href="entertainment.php">Giải trí-Thư giãn</a>
       <a href="addservice.php">Thêm dịch vụ</a>
    </div>
    </li>

  <li style="float:right"><a class="active" href="service.php">Quay lại</a></li>
</ul>

<div id = "left">
  <form action="timkiemdv.php" method="POST">
  <input type="text" name="search" placeholder="Tìm kiếm...">
    <input type="submit" name="ok" value="Tìm kiếm">
</form>
</div>


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


        $sql = "SELECT madv, tendv, loaidv, (dongia||'đ') as dongia FROM dichvu where loaidv ='Giải trí-Thư giãn' order by madv asc ";
        $result = pg_query($db, $sql);

        if(!$result)
            {
                 die('Query error: [' . $db->error . ']');
            }

    ?>
    <center><h2>Giải trí-Thư giãn</h2></center>
    <div style="overflow-x:auto;">
        <center>
            <table  width="600" border="2">
                <tr>
                    <th>STT</th>
                    <th>Mã dịch vụ</th>
                    <th>Tên dịch vụ</th>
                    <th>Loại dịch vụ</th>
                    <th>Đơn giá</th>
                    <th>Sửa</th>
                </tr>

                <tbody>
                    <?php 
                    
                        $b = 0 ;
                        
                        while ($row = pg_fetch_array($result)) :
                        $b = $b + 1 ; ?>
                        <tr>

                            <td><?php echo "".$b."" ?></td>
                            <td><?php echo $row['madv']; ?></td>
                            <td><?php echo $row['tendv']; ?></td>
                            <td><?php echo $row['loaidv'];?></td>
                            <td><?php echo $row['dongia']; ?></td>
                      
                      <td> <a = href='suadichvu.php?ID=<?php echo $row['madv']; ?>'>Sửa
                </a>
                </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </center>

</div>

</div>

</body>
</html>