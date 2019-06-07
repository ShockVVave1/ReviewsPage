<?php ?>

<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <header>
            <form action="/review/add" method="get" enctype="multipart/form-data">
                <input type="text">
                <input type="submit">
            </form>
        </header>
        <main>
            <section>
                <?php
                echo $pagination;
                echo '<pre>';
                echo $filter;
                echo '</pre>';
                echo '<pre>';
                print_r($reviews);
                echo '</pre>';
                ?>

            </section>
            <section class="pagination"></section>
        </main>
    </body>
</html>
