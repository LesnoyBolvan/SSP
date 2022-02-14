<div class="container overflow-hidden mb-5">
    <?php
    if (app()->auth::check_staff()):
        ?>
        <section class="d-flex flex-direction-row">
            <h2 class="mb-5 me-3">Авторы</h2>
            <form method="post" class="row g-3">
                <article class="col-auto">
                    <input class="form-control" list="datalistOptions" placeholder="Фильтрация">
                    <datalist id="datalistOptions">
                        <option value="Иван Иваныч">
                        <option value="New York">
                        <option value="Seattle">
                        <option value="Los Angeles">
                        <option value="Chicago">
                    </datalist>
                </article>
                <article class="col-auto">
                    <button type="submit" class="btn btn-primary btn-md">Применить</button>
                </article>
            </form>
        </section>
        <?php
        foreach ($authors as $author) {
            echo '<section class="col-9 border bg-light rounded-3 p-2 mb-2">';
            echo '<article class="row ps-2 pe-2">';
            echo '<a class="h5 text-decoration-none col m-0" href="">'. $author->first_name .' '. $author->patronymic .' '. $author->last_name .'</a>';
            echo '<a class="col btn btn-danger btn-sm p-0" href='.app()->route->getUrl('/author_delete?id='. $author->id).'>Удалить</a>';
            echo '</article>';
            echo '</section>';
        }
        ?>
    <?php
    else:
        ?>
        <h3>Как вы здесь оказались!?</h3>
    <?php endif; ?>
</div>