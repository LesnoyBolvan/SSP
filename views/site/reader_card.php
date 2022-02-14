<div class="container overflow-hidden mb-5">
    <h2 class="mb-5">Мои книги</h2>
    <section class="row gy-5">
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

    </section>
</div>