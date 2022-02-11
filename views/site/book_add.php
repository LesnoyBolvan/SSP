<div class="container">
    <?php
    if (app()->auth::check_staff()):
    ?>
    <h2 class="mb-4">Добавление книги</h2>
    <section class="row">
        <h3><?= $message ?? ''; ?></h3>
        <form method="post" enctype="multipart/form-data" class="col-5 shadow-sm p-3 mb-5 ms-0 bg-body rounded">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <article class="mb-3">
                <label for="title" class="form-label">Название</label>
                <input type="text" class="form-control" name="title">
            </article>
            <article class="mb-3">
                <label for="annotation" class="form-label">Описание</label>
                <textarea class="form-control" name="annotation"></textarea>
            </article>
            <article class="mb-3">
                <label for="year" class="form-label">Дата написания книги</label>
                <input type="date" class="form-control" name="year">
            </article>
            <article class="mb-3">
                <label for="image" class="form-label">Обложка</label>
                <input type="file" class="form-control" name="image">
            </article>
            <article class="mb-3">
                <label for="new_edition" class="form-check-label">Новое издание</label>
                <select class="form-select" aria-label="Default select example" name="new_edition">
                    <option value="1">Да</option>
                    <option value="0">Нет</option>
                </select>
            </article>
            <article class="mb-3 col-2">
                <label for="price" class="form-label">Цена</label>
                <input type="text" class="form-control" name="price">
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