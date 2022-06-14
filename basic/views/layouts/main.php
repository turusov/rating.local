<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>




<header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    if(Yii::$app->user->isGuest){
        $items = [
        ['label' => 'Contact', 'url' => ['/site/contact']],
        ['label' => 'Login', 'url' => ['/site/login']],
        ];
    }
    else{
        switch (Yii::$app->user->identity->user_status_id){
        case 2:
            $items = [
                // ['label' => 'Home', 'url' => ['/site/index']],
                // ['label' => 'About', 'url' => ['/site/about']],
                // ['label' => 'Contact', 'url' => ['/site/contact']],
                ['label' => 'Заполнить форму', 'url' => ['/form/fill-form']],
                ['label' => 'Список преподавателей кафедры', 'url' => ['/teacher/teacher-list']],
                ['label' => 'Личный кабинет', 'url' => ['/user-data/view']],
                ['label' => 'Редактировать критерии', 'url' => ['/criteria/index']],
                ['label' => 'Архив критериев', 'url' => ['criteria-archive/archive']],
                ['label' => 'Рейтинг', 'url' => ['teacher/teacher-rating']],
                Yii::$app->user->isGuest ? (
                    ['label' => 'Login', 'url' => ['/site/login']]
                ) : (
                    '<li>'
                    . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
                )
            ];
            break;
        case 3:
            $items = [
                ['label' => 'Заполнить форму', 'url' => ['/form/fill-form']],
                ['label' => 'Список преподавателей кафедры', 'url' => ['/teacher/teacher-list']],
                ['label' => 'Личный кабинет', 'url' => ['/user-data/view']],
                Yii::$app->user->isGuest ? (
                    ['label' => 'Login', 'url' => ['/site/login']]
                ) : (
                    '<li>'
                    . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
                )
            ];
        break;
        case 4: 
            $items = [
                ['label' => 'Contact', 'url' => ['/site/contact']],
                ['label' => 'Заполнить форму', 'url' => ['/form/fill-form']],
                ['label' => 'Личный кабинет', 'url' => ['/user-data/view']],
                ['label' => 'Рейтинг', 'url' => ['teacher/teacher-rating']],
                Yii::$app->user->isGuest ? (
                    ['label' => 'Login', 'url' => ['/site/login']]
                ) : (
                    '<li>'
                    . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
                )
            ];
        break;
        case 5: 
            $items = [
                ['label' => 'Contact', 'url' => ['/site/contact']],
                ['label' => 'Список преподавателей кафедры', 'url' => ['/teacher/teacher-list']],
                ['label' => 'Редактировать критерии', 'url' => ['/criteria/index']],
                ['label' => 'Архив критериев', 'url' => ['criteria-archive/archive']],
                ['label' => 'Рейтинг', 'url' => ['teacher/teacher-rating']],
                Yii::$app->user->isGuest ? (
                    ['label' => 'Login', 'url' => ['/site/login']]
                ) : (
                    '<li>'
                    . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
                )
            ];
        break;
        default:
            $items = [
                ['label' => 'Contact', 'url' => ['/site/contact']],
                Yii::$app->user->isGuest ? (
                    ['label' => 'Login', 'url' => ['/site/login']]
                ) : (
                    '<li>'
                    . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm()
                        . '</li>'
                        )
                    ];
                }
            }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav'],
            'items' => $items,
        ]);
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">&copy; Лаборатория программных систем ИМИ <?= date('Y') ?></p>
        <p class="float-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php
    $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/ico', 'href' => '/favicon.ico']);
?>

<link rel="shortcut icon" href="<?= Yii::$app->params['commonPath']; ?>/favicon.ico" type="image/x-icon" />


<link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/images/favicon.ico" type="image/x-icon" />



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
