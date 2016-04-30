<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tb_cidade}}".
 *
 * @property integer $id_cidade
 * @property string $nome
 * @property string $estado
 *
 * @property TbUsuario[] $tbUsuarios
 */
class Cidade extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_cidade';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'string', 'max' => 100],
            [['estado'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_cidade' => 'Cidade',
            'nome' => 'Nome',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbUsuarios()
    {
        return $this->hasMany(TbUsuario::className(), ['id_cidade' => 'id_cidade']);
    }
}
