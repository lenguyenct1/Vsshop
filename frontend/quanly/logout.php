<?php include_once __DIR__.'/../layouts/partials/session.php';?>
<?php

if(isset($_SESSION['kh_tendangnhap_logged_frontend'])) {
	unset($_SESSION['kh_tendangnhap_logged_frontend']);
	header('location:login.php');
} 
?>