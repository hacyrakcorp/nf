<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>NF note de frais</title>
		<link rel="icon" type="image/png" href="<?php echo $this->pathWeb('images/logo_Ndf.png'); ?>" />
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" >
		<link rel="stylesheet" type="text/css" href="<?php echo $this->pathWeb('css/style.css'); ?>" />
		<script src="<?php echo $this->pathWeb('js/jquery-3.2.1.min.js'); ?>" type="text/javascript"> </script>
                <script src="<?php echo $this->pathWeb('bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"> </script>
	</head>
	<body>
		<?php if ($this->getSessionParam('estAutenthifie') == 'false')
				{?>
				<header>
					<h1 id="En-tete">NF-CFAI84</h1>
				</header>
		<?php 	}?>
		<br>
		<div id="position_body">
        <?php if($this->erreurMessage != null): ?>
			<div class="alert col-lg-offset-1 col-lg-2 alert-danger alert-dismissible" role="alert">
				<!--<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>!-->
					<strong>Attention ! </strong><?php echo $this->erreurMessage; ?>
			</div>
        <?php endif ?>
		<?php if($this->infoMessage != null): ?>
			<div class="alert col-lg-2 alert-dismissable alert-info">
			<strong>Infos ! </strong><?php echo $this->infoMessage; ?>
			</div>
		<?php endif ?>