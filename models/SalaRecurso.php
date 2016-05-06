<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_sala_recurso".
 *
 * @property integer $id_sala
 * @property integer $id_recurso
 * @property integer $quantidade
 *
 * @property Recurso $idRecurso
 * @property Sala $idSala
 */
class SalaRecurso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_sala_recurso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_sala', 'id_recurso'], 'required'],
            [['id_sala', 'id_recurso', 'quantidade'], 'integer'],
            [['id_recurso'], 'exist', 'skipOnError' => true, 'targetClass' => Recurso::className(), 'targetAttribute' => ['id_recurso' => 'id_recurso']],
            [['id_sala'], 'exist', 'skipOnError' => true, 'targetClass' => Sala::className(), 'targetAttribute' => ['id_sala' => 'id_sala']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_sala' => 'Id Sala',
            'id_recurso' => 'Id Recurso',
            'quantidade' => 'Quantidade',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRecurso()
    {
        return $this->hasOne(Recurso::className(), ['id_recurso' => 'id_recurso']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSala()
    {
        return $this->hasOne(Sala::className(), ['id_sala' => 'id_sala']);
    }
}
