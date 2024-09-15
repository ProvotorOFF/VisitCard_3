<?

use app\assets\AuthAsset;
use yii\helpers\Html;

AuthAsset::register($this);


?>
<? $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <base href="/adminlte/">
    <? $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <? $this->head() ?>
</head>

<body class="hold-transition login-page">
    <? $this->beginBody() ?>
    <?= $content ?>
    <? $this->endBody() ?>
</body>

</html>
<? $this->endPage() ?>