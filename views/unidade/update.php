<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Unidade */

$this->title = 'Update Unidade: ' . $model->id_unidade;
$this->params['breadcrumbs'][] = ['label' => 'Unidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_unidade, 'url' => ['view', 'id' => $model->id_unidade]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="unidade-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
