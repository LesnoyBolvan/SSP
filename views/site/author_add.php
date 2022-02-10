<div class="container">
    <?php
    if (app()->auth::check_staff()):
    ?>
    <h2 class="mb-4">Добавление автора</h2>
    <section class="row">
        <h3><?= $message ?? ''; ?></h3>
        <form method="post" class="col-5 shadow-sm p-3 mb-5 ms-0 bg-body rounded">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <article class="mb-3">
                <label class="form-label">Имя</label>
                <input type="text" class="form-control" name="first_name">
            </article>
            <article class="mb-3">
                <label \class="form-label">Фамилия</label>
                <input class="form-control" id="floatingTextarea" name="last_name">
            </article>
            <article class="mb-3">
                <label  class="form-label">Отчество</label>
                <input class="form-control" name="patronymic">
            </article>
            <button type="submit" class="btn btn-primary btn-md mt-2">Добавить</button>
        </form>
    </section>
    <?php
    else:
        ?>
        <h3>Как вы здесь оказались!?</h3>
    <?php endif; ?>
</div>