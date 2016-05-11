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
            [['codigo', 'recurso_v', 'imageFiles'], 'required'],
            [['tipo'], 'string', 'max' => 45],
            [['codigo'], 'string', 'max' => 50],
            [['codigo'], 'match', 'pattern' => '/\d-\d\d\d/', 'message'=> 'Tetse'],
            [['nome'], 'match', 'pattern' => '/^[a-zA-Z0-9\s]*$/'],
            [['nome'], 'string','max' => 50], 
            [['descricao'], 'string', 'max' => 300],
            [['descricao'], 'match', 'pattern' => '/^[a-zA-Z0-9\s]*$/'],
            [['latitude'], 'string', 'max' => 100],
            [['longitude'], 'string', 'max' => 100],
            [['codigo'], 'unique'],
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 4],
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
                $this->id_autor = Yii::$app->getUser()->id;
            }
            return true;
        }
        return false;
    }
    
        public function afterSave($insert, $changedAttributes)
        { 
            $modeloUnidade = \app\models\Unidade::findOne($this->unidade_v);

            $this->link('idUnidades', $modeloUnidade);

            foreach ($this->recurso_v as $recurso) {
            $modeloRecurso = \app\models\Recurso::findOne($recurso);
            $this->link('idRecursos', $modeloRecurso);

            }
            return false;
        }
    
        public function upload()
    {
            

         mkdir(\Yii::$app->basePath . '/web/assets/images/' . $this->id_sala);
         foreach ($this->imageFiles as $file) {
            $file->saveAs(\Yii::$app->basePath . '/web/assets/images/' . $this->id_sala. '/' . $file->baseName . '.' . $file->extension);
        }
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
