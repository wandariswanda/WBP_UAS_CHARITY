<!-- service slider section -->
<div class="xs-funfact-section-v2 waypoint-tigger" style="background-image: url('assets/images/map_green.png');background-color: #0e0055;color: #fff;">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-6">
				<div class="xs-single-funFact funFact-v2">
					 <!-- class for count persentase number-percentage -->
					<span class="number-percentage-count" data-value="<?= $stats['total_disbursement'] ?>" data-animation-duration="3500"><?= $stats['total_disbursement'] ?></span>
					<small>Program Terdanai</small>
				</div>
			</div>
			<!-- <div class="col-lg-6 col-md-6">
				<div class="xs-single-funFact funFact-v2">
					<span style="text-transform: capitalize;">Rp </span>&nbsp;&nbsp;<span class="number-percentage-count" data-value="5000" data-animation-duration="3500"> <?= number_format(5000, 0, ",", ".") ?></span>
					<small>Total Dana Terkumpul</small>
				</div>
			</div> -->
			<div class="col-lg-4 col-md-6">
				<div class="xs-single-funFact funFact-v2">
					<span class="number-percentage-count" data-value="<?= $stats['total_user'] ?>" data-animation-duration="3500"><?= $stats['total_user'] ?></span>
					<small>Orang Baik</small>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="xs-single-funFact funFact-v2">
					<span class="number-percentage-count" data-value="<?= $stats['total_campaign'] ?>" data-animation-duration="3500"><?= $stats['total_campaign'] ?></span>
					<small>Program</small>
				</div>
			</div>
		</div>
	</div>
</div>	
<!-- end service slider section -->
<!-- Campaign -->
<section class="bg-gray waypoint-tigger xs-section-padding section-padding">
	<div class="container">
		<div class="xs-heading row xs-mb-60">
			<div class="col-md-9 col-xl-9">
				<h2 class="xs-title">List Program</h2>
				<p>Halo #orangbaik, pilih program yang ingin Anda bantu</p>
			</div>
			<div class="col-xl-3 col-md-3 xs-btn-wraper">
				<a href="<?= base_url('campaign/list/all') ?>" class="btn btn-primary">Lihat Semua</a>
			</div>
		</div>
		<div class="row">
			<?php 
				foreach ($list_campaign as $value) {
			?>
				<a href="<?= base_url('campaign/v/'.$value['url']) ?>">
					<div class="col-lg-4 col-md-6">
						<div class="xs-popular-item xs-box-shadow">
							<div class="xs-item-header">
								<img src="<?= base_url('assets/images/campaign/'.$value['image']) ?>" class="img-campaign img-fluid" alt="">
								<div class="xs-skill-bar">
									<div class="xs-skill-track" style="width: 0%;">
										<p style="right: -24px;"><span class="number-percentage-count number-percentage" data-value="<?= $value['fund_percentage'] ?>" data-animation-duration="3500"><?= $value['fund_percentage'] ?></span>%</p>
									</div>
								</div>
							</div>
							<div class="xs-item-content">
								<!-- <ul class="xs-simple-tag xs-mb-20">
									<li><a href="javascript:;">program tipe</a></li>
								</ul> -->
								<a href="<?= base_url('campaign/v/'.$value['url']) ?>" class="xs-post-title xs-mb-30"><?= $value['name'] ?></a>
								<ul class="xs-list-with-content">
									<li class="days-pos">Rp <?= number_format($value['fund_collected'], 0, ",", ".") ?><span>Dana Terkumpul</span></li>
									<li><?= $value['days_left'] ?><span>Sisa Hari</span></li>
								</ul>

								<span class="xs-separetor"></span>

								<div class="row xs-margin-0">
									<div class="xs-round-avatar">
										<img src="https://images3.alphacoders.com/905/thumb-1920-905410.jpg" alt="">
									</div>
									<div class="xs-avatar-title">
										<a href="#"><?= $value['full_name'] ?></a>
										<div class="my-rating-4" data-rating="5"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</a>
			<?php 
    		} 
    	?>
		</div>
	</div>
</section>
<!-- End Campaign -->