<!doctype html>
<html class="no-js" lang="en">
<?php echo view("include/metadata.php"); ?>

<body>
	
	<?php 
		if (!empty($head_slider)) {
			echo view("include/header");
		}else{
			echo view("include/header3");
		}
	?>

	<?php echo view($content); ?>

	<?php echo view("include/footer"); ?>

	<?php echo view("include/script"); ?>
</body>
</html>