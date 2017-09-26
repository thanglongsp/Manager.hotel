<?php
session_start();
//tiến hành kiểm tra là người dùng đã đăng nhập hay chưa
//nếu chưa, chuyển hướng người dùng ra lại trang đăng nhập
if (!isset($_SESSION['username'])) {
     header('Location: login.php');
}
$username = $_SESSION['username'];
$hoten = $_SESSION['hoten'];
?>
<DOCTYPE html>
<?php ob_start() ?>
<html>
<head>
<link href="css/styleservice.css" rel="stylesheet" type="text/css" media="screen,print" />
<style>
    #left{
     width: 60%;
     height: 100%;
     border: none;
     float:left;
     background-color: white;
}
</style>
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
            <a href="usedservice.php">Sử dụng DV</a>
      </div>
    </li>

   <li class="dropdown">
    <a href="#" class="dropbtn">Quản lý</a>
    <div class="dropdown-content">
      <a href="showsudungdichvu2.php">Sử dụng DV</a>
      <a href="showsudungphong2.php">Sử dụng phòng</a>
      <a href="showdoiphong2.php">Đổi phòng</a>
      <a href="hoadon.php">Hóa đơn</a>
      </div>
  </li>


      <li style="float:right"><a class="active" href="manager.php">Quay lại</a></li>
</ul>

<div id = "left">
    <form action="changeroom.php?flag=1" method="POST">
    <table>

    <tr>
    <td colspan="2"><div align="center"><strong>THÔNG TIN THAY ĐỔI</strong></div></td>
    </tr>

    <tr>
    <td>Mã khách hàng:  </td>
    <td><input type="text" name="makh" placeholder="Ví dụ : KH1"/> </td>
    </tr>

    <tr>
    <td>Ngày đổi :  </td>
    <td><input type="date" name="changedate" /> </td>
    </tr>

    <tr>
    <td>Mã phòng cũ :  </td>
    <td><input type="text" name="mapcu" placeholder="Ví dụ : 101" /></td>
    </tr>

    <tr>
    <td>Mã phòng mới :  </td>
    <td><input type="text" name="mapmoi" placeholder="Ví dụ : 102" /></td>
    </tr>

    <tr>
    <td colspan="2" align="center"> <input type="submit" name="submit" value="Hoàn tất" onclick="return confirm('Bạn đã chắc chắn')"> </td>
    <td> </td>
    </tr>

    </table>
    </form>

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


          if (isset($_REQUEST["flag"])) 
          {
           if (isset($_POST["submit"]))
           {
                    $q1 = "SELECT makh from sudungphong where makh = '".$_POST["makh"]."'";
                    $r1 = pg_query($q1);
                    $num1 = pg_num_rows($r1);

                    $q2 = "SELECT map from sudungphong where map = '".$_POST["mapcu"]."' and makh = '".$_POST["makh"]."' ";
                    $r2 = pg_query($q2);
                    $num2 = pg_num_rows($r2);

                    $q3 = "SELECT map from phong where trangthai = 'Trống' AND map = '".$_POST["mapmoi"]."' ";
                    $r3 = pg_query($q3);
                    $num3 = pg_num_rows($r3);


            if($_POST['makh']==NULL or $_POST['changedate']==NULL or $_POST['mapcu']==NULL or $_POST['mapmoi']==NULL)
                {
                    echo 'Mời bạn nhập đầy đủ thông tin';
                }
            else if ($num1 == 0) echo "Mã KH không tồn tại, vui lòng nhập lại Mã KH";
            else if ($num2 == 0) echo "Sai mã phòng cũ, vui lòng nhập lại mã phòng cũ";
            else if ($num3 == 0) echo "Mã phòng mới không tồn tại hoặc đã kín, vui lòng nhập lại mã phòng mới";

            else {
                    $sql=pg_query("INSERT INTO doiphong values('".$_POST['makh']."','".$_POST['changedate']."','".$_POST['mapcu']."','".$_POST['mapmoi']."')");
                    

                    $sql2=pg_query("UPDATE phong SET trangthai = 'Trống' WHERE map = '".$_POST['mapcu']."' ");
                    $sql3=pg_query("UPDATE phong SET trangthai = 'Kín' WHERE map = '".$_POST['mapmoi']."' ");

                    $map = pg_escape_string($_POST['mapmoi']);
                    $sql4=pg_query("UPDATE sudungphong SET map = $map  WHERE makh = '".$_POST['makh']."'  ");
                    $sql5=pg_query("UPDATE thuephong SET map = $map  WHERE makh = '".$_POST['makh']."'  ");

                     if($sql && $sql2 && $sql3 && $sql4 && $sql5)
                    {
                        echo "<h4>Thành công</h4>";
                    }
                    else echo 'Xảy ra lỗi, vui lòng kiểm tra lại';

                }
            }


          }

                    $sql = "SELECT * FROM phong where trangthai = 'Trống' order by map asc ";
        $result2 = pg_query($db, $sql);

        if(!$result2)
            {
                 die('Query error: [' . $db->error . ']');
            }
        
    ?>

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

                 $sql = "SELECT kh.makh , hotenkh , p.map, tenp , loaip, ngayden , ngaydi FROM khachhang as kh natural join sudungphong as sdp natural join phong as p natural join thuephong order by kh.makh asc ";
        $result = pg_query($db, $sql);

        if(!$result)
            {
                 die('Query error: [' . $db->error . ']');
            }

               ?>


        <center><h2> Danh sách sử dụng phòng </h2></center>
 <div style="overflow-x:auto;">
    <center>
        <table  width="800" border="1">
        <tr>
            <th>STT</th>
            <th>Mã khách hàng</th>
            <th>Họ tên khách hàng</th>
            <th>Mã phòng</th>
            <th>Kiểu phòng</th>
            <th>Loại Phòng</th>
            <th>Ngày đến</th>
            <th>Ngày đi</th>
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
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
</center>
</div>

</div>

 <!--Ket noi database-->
    
<!--End Xu ly form-->    

<!--HTML-->




<center><h2> Thông tin các phòng trống</h2></center>
 <div style="overflow-x:auto;">
    <center>
    <table  width="500" border="1">
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
            ;
            while ($row = pg_fetch_row($result2)) :
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
</center>
</div>

<!--End HTML-->
</body>
</html>