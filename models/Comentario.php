<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_comentario".
 *
 * @property integer $id_comentario
 * @property integer $id_usuario
 * @property integer $id_sala
 * @property string $comentario
 *
 * @property Sala $idSala
 * @property Usuario $idUsuario
 */
class Comentario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_comentario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_sala', 'comentario'], 'required'],
            [['id_usuario', 'id_sala'], 'integer'],
            [['comentario'], 'string', 'max' => 300],
            [['id_sala'], 'exist', 'skipOnError' => true, 'targetClass' => Sala::className(), 'targetAttribute' => ['id_sala' => 'id_sala']],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_usuario' => 'id_usuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_comentario' => 'Id Comentario',
            'id_usuario' => 'Id Usuario',
            'id_sala' => 'Id Sala',
            'comentario' => 'Comentario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSala()
    {
        return $this->hasOne(Sala::className(), ['id_sala' => 'id_sala']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id_usuario' => 'id_usuario']);
    }
}