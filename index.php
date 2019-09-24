<?php
/**
 * Created by PhpStorm.
 * User: Miracle-
 * Date: 20.09.2019
 * Time: 16:02
 */


include "app/controllers/TodoController.php";
include "app/controllers/AuthController.php";

$request = $_SERVER['REQUEST_URI'];

session_start();
switch ($request) {
    case '/':
        TodoController::index();
        break;
    case '/addTodo':
        TodoController::addTodo();
        break;
    case '/updateTodo':
        if (!$_SESSION['is_admin'])
            header('Location: auth');
        else
            TodoController::update();
        break;
    case '/auth':
        AuthController::index();
        break;
    case '/logIn':
        AuthController::logIn();
        break;
    case '/logOut':
        AuthController::logout();
        break;
    default:
        header("HTTP/1.0 404 Not Found");
}


