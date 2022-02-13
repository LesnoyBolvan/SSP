<div class="container overflow-hidden mb-5">
    <?php
    if (app()->auth::check_staff()):
    ?>
    <section class="d-flex flex-direction-row">
        <h2 class="mb-5 me-3">Читатели</h2>
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
        foreach ($users as $user) {
            echo '<section class="col-9 border bg-light rounded-3 p-2 mb-2">';
            echo '<article class="row ps-2 pe-2">' ;
            echo '<div class="col h6 m-0 text-center">'. $user->login .'</div>';
            echo "<p class='5 text-decoration-none col m-0 h5 ' href=''>$user->first_name $user->patronymic $user->last_name</p>";
            echo '<div class="col text-center">'. $user->phone_number .'</div>';
            echo '<div class="col text-center">'. $user->address .'</div>';
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