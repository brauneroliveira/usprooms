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
 * @property TbSala[] $tbSalas
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
            [['id_categoria', 'nome'], 'required'],
            [['id_categoria'], 'integer'],
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
    public function getTbSalas()
    {
        return $this->hasMany(TbSala::className(), ['categoria' => 'id_categoria']);
    }
}
