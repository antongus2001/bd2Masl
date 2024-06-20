<?php
$host = 'bojack-db';
$dbname = 'bojack_db';
$username = 'bojack_user';
$password = 'P@ssw0rd';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $objectId = $_POST['objectId']; // получаем id объекта для редактирования
        // обновляем данные объекта в базе данных на основе переданных данных из формы
        // Реализуйте эту часть кода в соответствии с вашей логикой
        echo "Данные успешно обновлены.";
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
    <title>Редактирование записи</title>
</head>
<body>
<h1>Редактирование записи</h1>
<form method="POST">
    <input type="hidden" name="objectId" value="<?= $row['objectId'] ?>">
    <label for="type">Тип:</label>
    <input type="text" id="type" name="type" value="<?= $row['type'] ?>"><br><br>
    <label for="galaxy">Галактика:</label>
    <input type="text" id="galaxy" name="galaxy" value="<?= $row['galaxy'] ?>"><br><br>
    <label for="accuracy">Точность:</label>
    <input type="text" id="accuracy" name="accuracy" value="<?= $row['accuracy'] ?>"><br><br>
    <label for="lightFlux">Поток света:</label>
    <input type="text" id="lightFlux" name="lightFlux" value="<?= $row['lightFlux'] ?>"><br><br>
    <label for="associatedObjects">Связанные объекты:</label>
    <input type="text" id="associatedObjects" name="associatedObjects" value="<?= $row['associatedObjects'] ?>"><br><br>
    <label for="note">Примечание:</label>
    <textarea id="note" name="note"><?= $row['note'] ?></textarea><br><br>
    <button type="submit">Сохранить</button>
</form>
</body>
</html>