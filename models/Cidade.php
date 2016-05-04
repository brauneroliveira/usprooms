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
            [['nome', 'estado'], 'required'],
            [['nome'], 'string', 'max' => 100],
            [['estado'], 'string', 'max' => 2],
            ['nome', 'match', 'pattern' => '/^[a-zA-Z\s]*$/', 'message' => 'O nome da cidade só pode conter letras e espaços em branco.'],
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
    
    public function getEstados(){
        return [
            "AC"=>"Acre", 
            "AL"=>"Alagoas", 
            "AM"=>"Amazonas", 
            "AP"=>"Amapá",
            "BA"=>"Bahia",
            "CE"=>"Ceará",
            "DF"=>"Distrito Federal",
            "ES"=>"Espírito Santo",
            "GO"=>"Goiás",
            "MA"=>"Maranhão",
            "MT"=>"Mato Grosso",
            "MS"=>"Mato Grosso do Sul",
            "MG"=>"Minas Gerais",
            "PA"=>"Pará",
            "PB"=>"Paraíba",
            "PR"=>"Paraná",
            "PE"=>"Pernambuco",
            "PI"=>"Piauí",
            "RJ"=>"Rio de Janeiro",
            "RN"=>"Rio Grande do Norte",
            "RO"=>"Rondônia",
            "RS"=>"Rio Grande do Sul",
            "RR"=>"Roraima",
            "SC"=>"Santa Catarina",
            "SE"=>"Sergipe",
            "SP"=>"São Paulo",
            "TO"=>"Tocantins",
            ];
    }

}
