<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once 'config/Database.php';
include_once 'models/Todo.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate todo object
$todo = new Todo($db);

// Get ID
$todo->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get Task
$todo->read_one();

// Create array
if ($todo->item != null) {
    $output = array(
        'id' => $todo->id,
        'item' => $todo->item,
        'sort' => $todo->sort,
        'todoStatu' => $todo->todoStatu,
        'addDate' => $todo->addDate,
        'completDate' => $todo->completDate,
    );
} else {
    $output["status"] = 200;
    $output['message'] = "No data available";
}

// Make JSON
print_r(json_encode($output));
