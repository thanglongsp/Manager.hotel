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
<?php ob_start() ?>
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
</head>
<title>Khách hàng</title>
    <meta charset="utf-8">

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

        <li class="dropdown">
            <a href="khachhang.php" class="dropbtn">Menu</a>
      <div class="dropdown-content">
            <a href="checkinkh.php">Checkin</a>
            <a href="changeroom.php">Đổi phòng</a>
            <a href="usedservice.php">Sử dụng dịch vụ</a>
      </div>
    </li>

    <li class="dropdown">
    <a  class="dropbtn">Quản lý</a>
    <div class="dropdown-content">
      <a href="showsudungdichvu2.php">Sử dụng dịch vụ</a>
      <a href="showsudungphong2.php">Sử dụng phòng</a>
      <a href="showdoiphong2.php">Đổi phòng</a>
      <a href="hoadon.php">Hóa đơn</a>
      </div>
  </li>

      <li style="float:right"><a class="active" href="khachhang.php">Quay lại</a></li>
</ul>

<?php           
        //Neu co ton tai ID
        if(isset($_REQUEST["ID"]))
        {
        $host        = "host=127.0.0.1";
         $port        = "port=5432";
         $dbname      = "dbname=qlkstloff3";
         $credentials = "user=postgres password=''";
         $db = pg_connect( "$host $port $dbname $credentials"  );
           if(!$db)
               {
                  echo "Error : Unable to open database\n";
               }//ket noi database
 
            if($db)
            {
                
                    if(isset($_REQUEST['ID']))
                    {
                      $makh = $_REQUEST['ID'] ;

$query = "SELECT * FROM khachhang WHERE makh = '".$_REQUEST['ID']. "'" ;

$query2 ="
SELECT tp.makh , map ,tenp, loaip ,(gia||'đ') as gia , ngayden , ngaydi , (tienp||'đ') as tienp, (tiendat||'đ') as tiendat ,(tiendv||'đ') as tiendv, (tienthue||'đ') as tienthue,(tongtientt||'đ') as tongtientt , hinhthuctt
from
thuephong as tp natural join hoadon as hd natural join phong as p
where makh = '$makh'
order by makh asc
";

$query3 = "
SELECT kh.makh, dv.madv, tendv, loaidv, (dongia||'đ') as dongia, soluong, ngaysd, ((dongia*soluong)||'đ') as thanhtien
from dichvu as dv join sudungdichvu as sddv on dv.madv = sddv.madv
right join khachhang as kh on sddv.makh = kh.makh
WHERE kh.makh = '$makh'
group by kh.makh , dv.madv , ngaysd , soluong
order by makh asc
";

$q4 = "Select mapcu , mapmoi, ngaydoi from doiphong where makh = '$makh' order by ngaydoi ";
$q5 = "SELECT magopy,clp,cldv,tdnv,gopykhac from gopy where makh = '$makh' order by magopy ";

                        
                        $result = pg_query($query);
                        $result2 = pg_query($query2);
                        $result3 = pg_query($query3);
                        $r4 = pg_query($q4);
                        $r5 = pg_query($q5);
                    }

                        while($row = pg_fetch_assoc($result2))
                        {
                            $makh = $row["makh"];
                            $map = $row["map"];
                            $tenp = $row["tenp"];
                            $loaip = $row["loaip"];
                            $gia = $row["gia"];
                            $ngayden = $row["ngayden"];
                            $ngaydi = $row["ngaydi"];
                            $tienp = $row["tienp"];
                            $tiendat = $row["tiendat"];
                            $tiendv = $row["tiendv"];
                            $tienthue = $row["tienthue"];
                            $tongtientt = $row["tongtientt"];
                            $hinhthuctt = $row["hinhthuctt"];
                        }

                }
            else
            {      
                die("Khong ket noi duoc database: ". pg_error());
            }


 
            pg_close($db);
        }      
?>

<div id = "left">

<td colspan="2"><div align="center"><strong>THÔNG TIN KHÁCH HÀNG</strong></div></td>

<div style="overflow-x:auto;">
    <table  width="700" border="2">
        <tr>
            <th>Họ tên KH</th>
            <th>Địa chỉ</th>
            <th>Số CMND</th>
            <th>Số điện thoại</th>
            <th>Giới tính</th>
            <th>Quốc tịch</th>
        </tr>

    <tbody>
        <?php 
        
            while ($row = pg_fetch_array($result)) :
              ?>
            <tr>
                <td><?php echo $row['hotenkh']; ?></td>
                <td><?php echo $row['dc']; ?></td>
                <td><?php echo $row['cmnd']; ?></td>
                <td><?php echo $row['tel']; ?></td>
                <td><?php echo $row['gioitinh']; ?></td>
                <td><?php echo $row['quoctich']; ?></td>

            </tr>
        <?php endwhile; ?>
    </tbody>
    </table>
