<?php include_once __DIR__.'/../layouts/partials/session.php';?>
<?php 
	include_once  __DIR__.'/../../dbconnect.php' ;
	$id = $_GET['id'];
	$sql = <<<EOT
	DELETE FROM `thuonghieu` WHERE th_id= $id
	EOT;
	$result = mysqli_query($conn, $sql);
	echo '<script>
			location.href="index.php";
			alert("Xóa thương hiệu thành công");
		</script>';
?>