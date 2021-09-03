<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Admin;

class AdminController extends Controller
{
    public function __construct($params) {
        parent::__construct($params);
        $this->model = new Admin();
    }
    
    public function loginAction()
    {
        if (isset($_SESSION['admin'])) {
            $this->view->redirect('/');
        }

        if (!empty($_POST)) {
            $inputLogin = trim($_POST['username']);
            $inputPassword = trim($_POST['password']);
            if (!$this->model->loginValidate($inputLogin, $inputPassword)) {
                $this->view->message('danger', $this->model->error);
            }
            $_SESSION['admin'] = true;
            $this->view->location('/');

            $this->view->message('success', 'OK');
        }
        $this->view->title = 'Вход в панель управления';
        $this->view->render('login');
    }

    public function logoutAction()
    {
        unset($_SESSION['admin']);
        $this->view->redirect('/');
    }
    
    
}