<?php
require 'database/db.php';

$pdo = db_connect();

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Invalid todo ID");
}

db_delete($pdo, 'todos', ['id' => $id]);

header("Location: index.php");
exit;