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
    public $cidade;
    public $estado;
    
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
            [['email', 'chaveSenha', 'confirmarSenha', 'data_nascimento', 'cidade', 'estado'], 'required'],
            [['email'], 'email'],
            ['confirmarSenha', 'compare', 'compareAttribute' => 'chaveSenha', 'operator' => '=='],
            [['confirmarSenha', 'chaveSenha'], 'string', 'min' => 8],
            ['data_nascimento', 'date', 'format' => 'dd/MM/yyyy'],
            ['data_nascimento', 'validarIdade', 'skipOnError' => false],
            [['nome_completo'], 'string', 'max' => 45],
            [['nome_completo', 'cidade'], 'match', 'pattern' => '/^[a-zA-Z\s]*$/', 'message' => 'O nome deve conter apenas caracteres.'],
            [['telefone'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 100],
            [['senha'], 'string', 'max' => 60],
            [['chave_autenticacao'], 'string', 'max' => 32],
            ['chaveSenha', 'validarSenha'],
            ['email', 'unique'],
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
            'chaveSenha' => 'Senha'
        ];
    }
    
    public function attributeHints()
    {
        return [
            'nome_completo' => 'Seu nome deve conter apenas letras [a-z].',
        ];
    }
    
    public function getIdSalas()
    {
        return $this->hasMany(Sala::className(), ['id_sala' => 'id_sala'])->viaTable('tb_comentario', ['id_usuario' => 'id_usuario']);
    }
    
    public function validarIdade($attribute, $params)
    {
        $currentDate = \DateTime::createFromFormat('d/m/Y', date('d/m/Y'));
        $userDate = \DateTime::createFromFormat('d/m/Y', $this->$attribute);
        
        $interval = $currentDate->diff($userDate);
        
        if($interval->y<13){
            $this->addError('data_nascimento', 'You must be at least 13 years old.');
        }
    }
    
    public function validarSenha($attribute, $params){
        
        if(!preg_match('/[a-z]/', $this->$attribute)){
            $this->addError('chaveSenha', 'You password must contain at least one lowercase letter [a-z].');
        }
        if(!preg_match('/[A-Z]/', $this->$attribute)){
            $this->addError('chaveSenha', 'You password must contain at least one uppercase letter [A-Z].');
        }
        if(!preg_match('/[0-9]/', $this->$attribute)){
            $this->addError('chaveSenha', 'You password must contain at least one digit [0-9].');
        }
        if(!preg_match('/[!@#$%\*]/', $this->$attribute)){
            $this->addError('chaveSenha', 'You password must contain at least one special character [!@#$%*].');
        }
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
                
                /*
                 * Procedimento para converter a data inserida pelo usuário no formato do banco de dados
                 */
                $auxDateTime = \DateTime::createFromFormat('d/m/Y', $this->data_nascimento);
                $this->data_nascimento = $auxDateTime->format('Y-m-d');
                
                /*
                 * Transformação do nome do usuário em caixa alta
                 */
                $this->nome_completo = mb_strtoupper($this->nome_completo, 'UTF-8');
                
                /*
                 * Remoção dos caracteres de máscara do telefone para inserção no banco
                 */
                $this->telefone = preg_replace("/[^0-9]/","",$this->telefone);
                
                /*
                 * Geração da chave de autenticação e do hash da senha do usuário
                 */
                $this->chave_autenticacao = Yii::$app->security->generateRandomString();
                $this->senha = Yii::$app->getSecurity()->generatePasswordHash($this->chaveSenha);
                
                /*
                 * Criação de uma nova cidade para atrelar ao usuário
                 */
                $cidade = new Cidade();
                $cidade->nome = mb_strtoupper($this->cidade, 'UTF-8');
                $cidade->estado = $this->estado;
                $cidade->save();
                $this->id_cidade = $cidade->id_cidade;
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
    
    public static function findByUsername($email)
    { 
        return Usuario::findOne(['email' => $email]);
    }
}
