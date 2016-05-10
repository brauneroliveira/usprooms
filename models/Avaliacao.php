<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_avaliacao".
 *
 * @property integer $id_avaliacao
 * @property integer $id_usuario
 * @property integer $id_sala
 * @property integer $avaliacao
 *
 * @property Sala $idSala
 * @property Usuario $idUsuario
 */
class Avaliacao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_avaliacao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_sala', 'avaliacao'], 'required'],
            [['id_usuario', 'id_sala', 'avaliacao'], 'integer'],
            [['id_sala'], 'exist', 'skipOnError' => true, 'targetClass' => Sala::className(), 'targetAttribute' => ['id_sala' => 'id_sala']],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_usuario' => 'id_usuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_avaliacao' => 'Id Avaliacao',
            'id_usuario' => 'Id Usuario',
            'id_sala' => 'Id Sala',
            'avaliacao' => 'Avaliacao',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSala()
    {
        return $this->hasOne(Sala::className(), ['id_sala' => 'id_sala']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id_usuario' => 'id_usuario']);
    }
}