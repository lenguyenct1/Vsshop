<?php
// hàm `session_id()` sẽ trả về giá trị SESSION_ID (tên file session do Web Server tự động tạo)
// - Nếu trả về Rỗng hoặc NULL => chưa có file Session tồn tại
if (session_id() === '') {
	// Yêu cầu Web Server tạo file Session để lưu trữ giá trị tương ứng với CLIENT (Web Browser đang gởi Request)
	session_start();
}
?>
<?php
		$giohangdata = [];
		if (isset($_SESSION['giohangdata'])) {
			$giohangdata = $_SESSION['giohangdata'];
		} else {
			$giohangdata = [];
		}
	?>

<?php 
		$sosanpham = 0;
		$tong = 0;
		foreach ($giohangdata as $sanpham) : 
			$sosanpham++;
			$tong = $tong+ $sanpham['soluong'] * $sanpham['gia'];
		endforeach;
?>
<div class="humberger__menu__overlay"></div>
	<div class="humberger__menu__wrapper">
		<div class="humberger__menu__logo">
			<a href="/Vsshop"><img src="/Vsshop/assets/vendor/frontend/img/logo.png" alt=""></a>
		</div>
		<div class="humberger__menu__cart">
			<ul>
				<li><a href="/Vsshop/frontend/sanpham/cart.php"><i class="fa fa-shopping-bag"></i> <span><?= $sosanpham ?></span></a></li>
			</ul>
			<div class="header__cart__price">Tổng tiền: <span><?=  number_format($tong, 2, ".", ",") . ' vnđ' ?></span></div>
		</div>
		<div class="humberger__menu__widget">
			<div class="header__top__right__auth">
				<?php if(isset($_SESSION['kh_tendangnhap_logged_frontend'])) :?>
					<a href="/Vsshop/frontend/quanly/login.php"><i class="fa fa-user"></i> HI! <?= $_SESSION['kh_tendangnhap_logged_frontend']; ?></a>
				<?php else: ?>
					<a href="/Vsshop/frontend/quanly/login.php"><i class="fa fa-user"></i> Đăng nhập </a>
				<?php endif; ?>
			</div>
		</div>
		<nav class="humberger__menu__nav mobile-menu">
			<ul>
				<li class="active"><a href="/Vsshop">Trang chủ</a></li>
				<li><a href="/Vsshop/frontend/sanpham/list.php">Danh sách</a>
				<ul class="header__menu__dropdown">
					<li><a href="/Vsshop/frontend/sanpham/introduce.php">Giới thiệu</a></li>
				</ul>
				</li>
				<li><a href="/Vsshop/frontend/lienhe/about.php">Liên hệ</a></li>
				<li><a href="/Vsshop/frontend/quanly/register.php">Đăng ký</a></li>
			</ul>
		</nav>
		<div id="mobile-menu-wrap"></div>
		<div class="header__top__right__social">
			<a href="#"><i class="fa fa-facebook"></i></a>
			<a href="#"><i class="fa fa-twitter"></i></a>
			<a href="#"><i class="fa fa-linkedin"></i></a>
			<a href="#"><i class="fa fa-pinterest-p"></i></a>
		</div>
		<div class="humberger__menu__contact">
			<ul>
				<li><i class="fa fa-envelope"></i> VSSHOP@gmail.com</li>
				<li>Miễn phí vận chuyển cho đơn hàng trên 100,000 VNĐ</li>
			</ul>
		</div>
	</div>
<header class="header">
		<div class="header__top">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<div class="header__top__left">
							<ul>
								<li><i class="fa fa-envelope"></i> VSSHOP@gmail.com</li>
								<li>Miễn phí vận chuyển cho đơn hàng trên 100,000 VNĐ</li>
							</ul>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="header__top__right">
							<div class="header__top__right__social">
								<a href="#"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-linkedin"></i></a>
								<a href="#"><i class="fa fa-pinterest-p"></i></a>
							</div>
							<div class="header__top__right__auth">
							<?php if(isset($_SESSION['kh_tendangnhap_logged_frontend'])) :?>
								<a href="/Vsshop/frontend/quanly/logout.php" data-toggle="tooltip" data-placement="top" title="Nhấn để đăng xuất"><i class="fa fa-user"></i> HI! <?= $_SESSION['kh_tendangnhap_logged_frontend']; ?></a>
							<?php else: ?>
								<a href="/Vsshop/frontend/quanly/login.php"><i class="fa fa-user"></i> Đăng nhập </a>
							<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-3">
					<div class="header__logo">
						<a href="/Vsshop"><img src="/Vsshop/assets/vendor/frontend/img/logo.png" alt="" style="width:80%; height:80%;"></a>
					</div>
				</div>
				<div class="col-lg-6">
					<nav class="header__menu">
						<ul>
							<li class="active"><a href="/Vsshop">Trang chủ</a></li>
							<li><a href="/Vsshop/frontend/sanpham/list.php">Danh sách</a>
							<ul class="header__menu__dropdown">
								<li><a href="/Vsshop/frontend/sanpham/introduce.php">Giới thiệu</a></li>
							</ul>
							</li>
							<li><a href="/Vsshop/frontend/lienhe/about.php">Liên hệ</a></li>
							<li><a href="/Vsshop/frontend/quanly/register.php">Đăng ký</a></li>
						</ul>
					</nav>
				</div>
				<div class="col-lg-3">
					<div class="header__cart">
						<ul>
							<li><a href="/Vsshop/frontend/sanpham/cart.php"><i class="fa fa-shopping-bag"></i> <span><?= $sosanpham ?></span></a></li>
						</ul>
						<div class="header__cart__price">Tổng tiền: <span><?=  number_format($tong, 2, ".", ",") . ' vnđ' ?></span></div>
					</div>
				</div>
			</div>
			<div class="humberger__open">
				<i class="fa fa-bars"></i>
			</div>
		</div>
	</header>