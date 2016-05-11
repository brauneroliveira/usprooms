<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use kartik\rating\StarRating;



/* @var $this yii\web\View */
/* @var $model app\models\Sala */
$modelSalaUnidade = app\models\SalaUnidade::find()->where(['id_sala' => $model->id_sala])->one();
$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Salas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sala-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_sala], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_sala], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_sala',
            'id_autor',
            'codigo',
            'nome',
            'descricao',
            'tipo',
            //'latitude',
            //'longitude',
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
                //var_dump($arquivo); die();
               // echo '<a href='.$pasta.$arquivo.'>'.$arquivo.'</a><br />';
                //}
                    
                
                
                }
        
        
        
        echo yii\bootstrap\Carousel::widget([
        'items' => $item
       
        ]);

        
        ?>
               
    </div>
    
    <div>
    <?php 
        
        echo yii\helpers\Html::beginForm(yii\helpers\Url::to(['sala/export']), 'get');
        
        echo Html::hiddenInput('id_sala', $model->id_sala);
        echo Html::submitButton('Exportar XML/JSON');
        
        echo yii\helpers\Html::endForm();
    
        
        foreach ($model->getComentarios()->all() as $_comentario){
            echo '<p>'.$_comentario->comentario.'</p>';
        }
        
        $form = ActiveForm::begin();
        $form->action = yii\helpers\Url::to(['comentario/create']);
        $comentario = new \app\models\ComentarioForm();
        
        ?>
        
        <?= $form->field($comentario, 'comentario')->textarea(['maxlength' => true]) ?>
        <?= Html::hiddenInput('id_sala', $model->id_sala) ?>

        <div class="form-group">
        <?= Html::submitButton('Comentar', ['class' => 'btn btn-success']) ?>
        </div>
        
       <?php
       
            $model = new \app\models\Avaliacao();
            echo $form->field($model, 'avaliacao')->widget(StarRating::className(), [
            'pluginOptions' => ['size'=>'xs', 'stars' => 5, 
        'min' => 0,
        'max' => 5,
        'step' => 1,
         //'filledStar' =>2,
        'symbol' => html_entity_decode('&#xe005;', ENT_QUOTES, "utf-8"),
        //'defaultCaption' => '{rating} hearts',
                
        'starCaptions'=>[]]
         ]);?>

    <?php ActiveForm::end(); 
    //$this->registerJs("$('#avaliacao-avaliacao').rating('update', 3);", \yii\web\View::POS_END);
    ?>
        
    </div>
    
</div>
