<?

use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$row = 0;

?>
<div class="products-breadcrumb">
	<div class="container">
		<ul>
			<li><i class="fa fa-home" aria-hidden="true"></i><a href="<?= Url::home() ?>">Home</a><span>|</span></li>
			<li>Оформление заказа</li>
		</ul>
	</div>
</div>
<?= $this->render('/layouts/inc/sidebar') ?>
<div class="w3l_banner_nav_right">
	<!-- about -->
	<div class="privacy about">
		<?= Alert::widget() ?>
		<h3>Chec<span>kout</span></h3>
		<? if (!empty($session['cart'])): ?>
			<div class="checkout-right">
				<h4>Your shopping cart contains: <span><?= $session['cart.qty'] ?? 0 ?> Products</span></h4>
				<div class="cart-table">
					<div class="overlay">
						<i class="fa fa-refresh fa-spin"></i>
					</div>
					<table class="timetable_sub">
						<thead>
							<tr>
								<th>SL No.</th>
								<th>Product</th>
								<th>Quantity</th>
								<th>Product Name</th>

								<th>Price</th>
								<th>Remove</th>
							</tr>
						</thead>
						<tbody>
							<? foreach (($session['cart'] ?? []) as $id => $item): ?>
								<tr>
									<td class="invert"><?= ++$row ?></td>
									<td class="invert-image">
										<a href="<?= Url::to(['product/view', 'id' => $id]) ?>">
											<?= Html::img("@web/{$item['img']}", ['alt' => $item['title']]) ?>
										</a>
									</td>
									<td class="invert">
										<div class="quantity">
											<div class="quantity-select">
												<div class="entry value-minus" data-qty="-1" data-id="<?= $id ?>">&nbsp;</div>
												<div class="entry value"><span><?= $item['qty'] ?></span></div>
												<div class="entry value-plus active" data-qty="1" data-id="<?= $id ?>">&nbsp;</div>
											</div>
										</div>
									</td>
									<td class="invert"><?= $item['title'] ?></td>

									<td class="invert">$<?= $item['price'] ?></td>
									<td class="invert">
										<div class="rem">
											<a class="close1" href="<?= Url::to(['cart/del-item', 'id' => $id]) ?>"> </a>
										</div>

									</td>
								</tr>
							<? endforeach; ?>
						</tbody>
					</table>
				</div>

			</div>
			<div class="checkout-left">
				<div class="col-md-4 checkout-left-basket">
					<h4>Continue to basket</h4>
					<ul>
						<? foreach (($session['cart'] ?? []) as $id => $item): ?>
							<li><?= $item['title'] ?><i>-</i> <span>$<?= $item['price'] * $item['qty'] ?> </span></li>
						<? endforeach; ?>
						<li>Total <i>-</i> <span>$<?= $session['cart.sum'] ?></span></li>
					</ul>
				</div>
				<div class="col-md-8 address_form_agile">
					<h4>Данные покупателя</h4>
					<? $form = ActiveForm::begin() ?>
					<?= $form->field($order, 'name'); ?>
					<?= $form->field($order, 'email'); ?>
					<?= $form->field($order, 'phone'); ?>
					<?= $form->field($order, 'address'); ?>
					<?= $form->field($order, 'note')->textarea(['rows' => 5]); ?>
					<?= Html::submitButton('Заказать', ['class' => 'submit check_out']) ?>
					<? ActiveForm::end() ?>

				</div>

				<div class="clearfix"> </div>

			</div>
		<?php else: ?>
			<h3>Корзина пуста</h3>
		<?php endif; ?>
	</div>
	<!-- //about -->
</div>
<div class="clearfix"></div>
</div>
<!-- //banner -->