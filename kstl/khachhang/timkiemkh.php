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
    <form action="timkiemkh.php?search" method="POST">
  <input type="text" name="search" placeholder="Tìm kiếm...">
  <input type="submit" name="ok" value="Tìm kiếm">

</form>

<?php           
        //Neu co ton tai ID
        if(isset($_REQUEST["ok"]))
        {
          $timkiem = addslashes($_POST['search']);
  
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
 

                     $query = "SELECT kh.* FROM khachhang as kh natural join thuephong as tp
                      WHERE (makh LIKE '%$timkiem%' OR hotenkh LIKE '%$timkiem%' OR dc LIKE '%$timkiem%' OR quoctich LIKE '%$timkiem%')
                      AND (thanhtoan !='Đã TT') " ;
                         
                        $rowCollection = pg_query($query);    
                        $num = pg_num_rows($rowCollection);
                        if($num == 0)
                        echo"<h2>Không tìm thấy kết quả </h2>"  ;    
        }    
      }    

      else header('location: khachhang.php')
?>
  </center>

</div>

<center><h2>Kết quả tìm kiếm</h2></center>
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
            <th>Sửa</th>
        </tr>

    <tbody>
        <?php 
        
            $b = 0 ;
            while ($row = pg_fetch_assoc($rowCollection)) :
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
                <td> <a = href='suathongtinkh.php?ID=<?php echo $row['makh']; ?>'>Sửa
                </a>
                </td>

            </tr>
        <?php endwhile; ?>
    </tbody>
</div>

</div>

</body>
</html>