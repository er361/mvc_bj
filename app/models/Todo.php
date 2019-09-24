<?php
/**
 * Created by PhpStorm.
 * User: Miracle-
 * Date: 20.09.2019
 * Time: 13:04
 */

include_once __DIR__ . "/../db/connection.php";
include_once __DIR__ .'/../db/SimpleOrm.class.php';

class Todo extends SimpleOrm
{
    public $name;
    public $email;
    public $text;
    public $status;
    public $tags;
    public $has_change;
}