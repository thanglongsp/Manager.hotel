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
<link href="css/manager.css" rel="stylesheet" type="text/css" media="screen,print" />
<title>Manager</title>
    <meta charset="utf-8">
<style>
#content{
     width: auto;
	height: auto;
     float:center;
}
#head{
	width: auto;
    height: 200px;
}
#head-link{
	width:100%;
     height: 30px;
     line-height: 30px;
     padding-left: 10px;
     padding-right: 10px;
     border: 1px solid #CDCDCD;
     background-color: #00FFFF;
}
</style>
</head>
<body>

<div id="main">
    <div id="head">
	<?php
		echo "<img width=100%	height=200px src=\"1.2.png\">"
		?>
    </div>

<?php
include'connection.php';

?>


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
    <a class="dropbtn">Quản lý</a>
    <div class="dropdown-content">
      <a href="showsudungdichvu2.php">Sử dụng dịch vụ</a>
      <a href="showsudungphong2.php">Sử dụng phòng</a>
      <a href="showdoiphong2.php">Đổi phòng</a>
      <a href="hoadon.php">Hóa đơn</a>
      <a href="gopy.php">Đóng góp của KH</a>
      </div>
  </li>

               <li class="dropdown">
          <a class="dropbtn">Thống kê</a>
          <div class="dropdown-content">
            <a href="thongkedanhchokh.php">Dành cho khách hàng</a>
            <a href="thongkedichvu.php">Dịch vụ</a>
            <a href="thongkekhachhang.php">Khách hàng</a>
            <a href="thongkethoidiem.php">Thời điểm</a>
            <a href="doanhthutheothang.php">Doanh thu theo tháng</a> 
            </div>
        </li>
        
             <li class="dropdown">
          <li style="float:right;" class="dropdown"> <a class="dropbtn" value ="<?php echo $hoten;?> "><?php echo $hoten;?></a>
          <div class="dropdown-content">
          <a href="quantri.php">Quản trị</a>
          <a href="logout.php" onclick="return confirm('Bạn đã chắc chắn')">Thoát</a>
          </div>
          </li>
          </li>
</ul>
<div id="content">
<?php
		echo "<img width=100%	height=100% src=\"5.jpg\">"
		?>
</div>
</body>
</html>
