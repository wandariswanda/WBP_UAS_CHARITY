<?php

if (!function_exists('debugCode')){
	function debugCode($r=array(),$f=TRUE){
	  echo "<pre>";
	  print_r($r);
	  echo "</pre>";

	  if($f==TRUE)
	    die;
	}
}
if(!function_exists('showNotif')){
	function showNotif($notif_session){
		$alert = "";
		$type = array_keys($notif_session)[0];
		if($type == 'error'){
			$alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
									'.$notif_session['error'].'
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>';
		}elseif($type == 'success'){
			$alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
									'.$notif_session['success'].'
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>';
		}

		return $alert;
	}
}