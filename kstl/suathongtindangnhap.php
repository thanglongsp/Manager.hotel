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

<style>
  #left{
     width: 40%;
     height: 100%;
     border: none;
     float:left;
     background-color: white;
}
</style>
<title>Quản trị</title>
    <meta charset="utf-8">
</head>
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
          <a href="#" class="dropbtn">Quản lý</a>
          <div class="dropdown-content">
            <a href="showsudungdichvu2.php">Sử dụng dịch vụ</a>
            <a href="showsudungphong2.php">Sử dụng phòng</a>
            <a href="showdoiphong2.php">Đổi phòng</a>
            <a href="hoadon.php">Hóa đơn</a>
            </div>
        </li>

                     <li class="dropdown">
          <a href="thongke.php" class="dropbtn">Thống kê</a>
          <div class="dropdown-content">
            <a href="thongkedanhchokh.php">Dành cho khách hàng</a>
            <a href="thongkedichvu.php">Dịch vụ</a>
            <a href="thongkekhachhang.php">Khách hàng</a>
            <a href="thongkethoidiem.php">Thời điểm</a> 
            <a href="doanhthutheothang.php" >Doanh thu</a> 
            </div>
        </li>
                   <li class="dropdown">
                <li style="float:right;" class="dropdown"> <a class="dropbtn" value ="<?php echo $hoten;?> "><?php echo $hoten;?></a>
                <div class="dropdown-content">
                <a href="quantri.php">Quản trị</a>
                <a href="logout.php">Thoát</a>
                </div>
                </li>
                </li>
      </ul>

    <?php
      //Gọi file connection.php ở bài trước
         $host        = "host=127.0.0.1";
         $port        = "port=5432";
         $dbname      = "dbname=qlkstloff3";
         $credentials = "user=postgres password=''";
         $db = pg_connect( "$host $port $dbname $credentials"  );
           if(!$db){
              echo "Error : Unable to open database\n";
           }

            if(isset($_REQUEST['ID']))
                    {
                        $query = "SELECT * FROM quanly WHERE username = '".$_REQUEST['ID']. "'" ;
                         
                        $rowCollection = pg_query($query);
                        while($row = pg_fetch_array($rowCollection))
                        {
                            $username = $row["username"];
                            $password = $row["password"];
                            $hotennv = $row["hoten"];
                            $gioitinh = $row["gioitinh"];
                            $chucvu = $row["chucvu"];

                        }
                    }                  

    ?>

<!--Tên đăng nhập và mật khẩu tùy ý-->

    <div id="left">

          <form action="quantri.php" method="POST">


              <tr>
              <td colspan="2"><div align="center"><strong>SỬA TÀI KHOẢN QUẢN LÝ</strong></div></td>
              </tr>

              <tr>
                  <td>Tên đăng nhập :  </td>
                  <td><input type="text" readonly="true" name="tendangnhap" value="<?php echo $username  ;?> "/></td>
              </tr>

              <tr>
                  <td>Mật khẩu :  </td>
                  <td><input type="text" name="matkhau" value="<?php echo $password ;?>"/> </td>
              </tr>

                    <td>Tên nhân viên :  </td>
                    <td><input type="text" name="tennhanvien"  value="<?php echo $hotennv ;?>"/> </td>
              </tr>

              <tr>
                 <td> Giới tính : </td><br/>
                 <td>
                      <input type="radio" name="gender" value="Nam" checked>Nam<br>
                      <input type="radio" name="gender" value="Nữ">Nữ<br>
                </td>
             </tr> 

              <tr>
                <td>Chức vụ : </td>
                    <select id="Chucvu" name="chucvu">
                        <option value="Nhân viên">Nhân viên</option>
                        <option value="Quản lý">Quản lý</option>
                        <option value="Khách hàng">Khách hàng</option> 
                    </select>
              </tr>

                 <tr>
                      <td colspan="2" align="center"> <input type="submit" name="submit" value="Hoàn tất" onclick="return confirm('Bạn đã chắc chắn')">> </td>
                      <td> </td>
                </tr>

        </form>


        <?php

        if(isset($_POST['submit']))

            {

              if($_POST["tendangnhap"] == NULL OR $_POST["matkhau"]== NULL OR $_POST["tennhanvien"] ==NULL OR $_POST["gender"]==NULL OR $_POST["chucvu"]==NULL) echo "<h3>Vui lòng nhập đầy đủ thông tin</h3><br/>";

                  else
                  {

                  $query2 ="

                   UPDATE quanly SET                  
                   password = '".$_POST["matkhau"]."',
                   hotennv = '".$_POST["tennhanvien"]."',
                   gioitinh ='".$_POST["gender"]."',
                   chucvu = '".$_POST["chucvu"]."')
                   WHERE username = '".$_POST["tendangnhap"]."'

                   ";

                   $result2 = pg_query($query2);

                   if($result2) header('location: quantri.php');

                   }

                

            }


        ?>



    </div>







</div>


</body>
</html>
