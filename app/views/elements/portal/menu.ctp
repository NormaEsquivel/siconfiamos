<section class="navigable">
<?php if(!isset($menu_elements)): ?>
	<ul class="big-menu">
		<li class="with-right-arrow">
			<span><span class="list-count">3</span>Root element</span>
			<ul class="big-menu">
				<li><a href="#">Children element</a></li>
				<li><a href="#">Children element</a></li>
				<li><a href="#">Children element</a></li>
				<li class="with-right-arrow">
					<span>Children with subs</span>
					<ul class="big-menu">
						<li><a href="#">Children element</a></li>
						<li><a href="#">Children element</a></li>
						<li><a href="#">Children element</a></li>
					</ul>
				</li>
			</ul>
		</li>
		<li>Victor</li>
	</ul>
<?php
else:
	App::import('Vendor' , 'format');
	$format = new format();

	$menu = $format->menugenerator($menu_elements, '</ul>', '<ul class="big-menu">');
	echo $menu['menu'] . $menu['close_element'];
endif;
?>
</section>