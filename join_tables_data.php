<?php

$host = 'bojack-db';
$dbname = 'bojack_db';
$username = 'bojack_user';
$password = 'P@ssw0rd';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Вызываем процедуру для объединения таблиц Position и Objects
    $sql = 'CALL join_tables_data("Position", "Objects")';
    $stmt = $pdo->query($sql);

    echo '<h2>Данные из объединенных таблиц Position и Objects:</h2>';
    echo '<table>';
    echo '<tr><th>positionId</th><th>EarthPosition</th><th>SunPosition</th><th>MoonPosition</th><th>InterstellarCoordinates</th><th>StarField</th><th>CurrentDate</th><th>CurrentTime</th><th>regionOfSpaceOccupied</th><th>objectType</th><th>description</th><th>parentObject</th></tr>';
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['positionId']) . '</td>';
        echo '<td>' . htmlspecialchars($row['EarthPosition']) . '</td>';
        echo '<td>' . htmlspecialchars($row['SunPosition']) . '</td>';
        echo '<td>' . htmlspecialchars($row['MoonPosition']) . '</td>';
        echo '<td>' . htmlspecialchars($row['InterstellarCoordinates']) . '</td>';
        echo '<td>' . htmlspecialchars($row['StarField']) . '</td>';
        echo '<td>' . htmlspecialchars($row['CurrentDate']) . '</td>';
        echo '<td>' . htmlspecialchars($row['CurrentTime']) . '</td>';
        echo '<td>' . htmlspecialchars($row['regionOfSpaceOccupied']) . '</td>';
        echo '<td>' . htmlspecialchars($row['objectType']) . '</td>';
        echo '<td>' . htmlspecialchars($row['description']) . '</td>';
        echo '<td>' . htmlspecialchars($row['parentObject']) . '</td>';
        echo '</tr>';
    }
    echo '</table>';

} catch (PDOException $e) {
    die('Ошибка: ' . $e->getMessage());
}
?>