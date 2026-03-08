<?php
require_once 'db.php';

if (isset($_GET['publisher'])) {
    $publisher = $_GET['publisher'];

    $sql = "SELECT NAME, YEAR, ISBN FROM literature WHERE PUBLISHER = :publisher";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':publisher', $publisher, PDO::PARAM_STR);
    $stmt->execute();
    
    $results = $stmt->fetchAll();

    echo "<h2>Результати для видавництва: " . htmlspecialchars($publisher) . "</h2>";
    if ($results) {
        echo "<ul>";
        foreach ($results as $row) {
            echo "<li><strong>" . htmlspecialchars($row['NAME']) . "</strong> (Рік: {$row['YEAR']}, ISBN: {$row['ISBN']})</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Книг не знайдено.</p>";
    }
    echo '<a href="index.php">Повернутися назад</a>';
}
?>