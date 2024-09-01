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
        $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $quantity * $product->price : $quantity * $product->price;
        if (!$_SESSION['cart'][$product->id]['qty']) unset($_SESSION['cart'][$product->id]);
    }

    public function recalc($id) {
        if (!isset($_SESSION['cart'][$id])) return false;
        $qtyMinus = $_SESSION['cart'][$id]['qty'];
        $sumMinus = $qtyMinus * $_SESSION['cart'][$id]['price'];
        $_SESSION['cart.qty'] -= $qtyMinus;
        $_SESSION['cart.sum'] -= $sumMinus;
        unset($_SESSION['cart'][$id]);
    }
}
