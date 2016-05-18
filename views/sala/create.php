<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Sala */

$this->title = 'USProoms - Criar nova sala';
$this->params['breadcrumbs'][] = ['label' => 'Salas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sala-create">

    <h1> Cadastrar nova sala </h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