</div>


      <form id="form1" name="form1" action="checkoutkhachhang.php?flag=1&ID=<?= $_REQUEST['ID'] ?>"  method="POST">

    <tr>
    <td colspan="2"><div align="center"><strong>THÔNG TIN HÓA ĐƠN</strong></div></td>
    </tr>

    <tr>
    <td>Mã KH:  </td>
    <td><input type="text" name="makh" readonly="true" value="<?php echo $makh;?> "/> </td>
    </tr>

    <tr>
    <td>Mã phòng:  </td>
    <td><input type="text" name="map" readonly="true" value="<?php echo $map;?> "/> </td>
    </tr>

    <tr>
    <td>Kiểu phòng :  </td>
    <td><input type="text" name="tenp" readonly="true" value="<?php echo $tenp;?> "/> </td>
    </tr>

    <tr>
    <td>Loại phòng : </td>
    <td><input type="text" name="loaip" readonly="true" value="<?php echo $loaip;?> "/> </td>
    </tr>

     <tr>
    <td>Giá :  </td>
    <td><input type="text" name="gia" readonly="true" value="<?php echo $gia;?> "/> </td>
    </tr>

     <tr>
    <td>Ngày đến:  </td>
    <td><input type="text" name="ngayden" readonly="true" value="<?php echo $ngayden;?> "/> </td>
    </tr>

     <tr>
    <td>Ngày đi:  </td>
    <td><input type="text" name="ngaydi" readonly="true" value="<?php echo $ngaydi;?> "/> </td>
    </tr>

    <tr>
    <td>Tiền phòng:  </td>
    <td><input type="text" name="tienp" readonly="true" value="<?php echo $tienp;?> "/> </td>
    </tr>
        
     <tr>
    <td>Tiền đặt:  </td>
    <td><input type="text" name="tiendat" readonly="true" value="<?php echo $tiendat;?> "/> </td>
    </tr>

     <tr>
    <td>Tiền dịch vụ:  </td>
    <td><input type="text" name="tiendv" readonly="true" value="<?php echo $tiendv;?> "/> </td>
    </tr>

     <tr>
    <td>Tiền thuế ( 10% ) :  </td>
    <td><input type="text" name="tienthue" readonly="true" value="<?php echo $tienthue;?> "/> </td>
    </tr>

    <tr>
    <td>Tổng số tiền phải thanh toán:  </td>
    <td><input type="text" name="tongtientt" readonly="true" value="<?php echo $tongtientt;?> "/> </td>
    </tr>

    <tr>
        <td>Hình thức thanh toán: </td><br/>
        <td><input type="text" name="hinhthuctt" readonly="true" value="<?php echo $hinhthuctt;?> "/> </td>
    </tr>

    </form>
</div>


<td colspan="2"><div align="center"><strong>HÓA ĐƠN SỬ DỤNG DỊCH VỤ</strong></div></td>

<div style="overflow-x:auto;">
    <table  width="700" border="2">
        <tr>
            <th>STT</th>
            <th>Mã DV</th>
            <th>Tên DV</th>
            <th>Loại DV</th>
            <th>Giá DV</th>
            <th>Ngày SD</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
        </tr>

    <tbody>
        <?php 
            $b = 0;
            while ($row = pg_fetch_array($result3)) :
              $b = $b + 1 ;
              ?>
            <tr>
                <td><?php echo "$b"; ?></td>
                <td><?php echo $row['madv']; ?></td>
                <td><?php echo $row['tendv']; ?></td>
                <td><?php echo $row['loaidv']; ?></td>
                <td><?php echo $row['dongia']; ?></td>
                <td><?php echo $row['ngaysd']; ?></td>
                <td><?php echo $row['soluong']; ?></td>
                <td><?php echo $row['thanhtien']; ?></td>

            </tr>
        <?php endwhile; ?>
    </tbody>
    </table>
</div>

<td colspan="2"><div align="center"><strong>THÔNG TIN ĐỔI PHÒNG</strong></div></td>

<div style="overflow-x:auto;">
    <table  width="700" border="2">
        <tr>
            <th>Mã phòng cũ</th>
            <th>Mã phòng mới</th>
            <th>Ngày đổi</th>
        </tr>

    <tbody>
        <?php 
        
            while ($row = pg_fetch_array($r4)) :
              ?>
            <tr>
                <td><?php echo $row['mapcu']; ?></td>
                <td><?php echo $row['mapmoi']; ?></td>
                <td><?php echo $row['ngaydoi']; ?></td>

            </tr>
        <?php endwhile; ?>
    </tbody>
    </table>
</div>

<td colspan="2"><div align="center"><strong>THÔNG TIN GÓP Ý CỦA KHÁCH HÀNG</strong></div></td>

<div style="overflow-x:auto;">
    <table  width="700" border="2">
        <tr>
            <th>Mã Góp ý</th>
            <th>Chất lượng phòng</th>
            <th>Chất lượng dịch vụ</th>
            <th>Thái độ nhân viên</th>
            <th>Góp ý khác</th>
        </tr>

    <tbody>
        <?php 
        
            while ($row = pg_fetch_array($r5)) :
              ?>
            <tr>
                <td><?php echo $row['magopy']; ?></td>
                <td><?php echo $row['clp']; ?></td>
                <td><?php echo $row['cldv']; ?></td>
                 <td><?php echo $row['tdnv']; ?></td>
                 <th><?php echo $row['gopykhac']; ?></th>
            </tr>
        <?php endwhile; ?>
    </tbody>
    </table>
</div>

</div>

</body>
</html>