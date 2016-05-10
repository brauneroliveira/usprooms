<?php

//var_dump($salas);
    
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
 
                echo '<b> Descrição: </b> '.'<p>' . $sala->descricao . '</p>';
                echo yii\helpers\Html::a('Veja mais', 'index.php?r=sala%2Fview&id='. $sala->id_sala, ['class' =>'btn btn-default']);
                //echo '<p><a class="btn btn-default" href="index.php?r=sala%2Fview&id=52">Veja mais</a></p>';
                echo '</div>';
            }
            echo '</div>';
        //}*/
        
        ?>