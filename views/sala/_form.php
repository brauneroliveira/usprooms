<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Sala */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sala-form">

    <?php 
        $modeloUnidade = \app\models\Unidade::find()->all();
        $modeloRecurso = \app\models\Recurso::find()->all();
        $autor = Yii::$app->getUser()->id;
        $modeloAutor = \app\models\Usuario::findOne($autor);
    ?>
    
    
    
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); 
    
    
    ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'value' => $modeloAutor->email, 'readOnly'=>true])->label('Autor') ?>
    
    <?= $form->field($model, 'codigo')->widget(\yii\widgets\MaskedInput::className(), [
    'mask' => '*-***',])->label('Código da Sala') ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true])->label('Nome da Sala') ?>

    <?= $form->field($model, 'descricao')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo')->listBox(['Sala de Aula' => 'Sala de Aula','Auditório' => 'Auditório','Sala de Reunião' => 'Sala de Reunião', 'Laboratorio' => 'Laboratorio', 'Escritorio'=>'Escritorio'])?>
    
    <?= $form->field($model, 'unidade_v')->listBox(yii\helpers\ArrayHelper::map($modeloUnidade, 'id_unidade', 'nome'))->label('Unidade Alocada') ?> 
    
    <?= $form->field($model, 'recurso_v')->checkboxList(yii\helpers\ArrayHelper::map($modeloRecurso, 'id_recurso', 'nome'))->label('Recursos Disponíveis') ?>
    
    <?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
        
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php 
    
    ActiveForm::end(); ?>

</div>
