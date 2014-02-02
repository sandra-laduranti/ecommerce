<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
			<meta http-equiv="X-UA-Compatible" content="IE=Edge">

			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

			<base href="<?= $baseURL ?>" >

			<link rel="shortcut icon" href="favicon.png" type="image/x-icon">

			<title><?= $titre ?></title>

			<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

			<link rel="stylesheet" type="text/css" href="/alcool_minimvc/styles/style.css"/>
			<link rel="stylesheet" type="text/css" href="/alcool_minimvc/styles/button.css"/>
	</head>

	<body>

		<div id="centreur">
			<?= $entete ?>

			<div id="corps">
				<?= $content ?>
			</div>

<div style="clear:both;"></div>

			<div id="footer">
				<p>	Copyright 2013-2014 - L'ABUS D'ALCOOL EST DANGEREUX POUR LA SANTE. A CONSOMMER AVEC MODERATION. </p>
			</div>
		</div>

	</body>
</html>