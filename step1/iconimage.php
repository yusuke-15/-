<?php
require_once 'function.php';

$pdo = connectDB();

$sql = 'SELECT * FROM account where accountID = :accountID LIMIT 1';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':accountID', (int)$_GET['id'], PDO::PARAM_INT);
$stmt->execute();
$image = $stmt->fetch();

echo $image['icon'];
exit();
?>