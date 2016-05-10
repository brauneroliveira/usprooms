<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

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
        //[
        // the item contains only the image
        //'<img src="http://www.suamelhordecoracao.com.br/wp-content/uploads/2013/12/decore-a-sala.jpg"/>',
        // equivalent to the above
        //['content' => '<img src="http://www.suamelhordecoracao.com.br/wp-content/uploads/2013/12/decore-a-sala.jpg"/>'],
        // the item contains both the image and the caption
        //[
          //  'content' => '<img src="http://twitter.github.io/bootstrap/assets/img/bootstrap-mdo-sfmoma-03.jpg"/>',
            //'caption' => '<h4>This is title</h4><p>This is the caption text</p>',
            //'options' => [...],
            //],
         //]
        ]);

        
        ?>
        
        <?php
        
        //var_dump($model->getComentarios()->all());
        
        foreach ($model->getComentarios()->all() as $_comentario){
            echo '<p>'.$_comentario->comentario.'</p>';
        }
        
        ?>
        
    </div>
    
    <div>
    <?php 
        
        $form = ActiveForm::begin();
        $form->action = yii\helpers\Url::to(['comentario/create']);
        $comentario = new \app\models\ComentarioForm();
        
        ?>
        
        <?= $form->field($comentario, 'comentario')->textarea(['maxlength' => true]) ?>
        <?= Html::hiddenInput('id_sala', $model->id_sala) ?>

        <div class="form-group">
        <?= Html::submitButton('Comentar', ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>
        
    </div>
    
</div>
