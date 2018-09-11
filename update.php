<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once 'config/Database.php';
include_once 'models/Todo.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
$output = array();
// Instantiate blog post object
$todo = new Todo($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));
if (isset($data->id) AND isset($data->item)) {
    $todo->id = $data->id;
    $todo->item = $data->item;
    if ($todo->update()) {
        $output['status'] = 200;
        $output['message'] = "Task  Updated";
    } else {
        $output['status'] = 204;
        $output['message'] = "Task Not Updated";
    }

} elseif (isset($data->id) AND isset($data->sort) AND isset($data->type)) {
    $todo->id = $data->id;
    $todo->sort = $data->sort;
    $todo->todoStatu = $data->type;
    // Update post
    if ($data->type == 1) {
        if ($todo->markAsUncompleted()) {
            $output['status'] = 200;
            $output['message'] = "Task  Uncompleted";
        } else {
            $output['status'] = 204;
            $output['message'] = "Task Not Uncompleted";
        }
    } elseif ($data->type == 2) {

        if ($todo->markAsCompleted()) {
            $output['status'] = 200;
            $output['message'] = "Task  Completed";
        } else {
            $output['status'] = 204;
            $output['message'] = "Task Not Completed";
        }
    }
} elseif (isset($data->from) AND isset($data->posFrom) AND isset($data->to) AND isset($data->posTo)) {
    $todo->from = $data->from;
    $todo->PosFrom = $data->posFrom;
    $todo->to = $data->to;
    $todo->PosTo = $data->posTo;
    // Update post
    if ($todo->Sort()) {
        $output['status'] = 200;
        $output['message'] = "Tasks Sort Updated";
    } else {
        $output['status'] = 204;
        $output['message'] = "Tasks Sort Not Updated";
    }
}

// Turn to JSON & output
echo json_encode($output);