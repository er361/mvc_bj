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

    <? require_once __DIR__ . "/_table.php" ?>
    <? require_once __DIR__ . "/_form.php" ?>

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