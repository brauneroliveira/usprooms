<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_sala".
 *
 * @property integer $id_sala
 * @property integer $id_autor
 * @property string $codigo
 * @property string $nome
 * @property string $descricao
 * @property string $tipo
 * @property string $latitude
 * @property string $longitude
 *
 * @property Avaliacao[] $avaliacaos
 * @property Usuario[] $idUsuarios
 * @property Comentario[] $comentarios
 * @property Usuario[] $idUsuarios0
 * @property Usuario $idAutor
 * @property SalaRecurso[] $salaRecursos
 * @property Recurso[] $idRecursos
 * @property SalaUnidade $salaUnidade
 * @property Unidade[] $idCategorias
 */
class Sala extends \yii\db\ActiveRecord
{
    public $unidade_v;
    public $recurso_v;
    public $imageFiles;
    public $email;
    //public $tipo_v;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_sala';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'recurso_v'], 'required'],
            [['tipo'], 'string', 'max' => 45],
            [['codigo'], 'string', 'max' => 50],
            [['codigo'], 'match', 'pattern' => '/\d-\d\d\d/', 'message'=> 'Tetse'],
            [['nome'], 'match', 'pattern' => '/^[a-z]\w*$/i'],
            [['nome'], 'string','max' => 50], 
            [['descricao'], 'string', 'max' => 300],
            [['descricao'], 'match', 'pattern' => '/^[a-z]\w*$/i'],
            [['latitude'], 'string', 'max' => 100],
            [['longitude'], 'string', 'max' => 100],
            [['codigo'], 'unique'],
            //[['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 4],
            //[['id_autor'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_autor' => 'id_usuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_sala' => 'Id Sala',
            'id_autor' => 'Id Autor',
            'codigo' => 'Codigo',
            'nome' => 'Nome',
            'descricao' => 'Descricao',
            'tipo' => 'Tipo',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'imageFiles' => 'Imagens',
        ];
    }
    
    
    public function beforeSave($insert)
    {
           if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {     
               
               //$this->unidade_v
                //$order->link('items', $item);        
                        
                //$this->tipo = $this->tipo_v;
               //$this->tipo->save();
                //var_dump($unidade_v); 
                
               // $model_SalaUnidade = new SalaUnidade();
                //$model_SalaUnidade->id_sala = $this->id_sala;
                //$model_SalaUnidade->id_categoria = $this->unidade_v;
                //$model_SalaUnidade->save();

                
                $this->id_autor = Yii::$app->getUser()->id;
               
            }
            return true;
        }
        return false;
    }
    
        public function afterSave($insert, $changedAttributes)
    { //die();
          // if (parent::afterSave($insert, $changedAttributes)) {
               
                //if( $modeloSalaUnidade = \app\models\SalaUnidade::findOne('id_sala' === $this->id_sala)){
                    //die();
                   // $modeloSalaUnidade = \app\models\SalaUnidade::findOne('id_sala' === $this->id_sala);
                  //  $modeloSalaUnidade->id_unidade = $this->unidade_v;
                //}
                //else{
                $modeloUnidade = \app\models\Unidade::find()->where('id_unidade' === $this->unidade_v)->one();
                $this->link('idUnidades', $modeloUnidade);
                //}
                
                 foreach ($this->recurso_v as $recurso) {
                 $modeloRecurso = \app\models\Recurso::findOne($recurso);
                 $this->link('idRecursos', $modeloRecurso);
                }
                
            
           // return true;
        //}
        return false;
    }
    
        public function upload()
    {
            
         //if ($this->validate()) {
            
         mkdir(\Yii::$app->basePath . '/web/assets/images/' . $this->id_sala);
         foreach ($this->imageFiles as $file) {
            $file->saveAs(\Yii::$app->basePath . '/web/assets/images/' . $this->id_sala. '/' . $file->baseName . '.' . $file->extension);
            //$this->imageFile->saveAs(\Yii::$app->basePath . '/assets/' . $this->id_sala. '/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
          // return true;
        }
        //}
        //else {
        //    return false;
        
       // }
            
    }

   
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvaliacaos()
    {
        return $this->hasMany(Avaliacao::className(), ['id_sala' => 'id_sala']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['id_usuario' => 'id_usuario'])->viaTable('tb_avaliacao', ['id_sala' => 'id_sala']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentario::className(), ['id_sala' => 'id_sala']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuarios0()
    {
        return $this->hasMany(Usuario::className(), ['id_usuario' => 'id_usuario'])->viaTable('tb_comentario', ['id_sala' => 'id_sala']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAutor()
    {
        return $this->hasOne(Usuario::className(), ['id_usuario' => 'id_autor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalaRecursos()
    {
        return $this->hasMany(SalaRecurso::className(), ['id_sala' => 'id_sala']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRecursos()
    {
        return $this->hasMany(Recurso::className(), ['id_recurso' => 'id_recurso'])->viaTable('tb_sala_recurso', ['id_sala' => 'id_sala']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalaUnidade()
    {
        return $this->hasOne(SalaUnidade::className(), ['id_sala' => 'id_sala']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUnidades()
    {
        return $this->hasOne(Unidade::className(), ['id_unidade' => 'id_unidade'])->viaTable('tb_sala_unidade', ['id_sala' => 'id_sala']);
    }
}
