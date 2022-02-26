	<?php 
	// Session
	$session = \Config\Services::session();
	$is_logged = $session->get('logged_in');
?>
<header class="xs-header xs-fullWidth">
	<div class="container">
		<nav class="xs-menus">
			<div class="nav-header">
				<div class="nav-toggle"></div>
				<a href="<?= base_url() ?>" class="xs-nav-logo">
					<img src="<?= base_url() ?>assets/images/logo/logo_kw_blue_no_backgound.png" alt="">
				</a>
			</div><!-- .nav-header END -->
			<div class="nav-menus-wrapper row">
				<div class="xs-logo-wraper col-lg-3">
					<a class="nav-brand" href="<?= base_url() ?>" style="padding: 6px 0;">
						<!-- <img src="<?= base_url() ?>assets/images/logo/logo_kw_blue_no_backgound.png" alt=""> -->
						<img src="<?= base_url('assets/images/logo/logo-yuamal.png') ?>" alt="" style="width: 25%;">
					</a>
				</div><!-- .xs-logo-wraper END -->
				<div class="col-lg-9">
					<ul class="nav-menu">
						<li>
							<a href="#">Donasi</a>
						</li>
					<?php 
						if ($is_logged) {
					?>
						<li><a href="#">Akun</a>
							<ul class="nav-dropdown">
								<li><a href="<?= base_url("dashboard/campaign") ?>">Dashboard</a></li>
								<li><a href="<?= base_url("logout") ?>">Logout</a></li>
							</ul>
						</li>
					<?php 
						}else{
					?>
						<li><a href="#">Join</a>
							<ul class="nav-dropdown">
								<li><a href="#">Register</a></li>
								<li><a href="<?= base_url("login") ?>">Sign in</a></li>
							</ul>
						</li>
					<?php 
						}
					?>
					</ul><!-- .nav-menu END -->
				</div>
			</div><!-- .nav-menus-wrapper .row END -->
		</nav><!-- .xs-menus .fundpress-menu END -->
	</div><!-- .container end -->
</header><!-- End header section -->