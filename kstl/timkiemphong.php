<DOCTYPE html>
<html>
<head>
<link href="css/styleservice.css" rel="stylesheet" type="text/css" media="screen,print" />

</head>
<title>Phòng</title>
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

  <li class="dropdown">
    <a href="room.php" class="dropbtn">Quản lý</a>
    <div class="dropdown-content">
      <a href="showsudungphong.php">Sử dụng phòng</a>
      <a href="showdoiphong.php">Đổi phòng</a>
      <a href="showthuephong.php">Thuê phòng</a>
  </li>

  <li style="float:right"><a class="active" href="manager.php">Quay lại</a></li>
</ul>

<div id = "left">
  <form action="timkiemphong.php" method="POST">
  <input type="text" name="search" placeholder="Tìm kiếm...">
    <input type="submit" name="ok" value="Tìm kiếm">
</form>
<?php           
        //Neu co ton tai ID
        if(isset($_REQUEST["ok"]))
        {
          $timkiem = addslashes($_POST['search']);
           $timkiem = strtolower($timkiem);
        {
        $host        = "host=127.0.0.1";
         $port        = "port=5432";
         $dbname      = "dbname=qlkstloff3";
         $credentials = "user=postgres password=''";
         $db = pg_connect( "$host $port $dbname $credentials"  );
           if(!$db)
               {
                  echo "Error : Unable to open database\n";
               }//ket noi database
 

            $query = "SELECT map, tenp, loaip , (gia||'đ') as gia , trangthai
                      FROM phong
                      WHERE lower(map) LIKE '%$timkiem%' OR lower(tenp) LIKE '%$timkiem%' OR lower(loaip) LIKE '%$timkiem%' OR lower(trangthai) LIKE '%$timkiem%'
                      order by map asc" ;
                         
                        $result = pg_query($query);    
                        $num = pg_num_rows($result);
                        if($num == 0)
                        echo"<h3>Không tìm thấy kết quả </h3>"  ;    
        }    

      }    

      else
      {
        header('location: room.php');
      }
?>
</div>

 <center><h2>Danh sách phòng</h2></center>
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