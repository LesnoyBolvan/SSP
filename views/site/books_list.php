<div class="container overflow-hidden mb-5">
    <?php
    if (app()->auth::check_staff()):
        ?>
    <section class="d-flex flex-direction-row">
        <h2 class="mb-5 me-3">Книги</h2>
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

    <section class="col-9 border bg-light rounded-3 p-2 mb-2">
        <article class="row ps-2 pe-2">
            <div class="col h6 m-0">Мертвые души</div>
            <a class="h5 text-decoration-none col m-0" href="">Иван Иваныч Гоголь </a>
            <div class="col">1956 год</div>
            <div class="col">Новое издание: нет</div>
        </article>
    </section>
    <section class="col-9 border bg-light rounded-3 p-2 mb-2">
        <article class="row ps-2 pe-2">
            <div class="col h6 m-0">Мертвые души</div>
            <a class="h5 text-decoration-none col m-0" href="">Иван Иваныч Гоголь </a>
            <div class="col">1956 год</div>
            <div class="col">Новое издание: нет</div>
        </article>
    </section>
    <section class="col-9 border bg-light rounded-3 p-2 mb-2">
        <article class="row ps-2 pe-2">
            <div class="col h6 m-0">Мертвые души</div>
            <a class="h5 text-decoration-none col m-0" href="">Иван Иваныч Гоголь </a>
            <div class="col">1956 год</div>
            <div class="col">Новое издание: нет</div>
        </article>
    </section>
    <?php
    else:
        ?>
    <h3>Как вы здесь оказались!?</h3>
    <?php endif; ?>
</div>