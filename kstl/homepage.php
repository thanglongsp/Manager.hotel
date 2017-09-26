<?php
session_start();
?>

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
	<title>Login</title>
	<meta charset="utf-8">
<body>


<ul>

			<li class="dropdown"><a href="homepage.php" class="dropbtn">Home</a></li>
			<li class="dropdown"><a href="huongdan.php" class="dropbtn">Hướng dẫn</a></li>

	        <li style="float:right;" class="dropdown"> <a href="dangky.php" class="dropbtn" value ="dangky">Đăng ký</a></li>
			<li style="float: right;" class="dropdown"><a href="login.php" class="dropbtn" value ="dangnhap">Đăng Nhập</a></li>


</ul>


<div id="content">
<?php
		echo "<img width=100%	height=100% src=\"5.jpg\">"
		?>
</div>
</body>
</html>