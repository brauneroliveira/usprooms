<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
<?php

//$modelo = new \app\models\Categoria();
//$modelo->nome = 'ICMC';
//$modelo->descricao = 'Bloco X';
//$modelo->save();

$modelo = \app\models\Categoria::findOne(['nome'=>'ICMC']);
$modelo->descricao = 'Bloco Ronaldo';
//var_dump($modelo);
//$modelo->save();

echo $modelo->descricao;



?>
    
 
</div>
