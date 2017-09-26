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
<title>Sửa dịch vụ</title>
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
  </li>
      <li class="dropdown">
    <a href="service.php" class="dropbtn">Menu</a>
    <div class="dropdown-content">
      <a href="food.php">Đồ ăn</a>
      <a href="drink.php">Đồ uống</a>
      <a href="entertainment.php">Giải trí-Thư giãn</a>
      <a href="addservice.php">Thêm dịch vụ</a>
    </div>
  </li>

  <li style="float:right"><a class="active" href="service.php">Quay lại</a></li>
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
                        $query = "SELECT * FROM dichvu WHERE madv = '".$_REQUEST['ID']. "'" ;
                         
                        $rowCollection = pg_query($query);
                        while($row = pg_fetch_array($rowCollection))
                        {
                            $tendv = $row["tendv"];
                            $loaidv = $row["loaidv"];
                            $dongia = $row["dongia"];
                      
                      
                        }
                    }                  
                }
            else
            {      
                die("Khong ket noi duoc database: ". pg_error());
            }

                    $sql = "SELECT * FROM dichvu order by madv asc ";
        $result = pg_query($db, $sql);

        if(!$result)
            {
                 die('Query error: [' . $db->error . ']');
            }
 
            pg_close($db);
        }      
?>
<div id = "left">

      <form id="form1" name="form1" action="suadichvu.php?flag=1&ID=<?= $_REQUEST['ID'] ?>"  method="POST">
    <tr>
    <td colspan="2"><div align="center"><strong>FORM SỬA THÔNG TIN DỊCH VỤ</strong></div></td>
    </tr>

    <tr>
    <td>Mã DV:  </td>
    <td><input type="text" name="madv" readonly="true" value="<?php echo $_REQUEST['ID'];?> "/> </td>
    </tr>

    <tr>
    <td>Tên DV :  </td>
    <td><input type="text" name="tendv" value="<?php echo $tendv;?> "/> </td>
    </tr>
    <tr>
      <td>Loại : </td>
          <select id="loaidv" name="loaidv">
            <option value="Đồ uống">Đồ uống</option>
            <option value="Đồ ăn">Đồ ăn</option>
            <option value="Giải trí">Giải trí-Thư giãn</option>
          </select>
    </tr>

    <tr>
    <td>Đơn giá :  </td>
    <td><input type="text" name="dongia" value="<?php echo $dongia;?> "/> </td>
    </tr>

    <tr>
    <td  colspan="2" align="center"> <input type="submit" name="submit"  value="CẬP NHẬT" onclick="return confirm('Bạn đã chắc chắn')">> </td>
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
                    $query ="UPDATE dichvu SET madv='" . $_POST["madv"] . "',
                    tendv = '". $_POST["tendv"]."',
                    loaidv = '". $_POST["loaidv"]."',
                    dongia = '". $_POST["dongia"] ."'
                    
                    WHERE madv='". $_REQUEST["ID"] . "'";
                  
                     
                    $result = pg_query($query); //Thuc thi cau lenh
                    if($result)
                    {
                        header("location:service.php"); //Tro ve trang truoc
                        exit();
                    }
                }
              }
  }
  ?>

<center><h2>Menu</h2></center>
    <div style="overflow-x:auto;">
        <center>
            <table  width="600" border="2">
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
                        
                        while ($row = pg_fetch_array($result)) :
                        $b = $b + 1 ; ?>
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
            </table>
        </center>

</div>

</div>

</body>
</html>