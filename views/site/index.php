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
                
        $unidades = [
            'ICMC' => ['SALA 1','SALA 2','SALA 3','SALA 4','SALA 5', 'SALA 6'],
            'EESC' => ['SALA 1','SALA 2','SALA 3','SALA 4','SALA 5', 'SALA 6'],
            'IQSC' => ['SALA 1','SALA 2','SALA 3','SALA 4','SALA 5', 'SALA 6'],
            'IAU'  => ['SALA 1','SALA 2','SALA 3','SALA 4','SALA 5', 'SALA 6'],
        ];
        
        foreach ($unidades as $unidade => $salas){
            echo '<div class="row">';
            echo '<h2>' . $unidade . '</h1>';
            
            foreach ($salas as $sala){
                echo '<div class="col-lg-4">';
                echo '<h3>' . $sala . '</h2>';
                echo yii\helpers\Html::img('assets/images/lab-icmc.jpg');
                echo '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>';
                echo '<p><a class="btn btn-default" href="#">Veja mais</a></p>';
                echo '</div>';
            }
            echo '</div>';
        }
        
        ?>
    </div>
</div>
