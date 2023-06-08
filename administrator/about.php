<?php

require_once 'core/init.php';

$user = new UserLogin(); //Current

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>ABOUT US</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/fontawesome-5.0.8/css/fontawesome-all.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
	<style>
	blockquote {  
		border-style: solid;
		border-width: 5px;
		font-size: 15px;
		font-style: italic;
		border-color: #eee #17b978;
		border-left: 5px solid #17b978;
		padding:20px;
	}
	</style>
</head>
<body class="animsition">
	
	<!-- Header -->
	<header>
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			
			<?php include 'includes/top-header.php'; ?>
			<!--  -->
			<?php include 'includes/wrap-main-nav.php'; ?>	
		</div>
	</header>

	<!-- Breadcrumb -->
	<div class="container">
		<div class="headline bg0 flex-wr-sb-c p-rl-20 p-tb-8">
			<div class="f2-s-1 p-r-30 m-tb-6">
				<a href="index.php" class="breadcrumb-item f1-s-3 cl9">
					Home 
				</a>

				<span class="breadcrumb-item f1-s-3 cl9">
					About Us
				</span>
			</div>
		</div>
	</div>

	<!-- Page heading -->
	<div class="container p-t-4 p-b-40">
		<h2 class="f1-l-1 cl2">
			ABOUT US
		</h2>
	</div>

	<!-- Content -->
	<section class="bg0 p-b-60">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-8 p-b-30">
					<div class="p-r-10 p-r-0-sr991">
						<p class="f1-s-11 cl6 p-b-25">
							The genesis of San Pedro College of Business Administration cannot be told without adverting to the life of a man – Mr. Cheng Eng Teng.  His was a story of adventures and guts, of patience and perseverance, of hard and rugged existence as a fisherman in the stormy seas of Mercedes near Daet, Camarines Norte of the Bicol Province.  For years he plodded on, eking out a living without ever enjoying the benefit of a formal education.  Mr.  Cheng often recalls vividly this hard life which was a continuation of the various  jobs he held like being an  a vendor and errand boy in Manila, Quezon, and other places in Luzon.
						</p>

						<p class="f1-s-11 cl6 p-b-25">
						</p>

						<p class="f1-s-11 cl6 p-b-25">
						</p>
						<blockquote>
							<b class="text-danger">PHILOSOPHY</b><hr>
							<p>Leaders of Distinction in Business, Industry and Society.</p>
						</blockquote>
						<blockquote>
							<b class="text-danger">VISION</b><hr>
							<p>A premier institution of higher learning in the Southern Tagalog Region committed to producing quality, technology-based and competitive graduates embodied with moral, social and ethical values who will be leaders in business, industry and society.</p>
						</blockquote>
						<blockquote>
							<b class="text-danger">MISSION</b><hr>
							<p>To prepare the students to become effective and competitive successful leaders of society capable of making sound contribution within the global market place</p>   
						</blockquote> 
					</div>
				</div>
				<!-- Sidebar -->
				<div class="col-md-5 col-lg-4 p-b-30">
					<div class="p-l-10 p-rl-0-sr991 p-t-5">
						<!-- Popular Posts -->
						<div>
							<div class="how2 how2-cl4 flex-s-c">
								<h3 class="f1-m-2 cl3 tab01-title">
									Popular Post
								</h3>
							</div>

							<ul class="p-t-35">
								<li class="flex-wr-sb-s p-b-30">
									<a href="#" class="size-w-10 wrap-pic-w hov1 trans-03">
										<img src="images/history.jpg" alt="IMG">
									</a>

									<div class="size-w-11">
										<h6 class="p-b-4">
											<a href="#" class="f1-s-5 cl3 hov-cl10 trans-03">
											
											</a>
										</h6>

										<span class="cl8 txt-center p-b-24">
											<a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
											</a>

											<span class="f1-s-3 m-rl-3">
											</span>

											<span class="f1-s-3">
											</span>
										</span>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<!-- Footer -->
	<?php include 'includes/footer.html'; ?>

	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<span class="fas fa-angle-up"></span>
		</span>
	</div>


<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>