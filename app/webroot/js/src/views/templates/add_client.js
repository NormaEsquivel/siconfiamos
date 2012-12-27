$(document).ready(function(){
				// Elements
			var form = $('.wizard'),

				// If layout is centered
				centered;

			// Handle resizing (mostly for debugging)
			function handleWizardResize()
			{
				centerWizard(false);
			};

			// Register and first call
			$(window).bind('normalized-resize', handleWizardResize);

			/*
			 * Center function
			 * @param boolean animate whether or not to animate the position change
			 * @return void
			 */
			function centerWizard(animate)
			{
				form[animate ? 'animate' : 'css']({ marginTop: Math.max(0, Math.round(($.template.viewportHeight-30-form.outerHeight())/2))+'px' });
			};

			// Initial vertical adjust
			centerWizard(false);

			// Refresh position on change step
			form.on('wizardchange', function() { centerWizard(true); });

			// Validation
			if ($.validationEngine)
			{
				form.validationEngine();
			}
});