<?php
// Headers
//http://api.todo.com/
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once 'config/Database.php';
include_once 'models/Todo.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
$output = array();
// Instantiate task object
$todo = new Todo($db);

// task uncompleted query
$uncompleted = $todo->getUncompleted();
// Get row count
$numUncompleted = $uncompleted->rowCount();

// task completed query
$completed = $todo->getCompleted();
// Get row count
$numCompleted = $completed->rowCount();

// Check if any todos
if ($numUncompleted > 0) {
    // Task uncompleted array
    while ($row = $uncompleted->fetch(PDO::FETCH_ASSOC)) {
        $output['uncompleted'][] = $row;
    }
}
if ($numCompleted > 0) {
    // Task array
    while ($row = $completed->fetch(PDO::FETCH_ASSOC)) {
        $output['completed'][] = $row;
    }
} else {
    $output['status'] = 204;
    $output['message'] = 'No Tasks Found';
}
// Turn to JSON & output
echo json_encode($output);
