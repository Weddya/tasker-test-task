<div class="container-fluid">
    <div class="row">
        <main role="main" class="col-md-4 col-lg-4 mx-auto">
            <h2><?php echo $this->title; ?></h2>
            <div id="ajax-message"></div>
            <form action="/login" method="post" id="login-form">
                <div class="form-group">
                    <label for="username">Логин</label>
                    <input type="text" name="username" class="form-control" id="username">
                </div>
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <p><button type="submit" name="enter" class="btn btn-primary">Войти</button></p>
            </form>
        </main>
    </div>
</div>