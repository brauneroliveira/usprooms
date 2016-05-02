<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_categoria".
 *
 * @property integer $id_categoria
 * @property string $nome
 * @property string $descricao
 *
 * @property Sala[] $salas
 */
class Categoria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_categoria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['nome'], 'string', 'max' => 50],
            [['descricao'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_categoria' => 'Id Categoria',
            'nome' => 'Nome',
            'descricao' => 'Descricao',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalas()
    {
        return $this->hasMany(Sala::className(), ['id_categoria' => 'id_categoria']);
    }
}
