<?php

use yii\widgets\ActiveForm;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">


<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
        
        $form->action = yii\helpers\Url::to(['site/teste']);
        
        ?>

    <?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <button>Submit</button>

<?php ActiveForm::end() ?>


    
 
</div>
