<?php

use kartik\rating\StarRating;

$this->title = 'USProoms - Resultado da pesquisa';
$this->registerMetaTag(['name' => 'description=', 'content' => 'Essa página apresenta todos os resultados de sua pesquisa.']);


if(empty($salas)){
    echo '<h2> Não foram encontradas salas para sua pesquisa :( </h2>';
}
else{
    
    foreach ($salas as $sala){
                
    echo '<div class="col-lg-4">';
    echo yii\helpers\Html::a('<h3>' . $sala->nome . ' '. $sala->codigo .  '</h2>', 
            'index.php?r=sala%2Fview&id='. $sala->id_sala);

    $pasta = \Yii::$app->basePath . '/web/assets/images/' . $sala->id_sala; 

    $diretorio = dir($pasta);

    while(($arquivo = $diretorio->read()) !== false){

        if ($arquivo != "." && $arquivo != "..") {
            $image = yii\helpers\Html::img('/usprooms/web/assets/images/'. $sala->id_sala . '/' .$arquivo, 
                    [
                        'height'=>'360', 
                        'width'=>'360', 
                        'alt'=>'Foto da sala ' . $sala->nome
                    ]);

            echo yii\helpers\Html::a($image, yii\helpers\Url::to(['sala/view', 'id' => $sala->id_sala]));

            break;
        }
    }
    unset($arquivo);
    $diretorio->close();

    echo StarRating::widget(['name' => 'rating_19', 
            'pluginOptions' => ['size'=>'xs',
            'stars' => 5, 
            'min' => 0,
            'max' => 5,
            'step' => 1,
            'symbol' => html_entity_decode('&#xe005;', ENT_QUOTES, "utf-8"),
            'starCaptions'=>[]
            ]
        ]);

    $autor = \app\models\Usuario::findOne($sala->id_autor);

    echo '<b> Autor: </b> '.'<p>' . $autor->nome_completo . '</p>';
    echo '<b> Descrição: </b> '.'<p>' . $sala->descricao . '</p>';
    echo '</div>';

}
    echo '</div>';
}