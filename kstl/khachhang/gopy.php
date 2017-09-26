<?php
session_start();
//tiến hành kiểm tra là người dùng đã đăng nhập hay chưa
//nếu chưa, chuyển hướng người dùng ra lại trang đăng nhập
if (!isset($_SESSION['username'])) {
     header('Location: login.php');
}
$username = $_SESSION['username'];
?>

<DOCTYPE html>
<html>
<head>
<link href="css/manager.css" rel="stylesheet" type="text/css" media="screen,print" />

<style >

input[type=submit] {
    width: 100%;
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

input[type=text] {
    width: 100%;
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

#left{
     width: 50%;
     height: 400px;
     border: 1px solid #CDCDCD;
     float:left;
     background-color: white;
     margin-bottom: 5px;
}
</style>
<title>Góp ý</title>
    <meta charset="utf-8">
</head>
<body>


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

?>


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

        <center><h2>CHÀO MỪNG QUÝ KHÁCH ĐẾN VỚI KHÁCH SẠN THIÊN LONG</h2></center>


  <div id="left">

  <form action="gopy.php" method="POST">
    <tr>
    <td colspan="2"><div align="center"><strong>XIN MỜI QUÝ KHÁCH ĐIỀN VÀO FORM SAU</strong></div></td>
    </tr>


    <tr>
        <td> <h4>Chất lượng phòng : </h4>  </td>
          <td>
              <input type="radio" name="clp" value="Tốt" checked>Tốt
              <input type="radio" name="clp" value="Trung bình">Trung bình
              <input type="radio" name="clp" value="Tệ">Tệ<br>
          </td>
    </tr>

    <tr>
        <td><h4> Chất lượng dịch vụ :</h4>  </td>
          <td>
              <input type="radio" name="cldv" value="Tốt" checked>Tốt
              <input type="radio" name="cldv" value="Trung bình">Trung bình
              <input type="radio" name="cldv" value="Tệ">Tệ<br>
          </td>
    </tr>

    <tr>
        <td><h4> Thái độ nhân viên : </h4> </td>
          <td>
              <input type="radio" name="tdnv" value="Tốt" checked>Tốt
              <input type="radio" name="tdnv" value="Trung bình">Trung bình
              <input type="radio" name="tdnv" value="Tệ">Tệ<br>
          </td>
    </tr>

    <tr>
        <td><h4>Nhận xét -  Góp ý :</h4>  </td>
            <td><input rows="10" cols="30" type="text" name="gopykhac"><br /> </td>
    </tr>    

    <tr>
        <td colspan="2" align="center"> <input type="submit" name="submit" value="Gửi"> </td>
        <td> </td>
    </tr>

    </form>


        <?php

              if(isset($_POST["submit"]))
              {

                if($_POST["clp"]==NULL OR $_POST["cldv"]==NULL OR $_POST["tdnv"] ==NULL)
                  echo "<h3>Xin mời ý khách nhập đầy đủ thông tin</h3>";

                else{
                    include'connection.php';

                  $result = pg_query("SELECT * FROM gopy");
                        $num = pg_num_rows($result);
                        $highest_id = $num + 1;

                  $query = "INSERT INTO gopy
                           VALUES( '".$highest_id."' , '".$username."' ,'".$_POST["clp"]."','".$_POST["cldv"]."','".$_POST["tdnv"]."','".$_POST["gopykhac"]."')";

                  $result2 = pg_query($query);

                  if($result2)
                    echo "<h2>Cảm ơn những đóng góp của quý khách</h3>";


              }
            }

          ?>


</div>

</div>
</body>
</html>




</body>
</html>
