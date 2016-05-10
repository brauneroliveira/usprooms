<?php

/* @var $this yii\web\View */

$this->title = 'Página 1: Página Inicial';
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
        //var_dump($salas); die();
        $unidades = [
            'ICMC' => ['SALA 1','SALA 2','SALA 3','SALA 4','SALA 5', 'SALA 6'],
            'EESC' => ['SALA 1','SALA 2','SALA 3','SALA 4','SALA 5', 'SALA 6'],
            'IQSC' => ['SALA 1','SALA 2','SALA 3','SALA 4','SALA 5', 'SALA 6'],
            'IAU'  => ['SALA 1','SALA 2','SALA 3','SALA 4','SALA 5', 'SALA 6'],
        ];
        
        //foreach ($unidades as $unidade => $salas){
        //    echo '<div class="row">';
         //   echo '<h2>' . $unidade . '</h1>';
            
            foreach ($salas as $sala){
                
                echo '<div class="col-lg-4">';
                echo '<h3>' . $sala->nome . ' '. $sala->codigo .  '</h2>';
      
                $pasta = \Yii::$app->basePath . '/web/assets/images/' . $sala->id_sala; 
                //var_dump($pasta);
                $diretorio = dir($pasta);
                //var_dump($diretorio);
                while(($arquivo = $diretorio->read()) !== false){
                    //var_dump($arquivo);
                    if ($arquivo != "." && $arquivo != "..") {
                        echo yii\helpers\Html::img('assets/images/'. $sala->id_sala . '/' .$arquivo, ['height'=>'360', 'width'=>'360']);
                        break;
                        
                    }
                //var_dump($arquivo); die();
               // echo '<a href='.$pasta.$arquivo.'>'.$arquivo.'</a><br />';
                //}
                    
                
                
                }
                unset($arquivo);
                $diretorio->close();
 
                echo '<p>' . $sala->descricao . '</p>';
                echo yii\helpers\Html::a('Veja mais', 'index.php?r=sala%2Fview&id='. $sala->id_sala, ['class' =>'btn btn-default']);
                //echo '<p><a class="btn btn-default" href="index.php?r=sala%2Fview&id=52">Veja mais</a></p>';
                echo '</div>';
            }
            echo '</div>';
        //}
        
        ?>
    </div>
</div>
