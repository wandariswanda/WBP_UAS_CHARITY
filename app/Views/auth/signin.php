<section class="xs-section-padding bg-gray">
	<div class="container">
		<div class="row">
			<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<div class="xs-donation-form-wraper" >
					<div class="xs-heading xs-mb-30">
						<h2 class="text-center">Hai, #kamu</h2>
						<p class="small text-center">Silakan login atau <a href="<?= base_url('signin/signup') ?>">daftar</a> untuk mengakses semua fitur Kitawakaf</p>
					</div>

          <?php 
            if(session()-> getFlashData())
              echo showNotif(session()->getFlashData());
          ?>
          
					<form action="<?= base_url('/do-login') ?>" method="POST" id="xs-donation-form" class="xs-donation-form" >
						<center>
							<div class="xs-input-group">
								<input type="text" name="username" class="form-control text-center <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>" placeholder="Username">
                <div class="invalid-feedback">
                  <?= $validation->getError('username') ?>
                </div>
							</div>
							<div class="xs-input-group">
								<input type="password" name="password" class="form-control text-center <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" placeholder="Password">
								<div class="invalid-feedback">
                  <?= $validation->getError('password') ?>
                </div>
							</div>
							<button type="submit" class="btn btn-success"><span class="badge">Masuk</button>
						</center>
					</form>
				</div>
			</div>
			<div class="col-lg-3"></div>
		</div>
	</div>
</section>