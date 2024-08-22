<?

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

?>
<div class="products-breadcrumb">
    <div class="container">
        <ul>
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="<?= Url::home() ?>">Home</a><span>|</span></li>
            <li>Поиск</li>
        </ul>
    </div>
</div>
<?= $this->render('/layouts/inc/sidebar') ?>
<div class="w3l_banner_nav_right">
    <div class="w3l_banner_nav_right_banner3">
        <h3>Best Deals For New Products<span class="blink_me"></span></h3>
    </div>
    <div class="w3l_banner_nav_right_banner3_btm">
        <div class="col-md-4 w3l_banner_nav_right_banner3_btml">
            <div class="view view-tenth">
                <img src="/images/13.jpg" alt=" " class="img-responsive" />
                <div class="mask">
                    <h4>Grocery Store</h4>
                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt.</p>
                </div>
            </div>
            <h4>Utensils</h4>
            <ol>
                <li>sunt in culpa qui officia</li>
                <li>commodo consequat</li>
                <li>sed do eiusmod tempor incididunt</li>
            </ol>
        </div>
        <div class="col-md-4 w3l_banner_nav_right_banner3_btml">
            <div class="view view-tenth">
                <img src="/images/14.jpg" alt=" " class="img-responsive" />
                <div class="mask">
                    <h4>Grocery Store</h4>
                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt.</p>
                </div>
            </div>
            <h4>Hair Care</h4>
            <ol>
                <li>enim ipsam voluptatem officia</li>
                <li>tempora incidunt ut labore et</li>
                <li>vel eum iure reprehenderit</li>
            </ol>
        </div>
        <div class="col-md-4 w3l_banner_nav_right_banner3_btml">
            <div class="view view-tenth">
                <img src="/images/15.jpg" alt=" " class="img-responsive" />
                <div class="mask">
                    <h4>Grocery Store</h4>
                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt.</p>
                </div>
            </div>
            <h4>Cookies</h4>
            <ol>
                <li>dolorem eum fugiat voluptas</li>
                <li>ut aliquid ex ea commodi</li>
                <li>magnam aliquam quaerat</li>
            </ol>
        </div>
        <div class="clearfix"> </div>
    </div>
    <div class="w3ls_w3l_banner_nav_right_grid">
        <h3>Поиск: <?= Html::encode($q)  ?></h3>
        <div class="w3ls_w3l_banner_nav_right_grid1">
            <?



            if (!empty($products)) : ?>
                <? foreach ($products as $product) : ?>
                    <div class="col-md-3 w3ls_w3l_banner_left">
                        <div class="hover14 column">

                            <div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
                                <? if ($product->is_offer) : ?>
                                    <div class="agile_top_brand_left_grid_pos">
                                        <img src="/images/offer.png" alt=" " class="img-responsive" />
                                    </div>
                                <? endif; ?>
                                <div class="agile_top_brand_left_grid1">
                                    <figure>
                                        <div class="snipcart-item block">
                                            <div class="snipcart-thumb">
                                                <a href="<?= Url::to(['product/view', 'id' => $product->id]) ?>">
                                                    <?= Html::img("@web/images/{$product->img}", ['alt' => $product->title, 'class' => 'img-responsive']) ?>
                                                </a>
                                                <p><?= $product->title ?></p>
                                                <h4>
                                                    $<?= $product->price ?>
                                                    <? if ((float)$product->old_price) : ?>
                                                        <span>$<?= $product->old_price ?></span>
                                                    <? endif; ?>
                                                </h4>
                                            </div>
                                            <div class="snipcart-details">
                                            <a href="<?= Url::to(['/cart/add', 'id' => $product->id]) ?>" data-id="<?= $product->id ?>" class="button add-to-cart">Add to Cart</a>
                                            </div>
                                        </div>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                <? endforeach; ?>
            <? else : ?>
                <h6>По запросу ничего не найдено</h6>
            <? endif; ?>
        </div>
        <div class="clearfix"> </div>
        <div class="col-md-12">
            <?= LinkPager::widget([
                'pagination' => $pages
            ]); ?>
        </div>
    </div>
</div>
<div class="clearfix"></div>
</div>