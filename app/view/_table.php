<?php
/**
 * Created by PhpStorm.
 * User: Miracle-
 * Date: 24.09.2019
 * Time: 11:40
 */
?>
<table class="table table-striped table-bordered" id="todoTable">
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Text</th>
        <th>Status</th>

        <? if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
            <th>Action</th>
        <? endif; ?>

    </tr>
    </thead>
    <tbody>
    <? foreach ($todos as $todo): ?>
        <tr>
            <td><?= $todo->name ?></td>
            <td><?= $todo->email ?></td>

            <? if ($_SESSION['is_admin']): ?>
                <td class="todoText">
                    <textarea><?= $todo->text ?></textarea>
                </td>
            <? else: ?>
                <td><?= $todo->text ?></td>
            <? endif ?>

            <? if ($_SESSION['is_admin']): ?>
                <td class="todoStatus">
                    <? $todoStatus = intval($todo->status); ?>
                    <!-- for order -->
                    <span style="visibility: hidden"><?= $todoStatus ?></span>

                    <select class="custom-select">
                        <option value="1" <? if ($todoStatus == 1) echo 'selected'; ?>>
                            Выполнено
                        </option>

                        <option value="0" <? if ($todoStatus == 0) echo 'selected'; ?>>
                            Не выполнено
                        </option>
                    </select>
                </td>
            <? else: ?>
                <td>
                    <span class="badge badge-primary"><?= $todo->status ? 'Выполнено' : 'Не выполнено' ?></span>
                    <span class="badge badge-success"><?= $todo->has_change ? 'Отредактировано' : null ?></span>
                </td>
            <? endif; ?>

            <? if ($_SESSION['is_admin']) : ?>
                <td class="todoUpdateForm">
                    <form action="updateTodo" method="post">

                        <input type="hidden" name="id" value="<?= $todo->id ?>">
                        <input type="hidden" name="text">
                        <input type="hidden" name="status">

                        <button type="submit" class="btn btn-success todoUpdate">Сохранить</button>
                    </form>
                </td>
            <? endif; ?>
        </tr>
    <? endforeach; ?>
    </tbody>
</table>
