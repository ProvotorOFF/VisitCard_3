<?php

use app\components\MenuWidget;
?>
<div class="banner">
	<div class="w3l_banner_nav_left">
		<nav class="navbar nav_bottom">
			<div class="navbar-header nav_2">
				<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
				<?= MenuWidget::widget([
					'tpl' => 'menu',
					'ul_class' => 'nav navbar-nav nav_1'
				]) ?>
			</div>
		</nav>
	</div>