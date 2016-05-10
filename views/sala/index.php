<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Salas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sala-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Sala', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_sala',
            'id_autor',
            'codigo',
            'nome',
            'descricao',
            // 'tipo',
            // 'latitude',
            // 'longitude',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); 

    /* Lista objetos mais recentes (mínimo 3) de uma categoria. Cada item deve apresentar: 
     * > Imagem do objeto (com link para a Página 6) 
     * > Nome do objeto (com link para Página 6) 
     * > Breve descrição do objeto (máximo de 200 caracteres). 
     * > Autor do conteúdo para este objeto
     * > Avaliação média dos usuários (nota entre 1 e 5) 
     * > Quantidade de usuários que avaliaram o objeto 
    */
    
    /*
    $salas = app\models\Sala::find()->all();
    
    yii\helpers\VarDumper::dump($salas);
    
    $salaDataProvider = new yii\data\ActiveDataProvider([
        'query' => \app\models\Sala::find(),
    ]);
    
    echo GridView::widget([
        'dataProvider' => $salaDataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'Sala', 
             'value' => 'codigo'],
            'nome',
            'descricao',
            ['attribute' => 'Autor',
                'value' => 'idAutor.nome_completo'],
            ['attribute' => 'N. Avaliações',
                'value' => 'countAvaliacoes'],
            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); 
    */
?>
</div>
