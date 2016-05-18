<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use kartik\rating\StarRating;



/* @var $this yii\web\View */
/* @var $model app\models\Sala */
$modelSalaUnidade = app\models\SalaUnidade::find()->where(['id_sala' => $model->id_sala])->one();
$this->title = 'USProoms - Sala: ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Salas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$autor = \app\models\Usuario::findOne($model->id_autor);
$salaUnidade = \app\models\SalaUnidade::findOne($model->id_sala)->id_unidade;
$unidade = \app\models\Unidade::findOne($salaUnidade);
//$salaRecurso = $model->idRecursos;  
//\app\models\SalaRecurso::find()->where(['id_sala' => $model->id_sala])->all();
//$recursos = app\models\Recurso::find()->where(['id_recurso' => $salaRecurso->id_recurso])->all();
foreach ($model->idRecursos as $recursos) {
    $salaRecursos[] = $recursos->nome;
}

?>
<div class="sala-view">

    <h1><?= Html::encode($this->title)?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_sala], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_sala], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Exportar XML/JSON' , ['export', 'id_sala' => $model->id_sala], ['class' => 'btn btn-info'])?>
         
    </p>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['label'=>'Autor', 'value' => $autor->nome_completo],
            'codigo',
            'nome',
            'tipo',
            ['label'=>'Unidade', 'value' => $unidade->nome],
            ['label'=>'Recursos', 'value' => implode(', ', $salaRecursos)],
            'descricao',
            'latitude',
            'longitude',
        ],
     ]) ?>
    
   

    <div>
        
        <?php 
        
        
                //$sala = app\models\Sala::findOne('id_sala' => );  
                $pasta = \Yii::$app->basePath . '/web/assets/images/' . $model->id_sala; 
                //var_dump($pasta);
                $diretorio = dir($pasta);
                //var_dump($diretorio);
                while(($arquivo = $diretorio->read()) !== false){
                    //var_dump($arquivo);
                    if ($arquivo != "." && $arquivo != "..") {
                      $item[] = yii\helpers\Html::img('assets/images/'. $model->id_sala. '/' .$arquivo, ['class'=>'img-responsive center-block', 'height'=>'720', 'width'=>'720']);
                    }  
                }
        echo yii\bootstrap\Carousel::widget([
        'items' => $item
        ]);
        ?>
               
    </div>
    
    <div>
    <?php 
        
        echo Html::hiddenInput('id_sala', $model->id_sala);
        
        
        echo yii\helpers\Html::endForm();
    
        
        foreach ($model->getComentarios()->all() as $_comentario){
            $autor = $_comentario->idUsuario->nome_completo;
            echo '<blockquote><p><strong>' . $autor . '</strong>' . ': ' .$_comentario->comentario.'</p></blockquote>';
        }
        
        if(!Yii::$app->user->isGuest){
        
        $form = ActiveForm::begin();

        $form->action = yii\helpers\Url::to(['comentario/create']);
        $comentario = new \app\models\ComentarioForm();
        
        echo $form->field($comentario, 'comentario')->textarea(['maxlength' => true]);
        echo Html::hiddenInput('id_sala', $model->id_sala);
        
        echo '<div class="form-group">';
        echo Html::submitButton('Comentar', ['class' => 'btn btn-success']);
        echo '</div>';
        
        ActiveForm::end();
        
        }
        
        $formAvaliacao = ActiveForm::begin();
        
            $model = new \app\models\Avaliacao();
            echo $formAvaliacao->field($model, 'avaliacao')->widget(StarRating::className(), [
            'pluginOptions' => ['size'=>'xs', 'stars' => 5, 
            'min' => 0,
            'max' => 5,
            'step' => 1,
            'symbol' => html_entity_decode('&#xe005;', ENT_QUOTES, "utf-8"),    
            'starCaptions'=>[]]
            ]);
            
            ActiveForm::end();
            
            ?>

        
    </div>
    
</div>
