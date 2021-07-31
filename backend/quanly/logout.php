<?php include_once __DIR__.'/../layouts/partials/session.php';?>
<?php

if(isset($_SESSION['kh_tendangnhap_logged'])) {
	unset($_SESSION['kh_tendangnhap_logged']);
	header('location:index.php');
} 
?>