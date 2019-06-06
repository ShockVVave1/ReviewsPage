<?php

/**
 * Для переустановки разместите
 *  include_once ROOT.'/database/setupScript.php';
 * строкой выше перед
 *  $router = new Router();
 */

//Проверка запроса формы
if (isset($_GET['submit'])) {
    //Генерация содержания конфигурационного файла
    $content = "<?php

            /**
             * Конфигурациооный файл для соединения с БД
             */
            return array(
                'host' => \"" . $_GET['host'] . "\",
                'dbname' => \"" . $_GET['dbname'] . "\",
                'user' => \"" . $_GET['user'] . "\",
                'password' =>\"" . $_GET['password'] . "\"
            
            );";
    file_put_contents(ROOT . '/app/configs/db_params.php', $content);

    //Создания БД и её заполнение
    $db = Db::getConnection();

    if (!$db->exec(file_get_contents(ROOT . '/database/createReviewsTable'))) {
        header('/');
    }
    if (!$db->exec(file_get_contents(ROOT . '/database/fillReviewsTable'))) {
        $db->exec('DROP TABLE Reviews');
        header('/');
    }
    unset($db);

    //Удаление подключения файла первоначальной настройки
    $indexFile = file(ROOT . '/index.php');

    $i = 0;
    foreach ($indexFile as $string => $value) {
        if (is_numeric(strpos($value, "include_once ROOT.'/database/setupScript.php';"))) {
            $indexFile[$i] = "";
        }
        $i++;
    }
    file_put_contents(ROOT . '/index.php', $indexFile);

    header('/');
    die;
}
?>

<h1>Настройка БД</h1>
<form action="/" method="get">
    <div>
        <label for="host">Хост</label>
        <input type="text" id="host" name="host" value="<?php echo $_GET['host']; ?>" required>
    </div>
    <div>
        <label for="dbname">Имя БД</label>
        <input type="text" id="dbname" name="dbname" value="<?php echo $_GET['dbname']; ?>" required>
    </div>
    <div>
        <label for="user">Имя пользователя</label>
        <input type="text" id="user" name="user" value="<?php echo $_GET['user']; ?>" required>
    </div>
    <div>
        <label for="password">Пароль</label>
        <input type="password" id="password" name="password" value="<?php echo $_GET['password']; ?>">
    </div>
    <input type="submit" name="submit">
</form>

<?php die ?>

