<?php
if (session_id() === '') {
	session_start();
}

if(!isset($_SESSION['kh_tendangnhap_logged'])) {
	header('location:../quanly/index.php');
}
?>