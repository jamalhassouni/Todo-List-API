<?php
// Headers
//RewriteRule ^create/task/([^/]*)$ /create.php?item=$1 [L]
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once 'config/Database.php';
include_once 'models/Todo.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
$output = array();
// Instantiate Todo object
$todo = new Todo($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$todo->item = $data->item;
// Create Task
if ($todo->create()) {
    $output['status'] = 200;
    $output['message'] = "Task  Created";
} else {
    $output['status'] = 204;
    $output['message'] = "Task Not Created";
}

// Turn to JSON & output
echo json_encode($output);
