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
<style >
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

      <li style="float:right"><a class="active" href="khachhang.php">Quay lại</a></li>
</ul>
<div id="main">
     <!--Ket noi database-->

     <div id = "left">
        <form action="checkinkh.php?flag=1" method="POST">

    <tr>
    <td colspan="2"><div align="center"><strong>THÔNG TIN KHÁCH HÀNG</strong></div></td>
    </tr

    <tr>
    <td>Họ tên khách hàng:  </td>
    <td><input type="text" name="name" placeholder="Ví dụ: Trần Văn Thiên"> </td>
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
    <td><input type="text" name="cmnd"/ placeholder="Ví dụ : 123456789"><br /> </td>
    </tr>

    <tr>
    <td>Số điện thoại :  </td>
    <td><input type="text" name="tel" placeholder="Ví dụ : 123456789" /><br /> </td>
    </tr>

    <tr>
    <td>Ngày đến : </td><br/>
    <td><input type="date" name="datein"/> </td>
    <br/></tr>

    <tr>
    <td>Ngày đi : </td><br/>
    <td><input type="date" name="dateout"/> </td>
    <br/></tr>

    <tr>
    <td>Số ngày thuê : </td><br/>
    <td><input type="text" name="numdate" placeholder="Ngày đi - Ngày đến  + 1" /> </td>
    <br/></tr>


    <tr>
    <td>Thuê phòng :  </td>
    <td><input type="text" name="map" placeholder="Ví dụ : 101" /> </td>
    </tr>

    <tr>
        <td> Giới tính : </td><br/>
         <td><input type="radio" name="gender" value="Nam" checked>Nam<br>
          <input type="radio" name="gender" value="Nữ">Nữ<br>
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
      <td>Tiền cọc : </td>
          <select id="tiencoc" name="tiencoc">
            <option value="1000000">1.000.000đ</option>
            <option value="1500000">1.500.000đ</option>
            <option value="2000000">2.500.000đ</option>
            <option value="3000000">3.000.000đ</option>
            <option value="3500000">3.500.000đ</option>
            <option value="4000000">4.000.000đ</option>
            <option value="4500000">4.500.000đ</option>
            <option value="5000000">5.000.000đ</option>
          </select>
    </tr>

    <tr>
    <td colspan="2" align="center"> <input type="submit" name="submit" value="Hoàn tất" onclick="return confirm('Bạn đã chắc chắn')"> </td>
    <td> </td>
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

               if (isset($_REQUEST["flag"]))
               {

                    $resultx = pg_query("SELECT makh FROM khachhang");
                        $row2 = pg_num_rows($resultx);
                        $highest_id = $row2 + 1;

                    $q1 = "SELECT map from sudungphong where map = '".$_POST["map"]."'";
                    $r1 = pg_query($q1);
                    $num = pg_num_rows($r1);


        if(isset($_POST['submit'])){

                    $q1 = "SELECT map from sudungphong where map = '".$_POST["map"]."'";
                    $r1 = pg_query($q1);
                    $num1 = pg_num_rows($r1);

                    $q2 = "SELECT map from phong where map = '".$_POST["map"]."'";
                    $r2 = pg_query($q2);
                    $num2 = pg_num_rows($r2);                    

            if($_POST['name']==NULL or $_POST['dc']==NULL or $_POST['cmnd']==NULL or $_POST['tel']==NULL or $_POST['datein']==NULL or $_POST['map']==NULL or $_POST['tiencoc']==NULL or $_POST['gender']==NULL or $_POST['quoctich']==NULL or $_POST['dateout']==NULL){
                echo 'Mời bạn nhập đầy đủ thông tin';
            }

            else if ($num1 > 0)  echo "<h4>Phòng đã kín, vui lòng nhập lại mã phòng</h4>";
            else if ($num2 == 0)  echo "<h4>Mã phòng không tồn tại, vui lòng nhập lại mã phòng</h4>";
            else{


                    $sql=pg_query("INSERT INTO khachhang values('KH".$highest_id."','".$_POST['name']."','".$_POST['dc']."','".$_POST['cmnd']."','".$_POST['tel']."','".$_POST['gender']."','".$_POST['quoctich']."')");

                   // $sql2=pg_query("INSERT INTO datphong values('KH".$highest_id."','".$_POST['datein']."','".$_POST['tiencoc']."','".$_POST['dateout']."')");
                    
                    $sql3=pg_query("INSERT INTO sudungphong values('KH".$highest_id."','".$_POST['map']."')");

                    $sql4=pg_query("INSERT INTO thuephong(makh,ngayden,thanhtoan,ngaydi,map,tiendat,songaythue) values('KH".$highest_id."','".$_POST['datein']."','Chưa TT','".$_POST['dateout']."','".$_POST['map']."','".$_POST['tiencoc']."','".$_POST['numdate']."')");

                    $sql5=pg_query("UPDATE phong SET trangthai = 'Kín' WHERE map ='".$_POST['map']."'");
                    

                    if($sql && $sql3 && $sql4 && $sql5)
                    {
                        header("location:khachhang.php");
                        exit();
                    }
                    else echo 'Xảy ra lỗi, vui lòng kiểm tra lại';

                }

                
            }
          }

        $sqlxx = "SELECT * FROM phong where trangthai = 'Trống' order by map asc ";
        $resultxx = pg_query($db, $sqlxx);

               ?>


     </div>

<center><h2>Danh sách phòng trống</h2></center>
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
                  
                  while ($row = pg_fetch_array($resultxx)) :
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


</body>
</html>
