<?php
require_once 'db.php';

$stmtPub = $pdo->query("SELECT DISTINCT PUBLISHER FROM literature WHERE PUBLISHER IS NOT NULL AND PUBLISHER != ''");
$publishers = $stmtPub->fetchAll();

$stmtAuth = $pdo->query("SELECT Id, NAME FROM author");
$authors = $stmtAuth->fetchAll();
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Лабораторна робота: Бібліотека (PDO)</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        section { margin-bottom: 30px; padding: 15px; border: 1px solid #ccc; background: #f9f9f9; }
        label { font-weight: bold; margin-right: 10px; }
        button { margin-left: 10px; padding: 5px 15px; }
    </style>
</head>
<body>
    <h1>Пошукова система бази «Бібліотека»</h1>

    <section>
        <h2>1. Книги зазначеного видавництва</h2>
        <form action="publisher_handler.php" method="GET">
            <label for="publisher">Виберіть видавництво:</label>
            <select name="publisher" id="publisher" required>
                <?php foreach($publishers as $pub): ?>
                    <option value="<?= htmlspecialchars($pub['PUBLISHER']) ?>">
                        <?= htmlspecialchars($pub['PUBLISHER']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Шукати</button>
        </form>
    </section>

    <section>
        <h2>2. Література за вказаний період (рік видання)</h2>
        <form action="year_handler.php" method="GET">
            <label for="start_year">З року:</label>
            <input type="number" name="start_year" id="start_year" value="2000" required>
            <label for="end_year">По рік:</label>
            <input type="number" name="end_year" id="end_year" value="2023" required>
            <button type="submit">Шукати</button>
        </form>
    </section>

    <section>
        <h2>3. Книги зазначеного автора</h2>
        <form action="author_handler.php" method="GET">
            <label for="author_id">Виберіть автора:</label>
            <select name="author_id" id="author_id" required>
                <?php foreach($authors as $auth): ?>
                    <option value="<?= htmlspecialchars($auth['Id']) ?>">
                        <?= htmlspecialchars($auth['NAME']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Шукати</button>
        </form>
    </section>
</body>
</html>