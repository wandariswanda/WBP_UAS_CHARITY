<section class="xs-content-section-padding position-dash">
	<div class="container">
		<div class="row col-md-12 mx-auto">
			<?php echo view("user/menu/sidemenu"); ?>
			<div class="col-lg-9">
        <!-- Show notif -->
        <?php 
          if(session()-> getFlashData())
            echo showNotif(session()->getFlashData());
        ?>
        <!-- End show notif -->
				<h5><?= $title_dashboard ?></h5><hr>
				<div class="tab-content" id="v-pills-tabContent">
					<div class="tab-pane slideUp active show" id="water" role="tabpanel">
						<div class="row">
							<div class="col-md-6">
								<div class="dash_card">
									<img src="<?= base_url() ?>assets/images/icon_dashboard/icon_campaign_small_square.png" alt="" width="80" style="border-radius: 50%;">
									<span class="text_count">1</span>
									<div>Program dimulai</div>
								</div>
							</div>
							<!-- <div class="col-md-3">
								<div class="dash_card">
									<img src="https://c4.wallpaperflare.com/wallpaper/778/348/985/anime-one-piece-brook-one-piece-franky-one-piece-wallpaper-preview.jpg" alt="" width="80" style="border-radius: 50%;">
									<span class="text_count">1</span>
									<div>Wakaf</div>
								</div>
							</div> -->
							<div class="col-md-6">
								<div class="dash_card">
									<img src="<?= base_url() ?>assets/images/icon_dashboard/icon_donasi_small_square.png" alt="" width="80" style="border-radius: 50%;">
									<span class="text_count">Rp <?= number_format(5000, 0, ",", ".") ?></span>
									<div>Dana Terkumpul</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="xs-tab-content">
									<h5>Berikut ini adalah dashboard untuk nadzir</h5>
									<p>
										<b>Program dimulai</b> menunjukkan banyaknya keseluruhan program yang diinisiasi oleh Anda.<br>
										<b>Dana terkumpul</b> merupakan jumlah total dari dana yang sudah masuk dari keseluruhan program yang diinisiasi oleh Anda.
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

