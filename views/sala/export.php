<?php

use yii\helpers\Html;
use yii\web\View;

    $this->registerJsFile('http://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.3.0/highlight.min.js', ['position' =>View::POS_END]);
    $this->registerCssFile('http://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.3.0/styles/default.min.css');
    $this->registerJs('hljs.initHighlightingOnLoad();', View::POS_END);
    $this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.10/clipboard.min.js', ['position' => View::POS_END]);
?>
<div class="sala-update">
    
    <h2>XML</h2><?= Html::button('Copiar', ['id'=>'copiar-xml', 'class' => 'btn btn-info', 'data-clipboard-target'=> '#xml']) ?>
    <pre>
        <code id="xml" class="xml" style="font-size: medium;">
            <?= Html::encode($xml); ?>
        </code>
    </pre>
    <h2>JSON</h2><?= Html::button('Copiar', ['id'=>'copiar-json', 'class' => 'btn btn-info', 'data-clipboard-target'=> '#json']) ?>
    <pre>
        <code id="json" class="json" style="font-size: medium;">
            <?= $json ?>
        </code>
    </pre>
    
</div>

<?php

    $this->registerJs("new Clipboard('#copiar-xml');", View::POS_END);
    $this->registerJs("new Clipboard('#copiar-json');", View::POS_END);
    

?>