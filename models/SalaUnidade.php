<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_sala_unidade".
 *
 * @property integer $id_sala
 * @property integer $id_unidade
 * @property string $bloco
 *
 * @property Sala $idSala
 * @property Unidade $idUnidade
 */
class SalaUnidade extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_sala_unidade';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_sala', 'id_unidade'], 'required'],
            [['id_sala', 'id_unidade'], 'integer'],
            [['bloco'], 'string', 'max' => 45],
            [['id_sala'], 'unique'],
            [['id_sala'], 'exist', 'skipOnError' => true, 'targetClass' => Sala::className(), 'targetAttribute' => ['id_sala' => 'id_sala']],
            [['id_unidade'], 'exist', 'skipOnError' => true, 'targetClass' => Unidade::className(), 'targetAttribute' => ['id_unidade' => 'id_unidade']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_sala' => 'Id Sala',
            'id_unidade' => 'Id Unidade',
            'bloco' => 'Bloco',
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
    public function getIdUnidade()
    {
        return $this->hasOne(Unidade::className(), ['id_unidade' => 'id_unidade']);
    }
}
