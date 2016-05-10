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
    
    
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo')->listBox(['Sala de Aula' => 'Sala de Aula','Auditório' => 'Auditório','Sala de Reunião' => 'Sala de Reunião'])?>
    
    <?= $form->field($model, 'unidade_v')->listBox(yii\helpers\ArrayHelper::map($modeloUnidade, 'id_unidade', 'nome')) ?>
    
    <?= $form->field($model, 'recurso_v')->checkboxList(yii\helpers\ArrayHelper::map($modeloRecurso, 'id_recurso', 'nome')) ?>

    <?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
    
    <div id="map" style="width:500px;height:380px;"></div>
    
    <?= $form->field($model, 'latitude')->textInput(); ?>
    
    <?= $form->field($model, 'longitude')->textInput(); ?>
    
    <script type="text/javascript">

    var map;
    var myLatLng = {lat: -22.0088967, lng: -47.8953421};
    var marker;

    function initMap() {

      map = new google.maps.Map(document.getElementById('map'), {
        center: myLatLng,
        zoom: 18
      });

      marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
            draggable: true,
            animation: google.maps.Animation.DROP,
        title: 'Escolha o local da sala.'

      }); 

      marker.addListener('dragend', function(event){
      
      $('#sala-latitude').val(marker.getPosition().lat());
      $('#sala-longitude').val(marker.getPosition().lng());
      });
      
      map.addListener('drag', function(event){
      
      $('#sala-latitude').val(marker.getPosition().lat());
      $('#sala-longitude').val(marker.getPosition().lng());
      });

      map.addListener('center_changed', function(event){
      marker.setPosition(map.getCenter());
      });

      map.addListener('click', function(event){
      marker.setPosition(event.latLng);

      });
    }
    </script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZSTwo9Ms6wPy_GIrCp5vatBQtp9ngvzk&callback=initMap">
    </script>
    
        
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php 
    
    ActiveForm::end(); ?>

</div>
