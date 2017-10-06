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


        $sql = "SELECT * FROM phong order by map asc ";
        $result = pg_query($db, $sql);
        if(!$result)
            {
                 die('Query error: [' . $db->error . ']');
            }

    ?>

    <div id="left">
    <form id="form1" name="form1" action="addroom.php"  method="POST">
    <tr>
    <td colspan="2"><div align="center"><strong>THÔNG TIN PHÒNG</strong></div></td>
    </tr>

    <tr>
    <td>Mã Phòng:  </td>
    <td><input type="text" name="map" placeholder="XXXX" /> </td>
    </tr>

    <tr>
      <td>Kiểu phòng : </td>
          <select id="tenp" name="tenp">
            <option value="Đơn">Đơn</option>
            <option value="Đôi">Đôi</option>
          </select>
    </tr>
       <tr>
      <td>Loại : </td>
          <select id="loaip" name="loaip">
            <option value="Thường">Thường</option>
            <option value="Vip">Vip</option>
          </select>
    </tr>

    <tr>
      <td>Giá tiền : </td>
          <select id="gia" name="gia">
            <option value="200000">200.000$</option>
            <option value="300000">300.000$</option>
            <option value="350000">350.000$</option>
            <option value="500000">500.000$</option>
          </select>
    </tr>
    <td>Trạng thái:  </td>
    <td><input type="text" name="trangthai" readonly="true" value="Trống" /> </td>
    </tr>

    <tr>
    <td  colspan="2" align="center"> <input type="submit" name="submit"  value="HOÀN TẤT" onclick="return confirm('Bạn đã chắc chắn')"> </td>
    </tr>

    </form>

       <?php
            include 'connection.php';

           if (isset($_POST["submit"]))
           {
                $map = $_POST['map'];

                $sql = "select map from phong where map = '$map'";
                $query = pg_query($db,$sql);
                $num_rows = pg_num_rows($query);

            if ($num_rows!=0)
                {
                    echo 'Mã phòng đã tồn tại, mời bạn nhập lại mã phòng';
                }

            else if($_POST['map']==NULL or $_POST['tenp']==NULL or $_POST['loaip']==NULL or $_POST['gia']==NULL)
                {
                    echo 'Mời bạn nhập đầy đủ thông tin';
                }

            else {
                    $sql=pg_query("INSERT INTO phong values('".$_POST['map']."','".$_POST['tenp']."','".$_POST['loaip']."','".$_POST['trangthai']."','".$_POST['gia']."')");
                    
                    if($sql) echo 'THÀNH CÔNG';
                    else echo 'sql xay ra loi';

                }

            }

        $sql = "SELECT map , tenp , loaip, (gia||'đ') as gia , trangthai FROM phong order by map asc ";
        $result = pg_query($db, $sql);

        if(!$result)
            {
                 die('Query error: [' . $db->error . ']');
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
            </tr>

          <tbody>
              <?php 
              
                  $b = 0 ;
                  
                  while ($row = pg_fetch_array($result)) : $b = $b + 1 ; ?>
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