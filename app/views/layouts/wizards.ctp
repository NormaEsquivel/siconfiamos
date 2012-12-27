<!DOCTYPE html>
<!--[if IEMobile 7]><html class="no-js iem7 oldie"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html class="no-js ie7 oldie" lang="en"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html class="no-js ie8 oldie" lang="en"><![endif]-->
<!--[if (IE 9)&!(IEMobile)]><html class="no-js ie9" lang="en"><![endif]-->
<!--[if (gt IE 9)|(gt IEMobile 7)]><!--><html class="no-js" lang="en"><!--<![endif]-->

<?php 
	echo $this->Html->meta(
		array(
			'charset' => 'utf-8'
		)
	); 
	?>
	<?php echo $this->Html->meta(
		array(
			'http-equiv' => 'X-UA Compatible',
			'content' => 'IE=edge, chrome=1'
		)
	); ?>
	<title><?php echo 'Sistema Si Confiamos'; ?></title>
	
	<!--For all browsers-->
	<?php echo $this->Html->css('portal/reset.css?v=1'); ?>
	<?php echo $this->Html->css('portal/style.css?v=1'); ?>
	<?php echo $this->Html->css('portal/colors.css?v=1'); ?>
	<?php echo $this->Html->css('portal/print.css?v=1', null, array('media' => 'print')); ?>
	<!--For progressively larger displays -->
	<?php echo $this->Html->css('portal/480.css?v=1', null, array('media' => 'only all and (min-width:480px)')); ?>
	<?php echo $this->Html->css('portal/768.css?v=1', null, array('media' => 'only all and (min-width:768px)')); ?>
	<?php echo $this->Html->css('portal/992.css?v=1', null, array('media' => 'only all and (min-width:992px)')); ?>
	<?php echo $this->Html->css('portal/1200.css?v=1', null, array('media' => 'only all and (min-width:1200px)')); ?>
	<!--For Retina displays -->
	<?php echo $this->Html->css('portal/2x.css?v=1', null, array('media' => 'only all and (-webkit-min-device-pixel-ratio: 1.5), only screen and (-o-min-device-pixel-ratio: 3/2), only screen and (min-device-pixel-ratio: 1.5)')); ?>

	<!-- Additional styles -->
	<?php echo $this->Html->css('portal/form.css?v=1'); ?>
	<?php echo $this->Html->css('portal/switches.css?v=1'); ?>

	<!-- jQuery Form Validation -->
	<?php echo $this->Html->css('portal/formValidator/developr.validationEngine.css?v=1'); ?>

	<!-- JavaScript at bottom except for Modernizr -->
	<?php echo $this->Html->script('src/portal/libs/modernizr.custom.js'); ?>
	<!-- For Modern Browsers -->
	<link rel="shortcut icon" href="/img/portal/favicons/favicon.png">
	<!-- For everything else -->
	<link rel="shortcut icon" href="/img/portal/favicons/favicon.ico">
	<!-- For retina screens -->
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/img/favicons/portal/apple-touch-icon-retina.png">
	<!-- For iPad 1-->
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/img/favicons/portal/apple-touch-icon-ipad.png">
	<!-- For iPhone 3G, iPod Touch and Android -->
	<link rel="apple-touch-icon-precomposed" href="/img/portal/favicons/apple-touch-icon.png">
	<!-- iOs web-app metas -->
	<?php echo $this->Html->meta('apple-mobile-web-app-capable', 'yes'); ?>
	<?php echo $this->Html->meta('apple-mobile-web-app-status-bar-style', 'black'); ?>

	<!-- Startup image for web apps -->
	<link rel="apple-touch-startup-image" href="img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
	<link rel="apple-touch-startup-image" href="img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
	<link rel="apple-touch-startup-image" href="img/splash/iphone.png" media="screen and (max-device-width: 320px)">

	<link rel="apple-touch-startup-image" href="/img/portal/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
	<link rel="apple-touch-startup-image" href="/img/portal/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
	<link rel="apple-touch-startup-image" href="/img/portal/splash/iphone.png" media="screen and (max-device-width: 320px)">
	<!--Microsoft clear type rendering -->
	<?php echo $this->Html->meta(array(
			'http-equiv' => 'cleartype',
			'content' => 'on'
	)); ?>
	<!-- IE9 Pinned Sites : http://msdn.microsof.com/en-us/library/gg131029.aspx -->
	<?php echo $this->Html->meta('application-name', 'Developr Admin Skin'); ?>
	<?php echo $this->Html->meta('msapplication-tooltip', 'Cross-platform admin template.'); ?>
	<?php echo $this->Html->meta('msapplication-staturl', 'http://www.display-inline.fr/demo/developr'); ?>
	
</head>

<body class="full-page-wizard">
<?php echo $content_for_layout; ?>
	<!-- JavaScript at the bottom for fast page loading -->

	<!-- Scripts -->
	<?php echo $this->Html->script('src/portal/libs/jquery-1.8.2.min.js'); ?>
	<?php echo $this->Html->script('src/portal/setup.js'); ?>
	<!--Template function-->
	<?php echo $this->Html->script('src/portal/developr.input.js'); ?>
	<?php echo $this->Html->script('src/portal/developr.message.js'); ?>
	<?php echo $this->Html->script('src/portal/developr.scroll.js'); ?>
	<?php echo $this->Html->script('src/portal/developr.tooltip.js'); ?>
	<?php echo $this->Html->script('src/portal/developr.notify.js'); ?>
	<?php echo $this->Html->script('src/portal/developr.wizard.js'); ?>
	<!-- jQuery Form Validation -->
	<?php echo $this->Html->script('src/portal/libs/formValidator/jquery.validationEngine.js?v=1'); ?>	
	<?php echo $this->Html->script('src/portal/libs/formValidator/languages/jquery.validationEngine-es.js?v=1'); ?>	
	<?php echo $scripts_for_layout; ?>
</body>
</html>