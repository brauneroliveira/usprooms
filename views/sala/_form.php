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
    ?>
    
    
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo')->listBox(['Sala de Aula' => 'Sala de Aula','Auditório' => 'Auditório','Sala de Reunião' => 'Sala de Reunião'])?>
    
    <!--= $form->field($model, 'unidade_v')->listBox(yii\helpers\ArrayHelper::map($modeloUnidade, 'id_categoria', 'nome')) -->
    
    <!--= $form->field($model, 'recurso')->checkbox(yii\helpers\ArrayHelper::map($modeloRecurso, 'id_recurso', 'nome')) -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php 
    
    ActiveForm::end(); ?>

</div>
