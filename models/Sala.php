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
   // public $valor;
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
            [['codigo'], 'required'],
            //[['id_autor'], 'integer'],
            [['codigo', 'nome'], 'string', 'max' => 50],
            [['descricao'], 'string', 'max' => 300],
            [['latitude'], 'string', 'max' => 100],
            [['longitude'], 'string', 'max' => 100],
            [['codigo'], 'unique'],
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
        ];
    }
    
    
    public function beforeSave($insert)
    {
           if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {     
               
                //var_dump($unidade_v); 
                
                $model_SalaUnidade = new SalaUnidade();
                $model_SalaUnidade->id_sala = $this->id_sala;
                $model_SalaUnidade->id_categoria = $this->unidade_v;
                $model_SalaUnidade->save();

                
                $this->id_autor = Yii::$app->getUser()->id;
               
            }
            return true;
        }
        return false;
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
        return $this->hasMany(Unidade::className(), ['id_unidade' => 'id_unidade'])->viaTable('tb_sala_unidade', ['id_sala' => 'id_sala']);
    }
}
