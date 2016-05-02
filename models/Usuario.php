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
 * @property string $chave_autenticacao 
 *
 * @property Cidade $idCidade
 */
class Usuario extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $chaveSenha;
    public $confirmarSenha;
    
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
            [['id_cidade', 'email', 'senha', 'chave_autenticacao', 'confirmarSenha'], 'required'],
            [['id_cidade'], 'integer'],
            [['email'], 'email'],
            ['confirmarSenha', 'compare', 'compareValue' => 'chaveSenha', 'operator' => '=='],
            [['data_nascimento', 'confirmarSenha'], 'safe'],
            [['nome_completo'], 'string', 'max' => 45],
            [['telefone'], 'string', 'max' => 11],
            [['email'], 'string', 'max' => 100],
            [['senha'], 'string', 'max' => 60],
            [['chave_autenticacao'], 'string', 'max' => 32],
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
            'chave_autenticacao' => 'Chave Autenticacao',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCidade()
    {
        return $this->hasOne(Cidade::className(), ['id_cidade' => 'id_cidade']);
    }
    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                
                $auxDateTime = \DateTime::createFromFormat('d/m/Y', $this->data_nascimento);
                $this->data_nascimento = $auxDateTime->format('y-m-d');
                $this->chave_autenticacao = Yii::$app->security->generateRandomString();
                $this->senha = Yii::$app->getSecurity()->generatePasswordHash($this->chaveSenha);
            }
            return true;
        }
        return false;
    }

    public function getAuthKey() {
        return $this->chave_autenticacao;
    }

    public function getId() {
        return $this->id_usuario;
    }
    
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->senha);
    }

    public function validateAuthKey($authKey) 
    {
        return $this->getAuthKey() === $authKey;
    }

    public static function findIdentity($id_usuario) {
        return static::findOne($id_usuario);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        
    }

}
