<?

namespace app\modules\admin\controllers;

use app\modules\admin\models\Category;
use app\modules\admin\models\Order;
use app\modules\admin\models\Product;

class MainController extends AppController
{

    public function actionIndex()
    {
        $orders = Order::find()->count();
        $products = Product::find()->count();
        $categories = Category::find()->count();
        return $this->render('index', compact('orders', 'products', 'categories'));
    }
}
