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

      <li class="dropdown">
          <li style="float:right;" class="dropdown"> <a class="dropbtn" value ="<?php echo $username;?> "><?php echo $username;?></a>
             <div class="dropdown-content">
                <a href="thongtinkhachhang.php">Thông tin</a>
                <a href="logout.php">Thoát</a>
              </div>
         </li>
      </li>


</ul>

    <div id = "left">

          <form action="timkiemdv.php" method="POST" >
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
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </center>

    </div>

</div>

</body>
</html>