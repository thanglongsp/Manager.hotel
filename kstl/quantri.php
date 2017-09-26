<?php
session_start();
//tiến hành kiểm tra là người dùng đã đăng nhập hay chưa
//nếu chưa, chuyển hướng người dùng ra lại trang đăng nhập
if (!isset($_SESSION['username'])) {
     header('Location: login.php');
}
else if ($_SESSION['chucvu']!="Giám đốc") header('Location: login.php');
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
            <a href="reset.php" onclick="return confirm('Bạn đã chắc chắn')">RESET TOÀN BỘ THÔNG TIN</a>
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
                <a href="logout.php" onclick="return confirm('Bạn đã chắc chắn muốn thoát')">Thoát</a>
                </div>
                </li>
                </li>
      </ul>

    <?php
      //Gọi file connection.php
       include("connection.php");

    ?>

<!--Tên đăng nhập và mật khẩu tùy ý-->

    <div id="left">

          <form action="quantri.php" method="POST">


              <tr>
              <td colspan="2"><div align="center"><strong>THÊM TÀI KHOẢN QUẢN LÝ</strong></div></td>
              </tr>

              <tr>
                  <td>Tên đăng nhập :  </td>
                  <td><input type="text" name="tendangnhap" placeholder="Ví dụ : Thienlong" /> </td>
              </tr>

              <tr>
                  <td>Mật khẩu :  </td>
                  <td><input type="password" name="matkhau" placeholder="Tùy ý , k điều kiện" /> </td>
              </tr>

              <tr>
                  <td> Xác nhận mật khẩu :  </td>
                  <td><input type="password" name="xacnhanmatkhau" placeholder="Giống mật khẩu trên" /> </td>
              </tr>

              <tr>
                    <td>Tên nhân viên :  </td>
                    <td><input type="text" name="tennhanvien" placeholder="Ví dụ : Thiên" /> </td>
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
                    </select>
              </tr>

                 <tr>
                      <td colspan="2" align="center"> <input type="submit" name="submit" value="Hoàn tất"> </td>
                      <td> </td>
                </tr>

        </form>


        <?php

        if(isset($_POST['submit']))

            {

              if($_POST["tendangnhap"] == NULL OR $_POST["matkhau"]== NULL OR $_POST["xacnhanmatkhau"]== NULL OR $_POST["tennhanvien"] ==NULL OR $_POST["gender"]==NULL OR $_POST["chucvu"]==NULL) echo "<h3>Vui lòng nhập đầy đủ thông tin</h3><br/>";

              else  if($_POST['matkhau'] != $_POST['xacnhanmatkhau'] ) echo "<h3>Xác nhận mật khẩu không đúng</h3><br/>";

              else {

              $query = "SELECT username from quanly WHERE username = '".$_POST["tendangnhap"]."'";
              $result = pg_query($query);
              $num = pg_num_rows($result);

              if ($num >0) echo "<h3>Tài khoản đã tồn tại, vui lòng nhập lại</h3><br/>";

                  else
                  {

                  $query2 = "INSERT INTO quanly
                   VALUES ('".$_POST["tendangnhap"]."','".$_POST["matkhau"]."','".$_POST["tennhanvien"]."','".$_POST["gender"]."','".$_POST["chucvu"]."')";
                   $result2 = pg_query($query2);

                   if($result2) echo "Thành công<br/>";

                   }

                 }
                 }


            $query3 = "SELECT * FROM quanly  where chucvu != 'Giám đốc' " ;
            $result3 = pg_query($query3);


?>



    </div>




<center><h2>Danh sách nhân viên lễ tân</h2></center>
    <div style="overflow-x:auto;">
    <center>
        <table  width="600" border="2">
            <tr>
                <th>STT</th>
                <th>Tên đăng nhập</th>
                <th>Mật khẩu</th>
                <th>Họ tên </th>
                <th>Giới tính</th>
                <th>Chức vụ</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>

          <tbody>
              <?php 
              
                  $b = 0 ;
                  
                  while ($row = pg_fetch_array($result3)) :
                  $b = $b + 1 ; ?>
                  <tr>

                      <td><?php echo "".$b."" ?></td>
                      <td><?php echo $row['username']; ?></td>
                      <td><?php echo $row['password']; ?></td>
                      <td><?php echo $row['hoten']; ?></td>
                      <td><?php echo $row['gioitinh']; ?></td>
                      <td><?php echo $row['chucvu']; ?></td>
                      <td> <a = href='suathongtindangnhap.php?ID=<?php echo $row['username']; ?>'><?php if ($row['chucvu'] !='Giám đốc') echo "Sửa"; ?></a></td>
                      <td> <a = href='xoanhanvien.php?ID=<?php echo $row['username']; ?>'><?php if ($row['chucvu'] !='Giám đốc') echo "Xóa"; ?></a></td>
                      

                  </tr>
              <?php endwhile; ?>
          </tbody>
      </table>
    </center>

</div>





</div>


</body>
</html>
