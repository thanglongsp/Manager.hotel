<?php
session_start();
?>

<!DOCTYPE html>
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

th, td {
    text-align: left;
    padding: 8px;
}

input[type=text] {
    width:20%;
    height: 50px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    background-color: white;
    background-image: url('searchicon.png');
    background-position: 10px 10px; 
    background-repeat: no-repeat;
    padding: 12px 20px 12px 40px;
}

input[type=password] {
    width: 20%;
    height: 50px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    background-color: white;
    background-position: 10px 10px; 
    background-repeat: no-repeat;
    padding: 12px 20px 12px 40px;
}

input[type=submit] {
    width: 20%;
    background-color: #333;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #32CD32 ;
}

</style>
	<title>Đăng nhập</title>
</head>
<body>


<ul>

			<li class="dropdown"><a href="homepage.php" class="dropbtn">Home</a></li>
			<li class="dropdown"><a href="huongdan.php" class="dropbtn">Hướng dẫn</a></li>

	        <li style="float:right;" class="dropdown"> <a href="dangky.php" class="dropbtn" value ="dangky">Đăng ký</a></li>
	        <li style="float: right;" class="dropdown"><a href="login.php" class="dropbtn" value ="dangnhap">Đăng Nhập</a></li>

</ul>

<center> <h3> Thông tin đăng nhập </h3>
<form method="POST" action="login.php">

	    			<td><input type="text" name="username" placeholder="Tên đăng nhập" ></td><br><br>

	    			<td><input type="password" name="password" placeholder="Mật khẩu"></td><br>

	    			<td colspan="2" align="center"> <input name="submit" type="submit" value="Đăng nhập"></td>

</form>
</center>


<?php
      //Gọi file connection.php ở bài trước
         $host        = "host=127.0.0.1";
         $port        = "port=5432";
         $dbname      = "dbname=qlks";
         $credentials = "user=postgres password='thanglongsp'";
         $db = pg_connect( "$host $port $dbname $credentials"  );
           if(!$db){
              echo "Error : Unable to open database\n";
           }

	// Kiểm tra nếu người dùng đã ân nút đăng nhập thì mới xử lý
	if (isset($_POST["submit"])) {
		// lấy thông tin người dùng
		$username = $_POST["username"];
		$password = $_POST["password"];
		//làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
		//mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
		$username = strip_tags($username);
		$username = addslashes($username);
		$password = strip_tags($password);
		$password = addslashes($password);
		if ($username == "" || $password =="") {
			echo "Tên đăng nhập hoặc mật khẩu trống!";
		}else{
			$sql = "select * from quanly where username = '$username' and password = '$password' ";
			$query = pg_query($db,$sql);
			while($row = pg_fetch_array($query))
			{
				$hoten = $row["hoten"] ;
				$chucvu = $row["chucvu"] ;
			}

			$num_rows = pg_num_rows($query);

			//$sql=pg_query("SELECT * FROM quanly WHERE username = '".$_POST['username']."' and password = '".$_POST['password']."' ");
			if ($num_rows==0) {
				echo "Tên đăng nhập hoặc mật khẩu không đúng, vui lòng thử lại !";
				header("Location: khachhang\dangky.php");
			}else{
				//tiến hành lưu tên đăng nhập vào session để tiện xử lý sau này
				$_SESSION['username'] = $username;
				$_SESSION['hoten'] = $hoten;
				$_SESSION['chucvu'] = $chucvu ;
				
				if ($chucvu == "Giám đốc")
				{
                	header('Location: quantri.php');					
				}

				else if ($chucvu == "Quản lý" OR $chucvu == "Nhân viên")
				{
					header('Location: manager.php');
				}
				else header('Location: khachhang\thongtinkhachhang.php');

			}
		}
	}
?>

</body>
</html>
