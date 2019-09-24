<?php
/**
 * Created by PhpStorm.
 * User: Miracle-
 * Date: 23.09.2019
 * Time: 12:36
 */

class AuthController
{
    public static function index($message = false, $invalid = false)
    {
        include_once __DIR__ . '/../view/auth.php';
    }

    public static function logIn()
    {
        //credits
        $username = 'admin';
        $password = '123';

        if (isset($_POST['user'])) {

            $user = $_POST['user'];
            if ($user['name'] != $username || $user['password'] != $password) {
                $invalid = true;
                $message = 'Ошибка, неправильно ввели данные';
                self::index($message, $invalid);
            } else {
                $_SESSION['is_admin'] = true;
                header('Location: /');
            }
        } else
            header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public static function logOut()
    {
        if(isset($_SESSION['is_admin'])){
            $_SESSION['is_admin'] = false;
            header('Location: /');
        }
    }
}