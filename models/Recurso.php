<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_recurso".
 *
 * @property integer $id_recurso
 * @property string $nome
 * @property string $descricao
 *
 * @property SalaRecurso[] $salaRecursos
 * @property Sala[] $idSalas
 */
class Recurso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_recurso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['nome'], 'string', 'max' => 45],
            [['descricao'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_recurso' => 'Id Recurso',
            'nome' => 'Nome',
            'descricao' => 'Descricao',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalaRecursos()
    {
        return $this->hasMany(SalaRecurso::className(), ['id_recurso' => 'id_recurso']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSalas()
    {
        return $this->hasMany(Sala::className(), ['id_sala' => 'id_sala'])->viaTable('tb_sala_recurso', ['id_recurso' => 'id_recurso']);
    }
}
