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
<title>Hóa đơn</title>
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

<center>
    <form action="timkiemthuephong.php?search=" method="POST">
      <input type="text" name="search" placeholder="Tìm kiếm...">
      <input type="submit" name="ok" value="Tìm kiếm">
    </form>
</center>


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


         $sql = "SELECT kh.*, tp.ngayden,tp.ngaydi,tp.thanhtoan, p.map,p.tenp,p.loaip,p.gia
         FROM khachhang as kh join thuephong as tp on kh.makh = tp.makh join phong as p on tp.map = p.map
         WHERE tp.thanhtoan = 'Đã TT'
         order by kh.makh asc  ";
        $result = pg_query($db, $sql);

        if(!$result)
            {
                 die('Query error: [' . $db->error . ']');
            }

        
    ?>
    <center><h2>Danh sách thuê phòng</h2></center>
<div style="overflow-x:auto;">
    <table  width="auto" border="2">
        <tr>
            <th>STT</th>
            <th>Mã KH</th>
            <th>Họ tên KH</th>
            <th>Địa chỉ</th>
            <th>CMND</th>
            <th>Số ĐT</th>
            <th>Giới tính</th>
            <th>Quốc tịch</th>
            <th>Ngày đến</th>
            <th>Ngày đi</th>
            <th>Thanh toán</th>
            <th>Mã phòng</th>
            <th>Loại phòng</th>
            <th>Kiểu phòng</th>
            <th>Giá phòng</th>
            <th>Chi tiết</th>
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
                <td><?php echo $row[5]; ?></td>
                <td><?php echo $row[6]; ?></td>
                <td><?php echo $row[7]; ?></td>
                <td><?php echo $row[8]; ?></td>
                <td><?php echo $row[9]; ?></td>
                <td><?php echo $row[10]; ?></td>
                <td><?php echo $row[11]; ?></td>
                <td><?php echo $row[12]; ?></td>
                <td><?php echo $row[13]; ?></td>
                <td> <a = href='thongtinluutrukh.php?ID=<?php echo $row[0]; ?>'>Chi tiết
                </a>
                </td>

            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
</div>

</body>
</html>

