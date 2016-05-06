<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_unidade".
 *
 * @property integer $id_categoria
 * @property string $nome
 * @property string $descricao
 *
 * @property SalaUnidade[] $salaUnidades
 * @property Sala[] $idSalas
 */
class Unidade extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_unidade';
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
    public function getSalaUnidades()
    {
        return $this->hasMany(SalaUnidade::className(), ['id_categoria' => 'id_categoria']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSalas()
    {
        return $this->hasMany(Sala::className(), ['id_sala' => 'id_sala'])->viaTable('tb_sala_unidade', ['id_categoria' => 'id_categoria']);
    }
}
