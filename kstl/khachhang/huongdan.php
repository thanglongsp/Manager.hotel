<?php
session_start();
//tiến hành kiểm tra là người dùng đã đăng nhập hay chưa
//nếu chưa, chuyển hướng người dùng ra lại trang đăng nhập
if (!isset($_SESSION['username'])) {
     header('Location: login.php');
}
$username = $_SESSION['username'];
?>


<html>
<head>
<link href="css/styleservice.css" rel="stylesheet" type="text/css" media="screen,print" />
<style>
#content{
     width: auto;
	height: 100%;
     float:center;
}
#head{
	width: auto;
    height: 200px;
}

</style>
</head>
	<title>Hướng dẫn</title>
	<meta charset="utf-8">
<body>

<ul>
          <li class="dropdown">
    <a href="homepage.php" class="dropbtn">Home</a>
    <div class="dropdown-content">
      <a href="room.php">Phòng</a>
      <a href="service.php">Dịch vụ</a>
    </div>
    </li>

        <li class="dropdown">
    <a href="thongtinkhachhang.php" class="dropbtn">Thông tin</a>
    <div class="dropdown-content">
      <a href="showsudungdichvu2.php">Sử dụng dịch vụ</a>
      <a href="showsudungphong2.php">Sử dụng phòng</a>
      <a href="showdoiphong2.php">Đổi phòng</a>
      <a href="hoadon.php">Hóa đơn</a>
      </div>
  </li>

   <li><a href="gopy.php">Góp ý - Đánh giá</a></li>
   <li><a href="thongkedanhchokh.php">Thống kê</a></li>
   <li><a href="huongdan.php">Hướng dẫn</a></li>

   
             <li class="dropdown">
          <li style="float:right;" class="dropdown"> <a class="dropbtn" value ="<?php echo $username;?> "><?php echo $username;?></a>
          <div class="dropdown-content">
          <a href="thongtinkhachhang.php">Thông tin</a>
          <a href="logout.php">Thoát</a>
          </div>
          </li>
          </li>
</ul>

<div id="main">
<br><td colspan="2"><div align="center"><strong>1.ĐĂNG KÝ</strong></div></td><br>
<center>
<?php
		echo "<img width=40%	height=50% src=\"img/dangky.png\">"

?>
</center>

<center>
<br><td colspan="2"><div align="center"><strong>2.ĐĂNG NHẬP</strong></div></td><br>
<?php
		echo "<img width=20%	height=30% src=\"img/dangnhap.png\">"

?>
</center>


<center>
<br><td colspan="2"><div align="center"><strong>3.TRA CỨU THÔNG TIN KHÁCH HÀNG SỬ DỤNG</strong></div></td><br>
<?php
		echo "<img width=90%	height=30% src=\"img/thongtin.png\">"

?>
</center>

<center>
<br><td colspan="2"><div align="center"><strong>4.TRA CỨU PHÒNG</strong></div></td><br>
<?php
		echo "<img width=90%	height=70% src=\"img/phong.png\">"

?>
</center>

<center>
<br><td colspan="2"><div align="center"><strong>5. TRA CỨU DỊCH VỤ</strong></div></td><br>
<?php
		echo "<img width=90%	height=70% src=\"img/dichvu.png\">"

?>
</center>

<center>
<br><td colspan="2"><div align="center"><strong>6. XEM NHỮNG THỐNG KÊ VỀ PHÒNG VÀ DỊCH VỤ</strong></div></td><br>
<?php
		echo "<img width=100%	height=100% src=\"img/thongke.png\">"

?>
</center>

<center>
<br><td colspan="2"><div align="center"><strong>7. GÓP Ý -  ĐÁNH GIÁ</strong></div></td><br>
<?php
		echo "<img width=40%	height=40% src=\"img/gopy.png\">"

?>
</center>



</div>
</body>
</html>