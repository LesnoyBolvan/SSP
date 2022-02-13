<div class="container overflow-hidden mb-5">
    <section class="d-flex flex-direction-row">
        <h2 class="mb-5 me-3">Популярное</h2>
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

    <section class="row gy-5">
        <?php
        foreach ($books as $book){
            echo '<section class="col-6">';
            echo '<section class="border bg-light rounded-3 d-flex flex-direction-row">';
            echo '<article>';
            echo '<img class="bg-black rounded-start" style="height: 250px; width: 250px;" src=upload/'.$book->image.'>';
            echo '</article>';
            echo '<article class="row text-start p-4">';
            echo '<a class="h5 text-decoration-none" href="">'.$book->title.'</a>';
            echo '<p class="">'.$book->annotation.'</p>';
            echo '<p class="align-self-end h6"> гогол</p>';
            echo '</article>';
            echo '</section>';
            echo '</section>';

        }
        ?>
    </section>
</div>