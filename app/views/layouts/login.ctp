<!DOCTYPE html>
<!--[if IEMobile 7]><html class="no-js iem7 oldie"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html class="no-js ie7 oldie" lang="en"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html class="no-js ie8 oldie" lang="en"><![endif]-->
<!--[if (IE 9)&!(IEMobile)]><html class="no-js ie9" lang="en"><![endif]-->
<!--[if (gt IE 9)|(gt IEMobile 7)]><!--><html class="no-js linen" lang="en"><!--<![endif]-->

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
); 
?>
<title><?php echo 'Sistema Si Confiamos'; ?></title>
<!-- http://davidbcalhoun.com/2010/viewport-metatag -->
<?php echo $this->Html->meta('HandheldFriendly', 'True'); ?>
<?php echo $this->Html->meta('MobileOptimized', '320'); ?>
<?php echo $this->Html->meta('viewport', 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no'); ?>

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
<?php echo $this->Html->css('portal/styles/form.css?v=1'); ?>
<?php echo $this->Html->css('portal/styles/switches.css?v=1'); ?>

<!-- Login pages styles -->
<?php echo $this->Html->css('portal/login.css?v=1'); ?>

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
<body>

	<div id="container">

		<hgroup id="login-title" class="large-margin-bottom">
			<h1 class="login-title-image">Si Confiamos</h1>
			<h5>&copy; Manivela</h5>
		</hgroup>
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->Form->create('User', array(
			'url' => array(
				'controller' => 'users',
				'action' => 'login'
			),
			'id' => 'form-login'
		));
		?>
			<ul class="inputs black-input large">
				<!-- The autocomplete="off" attributes is the only way to prevent webkit browsers from filling the inputs with yellow -->
				<li>
					<?php 
					echo $this->Form->input('name', array(
						'before' => '<span class="icon-user mid-margin-right"></span>',
						'div' => false,
						'class' => 'input-unstyled',
						'placeholder' => 'Nombre de Usuario',
						'autocomplete' => 'off',
						'after' => '</span>',
						'label' => false
					)); 
					?>
				</li>
				<li>
					<?php 
					echo $this->Form->input('password', array(
						'before' => '<span class="icon-lock mid-margin-right"></span>',
						'div' => false,
						'class' => 'input-unstyled',
						'placeholder' => 'Contraseña',
						'autocomplete' => 'off',
						'after' => '</span>',
						'label' => false,
						'type' => 'password'
					)); 
					?>
				</li>
			</ul>
			<button type="submit" class="button glossy full-width huge">Login</button>
		</form>

	</div>

	<!-- JavaScript at the bottom for fast page loading -->

	<!-- Scripts -->
	<?php echo $this->Html->script('src/portal/libs/jquery-1.8.2.min.js'); ?>
	<?php echo $this->Html->script('src/portal/setup.js'); ?>

	<!-- Template functions -->
	<!--Template function-->
	<?php echo $this->Html->script('src/portal/developr.input.js'); ?>
	<?php echo $this->Html->script('src/portal/developr.message.js'); ?>
	<?php echo $this->Html->script('src/portal/developr.tooltip.js'); ?>
	<?php echo $this->Html->script('src/portal/developr.notify.js'); ?>

	<script>

		/*
		 * How do I hook my login script to this?
		 * --------------------------------------
		 *
		 * This script is meant to be non-obtrusive: if the user has disabled javascript or if an error occurs, the login form
		 * works fine without ajax.
		 *
		 * The only part you need to edit is the login script between the EDIT SECTION tags, which does inputs validation
		 * and send data to server. For instance, you may keep the validation and add an AJAX call to the server with the
		 * credentials, then redirect to the dashboard or display an error depending on server return.
		 *
		 * Or if you don't trust AJAX calls, just remove the event.preventDefault() part and let the form be submitted.
		 */

		$(document).ready(function()
		{
			/*
			 * JS login effect
			 * This script will enable effects for the login page
			 */
				// Elements
			var doc = $('html').addClass('js-login'),
				container = $('#container'),
				formLogin = $('#form-login'),

				// If layout is centered
				centered;

			/******* EDIT THIS SECTION *******/

			/*
			 * AJAX login
			 * This function will handle the login process through AJAX
			 */
			// formLogin.submit(function(event)
			// {
			// 	// Values
			// 	var login = $.trim($('#login').val()),
			// 		pass = $.trim($('#pass').val());

			// 	// Check inputs
			// 	if (login.length === 0)
			// 	{
			// 		// Display message
			// 		displayError('Please fill in your login');
			// 		return false;
			// 	}
			// 	else if (pass.length === 0)
			// 	{
			// 		// Remove empty login message if displayed
			// 		formLogin.clearMessages('Please fill in your login');

			// 		// Display message
			// 		displayError('Please fill in your password');
			// 		return false;
			// 	}
			// 	else
			// 	{
			// 		// Remove previous messages
			// 		formLogin.clearMessages();

			// 		// Show progress
			// 		displayLoading('Checking credentials...');
			// 		event.preventDefault();

			// 		// Stop normal behavior
			// 		event.preventDefault();

					
			// 		 * This is where you may do your AJAX call, for instance:
			// 		 * $.ajax(url, {
			// 		 * 		data: {
			// 		 * 			login:	login,
			// 		 * 			pass:	pass
			// 		 * 		},
			// 		 * 		success: function(data)
			// 		 * 		{
			// 		 * 			if (data.logged)
			// 		 * 			{
			// 		 * 				document.location.href = 'index.html';
			// 		 * 			}
			// 		 * 			else
			// 		 * 			{
			// 		 * 				formLogin.clearMessages();
			// 		 * 				displayError('Invalid user/password, please try again');
			// 		 * 			}
			// 		 * 		},
			// 		 * 		error: function()
			// 		 * 		{
			// 		 * 			formLogin.clearMessages();
			// 		 * 			displayError('Error while contacting server, please try again');
			// 		 * 		}
			// 		 * });
					 

			// 		// Simulate server-side check
			// 		setTimeout(function() {
			// 			document.location.href = './'
			// 		}, 2000);
			// 	}
			// });

			/******* END OF EDIT SECTION *******/

			// Handle resizing (mostly for debugging)
			function handleLoginResize()
			{
				// Detect mode
				centered = (container.css('position') === 'absolute');

				// Set min-height for mobile layout
				if (!centered)
				{
					container.css('margin-top', '');
				}
				else
				{
					if (parseInt(container.css('margin-top'), 10) === 0)
					{
						centerForm(false);
					}
				}
			};

			// Register and first call
			$(window).bind('normalized-resize', handleLoginResize);
			handleLoginResize();

			/*
			 * Center function
			 * @param boolean animate whether or not to animate the position change
			 * @param string|element|array any jQuery selector, DOM element or set of DOM elements which should be ignored
			 * @return void
			 */
			function centerForm(animate, ignore)
			{
				// If layout is centered
				if (centered)
				{
					var siblings = formLogin.siblings(),
						finalSize = formLogin.outerHeight();

					// Ignored elements
					if (ignore)
					{
						siblings = siblings.not(ignore);
					}

					// Get other elements height
					siblings.each(function(i)
					{
						finalSize += $(this).outerHeight(true);
					});

					// Setup
					container[animate ? 'animate' : 'css']({ marginTop: -Math.round(finalSize/2)+'px' });
				}
			};

			// Initial vertical adjust
			centerForm(false);

			/**
			 * Function to display error messages
			 * @param string message the error to display
			 */
			function displayError(message)
			{
				// Show message
				var message = formLogin.message(message, {
					append: false,
					arrow: 'bottom',
					classes: ['red-gradient'],
					animate: false					// We'll do animation later, we need to know the message height first
				});

				// Vertical centering (where we need the message height)
				centerForm(true, 'fast');

				// Watch for closing and show with effect
				message.bind('endfade', function(event)
				{
					// This will be called once the message has faded away and is removed
					centerForm(true, message.get(0));

				}).hide().slideDown('fast');
			}

			/**
			 * Function to display loading messages
			 * @param string message the message to display
			 */
			function displayLoading(message)
			{
				// Show message
				var message = formLogin.message('<strong>'+message+'</strong>', {
					append: false,
					arrow: 'bottom',
					classes: ['blue-gradient', 'align-center'],
					stripes: true,
					darkStripes: false,
					closable: false,
					animate: false					// We'll do animation later, we need to know the message height first
				});

				// Vertical centering (where we need the message height)
				centerForm(true, 'fast');

				// Watch for closing and show with effect
				message.bind('endfade', function(event)
				{
					// This will be called once the message has faded away and is removed
					centerForm(true, message.get(0));

				}).hide().slideDown('fast');
			}
		});

	</script>

</body>
</html>