<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome_completo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_nascimento')->widget(\yii\jui\DatePicker::classname(), [
    'language' => 'pt-BR',
    'dateFormat' => 'dd/MM/yyyy',
])  ?>

    <?= $form->field($model, 'telefone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'id_cidade')->textInput() ?>

    <?= $form->field($model, 'chaveSenha')->passwordInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'confirmarSenha')->passwordInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
