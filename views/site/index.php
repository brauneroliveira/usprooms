<?php
use kartik\rating\StarRating;
/* @var $this yii\web\View */

$this->registerMetaTag(['name' => 'description=', 'content' => 'Encontre todas as sala do campus da USP. Veja seus recursos, localização e comentários!']);
$this->title = 'USProoms - Encontre uma sala no campus da USP';
?>
<div class="site-index">

    <div class="body-content">
        
        <h1>Últimas salas cadastradas no USProoms</h1>
        
        <?php
        $salas = app\models\Sala::find()->all();
        

             foreach ($salas as $sala){
                
                echo '<div class="col-lg-4">';
                echo yii\helpers\Html::a('<h2>' . $sala->nome . ' '. $sala->codigo .  '</h2>', 
                        'index.php?r=sala%2Fview&id='. $sala->id_sala);
      
                $pasta = \Yii::$app->basePath . '/web/assets/images/' . $sala->id_sala; 

                $diretorio = dir($pasta);

                while(($arquivo = $diretorio->read()) !== false){

                    if ($arquivo != "." && $arquivo != "..") {
                        $image = yii\helpers\Html::img('assets/images/'. $sala->id_sala . '/' .$arquivo, 
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
                
                echo '<strong> Avaliadores:</strong> '. $numeroAvaliacao;
                echo '<p><strong> Autor:</strong> '.$autor->nome_completo.'</p>';
                echo '<strong> Descrição:</strong> <p>'.$sala->descricao.'</p>';
                echo '</div>';
            
              
    
            }
            echo '</div>';
        //}*/
        
        
        ?>
    </div>
</div>
