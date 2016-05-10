<?php

namespace app\controllers;

use Yii;
use app\models\Sala;
use app\models\SalaUnidade;
use app\models\SalaRecurso;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UploadForm;
use yii\web\UploadedFile;

/**
 * SalaController implements the CRUD actions for Sala model.
 */
class SalaController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Sala models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Sala::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sala model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Sala model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sala();
        $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
        if ($model->load(Yii::$app->request->post()) && $model->save() && $model->upload()) {
            return $this->redirect(['view', 'id' => $model->id_sala]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionExport($id_sala){
        
        $model = Sala::findOne($id_sala);
        
        $model = \app\models\Sala::findOne(1);
    
        $sala = new \SimpleXMLElement('<sala/>');
        $autor = $sala->addChild('autor');
        $autor->addChild('nome', $model->idAutor->nome_completo);
        $autor->addChild('email', $model->idAutor->email);
        $sala->addChild('codigo', $model->codigo);
        $sala->addChild('nome', $model->nome);
        $sala->addChild('descricao', $model->descricao);
        $sala->addChild('tipo', $model->tipo);
        $sala->addChild('latitude', $model->latitude);
        $sala->addChild('longitude', $model->longitude);
        $unidade = $sala->addChild('unidade');
        $unidade->addChild('nome', $model->idUnidades->nome);
        $unidade->addChild('descricao', $model->idUnidades->descricao);
        $unidade->addChild('bloco', SalaUnidade::findOne(['id_sala'=>$model->id_sala])->bloco);
        $recursos = $sala->addChild('recursos');

        foreach ($model->idRecursos as $recurso){
            $recursoXML = $recursos->addChild('recurso');
            $recursoXML->addChild('nome', $recurso->nome);
            $recursoXML->addChild('descricao', $recurso->descricao);
            $recursoXML->addChild('quantidade', SalaRecurso::findOne(['id_sala'=>$model->id_sala])->quantidade);
        }
        /*
        switch ($format) {
            case 'xml': return $sala->asXML();break;
            case 'json': return \yii\helpers\Json::encode($sala);break;
        }*/
        
        return $this->render('export', [
                'xml' => $sala->asXML(),
                'json' => \yii\helpers\Json::encode($sala)
            ]);
    }

    /**
     * Updates an existing Sala model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_sala]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Sala model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Sala model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sala the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sala::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionUpload()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            if ($model->upload()) {
                // file is uploaded successfully
                return;
            }
        }

        return $this->render('upload', ['model' => $model]);
    }
}





    

