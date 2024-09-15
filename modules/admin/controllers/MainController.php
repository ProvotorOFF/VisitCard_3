<?

namespace app\modules\admin\controllers;

class MainController extends AppController
{

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionTest() {
        return $this->render('test');
    }
}
