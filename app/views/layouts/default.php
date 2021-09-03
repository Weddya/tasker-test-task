<!DOCTYPE html>
<html>
<head>
    <title><?php echo $this->title; ?></title>
    <link rel="stylesheet" href="/public/css/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/030b653943.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark flex-md-nowrap p-0 mb-4 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/">Tasker</a>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <?php if ($adminAccess): ?>
                    <a class="nav-link" href="/logout">Выход</a>
                <?php else: ?>
                    <a class="nav-link" href="/login">Авторизация</a>
                <?php endif; ?>
            </li>
        </ul>
    </nav>
    <?php echo $content; ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="/public/scripts/jquery-3.6.0.min.js"></script>
    <script src="/public/scripts/ajax.js"></script>
</body>
</html>