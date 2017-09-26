<DOCTYPE html>
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
<title>Sử dụng dịch vụ</title>
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
      <a href="showsudungdichvu2.php">Sử dụng dịch vụ</a>
      <a href="showsudungphong2.php">Sử dụng phòng</a>
      <a href="showdoiphong2.php">Đổi phòng</a>
      <a href="hoadon.php">Hóa đơn</a>
      </div>
  </li>

      <li style="float:right"><a class="active" href="manager.php">Quay lại</a></li>
</ul>

<div id="main">


<div id = "left">
  
  <form action="usedservice.php" method="POST">
    <table>
    <tr>
    <td colspan="2"><div align="center"><strong>THÔNG TIN SỬ DỤNG DỊCH VỤ</strong></div></td>
    </tr
    <tr>
    <td>Mã khách hàng:  </td>
    <td><input type="text" name="makh" placeholder="Ví dụ : KH1"> </td>
    </tr>

    <tr>
    <td>Mã dịch vụ :  </td>
    <td><input type="text" name="madv" placeholder="Ví dụ : D101" /> </td>
    </tr>

    <tr>
    <td>Ngày sử dụng :  </td>
    <td><input type="date" name="dateused"/><br /> </td>
    </tr>

    <tr>
    <td>Số lượng :  </td>
    <td><input type="text" name="quantity" placeholder="Ví dụ : 2" /><br /> </td>
    </tr>

    <tr>
    <td colspan="2" align="center"> <input type="submit" name="submit" value="Hoàn tất" onclick="return confirm('Bạn đã chắc chắn')"> </td>
    <td> </td>
    </tr>

    </table>
    </form>

    <?php

      include 'connection.php';

        if(isset($_POST['submit'])){

        $r1 = "SELECT * FROM sudungphong where makh = '".$_POST['makh']."'";
        $q1 = pg_query($r1);
        $num1 = pg_num_rows($q1);

        $r2 = "SELECT * FROM dichvu where madv = '".$_POST['madv']."'";
        $q2 = pg_query($r2);
        $num2 = pg_num_rows($q2);
            if($_POST['makh']==NULL or $_POST['madv']==NULL or $_POST['dateused']==NULL or $_POST['quantity']==NULL ){
                echo 'Xin hãy nhập đủ thông tin';
            }else if ($num1 ==0 ) echo "<h4> Mã KH không tồn tại hoặc đã check out </h4>";
            else if ($num2 ==0 ) echo "<h4> Mã DV không tồn tại </h4>";


            else{
                    $sql=pg_query("INSERT INTO sudungdichvu values('".$_POST['makh']."','".$_POST['madv']."','".$_POST['dateused']."','".$_POST['quantity']."')");
                    
                    if($sql) echo '<h4>Thành công</h4>';
                    else echo 'Xảy ra lỗi';

                }

                
            }

             $sql = "SELECT madv , tendv , loaidv , (dongia||'đ') as dongia FROM dichvu  order by madv";
        $result = pg_query($db, $sql);

        if(!$result)
            {
                 die('Query error: [' . $db->error . ']');
            }

                    $sqlx = "SELECT kh.makh, kh.hotenkh, tp.ngayden, tp.ngaydi
                    FROM khachhang as kh natural join thuephong as tp
                    WHERE thanhtoan != 'Đã TT'
                    ORDER BY kh.makh ASC";
        $resultx = pg_query($db, $sqlx);

        if(!$resultx)
            {
                 die('Query error: [' . $db->error . ']');
            }
    ?>

        <center><h2>DS KHÁCH HÀNG ĐANG LƯU TRÚ</h2></center>
<div style="overflow-x:auto;">
    <table  width="700" border="2">
        <tr>
            <th>STT</th>
            <th>Mã khách hàng</th>
            <th>Họ tên khách hàng</th>
            <th>Ngày đến</th>
            <th>Ngày đi</th>
        </tr>

    <tbody>
        <?php 
        
            $b = 0 ;
            while ($row = pg_fetch_array($resultx)) :
            $b = $b + 1;
              ?>
            <tr>

                <td><?php echo "".$b."" ?></td>
                <td><?php echo $row['makh']; ?></td>
                <td><?php echo $row['hotenkh']; ?></td>
                <td><?php echo $row['ngayden']; ?></td>
                <td><?php echo $row['ngaydi']; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
    </table>
</div>

</div>



    <center><h1> Danh sách dịch vụ</h1></center>
      <div style="overflow-x:auto;">
        <table  width="700" border="2">
            <tr>
                <th>STT </th>
                <th>Mã DV</th>
                <th>Tên DV</th>
                <th>Loại DV</th>
                <th>Đơn giá</th>
            </tr>

        <tbody>
            <?php
                    $b = 0;
                    
                     while ($row = pg_fetch_row($result)):
                    $b = $b + 1;  ?>
                    
                <tr>
                    <td><?php echo "".$b."" ?></td>
                    <td><?php echo $row[0]; ?></td>
                    <td><?php echo $row[1]; ?></td>
                    <td><?php echo $row[2]; ?></td>
                    <td><?php echo $row[3]; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    </div>

</div>


</body>
</html>