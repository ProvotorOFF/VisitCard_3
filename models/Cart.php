<?

namespace app\models;

use app\models\Product;
use yii\base\Model;

class Cart extends Model
{

    public function addToCart(Product $product, int $quantity = 1)
    {
        if (isset($_SESSION['cart'][$product->id])) {
            $_SESSION['cart'][$product->id]['qty'] += $quantity;
        } else {
            $_SESSION['cart'][$product->id] = [
                'title' => $product->title,
                'price' => $product->price,
                'qty' => $quantity,
                'img' => $product->img
            ];
        }

        $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $quantity : $quantity;
        $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $quantity * $product->price : $quantity * $product->price;
    }
}
