<?php
/**
 * Created by PhpStorm.
 * User: Miracle-
 * Date: 23.09.2019
 * Time: 14:04
 */
?>

<h2 class="text-center">Форма добавления задачи</h2>
<div class="d-flex justify-content-center">

    <form id="todoForm" action="addTodo" method="post">

        <div class="form-group">
            <label for="name">Имя</label>
            <input type="text" class="form-control" id="name" name='todo[name]' required>
            <div class="invalid-feedback">Обязательное поле</div>
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" name='todo[email]' required>
            <div class="invalid-feedback">Введите валидный email</div>
        </div>

        <div class="form-group">
            <label for="tags">Тэги</label>
            <input type="text" class="form-control" id="tags" name="todo[tags]">
        </div>

        <div class="form-group">
            <label for="text">Текст</label>
            <div>
                <textarea cols="40" rows="5" class="form-control" id="text" name='todo[text]' required></textarea>
                <div class="invalid-feedback">Обязательное поле</div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Добавить</button>
    </form>

</div>
