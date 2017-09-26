<html>
<head>
<link href="css/stylelogin.css" rel="stylesheet" type="text/css" media="screen,print" />
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

			<li class="dropdown"><a href="homepage.php" class="dropbtn">Home</a></li>
			<li class="dropdown"><a href="huongdan.php" class="dropbtn">Hướng dẫn</a></li>

	        <li style="float:right;" class="dropdown"> <a href="dangky.php" class="dropbtn" value ="dangky">Đăng ký</a></li>
			<li style="float: right;" class="dropdown"><a href="login.php" class="dropbtn" value ="dangnhap">Đăng Nhập</a></li>


</ul>

<div id="main">
<br><td colspan="2"><div align="center"><strong>1.ĐĂNG KÝ</strong></div></td><br>
<center>
<?php
		echo "<img width=40%	height=50% src=\"image/dangky.png\">"

?>
</center>

<center>
<br><td colspan="2"><div align="center"><strong>2.ĐĂNG NHẬP</strong></div></td><br>
<?php
		echo "<img width=20%	height=30% src=\"image/dangnhap.png\">"

?>
</center>


<center>
<br><td colspan="2"><div align="center"><strong>3.TRA CỨU THÔNG TIN KHÁCH HÀNG SỬ DỤNG</strong></div></td><br>
<?php
		echo "<img width=90%	height=30% src=\"image/thongtin.png\">"

?>
</center>

<center>
<br><td colspan="2"><div align="center"><strong>4.TRA CỨU PHÒNG</strong></div></td><br>
<?php
		echo "<img width=90%	height=70% src=\"image/phong.png\">"

?>
</center>

<center>
<br><td colspan="2"><div align="center"><strong>5. TRA CỨU DỊCH VỤ</strong></div></td><br>
<?php
		echo "<img width=90%	height=70% src=\"image/dichvu.png\">"

?>
</center>

<center>
<br><td colspan="2"><div align="center"><strong>6. XEM NHỮNG THỐNG KÊ VỀ PHÒNG VÀ DỊCH VỤ</strong></div></td><br>
<?php
		echo "<img width=100%	height=100% src=\"image/thongke.png\">"

?>
</center>

<center>
<br><td colspan="2"><div align="center"><strong>7. GÓP Ý -  ĐÁNH GIÁ</strong></div></td><br>
<?php
		echo "<img width=40%	height=40% src=\"image/gopy.png\">"

?>
</center>



</div>
</body>
</html>