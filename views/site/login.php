<div class="container">
    <h2 class="mb-4">Аутентификация</h2>
    <section class="row">
        <h3><?= $message ?? ''; ?></h3>
        <?php
        if (!app()->auth::check()):
            ?>
            <form method="post" class="col-5 shadow-sm p-3 mb-5 ms-0 bg-body rounded">
                <article class="mb-3">
                    <label for="login" class="form-label">Читательский билет</label>
                    <input type="text" class="form-control" name="login">
                </article>
                <article class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" class="form-control" name="password">
                </article>
                <button type="submit" class="btn btn-primary btn-md mt-2">Войти</button>
            </form>
        <?php endif ?>
    </section>
</div>
