<?php
require_once 'db.php';

if (isset($_GET['start_year']) && isset($_GET['end_year'])) {
    $startYear = (int)$_GET['start_year'];
    $endYear = (int)$_GET['end_year'];

    $sql = "SELECT NAME, LITERATE, YEAR, PUBLISHER FROM literature WHERE YEAR BETWEEN :start_year AND :end_year ORDER BY YEAR ASC";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':start_year', $startYear, PDO::PARAM_INT);
    $stmt->bindValue(':end_year', $endYear, PDO::PARAM_INT);
    $stmt->execute();
    
    $results = $stmt->fetchAll();

    echo "<h2>Література з $startYear по $endYear рік:</h2>";
    if ($results) {
        echo "<ul>";
        foreach ($results as $row) {
            echo "<li><strong>" . htmlspecialchars($row['NAME']) . "</strong> [Тип: " . htmlspecialchars($row['LITERATE']) . "] - {$row['YEAR']} рік, Видавництво: " . htmlspecialchars($row['PUBLISHER']) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Записів не знайдено.</p>";
    }
    echo '<a href="index.php">Повернутися назад</a>';
}
?>