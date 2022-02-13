<div class="container overflow-hidden mb-5">
    <?php
    if (app()->auth::check_staff()):
        ?>
    <section class="d-flex flex-direction-row">
        <h2 class="mb-5 me-3">Книги</h2>
        <form method="post" class="row g-3">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <article class="col-auto">
                <input class="form-control" type="search" placeholder="Поиск" name="search">
            </article>
            <article class="col-auto">
                <button type="submit" class="btn btn-primary btn-md">Искать</button>
            </article>
        </form>
    </section>
        <?php
        foreach ($books as $book) {
            echo '<section class="col-12 border bg-light rounded-3 p-2 mb-2">';
            echo '<article class="row ps-2 pe-0">' ;
            echo '<div class="col h5 m-0">' . $book->title . '</div>';
            echo '<p class="h6 text-decoration-none col m-0">автор моложец</p>';
            echo '<div class="col">' . $book->year . '</div>';
            echo '<div class="col"> Новое издание: ' . $book->new_edition . '</div>';
            echo '<a class="col btn btn-danger btn-sm p-0" href='.app()->route->getUrl('/book_delete?id='. $book->id).'>Удалить</a>';
            echo '</article>' ;
            echo '</section>';
        }
        ?>
    <?php
    else:
        ?>
    <h3>Как вы здесь оказались!?</h3>
    <?php endif; ?>
</div>