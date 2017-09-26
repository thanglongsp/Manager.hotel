<?php

session_start();
//tiến hành kiểm tra là người dùng đã đăng nhập hay chưa
//nếu chưa, chuyển hướng người dùng ra lại trang đăng nhập
if (!isset($_SESSION['username'])) {
     header('Location: login.php');
}
else if ($_SESSION['chucvu']!="Giám đốc") header('Location: login.php');

include("connection.php");
pg_query("DELETE FROM thuephong");
pg_query("DELETE FROM doiphong");
pg_query("DELETE FROM sudungdichvu");
pg_query("DELETE FROM sudungphong");
pg_query("DELETE FROM gopy");
pg_query("DELETE FROM hoadon");
pg_query("DELETE FROM thongke");
pg_query("DELETE FROM thongke2");
pg_query("DELETE FROM khachhang");
pg_query("UPDATE phong SET trangthai = 'Trống'");

header("Location: quantri.php");

?>