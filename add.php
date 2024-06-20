<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Обработка отправленной формы
    $type = $_POST['type'];
    $galaxy = $_POST['galaxy'];
    $accuracy = $_POST['accuracy'];
    $lightFlux = $_POST['lightFlux'];
    $associatedObjects = $_POST['associatedObjects'];
    $note = $_POST['note'];

    // Добавление записи в базу данных
    $host = 'bojack-db';
    $dbname = 'bojack_db';
    $username = 'bojack_user';
    $password = 'P@ssw0rd';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $stmt = $pdo->prepare('INSERT INTO NaturalObjects (type, galaxy, accuracy, lightFlux, associatedObjects, note) VALUES (:type, :galaxy, :accuracy, :lightFlux, :associatedObjects, :note)');
        $stmt->execute(['type' => $type, 'galaxy' => $galaxy, 'accuracy' => $accuracy, 'lightFlux' => $lightFlux, 'associatedObjects' => $associatedObjects, 'note' => $note]);
        echo 'Запись успешно добавлена в таблицу NaturalObjects.';
    } catch (PDOException $e) {
        echo "Ошибка: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Добавить новую запись в NaturalObjects</title>
</head>
<body>
<h1>Добавить новую запись</h1>
<form method="post" action="">
    <label for="type">Тип:</label><br>
    <input type="text" id="type" name="type"><br><br>

    <label for="galaxy">Галактика:</label><br>
    <input type="text" id="galaxy" name="galaxy"><br><br>

    <label for="accuracy">Точность:</label><br>
    <input type="text" id="accuracy" name="accuracy"><br><br>

    <label for="lightFlux">Световой поток:</label><br>
    <input type="text" id="lightFlux" name="lightFlux"><br><br>

    <label for="associatedObjects">Ассоциированные объекты:</label><br>
    <input type="text" id="associatedObjects" name="associatedObjects"><br><br>

    <label for="note">Примечание:</label><br>
    <textarea id="note" name="note"></textarea><br><br>

    <input type="submit" value="Добавить запись">
</form>
</body>
</html>