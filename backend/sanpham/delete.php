<?php include_once __DIR__.'/../layouts/partials/session.php';?>
<?php 
	include_once  __DIR__.'/../../dbconnect.php' ;
	$id = $_GET['id'];
	$sql = <<<EOT
	DELETE FROM `sanpham` WHERE sp_id= $id
	EOT;
	$result = mysqli_query($conn, $sql);
	echo '<script>
			location.href="index.php";
			alert("Xóa sản phẩm thành công");
		</script>';
?>