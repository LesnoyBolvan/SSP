<div class="container">
    <h2 class="mb-4">Авторизация</h2>
    <section class="row">
        <h3><?= $message ?? ''; ?></h3>
        <h3><?= app()->auth->user()->name ?? ''; ?></h3>
        <?php
        if (!app()->auth::check()):
            ?>
            <form method="post" class="col-5 shadow-sm p-3 mb-5 ms-0 bg-body rounded">
                <div class="mb-3">
                    <label for="readCard" class="form-label">Читательский билет</label>
                    <input type="text" class="form-control" name="login">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <button type="submit" class="btn btn-primary btn-md mt-2">Войти</button>
            </form>
        <?php endif ?>
    </section>
</div>
