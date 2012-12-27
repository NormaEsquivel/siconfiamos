<!DOCTYPE html>
<!--[if IEMobile 7]><html class="no-js iem7 oldie"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html class="no-js ie7 oldie" lang="en"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html class="no-js ie8 oldie" lang="en"><![endif]-->
<!--[if (IE 9)&!(IEMobile)]><html class="no-js ie9" lang="en"><![endif]-->
<!--[if (gt IE 9)|(gt IEMobile 7)]><!--><html class="no-js" lang="en"><!--<![endif]-->

<head>
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
	
	<!--Webfonts-->
	<?php echo $this->Html->css('http://fonts.googleapis.com/css?family=Open+Sans:300'); ?>

	<!-- Additional styles -->
	<?php echo $this->Html->css('portal/styles/form.css?v=1'); ?>
	<?php echo $this->Html->css('portal/styles/switches.css?v=1'); ?>
	<?php echo $this->Html->css('portal/styles/table.css?v=1'); ?>
	<?php echo $this->Html->css('portal/glDatePicker/developr.css'); ?>
	<!-- DataTables -->
	<?php echo $this->Html->css('portal/DataTables/jquery.dataTables.css?v=1'); ?>
	<!--JavaScript at botton except for Modernizr -->
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

<body class = "clearfix with-menu with-shortcuts">
	<!-- Prompt IE 6 users to install Chrome Frame -->
	<!--[if lt IE 7]>
	<p class="message red-gradient simpler">Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> 
	or 
	<a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p>
	<![endif]-->
	<header role="banner" id="title-bar">
		<h2>Si Confiamos</h2>
	</header>

	<!-- Button to open/hide menu -->
	<a href="#" id="open-menu"><span>Menu</span></a>

	<!-- Button to open/hide shortcuts -->
	<a href="#" id="open-shortcuts"><span class="icon-thumbs"></span></a>

	<!-- Main content -->
	<section role="main" id="main">
		<!-- Visible only to browsers without javascript -->
		<noscript class="message black-gradient simpler">Your browser does not support JavaScript! Some features won't work as expected...</noscript>
		<!--Main title-->
		<hgroup id="main-title" class="thin">
			<h1><?php echo $title_for_layout; ?></h1>
		</hgroup>
		<!-- The padding wrapper may be omitted -->
		<div class="with-padding">
			<!-- Main content here -->
			<?php echo $content_for_layout; ?>
		</div>
	</section>
	<!-- End main content -->

	<!-- Side tabs shortcuts -->
	<ul id="shortcuts" role="complementary" class="children-tooltip tooltip-right">
		<!-- Active shortcut -->
		<li class = <?php echo $firstElementClass; ?>>
			<?php 
			echo $this->Html->link('Clientes', array(
				'controller' => 'users', 
				'action' => 'sesion', 
				1
			), 
			array(
				'class' => 'shortcut-messages',
				'title' => 'Clientes'
			)); 
			?>
		</li>
		<!-- Background shortcut -->
		<li class = <?php echo $secondElementClass; ?>>
			<?php 
			echo $this->Html->link('Empresas', array(
				'controller' => 'users', 
				'action' => 'sesion', 
				2
			), 
			array(
				'class' => 'shortcut-agenda',
				'title' => 'Empresas'
			)); 
			?>
		</li>
		<!-- Disabled shortcut -->
		<li class = <?php echo $thirdElementClass; ?>>
			<?php 
			echo $this->Html->link('Pagos', array(
				'controller' => 'abonos', 
				'action' => 'elegir_empresa'
			), 
			array(
				'class' => 'shortcut-dashboard',
				'title' => 'Pagos'
			)); 
			?>
		</li>
		<li class = <?php echo $fourthElementClass; ?>>
			<?php 
			echo $this->Html->link('Reportes', array(
				'controller' => 'cobros', 
				'action' => 'reports_index'
			), 
			array(
				'class' => 'shortcut-contacts',
				'title' => 'Reportes'
			)); 
			?>
		</li>
	</ul>

	<!-- Sidebar/drop-down menu -->
	<section id="menu" role="complementary">
		<!-- This wrapper is used by several responsive layouts -->
		<div id="menu-content">
			<header>
				Administrator
			</header>
			<div id="profile">
				<?php echo $this->Html->image('portal/user.png', array('class' => 'user-icon')); ?>
				Hola
				<span class="name"><?php echo $auth_user['User']['nombre']; ?></span>
			</div>
			<!-- By default, this section is made for 4 icons, see the doc to learn how to change this, in "basic markup explained" -->

			<?php echo $this->element('portal/menu'); ?>
			<!-- Navigation menu goes here -->
		</div>
		<!-- End content wrapper -->

	</section>
	<!-- End sidebar/drop-down menu -->
	<!-- JavaScript at the bottom for fast page loading -->

	<!-- Scripts -->
	<?php echo $this->Html->script('src/portal/libs/jquery-1.8.2.min.js'); ?>
	<?php echo $this->Html->script('src/portal/setup.js'); ?>
	<!--Template function-->
	<?php echo $this->Html->script('src/portal/developr.input.js'); ?>
	<?php echo $this->Html->script('src/portal/developr.navigable.js'); ?>
	<?php echo $this->Html->script('src/portal/developr.scroll.js'); ?>
	<?php echo $this->Html->script('src/portal/developr.tooltip.js'); ?>
	<?php echo $this->Html->script('src/portal/developr.table.js'); ?>
	<?php echo $this->Html->script('src/portal/developr.tabs.js'); ?>

	<!-- Libs go here -->
	<?php echo $this->Html->script('src/portal/libs/jquery.tablesorter.min.js'); ?>
	<?php echo $this->Html->script('src/portal/libs/glDatePicker/glDatePicker.min.js'); ?>
	<?php echo $this->Html->script('src/portal/libs/DataTables/jquery.dataTables.min.js'); ?>
	<?php echo $scripts_for_layout; ?>
</body>
</html>

