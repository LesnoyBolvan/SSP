<div class="container">
    <h2 class="mb-4">Добавление книги</h2>
    <section class="row">
        <h3><?= $message ?? ''; ?></h3>
        <form method="post" class="col-5 shadow-sm p-3 mb-5 ms-0 bg-body rounded">
            <article class="mb-3">
                <label for="title" class="form-label">Название</label>
                <input type="text" class="form-control" name="title">
            </article>
            <article class="mb-3">
                <label for="desc" class="form-label">Описание</label>
                <textarea class="form-control" id="floatingTextarea" name="desc"></textarea>
            </article>
            <article class="mb-3 col-2">
                <label for="price" class="form-label">Цена</label>
                <input type="text" class="form-control" name="price">
            </article>
            <button type="submit" class="btn btn-primary btn-md mt-2">Добавить</button>
        </form>
        <?php
        if (app()->auth::check()):
            ?>

        <?php endif ?>
    </section>
</div>