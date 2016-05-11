<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'USProoms',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $unidades = \app\models\Unidade::find()->all();
    foreach ($unidades as $unidade) {
        $items[] = ['label' => $unidade->nome, 'url' => yii\helpers\Url::to(['unidade/salas', 'id_unidade'=>$unidade->id_unidade])];
    }
    
    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            
             ['label' => 'Categorias', 'url' => ['/categoria/index'],
                'items' => $items,
        ],
            Yii::$app->user->isGuest ? (
                ['label' => 'Cadastre-se', 'url' => ['/usuario/create']]) : (''),
            
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->email . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    
    $salas = \app\models\Sala::find()->all();
    
    foreach ($salas as $sala) {
    $searchData[] = $sala->codigo;
    $searchData[] = $sala->nome;
    
}
    echo '<div class="navbar-form navbar-right">';
    echo yii\helpers\Html::beginForm(yii\helpers\Url::to(['sala/search']), 'get');
    echo yii\jui\AutoComplete::widget([
        'name' => 'search_string',
        'options' => ['class' => 'form-control', 'style' => 'width: auto;'],
        'clientOptions' => [
        'source' => $searchData,
    ],
]);
    echo Html::submitButton('Pesquisar', ['style' => 'position: absolute; left: -9999px; width: 1px; height: 1px;']);
    echo yii\helpers\Html::endForm();
    
    echo '</div>';
    
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; USProoms <?= date('Y') ?></p>
        <span>&nbsp; - Desenvolvido por Brauner e Daniel</span>
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
