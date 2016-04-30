<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cidades';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cidade-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_cidade',
            'nome',
            'estado',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
        <p>
        
            <?= Html::a('Create Cidade', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    
</div>
