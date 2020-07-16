<?php

$conn = new PDO('mysql:host=mysql;dbname=php', 'root', '123456');

$stmt = $conn->prepare('SELECT nome FROM empresa LIMIT 0,1');
$stmt->execute();

$rec = $stmt->fetch();
echo $rec['nome'];