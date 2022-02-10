<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Библиотека</title>
</head>
<body>
<header class="container-fluid p-0">
    <section class="d-flex flex-direction-row justify-content-between align-items-center ps-5 pe-5 shadow-sm p-3 mb-5 ms-0 bg-body rounded">
        <a class="h1 text-decoration-none" href="<?= app()->route->getUrl('/popular')?>">Библиотека им. Астама Кузюры</a>
        <nav>
            <?php
            if (!app()->auth::check()):
                ?>
                <a class="btn btn-primary me-2 " href="<?= app()->route->getUrl('/login') ?>">Вход</a>
                <a class="btn btn-outline-primary me-5 " href="<?= app()->route->getUrl('/login') ?>">Регистрация</a>
            <?php
            else:
                ?>
                <section class="btn-group me-5">
                    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= app()->auth::user()->first_name?>
                            <?= app()->auth::user()->last_name?>
                    </button>
                    <article class="dropdown-menu">
                        <?php
                        if (app()->auth::check_staff()):
                            ?>
                            <a class="dropdown-item" href="<?= app()->route->getUrl('/book_register') ?>">Регистрация книги</a>
                            <a class="dropdown-item" href="<?= app()->route->getUrl('/user_add') ?>">Добавить пользователя</a>
                            <a class="dropdown-item" href="<?= app()->route->getUrl('/book_add') ?>">Добавить книгу</a>
                            <a class="dropdown-item" href="<?= app()->route->getUrl('/author_add') ?>">Добавить автора</a>
                            <a class="dropdown-item" href="<?= app()->route->getUrl('/readers_list') ?>">Список читателей</a>
                            <a class="dropdown-item" href="<?= app()->route->getUrl('/books_list') ?>">Список книг</a>
                        <?php
                        endif;
                            ?>
                        <?php
                        if (app()->auth::check()):
                            ?>
                            <a class="dropdown-item" href="<?= app()->route->getUrl('/books') ?>">Все книги</a>
                            <a class="dropdown-item" href="<?= app()->route->getUrl('/reader_card') ?>">Мои книги</a>
                            <a class="dropdown-item" href="<?= app()->route->getUrl('/logout') ?>">Выход</a>
                        <?php
                        endif;
                        ?>
                    </article>
                </section>
            <?php
            endif;
                ?>
        </nav>
    </section>
</header>
<main>
    <?= $content ?? '' ?>
</main>
<footer class="p-0 container-fluid position-static bottom-0">
    <section class="bg-light d-flex justify-content-center align-items-end">
       <p class="pt-5">© 2022 Библиотека</p>
    </section>
</footer>
</body>
</html>
