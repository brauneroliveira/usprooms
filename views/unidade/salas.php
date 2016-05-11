<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use kartik\rating\StarRating;
?>
    <h1> <?= $unidade ?> </h1>
  <?php
    foreach ($salas as $sala){
                
                echo '<div class="col-lg-4">';
                echo yii\helpers\Html::a('<h3>' . $sala->nome . ' '. $sala->codigo .  '</h2>', 
                        'index.php?r=sala%2Fview&id='. $sala->id_sala);
      
                $pasta = \Yii::$app->basePath . '/web/assets/images/' . $sala->id_sala; 
                //var_dump($pasta);
                $diretorio = dir($pasta);
                //var_dump($diretorio);
                while(($arquivo = $diretorio->read()) !== false){
                    //var_dump($arquivo);
                    if ($arquivo != "." && $arquivo != "..") {
                        $image = yii\helpers\Html::img('assets/images/'. $sala->id_sala . '/' .$arquivo, ['height'=>'360', 'width'=>'360', 'href'=>'http://www.w3schools.com']);
                        
                        echo yii\helpers\Html::a($image, 'index.php?r=sala%2Fview&id='. $sala->id_sala);
      
                        break;
                        
                    }
                //var_dump($arquivo); die();
               // echo '<a href='.$pasta.$arquivo.'>'.$arquivo.'</a><br />';
                //}
                    
                
                
                }
                unset($arquivo);
                $diretorio->close();
                
                $autor = \app\models\Usuario::findOne($sala->id_autor);
                $modeloAvaliacao = \app\models\Avaliacao::findAll(['id_sala' => $sala->id_sala]);
                $numeroAvaliacao = count($modeloAvaliacao);
                echo StarRating::widget(['name' => 'rating_19', 
                        'pluginOptions' => ['size'=>'xs',
                        'stars' => 5, 
                        'min' => 0,
                        'max' => 5,
                        'step' => 1,
                        'symbol' => html_entity_decode('&#xe005;', ENT_QUOTES, "utf-8"),
                        //'defaultCaption' => '{rating} hearts',
                        'starCaptions'=>[]
                        ]
                    ]); 
                
                echo '<b> Avaliadores:</b> '. $numeroAvaliacao;
                echo '<p><b> Autor:</b> '.$autor->nome_completo.'</p>';
                echo '<b> Descrição:</b> <p>'.$sala->descricao.'</p>';
                //echo yii\helpers\Html::a('Veja mais', 'index.php?r=sala%2Fview&id='. $sala->id_sala, ['class' =>'btn btn-default']);
                //echo '<p><a class="btn btn-default" href="index.php?r=sala%2Fview&id=52">Veja mais</a></p>';
                echo '</div>';
            
                
                    //$model = new \app\models\Avaliacao();
                  
                //$this->registerJs("$("[name='rating']").rating('update', 3);", \yii\web\View::POS_END);
    
            }
            echo '</div>';
        //}*/
        
        ?>