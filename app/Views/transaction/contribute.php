<section class="xs-section-padding bg-gray" id="regForm">
 	<div class="container">
 		<div class="row">
 			<div class="col-lg-1"></div>
 			<div class="col-lg-10">
 				<div class="xs-donation-form-wraper" >
 					<div class="xs-heading xs-mb-30">
 						<h4 class="text-center">Kamu akan berwakaf untuk program</h4>
 						<h5 class="text-center color-aqua"><?= $campaign['name'] ?></h5>
 					</div>
 					<?php 
            if(session()-> getFlashData())
              echo showNotif(session()->getFlashData());
          ?>
 					<form action="<?= base_url('campaign/payment') ?>" method="POST" id="xs-donation-form" class="xs-donation-form" >
 						<center>
 							<div class="tab">
 								<div class="xs-input-group">
 									<h6>Jumlah yang akan didonasikan</h6>
 									<input type="hidden" name="url" class="form-control" value="<?= $campaign['url'] ?>">
 									<input type="text" name="nominal" class="form-control uang" placeholder="Contoh : 10.000" oninput="this.className = ''">
 								</div>
 								<div class="xs-input-group" style="margin-top: -18px;">
 									<label class="--checkbox text-left">Berdonasi sebagai Anonim
                    <input type="checkbox" value="1" name="on_behalf">
                    <span class="checkmark"></span>
                  </label>	
                </div>
                <div class="xs-input-group">
                  <h6>Kirim Pesan</h6>
                  <textarea name="contribute_msg" class="form-control" rows="3"></textarea>
                </div>
              </div>

              <div class="tab">
                <?php
                  if (empty($dataNadzir)) {
                ?>
                    <div class="xs-input-group">
                      <h6>Nama Lengkap</h6>
                      <input type="text" name="full_name" id="xs-donate-name" class="form-control" placeholder="Nama Lengkap">
                    </div>

                    <div class="xs-input-group">
                      <h6>Alamat Email</h6>
                      <input type="text" name="email" id="xs-donate-name" class="form-control" placeholder="Email">
                    </div>
                <?php
                  }
                ?>

                <div class="xs-input-group">
                  <h6>No Telepon</h6>
                  <input type="text" name="no_telp" id="xs-donate-name" class="form-control" placeholder="Contoh : 08XX XXXX XXXX" value="" required="">
                </div>

                <div class="xs-input-group">
                    <h6>Pilih Metode Pembayaran</h6>
                    <select class="form-control" name="bank">
                    <?php 
                    //  foreach ($bank as $lBank) {
                    ?>
                       <option value="1">bank</option>
                    <?php 
                    //  }
                    ?>
                   </select>
                 </div>
              </div>

             <!-- <button type="submit" class="btn btn-warning"><span class="badge">Masuk</button> -->
             </center>
             <div style="overflow:auto;">
               <!-- <div style="float:right;"> -->
                <center id="next">
                 <button type="button" id="prevBtn" onclick="nextPrev(-1)" class="btn btn-warning bg-dan">Sebelumnya</button>
                 <button type="button" id="nextBtn" onclick="nextPrev(1)" class="btn btn-success">Selanjutnya</button>
               </center>
               <!-- </div> -->
             </div>
             <div style="text-align:center;margin-top:40px;">
              <span class="step"></span>
              <span class="step"></span>
            </div>
          </form>
        </div>
      </div>
      <div class="col-lg-1"></div>
    </div>
  </div>
</section>

<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the crurrent tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
  	document.getElementById("prevBtn").style.display = "none";
  } else {
  	document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
  	// document.getElementById("nextBtn").innerHTML = "Submit";
  	// $("#nextBtn").prop("type", "submit");
  	$("#next").empty();
  	$("#next").append(' <button type="button" id="prevBtn" onclick="nextPrev(-1)" class="btn btn-warning bg-dan">Sebelumnya</button>&emsp;'+
  		'<button type="submit" id="nextBtn" onclick="nextPrev(1)" class="btn btn-success">Selanjutnya</button>');
  } else {
  	// document.getElementById("nextBtn").innerHTML = "Selanjutnya";
  	$("#nextBtn").prop("type", "button");
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");

  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {

    // If a field is empty...
    if (y[i].value == "") {

      // add an "invalid" class to the field:
      y[i].className += " invalid";

      // and set the current valid status to false
      valid = false;
    }
  }

  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
  	document.getElementsByClassName("step")[currentTab].className += " finish";
  }

  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
  	x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script>
