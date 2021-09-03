<?php

namespace app\models;

use app\core\Model;

class Admin
{
    public $error;

    public function loginValidate($inputLogin, $inputPassword)
    {
        $config = require 'app/config/admin.php';
        if ($inputLogin !== $config['username'] || $inputPassword !== $config['password']) {
            $this->error = 'Данные введены неверно.';
            return false;
        }
        return true;
    }
}
