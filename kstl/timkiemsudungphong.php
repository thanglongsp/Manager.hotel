<DOCTYPE html>
<html>
<head>
<link href="css/styleservice.css" rel="stylesheet" type="text/css" media="screen,print" />
<style>
  #left{
     width: 10%;
     height: 100%;
     border: none;
     float:left;
     background-color: white;
}
input[type=text] {
    width: 20%;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    background-color: white;
    background-image: url('searchicon.png');
    background-position: 10px 10px; 
    background-repeat: no-repeat;
    padding: 12px 20px 12px 40px;
}


input[type=submit] {
    width: 8%;
    background-color: #333;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

</style>
</head>
<title>Khách hàng - Tìm kiếm sử dụng phòng</title>
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

        <center>
            <form action="timkiemsudungphong.php" method="POST">
              <input type="text" name="search" placeholder="Tìm kiếm...">
              <input type="submit" name="ok" value="Tìm kiếm">
            </form>
        </center>


          <?php           
                  //Neu co ton tai ID
                  if(isset($_REQUEST["ok"]))
                  {
                    $timkiem = addslashes($_POST['search']);
                    $timkiem = strtolower($timkiem);
                    $host        = "host=127.0.0.1";
                     $port        = "port=5432";
                     $dbname      = "dbname=qlkstloff3";
                     $credentials = "user=postgres password=''";
                     $db = pg_connect( "$host $port $dbname $credentials"  );
                       if(!$db)
                           {
                              echo "Error : Unable to open database\n";
                           }//ket noi database

        $sql = "SELECT kh.makh , hotenkh , p.map, tenp , loaip FROM khachhang as kh join sudungphong as sdp on kh.makh = sdp.makh join phong as p on sdp.map = p.map
        WHERE (lower(kh.makh) LIKE '%$timkiem%' OR lower(hotenkh) LIKE '%$timkiem%' OR lower(p.map) LIKE '%$timkiem%' OR lower(tenp) LIKE '%$timkiem%' OR lower(tenp) LIKE '%$timkiem%') order by kh.makh asc";

                    $result = pg_query($db, $sql);

                    if(!$result)
                    {
                         die('Query error: [' . $db->error . ']');
                    }
                     $num = pg_num_rows($result);
                    if($num == 0)
                     echo"<h2>Không tìm thấy kết quả </h2>"  ;                    


                  }

               else
                {
                  header('location: showsudungphong2.php');
                }

                
          ?>

<center><h2>Sử dụng phòng</h2></center>
<div style="overflow-x:auto;">
    <table  width="800" border="2">
        <tr>
            <th>STT</th>
            <th>Mã khách hàng</th>
            <th>Họ tên khách hàng</th>
            <th>Mã phòng</th>
            <th>Kiểu phòng</th>
            <th>Loại Phòng</th>
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

</div>

</body>
</html>
