<?php

namespace app\models;

use app\core\Model;

class Task extends Model
{
    public $error;

    public function getTasks($tasksOnPage, $route, $sortData)
    {
        $sql = 'SELECT id, username, email, text, status, edited_by_admin FROM tasks ';
        if (!empty($sortData)) {
            $sql .= 'ORDER BY '.$sortData['column'].' '.$sortData['order'].' ';
        } else {
            $sql .= 'ORDER BY id DESC ';
        }
        $params = [
            'max' => $tasksOnPage,
            'start' => ((isset($route['page']) ? $route['page'] : 1) - 1) * $tasksOnPage,
        ];
        $sql .= 'LIMIT :start, :max';

        $result = $this->db->row($sql, $params);
        return $result;
    }

    public function addTask($inputUsername, $inputEmail, $inputText)
    {
        $params = [
            'username' => $inputUsername,
            'email' => $inputEmail,
            'text' => $inputText,
        ];
        
        $this->db->query('INSERT INTO tasks (username, email, text) VALUES (:username, :email, :text)', $params);
    }

    public function tasksCount()
    {
        return $this->db->column('SELECT COUNT(id) FROM tasks');
    }

    public function changeStatus($id, $status)
    {
        $params = [
            'id' => $id,
            'status' => $status,
        ];
        $this->db->query('UPDATE tasks SET status = :status WHERE id = :id', $params);
    }
    
    public function isTaskExists($id)
    {
        $params = [
            'id' => $id,
        ];
        return $this->db->column('SELECT id FROM tasks WHERE id = :id', $params);
    }
    
    public function getTaskData($id)
    {
        $params = [
            'id' => $id,
        ];
        return $this->db->row('SELECT id, username, email, text FROM tasks WHERE id = :id', $params);
    }
    
    public function getTaskText($id)
    {
        $params = [
            'id' => $id,
        ];
        return $this->db->column('SELECT text FROM tasks WHERE id = :id', $params);
    }

    public function editTask($id, $inputUsername, $inputEmail, $inputText, $oldText)
    {
        $params = [
            'id' => $id,
            'username' => $inputUsername,
            'email' => $inputEmail,
        ];
        if ($inputText === $oldText) {
            $this->db->query('UPDATE tasks SET username = :username, email = :email WHERE id = :id', $params);
        } else {
            $params['text'] = $inputText;
            $params['edited_by_admin'] = 1;
            $this->db->query('UPDATE tasks 
                SET username = :username, email = :email, text = :text, edited_by_admin = :edited_by_admin 
                WHERE id = :id', $params);
        }
    }

    public function formValidate($inputUsername, $inputEmail, $inputText)
    {
        $usernameLen = iconv_strlen($inputUsername);
        $emailLen = iconv_strlen($inputEmail);
        $textLen = iconv_strlen($inputText);
        if ($usernameLen < 1 || $usernameLen > 255) {
            $this->error = 'Имя должно содержать от 1 до 255 символов.';
            return false;
        } elseif ($emailLen < 1 || $emailLen > 255) {
            $this->error = 'Email должен содержать от 1 до 255 символов.';
            return false;
        } elseif (!filter_var($inputEmail, FILTER_VALIDATE_EMAIL)) {
            $this->error = 'Email должен быть похож на email.';
            return false;
        } elseif ($textLen < 1 || $textLen > 1000) {
            $this->error = 'Текст задачи должен содержать от 1 до 1000 символов.';
            return false;
        }
        return true;
    }
}
