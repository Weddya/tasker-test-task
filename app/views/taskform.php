<div class="container-fluid">
    <div class="row">
        <main role="main" class="col-md-4 col-lg-4 mx-auto">
            <h2><?php echo $this->title; ?></h2>
            <div id="ajax-message"></div>
            <form action="/<?php echo empty($data['id']) ? 'add' : 'edit/'.$data['id']; ?>" method="post" id="<?php echo $this->action; ?>-form">
                <div class="form-group">
                    <label for="username">Имя пользователя</label>
                    <input type="text" name="username" class="form-control" id="username" value="<?php echo !empty($data['username']) ? $data['username'] : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" id="email" value="<?php echo !empty($data['email']) ? $data['email'] : ''; ?>">
                </div>
                <div class="form-group">
                    <textarea name="text" class="form-control" rows="5" id="text"><?php echo !empty($data['text']) ? $data['text'] : ''; ?></textarea>
                </div>
                <p><button type="submit" name="enter" class="btn btn-primary">Сохранить</button></p>
            </form>
        </main>
    </div>
</div>
