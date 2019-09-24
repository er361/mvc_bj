<?php
/**
 * Created by PhpStorm.
 * User: Miracle-
 * Date: 20.09.2019
 * Time: 14:55
 */

include_once __DIR__ . '/../models/Todo.php';

class TodoController
{
    public static function index()
    {
        $todos = Todo::all();
        $str = __DIR__ . '/../view/index.php';

        include_once $str;
    }

    public static function addTodo()
    {
        $todo = $_POST['todo'];

        $todoModel = new Todo();
        $todoModel->email = $todo['email'];
        $todoModel->name = $todo['name'];
        $todoModel->text = $todo['text'];
        $todoModel->tags = $todo['tags'];
        $todoModel->save();

        if (!$todo['tags'])
            $_SESSION['showNotify'] = true;

        header('Location: /');
    }

    public static function update()
    {
        $id = $_POST['id'];
        $status = $_POST['status'];
        $text = $_POST['text'];

        $todoModel = Todo::retrieveByPK($id);
        $todoModel->status = $status;

        if ($todoModel->text != $text)
            $todoModel->has_change = true;

        $todoModel->text = $text;

        $todoModel->save();
        header('Location: /');
    }
}