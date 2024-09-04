<?

namespace app\controllers;

use app\models\Cart;
use app\models\Order;
use app\models\OrderProduct;
use app\models\Product;
use Yii;

class CartController extends AppController
{

    public function actionAdd($id)
    {
        $product = Product::findOne($id);
        if (!$product) return false;
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product);
        if (Yii::$app->request->isAjax) {
            return $this->renderPartial('cart-modal', compact('session'));
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionShow()
    {
        $session = Yii::$app->session;
        $session->open();
        return $this->renderPartial('cart-modal', compact('session'));
    }

    public function actionDelItem()
    {
        $id = Yii::$app->request->get('id');
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->recalc($id);
        return Yii::$app->request->isAjax ? $this->renderPartial('cart-modal', compact('session')) : $this->redirect(Yii::$app->request->referrer);
    }

    public function actionClear()
    {
        $id = Yii::$app->request->get('id');
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');
        return $this->renderPartial('cart-modal', compact('session'));
    }

    public function actionCheckout() {
        $this->setMeta("Оформление заказа");
        $session = Yii::$app->session;
        $order = new Order();
        $orderProduct = new OrderProduct();
        if ($order->load(Yii::$app->request->post())) {
            $order->qty = $session['cart.qty'];
            $order->total = $session['cart.sum'];
            $transaction = Yii::$app->db->beginTransaction();
            if (!$order->save() || !$orderProduct->saveOrderProducts($session['cart'], $order->id)) {
                Yii::$app->session->setFlash('error', 'Ошибка оформления заказа');
                $transaction->rollBack();
            }
            else {
                Yii::$app->session->setFlash('success', 'Заказ принят!');
                $transaction->commit();
                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');
                return $this->refresh();
            }

        }
        return $this->render('checkout', compact('session', 'order'));
    }

    public function actionChangeCart() {
        $id = Yii::$app->request->get('id');
        $qty = Yii::$app->request->get('qty');
        $product = Product::findOne($id);
        if (!$product) return false;
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product, $qty);
        return $this->renderPartial('cart-modal', compact('session'));
    }
}
