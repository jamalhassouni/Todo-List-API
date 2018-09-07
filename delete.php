<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
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

// Set ID to update
$todo->id = $data->id;
$todo->todoStatu = $data->type;
$todo->sort = $data->sort;

// Delete Task
if ($todo->delete()) {
    $output['status'] = 200;
    $output['message'] = "Task Deleted";

} else {
    $output['status'] = 204;
    $output['message'] = "Task Not Deleted";
}
echo json_encode($output);
