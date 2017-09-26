<?php
session_start();
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
#head{
	width: auto;
    height: 200px;
}

</style>
<title>Đăng ký</title>
    <meta charset="utf-8">
</head>
<body>



<div id="main">


<ul>

      <li class="dropdown"><a href="homepage.php" class="dropbtn">Home</a></li>
      <li class="dropdown"><a href="huongdan1.php" class="dropbtn">Hướng dẫn</a></li>
          <li style="float:right;" class="dropdown"> <a href="dangky.php" class="dropbtn" value ="dangky">Đăng ký</a></li>
          <li style="float:right;" class="dropdown"> <a href="login.php" class="dropbtn" value ="dangnhap">Đăng nhập</a></li>

</ul>

<!--Tên đăng nhập và mật khẩu tùy ý-->

    <div id="left">

          <form action="dangky.php"  method="POST">


              <tr>
              <td colspan="2"><div align="center"><strong>Đăng ký tài khoản</strong></div></td>
              </tr>

              <tr>
                  <td>Mã KH (Được cấp lúc check in) :  </td>
                  <td><input type="text" name="tendangnhap" placeholder="Ví dụ : KH1" /> </td>
              </tr>

              <tr>
                  <td>Mật khẩu :  </td>
                  <td><input type="password" name="matkhau" placeholder="*********" /> </td>
              </tr>

              <tr>
                  <td> Xác nhận mật khẩu :  </td>
                  <td><input type="password" name="xacnhanmatkhau" placeholder="*********" /> </td>
              </tr>


                 <tr>
                      <td colspan="2" align="center"> <input type="submit" name="submit" value="Hoàn tất"> </td>
                      <td> </td>
                </tr>

        </form>


        <?php

        if(isset($_POST['submit']))

            {

              include("connection.php");
              $q1 = "SELECT makh from khachhang where makh = '".$_POST["tendangnhap"]."'";
              $r1 = pg_query($q1);
              $num1 = pg_num_rows($r1);


              if($_POST["tendangnhap"] == NULL OR $_POST["matkhau"]== NULL OR $_POST["xacnhanmatkhau"]== NULL) echo "<h3>Vui lòng nhập đầy đủ thông tin</h3><br/>";

              else  if($_POST['matkhau'] != $_POST['xacnhanmatkhau'] ) echo "<h3>Xác nhận mật khẩu không đúng</h3><br/>";
              else if ($num1 == 0) echo "Vui lòng nhập đúng mã khách hàng đã được cấp";                   

              else {
              $query = "SELECT username from quanly WHERE username = '".$_POST["tendangnhap"]."'";
              $result = pg_query($query);
              $num = pg_num_rows($result);

              if ($num >0) echo "<h3>Tài khoản đã tồn tại, vui lòng nhập lại</h3><br/>";

                  else
                  {

                  $query2 = "INSERT INTO quanly (username,password,chucvu)
                   VALUES ('".$_POST["tendangnhap"]."','".$_POST["matkhau"]."','Khách hàng')";
                   $result2 = pg_query($query2);

                   if($result2)
                    {
                      $_SESSION['username'] = $_POST['tendangnhap'];
                      header('location: thongtinkhachhang.php');
                    }

                   }

                 }
              

                

            }

?>



    </div>






</div>


</body>
</html>