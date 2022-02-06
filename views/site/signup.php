<div class="container">
    <h2 class="mb-4">Добавить пользователя</h2>
    <section class="row">
        <h3><?= $message ?? ''; ?></h3>
        <?php
        if (app()->auth::check()):
            ?>
            <form method="post" class="col-5 shadow-sm p-3 mb-5 ms-0 bg-body rounded">
                <article class="mb-3">
                    <label for="first_name" class="form-label">Имя</label>
                    <input type="text" class="form-control" name="first_name">
                </article>
                <article class="mb-3">
                    <label for="last_name" class="form-label">Фамилия</label>
                    <input type="text" class="form-control" name="last_name">
                </article>
                <article class="mb-3">
                    <label for="patronymic" class="form-label">Отчество</label>
                    <input type="text" class="form-control" name="patronymic">
                </article>
                <article class="mb-3">
                    <label for="phone_number" class="form-label">Телефон</label>
                    <input type="text" class="form-control" name="phone_number">
                </article>
                <article class="mb-3">
                    <label for="address" class="form-label">Адрес</label>
                    <input type="text" class="form-control" name="address">
                </article>
                <article class="mb-3">
                    <label for="role" class="form-label">Роль</label>
                    <select class="form-select" aria-label="Default select example" name="role_id">
                        <?php
                        foreach ($roles as $role) {
                            echo '<option label='. $role->role .'>' . $role->id . '</option>';
                        }
                        ?>
                    </select>
                </article>
                <button type="submit" class="btn btn-primary btn-md mt-2">Добавить</button>
            </form>
        <?php endif ?>
    </section>
</div>