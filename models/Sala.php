<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_sala".
 *
 * @property integer $id_sala
 * @property integer $id_autor
 * @property integer $id_categoria
 * @property string $codigo
 * @property string $nome
 * @property string $descricao
 *
 * @property Avaliacao[] $avaliacaos
 * @property Usuario[] $idUsuarios
 * @property Comentario[] $comentarios
 * @property Usuario[] $idUsuarios0
 * @property Categoria $idCategoria
 * @property Usuario $idAutor
 */
class Sala extends \yii\db\ActiveRecord
{
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
            [['id_autor', 'id_categoria', 'codigo'], 'required'],
            [['id_autor', 'id_categoria'], 'integer'],
            [['codigo', 'nome'], 'string', 'max' => 50],
            [['descricao'], 'string', 'max' => 300],
            [['codigo'], 'unique'],
            [['id_categoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['id_categoria' => 'id_categoria']],
            [['id_autor'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_autor' => 'id_usuario']],
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
            'id_categoria' => 'Id Categoria',
            'codigo' => 'Codigo',
            'nome' => 'Nome',
            'descricao' => 'Descricao',
        ];
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
    public function getIdCategoria()
    {
        return $this->hasOne(Categoria::className(), ['id_categoria' => 'id_categoria']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAutor()
    {
        return $this->hasOne(Usuario::className(), ['id_usuario' => 'id_autor']);
    }
}
