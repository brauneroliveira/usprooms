<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class ComentarioForm extends Model
{
    public $comentario;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            
            [['comentario'], 'required'],
            ['comentario', 'string', 'max' => '300'],
        ];
    }
}
