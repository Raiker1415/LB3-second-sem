<?php
require_once 'db_connection.php';

// Підготовка запиту
$stmt = $pdo->prepare('SELECT DISTINCT name, balance, start, stop, in_traffic, out_traffic FROM client, seanse WHERE id_client = fid_client');

// Виконання запиту
$stmt->execute();

// Отримання результатів
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Формування JSON-відповіді
$response = [];
foreach ($results as $row) {
    $response[] = [
        'name' => $row['name'],
        'balance' => $row['balance'],
        'start' => $row['start'],
        'stop' => $row['stop'],
        'in_traffic' => $row['in_traffic'],
        'out_traffic' => $row['out_traffic']
    ];
}

// Встановлення заголовків для відправки JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
