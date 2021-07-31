<!DOCTYPE html>
<html lang="zxx">

<head>
	<meta charset="UTF-8">
	<meta name="description" content="Ogani Template">
	<meta name="keywords" content="Ogani, unica, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Vsshop | Liên hệ</title>

	<?php include_once __DIR__.'/../layouts/meta.php';?>
	<?php include_once __DIR__.'/../layouts/style.php';?>
</head>

<body>
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<?php include_once __DIR__.'/../layouts/partials/header.php';?>

	<?php include_once __DIR__.'/../layouts/partials/sidebar.php';?>

	 <!-- Breadcrumb Section Begin -->
	 <section class="breadcrumb-section set-bg" data-setbg="/Vsshop/assets/vendor/frontend/img/breadcrumb.jpg">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="breadcrumb__text">
						<h2>Liên hệ</h2>
						<div class="breadcrumb__option">
							<a href="/Vsshop">Trang chủ</a>
							<span>Liên hệ</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Breadcrumb Section End -->

	<!-- Contact Section Begin -->
	<section class="contact spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-6 text-center">
					<div class="contact__widget">
						<span class="icon_phone"></span>
						<h4>Phone</h4>
						<p>+123456789</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 text-center">
					<div class="contact__widget">
						<span class="icon_pin_alt"></span>
						<h4>Address</h4>
						<p>123/456 ABC</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 text-center">
					<div class="contact__widget">
						<span class="icon_clock_alt"></span>
						<h4>Mở cửa</h4>
						<p>7:00 am to 10:00 pm</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 text-center">
					<div class="contact__widget">
						<span class="icon_mail_alt"></span>
						<h4>Email</h4>
						<p>VSSHOP@gmail.com</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Contact Section End -->

	<!-- Map Begin -->
	<div class="map">
		<iframe
			src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d49116.39176087041!2d-86.41867791216099!3d39.69977417971648!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x886ca48c841038a1%3A0x70cfba96bf847f0!2sPlainfield%2C%20IN%2C%20USA!5e0!3m2!1sen!2sbd!4v1586106673811!5m2!1sen!2sbd"
			height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
		<div class="map-inside">
			<i class="icon_pin"></i>
			<div class="inside-widget">
				<h4>Việt Nam</h4>
				<ul>
					<li>Điện thoại: +123456789</li>
					<li>Địa chỉ: 123/456 ABC</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- Map End -->

	<!-- Contact Form Begin -->
	<div class="contact-form spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="contact__form__title">
						<h2>TIN NHẮN</h2>
					</div>
				</div>
			</div>
			<form  method="post" action="">
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<input type="email"  id="email" name="email" placeholder="Email của bạn">
					</div>
					<div class="col-lg-6 col-md-6">
						<input type="text"id="title" name="title" placeholder="Tiêu đề của bạn">
					</div>
					<div class="col-lg-12 text-center">
						<textarea name="message" placeholder="Lời nhắn của bạn"></textarea>
						<button type="submit" class="site-btn" name="btnGoiLoiNhan">GỬI LỜI NHẮN</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- Contact Form End -->
	<?php
		// Load các thư viện (packages) do Composer quản lý vào chương trình
		require_once __DIR__.'/../../vendor/autoload.php';

		// Sử dụng thư viện PHP Mailer
		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\Exception;

		if (isset($_POST['btnGoiLoiNhan'])) {
			// Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
			$email = $_POST['email'];
			$title = $_POST['title'];
			$message = $_POST['message'];

			// Gởi mail kích hoạt tài khoản
			$mail = new PHPMailer(true);                                // Passing `true` enables exceptions
			try {
				//Server settings
			//	$mail->SMTPDebug = 2;                                   // Enable verbose debug output
				$mail->isSMTP();                                        // Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com';                         // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                                 // Enable SMTP authentication
				$mail->Username = 'socquayct@gmail.com'; 				// SMTP username
				$mail->Password = 'charovdflhaidfhy';                   // SMTP password
				$mail->SMTPSecure = 'tls';                              // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 587;                                      // TCP port to connect to
				$mail->CharSet = "UTF-8";

				// Bật chế bộ tự mình mã hóa SSL
				$mail->SMTPOptions = array(
					'ssl' => array(
						'verify_peer' => false,
						'verify_peer_name' => false,
						'allow_self_signed' => true
					)
				);

				//Recipients
				$mail->setFrom('socquayct@gmail.com', 'Mail Liên hệ');
				$mail->addAddress($email);               // Add a recipient
				//$mail->addReplyTo($email);
				// $mail->addCC('cc@example.com');
				// $mail->addBCC('bcc@example.com');

				//Attachments
				// $mail->addAttachment('/var/tmp/file.tar.gz');        // Add attachments
				// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');   // Optional name

				//Content
				$mail->isHTML(true);                                    // Set email format to HTML

				// Tiêu đề Mail
				$mail->Subject = "[Có người liên hệ] - $title";         

				// Nội dung Mail
				// Lưu ý khi thiết kế Mẫu gởi mail
				// - Chỉ nên sử dụng TABLE, TR, TD, và các định dạng cơ bản của CSS để thiết kế
				// - Các đường link/hình ảnh có sử dụng trong mẫu thiết kế MAIL phải là đường dẫn WEB có thật, ví dụ như logo,banner,...
				$body = <<<EOT
	Có người liên hệ cần giúp đỡ. <br />
	Email của khách: $email <br />
	Nội dung: <br />
	$message
EOT;
				$mail->Body    = $body;

				$mail->send();
				echo '<script>
				location.href="/Vsshop/frontend/lienhe/about.php";
				alert("Gửi lời thành công");
			</script>';
			} catch (Exception $e) {
				echo 'Lỗi khi gởi mail: ', $mail->ErrorInfo;
			}
		}
		?>
		<!-- End block content -->

	<?php include_once __DIR__.'/../layouts/partials/footer.php';?>

	<?php include_once __DIR__.'/../layouts/script.php';?>
</body>
</html>