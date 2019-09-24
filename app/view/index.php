<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Todo</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

    <style>
        body {
            padding-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">

    <? if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == true): ?>
        <a href="logOut" class="btn btn-primary">Log out</a>
    <? else: ?>
        <a href="auth" class="btn btn-primary">Log in</a>
    <? endif; ?>

    <? if (isset($_SESSION['showNotify']) && $_SESSION['showNotify']): ?>
        <div id="notifySuccess" class="alert alert-success">Todo успешно создан</div>
        <? $_SESSION['showNotify'] = false ?>
    <? endif; ?>

    <table class="table table-striped table-bordered" id="todoTable">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Text</th>
            <th>Status</th>

            <? if ($_SESSION['is_admin']): ?>
                <th>Action</th>
            <? endif; ?>

        </tr>
        </thead>
        <tbody>
        <?php if ($todos): ?>
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
        <?php endif; ?>
        </tbody>
    </table>

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

</div>


<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<script>

    $('.todoUpdate').click(function (e) {
        let todoText = $(e.target).parents("tr").children(".todoText").children().val();
        let todoStatus = $(e.target).parents("tr").children(".todoStatus").children('select').val();

        $(e.target).parents("tr").children(".todoUpdateForm").find("input[name='text']").val(todoText);
        $(e.target).parents("tr").children(".todoUpdateForm").find("input[name='status']").val(todoStatus);

    });

    $('#todoTable').DataTable({
        pageLength: 3,
        searching: false,
        lengthChange: false,
        columnDefs: [
            {orderable: false, targets: 2}
        ],
    });

</script>

</body>
</html>