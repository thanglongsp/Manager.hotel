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
<title>Dịch vụ</title>
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
    <a href="service.php" class="dropbtn">Menu</a>
    <div class="dropdown-content">
      <a href="food.php">Đồ ăn</a>
      <a href="drink.php">Đồ uống</a>
      <a href="entertainment.php">Giải trí-Thư giãn</a>
    </div>
    </li>

  <li style="float:right"><a class="active" href="homepage.php">Quay lại</a></li>
</ul>

<div id="main">

<div id = "left">
  <center>
    <form action="timkiemdv.php?search" method="POST">
  <input type="text" name="search" placeholder="Tìm kiếm...">
  <input type="submit" name="ok" value="Tìm kiếm">

</form>
  </center>

</div>

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
 

            $query = "SELECT * 
                      FROM dichvu
                      WHERE lower(madv) LIKE '%$timkiem%' OR  lower(tendv) LIKE '%$timkiem%' OR  lower(loaidv) LIKE '%$timkiem%'
                      order by madv asc" ;
                         
                        $result = pg_query($query);    
                        $num = pg_num_rows($result);
                        if($num == 0)
                        echo"<h2>Không tìm thấy kết quả </h2>"  ;    
        }    

      }

      else
      {
        header('location:service.php');
      }

      
?>
<center><h2>Kết quả tìm kiếm</h2></center>
<div style="overflow-x:auto;">
    <table  width="700" border="2">
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
            while ($row = pg_fetch_assoc($result)) :
            $b = $b + 1;
              ?>
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
</div>

</div>

</body>
</html>