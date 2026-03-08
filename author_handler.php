<?php
require_once 'db.php';

if (isset($_GET['author_id'])) {
    $authorId = (int)$_GET['author_id'];

    $sql = "SELECT l.NAME as title, l.YEAR, l.PUBLISHER 
            FROM literature l
            JOIN book_authrs ba ON l.Id = ba.FID_BOOK
            WHERE ba.FID_AUTH = :author_id";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':author_id', $authorId, PDO::PARAM_INT);
    $stmt->execute();
    
    $results = $stmt->fetchAll();

    echo "<h2>Книги обраного автора:</h2>";
    if ($results) {
        echo "<ul>";
        foreach ($results as $row) {
            echo "<li><strong>" . htmlspecialchars($row['title']) . "</strong> (Рік: {$row['YEAR']}, Видавництво: " . htmlspecialchars($row['PUBLISHER']) . ")</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Книг цього автора не знайдено.</p>";
    }
    echo '<a href="index.php">Повернутися назад</a>';
}
?>