<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>NF note de frais</title>
		<link rel="icon" type="image/png" href="<?php echo $this->pathWeb('images/logo_Ndf.png'); ?>" />
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" >
		<link rel="stylesheet" type="text/css" href="<?php echo $this->pathWeb('css/style.css'); ?>" />
		<script src="web/js/jquery-3.2.1.min.js" type="text/javascript"> </script>
	</head>
	<body>		
		<br>
        <?php if($this->erreurMessage != null): ?>
			<div class="alert col-lg-offset-1 col-lg-2 alert-danger">
				<strong>Attention ! </strong><?php echo $this->erreurMessage; ?>
			</div>
		   <!-- <div class="erreur"><?php //echo $this->erreurMessage; ?></div>
		   !-->
        <?php endif ?>
		<?php if($this->infoMessage != null): ?>
			<div class="alert col-lg-2 alert-info">
			<strong>Infos ! </strong><?php echo $this->infoMessage; ?>
			</div>
		<?php endif ?>