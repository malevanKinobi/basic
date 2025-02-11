<?php use app\assets\AppAsset;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Html;

AppAsset::register($this);

$this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
     <?php
    NavBar::begin([
        'brandLabel' => 'Дневник',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);


     // Левое меню
     echo Nav::widget([
         'options' => ['class' => 'navbar-nav'],
         'items' => [
             ['label' => 'Главная', 'url' => ['/home/index']],
             // здесь могут быть и другие элементы меню
         ],
     ]);

     echo Nav::widget([
         'options' => ['class' => 'navbar-nav ml-auto'],
         'items'   => [
             Yii::$app->user->isGuest ?
                 ['label' => 'Войти', 'url' => ['/home/login']] :
                 ['label' => 'Выйти', 'url' => ['/home/logout']],
         ],
     ]);

     NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; My Company <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
        </div>
    </div>
</footer>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
