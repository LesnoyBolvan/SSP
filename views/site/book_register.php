<div class="container">
    <?php
    if (app()->auth::check_staff()):
    ?>
    <h2 class="mb-4">Оформление книги</h2>
    <section class="row">
        <h3><?= $message ?? ''; ?></h3>
            <form method="post" class="col-5 shadow-sm p-3 mb-5 ms-0 bg-body rounded">
                <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
                <article class="mb-3">
                    <label for="book" class="form-label">Книга</label>
                    <select class="form-select" aria-label="Выберите книгу" name="book">
                        <?php
                        foreach ($books as $book) {
                            echo '<option label='. $book->title .'>' . $book->id . '</option>';
                        }
                        ?>
                    </select>
                </article>
                <article class="mb-3">
                    <label for="user" class="form-label">Читатель</label>
                    <select class="form-select" aria-label="Выберите читателя" name="user">
                        <?php
                        foreach ($users as $user) {
                            echo '<option label='. $user->first_name . '' . $user->patronymic . '' . $user->last_name . '>' . $user->id . '</option>';
                        }
                        ?>
                    </select>
                </article>
                <article class="mb-3">
                    <label for="issue_date" class="form-label">Дата возврата</label>
                    <input type="date" class="form-control" name="issue_date">
                </article>
                <button type="submit" class="btn btn-primary btn-md mt-2">Зарегистрировать</button>
            </form>
    </section>
    <?php
    else:
        ?>
        <h3>Как вы здесь оказались!?</h3>
    <?php endif; ?>
</div>