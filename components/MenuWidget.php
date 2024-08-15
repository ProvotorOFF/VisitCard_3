<?

namespace app\components;

use app\models\Category;
use Yii;
use yii\base\Widget;

class MenuWidget extends Widget
{
    public $tpl;
    public $ul_class;
    public $data;
    public $tree;
    public $menuHtml;

    public function init()
    {
        parent::init();
        $this->tpl = $this->tpl ? "$this->tpl.php" : "menu.php";
        $this->ul_class =  $this->ul_class ?? 'menu';
    }

    public function run()
    {
        $menu = Yii::$app->cache->get('menu');
        if ($menu) return $menu;
        $this->data = Category::find()
            ->select('id, parent_id, title')
            ->indexBy('id')
            ->asArray()
            ->all();
        $this->tree = $this->getTree($this->data);
        $this->menuHtml = "<ul class='$this->ul_class'>" . $this->getMenuHtml($this->tree) . "</ul>";
        Yii::$app->cache->set('menu', $this->menuHtml, 3600);
        return $this->menuHtml;
    }

    protected function getTree()
    {
        $tree = [];
        foreach ($this->data as $id => &$node) {
            if (!$node['parent_id'])
                $tree[$id] = &$node;
            else
                $this->data[$node['parent_id']]['children'][$node['id']] = &$node;
        }
        return $tree;
    }

    protected function getMenuHtml($tree){
        $str = '';
        foreach ($tree as $category) {
            $str .= $this->catToTemplate($category);
        }
        return $str;
    }

    protected function catToTemplate($category){
        ob_start();
        include __DIR__ . '/menu_tpl/' . $this->tpl;
        return ob_get_clean();
    }
}
