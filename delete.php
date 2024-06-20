<?php
$host = 'bojack-db';
$dbname = 'bojack_db';
$username = 'bojack_user';
$password = 'P@ssw0rd';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $objectId = $_POST['objectId']; // получаем id объекта для удаления
        // Удаляем объект из базы данных на основе переданного id
        // Реализуйте эту часть кода в соответствии с вашей логикой
        echo "Данные успешно удалены.";
    } catch (PDOException $e) {
        echo "Ошибка: " . $e->getMessage();
    }
}

if (isset($_GET['id'])) {
    $objectId = $_GET['id'];
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $stmt = $pdo->prepare('SELECT * FROM NaturalObjects WHERE objectId = :objectId');
        $stmt->execute(['objectId' => $objectId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Ошибка: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Удаление записи</title>
</head>
<body>
<h1>Удаление записи</h1>
<p>Вы уверены, что хотите удалить следующую запись?</p>
<p>Тип: <?= $row['type'] ?></p>
<p>Галактика: <?= $row['galaxy'] ?></p>
<form method="POST">
    <input type="hidden" name="objectId" value="<?= $row['objectId'] ?>">
    <button type="submit">Подтвердить удаление</button>
    <a href="index.php">Отмена</a>
</form>
</body>
</html>
