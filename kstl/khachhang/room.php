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
<title>Phòng</title>
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
             <a href="room.php" class="dropbtn">Menu</a>
                <div class="dropdown-content">
                      <a href="kieuphong.php">Kiểu phòng</a>
                      <a href="loaiphong.php">Loại phòng</a>
                      <a href="trangthaiphong.php">Trạng thái</a>
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
              <form action="timkiemphong.php" method="POST">
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


        $sql = "SELECT map, tenp, loaip, (gia||'đ') as gia, trangthai FROM phong order by map asc ";
        $result = pg_query($db, $sql);

        if(!$result)
            {
                 die('Query error: [' . $db->error . ']');
            }

    ?>
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
			            </tr>
			        <?php endwhile; ?>
			    </tbody>
			</table>
		</center>

</div>

</div>

</body>
</html>