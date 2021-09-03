<?php

namespace app\controllers;

define('TASK_COUNT_ON_PAGE', 3);

use app\core\Controller;
use app\models\Task;
use app\lib\Pagination;

class HomeController extends Controller
{
    public function __construct($params) {
        parent::__construct($params);
        $this->model = new Task();
    }
    
    public function indexAction()
    {
        if (!empty($_POST)) {
            if (!isset($_SESSION['admin'])) {
                $this->view->message('danger', 'Только администратор может сменить статус задачи!');
            }
            if (isset($_POST['id']) && isset($_POST['status'])) {
                $id = (int)$_POST['id'];
                $status = (int)$_POST['status'];
                $this->model->changeStatus($id, $status);
                exit(json_encode(['success' => true]));
            }
        }

        $sortData = [];
        $sortOptions = ['sortUsernameAsc','sortUsernameDesc','sortEmailAsc','sortEmailDesc','sortStatusAsc','sortStatusDesc',];
        if (isset($this->route['sort']) && in_array($this->route['sort'], $sortOptions)) {
            $tmpData = explode(' ', preg_replace("/([a-zа-я])([A-ZА-Я])/u", '$1 $2', $this->route['sort']));
            $sortData = [
                'action' => $tmpData[0],
                'column' => strtolower($tmpData[1]),
                'order' => strtoupper($tmpData[2]),
            ];
        }
        
        $pagination = new Pagination($this->route, $this->model->tasksCount(), TASK_COUNT_ON_PAGE);
        $vars = [
            'tasks' => $this->model->getTasks(TASK_COUNT_ON_PAGE, $this->route, $sortData),
            'pagination' => $pagination->getHtml(),
            'sort' => isset($this->route['sort']) ? $this->route['sort'] : '',
//            'adminAccess' => isset($_SESSION['admin']),
        ];
        $this->view->title = 'Главная страница';
        $this->view->render('index', $vars);
    }

    public function addAction()
    {
        if (!empty($_POST)) {
            $inputUsername = htmlspecialchars(trim($_POST['username']));
            $inputEmail = htmlspecialchars(trim($_POST['email']));
            $inputText = htmlspecialchars(trim($_POST['text']));
            if (!$this->model->formValidate($inputUsername, $inputEmail, $inputText)) {
                $this->view->message('danger', $this->model->error);
            }
            $this->model->addTask($inputUsername, $inputEmail, $inputText);
            $this->view->message('success', 'Задача добавлена');
        }
        $this->view->title = 'Добавить задачу';
        $this->view->render('taskform');
    }
    
    public function editAction()
    {
        if (!$this->model->isTaskExists($this->route['id'])) {
            $this->view->errorCode(404);
        }
        $taskData = $this->model->getTaskData($this->route['id'])[0];
        
        if (!empty($_POST)) {
            $inputUsername = htmlspecialchars(trim($_POST['username']));
            $inputEmail = htmlspecialchars(trim($_POST['email']));
            $inputText = htmlspecialchars(trim($_POST['text']));
            if (!$this->model->formValidate($inputUsername, $inputEmail, $inputText)) {
                $this->view->message('danger', $this->model->error);
            }
            $this->model->editTask($this->route['id'], $inputUsername, $inputEmail, $inputText, $taskData['text']);
            $this->view->message('success', 'Задача сохранена');
        }
        $vars = [
            'data' => $this->model->getTaskData($this->route['id'])[0],
        ];
        $this->view->title = 'Редактировать задачу';
        $this->view->render('taskform', $vars);
    }
}
