<?php
require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];

    // Підготовка запиту
    $stmt = $pdo->prepare('SELECT DISTINCT name, balance, start, stop, in_traffic, out_traffic FROM client, seanse WHERE name = :name AND id_client = fid_client');

    // Прив'язка значення параметру
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);

    // Виконання запиту
    $stmt->execute();

    // Отримання результатів
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Виведення результату
    if (count($results) > 0) {
        $output = '';
        foreach ($results as $row) {
            $output .= '<p>Ім\'я: ' . $row['name'] . '</p>';
            $output .= '<p>Баланс: ' . $row['balance'] . '</p>';
            $output .= '<p>Початок сеансу: ' . $row['start'] . '</p>';
            $output .= '<p>Кінець сеансу: ' . $row['stop'] . '</p>';
            $output .= '<p>Вхідний трафік: ' . $row['in_traffic'] . '</p>';
            $output .= '<p>Вихідний трафік: ' . $row['out_traffic'] . '</p>';
            $output .= '<hr>';
        }
        echo $output;
    } else {
        echo 'Результати не знайдені.';
    }
}
?>
