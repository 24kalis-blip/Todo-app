<?php
require 'database/db.php';

$pdo = db_connect();

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Invalid todo ID");
}

// Fetch current data
$row = db_fetch_one($pdo, 'todos', ['id' => $id]);
if (!$row) {
    die("Todo not found");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $description = $_POST['description'] ?? '';
    $due_date = $_POST['due_date'] ?? '';

    if (empty($description) || empty($due_date)) {
        $errorMessage = "All fields are required.";
    } else {
        $fields = [
            'description' => $description,
            'due_date' => $due_date,
        ];
        db_update($pdo, 'todos', $fields, ['id' => $id]);
        $successMessage = "Todo updated successfully.";
        // Optionally redirect
        header("Location: index.php");
        exit;
    }
}

require 'views/edit.html';