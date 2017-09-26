<?php ob_start() ?>

<DOCTYPE html>
<?php ob_start() ?>
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

  <li class="dropdown">
    <a href="room.php" class="dropbtn">Quản lý</a>
    <div class="dropdown-content">
      <a href="showsudungphong.php">Sử dụng phòng</a>
      <a href="showdoiphong.php">Đổi phòng</a>
      <a href="showthuephong.php">Thuê phòng</a>
  </li>

  <li style="float:right"><a class="active" href="manager.php">Quay lại</a></li>
</ul>
     <!--Ket noi database-->

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
                        $query = "SELECT * FROM phong WHERE map = '".$_REQUEST['ID']. "'" ;
                         
                        $rowCollection = pg_query($query);
                        while($row = pg_fetch_array($rowCollection))
                        {
                            $tenp = $row["tenp"];
                            $loaip = $row["loaip"];
                            $gia = $row["gia"];
                            $trangthai = $row["trangthai"];
                            

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

      <form id="form1" name="form1" action="suaphong.php?flag=1&ID=<?= $_REQUEST['ID'] ?>"  method="POST">

    <tr>
    <td colspan="2"><div align="center"><strong>FORM SỬA THÔNG TIN PHÒNG</strong></div></td>
    </tr>

    <tr>
    <td>Mã phòng:  </td>
    <td><input type="text" name="map" readonly="true" value="<?php echo $_REQUEST['ID'];?> "/> </td>
    </tr>

    <tr>
    <td>Kiểu :  </td>
    <td><input type="text" name="tenp" value="<?php echo $tenp;?> "/> </td>
    </tr>

    <tr>
    <td>Loại :  </td>
    <td><input type="text" name="loaip" value="<?php echo $loaip;?> "/> </td>
    </tr>

    <tr>
    <td>Đơn giá :  </td>
    <td><input type="text" name="gia" value="<?php echo $gia;?> "/> </td>
    </tr>

     <tr>
    <td>Trạng thái :  </td>
    <td><input type="text" name="trangthai" readonly="true" value="<?php echo $trangthai;?> "/> </td>
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
                    $query ="UPDATE phong SET map='" . $_POST["map"] . "',
                    tenp = '". $_POST["tenp"]."',
                    loaip = '". $_POST["loaip"]."',
                    gia = '". $_POST["gia"] ."',
                    trangthai = '". $_POST["trangthai"] ."'
                    WHERE map='". $_REQUEST["ID"] . "'";
                  
                     
                    $result = pg_query($query); //Thuc thi cau lenh
                    if($result)
                    {
                        header("location:room.php"); //Tro ve trang truoc
                        exit();
                    }
                }
              }

                      $sql = "SELECT * FROM phong order by map asc ";
        $resultx = pg_query($db, $sql);

        if(!$resultx)
            {
                 die('Query error: [' . $db->error . ']');
            }
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
                <th>Sửa</th>
            </tr>

          <tbody>
              <?php 
              
                  $b = 0 ;
                  
                  while ($row = pg_fetch_array($resultx)) :
                  $b = $b + 1 ; ?>
                  <tr>

                      <td><?php echo "".$b."" ?></td>
                      <td><?php echo $row['map']; ?></td>
                      <td><?php echo $row['tenp']; ?></td>
                      <td><?php echo $row['loaip']; ?></td>
                      <td><?php echo $row['gia']; ?></td>
                      <td><?php echo $row['trangthai']; ?></td>
                      <td> <a = href='suaphong.php?ID=<?php echo $row['map']; ?>'>Sửa
                </a>
                </td>
                  </tr>
              <?php endwhile; ?>
          </tbody>
      </table>
    </center>

</div>



</div>

</body>
</html>