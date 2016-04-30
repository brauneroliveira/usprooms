<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%usuario}}".
 *
 * @property integer $id_usuario
 * @property integer $id_cidade
 * @property string $nome_completo
 * @property string $data_nascimento
 * @property string $telefone
 * @property string $email
 * @property string $senha
 *
 * @property Cidade $idCidade
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%usuario}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_cidade', 'email', 'senha'], 'required'],
            [['id_cidade'], 'integer'],
            [['data_nascimento'], 'safe'],
            [['nome_completo'], 'string', 'max' => 45],
            [['telefone'], 'string', 'max' => 11],
            [['email'], 'string', 'max' => 100],
            [['senha'], 'string', 'max' => 60],
            [['email'], 'unique'],
            [['id_cidade'], 'exist', 'skipOnError' => true, 'targetClass' => Cidade::className(), 'targetAttribute' => ['id_cidade' => 'id_cidade']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => 'Id Usuario',
            'id_cidade' => 'Id Cidade',
            'nome_completo' => 'Nome Completo',
            'data_nascimento' => 'Data Nascimento',
            'telefone' => 'Telefone',
            'email' => 'Email',
            'senha' => 'Senha',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCidade()
    {
        return $this->hasOne(Cidade::className(), ['id_cidade' => 'id_cidade']);
    }
}
