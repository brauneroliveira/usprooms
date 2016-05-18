<?php
use kartik\rating\StarRating;
/* @var $this yii\web\View */

$this->title = 'USProoms - Encontre uma sala no campus da USP';
?>
<div class="site-index">
<!--
    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>
!-->
    <div class="body-content">

        <?php
        $salas = app\models\Sala::find()->all();
        

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
                echo '</div>';
            
              
    
            }
            echo '</div>';
        //}*/
        
        
        ?>
    </div>
</div>
