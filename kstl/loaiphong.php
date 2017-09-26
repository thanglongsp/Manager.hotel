<DOCTYPE html>
<html>
<head>
<link href="css/styleservice.css" rel="stylesheet" type="text/css" media="screen,print" />
<style >
  #left{
     width: 47%;
     height: 100%;
     border: none;
     float:left;
     background-color: white;
}

#right{
     width: 47%;
     height:auto;
     border: none;
     background-color: white;
     float:right;
}

</style>

</head>
<title>Loại Phòng</title>
    <meta charset="utf-8">

<body>
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
    <a href="room.php" class="dropbtn">Menu</a>
    <div class="dropdown-content">
      <a href="kieuphong.php">Kiểu phòng</a>
      <a href="loaiphong.php">Loại phòng</a>
      <a href="trangthaiphong.php">Trạng thái</a>
      <a href="addroom.php">Thêm</a>
    </div>
  </li>

  <li style="float:right"><a class="active" href="room.php">Quay lại</a></li>
</ul>

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


        $sql = "SELECT map, tenp, loaip, (gia||'đ') as gia, trangthai FROM phong where loaip = 'Thường' order by map asc ";
        $result = pg_query($db, $sql);

        if(!$result)
            {
                 die('Query error: [' . $db->error . ']');
            }

                    $sqlx = "SELECT map, tenp, loaip, (gia||'đ') as gia, trangthai FROM phong where loaip = 'Vip' order by map asc ";
        $resultx = pg_query($db, $sqlx);

        if(!$resultx)
            {
                 die('Query error: [' . $db->error . ']');
            }
        
    ?>

<div id = "left">
    <center><h2>Phòng thường</h2></center>
    <div style="overflow-x:auto;">
    <center>
        <table  width="600" border="2">
            <tr>
                <th>STT</th>
                <th>Mã Phòng</th>
                <th>Kiểu phòng</th>
                <th>Loại phòng</th>
                <th>Giá phòng</th>
                <th>Trạng thái</th>
                <th>Sửa</th>
            </tr>

          <tbody>
              <?php 
              
                  $b = 0 ;
                  
                  while ($row = pg_fetch_array($result)) :
                  $b = $b + 1 ; ?>
                  <tr>

                      <td><?php echo "".$b."" ?></td>
                      <td><?php echo $row['map']; ?></td>
                      <td><?php echo $row['tenp']; ?></td>
                      <td><?php echo $row['loaip']; ?></td>
                      <td><?php echo $row['gia']; ?></td>
                      <td><?php echo $row['trangthai']; ?></td>
                      <td> <a = href='suaphong.php?ID=<?php echo $row['map']; ?>'>Sửa
                </a>
                </td>
                  </tr>
              <?php endwhile; ?>
          </tbody>
      </table>
    </center>

</div>
</div>

<div id="right">
      <center><h2>Phòng vip</h2></center>
    <div style="overflow-x:auto;">
    <center>
        <table  width="600" border="2">
            <tr>
                <th>STT</th>
                <th>Mã Phòng</th>
                <th>Kiểu phòng</th>
                <th>Loại phòng</th>
                <th>Giá phòng</th>
                <th>Trạng thái</th>
                <th>Sửa</th>
            </tr>

          <tbody>
              <?php 
              
                  $b = 0 ;
                  
                  while ($row = pg_fetch_array($resultx)) :
                  $b = $b + 1 ; ?>
                  <tr>

                      <td><?php echo "".$b."" ?></td>
                      <td><?php echo $row['map']; ?></td>
                      <td><?php echo $row['tenp']; ?></td>
                      <td><?php echo $row['loaip']; ?></td>
                      <td><?php echo $row['gia']; ?></td>
                      <td><?php echo $row['trangthai']; ?></td>
                      <td> <a = href='suaphong.php?ID=<?php echo $row['map']; ?>'>Sửa
                </a>
                </td>
                  </tr>
              <?php endwhile; ?>
          </tbody>
      </table>
    </center>

</div>
</div>

     <!--Ket noi database-->
   



</body>
</html>
