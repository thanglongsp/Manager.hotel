<DOCTYPE html>
<html>
<head>
<link href="css/styleroom.css" rel="stylesheet" type="text/css" media="screen,print" />
</head>
<title>Phòng</title>
    <meta charset="utf-8">

<body>
<div id="main">
    <div id="head-link">
        <a href="room.php" ><input type="button" value="Danh sách phòng" class="button"></a>
        <a href="showsudungphong.php" ><input type="button" value="Sử dụng phòng" class="button"></a>
        <a href="showdoiphong.php" ><input type="button" value="Đổi phòng" class="button"></a>
        <a href="showthuephong.php" ><input type="button" value="Thuê phòng" class="button"></a>
        <a href="roomkin.php" ><input type="button" value="Phòng kín" class="button"></a>
        <a href="roomtrong.php" ><input type="button" value="Phòng trống" class="button"></a>
        <a href="roomdon.php" ><input type="button" value="Phòng đơn" class="button"></a>
        <a href="roomdoi.php" ><input type="button" value="Phòng đôi" class="button"></a>
        <a href="roomthuong.php" ><input type="button" value="Phòng thường" class="button"></a>
        <a href="roomvip.php" ><input type="button" value="Phòng vip" class="button"></a>

    </div>

    <div id="left">
            <a href="themphongmoi.php" ><input type="button" value="Thêm" class="button"></a><br>
            <a href="showdoiphong.php" ><input type="button" value="Tìm kiếm" class="button"></a><br>
            <a href="showthuephong.php" ><input type="button" value="Sửa" class="button"></a><br>
            <a href="showthuephong.php" ><input type="button" value="Xóa" class="button"></a><br>

    </div>

    <form action="themphongmoi.php" method="POST">
    <table>

    <tr>
    <td>Mã phòng:  </td>
    <td><input type="text" name="map"> </td>
    </tr>

    <tr>
    <td>Loại phòng :  </td>
    <td><input type="text" name="tenp"/> </td>
    </tr>

    <tr>
    <td>Kiểu phòng :  </td>
    <td><input type="text" name="kieup"/><br /> </td>
    </tr>

    <tr>
    <td>Đơn giá :  </td>
    <td><input type="text" name="tel"/><br /> </td>
    </tr>

    <tr>
    <td>Ngày đến : </td>
    <td><input type="date" name="datein"/> </td>
    </tr>

    <tr>
    <td>Thuê phòng :  </td>
    <td><input type="text" name="map"/> </td>
    </tr>

    <tr>
    <td>Tiền cọc :  </td>
    <td> <input type="text" name="tiencoc"/> </td>
    </tr>

    <tr>
        <td> Giới tính : </td>
         <td><input type="radio" name="gender" value="male" checked> Male<br>
          <input type="radio" name="gender" value="female"> Female<br>
          </td>
    </tr>

    <tr>
    <td>Quốc tịch :  </td>
    <td> <input type="text" name="quoctich"/> </td>
    </tr>

    <tr>
    <td colspan="2" align="center"> <input type="submit" name="submit" value="Hoàn tất" onclick="return confirm('Bạn đã chắc chắn')">> </td>
    <td> </td>
    </tr>

    </table>
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


        $sql = "SELECT * FROM phong order by map asc ";
        $result = pg_query($db, $sql);

        if(!$result)
            {
                 die('Query error: [' . $db->error . ']');
            }

    ?>
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
			            
			            while ($row = pg_fetch_row($result)) :
			            $b = $b + 1 ; ?>
			            <tr>

			                <td><?php echo "".$b."" ?></td>
			                <td><?php echo $row[0]; ?></td>
			                <td><?php echo $row[1]; ?></td>
			                <td><?php echo $row[2]; ?></td>
			                <td><?php echo $row[3]; ?></td>
			                <td><?php echo $row[4]; ?></td>
			            </tr>
			        <?php endwhile; ?>
			    </tbody>
			</table>
		</center>

</div>

</div>

</body>
</html>