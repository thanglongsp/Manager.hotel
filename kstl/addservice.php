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
<title>Thêm dịch vụ</title>
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

<div id="left">

      <form id="form1" name="form1" action="addservice.php"  method="POST">
    <tr>
    <td colspan="2"><div align="center"><strong>THÔNG TIN DỊCH VỤ</strong></div></td>
    </tr>

    <tr>
    <td>Mã DV:  </td>
    <td><input type="text" name="madv" placeholder="Ví dụ : XXXX" /> </td>
    </tr>

    <tr>
    <td>Tên DV :  </td>
    <td><input type="text" name="tendv" placeholder="Ví dụ : XXXX..." /> </td>
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
    <td><input type="text" name="dongia" placeholder="Ví dụ : 10000" /> </td>
    </tr>

    <tr>
    <td  colspan="2" align="center"> <input type="submit" name="submit"  value="CẬP NHẬT" onclick="return confirm('Bạn đã chắc chắn')"> </td>
    </tr>

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

           if (isset($_POST["submit"]))
           {
                $madv = $_POST['madv'];

                $sql = "select madv from dichvu where madv = '$madv'";
                $query = pg_query($db,$sql);
                $num_rows = pg_num_rows($query);

            if ($num_rows!=0)
                {
                    echo 'Dịch vụ đã tồn tại, mời bạn nhập lại đúng mã dịch vụ';
                }

            else if($_POST['madv']==NULL or $_POST['tendv']==NULL or $_POST['dongia']==NULL)
                {
                    echo 'Moi ban nhap day du thong tin';
                }

            else {
                    $sql=pg_query("INSERT INTO dichvu values('".$_POST['madv']."','".$_POST['tendv']."','".$_POST['dongia']."','".$_POST['loaidv']."')");
                    
                    if($sql) echo 'THÀNH CÔNG';
                    else echo 'sql xay ra loi';

                }

            }

            $sql = "SELECT madv, tendv, loaidv , (dongia||'đ') as dongia FROM dichvu order by madv ";
            $result = pg_query($db, $sql);

        if(!$result)
            {
                 die('Query error: [' . $db->error . ']');
            }

        
    ?>


  </div>

    <center><h2>MENU</h2></center>

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

    
<!--End Xu ly form-->    


        
<!--End HTML-->
</body>
</html>