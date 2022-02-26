<main class="xs-main">
<!-- event single section -->
<section class="xs-content-section-padding">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="xs-event-banner row">
					<div class="col-lg-8 cover-campaign">
						<img src="<?= base_url('assets/images/campaign/'.$campaign['image']) ?>" alt="Responsive image" class="img-fluid">
					</div>
					<div class="col-lg-4" style="line-height: 3;">
						<div color="red"><h2>Rp <?= number_format($campaign['fund_collected'], 0, ",", ".") ?></h2></div>
						<div>Target Pengumpulan : <span class="color-aqua">Rp <?= number_format($campaign['fund_target'], 0, ",", ".") ?></span></div>
						<div class="progress">
							<div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:<?= $campaign['fund_percentage'] ?>%">
								<?= $campaign['fund_percentage'] ?> %
							</div>
						</div>
						<div>
							Sisa Hari : <b><?= $campaign['days_left'] ?></b>
						</div>
						<div>
							<img src="<?= base_url($campaign['image']) ?>" alt="" class="pic-profile">
							<span style="position: absolute;font-size: 18px;font-weight: 900;margin: 10px;line-height: 24px;">
								<a href="#" class="color-aqua"><?= $campaign['full_name'] ?></a>
								<div class="my-rating-4" data-rating="4"></div>
							</span>
						</div><br>
						<!-- ShareThis BEGIN -->
						<!-- <div class="sharethis-inline-share-buttons"></div><script async src="//platform-api.sharethis.com/js/sharethis.js#property=5bf62fadea80c50011bc553c&product="inline-share-buttons"></script> -->
						<div class="sharethis-inline-share-buttons"></div>
						<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5bf62fadea80c50011bc553c&product=inline-share-buttons' async='async'></script>
						<!-- ShareThis END -->
						<center>
						<?php 
						if ($campaign['days_left'] == "SELESAI"): ?>
							<a href="javascript:;" class="btn btn-primary bg-danger form-control">
								<span class="badge"><i class="fa fa-heart"></i></span> Program sudah berakhir
							</a>
						<?php else: ?>
							<a href="<?= base_url('campaign/contribute/'.$campaign['url']) ?>" class="btn btn-primary form-control">
								<span class="badge"><i class="fa fa-heart"></i></span> Wakaf Sekarang
							</a>
						<?php endif ?>
						</center>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-lg-8 xs-event-wraper">
						<div class="xs-event-content">
							<h4><?= $campaign['name'] ?></h4>
							<p><?= $campaign['short_description'] ?></p>
						</div>
						<!-- horizontal tab -->
						<div class="xs-horizontal-tabs">
							<!-- Nav tabs -->
							<ul class="nav nav-tabs" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="tab" href="#deskripsi" role="tab">Deskripsi</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#update" role="tab">Update</a>
								</li>
							</ul><!-- .nav-tabs END -->

							<!-- Tab panes -->
							<div class="tab-content">
								<div class="tab-pane fade  show active" id="deskripsi" role="tabpanel">
									<p>
										<?= $campaign['description'] ?>	
									</p>
								</div>

								<div class="tab-pane" id="update" role="tabpanel">
								<?php 
									// $no = count($updateCampaign) + 1;
									// foreach ($updateCampaign as $update) {
									// $no--;
								?>
									<!-- Update Campaign -->
									<article class="post format-standard hentry xs-blog-post-details">
										<div class="xs-border line-border xs-padding-40">
											<div class="entry-content">
												<h6 class="text-right color-aqua">#Update 1</h6>
												<h2 class="entry-title xs-post-entry-title">
													<a href="javascript:;">judul update campaign</a>
													<h6><?= date("Y M d") ?></h6>
													<hr>
												</h2>
												<!-- <p>Founded by berlin's clubcommissioner alongside amsterdam's with nightori mayor, the creative footprint works with our partner Poor Advisor, local nyc scene experts and researchers to gather data need for regular life. </p> -->
												<div class="article-update">
													deskripsi
												</div>
											</div>
										</div>
									</article>
									<!-- End Update -->
								<?php 
									// }
								?>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<h4>Wakif : <span class="color-aqua">45</span></h4>
						<ul id="ajax_table"></ul>
						<br>
						<button class="btn btn-warning" id="load_more" data-val="0" style="width: 100%;">Tampilkan Selanjutnya
							<img style="display: none;" id="loader" src="http://www.trycatchclasses.com/code/demo/load-more-records-ci/asset/loader.GIF"> 
						</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
<script>
	$(document).ready(function(){
		getcountry(0);

		$("#load_more").click(function(e){
			e.preventDefault();
			var page = $(this).data('val');
			getcountry(page);

		});
//getcountry();
});

	var getcountry = function(page){
		$("#loader").show();
		$.ajax({
			url:"<?php echo base_url('front/getWakif/') ?>",
			type:'GET',
			data: {page:page}
		}).done(function(response){
			$("#ajax_table").append(response);
			$("#loader").hide();
			$('#load_more').data('val', ($('#load_more').data('val')+1));
			scroll();
		});
	};

	// var scroll  = function(){
	// 	$('html, body').animate({
	// 		scrollTop: $('#load_more').offset().top(300)
	// 	}, 1000);
	// };

</script>