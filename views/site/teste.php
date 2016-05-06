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

//$modelo = \app\models\Categoria::findOne(['nome'=>'ICMC']);
//$modelo->descricao = 'Bloco Ronaldo';
//var_dump($modelo);
//$modelo->save();

$a=[0=>'1'];

echo $a[0];

$senha='1234';
$chave=  Yii::$app->security->generateRandomString();
$senha = Yii::$app->security->generatePasswordHash($senha);
echo $chave;
echo "<br>";
echo $senha;

?>
    
 
</div>
