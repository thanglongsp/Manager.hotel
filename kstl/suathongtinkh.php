<?php ob_start() ?>

<DOCTYPE html>
<?php ob_start() ?>
<html>
<head>
<link href="css/styleservice.css" rel="stylesheet" type="text/css" media="screen,print" />
<style>
  #left{
     width: 30%;
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
            <a href="khachhang.php" class="dropbtn">Menu</a>
      <div class="dropdown-content">
            <a href="checkinkh.php">Checkin</a>
            <a href="checkoutkh.php">Checkout</a>
            <a href="changeroom.php">Đổi phòng</a>
            <a href="usedservice.php">Sử dụng dịch vụ</a>
      </div>
    </li>

    <li class="dropdown">
    <a href="#" class="dropbtn">Thống kê</a>
    <div class="dropdown-content">
      <a href="thongkekhachhang.php">Địa chỉ</a>
      <a href="#">Quốc tịch</a>
      <a href="showsudungdichvu2.php">Sử dụng dịch vụ</a>
      <a href="showsudungphong2.php">Sử dụng phòng</a>
      <a href="showdoiphong2.php">Đổi phòng</a>
      <a href="showthuephong2.php">Thuê phòng</a>
      </div>
  </li>

      <li style="float:right"><a class="active" href="manager.php">Quay lại</a></li>
</ul>

<?php           
        //Neu co ton tai ID
        if(isset($_REQUEST["ID"]))
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
 
            if($db)
            {
                
                    if(isset($_REQUEST['ID']))
                    {
                        $query = "SELECT * FROM khachhang WHERE makh = '".$_REQUEST['ID']. "'" ;
                         
                        $rowCollection = pg_query($query);
                        while($row = pg_fetch_array($rowCollection))
                        {
                            $hotenkh = $row["hotenkh"];
                            $dc = $row["dc"];
                            $cmnd = $row["cmnd"];
                            $tel = $row["tel"];
                            $gioitinh = $row["gioitinh"];
                            $quoctich = $row["quoctich"];

                        }
                    }                  
                }
            else
            {      
                die("Khong ket noi duoc database: ". pg_error());
            }
 
            pg_close($db);
        }      
?>

<div id = "left">

      <form id="form1" name="form1" action="suathongtinkh.php?flag=1&ID=<?= $_REQUEST['ID'] ?>"  method="POST">

    <tr>
    <td colspan="2"><div align="center"><strong>FORM SỬA THÔNG TIN KHÁCH HÀNG</strong></div></td>
    </tr>

    <tr>
    <td>Mã khách hàng:  </td>
    <td><input type="text" name="makh" readonly="true" value="<?php echo $_REQUEST['ID'];?> "/> </td>
    </tr>

    <tr>
    <td>Họ tên :  </td>
    <td><input type="text" name="hotenkh" value="<?php echo $hotenkh;?> "/> </td>
    </tr>

    <tr>
      <td>Địa chỉ : </td>
          <select id="dc" name="dc">
            <option value="Hà Nội">Hà Nội</option>
            <option value="TP Hồ Chí Minh">TP Hồ Chí Minh</option>
            <option value="Quảng Ninh">Quảng Ninh</option>
            <option value="Hải Phòng">Hải Phòng</option>
            <option value="Đà Nẵng">Đà Nẵng</option>
            <option value="Cần Thơ">Cần Thơ</option>
            <option value="Nam Định">Nam Định</option>
            <option value="Thái Bình">Thái Bình</option>
            <option value="Nghệ An">Nghệ An</option>
            <option value="Thanh Hóa">Thanh Hóa</option>
            <option value="Bắc Ninh">Bắc Ninh</option>
            <option value="Ninh Bình">Ninh Bình</option>
            <option value="Khác">Khác</option>
          </select>
    </tr>

    <tr>
    <td>Số CMND :  </td>
    <td><input type="text" name="cmnd" value="<?php echo $cmnd;?> "/> </td>
    </tr>

     <tr>
    <td>Số điện thoại :  </td>
    <td><input type="text" name="tel" value="<?php echo $tel;?> "/> </td>
    </tr>


    <tr>
        <td> Giới tính : </td><br/>
         <td><input type="radio" name="gioitinh" value="Nam" checked> Nam<br/>
          <input type="radio" name="gioitinh" value="Nữ"> Nữ<br>
          </td>
    </tr>

    <tr>
      <td>Quốc tịch : </td>
          <select id="quoctich" name="quoctich">
            <option value="Việt Nam">Việt Nam</option>
            <option value="Mỹ">Mỹ</option>
            <option value="Pháp">Pháp</option>
            <option value="Nhật">Nhật</option>
            <option value="Hàn Quốc">Hàn Quốc</option>
            <option value="Thái Lan">Thái Lan</option>
            <option value="Trung Quốc">Trung Quốc</option>
            <option value="Tây Ban Nha">Tây Ban Nha</option>
            <option value="Ý">Ý</option>
            <option value="Khác">Khác</option>
          </select>
    </tr>

    <tr>
    <td colspan="2" align="center"> <input type="submit" name="submit" value="Cập nhật" onclick="return confirm('Bạn đã chắc chắn')">> </td>
    </tr>

    </form>
</div>

        <?php           
        //Neu co ton tai ID
        if(isset($_REQUEST["ID"]))
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
 
            if($db)
            {
 
                if (isset($_REQUEST["flag"]))  //Neu nhan nut cap nhat
                {
                    $query ="UPDATE khachhang SET hotenkh='" . $_POST["hotenkh"] . "',
                    dc = '". $_POST["dc"]."',
                    cmnd = '". $_POST["cmnd"]."',
                    tel = '". $_POST["tel"] ."',
                    gioitinh = '". $_POST["gioitinh"] ."',
                    quoctich = '". $_POST["quoctich"] ."'
                    WHERE makh='". $_REQUEST["ID"] . "'";
                     
                    $result = pg_query($query); //Thuc thi cau lenh
                    if($result)
                    {
                        header("location:khachhang.php"); //Tro ve trang truoc
                        exit();
                    }
                }
              }
                     $sql = "SELECT * FROM khachhang order by makh ";
        $resultx = pg_query($db, $sql);

        if(!$resultx)
            {
                 die('Query error: [' . $db->error . ']');
            }
        
  }
  ?>

<center><h2>Danh sách khách hàng</h2></center>
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
            ;
            while ($row = pg_fetch_array($resultx)) :
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