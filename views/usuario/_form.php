<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<?php

$this->title = 'Página 3. Página de Cadastro';

?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin();?>

    <?= $form->field($model, 'nome_completo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_nascimento')->widget(\yii\jui\DatePicker::classname(), [
    'language' => 'pt-BR',
    'dateFormat' => 'dd/MM/yyyy',
    'clientOptions' => [
    'changeMonth' => true,
    'changeYear' => true,
    'yearRange' => '1916:2016'
    ]
])  ?>

    <?= $form->field($model, 'telefone')->widget(\yii\widgets\MaskedInput::className(), [
    'mask' => '(99) 99999-9999',
    ]) ?>

    <?= $form->field($model, 'email', ['enableAjaxValidation' => true])->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'estado')->dropDownList(app\models\Cidade::getEstados()) ?>
    
    <?= $form->field($model, 'cidade')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'chaveSenha')->passwordInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'confirmarSenha')->passwordInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
</div>
