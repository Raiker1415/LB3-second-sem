<?php
require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $startDate = $_POST['start_date'];

    // Підготовка запиту
    $stmt = $pdo->prepare('SELECT DISTINCT name, balance, start, stop, in_traffic, out_traffic FROM client, seanse WHERE start = :start_date AND id_client = fid_client ORDER BY name');

    // Прив'язка значення параметру
    $stmt->bindValue(':start_date', $startDate, PDO::PARAM_STR);

    // Виконання запиту
    $stmt->execute();

    // Отримання результатів
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Формування XML-відповіді
    $xml = new SimpleXMLElement('<response></response>');
    foreach ($results as $row) {
        $record = $xml->addChild('record');
        $record->addChild('name', $row['name']);
        $record->addChild('balance', $row['balance']);
        $record->addChild('start', $row['start']);
        $record->addChild('stop', $row['stop']);
        $record->addChild('in_traffic', $row['in_traffic']);
        $record->addChild('out_traffic', $row['out_traffic']);
    }

    // Встановлення заголовків для відправки XML
    header('Content-Type: application/xml');
    echo $xml->asXML();
}
?>