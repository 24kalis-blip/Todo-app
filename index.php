<?php
require 'database/db.php';
require 'classes/Todo.php';

$pdo = db_connect();

$rows = db_fetch_all($pdo, 'todos');

$todos = [];
$todosDueToday = [];

$today = date('Y-m-d');

foreach ($rows as $row) {
    $todo = new Todo($row['description'], $row['due_date']);
    if ($row['is_completed']) {
        $todo->markAsCompleted();
    }
    
    $todo->id = $row['id'];
    $todos[] = $todo;

    // Add to 'Due Today' if due_date is today
    if ($row['due_date'] === $today) {
        $todosDueToday[] = $todo;
    }
}

require 'views/index.html';