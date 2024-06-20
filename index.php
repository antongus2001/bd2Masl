<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список объектов</title>
</head>
<body>
<h2>Список объектов</h2>
<div id="objectsList">
    <?php
    $host = 'bojack-db';
    $dbname = 'bojack_db';
    $username = 'bojack_user';
    $password = 'P@ssw0rd';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $stmt = $pdo->query('SELECT * FROM NaturalObjects');
        echo '<table>';
        echo '<tr><th>objectId</th><th>type</th><th>galaxy</th><th>accuracy</th><th>lightFlux</th><th>associatedObjects</th><th>note</th><th>Действия</th></tr>';
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            foreach ($row as $value) {
                echo '<td>' . htmlspecialchars($value) . '</td>';
            }
            echo '<td><a href="edit.php?id=' . $row['objectId'] . '">Редактировать</a></td>';
            echo '<td><a href="delete.php?id=' . $row['objectId'] . '">Удалить</a></td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '<a href="add.php">Добавить новую запись</a>';
        echo '<br><br>';
        echo '<form action="join_tables_data.php" method="GET">';
        echo '<input type="submit" value="Показать данные из объединенных таблиц">';
        echo '</form>';
    } catch (PDOException $e) {
        echo "Ошибка: " . $e->getMessage();
    }
    ?>
</div>
</body>
</html>
