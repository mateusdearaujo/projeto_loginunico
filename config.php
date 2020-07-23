<?php
try {
    $pdo = new PDO("mysql:dbname=g iit;host=localhost:3306", "mateus", "");
} catch(PDOException $e) {
    echo "Erro: ".$e->getMessage();
}